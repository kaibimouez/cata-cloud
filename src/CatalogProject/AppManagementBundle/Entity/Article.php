<?php

namespace CatalogProject\AppManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;




/**
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article
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
     * @ORM\Column(name="articleName", type="string", length=255, nullable=false)
     */
    private $articleName;

    /**
     * @var string
     *
     * @ORM\Column(name="articleDescription", type="string", length=255, nullable=false)
     */
    private $articleDescription;

    /**
     * @var date
     *
     * @ORM\Column(name="creationDate", type="date", nullable=false)
     */
    private $creationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="articlePhoto", type="string",length=255, nullable=false)
     */
    private $articlePhoto;

    /**
     * @var float
     *
     * @ORM\Column(name="articleFirstPrice", type="float",length=255, nullable=false)
     */
    private $articleFirstPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="articleSecondPrice", type="float",length=255, nullable=false)
     */
    private $articleSecondPrice; 

    /**
     * @ORM\ManyToOne(targetEntity="CatalogProject\AppManagementBundle\Entity\Catalog", inversedBy="articles")
    */
    public $catalog;   

   

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
     * Set articleName
     *
     * @param string $articleName
     *
     * @return Article
     */
    public function setArticleName($articleName)
    {
        $this->articleName = $articleName;

        return $this;
    }

    /**
     * Get articleName
     *
     * @return string
     */
    public function getArticleName()
    {
        return $this->articleName;
    }

    /**
     * Set articleCategory
     *
     * @param string $articleCategory
     *
     * @return Article
     */
    public function setArticleCategory($articleCategory)
    {
        $this->articleCategory = $articleCategory;

        return $this;
    }

    /**
     * Get articleCategory
     *
     * @return string
     */
    public function getArticleCategory()
    {
        return $this->articleCategory;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Article
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set articlePhoto
     *
     * @param string $articlePhoto
     *
     * @return Article
     */
    public function setArticlePhoto($articlePhoto)
    {
        $this->articlePhoto = $articlePhoto;

        return $this;
    }

    /**
     * Get articlePhoto
     *
     * @return string
     */
    public function getArticlePhoto()
    {
        return $this->articlePhoto;
    }

    /**
     * Set articleFirstPrice
     *
     * @param float $articleFirstPrice
     *
     * @return Article
     */
    public function setArticleFirstPrice($articleFirstPrice)
    {
        $this->articleFirstPrice = $articleFirstPrice;

        return $this;
    }

    /**
     * Get articleFirstPrice
     *
     * @return float
     */
    public function getArticleFirstPrice()
    {
        return $this->articleFirstPrice;
    }

    /**
     * Set articleSecondPrice
     *
     * @param float $articleSecondPrice
     *
     * @return Article
     */
    public function setArticleSecondPrice($articleSecondPrice)
    {
        $this->articleSecondPrice = $articleSecondPrice;

        return $this;
    }

    /**
     * Get articleSecondPrice
     *
     * @return float
     */
    public function getArticleSecondPrice()
    {
        return $this->articleSecondPrice;
    }

    /**
     * Set catalog
     *
     * @param \CatalogProject\AppManagementBundle\Entity\Catalog $catalog
     *
     * @return Article
     */
    public function setCatalog(\CatalogProject\AppManagementBundle\Entity\Catalog $catalog = null)
    {
        $this->catalog = $catalog;

        return $this;
    }

    /**
     * Get catalog
     *
     * @return \CatalogProject\AppManagementBundle\Entity\Catalog
     */
    public function getCatalog()
    {
        return $this->catalog;
    }

    /**
     * Set articleDescription
     *
     * @param string $articleDescription
     *
     * @return Article
     */
    public function setArticleDescription($articleDescription)
    {
        $this->articleDescription = $articleDescription;

        return $this;
    }

    /**
     * Get articleDescription
     *
     * @return string
     */
    public function getArticleDescription()
    {
        return $this->articleDescription;
    }
}
