<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TypeLabel
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\Table(name="type_label")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeLabelRepository")
 */
class TypeLabel
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Phonenumber", mappedBy="typeLabel")
     */
    private $phonenumbers;

    /**
     * @ORM\OneToMany(targetEntity="Email", mappedBy="typeLabel")
     */
    private $emails;
    
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
     * Set name
     *
     * @param string $name
     *
     * @return TypeLabel
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
     * Constructor
     */
    public function __construct()
    {
        $this->phonenumbers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add phonenumber
     *
     * @param \AppBundle\Entity\Phonenumber $phonenumber
     *
     * @return TypeLabel
     */
    public function addPhonenumber(\AppBundle\Entity\Phonenumber $phonenumber)
    {
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
        return $this->name;
    }

    /**
     * Add email
     *
     * @param \AppBundle\Entity\Email $email
     *
     * @return TypeLabel
     */
    public function addEmail(\AppBundle\Entity\Email $email)
    {
        $this->emails[] = $email;

        return $this;
    }

    /**
     * Remove email
     *
     * @param \AppBundle\Entity\Email $email
     */
    public function removeEmail(\AppBundle\Entity\Email $email)
    {
        $this->emails->removeElement($email);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TypeLabel
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
     * @return TypeLabel
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
     * @return TypeLabel
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
