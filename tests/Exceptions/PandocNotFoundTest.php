<?php

namespace Ueberdosis\Pandoc\Tests\Exceptions;

use Ueberdosis\Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;
use Ueberdosis\Pandoc\Exceptions\PandocNotFound;

class PandocNotFoundTest extends TestCase
{
    /** @test */
    public function pandoc_not_found_exception_is_thrown()
    {
        $pandoc = new Pandoc([
            'command' => 'foobar',
        ]);

        $this->expectException(PandocNotFound::class);

        $pandoc->version();
    }
}
