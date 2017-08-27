<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\DAO;

use Doctrine\ORM\EntityManager;
/**
 * Description of GenericDAO
 *
 * @author Gabriel Martins
 */


abstract class GenericDAO {
    
    protected $entityManager;
    
    
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    public function inserir($entity) {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function pesquisar($id) {
    }

    public function remover($entity) {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function alterar($id,$entity) {
   
    }
    
    public function listarTodos() {
      
    }
    
    
}
