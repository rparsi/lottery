<?php

namespace AppBundle\Controller;

use Rahi\ApiBundle\Entity\Account\Company\CompanyType;
use Rahi\ApiBundle\Service\Security\RouteBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

class DefaultController extends AbstractAppController
{
    /**
     * @Route("/", name="home")
     */
    public function homeAction(Request $request)
    {
        $mailerSettings = [
            'mailer_transport' => $this->getParameter('mailer_transport'),
            'mailer_host' => $this->getParameter('mailer_host'),
            'mailer_port' => $this->getParameter('mailer_port'),
            'mailer_user' => $this->getParameter('mailer_user'),
            'mailer_password' => $this->getParameter('mailer_password')
        ];
        return $this->render('default/home.html.twig', ['user' => $this->getLoggedInUser(), 'mailerSettings' => $mailerSettings]);
    }

    /**
     * @Route("/home2", name="home_two")
     * @param Request $request
     * @return Response
     */
    public function home2Action(Request $request)
    {
        $user = $this->getLoggedInUser();
        $mailerSettings = [
            'mailer_transport' => $this->getParameter('mailer_transport'),
            'mailer_host' => $this->getParameter('mailer_host'),
            'mailer_port' => $this->getParameter('mailer_port'),
            'mailer_user' => $this->getParameter('mailer_user'),
            'mailer_password' => $this->getParameter('mailer_password')
        ];
        $dropDownMenu = [
            $this->generateUrl('jsontest', [], UrlGenerator::RELATIVE_PATH),
            $this->generateUrl('emailtest', [], UrlGenerator::RELATIVE_PATH),
            $this->generateUrl('datatest', [], UrlGenerator::RELATIVE_PATH)
        ];

        /** @var RouteBuilder $routeBuilder */
        $routeBuilder = $this->get('api.security.routebuilder');
        $view = [
            'user' => null,
            'mailerSettings' => $mailerSettings,
            'menu' => $routeBuilder->fetchAvailableRoutes($user),
            'dropDownMenu' => $dropDownMenu
        ];

        if ($user) {
            $view['user'] = [
                'id' => $user->getId(),
                'username' => $user->getUsername()
            ];
        }

        return $this->render('default/home2.html.twig', $view);
    }

    /**
     * @Route("/jsontest", name="jsontest")
     * @param Request $request
     * @return Response
     */
    public function jsonTestAction(Request $request)
    {
        $data = ['foobar' => true, 'version' => 1];
        return $this->createJsonResponse($data);
    }

    /**
     * @Route("/emailtest", name="emailtest")
     * @param Request $request
     * @return Response
     */
    public function emailTestAction(Request $request)
    {
        $emailData = [
            'subject' => 'Email test',
            'from' => 'send@example.com',
            'to' => 'recipient@example.com'
        ];

        $htmlBody = $this->renderView('default/email/test.html.twig', ['emailData' => $emailData]);
        $textBody = $this->renderView('default/email/test.text.twig', ['emailData' => $emailData]);

        $message = \Swift_Message::newInstance()
            ->setSubject($emailData['subject'])
            ->setFrom($emailData['from'])
            ->setTo($emailData['to'])
            ->setBody($htmlBody, 'text/html')
            ->addPart($textBody, 'text/plain');

        // Create the Transport
        $customTransport = \Swift_SmtpTransport::newInstance($this->getParameter('mailer_host'), $this->getParameter('mailer_port'))
            ->setUsername(null)
            ->setPassword(null);

        $mailer = \Swift_Mailer::newInstance($customTransport);
        $numEmailsSent = $mailer->send($message);
        return $this->render('default/emailtest.html.twig', ['user' => null, 'email' => $emailData, 'numEmailsSent' => $numEmailsSent]);
    }

    /**
     * @Route("/datatest", name="datatest")
     * @param Request $request
     * @return JsonResponse
     */
    public function dataTestAction(Request $request)
    {
        $em = $this->getEntityManager();
        $repository = $em->getRepository('RahiApiBundle:Account\Company\CompanyType');
        $companyTypes = $repository->findAll();

        $data = [];
        /** @var CompanyType $companyType */
        foreach ($companyTypes as $companyType) {
            $item = [
                'id' => $companyType->getId(),
                'name' => $companyType->getName(),
                'slug' => $companyType->getSlug()
            ];
            $data[] = $item;
        }
        return $this->json($data);
    }

    /**
     * @param Request $request
     * @Route("/frontendtest", name="frontendtest")
     * @return Response
     */
    public function frontendTestAction(Request $request)
    {
        return $this->render('default/frontendtest.html.twig', ['user' => $this->getLoggedInUser()]);
    }
}
