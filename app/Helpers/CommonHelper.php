<?php
namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;

class CommonHelper {
    
    public static function encrip_password($string,$action = 'e') 
    {
        $secret_key = '23187SJAE382EJQW!2DSA';
        $secret_iv = '9IEJWQDJE3-123.DASW1';
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha512', $secret_key );
        $iv = substr( hash( 'sha512', $secret_iv ), 0, 16 );

        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
            //dd($output);
        }
        else if( $action == 'd' ) {
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }

        return $output;
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

