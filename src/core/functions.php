<?php
// --
class Functions {
    /**
     * Encode Json Web Token (Firebase)
     * @payload
     */
    public function encode_token($jwt, $payload, $private_key) {
        // --
        $token = $jwt::encode($payload, $private_key, 'EdDSA');
        // --
        return $token;
    }

    /**
     * Verified token
     * @JWT
     */
    public function verified_token($jwt, $token, $public_key) {
        // --
        if (isset($token)) {
            // --
            if (!empty($token)) {
                // --
                try {
                    // --
                    $jwt::decode($token, $public_key);
                    // --
                    $result = array(
                        'status' => 'OK',
                        'msg' => 'El token de seguridad sigue activo.',
                        'data' => array()
                    );
                } catch (Exception $e) {
                    // --
                    $result = array(
                        'status' => 'TOKEN_ERROR',
                        'msg' => 'El token ha expirado, vuelva a iniciar sesión.',
                        'data' => array()
                    );
                }
            } else {
                // --
                $result = array(
                    'status' => 'ERROR',
                    'msg' => 'Las credenciales de autorización no se enviaron.',
                    'data' => array()
                );
            }
            // --
        } else {
            // --
            $result = array(
                'status' => 'ERROR',
                'msg' => 'Las credenciales de autorización no se enviaron.',
                'data' => array()
            );
        }
        // --
        return $result;
    }
}