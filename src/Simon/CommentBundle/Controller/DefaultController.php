<?php

namespace Simon\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SimonCommentBundle:Default:index.html.twig');
    }
}
