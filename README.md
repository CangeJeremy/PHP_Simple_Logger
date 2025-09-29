# PHP_Simple_Logger
A simple PHP package to write logs

## Usage
### 1. Instanciate the SimpleLogger class

```php
$log = new SimpleLogger();
```

The class has 2 optional parameters :
-  The log directory name.
-  A boolean used to add a nested folder using today date and separate logs day by day.

Note :
- If the log directory doesn't exist it will be created.
- Default values are "Logs" and FALSE.

### 2. Call one of the method
4 methods are available to write in a log file :
- Custom : Allow you to write in your own custom file and will create it if it doesn't exist
- Warning : Allow you to write in the Warning log
- Error : Allow you to write in the Error log
- Info : Allow you to write in the Info log

Examples :

```php
$log->writeCustomLog("TestLog", "Info", "This is a simple writing test into a custom log");
$log->writeWarningLog("This is a simple writing test into the warning log");
$log->writeErrorLog("This is a simple writing test into the error log");
$log->writeInfoLog("This is a simple writing test into the information log");
```

Every method return true if the log has been written