<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\AdminEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;

/**
 * Project controller.
 *
 * @Route("projects")
 */
class BaseAdminController extends Controller
{
    /**
     * Creates a form to delete a AdminEntity entity.
     *
     * @param AdminEntity $entity
     * @param string $route
     * @return Form
     */
    protected function createDeleteForm(AdminEntity $entity, string $route): Form
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($route, array('id' => $entity->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @param AdminEntity $entity
     * @return Response
     */
    protected function removeProject(AdminEntity $entity): Response
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();

            return new Response(null, 204);

        } catch (\Throwable $exception) {

            return new Response($exception->getMessage(), 409);
        }
    }
}
