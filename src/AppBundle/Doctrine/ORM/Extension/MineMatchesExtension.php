<?php

namespace AppBundle\Doctrine\ORM\Extension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use AppBundle\Entity\Match;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Class MineMatchesExtension
 *
 * @package AppBundle\Doctrine\ORM\Extension
 */
class MineMatchesExtension implements QueryCollectionExtensionInterface
{
    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * MineMatchesExtension constructor.
     *
     * @param TokenStorage $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $operationName = null)
    {
        if ($resourceClass != Match::class || $operationName != 'get_mine') {
            return;
        }

        $user = $this->tokenStorage->getToken()->getUser();
        $rootAlias = $queryBuilder->getRootAliases()[0];

        $queryBuilder->andWhere(
            $queryBuilder->expr()->orX(
                $queryBuilder->expr()->eq($rootAlias.'.playerOne', ':player'),
                $queryBuilder->expr()->eq($rootAlias.'.playerTwo', ':player')
            )
        )->setParameter('player', $user);
    }
}
