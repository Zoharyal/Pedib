<?php

namespace Simon\CommentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Comment as BaseComment;
use FOS\CommentBundle\Model\SignedCommentInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class Comment extends BaseComment implements SignedCommentInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Thread of this comment
     *
     * @var Thread
     * @ORM\ManyToOne(targetEntity="Simon\CommentBundle\Entity\Thread")
     */
    protected $thread;
    
    /**
     * Author of comment
     *
     * @ORM\ManyToOne(targetEntity="Simon\UserBundle\Entity\User")
     * @var User
     */
    protected $author;
    
    public function setAuthor(UserInterface $author)
    {
        $this->author = $author;
    }
    
    public function getAuthor()
    {
        return $this->author;
    }
    
    public function getAuthorName()
    {
        if (null === $this->getAuthor()) {
            return 'Anonymous';
        }
        
        return $this->getAuthor()->getUsername();
    }
}