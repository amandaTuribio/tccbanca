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
class TCCConstroller extends Controller{
    
    /**
     * @Route("/tcc/cadastro")
     */
    public function cadastro(){
        return  $this->render('tcc/cadastro.html.twig');
        
    }
}
