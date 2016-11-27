<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Valid;

use Psr\Http\Message\ServerRequestInterface;

class StaticMiddleware
{
    public static function middleware(ServerRequestInterface $request, callable $delegate)
    {
        return $delegate($request);
    }
}
