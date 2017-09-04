<?php

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
     *@ORM\Column(type="bigint", name="alun_id_curso")
     * @ORM\JoinColumn(name="alun_id_curso", referencedColumnName="curs_id")
     */
    private $curso;
    
    /**
     * @ORM\ManyToOne(targetEntity="TCC", inversedBy="alunos")
     *@ORM\Column(type="bigint", name="alun_id_tcc")
     * @ORM\JoinColumn(name="alun_id_tcc", referencedColumnName="tcc_id")
     */
    private $tcc;
    

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

    function getTcc() {
        return $this->tcc;
    }

    function setTcc($tcc) {
        $this->tcc = $tcc;
    }
    
}
