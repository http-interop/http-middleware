<?php

namespace Interop\Http\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface MiddlewareInterface
{
    /**
     * Process an incoming request and return a response, optionally delegating
     * to the next middleware component to create the response.
     *
     * @param RequestInterface           $request
     * @param DelegateInterface|callable $delegate
     *
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, callable $delegate);
}
