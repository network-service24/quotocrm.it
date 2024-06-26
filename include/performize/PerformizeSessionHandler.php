<?php


class PerformizeSessionHandler extends SessionHandler
{
    private ?string $logFilePath;

    public function __construct(?string $logFilePath=null)
    {
        $this->logFilePath = $logFilePath;
    }

    public function open($savePath, $sessionName): bool
    {
        $this->log(__METHOD__);
        return parent::open($savePath, $sessionName);
    }

    public function close(): bool
    {
        $this->log(__METHOD__);
        return parent::close();
    }

    public function read($id)
    {
  //      $this->log('Session read');
        return parent::read($id);
    }

    public function write($id, $data): bool
    {
     //   $this->log('Session write');
        return parent::write($id, $data);
    }

    public function destroy($id): bool
    {
        $this->log(__METHOD__);

        return parent::destroy($id);
    }

    public function gc($maxlifetime)
    {
        $this->log("Session garbage collected");
        return parent::gc($maxlifetime);
    }

    private function log(string $message): void
    {
        if(!empty($this->logFilePath) && $_SERVER['REMOTE_ADDR']=='217.61.62.216' )
        file_put_contents($this->logFilePath, sprintf('%2$s - %1$s - %2$s %3$s',date('Y-m-d H:i:s'),$_SERVER['REQUEST_URI'],$message) . PHP_EOL, FILE_APPEND);
    }
}

