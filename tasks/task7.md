Task 7: Create doctrine extension
=================================

Goal
----
Create /me/matches endpoint which returns all matches current user played. 

Steps
-----
- Create collection operation in `resources.yml` for Match with path `/me/matches.{_format}`
- Create doctrine extension `AppBundle\Doctrine\ORM\Extension\MineMatchesExtension` which implements 
`ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface`
- Check operation name and resource class and add necessary conditions to query builder in extension
- Define extension as service with following tag: 
`- { name: api_platform.doctrine.orm.query_extension.collection, priority: 9 }`

More info
---------
You can get root alias from queryBuilder: `$rootAlias = $queryBuilder->getRootAliases()[0];`

**Documentation:** https://api-platform.com/docs/core/extensions


Solution
--------
`git checkout task7`