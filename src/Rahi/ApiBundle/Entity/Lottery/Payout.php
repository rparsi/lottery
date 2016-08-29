<?php


namespace Rahi\ApiBundle\Entity\Lottery;


use Doctrine\ORM\Mapping as ORM;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\IdTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Lottery\PayoutRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(
 *      name="payout",
 *      options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
 * )
 */
class Payout extends AbstractEntity
{
    use IdTrait;

    /**
     * @var LotteryDraw
     * @ORM\ManyToOne(targetEntity="LotteryDraw", inversedBy="payouts")
     * @ORM\JoinColumn(name="lottery_draw_id", referencedColumnName="id", nullable=false)
     */
    protected $lotteryDraw;

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
     * @var float
     * @ORM\Column(type="decimal", name="value_", precision=11, scale=2, options={"unsigned": true})
     * @Assert\Type(
     *     type="float"
     * )
     * @Assert\GreaterThan(
     *     value = 0
     * )
     */
    protected $value;

    public function getLotteryDraw()
    {
        return $this->lotteryDraw;
    }

    public function setLotteryDraw(LotteryDraw $lotteryDraw)
    {
        $this->lotteryDraw = $lotteryDraw;
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

    public function getValue()
    {
        return $this->value;
    }

    public function setValue(float $value)
    {
        $this->value = $value;
        return $this;
    }
}