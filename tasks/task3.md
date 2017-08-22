Task 3: Implement login with JSON Web Token (JWT)
=================================================

Goal
----
Implement user login using LexikJWTAuthenticationBundle.
Lock Payer routes for anonymous users.

*NOTE* LexikJWTAuthenticationBundle and JWTRefreshTokenBundle 
       are already installed and added to composer.
      
Steps
-----
- Enable LexikJWTAuthenticationBundle in AppKernel
- Generate the SSH keys :
``` bash
$ mkdir -p var/jwt # For Symfony3+, no need of the -p option
$ openssl genrsa -out var/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem
```

- Configure the SSH keys path in your `config.yml` :  
``` yaml
lexik_jwt_authentication:
    private_key_path: '%jwt_private_key_path%'
    public_key_path:  '%jwt_public_key_path%'
    pass_phrase:      '%jwt_key_pass_phrase%'
    token_ttl:        '%jwt_token_ttl%'
```

- Configure your `parameters.yml` :
``` yaml
jwt_private_key_path: '%kernel.root_dir%/../var/jwt/private.pem' # ssh private key path
jwt_public_key_path:  '%kernel.root_dir%/../var/jwt/public.pem'  # ssh public key path
jwt_key_pass_phrase:  ''                                         # ssh key pass phrase
jwt_token_ttl:        3600
```

- Configure your `security.yml` :

``` yaml
security:
# ...

firewalls:
    login:
        pattern:  ^/api/v1/login
        stateless: true
        anonymous: true
        form_login:
            check_path:               /api/v1/login-check
            username_parameter:       username
            password_parameter:       password
            success_handler:          lexik_jwt_authentication.handler.authentication_success
            failure_handler:          lexik_jwt_authentication.handler.authentication_failure
            require_previous_session: false

    api:
        pattern:   ^/api/v1
        provider: fos_userbundle
        stateless: true
        anonymous: true
        guard:
            authenticators:
                - lexik_jwt_authentication.jwt_token_authenticator

access_control:
    - { path: ^/api/v1/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
    - { path: ^/api/v1/doc, roles: IS_AUTHENTICATED_ANONYMOUSLY }
    - { path: ^/api/v1/players,       roles: IS_AUTHENTICATED_FULLY }
```

- Configure your `routing.yml` :

``` yaml
api_login_check:
    path: /api/v1/login-check
    defaults:
        _controller: AppBundle:Authentication:loginCheck
    methods: ['POST']
```

- Since login is not ApiPlatform resource, it won't be added automatically to documentation.
Add login_check route to Nelmio Api documentation using annotations:

``` php
// AppBundle/Controller/AuthenticationController

class AuthenticationController extends Controller
{
    /**
     * Auth with username and password.
     * NOTE: Use Form Data body format
     *
     * @ApiDoc(
     *      description="Auth with username and password.",
     *      section="Authentication",
     *      statusCodes={
     *          200="Returning accessToken when Authentication successful",
     *          401="Returned when invalid credentials",
     *      },
     *      parameters={
     *          {"name"="username", "dataType"="formData", "required"="true", "description"="Username"},
     *          {"name"="password", "dataType"="formData", "required"="true", "description"="Plain password"}
     *      }
     *     )
     */
    public function loginCheckAction()
    {
//        Won't be called, it's handled by firewall
    }
```


- Try to login with test user imported from fixtures:
- 
```
username: 'test@pingpong.dev'
password: 'password'
```

Extra credit
------------
Implement JSON Refresh Token using JWTRefreshTokenBundle

**Steps:**
- Enable JWTRefreshTokenBundle in AppKernel
- Configure your own routing to refresh token:
``` yaml
# app/config/routing.yml
gesdinet_jwt_refresh_token:
    path:     /api/v1/token/refresh
    defaults:
        _controller: AppBundle:Authentication:refreshToken
    methods: ['POST']
# ...
```

- Add RefreshTokenAction and ApiDoc block:

``` php
// AppBundle/Controller/AuthenticationController
// ...

    /**
     * Refresh Authentication token with Refresh token.
     * NOTE: Use Form Data body format
     *
     * @ApiDoc(
     *      description="Refresh Authentication token with Refresh token.",
     *      section="Authentication",
     *      statusCodes={
     *          200="Returning accessToken and refreshToken when Authentication successful",
     *          401="Returned when invalid credentials",
     *      },
     *      parameters={
     *          {"name"="refresh_token", "dataType"="formData", "required"="true", "description"="Refresh Token"},
     *      }
     *     )
     * @param Request $request
     * @return mixed
     */
    public function refreshTokenAction(Request $request)
    {
        return $this->get('gesdinet.jwtrefreshtoken')->refresh($request);
    }
    
// ...

``` 

- Allow anonymous access to refresh token

``` yaml
# app/config/security.yml
    firewalls:
        refresh:
            pattern:  ^/api/v1/token/refresh
            stateless: true
            anonymous: true
    # ...

    access_control:
        # ...
        - { path: ^/api/v1/token/refresh, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        # ...
# ...
```
- Config TTL and firewall name

``` yaml
  gesdinet_jwt_refresh_token:
      ttl: 2592000
      firewall: api
```

- Update your database schema
- Try to refresh your token

More info
---------

**Documentation:** 

- https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#installation
- https://github.com/gesdinet/JWTRefreshTokenBundle
- https://symfony.com/doc/current/bundles/NelmioApiDocBundle/the-apidoc-annotation.html


Solution
--------
`git checkout task3`