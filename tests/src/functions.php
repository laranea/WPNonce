<?php

function wp_create_nonce($action)
{
    return 'this-is-a-nonce';
}

function wp_verify_nonce($nonce, $action=-1)
{
    return true;
}

function wp_nonce_url($url,$action = -1, $name = '_wpnonce')
{
    return "$url?$name=this-is-a-nonce";
}

function wp_nonce_field($action = -1, $name = "_wpnonce", $referer = true , $echo = true)
{
    $nonce_field = '<input type="hidden" id="' . $name . '" name="' . $name . '" value="this-is-a-nonce" />';

    if ( $referer )
        $nonce_field .= '<input type="hidden" name="_wp_http_referer" value="/" />';

    return $nonce_field;
}

function check_admin_referer($action = -1, $query_arg = '_wpnonce')
{
    return true;
}

function check_ajax_referer($action = -1, $query_arg = false, $die = true)
{
    return true;
}
