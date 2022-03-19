<?php
// -- 
require __DIR__ . '/../../vendor/autoload.php';

// --
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

// -- 
$request = $_SERVER['REQUEST_METHOD'];
$response = array();

// -- Method
switch ($request) {
    // --
    case 'GET':
        // --
        $keyPair = sodium_crypto_sign_keypair();
        // --
        $privateKey = base64_encode(sodium_crypto_sign_secretkey($keyPair));
        $publicKey = base64_encode(sodium_crypto_sign_publickey($keyPair));
        // --
        $response = array(
            'status' => 'OK',
            'data' => array(
                'private_key' => $privateKey,
                'public_key' => $publicKey
            ),
            'msg' => 'Keys generadas.'
        );

        // --
        break;

    default:
        // --
        $response = array('status' => 'ERROR', 'data' => array(), 'msg' => 'Método no permitido, verificar.');
        // --
        break;
}

// --
header('Content-Type: application/json');
echo json_encode($response);
