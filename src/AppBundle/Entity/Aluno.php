<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aluno
 *
 * @author Gabriel Martins
 */


namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="aluno")
 */
class Aluno {
   
    
    /**
     * @ORM\Column(type="string",length=10,name="alun_pront")
     * @ORM\Id
     */
    private $prontuario;
    
     
    /**
     * @ORM\Column(type="string", length=300,name="alun_nome")
     */
    private $nome;
    
     /**
     * @ORM\Column(type="string", length=300,name="alun_email")
     */
    private $email;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="alunos")
     * @ORM\JoinColumn(name="alun_id_curso", referencedColumnName="curs_id")
     */
    private $curso;
    
    

    
    function __construct($prontuario, $nome, $email, $curso) {
        $this->prontuario = $prontuario;
        $this->nome = $nome;
        $this->email = $email;
        $this->curso = $curso;
    }
    
    
    function getProntuario() {
        return $this->prontuario;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getCurso() {
        return $this->curso;
    }

    function setProntuario($prontuario) {
        $this->prontuario = $prontuario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCurso($curso) {
        $this->curso = $curso;
    }





    
}
