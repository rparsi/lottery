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
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Locale\CityRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="city", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 *
 * @JMS\ExclusionPolicy("all")
 */
class City extends AbstractEntity
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
     * The subdivision category, ie 'town', 'municipality', etc
     * Currently no ISO standards that I know of, and may need to create entity (ie CityType)
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
     * @var Province
     * @ORM\ManyToOne(targetEntity="Province", inversedBy="cities")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id", nullable=false)
     */
    protected $province;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
        return $this;
    }

    public function setProvince(Province $province)
    {
        $this->province = $province;
        return $this;
    }
}