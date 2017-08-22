Task 8: Add some filters
========================

Goal
----
Add partial search filters to Player for firstName and lastName
Add exact search filter to Player for email
Add order filter to Player for firstName, lastName and email
Add date filter to Match for datetime

Steps
-----
- For each filter create service and add it to attributes in resource.
Example:

``` yaml
# services.yml
services:
    player.search_filter:
        parent:    'api_platform.doctrine.orm.search_filter'
        arguments: [ { firstName: 'partial' } ]
        tags:      [ { name: 'api_platform.filter', id: 'player.search' } ]
```

``` yaml
# resources.yml
    resources:
        AppBundle\Entity\Player:
            attributes:
                filters: ['player.search']
```

More info
---------
Services for filters:
- search filter: 'api_platform.doctrine.orm.search_filter'
- order filter: 'api_platform.doctrine.orm.order_filter'
- date filter: 'api_platform.doctrine.orm.date_filter'

**Documentation:** https://api-platform.com/docs/core/filters


Solution
--------
`git checkout task8`