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
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=true)
     */
    private $content;
	
	/**
     * @var string
     *
     * @ORM\Column(name="title1", type="string", length=255, nullable=true)
     */
    private $title1;
	
	/**
     * @var string
     *
     * @ORM\Column(name="title2", type="string", length=255, nullable=true)
     */
    private $title2;
	
	/**
     * @var string
     *
     * @ORM\Column(name="title3", type="string", length=255, nullable=true)
     */
    private $title3;
	
	/**
     * @var string
     *
     * @ORM\Column(name="title4", type="string", length=255, nullable=true)
     */
    private $title4;
	
	/**
     * @var string
     *
     * @ORM\Column(name="title5", type="string", length=255, nullable=true)
     */
    private $title5;
	
	/**
     * @var string
     *
     * @ORM\Column(name="title6", type="string", length=255, nullable=true)
     */
    private $title6;
	
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
     * Set summary
     *
     * @param string $summary
     * @return Lesson
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Lesson
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
     * Set title1
     *
     * @param string $title1
     * @return Lesson
     */
    public function setTitle1($title1)
    {
        $this->title1 = $title1;

        return $this;
    }

    /**
     * Get title1
     *
     * @return string 
     */
    public function getTitle1()
    {
        return $this->title1;
    }

    /**
     * Set title2
     *
     * @param string $title2
     * @return Lesson
     */
    public function setTitle2($title2)
    {
        $this->title2 = $title2;

        return $this;
    }

    /**
     * Get title2
     *
     * @return string 
     */
    public function getTitle2()
    {
        return $this->title2;
    }

    /**
     * Set title3
     *
     * @param string $title3
     * @return Lesson
     */
    public function setTitle3($title3)
    {
        $this->title3 = $title3;

        return $this;
    }

    /**
     * Get title3
     *
     * @return string 
     */
    public function getTitle3()
    {
        return $this->title3;
    }

    /**
     * Set title4
     *
     * @param string $title4
     * @return Lesson
     */
    public function setTitle4($title4)
    {
        $this->title4 = $title4;

        return $this;
    }

    /**
     * Get title4
     *
     * @return string 
     */
    public function getTitle4()
    {
        return $this->title4;
    }

    /**
     * Set title5
     *
     * @param string $title5
     * @return Lesson
     */
    public function setTitle5($title5)
    {
        $this->title5 = $title5;

        return $this;
    }

    /**
     * Get title5
     *
     * @return string 
     */
    public function getTitle5()
    {
        return $this->title5;
    }

    /**
     * Set title6
     *
     * @param string $title6
     * @return Lesson
     */
    public function setTitle6($title6)
    {
        $this->title6 = $title6;

        return $this;
    }

    /**
     * Get title6
     *
     * @return string 
     */
    public function getTitle6()
    {
        return $this->title6;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
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

}
