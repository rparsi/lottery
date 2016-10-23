<?php


namespace Rahi\ApiBundle\Entity\Lottery;


use Doctrine\ORM\Mapping as ORM;
use Rahi\ApiBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Lottery\WinningNumberRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(
 *      name="winning_number",
 *      indexes={
 *          @ORM\Index(columns={"number_"})
 *      },
 *      options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
 * )
 */
class WinningNumber extends AbstractEntity
{
    /**
     * @var integer
     * @ORM\Column(type="integer", name="lottery_draw_id", options={"unsigned": true})
     * @ORM\Id
     */
    protected $lotteryDrawId;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="number_", options={"unsigned": true})
     * @ORM\Id
     */
    protected $number;

    /**
     * @var LotteryDraw
     * @ORM\ManyToOne(targetEntity="LotteryDraw", inversedBy="winningNumbers")
     * @ORM\JoinColumn(name="lottery_draw_id", referencedColumnName="id", nullable=false)
     */
    protected $lotteryDraw;

    /**
     * @return int
     */
    public function getLotteryDrawId()
    {
        return $this->lotteryDrawId;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return WinningNumber
     */
    public function setNumber(int $number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return LotteryDraw
     */
    public function getLotteryDraw()
    {
        return $this->lotteryDraw;
    }

    /**
     * @param LotteryDraw $lotteryDraw
     * @return WinningNumber
     */
    public function setLotteryDraw(LotteryDraw $lotteryDraw)
    {
        $this->lotteryDraw = $lotteryDraw;
        return $this;
    }
}