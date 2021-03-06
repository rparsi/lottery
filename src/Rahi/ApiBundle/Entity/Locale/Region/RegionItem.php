<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 15/07/2015
 * Time: 5:33 PM
 */

namespace Rahi\ApiBundle\Entity\Locale\Region;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\AutoIdTrait;
use Rahi\ApiBundle\Entity\Locale\Country;
use Rahi\ApiBundle\Entity\Locale\Province;
use Rahi\ApiBundle\Entity\Locale\City;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Locale\Region\RegionItemRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="region_item", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 *
 * @JMS\ExclusionPolicy("all")
 */
class RegionItem extends AbstractEntity
{
    use AutoIdTrait;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, name="name_", unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=3,
     *     max=100
     * )
     */
    protected $name;

    /**
     * @var Region
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="items")
     * @ORM\JoinColumn(name="parent_region_id", referencedColumnName="id", nullable=false)
     */
    protected $parentRegion;

    /**
     * @var RegionItemType
     * @ORM\ManyToOne(targetEntity="RegionItemType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    protected $type;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Locale\Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=true)
     */
    protected $country;

    /**
     * @var Province
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Locale\Province")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id", nullable=true)
     */
    protected $province;

    /**
     * @var City
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Locale\City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=true)
     */
    protected $city;

    /**
     * @var Region
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id", nullable=true)
     */
    protected $region;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default": true})
     * @Assert\Type(
     *     type="bool"
     * )
     */
    protected $inheritsChildren;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function setParentRegion(Region $parentRegion)
    {
        $this->parentRegion = $parentRegion;
        return $this;
    }

    public function setType(RegionItemType $type)
    {
        $this->type = $type;
        return $this;
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
        return $this;
    }

    public function setProvince(Province $province)
    {
        $this->province = $province;
        return $this;
    }

    public function setCity(City $city)
    {
        $this->city = $city;
        return $this;
    }

    public function setRegion(Region $region)
    {
        $this->region = $region;
        return $this;
    }

    public function getInheritsChildren()
    {
        return $this->inheritsChildren;
    }

    /**
     * @param boolean $inheritsChildren
     * @return RegionItem
     */
    public function setInheritsChildren($inheritsChildren)
    {
        $this->inheritsChildren = (bool)$inheritsChildren;
        return $this;
    }
}