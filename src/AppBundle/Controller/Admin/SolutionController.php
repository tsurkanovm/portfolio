<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SolutionController extends Controller
{
    /**
     * @Route("/solutions", name="admin_solution_list")
     */
    public function indexAction()
    {
//        $projects = $this->getDoctrine()
//            ->getRepository('AppBundle:Project')
//            ->findAll();
//
        return $this->render('admin/project/index.html.twig', [
            'projects' => [],
        ]);

    }
}
