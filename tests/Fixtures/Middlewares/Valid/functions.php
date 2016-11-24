<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Valid;

use Psr\Http\Message\ServerRequestInterface;

function fnMiddleware(ServerRequestInterface $request, callable $delegate)
{
    return $delegate($request);
}

function fnMiddlewareFactory()
{
    return function (ServerRequestInterface $request, callable $delegate) {
        return $delegate($request);
    };
}
