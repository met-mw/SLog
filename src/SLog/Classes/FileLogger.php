<?php
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;
use SFileSystem\Classes\File;

class FileLogger extends AbstractLogger implements LoggerInterface
{

    /** @var File */
    protected $FileLog = null;

    public function __construct($logFilePath)
    {
        $this->FileLog = new File($logFilePath);
        if (!$this->FileLog->exists()) {
            $this->FileLog->create();
        }
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        $this->FileLog->appendContent("$level | " . trim(strtr($message, $context)));
    }

}