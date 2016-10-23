<?php


namespace Rahi\ApiBundle\Entity\Lottery;


use Doctrine\ORM\Mapping as ORM;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\AutoIdTrait;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Lottery\NumberRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(
 *      name="number_metric",
 *      indexes={
 *          @ORM\Index(columns={"number_"})
 *      },
 *      options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
 * )
 */
class NumberMetric extends AbstractEntity
{
    use AutoIdTrait;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="number_", options={"unsigned": true})
     */
    protected $number;

    /**
     * @var LotteryType
     * @ORM\ManyToOne(targetEntity="LotteryType")
     * @ORM\JoinColumn(name="lottery_type_id", referencedColumnName="id", nullable=false)
     */
    protected $lotteryType;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", name="updated_date")
     */
    protected $updatedDate;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="total_times_won", options={"unsigned": true, "default": 0})
     */
    protected $totalTimesWon;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="times_won_last_10_draws", options={"unsigned": true, "default": 0})
     */
    protected $timesWonLast10Draws;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="times_won_last_20_draws", options={"unsigned": true, "default": 0})
     */
    protected $timesWonLast20Draws;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="times_won_last_30_draws", options={"unsigned": true, "default": 0})
     */
    protected $timesWonLast30Draws;

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     * @return NumberMetric
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return LotteryType
     */
    public function getLotteryType(): LotteryType
    {
        return $this->lotteryType;
    }

    /**
     * @param LotteryType $lotteryType
     * @return NumberMetric
     */
    public function setLotteryType(LotteryType $lotteryType)
    {
        $this->lotteryType = $lotteryType;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedDate(): \DateTime
    {
        return $this->updatedDate;
    }

    /**
     * @return NumberMetric
     * @param \DateTime $updatedDate
     */
    public function setUpdatedDate(\DateTime $updatedDate)
    {
        $this->updatedDate = $updatedDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalTimesWon(): int
    {
        return $this->totalTimesWon;
    }

    /**
     * @param int $totalTimesWon
     * @return NumberMetric
     */
    public function setTotalTimesWon(int $totalTimesWon)
    {
        $this->totalTimesWon = $totalTimesWon;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimesWonLast10Draws(): int
    {
        return $this->timesWonLast10Draws;
    }

    /**
     * @param int $timesWonLast10Draws
     * @return NumberMetric
     */
    public function setTimesWonLast10Draws(int $timesWonLast10Draws)
    {
        $this->timesWonLast10Draws = $timesWonLast10Draws;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimesWonLast20Draws(): int
    {
        return $this->timesWonLast20Draws;
    }

    /**
     * @param int $timesWonLast20Draws
     * @return NumberMetric
     */
    public function setTimesWonLast20Draws(int $timesWonLast20Draws)
    {
        $this->timesWonLast20Draws = $timesWonLast20Draws;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimesWonLast30Draws(): int
    {
        return $this->timesWonLast30Draws;
    }

    /**
     * @param int $timesWonLast30Draws
     * @return NumberMetric
     */
    public function setTimesWonLast30Draws(int $timesWonLast30Draws)
    {
        $this->timesWonLast30Draws = $timesWonLast30Draws;
        return $this;
    }
}