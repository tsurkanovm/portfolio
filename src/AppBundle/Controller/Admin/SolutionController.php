<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Solution;
use AppBundle\Form\SolutionFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SolutionController extends Controller
{
    /**
     * @Route("/solutions", name="admin_solution_list")
     */
    public function indexAction()
    {
        $solutions = $this->getDoctrine()
            ->getRepository('AppBundle:Solution')
            ->findAll();

        return $this->render('admin/solution/index.html.twig', [
            'solutions' => $solutions,
        ]);

    }

    /**
     * @Route("/new_solution", name="admin_solution_add")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(SolutionFormType::class);

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
    public function editAction(Solution $solution)
    {
        $form = $this->createForm(SolutionFormType::class);
        $form->setData($solution);
        return $this->render('admin/solution/edit.html.twig', [
            'solution' => $solution,
            'form' => $form->createView()
        ]);
    }
}
