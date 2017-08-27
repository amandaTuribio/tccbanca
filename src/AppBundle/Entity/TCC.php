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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tcc")
 */
class TCC {
   
    
    /**
     * @ORM\Column(type="integer",name="tcc_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=300,name="tcc_titulo")
     */
    private $titulo;
    

      /**
     * @ORM\ManyToMany(targetEntity="Aluno")
     * @ORM\JoinTable(name="tcc_aluno",
     *      joinColumns={@ORM\JoinColumn(name="tcc_alun_pront", referencedColumnName="aluno_pront")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tcc_id", referencedColumnName="tcc_id")}
     *      )
     */
    private $alunos;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Orientador", inversedBy="tccs")
     * @ORM\JoinColumn(name="tcc_id_orientador", referencedColumnName="ori_id")
     */
    private $orientador;
    
     /**
     * @ORM\Column(type="boolean",name="tcc_aprov")
     */
    private $aprovado;
             
    function __construct($titulo, $orientador) {
        $this->alunos = new ArrayCollection();
        $this->titulo = $titulo;
        $this->orientador = $orientador;
    }
    
    function adicionarAluno($aluno) {
        $this->alunos->add($aluno);
    }

    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getAlunos() {
        return $this->alunos;
    }

    function getOrientador() {
        return $this->orientador;
    }

    function getAprovado() {
        return $this->aprovado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setAlunos($alunos) {
        $this->alunos = $alunos;
    }

    function setOrientador($orientador) {
        $this->orientador = $orientador;
    }

    function setAprovado($aprovado) {
        $this->aprovado = $aprovado;
    }



    
    

    
    
}
