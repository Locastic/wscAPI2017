<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Player;

/**
 * Match
 */
class Match
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $datetime;

    /**
     * @var integer
     */
    private $playerOnePoints;

    /**
     * @var integer
     */
    private $playerTwoPoints;

    /**
     * @var Player
     */
    private $playerOne;

    /**
     * @var Player
     */
    private $playerTwo;

    /**
     * @var Player
     */
    private $winner;

    /**
     * Match constructor.
     */
    public function __construct()
    {
        $this->datetime = new \DateTime();
    }


    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Match
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set playerOnePoints
     *
     * @param integer $playerOnePoints
     *
     * @return Match
     */
    public function setPlayerOnePoints($playerOnePoints)
    {
        $this->playerOnePoints = $playerOnePoints;

        return $this;
    }

    /**
     * Get playerOnePoints
     *
     * @return integer
     */
    public function getPlayerOnePoints()
    {
        return $this->playerOnePoints;
    }

    /**
     * Set playerTwoPoints
     *
     * @param integer $playerTwoPoints
     *
     * @return Match
     */
    public function setPlayerTwoPoints($playerTwoPoints)
    {
        $this->playerTwoPoints = $playerTwoPoints;

        return $this;
    }

    /**
     * Get playerTwoPoints
     *
     * @return integer
     */
    public function getPlayerTwoPoints()
    {
        return $this->playerTwoPoints;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set playerOne
     *
     * @param Player $playerOne
     *
     * @return Match
     */
    public function setPlayerOne(Player $playerOne)
    {
        $this->playerOne = $playerOne;

        return $this;
    }

    /**
     * Get playerOne
     *
     * @return Player
     */
    public function getPlayerOne()
    {
        return $this->playerOne;
    }

    /**
     * Set playerTwo
     *
     * @param Player $playerTwo
     *
     * @return Match
     */
    public function setPlayerTwo(Player $playerTwo)
    {
        $this->playerTwo = $playerTwo;

        return $this;
    }

    /**
     * Get playerTwo
     *
     * @return Player
     */
    public function getPlayerTwo()
    {
        return $this->playerTwo;
    }

    /**
     * Set winner
     *
     * @param Player $winner
     *
     * @return Match
     */
    public function setWinner(Player $winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return Player
     */
    public function getWinner()
    {
        if($this->playerOnePoints >$this->playerTwoPoints) {
            return $this->playerOne;
        }

        return $this->playerTwo;
    }
}

