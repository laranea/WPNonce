<?php # -*- coding: utf-8 -*-

namespace Laranea\WPNonce;

class WPNonce extends AbstractWPNonce
{
    public static function generate($action = -1)
    {
        $instance = new static();
        $instance->setNonce(wp_create_nonce($action));
        $instance->setAction($action);
        $instance->setName('_wpnonce');
        $instance->setOutput($instance->getNonce());

        return $instance;
    }

    public static function generateAYS($action)
    {
        wp_nonce_ays($action);
    }
}
