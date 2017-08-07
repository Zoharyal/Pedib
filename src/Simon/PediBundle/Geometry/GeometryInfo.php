<?php

namespace Simon\PediBundle\Geometry;


use Simon\UserBundle\Entity\User;
use Simon\PediBundle\Entity\Geometry;
use Simon\PediBundle\Entity\Advert;
use Doctrine\ORM\EntityManager;
    
class GeometryInfo
{
    
    protected $em;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
    public function geometryUser()
    {
        $geometryUser = $this->em->getRepository('SimonPediBundle:Geometry')->findAll();
        $userInfo = [];
        foreach($geometryUser as $user) 
        {
            $Uname = $user->getUser()->getName();
            $ULat = $user->getLat();
            $ULng = $user->getLng();
            $hasAdvert = $user->getUser()->getHasAdvert();
            $userLoca = [$Uname, $ULat, $ULng, $hasAdvert];
            array_push($userInfo, $userLoca);
        }
        
        return $userInfo;
    }
    
    public function geometryAdvert()
    {
        $adverts = $this->em->getRepository('SimonPediBundle:Advert')->findAll();
        $geoRepo = $this->em->getRepository('SimonPediBundle:Geometry');
        $advertInfo= [];
        foreach($adverts as $advert)
        {
            
            $user = $advert->getUser();
            $AId = $advert->getId();
            $Ageometry = $geoRepo->findByUser($user);
            $username = $user->getUsername();
            foreach($Ageometry as $advertLoca) {
                $ALat = $advertLoca->getLat();
                $ALng = $advertLoca->getLng();
                
                $ALoca = [$ALat, $ALng, $AId];
                array_push($advertInfo, $ALoca);
            }
        }
        
        return $advertInfo;
    }
}