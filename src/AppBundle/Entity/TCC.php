<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TCC
 *
 * @author Gabriel Martins
 */

namespace AppBundle\Entity;


class TCC {
   
    private $id;
    private $titulo;
    private $aluno;
    private $orientador;
    private $status;
             
    function __construct($titulo, $aluno, $orientador) {
        $this->titulo = $titulo;
        $this->aluno = $aluno;
        $this->orientador = $orientador;
    }

    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getAluno() {
        return $this->aluno;
    }

    function getOrientador() {
        return $this->orientador;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setAluno($aluno) {
        $this->aluno = $aluno;
    }

    function setOrientador($orientador) {
        $this->orientador = $orientador;
    }

    function setStatus($status) {
        $this->status = $status;
    }


    
    
}
