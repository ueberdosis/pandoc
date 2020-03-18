<?php

namespace Ueberdosis\Pandoc\Tests\Exceptions;

use Ueberdosis\Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;
use Ueberdosis\Pandoc\Exceptions\UnknownOutputFormat;

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
