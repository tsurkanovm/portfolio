<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Tsurkanov Mihail <tsurkanovm@gmail.com>
 */
class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction(): Response
    {
        $projects = $this->getDoctrine()
            ->getRepository('AppBundle:Project')
            ->getHomePageProjects();

        return $this->render('main/index.html.twig', ['projects' => $projects]);
    }

    /**
     * @Route("/project/{id}", requirements={"id"="\d+"}, name="project")
     * @Method("GET")
     *
     * @param Project $project
     * @return Response
     */
    public function showAction(Project $project)
    {
        return $this->render('project/show.html.twig', ['project' => $project]);
    }
}
