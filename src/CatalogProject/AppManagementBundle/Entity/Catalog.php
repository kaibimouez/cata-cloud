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
     * @ORM\Column(name="startDate", type="string", nullable=false)
     */
    public $startDate;

    /**
     * @var string
     *
     * @ORM\Column(name="endDate", type="string", nullable=false)
     */
    public $endDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbLikes", type="integer", nullable=false)
    */
    public $nbLikes;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbViews", type="integer", nullable=false)
    */
    public $nbViews;

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
     * @ORM\OneToMany(targetEntity="CatalogProject\AppManagementBundle\Entity\Article", mappedBy="catalog")
    */
    public $articles;  





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

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Catalog
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Catalog
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set nbLikes
     *
     * @param integer $nbLikes
     *
     * @return Catalog
     */
    public function setNbLikes($nbLikes)
    {
        $this->nbLikes = $nbLikes;

        return $this;
    }

    /**
     * Get nbLikes
     *
     * @return integer
     */
    public function getNbLikes()
    {
        return $this->nbLikes;
    }

    /**
     * Set nbViews
     *
     * @param integer $nbViews
     *
     * @return Catalog
     */
    public function setNbViews($nbViews)
    {
        $this->nbViews = $nbViews;

        return $this;
    }

    /**
     * Get nbViews
     *
     * @return integer
     */
    public function getNbViews()
    {
        return $this->nbViews;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add article
     *
     * @param \CatalogProject\AppManagementBundle\Entity\Article $article
     *
     * @return Catalog
     */
    public function addArticle(\CatalogProject\AppManagementBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \CatalogProject\AppManagementBundle\Entity\Article $article
     */
    public function removeArticle(\CatalogProject\AppManagementBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
