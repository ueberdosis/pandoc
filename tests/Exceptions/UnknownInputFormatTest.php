<?php

namespace Pandoc\Tests\Exceptions;

use Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;
use Pandoc\Exceptions\UnknownInputFormat;

class UnknownInputFormatTest extends TestCase
{
    /** @test */
    public function unknown_input_format_exception_is_thrown()
    {
        $this->expectException(UnknownInputFormat::class);

        (new Pandoc)
            ->from('foobar')
            ->run();
    }
}
