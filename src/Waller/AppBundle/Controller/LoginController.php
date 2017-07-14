<?php

namespace Waller\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Templating\Storage\Storage;
use Waller\AppBundle\Entity\User;
use Waller\AppBundle\Form\UserLogin;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request){
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserLogin::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        return $this->render(
            ':Login:index.html.twig',
            array('form' => $form->createView())
        );
    }

//    public function autenticaUsuario(string $token){
//        Storage::setItem('token', $token);
//    }
//
    public function ajaxAction(Request $request)
    {
        $data = $request->request->post('request');
        dump($data);die;
    }
}
