<?php # -*- coding: utf-8 -*-

namespace Laranea\WPNonce;

class WPNonceURL extends AbstractWPNonce
{
    public static function generate($url, $action = -1, $name = '_wpnonce')
    {
        $instance = new static();
        $instance->setOutput(wp_nonce_url( $url, $action, $name ));

        $matched = preg_match('/' . preg_quote( $name ) . '=(.+)$/', $instance->getOutput(), $matches);

        if ($matched)
        {
            $instance->setNonce($matches[1]);
        }

        $instance->setAction($action);
        $instance->setName($name);
        return $instance;
    }
}
