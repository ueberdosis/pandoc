<?php

namespace Pandoc\Tests\Features;

use Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;

class DataDirTest extends TestCase
{
    /** @test */
    public function pandoc_uses_custom_templates()
    {
        $output = (new Pandoc)
            ->dataDir('tests/data/custom')
            ->from('markdown')
            ->input('# Test')
            ->to('html')
            ->run();

        $this->assertStringContainsString('/* custom template */', $output);
    }
}
