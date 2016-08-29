<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 14/07/2015
 * Time: 5:20 PM
 */

namespace Rahi\ApiBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\IdTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\EmailAddressRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="email_address", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 *
 * @JMS\ExclusionPolicy("all")
 */
class EmailAddress extends AbstractEntity
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
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=3,
     *     max=255
     * )
     * @Assert\Email()
     */
    protected $email;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }
}