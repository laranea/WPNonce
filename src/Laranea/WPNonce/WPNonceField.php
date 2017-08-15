<?php # -*- coding: utf-8 -*-

namespace Laranea\WPNonce;

class WPNonceField extends AbstractWPNonce
{
    public static function generate($action = -1, $name = '_wpnonce', $referer = true, $echo = true)
    {
        $instance = new static();
        $instance->setOutput(wp_nonce_field($action, $name, $referer, $echo));

        $matched = preg_match('/value="([^"]+)"/', $instance->getOutput(), $matches);

        if ($matched) {
            $instance->setNonce($matches[1]);
        }

        $instance->setAction($action);
        $instance->setName($name);

        return $instance;
    }
}
