<?php

namespace Interop\Http\Middleware;

use ReflectionException;
use ReflectionFunctionAbstract;
use TRex\Reflection\CallableReflection;

if (! function_exists('Interop\Http\Middleware\is_delegate')) {
    /**
     * Verify that the contents of a variable can be called as a delegate.
     *
     * @param mixed $var The value to check
     *
     * @return bool Returns TRUE if var is a delegate, FALSE otherwise.
     * @throws ReflectionException if the function does not exist.
     */
    function is_delegate($var)
    {
        /* short circuit for interface implementers */
        if ($var instanceof DelegateInterface) {
            return true;
        }

        if (! is_callable($var)) {
            return false;
        }

        /* @var $refFunc ReflectionFunctionAbstract */
        $refFunc = (new CallableReflection($var))->getReflector();

        if (1 !== $refFunc->getNumberOfRequiredParameters()) {
            return false;
        }

        $request = $refFunc->getParameters()[0];

        if (null === $requestClass = $request->getClass()) {
            return false;
        }

        return $requestClass->getName() === 'Psr\Http\Message\RequestInterface';
    }
}

if (! function_exists('Interop\Http\Middleware\is_server_middleware')) {
    /**
     * Verify that the contents of a variable can be called as a middleware.
     *
     * @param mixed $var The value to check
     *
     * @return bool Returns TRUE if var is a middleware, FALSE otherwise.
     * @throws ReflectionException if the function does not exist.
     */
    function is_server_middleware($var)
    {
        /* short circuit for interface implementers */
        if ($var instanceof ServerMiddlewareInterface) {
            return true;
        }

        if (! is_callable($var)) {
            return false;
        }

        /* @var $refFunc ReflectionFunctionAbstract */
        $refFunc = (new CallableReflection($var))->getReflector();

        if (2 !== $refFunc->getNumberOfRequiredParameters()) {
            return false;
        }

        list($request, $delegate) = $refFunc->getParameters();

        /* first parameter */
        if (null === $requestClass = $request->getClass()) {
            return false;
        }

        if ($requestClass->getName() !== 'Psr\Http\Message\ServerRequestInterface') {
            return false;
        }

        /* second parameter */
        return $delegate->isCallable();
    }
}
