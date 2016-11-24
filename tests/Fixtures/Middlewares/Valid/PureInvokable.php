<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Valid;

use Psr\Http\Message\ServerRequestInterface;

class PureInvokable
{
    public function __invoke(ServerRequestInterface $request, callable $delegate)
    {
        return $delegate($request);
    }
}
