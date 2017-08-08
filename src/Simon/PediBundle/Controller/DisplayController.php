<?php

namespace Simon\PediBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Simon\UserBundle\Entity\User;
use Simon\PediBundle\Entity\Geometry;
use Simon\PediBundle\Entity\Advert;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class DisplayController extends Controller
{
    public function indexAction()
    {
        return $this->render('infoDisplay/index.html.twig');
    }
    
    public function infoAction()   
    {
        return $this->render('infoDisplay/infoDescription.html.twig');
    }
    
    public function mapAction()
    {
        $userInfo = $this->container->get('simon_pedi.geometry')->geometryUser();
        $advertInfo = $this->container->get('simon_pedi.geometry')->geometryAdvert();
        $serializer = $this->container->get('simon_pedi.serializer');
        $Ulocation = $serializer->ocSerialize($userInfo);
        $Alocation = $serializer->ocSerialize($advertInfo);
        
        return $this->render('infoDisplay/map.html.twig', array('Ulocation' => $Ulocation,
                                                                'Alocation' => $Alocation));
    }
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $advertRepo = $em->getRepository('SimonPediBundle:Advert');
        $advert = $advertRepo->find($id);
        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ". $id. " n'existe pas.");
        }
        return $this->render('infoDisplay/view.html.twig', array('advert' => $advert));
    }
    
    public function viewAdminAction()
    {
        $em = $this->getDoctrine()->getManager();
        $advertRepo = $em->getRepository('SimonPediBundle:Advert');
        $currentUserId = $this->getUser()->getId();
        $advert = $advertRepo->findOneByUser($currentUserId);
        return $this->render('infoDisplay/viewadmin.html.twig', array('advert' => $advert));
    }
    
    public function infoDescriptionAction()
    {
        return $this->render('infoDisplay/infoDescription.html.twig');
    }
    
    public function infoAvantagesAction()
    {
        return $this->render('infoDisplay/infoAvantages.html.twig');
    }
    
    public function infoFonctionnementAction()
    {
        return $this->render('infoDisplay/infoFonctionnement.html.twig');
    }
    
    public function creditAction()
    {
        return $this->render('infoDisplay/credit.html.twig');
    }
}
