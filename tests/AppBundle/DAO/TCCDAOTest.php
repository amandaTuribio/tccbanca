<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\AppBundle\DAO;

use AppBundle\DAO\AlunoDAO;
use AppBundle\DAO\CursoDAO;
use AppBundle\DAO\TCCDAO;
use AppBundle\Entity\Curso;
use AppBundle\Entity\Aluno;
use AppBundle\Entity\Orientador;
use AppBundle\Entity\TCC;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of TCCDAOTest
 *
 * @author Gabriel Martins
 */
class TCCDAOTest extends KernelTestCase {

    private $entityManager;
    private $cursoDAO;
    private $alunoDAO;
    private $orientadorDAO;
    private $tccDAO;

    protected function setUp() {
        self::bootKernel();

        $this->entityManager = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
        $this->alunoDAO = new AlunoDAO($this->entityManager);
        $this->cursoDAO = new CursoDAO($this->entityManager);
        $this->orientadorDAO = new TCCDAO($this->entityManager);
        $this->tccDAO = new TCCDAO($this->entityManager);
    }

    public function testInserirTCC() {

        $curso = new Curso("CURSO A");
        $this->cursoDAO->inserir($curso);
        $aluno = new Aluno("1", "Aluno A", "alunoA@gmail.com", $curso);
        $this->alunoDAO->inserir($aluno);
        $orientador = new Orientador("Orientador A", "orientadorA@gmail.com", "12345");
        $this->orientadorDAO->inserir($orientador);
        $tcc = new TCC("Titulo 1", $orientador);
        $tcc->adicionarAluno($aluno);
        $this->tccDAO->inserir($tcc);
    }

    public function testAlterarTCC() {
        $curso = new Curso("CURSO B");
        $this->cursoDAO->inserir($curso);
        $aluno = new Aluno("2", "Aluno B", "alunoB@gmail.com", $curso);
        $this->alunoDAO->inserir($aluno);
        $orientador = new Orientador("Orientador B", "orientadorB@gmail.com", "12345");
        $this->orientadorDAO->inserir($orientador);
        $tcc = new TCC("Titulo 2", $orientador);
        $tcc->adicionarAluno($aluno);
        $this->tccDAO->inserir($tcc);
        $tccAlterado = new TCC("Titulo 3", $orientador);
        $tccAlterado->adicionarAluno($aluno);
        $this->tccDAO->alterar($tcc->getId(), $tccAlterado);
    }

    public function testRemoverTCC() {
        $curso = new Curso("CURSO C");
        $this->cursoDAO->inserir($curso);
        $aluno = new Aluno("3", "Aluno D", "alunoD@gmail.com", $curso);
        $this->alunoDAO->inserir($aluno);
        $orientador = new Orientador("Orientador C", "orientadorC@gmail.com", "12345");
        $this->orientadorDAO->inserir($orientador);
        $tcc = new TCC("Titulo 4", $orientador);
        $tcc->adicionarAluno($aluno);
        $this->tccDAO->inserir($tcc);
        $this->tccDAO->remover($tcc);
    }

    public function testPesquisarTCC() {
        $curso = new Curso("CURSO D");
        $this->cursoDAO->inserir($curso);
        $aluno = new Aluno("4", "Aluno E", "alunoE@gmail.com", $curso);
        $this->alunoDAO->inserir($aluno);
        $orientador = new Orientador("Orientador D", "orientadorD@gmail.com", "12345");
        $this->orientadorDAO->inserir($orientador);
        $tcc = new TCC("Titulo 5", $orientador);
        $tcc->adicionarAluno($aluno);
        $this->tccDAO->inserir($tcc);


        $tccEncontrado = $this->tccDAO->pesquisar($tcc->getId());

        $this->assertEquals($tccEncontrado->getId(), $tcc->getId());
        $this->assertEquals($tccEncontrado->getTitulo(), $tcc->getTitulo());
    }

    public function testListarTCC() {
        $tccs = $this->tccDAO->listarTodos();
        $this->assertNotNull($tccs);
    }

    public function tearDown() {
        parent::tearDown();



        $queryTCC = $this->entityManager->createQuery(
                'DELETE AppBundle:TCC tcc');

        $queryTCC->execute();


        $queryOrientador = $this->entityManager->createQuery(
                'DELETE AppBundle:Orientador orientador');

        $queryOrientador->execute();


        $queryAluno = $this->entityManager->createQuery(
                'DELETE AppBundle:Aluno aluno');

        $queryAluno->execute();

        $queryCurso = $this->entityManager->createQuery(
                        'DELETE AppBundle:Curso curso 
               WHERE curso.id > :id')
                ->setParameter("id", 4);

        $queryCurso->execute();






        $this->entityManager->close();
        $this->entityManager = null;
        $this->cursoDAO = null;
        $this->alunoDAO = null;
        $this->orientadorDAO = null;
        $this->tccDAO = null;
    }

}
