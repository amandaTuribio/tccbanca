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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * Description of TCCConstroller
 *
 * @author Gabriel Martins
 */
class TCCController extends Controller{
    
    /**
     * @Route("/tcc/cadastro")
     */
    public function cadastro(){
        $entityManager = $this->getDoctrine()->getManager();
        $orientadorDAO = new OrientadorDAO($entityManager);
        $cursoDAO = new CursoDAO($entityManager);
        $orientadores = $orientadorDAO->listarTodos();
        $cursos = $cursoDAO->listarTodos();
         return $this->render('tcc/cadastro.html.twig',array('orientadores'=>$orientadores,
                                                             'cursos'=>$cursos));
 
      
    }
    
    
    /**
        * @Route("/tcc/store",name="salvartcc")
     */
    public function store(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $orientadorDAO = new OrientadorDAO($entityManager);
        $titulo = $request->get('titulo');
        $orientador = $orientadorDAO->pesquisar($request->get('orientador'));
        $tcc = new TCC($titulo, $orientador);
        
        $tccDAO = new TCCDAO($entityManager);
        $tccDAO->inserir($tcc);
        $this->addFlash("Sucesso", "Cadastro Realizado com Sucesso !!!");
        
        return $this->render('tcc/cadastro_sucess.html.twig');
     
    }
    
    
    /**
     * @Route("/tcc/update")
     */
    public function update(){
        return  $this->render('tcc/update.html.twig');
        
    }
    
     /**
     * @Route("/tcc/delete")
     */
    public function delete(){
        return  $this->render('tcc/delete.html.twig');
        
    }
    
     /**
     * @Route("/tcc/find")
     */
    public function find(){
        return  $this->render('tcc/find.html.twig');
        
    }
    
     /**
     * @Route("/tcc/show")
     */
    public function show(){
        return  $this->render('tcc/show.html.twig');
        
    }
    
     /**
     * @Route("/tcc/listAll")
     */
    public function listAll(){
        return  $this->render('tcc/listAll.html.twig');
        
    }
}
