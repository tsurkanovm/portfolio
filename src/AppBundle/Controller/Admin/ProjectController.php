<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Project;
use AppBundle\Form\ProjectFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends Controller
{
    /**
     * @Route("/projects", name="admin_project_list")
     */
    public function indexAction()
    {
        $projects = $this->getDoctrine()
            ->getRepository('AppBundle:Project')
            ->findAll();

        return $this->render('admin/project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    /**
     * @Route("/new_project", name="admin_project_add")
     */
    public function addAction(Request $request)
    {
//        $project = new Project();
        $form = $this->createForm(ProjectFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }

        return $this->render('admin/project/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/edit_project", name="admin_project_edit")
     */
    public function editAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }


}
