<?php

namespace Pandoc\Tests\Features;

use Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;

class ListInputFormatsTest extends TestCase
{
    /** @test */
    public function pandoc_lists_input_formats()
    {
        $inputFormats = (new Pandoc)->listInputFormats();

        $this->assertContains('markdown', $inputFormats);
        $this->assertGreaterThan(10, $inputFormats);
    }
}
