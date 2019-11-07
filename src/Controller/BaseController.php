<?php

namespace App\Controller;

 use App\Entity\User;
 use phpDocumentor\Reflection\Types\This;
 use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use Symfony\Component\Form\Extension\Core\Type\TextType;
 use Symfony\Component\Form\Extension\Core\Type\TextareaType;
 use Symfony\Component\Form\Extension\Core\Type\SubmitType;
 use Symfony\Component\Form\Extension\Core\Type\EmailType;
 use Symfony\Component\Form\Extension\Core\Type\PasswordType;

 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;
 use function Sodium\add;


 class BaseController extends Controller
{
    /**
     * @Route("/",name = "index_page")
     * @Method({"GET"})
     */
    public function index()
    {
        return $this->render("articles/index.html.twig");
    }

    /**
     * @Route("/signup" ,name = "signup")
     * @Method({"GET","POST"})
     */

    public function signup(Request $request){
//        $user = new User();
//        $user->setName("Drin");
//        $user->setLastName("Fejzullahu");
//        $user->setEmail("dfejzullahu07@gmail.com");
//        $user->setPassword("12345678");
//
//
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add("name",TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('lastname',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('email',EmailType::class,array(  'attr'=>array( 'type' => 'email', 'class'=>'form-control')))
            ->add('password',PasswordType::class,array(  'attr'=>array( 'type' =>'password', 'class'=>'form-control')))
            ->add('signup',SubmitType::class,array('label'=>'Sign Up','attr'=>array('class'=>'btn btn-primary mt-3')))
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('index_page');
        }

        return $this->render('articles/signup.html.twig',array(
            'form'=>$form->createView()
        ));
    }


     /**
      * @Route("/login" ,name = "login")
      *
      */

     public function login(Request $request):Response{
//        $user = new User();
//        $user->setName("Drin");
//        $user->setLastName("Fejzullahu");
//        $user->setEmail("dfejzullahu07@gmail.com");
//        $user->setPassword("12345678");
//
//
         $user = new User();
         $form = $this->createFormBuilder($user)

             ->add('email',EmailType::class,array(  'attr'=>array( 'type' => 'email', 'class'=>'form-control')))
             ->add('password',PasswordType::class,array(  'attr'=>array( 'type' =>'password', 'class'=>'form-control')))
             ->add('login',SubmitType::class,array('label'=>'Log In','attr'=>array('class'=>'btn btn-primary mt-3')))
             ->getForm();

         $form->handleRequest($request);

//         $users = $this->getDoctrine()->getRepository(User::class)->findAll();

         $user = $form->getData();

        if($form->isSubmitted()){
            $eml = $user->getEmail();
            $pwd = $user->getPassword();
            $repository = $this->getDoctrine()->getRepository(User::class);
            $user1=$repository->findOneBy(array('email'=>$eml,'password'=>$pwd));
            if(!$user1){
                return new Response("<h1>Wrong</h1>");
            }
            else{
                return $this->redirectToRoute('index_page');
            }
        }

//             $entityManager = $this->getDoctrine()->getManager();
//
//             if($entityManager->find($user.get)){
//                 $entityManager->flush();
//             }


         return $this->render('articles/login.html.twig',array(
             'form'=>$form->createView()
         ));
     }



    public function getUsers(){
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
    }
}