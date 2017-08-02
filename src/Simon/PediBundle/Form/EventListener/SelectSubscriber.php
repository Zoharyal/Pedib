<?php

namespace Simon\PediBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubsriberInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SelectSubscriber implements EventSubsricerInterface
{
    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }
    
    public function preSetData(FormEvent $event)
    {
        $product = $event->getData();
        
    }
}