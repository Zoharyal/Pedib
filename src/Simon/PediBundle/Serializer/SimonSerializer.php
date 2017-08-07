<?php

namespace Simon\PediBundle\Serializer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
   
class SimonSerializer
{

    public function ocSerialize($adverts)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array (new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonFile = $serializer->serialize($adverts,'json');
        return $jsonFile;
    }
}