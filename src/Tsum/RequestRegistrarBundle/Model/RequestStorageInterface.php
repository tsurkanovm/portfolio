<?php

namespace Tsum\RequestRegistrarBundle\Model;

use Symfony\Component\HttpFoundation\Request;

interface RequestStorageInterface
{
    public function saveRequest(Request $request);
}
