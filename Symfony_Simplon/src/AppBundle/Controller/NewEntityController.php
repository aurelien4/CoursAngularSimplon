<?php

namespace AppBundle\Controller;

use AppBundle\Entity\NewEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Newentity controller.
 *
 * @Route("newentity")
 */
class NewEntityController extends Controller
{
    /**
     * Lists all newEntity entities.
     *
     * @Route("/", name="newentity_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $newEntities = $em->getRepository('AppBundle:NewEntity')->findAll();

        return $this->render('newentity/index.html.twig', array(
            'newEntities' => $newEntities,
        ));
    }

    /**
     * Creates a new newEntity entity.
     *
     * @Route("/new", name="newentity_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $newEntity = new Newentity();
        $form = $this->createForm('AppBundle\Form\NewEntityType', $newEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newEntity);
            $em->flush();

            return $this->redirectToRoute('newentity_show', array('id' => $newEntity->getId()));
        }

        return $this->render('newentity/new.html.twig', array(
            'newEntity' => $newEntity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a newEntity entity.
     *
     * @Route("/{id}", name="newentity_show")
     * @Method("GET")
     */
    public function showAction(NewEntity $newEntity)
    {
        $deleteForm = $this->createDeleteForm($newEntity);

        return $this->render('newentity/show.html.twig', array(
            'newEntity' => $newEntity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing newEntity entity.
     *
     * @Route("/{id}/edit", name="newentity_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, NewEntity $newEntity)
    {
        $deleteForm = $this->createDeleteForm($newEntity);
        $editForm = $this->createForm('AppBundle\Form\NewEntityType', $newEntity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('newentity_edit', array('id' => $newEntity->getId()));
        }

        return $this->render('newentity/edit.html.twig', array(
            'newEntity' => $newEntity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a newEntity entity.
     *
     * @Route("/{id}", name="newentity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, NewEntity $newEntity)
    {
        $form = $this->createDeleteForm($newEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($newEntity);
            $em->flush();
        }

        return $this->redirectToRoute('newentity_index');
    }

    /**
     * Creates a form to delete a newEntity entity.
     *
     * @param NewEntity $newEntity The newEntity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(NewEntity $newEntity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('newentity_delete', array('id' => $newEntity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
