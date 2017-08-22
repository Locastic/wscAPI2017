<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class User
 *
 * @package AppBundle\Entity
 */
class Player extends BaseUser
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     *
     * @Groups({"player_read", "player_write", "match_read"})
     */
    private $firstName;

    /**
     * @var string
     *
     * @Groups({"player_read", "player_write", "match_read"})
     */
    private $lastName;

    /**
     * @var string
     *
     * @Groups({"player_read", "player_write"})
     */
    protected $email;

    /**
     * @var string
     *
     * @Groups({"player_read", "player_write"})
     */
    protected $username;

    /**
     * @var \DateTime
     *
     * @Groups({"player_extra"})
     */
    protected $lastLogin;

    /**
     * @var array
     *
     * @Groups({"player_extra"})
     */
    protected $roles;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
}