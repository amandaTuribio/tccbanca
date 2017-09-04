<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\DAO\AlunoDAO;
use AppBundle\Entity\Aluno;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class AlunoController extends Controller{
    
    public $aluno;

    /**
     * @Route("/aluno/cadastro")
     */
    public function cadastro(){

        $form = $this->createFormBuilder($this->aluno)
            
            ->add('nome', TextType::class)
            ->add('prontuario', TextType::class)
            ->add('email', EmailType::class)
            ->add('curso', NumberType::class)
            ->add('tcc', NumberType::class)
            ->add('save', SubmitType::class, array('label' => 'Inserir'))
            ->getForm();
                   
        return $this->render('aluno/cadastro.html.twig', array(
            'form' => $form->createView(),
        ));
    }
 
    /**
     * @Route("/aluno/store")
     */
    public function store(Request $request){ 

        $dataForm = $request->request->get('form');  
        
        $em = $this->getDoctrine()->getManager();

        $curso = (int) $dataForm['curso'];
        
        $this->aluno = new Aluno($dataForm['prontuario'], $dataForm['nome'], $dataForm['email'], $curso);
        
        $this->aluno->setTcc((int) $dataForm['tcc']);
        
        $dao = new AlunoDAO($em);
        
        var_dump($this->aluno);
        $dao->inserir($this->aluno);

        return  $this->render('aluno/listAll.html.twig');
        
    }
    
    
    /**
     * @Route("/aluno/find")
     */
    public function find(){
        return  $this->render('aluno/find.html.twig');
    }
    
    /**
     * @Route("/aluno/delete")
     */
    public function delete(){
        return  $this->render('aluno/delete.html.twig');
    }
    
    
    /**
     * @Route("/aluno/update")
     */
    public function update(){
        return  $this->render('aluno/update.html.twig');
    }
    
    
    /**
     * @Route("/aluno/show")
     */
    public function show(){
        return  $this->render('aluno/show.html.twig');
    }
    
    /**
     * @Route("/aluno/listAll")
     */
    public function listAll(){
        return  $this->render('aluno/listAll.html.twig');
    }
}