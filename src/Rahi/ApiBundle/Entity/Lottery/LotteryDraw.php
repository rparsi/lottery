<?php


namespace Rahi\ApiBundle\Entity\Lottery;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\IdTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Lottery\LotteryDrawRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(
 *      name="lottery_draw",
 *      options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
 * )
 */
class LotteryDraw extends AbstractEntity
{
    use IdTrait;

    /**
     * @var LotteryType
     * @ORM\ManyToOne(targetEntity="LotteryType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    protected $type;

    /**
     * @var
     * @ORM\Column(type="datetime", name="draw_date")
     */
    protected $drawDate;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Payout", mappedBy="lotteryDraw", indexBy="id", cascade={"persist", "remove"})
     */
    protected $payouts;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Number", indexBy="id", cascade={"persist"})
     * @ORM\JoinTable(name="lottery_draw_winning_numbers",
     *      joinColumns={@ORM\JoinColumn(name="lottery_draw_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="number_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $winningNumbers;

    public function __construct()
    {
        $this->winningNumbers = new ArrayCollection();
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType(LotteryType $type)
    {
        $this->type = $type;
        return $this;
    }

    public function getDrawDate()
    {
        return $this->drawDate;
    }

    public function setDrawDate(\DateTime $drawDate)
    {
        $this->drawDate = $drawDate;
        return $this;
    }

    public function getPayouts()
    {
        return $this->payouts;
    }

    public function setPayouts(Collection $payouts)
    {
        $this->payouts = $payouts;
        return $this;
    }

    public function addPayout(Payout $payout)
    {
        $payout->setLotteryDraw($this);
        $this->payouts[] = $payout;
        return $this;
    }

    public function removePayout(Payout $payout)
    {
        $this->payouts->removeElement($payout);
        return $this;
    }

    public function getWinningNumbers()
    {
        return $this->winningNumbers;
    }

    public function setWinningNumbers(Collection $winningNumbers)
    {
        $this->winningNumbers = $winningNumbers;
        return $this;
    }

    public function addWinningNumber(Number $number)
    {
        $this->winningNumbers[] = $number;
        return $this;
    }

    public function removeWinningNumber(Number $number)
    {
        $this->winningNumbers->removeElement($number);
        return $this;
    }
}