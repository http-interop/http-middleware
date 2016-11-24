<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Invalid;

use Psr\Http\Message\ServerRequestInterface;

class PureInvokableWithoutDelegate
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(ServerRequestInterface $request)
    {
        return null;
    }
}
