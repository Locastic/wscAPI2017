Task 2: Add serialization & deserialization groups
==================================================

Goal
----
Expose only following fields for Player in CRUD operations:
    `firstName`, `lastName`, `email`, `username`

Steps
-----
- Define normalization and denormalization context groups in `resources.yml` 
config for Player entity.
- Add groups for each field in Player entity using serialization group annotations

Extra credit
------------
Use different groups for different operations:
- Fields that need to be exposed for GET Player item operation:
    `firstName`, `lastName`, `email`, `username`, `lastLogin`, `roles`

Disable DELETE action for Player

More info
---------
API Platform Core allows to choose which attributes of the resource are exposed during
the normalization (read) and denormalization (write) process. It relies on the serialization
(and deserialization) groups feature of the Symfony Serializer component.

**Documentation:** 
https://api-platform.com/docs/core/serialization-groups-and-relations#using-serialization-groups
https://api-platform.com/docs/core/serialization-groups-and-relations#using-different-serialization-groups-per-operation

Solution
--------
`git checkout task2`