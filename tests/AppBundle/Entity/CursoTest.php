<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CursoTest
 *
 * @author Gabriel
 */

namespace Tests\AppBundle\Model;

use AppBundle\Entity\Curso;
use AppBundle\Entity\Aluno;
use PHPUnit\Framework\TestCase;


class CursoTest extends TestCase{


    

   
   public function testCursoPossuiDados(){
       $curso = new Curso("TECNOLOGIA EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS");
       $this->assertEquals("TECNOLOGIA EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS", $curso->getNome());
        
   }
   
   public function testCursoPossuiAlunos(){
       $curso = new Curso("TECNOLOGIA EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS");
       $aluno1 = new Aluno("156246-1", "Gabriel Martins", "gabriel.souzamartins94@gmail.com", $curso);
       $aluno2 = new Aluno("153252-1", "Joao da Silva", "joao.silva@gmail.com", $curso);
       $curso->adicionarAluno($aluno1);
       $curso->adicionarAluno($aluno2);
       $alunos = $curso->getAlunos();
       $this->assertEquals("TECNOLOGIA EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS", $curso->getNome());
       $this->assertNotNull($curso->getAlunos());
       foreach ($alunos as $aluno){
           printf("\n" . $aluno->getProntuario() . " - " . $aluno->getNome() ."\n") ;
       }
   }
   
   
   
}
