<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Employee controller.
 *
 * @Route("employee")
 */
class EmployeeController extends Controller
{
    /**
     * Lists all employee entities.
     *
     * @Route("/", name="employee_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Employee::class);
        $employee = $repository->findAll();
        return $this->render('employee/index.html.twig', array(
            'employees' => $employee,
        ));
    }

    /**
     * Creates a new employee entity.
     *
     * @Route("/new", name="employee_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createForm('AppBundle\Form\EditEmployeeType', $employee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cr = $this->getDoctrine()->getManager();
            $cr->persist($employee);
            $cr->flush();
            return $this->redirectToRoute('employee_index');
        }
        return $this->render('employee/new.html.twig', array(
            'employees' => $employee,
            'form' => $form->createView()
        ));
    }

    /**
     * Find and display a employee entity.
     *
     * @Route("/{id}", name="employee_show")
     * @Method("GET")
     */
    public function showAction(Employee $employee)
    {
        //dump($employee);
        return $this->render('employee/show.html.twig', array(
            'employees' => $employee,
        ));
    }

    /**
     * Update entity
     * @Route("/{id}/edit", name="employee_edit")
     *
     */
    public function editAction(Request $request, Employee $employee)
    {
        dump($employee);
        $editForm = $this->createForm('AppBundle\Form\EditEmployeeType', $employee);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('employee_index');
        }
        return $this->render('employee/update.html.twig', array(
            'employee' => $employee,
            'update_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a employee entity.
     * @Route("/{id}/delete", name="employee_delete")
     *
     */
    public function deleteAction(Request $request, Employee $employee)
    {
        $deleteForm = $this->createForm('AppBundle\Form\DeleteEmployeeType', $employee);
        $deleteForm->handleRequest($request);
        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employee);
            $em->flush();
            return $this->redirectToRoute('employee_index');
        }
        return $this->render('employee/delete.html.twig', array(
            'employees' => $employee,
            'delete_form' => $deleteForm->createView()));
    }
}
