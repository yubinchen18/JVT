<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmailRepository")
 */
class Email
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
     * @ORM\ManyToOne(targetEntity="TypeLabel", inversedBy="emails")
     * @ORM\JoinColumn(name="type_label_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * 
     */
    private $typeLabel;
    
    /**
     * @var string
     * @Assert\NotBlank(message= "Enter email")
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;
    
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="emails")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $client;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(name="deleted", type="boolean", options={"default":0}))
     */
    private $deleted = 0;


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
     * Set address
     *
     * @param string $address
     *
     * @return Email
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Email
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set typeLabel
     *
     * @param \AppBundle\Entity\TypeLabel $typeLabel
     *
     * @return Email
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
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Email
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
