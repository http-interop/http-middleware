<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Invalid;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Middleware\DelegateInterface;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
function fnDoublePass(ServerRequestInterface $request, ResponseInterface $response)
{
    return $response;
}

function fnDoublePassFactory()
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    return function (ServerRequestInterface $request, ResponseInterface $response) {
        return $response;
    };
}

function fnWithDelegate(ServerRequestInterface $request, DelegateInterface $delegate)
{
    return $delegate($request);
}

function fnWithDelegateFactory()
{
    return function (ServerRequestInterface $request, DelegateInterface $delegate) {
        return $delegate($request);
    };
}

function fnWithMixedRequest($request, callable $delegate)
{
    return $delegate($request);
}

function fnWithMixedRequestFactory()
{
    return function ($request, callable $delegate) {
        return $delegate($request);
    };
}

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
function fnWithoutDelegate(ServerRequestInterface $request)
{
    return null;
}

function fnWithoutDelegateFactory()
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    return function (ServerRequestInterface $request) {
        return null;
    };
}
