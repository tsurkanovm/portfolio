<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Project controller.
 *
 * @Route("projects")
 */
class ProjectController extends Controller
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
        $deleteForm = $this->createDeleteForm($project);
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
     * Creates a form to delete a Project entity.
     *
     * @param Project $project
     * @return Form
     */
    private function createDeleteForm(Project $project): Form
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_project_delete', array('id' => $project->getId())))
            ->setMethod('DELETE')
            ->getForm();
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
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();

            $this->addFlash('success', "Project {$project->getName()} deleted!");
        }

        return $this->redirectToRoute('admin_project_list');
    }
}
