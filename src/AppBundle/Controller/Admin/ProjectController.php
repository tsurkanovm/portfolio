<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Project controller.
 *
 * @Route("projects")
 */
class ProjectController extends BaseAdminController
{
    /**
     * @Route("/{page}", defaults={"page" = 1}, requirements={"page" = "\d+"}, name="admin_project_list")
     * @Method("GET")
     *
     * @param int $page
     * @return Response
     */
    public function indexAction(int $page): Response
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
     * @Route("/add", name="admin_project_add")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request): Response
    {
        $form = $this->createForm(ProjectType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash('success', "Project {$project->getName()} created!");
        }

        return $this->render('admin/project/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", requirements={"page" = "\d+"}, name="admin_project_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Project $project
     * @return Response
     */
    public function editAction(Request $request, Project $project)
    {
        $deleteForm = $this->createDeleteForm($project, 'admin_project_delete');
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Project {$project->getName()} updated!");

            return $this->redirectToRoute('admin_project_list');
        }

        return $this->render('admin/project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView()
        ]);
    }

    /**
     * Deletes a Project entity.
     *
     * @Route("/delete/{id}", requirements={"id" = "\d+"}, name="admin_project_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param Project $project
     * @return Response
     */
    public function deleteAction(Request $request, Project $project): Response
    {
        if ($request->isXmlHttpRequest()) {

            return $this->removeProject($project);
        }

        $form = $this->createDeleteForm($project, 'admin_project_delete');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->removeProject($project);
            $this->addFlash('success', "Project {$project->getName()} deleted!");
        }

        return $this->redirectToRoute('admin_project_list');
    }
}
