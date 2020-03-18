<?php

namespace Ueberdosis\Pandoc;

use Exception;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Pandoc
{
    protected $inputFile;

    protected $from;

    protected $to;

    protected $output;

    public function inputFile($value)
    {
        $this->inputFile = $value;

        return $this;
    }

    public function from($value)
    {
        $this->from = $value;

        return $this;
    }

    public function to($value)
    {
        $this->to = $value;

        return $this;
    }

    public function output($value)
    {
        $this->output = $value;

        return $this;
    }

    public function execute(array $parameters)
    {
        $process = new Process(
            array_merge([
                'pandoc'
            ], $parameters)
        );

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }

    public function run()
    {
        return $this->execute([$this->inputFile,
            "--from", "{$this->from}",
            "--to", "{$this->to}",
            "--standalone",
            "--output", "{$this->output}",
        ]);
    }

    public function version()
    {
        $output = $this->execute(['--version']);

        preg_match("/pandoc ([0-9]+\.[0-9]+\.[0-9]+)/", $output, $matches);
        list($match, $version) = $matches;

        if (!$version) {
            throw new Exception("Couldn’t find a pandoc version number in the output.");
        }

        return $version;
    }

    public function listInputFormats()
    {
        $output = $this->execute(['--list-input-formats']);

        return array_filter(explode("\n", $output));
    }

    public function listOutputFormats()
    {
        $output = $this->execute(['--list-output-formats']);

        return array_filter(explode("\n", $output));
    }
}
