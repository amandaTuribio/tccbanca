<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\DAO\AlunoDAO;
use AppBundle\DAO\CursoDAO;
use AppBundle\DAO\TCCDAO;
use AppBundle\Entity\Aluno;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class AlunoController extends Controller{
    
    public $aluno;

    /**
     * @Route("/aluno/listAll", name="aluno.listall")
     */
    public function listAll(){
        $em = $this->getDoctrine()->getManager();
        $dao = new AlunoDAO($em);
        $aluno = $dao->listarTodos();
        return $this->render('aluno/listAll.html.twig', array(
            'aluno' => $aluno,
        ));
    }

    public function makeForm($aluno){
        $form = $this->createFormBuilder($aluno)
            ->add('nome', TextType::class,
                array('attr' => 
                    array('class'=>'form-control', 'placeholder'=> 'Digite o nome completo do Aluno')))
            ->add('prontuario', TextType::class,
                array('attr' => array('class'=>'form-control', 'placeholder'=> 'Digite o prontuario do Aluno. Ex.:Gu1543234')))
            ->add('email', EmailType::class,
                array('attr' => array('class'=>'form-control', 'placeholder'=> 'Digite o e-mail do Aluno')))
            ->add('tcc', ChoiceType::class, 
                array('attr' => 
                    array('class'=>'form-control'), "choices" => $this->buildeTcc()))
            ->add('curso', ChoiceType::class,
                array('attr' => 
                    array('class'=>'form-control'), "choices" => $this->buildeCurso()))
            ->add('save', SubmitType::class, 
                array('label' => 'Inserir','attr' =>
                 array('class'=>' btn btn-outline-success btn-lg btn-block')))
            ->getForm();    
            return  $form->createView();
    }


    /**
     * @Route("/aluno/cadastro")
     */
    public function cadastro(){
        $form = $this->makeForm($this->aluno);
            return $this->render('aluno/cadastro.html.twig', array(
            'form' => $form,
            'errors' => null,
        ));
    }
 
    public function validaAluno($aluno){
        $validator = $this->get('validator');
        $errors = $validator->validate($aluno) ;
        if (count($errors) > 0) {
            foreach ($errors as $error){
                //var_dump($error);
                //$errorsA[] = $error->getmessage();propertyPath
                $errorsA[] = $error;
            }
            return $errorsA;
        }
        return null;
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
        
        $valid = $this->validaAluno($this->aluno);

        if($valid){
            $form = $this->makeForm($this->aluno);
            return $this->render('aluno/cadastro.html.twig', array(
            'form' => $form,
            'errors' => $valid,
        ));
        }
        $dao = new AlunoDAO($em);    
        $dao->inserir($this->aluno);
        return $this->redirectToRoute('aluno.listall');
    }
    
    
    /**
     * @Route("/aluno/find/{id}", name="aluno.find")
     */
    public function find($id){
        $em = $this->getDoctrine()->getManager();
        $dao = new AlunoDAO($em);
        $aluno = $dao->pesquisar($id);
        return $this->render('aluno/find.html.twig', array(
             'aluno' => $aluno,
        ));
    }
    
    /**
     * @Route("/aluno/delete/{id}", name="aluno.delete")
     */
    public function delete($id){
        $em = $this->getDoctrine()->getManager();
        $dao = new AlunoDAO($em);
        $aluno = $dao->pesquisar($id);
        $dao->remover($aluno);
        return $this->redirectToRoute('aluno.listall');
    }

    /**
     * @Route("/aluno/validaProntuario/{id}", name="aluno.validaProntuario")
     */
    public function validaProntuario($id){
        $em = $this->getDoctrine()->getManager();
        $dao = new AlunoDAO($em);
        $aluno = $dao->pesquisar($id);
        return $aluno ;
    }
    
    /**
     * @Route("/aluno/update/{id}", name="aluno.update")
     */
    public function update(Request $request,$id){
        $dataForm = $request->request->get('form');  
        $em = $this->getDoctrine()->getManager();
        $curso = (int) $dataForm['curso'];
        $this->aluno = new Aluno($dataForm['prontuario'], $dataForm['nome'], $dataForm['email'], $curso);
        $this->aluno->setTcc((int) $dataForm['tcc']);
        $dao = new AlunoDAO($em);
        $aluno = $dao->alterar($id,$this->aluno);
        return $this->redirectToRoute('aluno.listall');
    }
    
    
    /**
     * @Route("/aluno/edit/{id}", name="aluno.edit")
     */
    public function edit($id){
        $em = $this->getDoctrine()->getManager();
        $dao = new AlunoDAO($em);
        $aluno = $dao->pesquisar($id);
        $form = $this->makeForm($aluno);
        return $this->render('aluno/edit.html.twig', array(
            'form' => $form,
            'aluno' => $aluno,
            'errors' => null
        ));
    }

    private function buildeCurso() {
        $em = $this->getDoctrine()->getManager();
        $dao = new CursoDAO($em);
        $results = $dao->listarTodos();
        $cursos = array();
        foreach($results as $bu){
             $cursos[$bu->getNome()] = $bu->getId();
        }

        return $cursos;
    }
    private function buildeTcc() {
        $em = $this->getDoctrine()->getManager();
        $dao = new TCCDAO($em);
        $results = $dao->listarTodos();
        $tcc = array();
        foreach($results as $bu){
             $tcc[$bu->getTitulo()] = $bu->getId();
        }

        return $tcc;
    }
    
    
}