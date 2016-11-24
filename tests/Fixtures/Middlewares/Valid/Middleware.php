<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Valid;

use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Middleware\ServerMiddlewareInterface;

class Middleware implements ServerMiddlewareInterface
{
    public function __invoke(ServerRequestInterface $request, callable $delegate)
    {
        return $delegate($request);
    }
}
