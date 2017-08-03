<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\FileStorage;
use AppBundle\Form\FileStorageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Filestorage controller.
 *
 * @Route("files")
 */
class FileStorageController extends Controller
{
    /**
     * Lists all fileStorage entities.
     *
     * @Route("/{page}", defaults={"page" = 1}, requirements={"page" = "\d+"}, name="admin_files_list")
     * @Method("GET")
     *
     * @param int $page
     * @return Response
     */
    public function indexAction($page): Response
    {
        $limit = $this->getParameter("paginator_limit");
        $em = $this->getDoctrine()->getManager();

        $files = $em->getRepository('AppBundle:FileStorage')->getAllFiles($page, $limit);

        return $this->render('admin/filestorage/index.html.twig', array(
            'fileStorages' => $files,
            'currentPage' => $page,
            'maxPages' => ceil($files->count() / $limit),
        ));
    }

    /**
     * Creates a new fileStorage entity.
     *
     * @Route("/add", name="admin_files_add")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request): Response
    {
        $fileStorage = new Filestorage();
        $form = $this->createForm('AppBundle\Form\FileStorageType', $fileStorage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fileStorage);
            $em->flush();

            $this->addFlash('success', "File {$fileStorage->getName()} created!");

            return $this->redirectToRoute('admin_files_show', array('id' => $fileStorage->getId()));
        }

        return $this->render('admin/filestorage/new.html.twig', array(
            'fileStorage' => $fileStorage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fileStorage entity.
     *
     * @Route("/show/{id}", requirements={"id" = "\d+"}, name="admin_files_show")
     * @Method("GET")
     *
     * @param FileStorage $fileStorage
     * @return Response
     */
    public function showAction(FileStorage $fileStorage): Response
    {
        $deleteForm = $this->createDeleteForm($fileStorage);

        return $this->render('admin/filestorage/show.html.twig', array(
            'fileStorage' => $fileStorage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fileStorage entity.
     *
     * @Route("/edit/{id}", requirements={"id" = "\d+"}, name="admin_files_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param FileStorage $fileStorage
     * @return Response
     */
    public function editAction(Request $request, FileStorage $fileStorage): Response
    {
        $deleteForm = $this->createDeleteForm($fileStorage);
        $editForm = $this->createForm(FileStorageType::class, $fileStorage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "File {$fileStorage->getName()} updated!");

            return $this->redirectToRoute('admin_files_edit', array('id' => $fileStorage->getId()));
        }

        return $this->render('admin/filestorage/edit.html.twig', array(
            'fileStorage' => $fileStorage,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a fileStorage entity.
     *
     * @param FileStorage $fileStorage The fileStorage entity
     * @return Form
     */
    private function createDeleteForm(FileStorage $fileStorage): Form
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_files_delete', array('id' => $fileStorage->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Deletes a fileStorage entity.
     *
     * @Route("/delete/{id}", requirements={"id" = "\d+"}, name="admin_files_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param FileStorage $fileStorage
     * @return Response
     */
    public function deleteAction(Request $request, FileStorage $fileStorage): Response
    {
        $form = $this->createDeleteForm($fileStorage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fileStorage);
            $em->flush();

            $this->addFlash('success', "File {$fileStorage->getName()} deleted!");
        }

        return $this->redirectToRoute('admin_files_list');
    }
}
