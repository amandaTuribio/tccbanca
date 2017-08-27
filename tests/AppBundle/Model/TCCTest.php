<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TCCTest
 *
 * @author Gabriel
 */

namespace Tests\AppBundle\Controller;

use PHPUnit\Framework\TestCase;

use AppBundle\Entity\Aluno;

use AppBundle\Entity\Curso;

use AppBundle\Entity\Orientador;

use AppBundle\Entity\TCC;


class TCCTest extends TestCase{
   
   private $aluno;
   private $orientador;
    
   public function setUp() {
      $curso = new Curso("TECNOLOGIA EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS");
      $this->orientador = new Orientador("GIOVANI", "giovani@ifsp.edu.br", "12345");
      $this->aluno = new Aluno(1562461, "Gabriel Martins", "gabriel.souzamartins94@gmail.com", $curso);
   }
   
   public function testTccPossuiDados(){
       $tcc = new TCC("Titulo TCC",$this->aluno,$this->orientador);
       
       $this->assertEquals("Titulo TCC", $tcc->getTitulo());
       $this->assertEquals($this->aluno->getProntuario(), $tcc->getAluno()->getProntuario());
       $this->assertEquals($this->aluno->getNome(), $tcc->getAluno()->getNome());
       $this->assertEquals($this->aluno->getEmail(), $tcc->getAluno()->getEmail());
       $this->assertEquals($this->aluno->getCurso()->getId(), $tcc->getAluno()->getCurso()->getId());
       $this->assertEquals($this->aluno->getCurso()->getNome(), $tcc->getAluno()->getCurso()->getNome());
       $this->assertEquals($this->orientador->getId(), $tcc->getOrientador()->getId());
       $this->assertEquals($this->orientador->getEmail(), $tcc->getOrientador()->getEmail());
       $this->assertEquals($this->orientador->getSenha(), $tcc->getOrientador()->getSenha());
        
   }
   
   
   
}
