<?php

namespace Waller\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Waller\AppBundle\Entity\User;
use Waller\AppBundle\Form\UserLogin;

class SecurityController extends Controller
{
    /**
    *@Route("/login",name="security_login")
    */
    public function loginAction(){
        $user = new User();
        $form = $this->createForm(UserLogin::class, $user);

//        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump('teste');die;
            return $this->redirectToRoute('tasks');
        }

        return $this->render(
            ':security:login.html.twig',
            array('form' => $form->createView())
        );
    }
}