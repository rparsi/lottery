<?php

namespace Rahi\ApiBundle\Service\Security;


use Rahi\ApiBundle\Entity\Account\User;
use Symfony\Component\Routing\RouterInterface;


class RouteBuilder
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param User $user
     * @return RouteDTO[]
     */
    public function fetchAvailableRoutes(User $user = null)
    {
        // no user
        $routes = [
            'fos_user_security_login' => 'Login',
            'fos_user_registration_register' => 'Register',
            'fos_user_resetting_request' => 'Reset Password'
        ];

        if ($user) {
            $routes = [
                'fos_user_security_logout' => 'Logout',
                'fos_user_profile_show' => 'Profile',
                'fos_user_change_password' => 'Change Password',
                'api_console' => 'API Console'
            ];
        }

        $urls = [];
        foreach ($routes as $route => $text) {
            $urls[] = new RouteDTO(
                $this->router->generate($route, [], RouterInterface::RELATIVE_PATH),
                $text
            );
        }
        return $urls;
    }
}