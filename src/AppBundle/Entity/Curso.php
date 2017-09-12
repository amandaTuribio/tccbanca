<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Curso
 *
 * @author home-pc
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="curso")
 */
class Curso {
    
    
    /**
     * @ORM\Column(type="integer",name="curs_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    /**
     * @ORM\Column(type="string", length=300,name="curs_nome")
     */
    private $nome;
    
    /**
     * @ORM\OneToMany(targetEntity="Aluno", mappedBy="curso",cascade={"persist"})
     */
    private $alunos;
    
    function __construct($nome) {
        $this->alunos = new ArrayCollection();
        $this->nome = $nome;
    }

    
    function adicionarAluno($aluno) {
        $this->alunos->add($aluno);
    }
    
    function getAlunos() {
        return $this->alunos;
    }
    
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
    
    
    
    


}
