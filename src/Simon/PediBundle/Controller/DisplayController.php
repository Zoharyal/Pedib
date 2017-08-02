<?php

namespace Simon\PediBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Simon\UserBundle\Entity\User;
use Simon\PediBundle\Entity\Geometry;
use Simon\PediBundle\Entity\Advert;



class DisplayController extends Controller
{
    public function indexAction()
    {
        return $this->render('infoDisplay/index.html.twig');
    }
    
    public function infoAction()   
    {
        return $this->render('infoDisplay/info.html.twig');
    }
    
    public function mapAction()
    {
        $em = $this->getDoctrine()->getManager();
        $geoRepo = $em->getRepository('SimonPediBundle:Geometry');
        $advertRepo = $em->getRepository('SimonPediBundle:Advert');
        $adverts = $advertRepo->findAll();
        $geometryUser = $geoRepo->findAll();
        $advertInfo = [];
        foreach($adverts as $advert)
        {
            
            $user = $advert->getUser();
            $Ageometry = $geoRepo->findByUser($user);
            $username = $user->getUsername();
            foreach($Ageometry as $advertLoca) {
                $ALat = $advertLoca->getLat();
                $ALng = $advertLoca->getLng();
                $ALoca = [$ALat, $ALng];
                array_push($advertInfo, $ALoca);
            }
        }
        $userInfo = [];
        foreach($geometryUser as $user) 
        {
            $Uname = $user->getUser()->getName();
            $ULat = $user->getLat();
            $ULng = $user->getLng();
            $userLoca = [$Uname, $ULat, $ULng];
            array_push($userInfo, $userLoca);
        }
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
    public function userGeometryAction()
    {
        $em = $this->getDoctrine()->getManager();
        $geoRepo = $em->getRepository('SimonPediBundle:Geometry');
        $geometryUser = $geoRepo->findAll();
        $userInfo = [];
        foreach($geometryUser as $user) 
        {
            $AUser = $user->getUser()->getName();
            $ALat = $user->getLat();
            $ALng = $user->getLng();
            $userLoca = [$AUser, $ALat, $ALng];
            array_push($userInfo, $userLoca);
        }
        $response = new JsonResponse;
        return $response->setData(array($userInfo));
        
    }
}
