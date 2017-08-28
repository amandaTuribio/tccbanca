<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrientadorTest
 *
 * @author Gabriel
 */

namespace Tests\AppBundle\Model;

use AppBundle\Entity\Orientador;

use PHPUnit\Framework\TestCase;


class OrientadorTest extends TestCase{

   
   public function testOrientadorPossuiDados(){
      
       $orientador = new Orientador("Orientador A","orientadorA@ifsp.edu.br","12345");
       
       $this->assertEquals("Orientador A", $orientador->getNome());
       $this->assertEquals("orientadorA@ifsp.edu.br", $orientador->getEmail());
       $this->assertEquals("12345", $orientador->getSenha());
        
   }
   
   
   
}
