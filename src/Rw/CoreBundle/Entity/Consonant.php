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
}
