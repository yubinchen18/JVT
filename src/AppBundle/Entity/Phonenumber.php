<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phonenumber
 *
 * @ORM\Table(name="phonenumber")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhonenumberRepository")
 */
class Phonenumber
{
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
     * @ORM\Column(name="type_label", type="string", length=255)
     */
    private $typeLabel;

    /**
     * @var int
     *
     * @ORM\Column(name="digits", type="integer")
     */
    private $digits;
    
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="phonenumbers")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     */
    private $client;


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
     * Set typeLabel
     *
     * @param string $typeLabel
     *
     * @return Phonenumber
     */
    public function setTypeLabel($typeLabel)
    {
        $this->typeLabel = $typeLabel;

        return $this;
    }

    /**
     * Get typeLabel
     *
     * @return string
     */
    public function getTypeLabel()
    {
        return $this->typeLabel;
    }

    /**
     * Set digits
     *
     * @param integer $digits
     *
     * @return Phonenumber
     */
    public function setDigits($digits)
    {
        $this->digits = $digits;

        return $this;
    }

    /**
     * Get digits
     *
     * @return int
     */
    public function getDigits()
    {
        return $this->digits;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Phonenumber
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
