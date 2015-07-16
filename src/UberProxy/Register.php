<?php

namespace UberProxy;

class Register extends Command
{
    protected $maxreq = 20;
    protected $routes = array();
    protected $routes_regex = array();
    protected $extra  = array();
    protected $hosts  = array();
    protected $worker = "";
    protected $rcode = 0;
    protected $plugins = array();
    protected $rewriteHost = null;
    protected $rewriteRoutes = array();


    public function getAction()
    {
        return 'register';
    }

    public function rewriteHost($to)
    {
        $this->rewriteHost = $to;
        return $this;
    }

    public function addRoute($regex)
    {
        $this->routes[] = $regex;
        return $this;
    }

    public function addRegexRoute($regex)
    {
        $this->routes_regex[] = $regex;
        return $this;
    }

    public function rewriteRoute($regex, $to)
    {
        $this->rewriteRoutes[$regex] = $to;
        return $this;
    }

    public function addHost($host)
    {
        $this->hosts[] = $host;
        return $this;
    }

    public function worker($worker)
    {
        $this->worker = $worker;
        return $this;
    }
    
    public function extra(Array $extra)
    {
        $this->extra = $extra;
        return $this;
    }

    public function enablePlugin($name)
    {
        $this->plugins[] = $name;
        return $this;
    }

    public function toArray()
    {
        return array(
            'worker'   => $this->worker,
            'hostname' => $this->hosts,
            'extra'    => $this->extra,
            'maxreq'   => $this->maxreq,
            'rewrite'  => array(
                'host' => $this->rewriteHost,
                'routes' => $this->rewriteRoutes,
            ),
            'plugins' => $this->plugins,
            'routes' => $this->routes,
            'routes_regex' => $this->routes_regex,
        );
    }
}
