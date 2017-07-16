<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestMongoController extends Controller
{
    public function viewAction()
    {
        return $this->render('CoreBundle:TestMongo:view.html.twig', array(
            // ...
        ));
    }

    public function addAction()
    {
        return $this->render('CoreBundle:TestMongo:add.html.twig', array(
            // ...
        ));
    }

    public function deleteByIDAction()
    {
        return $this->render('CoreBundle:TestMongo:delete_by_id.html.twig', array(
            // ...
        ));
    }

}
