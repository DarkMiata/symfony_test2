<?php

namespace DM\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DM\ContactBundle\Entity\Contact;
use DM\ContactBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
  {
  public function indexAction() {
    return $this->render('DMContactBundle:Default:index.html.twig');
  }
  // ------------------------
  // page de formulaire d'ajout de contact
  public function addAction(Request $request) {
    $contact = new Contact;

    $form = $this->get('form.factory')->create(ContactType::class, $contact);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($contact);
      $em->flush();

      // après l'ajout du contact, redirige vers la page view contact id
      return $this->redirectToRoute('dm_contact_view', array('id' => $contact->getId())
      );
    }

    // envoi et affichage de la page du formulaire
    return $this->render('DMContactBundle:Default:add.html.twig', array(
          'form' => $form->createView()
    ));
  }
  // ------------------------
  // Afficage du contact n°id
  public function viewAction($id) {
    $em = $this->getDoctrine()->getManager();

    $contact = $em->getRepository('DMContactBundle:Contact')->findOneById($id);

    if (null === $contact) {
      throw new NotFoundHttpException("L'annonce d'id " . $id . " n'existe pas.");
    }

    //var_dump($contact);

    return $this->render('DMContactBundle:Default:view.html.twig', array(
          'contact' => $contact
    ));
  }
  // ------------------------
  // liste des contacts
  public function listAction() {
    $em = $this->getDoctrine()->getManager();

    $contacts = $em->getRepository('DMContactBundle:Contact')->findAll();

    return $this->render('DMContactBundle:Default:list.html.twig', array(
          'contacts' => $contacts
    ));
  }
  // ------------------------

// ========================================
  }
