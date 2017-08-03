<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\FrontendBlock;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Frontendblock controller.
 *
 * @Route("blocks")
 */
class FrontendBlockController extends Controller
{
    /**
     * @Route("/{page}", defaults={"page" = 1}, requirements={"page" = "\d+"}, name="admin_block_list")
     * @Method("GET")
     *
     * @param int $page
     * @return Response
     */
    public function indexAction(int $page): Response
    {
        $limit = $this->getParameter("paginator_limit");
        $blocks = $this->getDoctrine()
            ->getRepository('AppBundle:FrontendBlock')
            ->getAllBlocks($page, $limit);

        return $this->render('admin/block/index.html.twig', [
            'frontendBlocks' => $blocks->getIterator(),
            'currentPage' => $page,
            'maxPages' => ceil($blocks->count() / $limit)
        ]);
    }

    /**
     * Creates a new frontendBlock entity.
     *
     * @Route("/add", name="admin_block_add")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request): Response
    {
        $frontendBlock = new Frontendblock();
        $form = $this->createForm('AppBundle\Form\FrontendBlockType', $frontendBlock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($frontendBlock);
            $em->flush();

            $this->addFlash('success', "Block {$frontendBlock->getName()} created!");

            return $this->redirectToRoute('admin_block_list', array('id' => $frontendBlock->getId()));
        }

        return $this->render('admin/block/new.html.twig', array(
            'frontendBlock' => $frontendBlock,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing frontendBlock entity.
     *
     * @Route("/edit/{id}", requirements={"id" = "\d+"}, name="admin_block_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param FrontendBlock $frontendBlock
     * @return Response
     */
    public function editAction(Request $request, FrontendBlock $frontendBlock): Response
    {
        $deleteForm = $this->createDeleteForm($frontendBlock);
        $editForm = $this->createForm('AppBundle\Form\FrontendBlockType', $frontendBlock);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Block {$frontendBlock->getName()} updated!");

            return $this->redirectToRoute('admin_block_edit', array('id' => $frontendBlock->getId()));
        }

        return $this->render('admin/block/edit.html.twig', array(
            'frontendBlocks' => $frontendBlock,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @param FrontendBlock $frontendBlock
     * @return Form
     */
    private function createDeleteForm(FrontendBlock $frontendBlock): Form
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_block_delete', array('id' => $frontendBlock->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Deletes a frontendBlock entity.
     *
     * @Route("/delete/{id}", name="admin_block_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param FrontendBlock $frontendBlock
     * @return Response
     */
    public function deleteAction(Request $request, FrontendBlock $frontendBlock): Response
    {
        $form = $this->createDeleteForm($frontendBlock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($frontendBlock);
            $em->flush();

            $this->addFlash('success', "Block {$frontendBlock->getName()} deleted!");
        }

        return $this->redirectToRoute('admin_block_list');
    }
}
