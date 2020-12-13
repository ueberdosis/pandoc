<?php

namespace Pandoc\Tests\Features;

use Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;

class LogTest extends TestCase
{
    /** @test */
    public function pandoc_writes_log_file()
    {
        if (file_exists('tests/temp/log.txt')) {
            unlink('tests/temp/log.txt');
        }

        $output = (new Pandoc)
            ->from('markdown')
            ->input("# Test")
            ->to('html')
            ->log('tests/temp/log.txt')
            ->run();

        $this->assertFileExists('tests/temp/log.txt');
    }
}
