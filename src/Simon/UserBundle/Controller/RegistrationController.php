<?php

namespace Simon\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Simon\PediBundle\Entity\Geometry;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;


class RegistrationController extends BaseController
{
    /**
     * Tell the user his account is now confirmed.
     */
    public function confirmedAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $address = $user->getAddress();
        $geocodeAddress = $address . ",La Bourboule";
        $geo = $this->container->get('simon_user.geocoder');
        $coord = $geo->geocode($geocodeAddress);
        $geometry = new Geometry();
        $geometry->setLat($coord[0]);
        $geometry->setLng($coord[1]);
        $geometry->setUser($user);
        $em->persist($geometry);
        $em->flush();
    

        

        return $this->render('@FOSUser/Registration/confirmed.html.twig', array(
            'user' => $user,
            'targetUrl' => $this->getTargetUrlFromSession(),
        ));
    }
    /**
     * @return mixed
     */
    private function getTargetUrlFromSession()
    {
        $key = sprintf('_security.%s.target_path', $this->get('security.token_storage')->getToken()->getProviderKey());

        if ($this->get('session')->has($key)) {
            return $this->get('session')->get($key);
        }
    }

}
