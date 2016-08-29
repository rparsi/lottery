<?php


namespace Rahi\ApiBundle\Entity\Lottery;


use Doctrine\ORM\Mapping as ORM;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\TypeTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Lottery\MetricTypeRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(
 *      name="metric_type",
 *      options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
 * )
 */
class MetricType extends AbstractEntity
{
    use TypeTrait;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="description_")
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=3,
     *     max=255
     * )
     */
    protected $description;

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }
}