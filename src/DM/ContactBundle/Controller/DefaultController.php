<?php

namespace DM\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DM\ContactBundle\Entity\Contact;
use DM\ContactBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
  {
  /**
   * @Route("/contact/", name="dm_contact_homepage")
   */
  public function indexAction() {
    return $this->render('DMContactBundle:Default:index.html.twig');
  }
  // ------------------------

  /**
  * @Route("/contact/add/", name="dm_contact_add")
  */
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
  /**
  *  @Route("/contact/view/{id}", name="dm_contact_view")
  */
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
  /**
  *  @Route("/contact/list/{msg}", defaults={"msg" = ""}, name="dm_contact_list")
  */
  // liste des contacts

  public function listAction($msg="") {
    $em = $this->getDoctrine()->getManager();

    $contacts = $em->getRepository('DMContactBundle:Contact')->findAll();

    return $this->render('DMContactBundle:Default:list.html.twig',
        [ 'contacts'  => $contacts,
          'msg'       => $msg,
          ]);
  }
  // ------------------------
  /**
  *  @Route("/contact/delete/{id}", name="dm_contact_deleteconfirm")
  */
  public function deleteConfirmAction($id) {
    $em = $this->getDoctrine()->getManager();

    $contact = $em->getRepository('DMContactBundle:Contact')->findOneById($id);

    return $this->render('DMContactBundle:Default:delete_confirm.html.twig', array(
          'contact' => $contact
    ));
  }
  // ------------------------
  /**
   *  @Route("/contact/deletebyid/{id}", name="dm_contact_deletebyid")
   */
  // effacer un élément ID et redirection vers la page de liste.

    public function deleteByIdAction($id) {
    $em       = $this->getDoctrine()->getManager();
    $contact  = $em->getRepository('DMContactBundle:Contact')->findOneById($id);
    $em->remove($contact);
    $em->flush();

    return $this->redirectToRoute('dm_contact_list', array(
      'msg' => "élément ".$id." bien effacé<br>"
    ));

  // ========================================
  // ========================================


  }
// ========================================
  }
