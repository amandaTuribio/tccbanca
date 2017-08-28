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

namespace Tests\AppBundle\Model;

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
      $this->orientador = new Orientador("Orientador A", "orientadorA@ifsp.edu.br", "12345");
      $this->aluno = new Aluno(12345, "Aluno A", "alunoA@gmail.com", $curso);
   }
   
   public function testTCCPossuiDados(){
       $tcc = new TCC("Titulo TCC",$this->orientador);
       $tcc->adicionarAluno($this->aluno);
       $this->assertEquals("Titulo TCC", $tcc->getTitulo());
       $this->assertNotNull($tcc->getAlunos());
       $this->assertEquals($this->orientador->getId(), $tcc->getOrientador()->getId());
       $this->assertEquals($this->orientador->getEmail(), $tcc->getOrientador()->getEmail());
       $this->assertEquals($this->orientador->getSenha(), $tcc->getOrientador()->getSenha());
        
   }
   
   
   public function testTCCPossuiAlunos(){
       $tcc = new TCC("Titulo TCC",$this->orientador);
       $tcc->adicionarAluno($this->aluno);
       $this->assertEquals("Titulo TCC", $tcc->getTitulo());
       $this->assertNotNull($tcc->getAlunos());
       
   }
   
   
}
