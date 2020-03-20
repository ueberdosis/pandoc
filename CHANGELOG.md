# Changelog

All notable changes to `pandoc` will be documented in this file

## 0.5.0 - 2020-03-20

- add symfony/process executable finder

## 0.4.0 - 2020-03-20

- add magic from method (e. g. ->fromMarkdown()))
- add magic to method (e. g. ->toHtml()))
- add BadMethodCall exception

## 0.3.0 - 2020-03-19

- add LogFileNotWriteable exception
- add InputFileNotFound exception

## 0.2.1 - 2020-03-19

- add support for --data-dir (custom templates)

## 0.2.0 - 2020-03-18

- changed namespace

## 0.1.2 - 2020-03-18

- add PandocNotFound exception
- add UnknownInputFormat exception
- add UnknownOutputFormat exception

## 0.1.1 - 2020-03-18

- compatibility with symfony/process 4.*

## 0.1.0 - 2020-03-18

- initial release
- return the converted text
- use a file as input and write a file as output
- change path to Pandoc
- list available input formats
- list available output formats
- write a log file
- retrieve Pandoc version
