<?php

namespace Simon\PediBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Simon\PediBundle\Entity\Advert;
use Simon\PediBundle\Entity\Planning;
use Simon\UserBundle\Entity\User;
use Simon\PediBundle\Form\Type\PlanningType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PlanningController extends Controller
{
    
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $planningRepo = $em->getRepository('SimonPediBundle:Planning');
        $userRepo = $em->getRepository('SimonUserBundle:User');
        
        $user = $this->getUser();
        $planningId = $user->getPlanning()->getId();
        $planning = $planningRepo->find($planningId);
        
        $users = $userRepo->findByPlanning($planningId);
        
        if (null === $planning) {
            throw new NotFoundHttpException("Le planning d'id ".$id. "n'existe pas.");
        }
        
        return $this->render('planningAction/planning.html.twig', array('planning' => $planning, 
                                                                        'users' => $users,
                                                                        'user' => $user));
    }
    
   public function subscribeAction(Request $request, $id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $planning = $em->getRepository('SimonPediBundle:Planning')->find($id);
        $userPlanning = $em->getRepository('SimonUserBundle:User')->findByPlanning($id);
        $PDayInfoService = $this->container->get('simon_pedi.planning')->planningDayinfo($id);
        $PDayInfo = $this->container->get('simon_pedi.serializer')->ocSerialize($PDayInfoService);
        $form = $this->get('form.factory')->create(PlanningType::class, $user);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $user->setPlanning($planning);
                $em->persist($user);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée');
                return $this->redirectToRoute('planning', array('id' => $id));
            }
        }    
        return $this->render('planningAction/subscribe.html.twig', array('form' => $form->createView(), 'info' => $PDayInfo));
    }
    
    public function unsubscribeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->get('form.factory')->create();
        $user = $this->getUser();
        
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
            $user->setPlanning(null);
            $user->setPlanningday(null);
            $user->setPlanningcontent(null);
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('info', "Votre planning a bien été supprimé");
            
            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('planningAction/delete.html.twig', array('form' => $form->createView()));
    }
}
