<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Orientador
 *
 * @author Gabriel Martins
 */



namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="orientador")
 */
class Orientador {

    
    /**
     * @ORM\Column(type="integer",name="ori_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
   private $id;
   
   
   /**
     * @ORM\Column(type="string", length=100,name="ori_nome")
     */
   private $nome;
   
   /**
     * @ORM\Column(type="string", length=200,name="ori_email")
     */
   private $email;
   
   
   /**
     * @ORM\Column(type="string", length=200,name="ori_senha")
     */
   private $senha;
                   

   /**
     * @ORM\OneToMany(targetEntity="TCC", mappedBy="orientador")
     */
   private $tccs;
   
   function __construct($nome, $email, $senha) {
       $this->tccs = new ArrayCollection();
       $this->nome = $nome;
       $this->email = $email;
       $this->senha = $senha;
   }
   
   
   function getId() {
       return $this->id;
   }

   function getNome() {
       return $this->nome;
   }

   function getEmail() {
       return $this->email;
   }

   function getSenha() {
       return $this->senha;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setNome($nome) {
       $this->nome = $nome;
   }

   function setEmail($email) {
       $this->email = $email;
   }

   function setSenha($senha) {
       $this->senha = $senha;
   }
   
   function getTccs() {
       return $this->tccs;
   }

   function setTccs($tccs) {
       $this->tccs = $tccs;
   }





   
}
