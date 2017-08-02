<?php

namespace Simon\PediBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Simon\UploadBundle\Annotation\Uploadable;
use Simon\UploadBundle\Annotation\UploadableField;
use Symfony\Component\HttpFoundation\File\File;


/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="Simon\PediBundle\Repository\AdvertRepository")
 * @Uploadable()
  */
class Advert
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
     * @var int
     *
     * @ORM\Column(name="nbChild", type="integer")
     */
    private $nbChild;
    /**
     * *@ORM\OneToOne(targetEntity="Simon\UserBundle\Entity\User")
     *
     */
    private $user;
    /**
     * *@ORM\OneToOne(targetEntity="Simon\PediBundle\Entity\Planning", cascade={"persist", "remove"})
     *
     */
    private $planning;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;

    /**
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    
    /**
     * @UploadableField(filename="filename", path="adverts")
     */
    private $file;
    /**
     * @var string
     * @ORM\Column(name="filename", type="string", length=255, nullable = true)
     */
    private $filename;
   
    
    
    public function __construct()
    {
        $this->date = new \Datetime();
    }


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
     * Set nbChild
     *
     * @param integer $nbChild
     *
     * @return Advert
     */
    public function setNbChild($nbChild)
    {
        $this->nbChild = $nbChild;

        return $this;
    }

    /**
     * Get nbChild
     *
     * @return int
     */
    public function getNbChild()
    {
        return $this->nbChild;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Advert
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set user
     *
     * @param \Simon\UserBundle\Entity\User $user
     *
     * @return Advert
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

    /**
     * Set planning
     *
     * @param \Simon\PediBundle\Entity\Planning $planning
     *
     * @return Advert
     */
    public function setPlanning(\Simon\PediBundle\Entity\Planning $planning = null)
    {
        $this->planning = $planning;

        return $this;
    }

    /**
     * Get planning
     *
     * @return \Simon\PediBundle\Entity\Planning
     */
    public function getPlanning()
    {
        return $this->planning;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Advert
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }
    
    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File $file|null
     */
    public function setFile($file)
    {
        $this->file = $file;
    }
    
    
}
