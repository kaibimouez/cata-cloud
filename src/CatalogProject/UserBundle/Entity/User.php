<?php


namespace CatalogProject\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
    */
    public $type;
    /**
     * @ORM\Column(type="string")
    */
    public $creationDate;

    /**
     * @ORM\Column(type="string",nullable=true)
    */
    public $companyPhone;
    /**
     * @ORM\Column(type="string",nullable=true)
    */
    public $companyAdress;

    /**
     * @ORM\Column(type="string",nullable=true)
    */
    public $profilePicture;


    /**
     * @ORM\OneToMany(targetEntity="CatalogProject\AppManagementBundle\Entity\Catalog", mappedBy="user")
    */
    private $catalogs;

    

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

   

    /**
     * Set type
     *
     * @param string $type
     *
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set creationDate
     *
     * @param string $creationDate
     *
     * @return User
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
     * Set companyPhone
     *
     * @param string $companyPhone
     *
     * @return User
     */
    public function setCompanyPhone($companyPhone)
    {
        $this->companyPhone = $companyPhone;

        return $this;
    }

    /**
     * Get companyPhone
     *
     * @return string
     */
    public function getCompanyPhone()
    {
        return $this->companyPhone;
    }

    /**
     * Set companyAdress
     *
     * @param string $companyAdress
     *
     * @return User
     */
    public function setCompanyAdress($companyAdress)
    {
        $this->companyAdress = $companyAdress;

        return $this;
    }

    /**
     * Get companyAdress
     *
     * @return string
     */
    public function getCompanyAdress()
    {
        return $this->companyAdress;
    }

    /**
     * Set profilePicture
     *
     * @param string $profilePicture
     *
     * @return User
     */
    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    /**
     * Get profilePicture
     *
     * @return string
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * Add catalog
     *
     * @param \CatalogProject\AppManagementBundle\Entity\Catalog $catalog
     *
     * @return User
     */
    public function addCatalog(\CatalogProject\AppManagementBundle\Entity\Catalog $catalog)
    {
        $this->catalogs[] = $catalog;

        return $this;
    }

    /**
     * Remove catalog
     *
     * @param \CatalogProject\AppManagementBundle\Entity\Catalog $catalog
     */
    public function removeCatalog(\CatalogProject\AppManagementBundle\Entity\Catalog $catalog)
    {
        $this->catalogs->removeElement($catalog);
    }

    /**
     * Get catalogs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCatalogs()
    {
        return $this->catalogs;
    }
}
