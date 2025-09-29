<?php

namespace Cangej\PhpSimpleLogger;

use RuntimeException;

class SimpleLogger
{
    private string $logDirectory;
    private bool $dateDirectory; // Add a folder inside the main log directory with a date to separate logs day by day

    /**
     * Write a message into a custom log file.
     *
     * @param string $logDir     Log directory to be used
     * @param bool $dateDir      Add a nested directory based on today date. This allow the logs to be separated day by day
     *
     * @throws RuntimeException if the directory cannot be created
     */
    public function __construct(string $logDir = "Logs", bool $dateDir = false)
    {
        $this->dateDirectory = $dateDir;

        if($this->dateDirectory){
            $this->logDirectory = __DIR__ . '/' . trim($logDir, '/') . '/' . date('Y-m-d');
        }
        else{
            $this->logDirectory = __DIR__ . '/' . trim($logDir, '/');
        }

        if (!is_dir($this->logDirectory) && !mkdir($this->logDirectory, 0777, true)) {
            throw new RuntimeException("Failed to create log directory: {$this->logDirectory}");
        }
    }

    /**
     * Write a message into a custom log file.
     *
     * @param string $logName    Log file name (without extension)
     * @param string $logLevel   Log level (INFO, ERROR, DEBUG, etc.)
     * @param string $logContent Log message
     *
     * @return bool true on success
     * @throws RuntimeException if the log file cannot be created, opened or written
     */
    public function writeCustomLog(string $logName, string $logLevel, string $logContent): bool
    {
        $filePath = $this->logDirectory . '/' . $logName . '.log';

        // Create log file if it doesn't exist
        if (!file_exists($filePath)) {
            $initMessage = date('Y-m-d') . " | INFO - Log file created" . PHP_EOL;
            if (file_put_contents($filePath, $initMessage) === false) {
                throw new RuntimeException("Failed to create log file: {$filePath}");
            }
        }

        $logHandle = fopen($filePath, "a+");
        if (!$logHandle) {
            throw new RuntimeException("Failed to open log file: {$filePath}");
        }

        $logEntry = date('Y-m-d H:i:s') . ' | ' . strtoupper($logLevel) . ' - ' . $logContent . PHP_EOL;

        if (!flock($logHandle, LOCK_EX)) {
            fclose($logHandle);
            throw new RuntimeException("Failed to lock log file: {$filePath}");
        }

        if (fwrite($logHandle, $logEntry) === false) {
            flock($logHandle, LOCK_UN);
            fclose($logHandle);
            throw new RuntimeException("Failed to write to log file: {$filePath}");
        }

        flock($logHandle, LOCK_UN);
        fclose($logHandle);

        return true;
    }

    /**
     * Write a message into an info log file.
     *
     * @param string $logContent Log message
     *
     * @return bool true on success
     * @throws RuntimeException if the log file cannot be created, opened or written
     */
    public function writeInfoLog(string $logContent): bool
    {
        $filePath = $this->logDirectory . '/Info.log';

        // Create log file if it doesn't exist
        if (!file_exists($filePath)) {
            $initMessage = date('Y-m-d') . " | INFO - Log file created" . PHP_EOL;
            if (file_put_contents($filePath, $initMessage) === false) {
                throw new RuntimeException("Failed to create log file: {$filePath}");
            }
        }

        $logHandle = fopen($filePath, "a+");
        if (!$logHandle) {
            throw new RuntimeException("Failed to open log file: {$filePath}");
        }

        $logEntry = date('Y-m-d H:i:s') . ' | INFO - ' . $logContent . PHP_EOL;

        if (!flock($logHandle, LOCK_EX)) {
            fclose($logHandle);
            throw new RuntimeException("Failed to lock log file: {$filePath}");
        }

        if (fwrite($logHandle, $logEntry) === false) {
            flock($logHandle, LOCK_UN);
            fclose($logHandle);
            throw new RuntimeException("Failed to write to log file: {$filePath}");
        }

        flock($logHandle, LOCK_UN);
        fclose($logHandle);

        return true;
    }

    /**
     * Write a message into an error log file.
     *
     * @param string $logContent Log message
     *
     * @return bool true on success
     * @throws RuntimeException if the log file cannot be created, opened or written
     */
    public function writeErrorLog(string $logContent): bool
    {
        $filePath = $this->logDirectory . '/Error.log';

        // Create log file if it doesn't exist
        if (!file_exists($filePath)) {
            $initMessage = date('Y-m-d') . " | INFO - Log file created" . PHP_EOL;
            if (file_put_contents($filePath, $initMessage) === false) {
                throw new RuntimeException("Failed to create log file: {$filePath}");
            }
        }

        $logHandle = fopen($filePath, "a+");
        if (!$logHandle) {
            throw new RuntimeException("Failed to open log file: {$filePath}");
        }

        $logEntry = date('Y-m-d H:i:s') . ' | ERROR - ' . $logContent . PHP_EOL;

        if (!flock($logHandle, LOCK_EX)) {
            fclose($logHandle);
            throw new RuntimeException("Failed to lock log file: {$filePath}");
        }

        if (fwrite($logHandle, $logEntry) === false) {
            flock($logHandle, LOCK_UN);
            fclose($logHandle);
            throw new RuntimeException("Failed to write to log file: {$filePath}");
        }

        flock($logHandle, LOCK_UN);
        fclose($logHandle);

        return true;
    }

    /**
     * Write a message into an warning log file.
     *
     * @param string $logContent Log message
     *
     * @return bool true on success
     * @throws RuntimeException if the log file cannot be created, opened or written
     */
    public function writeWarningLog(string $logContent): bool
    {
        $filePath = $this->logDirectory . '/Warning.log';

        // Create log file if it doesn't exist
        if (!file_exists($filePath)) {
            $initMessage = date('Y-m-d') . " | INFO - Log file created" . PHP_EOL;
            if (file_put_contents($filePath, $initMessage) === false) {
                throw new RuntimeException("Failed to create log file: {$filePath}");
            }
        }

        $logHandle = fopen($filePath, "a+");
        if (!$logHandle) {
            throw new RuntimeException("Failed to open log file: {$filePath}");
        }

        $logEntry = date('Y-m-d H:i:s') . ' | WARNING - ' . $logContent . PHP_EOL;

        if (!flock($logHandle, LOCK_EX)) {
            fclose($logHandle);
            throw new RuntimeException("Failed to lock log file: {$filePath}");
        }

        if (fwrite($logHandle, $logEntry) === false) {
            flock($logHandle, LOCK_UN);
            fclose($logHandle);
            throw new RuntimeException("Failed to write to log file: {$filePath}");
        }

        flock($logHandle, LOCK_UN);
        fclose($logHandle);

        return true;
    }
}