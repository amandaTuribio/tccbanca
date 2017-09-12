<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\DAO\OrientadorDAO;
use AppBundle\Entity\Orientador;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class OrientadorController extends Controller{
    
    public $orientador;
    
    public function makeForm($orientador){
        $form = $this->createFormBuilder($orientador)
                
            ->add('nome', TextType::class,
                    array('attr' => 
                    array('class'=>'form-control', 'placeholder'=> 'Digite seu nome completo')))
            ->add('senha', PasswordType::class , array('attr' => array('class'=>'form-control')))
            ->add('email', EmailType::class, 
                    array('attr' => 
                    array('class'=>'form-control', 'placeholder'=> 'exemplo@exemplo.com')))
            ->add('save', SubmitType::class, 
                array('label' => 'Inserir','attr' =>
                 array('class'=>' btn btn-outline-success btn-lg btn-block')))
            ->getForm();   
            return  $form->createView();
    }

    /**
     * @Route("/orientador/cadastroOrientador", name="orientador.cadastroOrientador")
     */
    public function cadastro(){
        $form = $this->makeForm($this->orientador);
            return $this->render('orientador/cadastroOrientador.html.twig', array(
            'form' => $form,
            'errors' => null,
        ));
    }
    
    public function validaOrientador($orientador){
        $validator = $this->get('validator');
        $errors = $validator->validate($orientador) ;
        if (count($errors) > 0) {
            foreach ($errors as $error){
                $errorsA[] = $error;
            }
            return $errorsA;
        }
        return null;
    }
    
    /**
     * @Route("/orientador/store")
     */
    public function store(Request $request){
        $dataForm = $request->request->get('form');
        $em = $this->getDoctrine()->getManager();
        $this->orientador = new Orientador($dataForm['nome'], $dataForm['email'], $dataForm['senha']);
        
        $valid = $this->validaOrientador($this->orientador);

        if($valid){
            $form = $this->makeForm($this->orientador);
            return $this->render('aluno/cadastro.html.twig', array(
            'form' => $form,
            'errors' => $valid,
        ));
        }
        
        $dao = new OrientadorDAO($em);
        $dao->inserir($this->orientador);
        $online = true; 

        return $this->redirectToRoute('orientador.listall');
    }
    
    /**
     * @Route("/orientador/update/{id}", name="orientador.update")
     */
    public function update(Request $request,$id){
        $dataForm = $request->request->get('form');  
        $em = $this->getDoctrine()->getManager();
        $this->orientador = new Orientador($dataForm['nome'], $dataForm['email'], $dataForm['senha']);
        $dao = new OrientadorDAO($em);
        $orientador = $dao->alterar($id, $this->orientador);
        return $this->redirectToRoute('orientador.listall');
    }
    
    
    /**
     * @Route("/orientador/edit/{id}", name="orientador.edit")
     */
    public function edit($id){
        $em = $this->getDoctrine()->getManager();
        $dao = new OrientadorDAO($em);
        $orientador = $dao->pesquisar($id);
        $form = $this->makeForm($orientador);
        return $this->render('orientador/edit.html.twig', array(
            'form' => $form,
            'orientador' => $orientador,
            'errors' => null
        ));
    }
    
     /**
     * @Route("/orientador/delete/{id}", name="orientador.delete")
     */
    public function delete($id){
        $em = $this->getDoctrine()->getManager();
        $dao = new OrientadorDAO($em);
        $orientador = $dao->pesquisar($id);
        $dao->remover($orientador);
        return $this->redirectToRoute('orientador.listall');
        
    }
    
     /**
     * @Route("/orientador/find/{id}", name="orientador.find")
     */
    public function find($id){
        $em = $this->getDoctrine()->getManager();
        $dao = new OrientadorDAO($em);
        $orientador = $dao->pesquisar($id);
        return $this->render('orientador/find.html.twig', array(
             'orientador' => $orientador,
        ));
        
    }
    
     /**
     * @Route("/orientador/show")
     */
    public function show(){
        return  $this->render('orientador/show.html.twig');
        
    }
    
      /**
     * @Route("/orientador/listAll", name="orientador.listall")
     */
    public function listAll(){
        $em = $this->getDoctrine()->getManager();
        $dao = new OrientadorDAO($em);
        $orientador = $dao->listarTodos();
        return $this->render('orientador/listAll.html.twig', array(
            'orientador' => $orientador,
        ));
        
    }
}
 
    