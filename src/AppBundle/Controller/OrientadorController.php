<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\DAO\OrientadorDAO;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class OrientadorController extends Controller{
    
    public $orientador;

    /**
     * @Route("/orientador/cadastroOrientador")
     */
    public function cadastro(){

        $form = $this->createFormBuilder($this->orientador)
            
            ->add('nome', TextType::class)
            ->add('senha', PasswordType::class)
            ->add('email', EmailType::class)
            ->add('save', SubmitType::class, array('label' => 'Cadastrar'))
            ->getForm();
                   
        return $this->render('orientador/cadastroOrientador.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/orientador/store")
     */
    public function store(Request $request){
        $dataForm = $request->request->get('form');
        
        $em = $this->getDoctrine()->getManager();
        
        $this->orientador = new Orientador($dataForm['nome'], $dataForm['senha'], $dataForm['email']);
        
        $dao = new OrientadorDAO($em);
        
        var_dump($this->orientador);
        $dao->inserir($this->orientador);

        return  $this->render('aluno/listAll.html.twig');
        
    }
    
    /**
     * @Route("/orientador/update")
     */
    public function update(){
        return  $this->render('orientador/update.html.twig');
        
    }
    
     /**
     * @Route("/orientador/delete")
     */
    public function delete(){
        return  $this->render('orientador/delete.html.twig');
        
    }
    
     /**
     * @Route("/orientador/find")
     */
    public function find(){
        return  $this->render('orientador/find.html.twig');
        
    }
    
     /**
     * @Route("/orientador/show")
     */
    public function show(){
        return  $this->render('orientador/show.html.twig');
        
    }
    
     /**
     * @Route("/orientador/listAll")
     */
    public function listAll(){
        return  $this->render('orientador/listAll.html.twig');
        
    }
}
 
    