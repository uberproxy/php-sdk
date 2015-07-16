<?php

namespace UberProxy;

class Ssl extends Command
{
    protected $array;

    public function __call($name, $value)
    {
        if (substr($name, 0, 3) !== 'add') {
            throw new \RuntimeException("Invalid function $name");
        }
        $this->array[ strtolower(substr($name, 3)) ] = file_get_contents($value[0]);
        return $this;
    }

    public function setDomain($domain)
    {
        $this->array['domain'] = $domain;
        return $this;
    }

    public function getAction()
    {
        return 'add_ssl';
    }

    public function toArray()
    {
        return $this->array;
    }
}
