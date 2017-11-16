<?php

namespace Simon\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Simon\UserBundle\Repository\UserRepository")
 * @Vich\Uploadable
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

    protected $address;

    /**
     *@ var string
     *@ORM\Column(name="city", type="string", length=255)
     */
    protected $city;

    /**
     * @var string
     *@ORM\Column(name="postCode", type="string", length=5)
     */
    protected $postCode;

    /**
     * @Vich\UploadableField(mapping="user_avatar", fileNameProperty="avatarName", size="imageSize")
     *
     * @var File
     */
    private $avatarFile;

    /**
     * @var string
     * @ORM\Column(name="avatarName", type="string", length=255, nullable = true)
     */
    private $avatarName;

    /**
     * @ORM\Column(type="integer", nullable =true)
     *
     * @var integer
     */
    private $imageSize;
    /**
     * @ORM\Column(type="datetime", nullable = true)
     *
     * @var \Datetime
     */
    private $updateAt;




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


    public function addRole($role)
    {
        $role = strtoupper($role);

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $avatar
     *
     * @return User
     */
    public function setAvatarFile(File $avatar = null)
    {
        $this->avatarFile = $avatar;

        if ($avatar) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }
    /**
     * @return File|null
     */
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }
    /**
     * Set avatarName
     *
     * @param string $avatarName
     *
     * @return User
     */
    public function setAvatarName($avatarName)
    {
        $this->avatarName = $avatarName;

        return $this;
    }

    /**
     * Get avatarName
     *
     * @return string|null
     */
    public function getAvatarName()
    {
        return $this->avatarName;
    }

    /**
     * Set imageSize
     *
     * @param integer $imageSize
     *
     * @return User
     */
    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    /**
     * Get imageSize
     *
     * @return integer
     */
    public function getImageSize()
    {
        return $this->imageSize;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return User
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    public function __construct()
    {
        $this->updateAt = new \Datetime();
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postCode
     *
     * @param integer $postCode
     *
     * @return User
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return integer
     */
    public function getPostCode()
    {
        return $this->postCode;
    }
}
