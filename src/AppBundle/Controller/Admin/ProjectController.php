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
        $form = $this->createForm(ProjectFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();
        }

        return $this->render('admin/project/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit_project/{id}", name="admin_project_edit")
     */
    public function editAction(Project $project)
    {
        $form = $this->createForm(ProjectFormType::class);
        $form->setData($project);
        return $this->render('admin/project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView()
        ]);
    }
}
