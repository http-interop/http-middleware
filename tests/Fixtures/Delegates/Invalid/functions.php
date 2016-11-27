<?php

namespace Interop\Http\Middleware\Fixtures\Delegates\Invalid;

function fnWithoutRequest()
{
    return null;
}

function fnWithoutRequestFactory()
{
    return function () {
        return null;
    };
}

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
function fnWithMixedRequest($request)
{
    return null;
}

function fnWithMixedRequestFactory()
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    return function ($request) {
        return null;
    };
}
