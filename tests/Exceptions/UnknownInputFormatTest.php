<?php

namespace Ueberdosis\Pandoc\Tests\Exceptions;

use Ueberdosis\Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;
use Ueberdosis\Pandoc\Exceptions\UnknownInputFormat;

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
