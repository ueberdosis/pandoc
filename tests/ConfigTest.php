<?php

namespace Ueberdosis\Pandoc\Tests;

use Ueberdosis\Pandoc\Pandoc;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /** @test */
    public function command_is_configurable()
    {
        $pandoc = new Pandoc([
            'command' => '/usr/local/bin/pandoc',
        ]);

        $this->assertEquals('/usr/local/bin/pandoc', $pandoc->config['command']);
    }
}
