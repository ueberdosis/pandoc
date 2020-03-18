<?php

namespace Ueberdosis\Tests\Features;

use Ueberdosis\Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;

class LogTest extends TestCase
{
    /** @test */
    public function pandoc_writes_log_file()
    {
        $output = (new Pandoc)
            ->from('markdown')
            ->input("# Test")
            ->to('html')
            ->log('tests/temp/log.txt')
            ->run();

        $this->assertTrue(file_exists('tests/temp/log.txt'));
    }
}
