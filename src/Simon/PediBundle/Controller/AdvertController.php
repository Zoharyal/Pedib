<?php

namespace Simon\PediBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Simon\PediBundle\Entity\Advert;
use Simon\PediBundle\Entity\Planning;
use Simon\PediBundle\Form\Type\AdvertType;
use Simon\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class AdvertController extends Controller 
{
    public function subscribeAction(Request $request) 
    {
        $advert = new Advert();
        $user = $this->getUser();
        $advert->setUser($user);
        $form = $this->get('form.factory')->create(AdvertType::class, $advert);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //Création  de Planning
            $planning = new Planning();
            $advert->setPlanning($planning);
            $user->setHasAdvert(true);
            $user->setPlanning($planning);
            $em->persist($advert);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée');
            return $this->redirectToRoute('subscribe');
        }
        return $this->render('advertAction/subscribe.html.twig', array('form' => $form->createView()));
    }
    
    public function listAdvertAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $advertRepo = $em->getRepository('SimonPediBundle:Advert');
        $findAdverts = $advertRepo->findAll();
        
        $adverts = $this->get('knp_paginator')->paginate($findAdverts, $request->query->getInt('page',1),2);
        
        return $this->render('advertAction/listadvert.html.twig', array('adverts' => $adverts));
        
        
    }
    
    public function editAdvertAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $advertRepo = $em->getRepository('SimonPediBundle:Advert');
        $currentUserId = $this->getUser()->getId();
        $advert = $advertRepo->findOneByUser($currentUserId);
        $form = $this->get('form.factory')->create(AdvertType::class, $advert);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();
                 $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée');
                return $this->redirectToRoute('homepage');
            }
        return $this->render('advertAction/advertedit.html.twig', array('form' => $form->createView()));
        
    }
    
    public function deleteAdvertAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $advert = $em->getRepository('SimonPediBundle:Advert')->find($id);
        
        $form = $this->get('form.factory')->create();
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($advert);
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");
            
            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('advertAction/delete.html.twig', array('advert' => $advert,
                                                                    'form' => $form->createView(),
                                                                   ));
        
    }
}