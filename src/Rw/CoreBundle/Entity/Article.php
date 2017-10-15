<?php

namespace Rw\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="Rw\CoreBundle\Entity\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\ManyToOne(targetEntity="Rw\CoreBundle\Entity\Lesson", inversedBy="articles")
     */
    private $lesson;
	
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
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;


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
     * @return Article
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
     * Set content
     *
     * @param string $content
     * @return Article
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
     * Set advert
     *
     * @param \Rw\CoreBundle\Entity\Lesson $advert
     * @return Article
     */
    public function setLesson(\Rw\CoreBundle\Entity\Lesson $lesson = null)
    {
        $this->lesson = $lesson;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \Rw\CoreBundle\Entity\Lesson 
     */
    public function getLesson()
    {
        return $this->lesson;
    }
}
