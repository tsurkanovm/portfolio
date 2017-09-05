<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Tsum\RequestRegistrarBundle\Manager\RequestApiManager;

/**
 * @Route("requests")
 */
class IncomingRequestController extends BaseAdminController
{
    /**
     * @Route("/", name="admin_incoming_request_list")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        /* @var RequestApiManager */
        $requestManager = $this->get('tsum_request_registrar.manager.request_api_manager');

        return $this->render(':admin/incoming_request:index.html.twig', [
            'requests' => $requestManager->getRequests([]),
        ]);
    }
}
