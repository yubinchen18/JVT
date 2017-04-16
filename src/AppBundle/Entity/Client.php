<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=255, nullable=true)
     */
    private $companyName;
    
    /**
     * @ORM\OneToMany(targetEntity="Phonenumber", mappedBy="client", cascade={"persist", "remove"})
     */
    private $phonenumbers;

    public function __construct()
    {
        $this->phonenumbers = new ArrayCollection();
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Client
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Client
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Client
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Add phonenumber
     *
     * @param \AppBundle\Entity\Phonenumber $phonenumber
     *
     * @return Client
     */
    public function addPhonenumber(\AppBundle\Entity\Phonenumber $phonenumber)
    {
        $phonenumber->setClient($this);
        $this->phonenumbers[] = $phonenumber;

        return $this;
    }

    /**
     * Remove phonenumber
     *
     * @param \AppBundle\Entity\Phonenumber $phonenumber
     */
    public function removePhonenumber(\AppBundle\Entity\Phonenumber $phonenumber)
    {
        $this->phonenumbers->removeElement($phonenumber);
    }

    /**
     * Get phonenumbers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhonenumbers()
    {
        return $this->phonenumbers;
    }
    
    /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        return $this->firstname;
    }
    
    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        if (null === $this->firstname && null === $this->lastname && null === $this->companyName) {
            $context
                ->buildViolation('At least one of the fields must be filled')
                ->atPath('firstname')
                ->addViolation();
        }
    }
}
