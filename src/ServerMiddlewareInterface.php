<?php

namespace Interop\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ServerMiddlewareInterface
{
    /**
     * Process an incoming server request and return a response, optionally delegating
     * the request utilizing $delegate.
     *
     * @param ServerRequestInterface     $request
     * @param DelegateInterface|callable $delegate
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, callable $delegate);
}
