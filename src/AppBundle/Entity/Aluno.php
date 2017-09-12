<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="aluno")
 * @UniqueEntity("prontuario", message="Prontuario ja cadastrado."
 * )
 */
class Aluno {   
    
    /**
     * @ORM\Column(type="string",length=10,name="alun_pront", unique=true)
     * @ORM\Id
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 10,
     *      maxMessage = "O prontuario deve conter até 10 caracters",
     *      minMessage = "O prontuario deve conter no minimo 5 caracteres",
     * )
     */
    private $prontuario;
    
    /**
     * @ORM\Column(type="string", length=100,name="alun_nome")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      maxMessage = "O nome deve conter até 100 caracters",
     *      minMessage = "O nome deve conter no minimo 5 caracteres",
     * )
     */
    private $nome;
    
     /**
     * @ORM\Column(type="string", length=200,name="alun_email")
     * @Assert\NotBlank()
     @Assert\Length(
     *      min = 5,
     *      max = 200,
     *      maxMessage = "O e-mail deve conter até 200 caracters",
     *      minMessage = "O e-mail deve conter no minimo 5 caracteres",
     * )
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
