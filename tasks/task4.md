Task 4: Create event subscriber for posting new Player
====================================================

Goal
----
Create event subscriber for POST /players endpoint which will generate password
and send an email with login info to new user.

Steps
-----
- Create event subscriber for PRE_WRITE and POST_WRITE events:
``` php
/**
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                'postPlayerPreWrite', EventPriorities::PRE_WRITE,
                'postPlayerPostWrite', EventPriorities::POST_WRITE
            ],
        ];
    }
```

- Ensure method is POST and object is type of Player before implementing logic in event
- Generate user password and activate it in PRE_WRITE event
- Send registration email in POST_WRITE event

Extra credit
------------
Allow only users with ROLE_ADMIN to use this endpoint

You can use Symfony’s access control expressions in resource configuration with key:
`access_control`

More info
---------
- Event subscriber is auto wired, so there is no need to define it as service.
- Check `AppBundle/Handler/UserHandler` and use its methods in subscriber
- ApiPlatform event methods have 
 `Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent` object as argument. 
 This class has method `getControllerResult` which returns current object (in this case Player object)

**Documentation:**
- https://api-platform.com/docs/core/events
- https://symfony.com/doc/current/expressions.html#security-complex-access-controls-with-expressions


Solution
--------
`git checkout task4`