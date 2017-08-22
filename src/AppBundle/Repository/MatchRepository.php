<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Player;
use Doctrine\ORM\EntityRepository;

/**
 * Class MatchRepository
 *
 * @package AppBundle\Repository
 */
class MatchRepository extends EntityRepository
{
    /**
     * @param Player $player
     *
     * @return mixed
     */
    public function getCountMatchesWonByPlayer(Player $player)
    {
        $qb = $this->createQueryBuilder('match');

        $qb
            ->select('count(match.id)')
            ->where(
                $qb->expr()->orX(
                    $qb->expr()->andX(
                        $qb->expr()->eq('match.playerOne', ':player'),
                        $qb->expr()->gt('match.playerOnePoints', 'match.playerTwoPoints')
                    ),
                    $qb->expr()->andX(
                        $qb->expr()->eq('match.playerTwo', ':player'),
                        $qb->expr()->gt('match.playerTwoPoints', 'match.playerOnePoints')
                    )
            ))
            ->setParameter('player', $player)
            ;

        return $qb->getQuery()->getSingleScalarResult();
    }
}