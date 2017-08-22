<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthenticationController
 *
 * @package AppBundle\Controller
 */
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
}
