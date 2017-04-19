<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Client controller.
 *
 * @Route("clients")
 */
class ClientController extends Controller
{
    /**
     * Lists all client entities.
     *
     * @Route("/", name="clients_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
//        $em->getFilters()->disable('softdeleteable');
        $clients = $em->getRepository('AppBundle:Client')->findAllOrderByLastname();

        return $this->render('client/index.html.twig', array(
            'clients' => $clients,
        ));
    }

    /**
     * Creates a new client entity.
     *
     * @Route("/new", name="clients_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $client = new Client();
        $form = $this->createForm('AppBundle\Form\ClientType', $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('clients_show', array('id' => $client->getId()));
        }

        return $this->render('client/new.html.twig', array(
            'client' => $client,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a client entity.
     *
     * @Route("/{id}", name="clients_show", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function showAction(Client $client)
    {
        $clientObj = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Client')
            ->findOneByIdJoinedToChildren($client);
        $deleteForm = $this->createDeleteForm($client);

        return $this->render('client/show.html.twig', array(
            'client' => $clientObj,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing client entity.
     *
     * @Route("/{id}/edit", name="clients_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Client $client)
    {
        $clientObj = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Client')
            ->findOneByIdJoinedToChildren($client);
        
        $deleteForm = $this->createDeleteForm($client);
        $editForm = $this->createForm('AppBundle\Form\ClientType', $clientObj);
        $editForm->handleRequest($request);
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('clients_show', array('id' => $client->getId()));
        }

        return $this->render('client/edit.html.twig', array(
            'client' => $client,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a client entity.
     *
     * @Route("/{id}", name="clients_delete", requirements={"id": "\d+"})
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Client $client, $hard = false)
    {
        $form = $this->createDeleteForm($client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($hard) {
                $em->getFilters()->disable('softdeleteable');
            }
            $em->remove($client);
            $em->flush();
        }

        return $this->redirectToRoute('clients_index');
    }

    /**
     * Creates a form to delete a client entity.
     *
     * @param Client $client The client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clients_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Finds and displays deleted clients.
     *
     * @Route("/restore", name="clients_restore_index")
     * @Method("GET")
     */
    public function indexRestoreAction()
    {
        $em = $this->getDoctrine()->getManager();
        $em->getFilters()->disable('softdeleteable');
        $clients = $em->getRepository('AppBundle:Client')->findAllDeleted();
        return $this->render('client/restore/index.html.twig', array(
            'clients' => $clients,
        ));
    }
    
    /**
     * Finds and displays deleted contacts of a client.
     *
     * @Route("/restore/{id}", name="clients_restore_show", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function showRestoreAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getFilters()->disable('softdeleteable');
        $client = $em->getRepository('AppBundle:Client')->findOneJoinedToDeletedChildren($id);
        
        return $this->render('client/restore/show.html.twig', array(
            'client' => $client,
        ));
    }
    
    
    /**
     * Restores a deleted client.
     *
     * @Route("/{id}/restore", name="clients_restore", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function restoreAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getFilters()->disable('softdeleteable');
        $client = $em->getRepository('AppBundle:Client')->findDeletedJoinedToChildren($id);
        $phones = $client->getPhonenumbers();
        $emails = $client->getEmails();
        
        // restore all phones
        if (!empty($phones)) {
            foreach ($phones as $phone) {
                $phone->setDeletedAt(NULL);
                $em->persist($phone);
            }
        }
        
        // restore all emails
        if (!empty($emails)) {
            foreach ($emails as $email) {
                $email->setDeletedAt(NULL);
                $em->persist($email);
            }
        }
        $client->setDeletedAt(NULL);
        $em->persist($client);
        $em->flush();
        
        return $this->redirectToRoute('clients_restore_index');
    }
    
    /**
     * Restores a deleted email of a client.
     *
     * @Route("/restore/email/{id}", name="clients_restore_email", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function restoreEmailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getFilters()->disable('softdeleteable');
        $email = $em->getRepository('AppBundle:Email')->find($id);
        $email->setDeletedAt(NULL);
        $em->persist($email);
        $em->flush();
        
        return $this->redirectToRoute('clients_restore_show', array('id' => $email->getClient()->getId()));
    }
    
    /**
     * Restores a deleted email of a client.
     *
     * @Route("/restore/phonenumber/{id}", name="clients_restore_phonenumber", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function restorePhonenumberAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getFilters()->disable('softdeleteable');
        $phone = $em->getRepository('AppBundle:Phonenumber')->find($id);
        $phone->setDeletedAt(NULL);
        $em->persist($phone);
        $em->flush();
        
        return $this->redirectToRoute('clients_restore_show', array('id' => $phone->getClient()->getId()));
    }
}
