<?php

namespace Pandoc\Tests\Features;

use Pandoc\Pandoc;
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
