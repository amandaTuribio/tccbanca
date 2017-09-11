<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\DAO\CursoDAO;
use AppBundle\DAO\OrientadorDAO;
use AppBundle\DAO\TCCDAO;
use AppBundle\Entity\TCC;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of TCCConstroller
 *
 * @author Gabriel Martins
 */
class TCCController extends Controller {

    /**
     * @Route("/tcc/cadastro", name="novotcc")
     */
    public function cadastro() {
        $entityManager = $this->getDoctrine()->getManager();
        $orientadorDAO = new OrientadorDAO($entityManager);
        $cursoDAO = new CursoDAO($entityManager);
        $orientadores = $orientadorDAO->listarTodos();
        $cursos = $cursoDAO->listarTodos();
        return $this->render('tcc/cadastro.html.twig', array('orientadores' => $orientadores,
                    'cursos' => $cursos));
    }

    /**
     * @Route("/tcc/pesquisa_alunos_curso", name="pesquisaralunoscursotcc")
     */
    public function pesquisarAlunosPorCurso(Request $request) {
        try {
            $entityManager = $this->getDoctrine()->getManager();
            $cursoDAO = new CursoDAO($entityManager);
            $curso = $cursoDAO->pesquisar($request->get('curso'));
            $alunos = $curso->getAlunos();
            $json = array();
            foreach ($alunos as $aluno) {
                $json[] = array('id' => $aluno->getProntuario(), 'nome' => $aluno->getNome());
            }


            return new JsonResponse($json);
        } catch (Exception $e) {
            return new JsonResponse(
                    array(
                'status' => 'errorException',
                'message' => $e->getMessage()
                    )
            );
        }
    }

    /**
     * @Route("/tcc/store",name="salvartcc")
     */
    public function store(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $orientadorDAO = new OrientadorDAO($entityManager);
        $tccDAO = new TCCDAO($entityManager);
        $titulo = $request->get('titulo');
        $orientador = $orientadorDAO->pesquisar($request->get('orientador'));

        if (!isNull($tcc) && !isNull($orientador)) {
            $tcc = new TCC($titulo, $orientador);
            $tccDAO->inserir($tcc);
            $status = "saved";
        }else{
            $status = "invalid";
        }


        return new JsonResponse(array('status' => $status));
    }

    /**
     * @Route("/tcc/update")
     */
    public function update() {
        return $this->render('tcc/update.html.twig');
    }

    /**
     * @Route("/tcc/delete")
     */
    public function delete() {
        return $this->render('tcc/delete.html.twig');
    }

    /**
     * @Route("/tcc/find")
     */
    public function find() {
        return $this->render('tcc/find.html.twig');
    }

    /**
     * @Route("/tcc/show")
     */
    public function show() {
        return $this->render('tcc/show.html.twig');
    }

    /**
     * @Route("/tcc/listAll")
     */
    public function listAll() {
        return $this->render('tcc/listAll.html.twig');
    }

}
