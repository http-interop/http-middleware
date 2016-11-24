<?php

namespace Interop\Http\Middleware\Fixtures\Delegates\Valid;

use Psr\Http\Message\RequestInterface;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
function fnDelegate(RequestInterface $request)
{
    return null;
}

function fnDelegateFactory()
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    return function (RequestInterface $request) {
        return null;
    };
}
