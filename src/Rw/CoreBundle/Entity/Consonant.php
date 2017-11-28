<?php

namespace Rw\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consonant
 *
 * @ORM\Table(name="consonant")
 * @ORM\Entity(repositoryClass="Rw\CoreBundle\Entity\consonantRepository")
 */
class Consonant
{
	/**
	 * @ORM\ManyToOne(targetEntity="Rw\CoreBundle\Entity\Lesson",
	 inversedBy="consonants")
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
     * @ORM\OneToOne(targetEntity="Rw\CoreBundle\Entity\Draw", cascade={"persist"})
     */
    private $draw;
	
	/**
     * @ORM\OneToOne(targetEntity="Rw\CoreBundle\Entity\Picture", cascade={"persist"})
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="letter", type="string", length=255)
     */
    private $letter;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="initial", type="string", length=255)
     */
    private $initial;

    /**
     * @var string
     *
     * @ORM\Column(name="final", type="string", length=255)
     */
    private $final;

	/**
     * @var string
     *
     * @ORM\Column(name="classe", type="string", length=255)
     */
    private $classe;
	
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
     * Set letter
     *
     * @param string $letter
     * @return consonant
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;

        return $this;
    }

    /**
     * Get letter
     *
     * @return string 
     */
    public function getLetter()
    {
        return $this->letter;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return consonant
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
     * Set initial
     *
     * @param string $initial
     * @return consonant
     */
    public function setInitial($initial)
    {
        $this->initial = $initial;

        return $this;
    }

    /**
     * Get initial
     *
     * @return string 
     */
    public function getInitial()
    {
        return $this->initial;
    }

    /**
     * Set final
     *
     * @param string $final
     * @return consonant
     */
    public function setFinal($final)
    {
        $this->final = $final;

        return $this;
    }

    /**
     * Get final
     *
     * @return string 
     */
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * Set draw
     *
     * @param \Rw\CoreBundle\Entity\Draw $draw
     * @return Consonant
     */
    public function setDraw(\Rw\CoreBundle\Entity\Draw $draw = null)
    {
        $this->draw = $draw;

        return $this;
    }

    /**
     * Get draw
     *
     * @return \Rw\CoreBundle\Entity\Draw 
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * Set lesson
     *
     * @param \Rw\CoreBundle\Entity\Lesson $lesson
     * @return Consonant
     */
    public function setLesson(\Rw\CoreBundle\Entity\Lesson $lesson = null)
    {
        $this->lesson = $lesson;

        return $this;
    }

    /**
     * Get lesson
     *
     * @return \Rw\CoreBundle\Entity\Lesson 
     */
    public function getLesson()
    {
        return $this->lesson;
    }

    /**
     * Set classe
     *
     * @param string $classe
     * @return Consonant
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return string 
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set picture
     *
     * @param \Rw\CoreBundle\Entity\Picture $picture
     * @return Consonant
     */
    public function setPicture(\Rw\CoreBundle\Entity\Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \Rw\CoreBundle\Entity\Picture 
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
