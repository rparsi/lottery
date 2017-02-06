<?php

namespace AppBundle\Controller;

use Rahi\ApiBundle\Entity\Account\Company\CompanyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractAppController
{
    /**
     * @Route("/api/console", name="api_console")
     * @return Response
     */
    public function consoleAction()
    {
        $data = [
            'user' => $this->getLoggedInUser()
        ];
        return $this->render('default/console.html.twig', $data);
    }
}
