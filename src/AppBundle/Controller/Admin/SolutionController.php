<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Solution;
use AppBundle\Form\SolutionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Solution controller.
 *
 * @Route("solutions")
 */
class SolutionController extends BaseAdminController
{
    /**
     * @Route("/{page}", defaults={"page" = 1}, requirements={"page" = "\d+"}, name="admin_solution_list")
     * @Method("GET")
     *
     * @param int $page
     * @return Response
     */
    public function indexAction(int $page): Response
    {
        $limit = $this->getParameter("paginator_limit");
        $solutions = $this->getDoctrine()
            ->getRepository('AppBundle:Solution')
            ->getAllSolutions($page, $limit);

        return $this->render('admin/solution/index.html.twig', [
            'solutions' => $solutions->getIterator(),
            'currentPage' => $page,
            'maxPages' => ceil($solutions->count() / $limit),
        ]);

    }

    /**
     * @Route("/add", name="admin_solution_add")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(SolutionType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $solution = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($solution);
            $em->flush();

            $this->addFlash('success', "Solution {$solution->getName()} created!");
        }

        return $this->render('admin/solution/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", requirements={"page" = "\d+"}, name="admin_solution_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Solution $solution
     * @return Response
     */
    public function editAction(Request $request, Solution $solution)
    {
        $deleteForm = $this->createDeleteForm($solution, 'admin_solution_delete');
        $form = $this->createForm(SolutionType::class, $solution);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Solution {$solution->getName()} updated!");

            return $this->redirectToRoute('admin_solution_list');
        }

        return $this->render('admin/solution/edit.html.twig', [
            'solution' => $solution,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView()
        ]);
    }

    /**
     * Deletes a Solution entity.
     *
     * @Route("/delete/{id}", requirements={"id" = "\d+"}, name="admin_solution_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param Solution $solution
     * @return Response
     */
    public function deleteAction(Request $request, Solution $solution): Response
    {
        if ($request->isXmlHttpRequest()) {

            return $this->removeProject($solution);
        }

        $form = $this->createDeleteForm($solution, 'admin_solution_delete');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($solution);
            $em->flush();

            $this->addFlash('success', "Solution {$solution->getName()} deleted!");
        }

        return $this->redirectToRoute('admin_solution_list');
    }
}
