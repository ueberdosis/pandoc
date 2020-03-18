<?php

namespace Ueberdosis\Pandoc;

use Exception;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Pandoc
{
    protected $input;

    protected $inputFile;

    protected $from;

    protected $to;

    protected $output;

    public function inputFile($value)
    {
        $this->inputFile = $value;

        return $this;
    }

    public function input($value)
    {
        $this->input = $value;

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

        if ($this->input) {
            $process->setInput($this->input);
        }

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();

        if ($output === '') {
            return true;
        }

        return $output;
    }

    public function run()
    {
        $parameters = [
            "--standalone",
        ];

        if ($this->inputFile) {
            array_push($parameters, $this->inputFile);
        }

        if ($this->from) {
            array_push($parameters, "--from", "{$this->from}");
        }

        if ($this->to) {
            array_push($parameters, "--to", "{$this->to}");
        }

        if ($this->output) {
            array_push($parameters, "--output", "{$this->output}");
        }

        return $this->execute($parameters);
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
