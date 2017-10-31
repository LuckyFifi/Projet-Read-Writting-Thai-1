<?php

namespace Rw\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lesson
 *
 * @ORM\Table(name="lesson")
 * @ORM\Entity(repositoryClass="Rw\CoreBundle\Entity\LessonRepository")
 */
class Lesson
{
    /**
     * @ORM\OneToMany(targetEntity="Rw\CoreBundle\Entity\Article", mappedBy="lesson")
    */
	private $articles; // Notez le « s », une lesson est liée à plusieurs articles
	
	/**
	 * @ORM\OneToMany(targetEntity="Rw\CoreBundle\Entity\Consonant", mappedBy="lesson")
	 */
	private $consonants; // Notez le « s », une lesson est liée à plusieurs consonants
	
	/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


	
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
     * Set title
     *
     * @param string $title
     * @return Lesson
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
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
		$this->consonants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add articles
     *
     * @param \Rw\CoreBundle\Entity\Article $article
     * @return Lesson
     */
    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
		
		$article->setLesson($this);
		
        return $this;
    }

    /**
     * Remove articles
     *
     * @param \Rw\CoreBundle\Entity\Article $article
     */
    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }


    /**
     * Add consonant
     *
     * @return Lesson
     */
    public function addConsonant(Consonant $consonant)
    {
        $this->consonants[] = $consonants;
		 
		$consonant->setLesson($this);

        return $this;
    }

    /**
     * Remove consonant
     *
     */
    public function removeConsonant(Consonant $consonant)
    {
        $this->consonants->removeElement($consonant);
    }

    /**
     * Get consonants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConsonants()
    {
        return $this->consonants;
    }
}
