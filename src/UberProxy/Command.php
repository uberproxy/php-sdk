<?php

namespace UberProxy;

abstract class Command
{
    protected $proxy;

    public function __construct(Client $proxy)
    {
        $this->proxy = $proxy;
    }

    public function send()
    {
        return $this->proxy->send($this);
    }

    abstract public function toArray();

    abstract public function getAction();
}
