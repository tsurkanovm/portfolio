<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Solution;
use AppBundle\Form\SolutionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SolutionController extends Controller
{
    /**
     * @Route("/solutions/{page}", defaults={"page" = 1}, name="admin_solution_list")
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(int $page)
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
     * @Route("/new_solution", name="admin_solution_add")
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
        }

        return $this->render('admin/solution/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit_solution/{id}", name="admin_solution_edit")
     */
    public function editAction(Request $request, Solution $solution)
    {
        $form = $this->createForm(SolutionType::class, $solution);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $solution = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($solution);
            $em->flush();

            $this->addFlash('success', 'Solution updated!');

            return $this->redirectToRoute('admin_solution_list');
        }

        return $this->render('admin/solution/edit.html.twig', [
            'solution' => $solution,
            'form' => $form->createView()
        ]);
    }
}
