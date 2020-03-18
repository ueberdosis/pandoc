<?php

namespace Ueberdosis\Pandoc\Tests;

use Ueberdosis\Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;

class ListOutputFormatsTest extends TestCase
{
    /** @test */
    public function pandoc_lists_output_formats()
    {
        $outputFormats = (new Pandoc)->listOutputFormats();

        $this->assertContains('markdown', $outputFormats);
        $this->assertGreaterThan(10, $outputFormats);
    }
}
