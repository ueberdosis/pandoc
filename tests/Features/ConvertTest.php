<?php

namespace Pandoc\Tests\Features;

use Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;

class ConvertTest extends TestCase
{
    /** @test */
    public function pandoc_converts_markdown_to_text()
    {
        if (file_exists('tests/temp/example.txt')) {
            unlink('tests/temp/example.txt');
        }

        $output = (new Pandoc)
            ->from('markdown')
            ->inputFile('tests/data/example.md')
            ->to('plain')
            ->output('tests/temp/example.txt')
            ->run();

        $this->assertFileExists('tests/temp/example.txt');
    }

    /** @test */
    public function pandoc_converts_stdin_to_html()
    {
        $output = (new Pandoc)
            ->from('markdown')
            ->input("# Test")
            ->to('html')
            ->run();

        $this->assertStringContainsString('<h1 id="test">Test</h1>', $output);
    }

    /** @test */
    public function pandoc_forwards_magic_from_calls()
    {
        $output = (new Pandoc)
            ->fromMarkdown()
            ->inputFile('tests/data/example.md')
            ->to('html')
            ->run();

        $this->assertStringContainsString('<h1 id="test">Test</h1>', $output);
    }

    /** @test */
    public function pandoc_forwards_magic_to_calls_with_stdin()
    {
        $output = (new Pandoc)
            ->fromMarkdown('# Test')
            ->to('html')
            ->run();

        $this->assertStringContainsString('<h1 id="test">Test</h1>', $output);
    }

    /** @test */
    public function pandoc_forwards_magic_to_calls()
    {
        if (file_exists('tests/temp/example.html')) {
            unlink('tests/temp/example.html');
        }

        $output = (new Pandoc)
            ->from('markdown')
            ->input("# Test")
            ->toHtml('tests/temp/example.html')
            ->run();

        $this->assertFileExists('tests/temp/example.html');
    }
}
