<?php

namespace Tests\AppBundle\DAO;

use AppBundle\DAO\AlunoDAO;
use AppBundle\DAO\CursoDAO;
use AppBundle\Entity\Curso;
use AppBundle\Entity\Aluno;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AlunoDAOTest extends KernelTestCase {

    private $entityManager;
    private $cursoDAO;
    private $alunoDAO;

    protected function setUp() {
        self::bootKernel();

        $this->entityManager = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
        $this->alunoDAO = new AlunoDAO($this->entityManager);
        $this->cursoDAO = new CursoDAO($this->entityManager);
    }

    public function testInserirAluno() {

        $curso = new Curso("CURSO A");
        $this->cursoDAO->inserir($curso);
        $aluno = new Aluno("1", "Aluno A", "alunoA@gmail.com", $curso);
        $this->alunoDAO->inserir($aluno);
    }

    public function testAlterarAluno() {
        $curso = new Curso("CURSO B");
        $this->cursoDAO->inserir($curso);
        $aluno = new Aluno("2", "Aluno B", "alunoB@gmail.com", $curso);
        $this->alunoDAO->inserir($aluno);
        $alunoAlterado = new Aluno("2", "Aluno C", "alunoC@gmail.com", $curso);
        $this->alunoDAO->alterar($aluno->getProntuario(), $alunoAlterado);
    }

    public function testRemoverAluno() {
        $curso = new Curso("CURSO C");
        $this->cursoDAO->inserir($curso);
        $aluno = new Aluno("3", "Aluno D", "alunoD@gmail.com", $curso);
        $this->alunoDAO->inserir($aluno);
        $this->alunoDAO->remover($aluno);
    }

    public function testPesquisarAluno() {
        $curso = new Curso("CURSO D");
        $this->cursoDAO->inserir($curso);
        $aluno = new Aluno("4", "Aluno E", "alunoE@gmail.com", $curso);
        $this->alunoDAO->inserir($aluno);



        $alunoEncontrado = $this->alunoDAO->pesquisar($aluno->getProntuario());

        $this->assertEquals($alunoEncontrado->getProntuario(), $aluno->getProntuario());
        $this->assertEquals($alunoEncontrado->getNome(), $aluno->getNome());
        $this->assertEquals($alunoEncontrado->getEmail(), $aluno->getEmail());
        $this->assertEquals($alunoEncontrado->getCurso()->getId(), $aluno->getCurso()->getId());
        $this->assertEquals($alunoEncontrado->getCurso()->getNome(), $aluno->getCurso()->getNome());
    }

    public function testListarAlunos() {
        $alunos = $this->alunoDAO->listarTodos();
        $this->assertNotNull($alunos);
    }

    protected function tearDown() {
        parent::tearDown();


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
    }

}
