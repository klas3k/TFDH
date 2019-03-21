<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Training
 *
 * @ORM\Table(name="training")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrainingRepository")
 */
class Training
{
    /**
     * @ORM\OneToMany(targetEntity="Lesson", mappedBy="training")
     */
    private $lessons;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duration", type="time")
     */
    private $duration;

    /**
     * @var int
     *
     * @ORM\Column(name="extra_costs", type="integer", nullable=true)
     */
    private $extraCosts;

    public function __construct() {
        $this->lessons = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Training
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
     * Set description
     *
     * @param string $description
     *
     * @return Training
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set duration
     *
     * @param \DateTime $duration
     *
     * @return Training
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return \DateTime
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set extraCosts
     *
     * @param integer $extraCosts
     *
     * @return Training
     */
    public function setExtraCosts($extraCosts)
    {
        $this->extraCosts = $extraCosts;

        return $this;
    }

    /**
     * Get extraCosts
     *
     * @return int
     */
    public function getExtraCosts()
    {
        return $this->extraCosts;
    }

    public function __toString()
    {
        return $this->name;
    }
}

