<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Invalid;

use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Middleware\DelegateInterface;

class PureInvokableWithDelegate
{
    public function __invoke(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return $delegate($request);
    }
}
