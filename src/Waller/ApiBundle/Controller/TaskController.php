<?php

namespace Waller\ApiBundle\Controller;

use Waller\ApiBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskController extends Controller
{
    /**
     * @Route("/tasks/show/{id}", name="showTask")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('ApiBundle:Task')->find($id);

        if(!$task){
            throw $this->createNotFoundException("não foi encontrado nenhum registro!");
        }
        return $this->render(':Task:show.html.twig',[
            'task' => $task
        ]);
    }

    /**
     * @Route("/tasks/{name}", name="homepage")
     */
    public function indexAction($name)
    {
        $em = $this->getDoctrine()->getManager();
        $tasks = $em->getRepository("ApiBundle:Task")->findAll();

        return $this->render('Task/index.html.twig', [
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
        $em = $this->getDoctrine()->getManager();
        $tasks = $em->getRepository("ApiBundle:Task")->findAll();

        $json = array();
        foreach ($tasks as $task){
            $json[] = $task->getName();
        }

        return new JsonResponse($json);
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
