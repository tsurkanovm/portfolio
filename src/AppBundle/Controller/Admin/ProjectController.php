<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Filestorage controller.
 *
 * @Route("projects")
 */
class ProjectController extends Controller
{
    /**
     * @Route("/{page}", defaults={"page" = 1}, requirements={"page" = "\d+"}, name="admin_project_list")
     */
    public function indexAction(int $page)
    {
        $limit = $this->getParameter("paginator_limit");
        $projects = $this->getDoctrine()
            ->getRepository('AppBundle:Project')
            ->getAllProjects($page, $limit);

        return $this->render('admin/project/index.html.twig', [
            'projects' => $projects->getIterator(),
            'currentPage' => $page,
            'maxPages' => ceil($projects->count() / $limit)
        ]);
    }

    /**
     * @Route("/new_project", name="admin_project_add")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(ProjectType::class);

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
    public function editAction(Request $request, Project $project)
    {
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash('success', "Project {$project->getName()} updated!");

            return $this->redirectToRoute('admin_project_list');
        }

        return $this->render('admin/project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView()
        ]);
    }
}
