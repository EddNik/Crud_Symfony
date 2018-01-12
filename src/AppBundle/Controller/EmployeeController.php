<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Employee controller.
 */
class EmployeeController extends Controller
{
    /**
     * Lists all employee entities.
     *
     * @Route("/employee", name="employee_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Employee::class);
        $employee = $repository->findAll();
        return $this->render('employee/index.html.twig', array(
            'employees' => $employee,
        ));
        //$this->adminAction();
    }

    /**
     * Creates a new employee entity.
     *
     * @Route("/employee/new", name="employee_new")
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
     * @Route("/employee/{id}", name="employee_show")
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
     * @Route("/employee/{id}/edit", name="employee_edit")
     *
     */
    public function editAction(Request $request, Employee $employee)
    {
        //dump($employee);
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
     * @Route("/employee/{id}/delete", name="employee_delete")
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

    /**
     * @Route("/auth/register", name="registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        // whatever *your* User object is
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('access');
        }
        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/auth/login", name="access")
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }
}
