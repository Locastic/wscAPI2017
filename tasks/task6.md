Task 6: Custom operation
========================

Goal
----
Add matchesWon number to GET single Player endpoint

Steps
-----
- Add non mapped field `matchesWon` to Player entity
- Create custom operation method for GET /players/{id}:
``` yaml
# app/config/routing.yml
get_player:
    path: /api/v1/players/{id}.{_format}
    defaults:
        _controller: AppBundle:Player:getPlayer
        _api_resource_class: AppBundle\Entity\Player
        _api_item_operation_name: get
        _format: jsonld
    methods: ['GET']
```

- Add route name to get item operation for Player: `route_name: 'get_player'`

More info
---------
- You can use `getCountMatchesWonByPlayer` repository method
- Api platform passes object received from database to the action as `$data` parameter. 
You can modify it and return it. API Platform will automatically validate, persist (if you use Doctrine) and serialize it
for you. If you prefer to do it yourself, return an instance of Symfony\Component\HttpFoundation\Response.

**Documentation:** 
https://api-platform.com/docs/core/operations#creating-custom-operations-and-controllers


Solution
--------
`git checkout task6`