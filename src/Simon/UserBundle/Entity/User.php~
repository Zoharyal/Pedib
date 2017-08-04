<?php

namespace Simon\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\HttpFoundation\File\File;
use Simon\UploadBundle\Annotation\Uploadable;
use Simon\UploadBundle\Annotation\UploadableField;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Simon\UserBundle\Repository\UserRepository")
 * @Uploadable()
 */
class User extends BaseUser
{
    /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
   protected $id;
   /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="Merci d'entrer votre prénom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=50,
     *     minMessage="Prénom trop court",
     *     maxMessage="Prénom trop long",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     * @Assert\NotBlank(message="Merci d'entrer votre nom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=50,
     *     minMessage="Nom trop court",
     *     maxMessage="Nom trop long",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $lastname;
     /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=12)
     * @Assert\NotBlank(message="Merci d'entrer un numéro de téléphone.", groups={"Registration", "Profile"}))
     * @Assert\Length(
     *      min=10,
     *      max=10,
     *      minMessage="Entrez un numéro de téléphone valide",
     *      maxMessage="Entrez un numéro de téléphone valide",
     *      groups={"Registration", "Profile"}
     * )
     */
    protected $phone;
    /**
     * @var boolean
     *
     *@ORM\Column(name="hasAdvert", type="boolean", nullable=true)
     */
    protected $hasAdvert;
    /**
     * @var boolean
     *
     * @ORM\Column(name="isAdmin", type="boolean", nullable=true)
     */
    protected $Admin;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Simon\PediBundle\Entity\Planning", cascade={"persist"})
     *
     */
    protected $planning;
    /**
     * @var int
     *
     * @ORM\Column(name="planningday", type="smallint", nullable= true)
     */
    protected $planningday;
    /**
     * @var text
     *
     * @ORM\Column(name="planningcontent", type="text", nullable= true)
     */
    protected $planningcontent;
    /**
     *@ var string
     * @ORM\Column(name="address", type="string", length=255)
     */
    protected $address;
    
    
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
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set hasAdvert
     *
     * @param boolean $hasAdvert
     *
     * @return User
     */
    public function setHasAdvert($hasAdvert)
    {
        $this->hasAdvert = $hasAdvert;

        return $this;
    }

    /**
     * Get hasAdvert
     *
     * @return boolean
     */
    public function getHasAdvert()
    {
        return $this->hasAdvert;
    }

    /**
     * Set isAdmin
     *
     * @param boolean $isAdmin
     *
     * @return User
     */
    public function setAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return boolean
     */
    public function getAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set planningday
     *
     * @param integer $planningday
     *
     * @return User
     */
    public function setPlanningday($planningday)
    {
        $this->planningday = $planningday;

        return $this;
    }

    /**
     * Get planningday
     *
     * @return integer
     */
    public function getPlanningday()
    {
        return $this->planningday;
    }

    /**
     * Set planningcontent
     *
     * @param string $planningcontent
     *
     * @return User
     */
    public function setPlanningcontent($planningcontent)
    {
        $this->planningcontent = $planningcontent;

        return $this;
    }

    /**
     * Get planningcontent
     *
     * @return string
     */
    public function getPlanningcontent()
    {
        return $this->planningcontent;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set planning
     *
     * @param \Simon\PediBundle\Entity\Planning $planning
     *
     * @return User
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
     * @return User
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
    
    public function addRole($role)
    {
        $role = strtoupper($role);
        
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
        
        return $this;
    }
}
