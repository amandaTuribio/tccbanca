<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlunoDAO
 *
 * @author Gabriel Martins
 */


namespace AppBundle\DAO;

use Doctrine\ORM\EntityManager;

use AppBundle\DAO\GenericDAO;

use AppBundle\Entity\Aluno;

class AlunoDAO extends GenericDAO {
   
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
    }
    
    
    public function alterar($id,$entity) {
        $aluno = $this->entityManager->getRepository(Aluno::class)->find($id);
        $aluno->setProntuario($entity->getProntuario());
        $aluno->setNome($entity->getNome());
        $aluno->setEmail($entity->getNome());
        $aluno->setCurso($entity->getCurso());
        $this->entityManager->flush();
    }
    
    public function pesquisar($id) {
        $entity = $this->entityManager->getRepository(Aluno::class)->find($id);
        return $entity;
    }
    
     public function listarTodos() {
        $repository =  $this->entityManager->getRepository(Aluno::class);
        $cursos = $repository->findAll();
        return $cursos;
    }
    
}
