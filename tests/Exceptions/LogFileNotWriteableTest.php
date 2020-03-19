<?php

namespace Pandoc\Tests\Exceptions;

use Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;
use Pandoc\Exceptions\LogFileNotWriteable;

class LogFileNotWriteableTest extends TestCase
{
    /** @test */
    public function log_file_not_writeable_exception_is_thrown()
    {
        $this->expectException(LogFileNotWriteable::class);

        (new Pandoc)
            ->to('html')
            ->log('foo/bar/doesnt/exist.txt')
            ->run();
    }
}
