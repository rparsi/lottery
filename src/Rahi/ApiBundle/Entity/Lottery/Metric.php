<?php


namespace Rahi\ApiBundle\Entity\Lottery;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\IdTrait;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Lottery\MetricRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(
 *      name="metric",
 *      options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
 * )
 */
class Metric extends AbstractEntity
{
    use IdTrait;

    /**
     * @var LotteryType
     * @ORM\ManyToOne(targetEntity="LotteryType", cascade={"persist"})
     * @ORM\JoinColumn(name="lottery_type_id", referencedColumnName="id", nullable=false)
     */
    protected $lotteryType;

    /**
     * @var MetricType
     * @ORM\ManyToOne(targetEntity="MetricType", cascade={"persist"})
     * @ORM\JoinColumn(name="metric_type_id", referencedColumnName="id", nullable=false)
     */
    protected $metricType;

    /**
     * @var Number
     * @ORM\ManyToOne(targetEntity="Number", cascade={"persist"})
     * @ORM\JoinColumn(name="number_id", referencedColumnName="id", nullable=false)
     */
    protected $number;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="int_value", options={"unsigned": true})
     * @Assert\Type(
     *     type="integer"
     * )
     */
    protected $intValue;

    public function getLotteryType()
    {
        return $this->lotteryType;
    }

    public function setLotteryType(LotteryType $lotteryType)
    {
        $this->lotteryType = $lotteryType;
        return $this;
    }

    public function getMetricType()
    {
        return $this->metricType;
    }

    public function setMetricType(MetricType $metricType)
    {
        $this->metricType = $metricType;
        return $this;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber(Number $number)
    {
        $this->number = $number;
        return $this;
    }

    public function getIntValue()
    {
        return $this->intValue;
    }

    public function setIntValue(int $intValue)
    {
        $this->intValue = $intValue;
        return $this;
    }
}