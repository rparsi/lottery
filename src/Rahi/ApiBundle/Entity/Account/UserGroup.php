<?php


namespace Rahi\ApiBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\TypeTrait;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\UserGroupRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(
 *      name="usergroup",
 *      indexes={
 *          @ORM\Index(columns={"can_read_lottery"}),
 *          @ORM\Index(columns={"can_add_lottery"}),
 *          @ORM\Index(columns={"can_edit_lottery"}),
 *          @ORM\Index(columns={"can_delete_lottery"})
 *      },
 *      options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
 * )
 */
class UserGroup extends AbstractEntity
{
    use TypeTrait;

    const SLUG_ADMIN = 'admin';
    const SLUG_STANDARD = 'standard';

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

    // flags indicating what users of this group can do with lottery data

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="can_read_lottery", options={"default": true})
     * @Assert\Type(
     *     type="bool"
     * )
     */
    protected $canReadLottery;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="can_add_lottery", options={"default": false})
     * @Assert\Type(
     *     type="bool"
     * )
     */
    protected $canAddLottery;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="can_edit_lottery", options={"default": false})
     * @Assert\Type(
     *     type="bool"
     * )
     */
    protected $canEditLottery;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="can_delete_lottery", options={"default": false})
     * @Assert\Type(
     *     type="bool"
     * )
     */
    protected $canDeleteLottery;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return UserGroup
     */
    public function setDescription(string $description): UserGroup
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCanReadLottery(): bool
    {
        return $this->canReadLottery;
    }

    /**
     * @param bool $canReadLottery
     * @return UserGroup
     */
    public function setCanReadLottery(bool $canReadLottery): UserGroup
    {
        $this->canReadLottery = $canReadLottery;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCanAddLottery(): bool
    {
        return $this->canAddLottery;
    }

    /**
     * @param bool $canAddLottery
     * @return UserGroup
     */
    public function setCanAddLottery(bool $canAddLottery): UserGroup
    {
        $this->canAddLottery = $canAddLottery;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCanEditLottery(): bool
    {
        return $this->canEditLottery;
    }

    /**
     * @param bool $canEditLottery
     * @return UserGroup
     */
    public function setCanEditLottery(bool $canEditLottery): UserGroup
    {
        $this->canEditLottery = $canEditLottery;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCanDeleteLottery(): bool
    {
        return $this->canDeleteLottery;
    }

    /**
     * @param bool $canDeleteLottery
     * @return UserGroup
     */
    public function setCanDeleteLottery(bool $canDeleteLottery): UserGroup
    {
        $this->canDeleteLottery = $canDeleteLottery;
        return $this;
    }
}