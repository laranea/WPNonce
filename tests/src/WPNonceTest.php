<?php

namespace Laranea\WPNonce\Tests;

require_once 'functions.php';

use PHPUnit\Framework\TestCase;
use Laranea\WPNonce\WPNonce;

class WPNonceTest extends TestCase
{
    public function testGenerateReturnsInstance()
    {
        $nonce = WPNonce::generate( 'test' );
        $this->assertInstanceOf( 'Laranea\\WPNonce\\WPNonce', $nonce );
    }

    public function testGenerateHasNonce()
    {
        $nonce = WPNonce::generate( 'test' );
        $this->assertEquals( 'this-is-a-nonce', $nonce->getNonce() );
    }

    public function testGenerateHasAction()
    {
        $nonce = WPNonce::generate( 'test' );
        $this->assertEquals( 'test', $nonce->getAction() );
    }

    public function testGenerateHasName()
    {
        $nonce = WPNonce::generate( 'test' );
        $this->assertEquals( '_wpnonce', $nonce->getName() );
    }

    public function testImport()
    {
        $_REQUEST = array(
            '_wpnonce' => 'this-is-a-nonce',
        );
        $nonce = WPNonce::import( 'test' );
        $this->assertInstanceOf( 'Laranea\\WPNonce\\WPNonce', $nonce );
        $this->assertEquals( 'this-is-a-nonce', $nonce->getNonce() );
    }

    public function testVerifyCalledWithNonce()
    {
        $nonce = WPNonce::generate( 'test' );

        $_REQUEST = array(
            '_wpnonce' => 'this-is-a-nonce',
        );
        $this->assertTrue( $nonce->verify() );
    }

    public function testVerifyCalledWithoutNonce()
    {
        $nonce = WPNonce::generate( 'test' );

        $_REQUEST = array();
        $this->assertFalse( $nonce->verify() );
    }

    public function testVerifyAdmin()
    {
        $nonce = WPNonce::generate( 'test' );
        $this->assertTrue( $nonce->verifyAdmin() );
    }

    public function testVerifyAjax()
    {
        $nonce = WPNonce::generate( 'test' );
        $this->assertTrue( $nonce->verifyAjax() );
    }

}
