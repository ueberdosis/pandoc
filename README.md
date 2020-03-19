# Pandoc PHP Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ueberdosis/pandoc.svg?style=flat-square)](https://packagist.org/packages/ueberdosis/pandoc)
[![Build Status](https://github.com/ueberdosis/pandoc/workflows/run-tests/badge.svg)](https://github.com/ueberdosis/pandoc/actions)
[![Total Downloads](https://img.shields.io/packagist/dt/ueberdosis/pandoc.svg?style=flat-square)](https://packagist.org/packages/ueberdosis/pandoc)

If you need to convert text files from one format to another, [pandoc](https://pandoc.org/) is your swiss-army knife. This package is a PHP wrapper for pandoc.

## Installation

You can install the package via composer:

```bash
composer require ueberdosis/pandoc
```

This package is a wrapper for the command-line tool pandoc. Don’t forget to install pandoc. Here is an example for Ubuntu:

```bash
sudo apt-get update
sudo apt-get install -y wget
sudo mkdir -p /usr/src/pandoc
cd /usr/src/pandoc
sudo wget https://github.com/jgm/pandoc/releases/download/2.9.2/pandoc-2.9.2-1-amd64.deb
sudo dpkg -i pandoc-2.9.2-1-amd64.deb
```

[More examples are available in the pandoc documentation](https://pandoc.org/installing.html)

## Usage

### Return the converted text

``` php
$output = (new \Pandoc\Pandoc)
    ->from('markdown')
    ->input("# Test")
    ->to('html')
    ->run();
```

### Use a file as input and write a file as output

``` php
(new \Pandoc\Pandoc)
    ->from('markdown')
    ->inputFile('tests/data/example.md')
    ->to('plain')
    ->output('tests/temp/example.txt')
    ->run();
```

### Change path to Pandoc

``` php
new \Pandoc\Pandoc([
    'command' => '/usr/local/bin/pandoc',
]);
```

### List available input formats

``` php
(new \Pandoc\Pandoc)->listInputFormats();
```

### List available output formats

``` php
(new \Pandoc\Pandoc)->listOutputFormats();
```

### Write a log file

``` php
echo (new \Pandoc\Pandoc)
    ->from('markdown')
    ->input("# Markdown")
    ->to('html')
    ->log('log.txt')
    ->run();
```

### Retrieve Pandoc version

``` php
echo (new \Pandoc\Pandoc)->version();
```

### Laravel Facade

This package includes a Laravel facade for people that like that little bit of syntactic sugar.

```php
echo \Pandoc\Facades\Pandoc::version();
```

### Exceptions

If something went wrong, the package throws a generic `\Symfony\Component\Process\Exception\ProcessFailedException`. There are even a few specific exceptions.

* \Pandoc\Exceptions\PandocNotFound
* \Pandoc\Exceptions\InputFileNotFound
* \Pandoc\Exceptions\UnknownInputFormat
* \Pandoc\Exceptions\UnknownOutputFormat
* \Pandoc\Exceptions\LogFileNotWriteable

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Hans Pagel](https://github.com/hanspagel)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
