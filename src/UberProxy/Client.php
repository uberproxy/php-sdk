<?php

namespace UberProxy;

class Client
{
    protected $url;
    protected $secret;

    public function __construct($url, $secret)
    {
        $this->url = $url;
        $this->secret = $secret;
    }

    public function deregister()
    {
        return new Deregister($this);
    }

    public function register()
    {
        return new Register($this);
    }

    protected function command($action, Array $data = null)
    {
        $ch   = curl_init("http://{$this->url}/_uberproxy/{$action}");
        $data = $data ? json_encode($data) : "";
        curl_setopt_array($ch, array(
            //CURLOPT_VERBOSE         => 1,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_POST            => 1,
            CURLOPT_POSTFIELDS      => $data,
            CURLOPT_HTTPHEADER      => array('X-Auth: '. hash('sha256', $this->secret . "\0" . $action . "\0" . $data)),
        ));
        $response = curl_exec($ch);
        $resCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $object = json_decode($response, true);
        if (!empty($object['error'])) {
            throw new \RuntimeException($object['exception']);
        }
        if ($resCode !== 200) {
            throw new \RuntimeException("Invalid response code ($resCode)");
        }
        return $object;
    }

    public function getInfo()
    {
        return $this->command('info');
    }

    public function ping()
    {
        return $this->command('ping');
    }

    public function addSsl($domain)
    {
        $ssl = new Ssl($this);
        return $ssl->setDomain($domain);
    }

    public function send(Command $command)
    {
        return $this->command($command->getAction(), $command->toArray());
    }
}
