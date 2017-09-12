<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\AppBundle\DAO;

use AppBundle\DAO\CursoDAO;
use AppBundle\Entity\Aluno;
use AppBundle\Entity\Curso;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of CursoDAOTest
 *
 * @author Gabriel Martins
 */
class CursoDAOTest extends KernelTestCase {

    private $entityManager;
    private $cursoDAO;

    protected function setUp() {
        self::bootKernel();
        $this->entityManager = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->cursoDAO = new CursoDAO($this->entityManager);
    }

    public function testInserirCurso() {
        $curso = new Curso("CURSO A");
        $this->cursoDAO->inserir($curso);
    }

    public function testAlterarCurso() {
        $curso = new Curso("CURSO B");
        $this->cursoDAO->inserir($curso);
        $cursoAlterado = new Curso("CURSO C");
        $this->cursoDAO->alterar($curso->getId(), $cursoAlterado);
    }

    public function testRemoverCurso() {
        $curso = new Curso("CURSO D");
        $this->cursoDAO->inserir($curso);
        $this->cursoDAO->remover($curso);
    }

    public function testPesquisarCurso() {
        $curso = new Curso("CURSO E");
        $this->cursoDAO->inserir($curso);
        $cursoEncontrado = $this->cursoDAO->pesquisar($curso->getId());

        $this->assertEquals($cursoEncontrado->getId(), $curso->getId());
        $this->assertEquals($cursoEncontrado->getNome(), $curso->getNome());
    }

    public function testListarCursos() {
        $cursos = $this->cursoDAO->listarTodos();
        $this->assertNotNull($cursos);
    }
    
  

    protected function tearDown() {


        parent::tearDown();


        $query = $this->entityManager->createQuery(
                        'DELETE AppBundle:Curso curso 
               WHERE curso.id > :id')
                ->setParameter("id", 4);

        $query->execute();


        $this->entityManager->close();
        $this->entityManager = null;
        $this->cursoDAO = null;
    }

}
