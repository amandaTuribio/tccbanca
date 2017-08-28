<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
         return $this->render('common/import_assets.html.twig',array('page_title' => 'Cadastro TCC'));
    }
    
    
    /**
     * @Route("/tcc/store")
     */
    public function store(){
        return  $this->render('tcc/store.html.twig');
        
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
