<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\AppBundle\DAO;

use AppBundle\DAO\OrientadorDAO;
use AppBundle\Entity\Orientador;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of OrientadorDAOTest
 *
 * @author Gabriel Martins
 */
class OrientadorDAOTest extends KernelTestCase {

    private $entityManager;
    private $orientadorDAO;

    protected function setUp() {
        self::bootKernel();

        $this->entityManager = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
        $this->orientadorDAO = new OrientadorDAO($this->entityManager);
    }

    public function testInserirOrientador() {
        $orientador = new Orientador("Orientador A", "orientadorA@ifsp.edu.br", "12345");
        $this->orientadorDAO->inserir($orientador);
    }

    public function testAlterarOrientador() {
       $orientador = new Orientador("Orientador B", "orientadorB@ifsp.edu.br", "12345");
        $this->orientadorDAO->inserir($orientador);
        $orientadorAterador = new Orientador("Orientador C", "orientadorC@ifsp.edu.br", "12345");
        $this->orientadorDAO->alterar($orientador->getId(), $orientadorAterador);
    }

    public function testRemoverOrientador() {
       $orientador = new Orientador("Orientador D", "orientadorD@ifsp.edu.br", "12345");
       $this->orientadorDAO->inserir($orientador);
       $this->orientadorDAO->remover($orientador);
    }

    public function testPesquisarOrientador() {
        $orientador = new Orientador("Orientador E", "orientadorE@ifsp.edu.br", "12345");
        $this->orientadorDAO->inserir($orientador);
      
        $orientadorEncontrado = $this->orientadorDAO->pesquisar($orientador->getId());

        $this->assertEquals($orientadorEncontrado->getId(), $orientador->getId());
        $this->assertEquals($orientadorEncontrado->getNome(), $orientador->getNome());
        $this->assertEquals($orientadorEncontrado->getEmail(), $orientador->getEmail());
        $this->assertEquals($orientadorEncontrado->getSenha(), $orientador->getSenha());
    }

    public function testListarOrienrtadores() {
        $orientadores = $this->orientadorDAO->listarTodos();
        $this->assertNotNull($orientadores);
    }

    protected function tearDown() {
        parent::tearDown();


        $query = $this->entityManager->createQuery(
                        'DELETE AppBundle:Orientador orientador');

        $query->execute();
      
        $this->entityManager->close();
        $this->entityManager = null;
        $this->orientadorDAO = null;
    }

}
