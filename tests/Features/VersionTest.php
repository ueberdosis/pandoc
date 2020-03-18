<?php

namespace Pandoc\Tests\Features;

use Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;

class VersionTest extends TestCase
{
    /** @test */
    public function pandoc_returns_version()
    {
        $output = (new Pandoc)->version();

        $this->assertTrue(version_compare($output, '2.0.0', '>='));
        $this->assertTrue(version_compare($output, '3.0.0', '<'));
    }
}
