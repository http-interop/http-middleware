<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Invalid;

use Psr\Http\Message\ServerRequestInterface;

class StaticMiddlewareWithoutDelegate
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public static function middleware(ServerRequestInterface $request)
    {
        return null;
    }
}
