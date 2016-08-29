<?php


namespace Rahi\ApiBundle\Entity\Lottery;


use Doctrine\ORM\Mapping as ORM;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\TypeTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Lottery\LotteryTypeRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(
 *      name="lottery_type",
 *      options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
 * )
 */
class LotteryType extends AbstractEntity
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

    /**
     * @var integer
     * @ORM\Column(type="integer", name="number_of_picks", options={"unsigned": true})
     * @Assert\Type(
     *     type="integer"
     * )
     * @Assert\GreaterThan(
     *     value = 0
     * )
     */
    protected $numberOfPicks;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="min_pick_value", options={"unsigned": true})
     * @Assert\Type(
     *     type="integer"
     * )
     * @Assert\GreaterThan(
     *     value = 0
     * )
     */
    protected $minPickValue;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="max_pick_value", options={"unsigned": true})
     * @Assert\Type(
     *     type="integer"
     * )
     * @Assert\GreaterThan(
     *     value = 0
     * )
     */
    protected $maxPickValue;

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function getNumberOfPicks()
    {
        return $this->numberOfPicks;
    }

    public function setNumberOfPicks(int $numberOfPicks)
    {
        $this->numberOfPicks = $numberOfPicks;
        return $this;
    }

    public function getMinPickValue()
    {
        return $this->minPickValue;
    }

    public function setMinPickValue(int $minPickValue)
    {
        $this->minPickValue = $minPickValue;
        return $this;
    }

    public function getMaxPickValue()
    {
        return $this->maxPickValue;
    }

    public function setMaxPickValue(int $maxPickValue)
    {
        $this->maxPickValue = $maxPickValue;
        return $this;
    }
}