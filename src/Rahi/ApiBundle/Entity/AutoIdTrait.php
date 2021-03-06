<?php
/**
 * Created by PhpStorm.
 * User: rparsi
 * Date: 23/04/2016
 * Time: 3:42 PM
 */

namespace Rahi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

trait AutoIdTrait
{
    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}