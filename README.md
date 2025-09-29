# PHP_Simple_Logger
A simple PHP package for writing logs.

## Installation
Installation is done with composer : `composer require cangej/php_simple_logger`

## Usage
### 1. Instantiate the SimpleLogger class

```php
$log = new SimpleLogger();
```

The class has 2 optional parameters:

- The log directory name.
- A boolean that specifies whether to create a nested folder using today’s date, so logs are separated day by day.

Notes:

- If the log directory doesn’t exist, it will be created automatically.
- Default values are `"Logs"` and `false`.

### 2. Call one of the methods
There are 4 available methods for writing to log files:

- Custom: Allows you to write to your own custom file (it will be created if it doesn’t exist).
- Warning: Writes to the Warning log.
- Error: Writes to the Error log.
- Info: Writes to the Info log.

The `writeCustomLog` method takes 3 parameters:
- A string for the file name.
- A string for the log level (e.g., Info, Error, Warning...).
- The content to write into the log.
- The `writeWarningLog`, `writeErrorLog`, and `writeInfoLog` methods each take a single parameter: the string content you want to write to the log file.

Each method returns `true` if the log was successfully written.

Examples :

```php
$log->writeCustomLog("TestLog", "Info", "This is a simple writing test into a custom log");
$log->writeWarningLog("This is a simple writing test into the warning log");
$log->writeErrorLog("This is a simple writing test into the error log");
$log->writeInfoLog("This is a simple writing test into the information log");
```