Task 5: Create CRUD for Match
=============================

Goal
----
Create POST and GET api endpoints for Match. 
Try to call POST match endpoint in sandbox.

Steps
-----
- Add Match to resources.yml and set normalization and denormalization groups
- Add Player First and Last name to GET /matches response
- Try to call POST match endpoint in sandbox

Extra credit
------------
- Change items per page number and enable items per page parameter in config.yml:
``` yaml
api_platform:
    collection:
        pagination:
            items_per_page: 30 # Default value
            client_items_per_page: true # Disabled by default
            items_per_page_parameter_name: itemsPerPage # Default value
```
- Test it on GET /matches endpoint

More info
---------
- Make sure you use IRI for player relation in POST matches

**Documentation:**
- https://api-platform.com/docs/core/pagination


Solution
--------
`git checkout task5`