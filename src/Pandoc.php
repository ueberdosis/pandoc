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

    protected $outputFile;

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

    public function outputFile($value)
    {
        $this->outputFile = $value;

        return $this;
    }

    public function run()
    {
        $process = new Process([
            'pandoc', $this->inputFile,
            "-f", "{$this->from}",
            "-t", "{$this->to}",
            "-s",
            "-o", "{$this->outputFile}",
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }

    public function version($fullOutput = false)
    {
        $process = new Process([
            'pandoc',
            '-v',
        ]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $outputFile = $process->getOutput();

        if ($fullOutput) {
            return $outputFile;
        }

        preg_match("/pandoc ([0-9]+\.[0-9]+\.[0-9]+)/", $outputFile, $matches);
        list($match, $version) = $matches;

        if (!$version) {
            throw new Exception("Couldn’t find a pandoc version number in the outputFile.");
        }

        return $version;
    }
}
