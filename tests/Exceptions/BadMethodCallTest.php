<?php

namespace Pandoc\Tests\Exceptions;

use Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;
use Pandoc\Exceptions\BadMethodCall;

class BadMethodCallTest extends TestCase
{
    /** @test */
    public function bad_method_call_exception_is_thrown()
    {
        $this->expectException(BadMethodCall::class);

        (new Pandoc)
            ->fromDoesNotExist()
            ->run();
    }
}
