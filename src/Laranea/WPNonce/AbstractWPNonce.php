<?php # -*- coding: utf-8 -*-

namespace Laranea\WPNonce;

abstract class AbstractWPNonce
{

    protected $nonce;
    protected $action;
    protected $name;
    protected $output;

    protected function __construct()
    {
        $this->name = '_wpnonce';
    }

    public static function import($action, $name = '_wpnonce')
    {
        $instance = new static();
        if (isset($_REQUEST[$name])) {
            $instance->setNonce($_REQUEST[$name]);
        }
        $instance->setAction($action);
        $instance->setName($name);
        return $instance;
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function setOutput($output)
    {
        $this->output = $output;
    }

    public function verify()
    {
        if (isset($_REQUEST[$this->getName()])) {
            return wp_verify_nonce($this->getNonce(), $this->getAction());
        } else {
            return false;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getNonce()
    {
        return $this->nonce;
    }

    public function setNonce($nonce)
    {
        $this->nonce = $nonce;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function verifyAdmin()
    {
        return check_admin_referer($this->getAction(), $this->getName());
    }

    public function verifyAjax($die = true)
    {
        return check_ajax_referer($this->getAction(), $this->getName(), $die);
    }

    public function __toString()
    {
        return $this->output;
    }
}
