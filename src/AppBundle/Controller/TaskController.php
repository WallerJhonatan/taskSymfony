<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskController extends Controller
{
    /**
     * @Route("/tasks/show", name="showTask")
     */
    public function showAction()
    {
        return $this->render(':task:show.html.twig');
    }

    /**
     * @Route("/tasks/{name}", name="homepage")
     */
    public function indexAction($name)
    {

        $tasks = [
            'andar',
            'sair',
            'chegar'
        ];

        return $this->render('task/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'name' => $name,
            'tasks' => $tasks
        ]);
    }

    /**
     * @Route("/tasks", name="tasks")
     * @Method("GET")
     */
    public function apiAction()
    {
        $tasks = [
            'andar',
            'sair',
            'chegar'
        ];

        return new JsonResponse($tasks);
    }

    /**
     * @Route("tasks/new/{name}", name="novoTask")
     */
    public function newAction(string $name)
    {
        $task = new Task();
        $task->setName($name);
        $task->setStatus(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em-> flush();

        return new JsonResponse("task has been created");
    }
}
