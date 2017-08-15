<?php

namespace Laranea\WPNonce\Tests;

require_once 'functions.php';

use PHPUnit\Framework\TestCase;
use Laranea\WPNonce\WPNonceField;

class WPNonceFieldTest extends TestCase
{

    public function testGenerateReturnsInstance()
    {
        $nonce = WPNonceField::generate('test');
        $this->assertInstanceOf('Laranea\\WPNonce\\WPNonceField', $nonce);
    }

    public function testGenerateHasNonce()
    {
        $nonce = WPNonceField::generate('test');
        $this->assertEquals('this-is-a-nonce', $nonce->getNonce());
    }

    public function testGenerateHasAction()
    {
        $nonce = WPNonceField::generate('test');
        $this->assertEquals('test', $nonce->getAction());
    }

    public function testGenerateHasName()
    {
        $nonce = WPNonceField::generate('test');
        $this->assertEquals('_wpnonce', $nonce->getName());
    }

    public function testGenerateHasNameWhenSpecified()
    {
        $nonce = WPNonceField::generate('test', 'my-nonce');
        $this->assertEquals('my-nonce', $nonce->getName());
    }

    public function testGenerateHasOutputWithReferer()
    {
        $nonce = WPNonceField::generate('test');
        $this->assertEquals('<input type="hidden" id="_wpnonce" name="_wpnonce" value="this-is-a-nonce" /><input type="hidden" name="_wp_http_referer" value="/" />',
            $nonce->getOutput());
    }

    public function testGenerateHasOutputWithoutReferer()
    {
        $nonce = WPNonceField::generate('test', '_wpnonce', false);
        $this->assertEquals('<input type="hidden" id="_wpnonce" name="_wpnonce" value="this-is-a-nonce" />',
            $nonce->getOutput());
    }

    public function testVerifyCalledWithNonce()
    {
        $nonce = WPNonceField::generate('test');

        $_REQUEST = array(
            '_wpnonce' => 'this-is-a-nonce',
        );
        $this->assertTrue($nonce->verify());
    }

    public function testVerifyCalledWithoutNonce()
    {
        $nonce = WPNonceField::generate('test');

        $_REQUEST = array();
        $this->assertFalse($nonce->verify());
    }

    public function testVerifyAdmin()
    {
        $nonce = WPNonceField::generate('test');
        $this->assertTrue($nonce->verifyAdmin());
    }

    public function testVerifyAjax()
    {
        $nonce = WPNonceField::generate('test');
        $this->assertTrue($nonce->verifyAjax());
    }

}
