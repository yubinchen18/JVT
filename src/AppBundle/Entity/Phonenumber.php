<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Phonenumber
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
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
     * @ORM\ManyToOne(targetEntity="TypeLabel", inversedBy="phonenumbers")
     * @ORM\JoinColumn(name="type_label_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * 
     */
    private $typeLabel;

    /**
     * @var string
     * @Assert\NotBlank(message = "Enter phone")
     * @ORM\Column(name="digits", type="string", length=255, nullable=false)
     */
    private $digits;
    
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="phonenumbers")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $client;
    
    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;


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

    /**
     * Set typeLabel
     *
     * @param \AppBundle\Entity\TypeLabel $typeLabel
     *
     * @return Phonenumber
     */
    public function setTypeLabel(\AppBundle\Entity\TypeLabel $typeLabel = null)
    {
        $this->typeLabel = $typeLabel;

        return $this;
    }

    /**
     * Get typeLabel
     *
     * @return \AppBundle\Entity\TypeLabel
     */
    public function getTypeLabel()
    {
        return $this->typeLabel;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Phonenumber
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Phonenumber
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return Phonenumber
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
