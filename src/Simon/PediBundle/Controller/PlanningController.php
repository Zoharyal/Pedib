<?php

namespace Simon\PediBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Simon\PediBundle\Entity\Advert;
use Simon\PediBundle\Entity\Planning;
use Simon\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
        $planningRepo = $em->getRepository('SimonPediBundle:Planning');
        $userRepo = $em->getRepository('SimonUserBundle:User');
        $userPlanning = $userRepo->findByPlanning($id);
        $planning = $planningRepo->find($id);
        $PDayInfo = [];
        foreach ($userPlanning as $userInfo)
        {
            $day = $userInfo->getPlanningday();
            array_push($PDayInfo, $day);
        }
        $form = $this->get('form.factory')->createBuilder(FormType::class, $user)
            ->add('planningday', ChoiceType::class, array( 'label' => 'Sélectionnez un jour',
              'choices' => array('Lundi' => 1, 'Mardi' => 2, 'Mercredi' => 3, 'Jeudi' => 4, 'Vendredi' => 5 )))
            ->add('planningcontent', TextType::class, array( 'label' => 'Description'))
            ->add('S\'inscrire au planning', SubmitType::class)
            ->getForm();
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
