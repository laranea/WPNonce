<?php

namespace Laranea\WPNonce\Tests;

require_once 'functions.php';

use PHPUnit\Framework\TestCase;
use Laranea\WPNonce\WPNonceURL;

class WPNonceURLTest extends TestCase
{

    public function testGenerateReturnsInstance()
    {
        $nonce = WPNonceURL::generate('http://www.example.com', 'test');
        $this->assertInstanceOf('Laranea\\WPNonce\\WPNonceURL', $nonce);
    }

    public function testGenerateHasNonce()
    {
        $nonce = WPNonceURL::generate('http://www.example.com', 'test');
        $this->assertEquals('this-is-a-nonce', $nonce->getNonce());
    }

    public function testGenerateHasAction()
    {
        $nonce = WPNonceURL::generate('http://www.example.com', 'test');
        $this->assertEquals('test', $nonce->getAction());
    }

    public function testGenerateHasName()
    {
        $nonce = WPNonceURL::generate('http://www.example.com', 'test');
        $this->assertEquals('_wpnonce', $nonce->getName());
    }

    public function testGenerateHasNameWhenSpecified()
    {
        $nonce = WPNonceURL::generate('http://www.example.com', 'test', 'my-nonce');
        $this->assertEquals('my-nonce', $nonce->getName());
    }

    public function testGenerateHasOutput()
    {
        $nonce = WPNonceURL::generate('http://www.example.com', 'test');
        $this->assertEquals('http://www.example.com?_wpnonce=this-is-a-nonce', $nonce->getOutput());
    }

    public function testVerifyCalledWithNonce()
    {
        $nonce = WPNonceURL::generate('test');

        $_REQUEST = array(
            '_wpnonce' => 'this-is-a-nonce',
        );
        $this->assertTrue($nonce->verify());
    }

    public function testVerifyCalledWithoutNonce()
    {
        $nonce = WPNonceURL::generate('test');

        $_REQUEST = array();
        $this->assertFalse($nonce->verify());
    }

    public function testVerifyAdmin()
    {
        $nonce = WPNonceURL::generate('test');
        $this->assertTrue($nonce->verifyAdmin());
    }

    public function testVerifyAjax()
    {
        $nonce = WPNonceURL::generate('test');
        $this->assertTrue($nonce->verifyAjax());
    }

}
