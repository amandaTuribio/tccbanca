<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\DAO;

use AppBundle\DAO\GenericDAO;
use AppBundle\Entity\TCC;

use Doctrine\ORM\EntityManager;
/**
 * Description of TCCDAO
 *
 * @author home-pc
 */
class TCCDAO extends GenericDAO{

    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
    }
    
    
    public function alterar($id,$entity) {
        $tcc = $this->entityManager->getRepository(TCC::class)->find($id);
        $tcc->setId($entity->getId());
        $tcc->setTitulo($entity->getTitulo());
        $tcc->setAlunos($entity->getAlunos());
        $tcc->setAprovado($entity->isAprovado());
        $this->entityManager->flush();
    }
    
    public function pesquisar($id) {
        $entity = $this->entityManager->getRepository(TCC::class)->find($id);
        return $entity;
    }
    
     public function listarTodos() {
        $repository =  $this->entityManager->getRepository(TCC::class);
        $tccs = $repository->findAll();
        return $tccs;
    }
    
}
