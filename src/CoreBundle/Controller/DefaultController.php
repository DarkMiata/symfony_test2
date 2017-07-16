<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DM\ContactBundle\Service\MessageGenerator;

class DefaultController extends Controller
{

public function indexAction() {

  $messageGenerator = new MessageGenerator();
  $message = $messageGenerator->getHappyMessage();

  return $this->render('CoreBundle:Default:index.html.twig', array(
    'messageGen' => $message
  ));
}

}
