<?php

namespace Rw\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Billet
 *
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="Rw\BlogBundle\Entity\BilletRepository")
 */
class Billet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	/**
     * @ORM\OneToMany(targetEntity="Rw\BlogBundle\Entity\Comment", mappedBy="billet", cascade={"remove"})
     */
    private $comments; // Ici comments prend un « s », car un billet a plusieurs commentaires !

    /**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="date", type="datetime")
     */
	private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
	 * @Assert\Length(min=10)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
	 * @Assert\Length(min=2)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
	 * @Assert\NotBlank()
     */
    private $content;
	
	public function __construct()
	{
		// Par défaut, la date du billet est la date d'aujourd'hui
		$this->date = new \Datetime(); 
		$this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     * @return Billet
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
     * Set titre
     *
     * @param string $title
     * @return Billet
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Billet
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }
    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Billet
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
     * Add comment
     *
     * @param \Rw\BlogBundle\Entity\Comment $comments
     * @return Billet
     */
    public function addComment(\Rw\BlogBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;
		$comments->setBillet($this); 
        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Rw\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\Rw\BlogBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
