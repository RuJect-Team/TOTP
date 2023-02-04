<?php

function TOTP($secret) {
    $index = floor(time() / 30);
    $key = hash_hmac('sha1', pack("N", $index), $secret, true);
    $offset = ord($key[19]) & 0xf;
    $code = (((ord($key[$offset + 0]) & 0x7f) << 24) | ((ord($key[$offset + 1]) & 0xff) << 16) | ((ord($key[$offset + 2]) & 0xff) << 8) | (ord($key[$offset + 3]) & 0xff)) % 1000000;
    return str_pad($code, 6, "0", STR_PAD_LEFT);
}