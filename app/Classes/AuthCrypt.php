<?php
/**
* Created by PhpStorm.
* User: simon.proud@ro.ru
* Date: 12.12.18
* Time: 18:36
*/

namespace App\Classes;


class AuthCrypt
{
    private $key;

    public  function  __construct($key)
    {
    $this->key = $key;
    }

    public function encode($string){
        $plaintext = $string;
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $this->key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary=true);
        $encString = base64_encode( $iv.$hmac.$ciphertext_raw );
        return $encString;
    }

    public function decode($encString){

        $c = base64_decode($encString);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $plaintext = openssl_decrypt($ciphertext_raw, $cipher, $this->key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary=true);
        if (hash_equals($hmac, $calcmac))
        {
            return $plaintext;
        }
    }
}