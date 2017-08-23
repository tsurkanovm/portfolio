<?php

namespace Tsum\RequestRegistrarBundle\Manager;

use Symfony\Component\HttpFoundation\Request;

interface RequestStorageManagerInterface
{
    /**
     * @param Request $request
     * @return void
     */
    public function registerRequest(Request $request);
}
