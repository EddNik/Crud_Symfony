<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Crud;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Crud controller.
 *
 * @Route("crud")
 */
class CrudController extends Controller
{
    /**
     * Lists all crud entities.
     *
     * @Route("/", name="crud_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Crud::class);
        $crud = $repository->findAll();
        return $this->render('crud/index.html.twig', array(
            'employees' => $crud,
        ));
    }
    /**
     * Creates a new crud entity.
     *
     * @Route("/new", name="crud_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crud = new Crud();
        $form = $this->createForm('AppBundle\Form\CrudType', $crud);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cr = $this->getDoctrine()->getManager();
            $cr->persist($crud);
            $cr->flush();
            return $this->redirectToRoute('crud_index');
        }
        return $this->render('crud/new.html.twig', array(
            'employees' => $crud,
            'form' => $form->createView()
        ));
    }
    /**
     * Find and display a crud entity.
     *
     * @Route("/{id}", name="crud_show")
     * @Method("GET")
     */
    public function showAction(Crud $crud)
    {
        $repository = $this->getDoctrine()->getRepository(Crud::class);
        $crud = $repository->find($crud->getId());
        return $this->render('crud/show.html.twig', array(
            'employees' => $crud,
        ));
    }
    /**
     * Update entity
     * @Route("/{id}/edit", name="crud_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Crud $crud)
    {
        $editForm = $this->createForm('AppBundle\Form\CrudType', $crud);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('crud_index');
        }
        return $this->render('crud/update.html.twig', array(
            'crud' => $crud,
            'update_form' => $editForm->createView(),
        ));
    }
    /**
     * Deletes a crud entity.
     * @Route("/{id}/delete", name="crud_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Crud $crud)
    {
        $deleteForm = $this->createForm('AppBundle\Form\DeleteType', $crud);
        $deleteForm->handleRequest($request);
        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crud);
            $em->flush();
            return $this->redirectToRoute('crud_index', array('id' => $crud->getId()));
        }
        return $this->render('crud/delete.html.twig', array(
            'employees' => $crud,
            'delete_form' => $deleteForm->createView()));
    }
}
