<?php

namespace Simon\PediBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Geometry
 *
 * @ORM\Table(name="geometry")
 * @ORM\Entity(repositoryClass="Simon\PediBundle\Repository\GeometryRepository")
 */
class Geometry
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     *
     *@ORM\OneToOne(targetEntity="Simon\UserBundle\Entity\User")
     *
     */
    private $user;

    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float")
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="float")
     */
    private $lng;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lat
     *
     * @param float $lat
     *
     * @return Geometry
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param float $lng
     *
     * @return Geometry
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set user
     *
     * @param \Simon\UserBundle\Entity\User $user
     *
     * @return Geometry
     */
    public function setUser(\Simon\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Simon\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
