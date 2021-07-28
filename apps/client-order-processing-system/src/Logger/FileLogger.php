<?php


namespace Marguzych23\ClientOrderProcessingSystem\Logger;

use Marguzych23\ClientOrderProcessingSystem\AppContainer;

class FileLogger implements LoggerInterface
{
    private ?string $log_dir_path = null;

    /**
     * FileLogger constructor.
     *
     * @param string|null $log_dir_path
     */
    public function __construct(?string $log_dir_path = null)
    {
        if ($log_dir_path !== null) {
            $this->log_dir_path = $log_dir_path;
        } else {
            $this->log_dir_path = AppContainer::path('app') . 'logs';
        }
    }

    /**
     * @inheritDoc
     */
    public function log($level, $message, array $context = [])
    {
        $filename = $this->log_dir_path . DIRECTORY_SEPARATOR . $level . '.txt';
        file_put_contents($filename, $message . PHP_EOL, FILE_APPEND);
    }

    /**
     * @inheritDoc
     */
    public function emergency($message, array $context = [])
    {
        $this->log(self::EMERGENCY, $message, $context);
    }

    /**
     * @inheritDoc
     */
    public function alert($message, array $context = [])
    {
        $this->log(self::ALERT, $message, $context);
    }

    /**
     * @inheritDoc
     */
    public function critical($message, array $context = [])
    {
        $this->log(self::CRITICAL, $message, $context);
    }

    /**
     * @inheritDoc
     */
    public function error($message, array $context = [])
    {
        $this->log(self::ERROR, $message, $context);
    }

    /**
     * @inheritDoc
     */
    public function warning($message, array $context = [])
    {
        $this->log(self::WARNING, $message, $context);
    }

    /**
     * @inheritDoc
     */
    public function notice($message, array $context = [])
    {
        $this->log(self::NOTICE, $message, $context);
    }

    /**
     * @inheritDoc
     */
    public function info($message, array $context = [])
    {
        $this->log(self::INFO, $message, $context);
    }

    /**
     * @inheritDoc
     */
    public function debug($message, array $context = [])
    {
        $this->log(self::DEBUG, $message, $context);
    }
}