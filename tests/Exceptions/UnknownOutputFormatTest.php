<?php

namespace Pandoc\Tests\Exceptions;

use Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;
use Pandoc\Exceptions\UnknownOutputFormat;

class UnknownOutputFormatTest extends TestCase
{
    /** @test */
    public function unknown_output_format_exception_is_thrown()
    {
        $this->expectException(UnknownOutputFormat::class);

        (new Pandoc)
            ->to('foobar')
            ->run();
    }
}
