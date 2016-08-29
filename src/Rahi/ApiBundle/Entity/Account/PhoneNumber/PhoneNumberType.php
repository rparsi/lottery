<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 14/07/2015
 * Time: 5:20 PM
 */

namespace Rahi\ApiBundle\Entity\Account\PhoneNumber;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\TypeTrait;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\PhoneNumber\PhoneNumberTypeRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(
 *      name="phone_number_type",
 *      options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
 * )
 *
 * @JMS\ExclusionPolicy("all")
 */
class PhoneNumberType extends AbstractEntity
{
    use TypeTrait;
}