<?php

namespace Interop\Http\Middleware;

use ReflectionException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Middleware\Fixtures\Delegates\Invalid\MagicCall;
use Interop\Http\Middleware\Fixtures\Delegates\Invalid\PureInvokableWithMixedRequest;
use Interop\Http\Middleware\Fixtures\Delegates\Invalid\PureInvokableWithoutRequest;
use Interop\Http\Middleware\Fixtures\Delegates\Invalid\StaticDelegateWithMixedRequest;
use Interop\Http\Middleware\Fixtures\Delegates\Invalid\StaticDelegateWithoutRequest;

use function Interop\Http\Middleware\Fixtures\Delegates\Invalid\fnWithoutRequestFactory;
use function Interop\Http\Middleware\Fixtures\Delegates\Invalid\fnWithMixedRequestFactory;

class IsDelegateInvalidTest extends \PHPUnit_Framework_TestCase
{
    public function testFnWithoutRequestShouldBeInvalid()
    {
        $this->assertSame(
            false,
            is_delegate('Interop\Http\Middleware\Fixtures\Delegates\Invalid\fnWithoutRequest')
        );
    }

    public function testFnWithoutRequestFactoryShouldBeInvalid()
    {
        $sut = fnWithoutRequestFactory();
        $this->assertSame(false, is_delegate($sut));
    }

    public function testFnWithMixedRequestShouldBeInvalid()
    {
        $this->assertSame(
            false,
            is_delegate('Interop\Http\Middleware\Fixtures\Delegates\Invalid\fnWithMixedRequest')
        );
    }

    public function testFnWithMixedRequestFactoryShouldBeInvalid()
    {
        $sut = fnWithMixedRequestFactory();
        $this->assertSame(false, is_delegate($sut));
    }

    public function magicCallProvider()
    {
        $sut = new MagicCall();

        return [
            [
                [$sut, '__invoke'],
                '/__invoke\(\) does not exist$/',
            ],
            [
                [$sut, 'delegate'],
                '/delegate\(\) does not exist$/',
            ],
            [
                [MagicCall::class, '__invoke'],
                '/__invoke\(\) does not exist$/',
            ],
            [
                MagicCall::class.'::__invoke',
                '/__invoke\(\) does not exist$/',
            ],
            [
                [MagicCall::class, 'delegate'],
                '/delegate\(\) does not exist$/',
            ],
            [
                MagicCall::class.'::delegate',
                '/delegate\(\) does not exist$/',
            ],
        ];
    }

    /**
     * @dataProvider magicCallProvider
     */
    public function testMagicCallShouldBeInvalid($var, $messageRegExp)
    {
        $this->expectException(ReflectionException::class);
        $this->expectExceptionMessageRegExp($messageRegExp);
        is_delegate($var);
    }

    public function testPureInvokableWithMixedRequestShouldBeInvalid()
    {
        $sut = new PureInvokableWithMixedRequest();
        $this->assertSame(false, is_delegate($sut));
        $this->assertSame(false, is_delegate([$sut, '__invoke']));
        $this->assertSame(false, is_delegate([PureInvokableWithMixedRequest::class, '__invoke']));
        $this->assertSame(false, is_delegate(PureInvokableWithMixedRequest::class.'::__invoke'));
    }

    public function testPureInvokableWithoutRequestShouldBeInvalid()
    {
        $sut = new PureInvokableWithoutRequest();
        $this->assertSame(false, is_delegate($sut));
        $this->assertSame(false, is_delegate([$sut, '__invoke']));
        $this->assertSame(false, is_delegate([PureInvokableWithoutRequest::class, '__invoke']));
        $this->assertSame(false, is_delegate(PureInvokableWithoutRequest::class.'::__invoke'));
    }

    public function testStaticDelegateWithMixedRequestShouldBeInvalid()
    {
        $sut = new StaticDelegateWithMixedRequest();
        $this->assertSame(false, is_delegate([$sut, 'delegate']));
        $this->assertSame(false, is_delegate([StaticDelegateWithMixedRequest::class, 'delegate']));
        $this->assertSame(false, is_delegate(StaticDelegateWithMixedRequest::class.'::delegate'));
    }

    public function testStaticDelegateWithoutRequestShouldBeInvalid()
    {
        $sut = new StaticDelegateWithoutRequest();
        $this->assertSame(false, is_delegate([$sut, 'delegate']));
        $this->assertSame(false, is_delegate([StaticDelegateWithoutRequest::class, 'delegate']));
        $this->assertSame(false, is_delegate(StaticDelegateWithoutRequest::class.'::delegate'));
    }
}
