<?php

namespace Tests\AppBundle\Model;

use AppBundle\Entity\Aluno;

use AppBundle\Entity\Curso;
use PHPUnit\Framework\TestCase;


class AlunoTest extends TestCase{

   
   public function testAlunoPossuiDados(){
       
       $curso = new Curso("TECNOLOGIA EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS");
       $aluno = new Aluno("1", "Aluno A", "alunoA@gmail.com", $curso);
       
       $this->assertEquals("1", $aluno->getProntuario());
       $this->assertEquals("Aluno A", $aluno->getNome());
       $this->assertEquals("alunoA@gmail.com", $aluno->getEmail());
       $this->assertEquals($curso->getNome(), $aluno->getCurso()->getNome());  
   }
}
