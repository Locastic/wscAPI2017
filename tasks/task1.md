Task 1: Create your first CRUD
=============================

Goal
----
Create CRUD api endpoints for Player entity.

Steps
-----
- Import Player fixtures with following command: `bin/console fixtures:load --no-interaction`
- Create `resources.yml` file in `AppBundle/Resources/config/api_resources`
- Add Player entity to resources
- Open http://phpapi.websc/app_dev.php/api/v1/doc in your browser and test endpoints in sandbox

Extra credit
------------
- Use http://schema.org/Person for Player resource.

More info
---------
You can also use xml or annotations for defining resources.

**Documentation:** https://api-platform.com/docs/core/getting-started#mapping-the-entities

Solution
--------
`git checkout task1`