<?php

namespace Psr\Http\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface StackInterface
{
    /**
     * Dispatch the request through middleware and return the response.
     *
     * This method MUST be implemented in such a way as to allow the same
     * stack to be reused for processing multiple requests in sequence.
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function dispatch(RequestInterface $request);
}
