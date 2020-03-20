<?php

namespace Pandoc;

use Exception;
use Pandoc\Exceptions\BadMethodCall;
use Pandoc\Exceptions\PandocNotFound;
use Symfony\Component\Process\Process;
use Pandoc\Exceptions\InputFileNotFound;
use Pandoc\Exceptions\UnknownInputFormat;
use Pandoc\Exceptions\LogFileNotWriteable;
use Pandoc\Exceptions\UnknownOutputFormat;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Pandoc
{
    public $config = [
        'command' => 'pandoc',
    ];

    protected $input;

    protected $inputFile;

    protected $from;

    protected $to;

    protected $output;

    protected $log;

    protected $dataDir;

    public function __construct($config = [])
    {
        $this->config = array_merge($this->config, $config);
    }

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

    public function log($value)
    {
        $this->log = $value;

        return $this;
    }

    public function dataDir($value)
    {
        $this->dataDir = $value;

        return $this;
    }

    public function execute(array $parameters = [])
    {
        $parameters = array_merge([
            $this->config['command'],
        ], $parameters);

        if ($this->log) {
            array_push($parameters, "--log", "{$this->log}");
        }

        if ($this->dataDir) {
            array_push($parameters, "--data-dir", "{$this->dataDir}");
        }

        $process = new Process($parameters);

        if ($this->input) {
            $process->setInput($this->input);
        }

        $process->run();

        if (!$process->isSuccessful()) {
            $output = $process->getErrorOutput();

            if (strpos($output, "pandoc: {$this->inputFile}: openBinaryFile: does not exist") !== false) {
                throw new InputFileNotFound;
            }

            if (strpos($output, "pandoc: {$this->log}: openBinaryFile: does not exist") !== false) {
                throw new LogFileNotWriteable;
            }

            if (strpos($output, 'Unknown input format') !== false) {
                throw new UnknownInputFormat;
            }

            if (strpos($output, 'Unknown output format') !== false) {
                throw new UnknownOutputFormat;
            }

            if (strpos($output, 'not found') !== false) {
                throw new PandocNotFound;
            }

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

        preg_match("/(0|[1-9]\d*)\.(0|[1-9]\d*)\.(0|[1-9]\d*)(-(0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*)(\.(0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*))*)?(\+[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*)?/", $output, $matches);
        list($version) = $matches;

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

    public function __call($method, $args)
    {
        $stringsStartsWithFrom = strpos($method, 'from') === 0;
        $desiredInputFormat = strtolower(
            array_reverse(explode('from', $method, 2))[0]
        );
        $availableInputFormats = $this->listInputFormats();

        if ($stringsStartsWithFrom && in_array($desiredInputFormat, $availableInputFormats)) {
            $this->from($desiredInputFormat);

            if (! empty($args)) {
                $this->input(...$args);
            }

            return $this;
        }

        $stringStartsWithTo = strpos($method, 'to') === 0;
        $desiredOutputFormat = strtolower(
            array_reverse(explode('to', $method, 2))[0]
        );
        $availableOutputFormats = $this->listOutputFormats();

        if ($stringStartsWithTo && in_array($desiredOutputFormat, $availableOutputFormats)) {
            $this->to($desiredOutputFormat);

            if (! empty($args)) {
                $this->output(...$args);
            }

            return $this;
        }

        throw new BadMethodCall(sprintf(
            'Call to undefined method %s::%s()',
            get_class($this),
            $method
        ));
    }
}
