<?php 
namespace Simon\PediBundle\PlanningInfo;

use Simon\UserBundle\Entity\User;
use Simon\PediBundle\Entity\Planning;
use Doctrine\ORM\EntityManager;

class PlanningInfo
{
    protected $em;
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
    public function planningDayinfo($id)
    {

        $planningRepo = $this->em->getRepository('SimonPediBundle:Planning');
        $userRepo = $this->em->getRepository('SimonUserBundle:User');
        $userPlanning = $userRepo->findByPlanning($id);
        $planning = $planningRepo->find($id);
        $PDayInfo = [];
        $info = [
            "1" => "",
            "2" => "",
            "3" => "",
            "4" => "",
            "5" => "",
        ];
        foreach ($userPlanning as $userInfo)
        {
            $day = $userInfo->getPlanningday();
            array_push($PDayInfo, $day);
        }
        if (in_array("1", $PDayInfo))
        {
            $info["1"] = true;

        } else {
            $info["1"] = false;
            
        }
        if (in_array("2", $PDayInfo))
        {
            $info["2"] = true;
            
        } else {
            $info["2"] = false;
        }
        if (in_array("3", $PDayInfo))
        {
            $info["3"] = true;
        } else {
            $info["3"] = false;
        }
        if (in_array("4", $PDayInfo))
        {
            $info["4"] = true;  
        } else {
            $info["4"] = false;
        }
        if (in_array("5", $PDayInfo))
        {
            $info["5"] = true; 
        } else {
            $info["5"] = false;
        }
        return $info;
    }
}
