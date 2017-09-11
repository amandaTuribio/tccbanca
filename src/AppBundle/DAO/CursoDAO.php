<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CursoDAO
 *
 * @author Gabriel Martins
 */


namespace AppBundle\DAO;

use Doctrine\ORM\EntityManager;

use AppBundle\DAO\GenericDAO;

use AppBundle\Entity\Curso;

class CursoDAO extends GenericDAO {
   
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
    }
    
    
    public function alterar($id,$entity) {
        $curso = $this->entityManager->getRepository(Curso::class)->find($id);
        $curso->setId($entity->getId());
        $curso->setNome($entity->getNome());
        $this->entityManager->flush();
    }
    
    public function pesquisar($id) {
        $entity = $this->entityManager->getRepository(Curso::class)->find($id);
        return $entity;
    }
    
     public function listarTodos() {
        $repository =  $this->entityManager->getRepository(Curso::class);
        $cursos = $repository->findAll();
        return $cursos;
    }
    
   
    
}
