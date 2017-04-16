<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Phonenumber;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Phonenumber controller.
 *
 * @Route("phonenumbers")
 */
class PhonenumberController extends Controller
{
    /**
     * Lists all phonenumber entities.
     *
     * @Route("/", name="phonenumbers_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $phonenumbers = $em->getRepository('AppBundle:Phonenumber')->findAll();

        return $this->render('phonenumber/index.html.twig', array(
            'phonenumbers' => $phonenumbers,
        ));
    }

    /**
     * Creates a new phonenumber entity.
     *
     * @Route("/new", name="phonenumbers_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $phonenumber = new Phonenumber();
        $form = $this->createForm('AppBundle\Form\PhonenumberType', $phonenumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($phonenumber);
            $em->flush();

            return $this->redirectToRoute('phonenumbers_show', array('id' => $phonenumber->getId()));
        }

        return $this->render('phonenumber/new.html.twig', array(
            'phonenumber' => $phonenumber,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a phonenumber entity.
     *
     * @Route("/{id}", name="phonenumbers_show")
     * @Method("GET")
     */
    public function showAction(Phonenumber $phonenumber)
    {
        $deleteForm = $this->createDeleteForm($phonenumber);

        return $this->render('phonenumber/show.html.twig', array(
            'phonenumber' => $phonenumber,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing phonenumber entity.
     *
     * @Route("/{id}/edit", name="phonenumbers_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Phonenumber $phonenumber)
    {
        $deleteForm = $this->createDeleteForm($phonenumber);
        $editForm = $this->createForm('AppBundle\Form\PhonenumberType', $phonenumber);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('phonenumbers_edit', array('id' => $phonenumber->getId()));
        }

        return $this->render('phonenumber/edit.html.twig', array(
            'phonenumber' => $phonenumber,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a phonenumber entity.
     *
     * @Route("/{id}", name="phonenumbers_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Phonenumber $phonenumber)
    {
        $form = $this->createDeleteForm($phonenumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($phonenumber);
            $em->flush();
        }

        return $this->redirectToRoute('phonenumbers_index');
    }

    /**
     * Creates a form to delete a phonenumber entity.
     *
     * @param Phonenumber $phonenumber The phonenumber entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Phonenumber $phonenumber)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('phonenumbers_delete', array('id' => $phonenumber->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
