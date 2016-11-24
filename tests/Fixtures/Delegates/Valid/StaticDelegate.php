<?php

namespace Interop\Http\Middleware\Fixtures\Delegates\Valid;

use Psr\Http\Message\RequestInterface;

class StaticDelegate
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public static function delegate(RequestInterface $request)
    {
        return null;
    }
}
