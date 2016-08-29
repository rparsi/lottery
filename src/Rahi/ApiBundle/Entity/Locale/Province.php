<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 15/07/2015
 * Time: 11:26 AM
 */

namespace Rahi\ApiBundle\Entity\Locale;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\IdTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Locale\ProvinceRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="province", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 *
 * @JMS\ExclusionPolicy("all")
 */
class Province extends AbstractEntity
{
    use IdTrait;

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
     * For example refer to https://en.wikipedia.org/wiki/ISO_3166-2:CA
     * @var string
     * @ORM\Column(type="string", length=10, name="iso_code")
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=1,
     *     max=10
     * )
     */
    protected $isoCode;

    /**
     * The subdivision category, ie 'province' or 'territory' for Canada
     * @var string
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=1,
     *     max=30
     * )
     */
    protected $category;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="provinces")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     */
    protected $country;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="City", mappedBy="province", indexBy="id")
     */
    protected $cities;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
        return $this;
    }

    public function addCity(City $city)
    {
        $city->province = $this;
        $this->cities[] = $city;
        return $this;
    }

    public function setCities(Collection $cities)
    {
        $this->cities = $cities;
        return $this;
    }
}