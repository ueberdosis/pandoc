<?php

namespace Pandoc\Tests\Exceptions;

use Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;
use Pandoc\Exceptions\InputFileNotFound;

class InputFileNotFoundTest extends TestCase
{
    /** @test */
    public function input_file_not_found_exception_is_thrown()
    {
        $this->expectException(InputFileNotFound::class);

        (new Pandoc)
            ->inputFile('foo/bar/doesnt/exist.txt')
            ->to('html')
            ->run();
    }
}
