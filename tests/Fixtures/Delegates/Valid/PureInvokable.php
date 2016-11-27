<?php

namespace Interop\Http\Middleware\Fixtures\Delegates\Valid;

use Psr\Http\Message\RequestInterface;

class PureInvokable
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(RequestInterface $request)
    {
        return null;
    }
}
