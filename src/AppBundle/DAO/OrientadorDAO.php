<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrientadorDAO
 *
 * @author Gabriel Martins
 */


namespace AppBundle\DAO;

use Doctrine\ORM\EntityManager;

use AppBundle\DAO\GenericDAO;

use AppBundle\Entity\Orientador;

class OrientadorDAO extends GenericDAO {
   
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
    }

    public function alterar($id,$entity) {
        $orientador = $this->entityManager->getRepository(Orientador::class)->find($id);
        $orientador->setId($entity->getId());
        $orientador->setNome($entity->getNome());
        $orientador->setEmail($entity->getNome());
        $orientador->setSenha($entity->getSenha());
        $this->entityManager->flush();
    }
    
    public function pesquisar($id) {
        $entity = $this->entityManager->getRepository(Orientador::class)->find($id);
        return $entity;
    }
    
     public function listarTodos() {
        $repository =  $this->entityManager->getRepository(Orientador::class);
        $orientadores = $repository->findAll();
        return $orientadores;
    }
    
}
