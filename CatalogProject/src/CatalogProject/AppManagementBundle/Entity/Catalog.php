<?php

namespace CatalogProject\AppManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ad
 *
 * @ORM\Table(name="Catalog")
 * @ORM\Entity
 */
class Catalog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="catalogName", type="string", length=255, nullable=false)
     */
    public $catalogName;

    /**
     * @var string
     *
     * @ORM\Column(name="catalogCategory", type="string", length=255, nullable=false)
     */
    public $catalogCategory;

    
    /**
     * @var string
     *
     * @ORM\Column(name="creationDate", type="string", nullable=false)
     */
    public $creationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="catalogPhoto", type="string",length=255, nullable=false)
     */
    public $catalogPhoto;

    /**
     * @ORM\ManyToOne(targetEntity="CatalogProject\UserBundle\Entity\User", inversedBy="catalogs")
    */
    public $user;





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
     * Set catalogName
     *
     * @param string $catalogName
     *
     * @return Catalog
     */
    public function setCatalogName($catalogName)
    {
        $this->catalogName = $catalogName;

        return $this;
    }

    /**
     * Get catalogName
     *
     * @return string
     */
    public function getCatalogName()
    {
        return $this->catalogName;
    }

    /**
     * Set catalogCategory
     *
     * @param string $catalogCategory
     *
     * @return Catalog
     */
    public function setCatalogCategory($catalogCategory)
    {
        $this->catalogCategory = $catalogCategory;

        return $this;
    }

    /**
     * Get catalogCategory
     *
     * @return string
     */
    public function getCatalogCategory()
    {
        return $this->catalogCategory;
    }

    /**
     * Set creationDate
     *
     * @param string $creationDate
     *
     * @return Catalog
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return string
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set catalogPhoto
     *
     * @param string $catalogPhoto
     *
     * @return Catalog
     */
    public function setCatalogPhoto($catalogPhoto)
    {
        $this->catalogPhoto = $catalogPhoto;

        return $this;
    }

    /**
     * Get catalogPhoto
     *
     * @return string
     */
    public function getCatalogPhoto()
    {
        return $this->catalogPhoto;
    }

    /**
     * Set user
     *
     * @param \CatalogProject\UserBundle\Entity\User $user
     *
     * @return Catalog
     */
    public function setUser(\CatalogProject\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CatalogProject\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
