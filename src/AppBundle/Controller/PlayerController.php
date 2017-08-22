<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class PlayerController
 *
 * @package AppBundle\Controller
 */
class PlayerController extends Controller
{
    /**
     * @param Player $data
     *
     * @return mixed
     */
    public function getPlayerAction($data)
    {
        $playerRepository = $this->get('app.repository.match');

        $matchesWon = $playerRepository->getCountMatchesWonByPlayer($data);

        $data->setMatchesWon($matchesWon);

        return $data;
    }
}
