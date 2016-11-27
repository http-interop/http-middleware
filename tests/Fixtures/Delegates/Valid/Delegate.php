<?php

namespace Interop\Http\Middleware\Fixtures\Delegates\Valid;

use Psr\Http\Message\RequestInterface;
use Interop\Http\Middleware\DelegateInterface;

class Delegate implements DelegateInterface
{
    public function __invoke(RequestInterface $request)
    {
        return null;
    }
}
