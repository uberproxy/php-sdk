<?php

namespace UberProxy;

class Deregister extends Command
{
    protected $host;
    protected $worker;

    public function getAction()
    {
        return 'deregister';
    }

    public function host($host)
    {
        $this->host = $host;
        return $this;
    }

    public function worker($worker)
    {
        $this->worker = $worker;
        return $this;
    }

    public function toArray()
    {
        return array(
            'worker' => $this->worker,
            'host'   => $this->host,
        );
    }
}
