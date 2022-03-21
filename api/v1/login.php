<?php
// --
require __DIR__ . '/../../src/core/app.php';
// -- 
$request = $_SERVER['REQUEST_METHOD'];
$response = array();

// -- Method
switch ($request) {
    // --
    case 'POST':
        // --
        $input = json_decode(file_get_contents('php://input'), true);
        if (empty($input)) {
            $input = filter_input_array(INPUT_POST);
        }
        // -- 
        if (isset($input['user']) && isset($input['password'])) {
            // --
            $user = trim($input['user']);
            $password = trim($input['password']);
            // --
            $bind = array(
                'user' => $user,
                'password' => $password,
                'status' => 1
            );
            // --
            try {
                // --
                $sql = 'SELECT 
                            id,
                            name,
                            user,
                            status
                        FROM user
                        WHERE
                            user = :user AND 
                            password = :password AND 
                            status = :status';
                // --
                $result = $pdo->fetchOne($sql, $bind);
                // --
                if ($result) {
                    // -- JWT
                    $time = time();
                    $payload = array(
                        'iat' => $time, // Tiempo que inició el token
                        'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora) (60*60)
                        'data' => $result
                    );

                    // --
                    $token = $functions->encode_token($jwt, $payload, $config['jwt']['private_key']);

                    // --
                    $response = array(
                        // --
                        'status' => 'OK', 
                        'data' => array(
                            'user' => $result,
                            'token' => $token
                        ), 
                        'msg' => 'Verificación correcta.'
                    );
                } else {
                    // --
                    $response = array('status' => 'ERROR', 'msg' => 'Verificar credenciales.');
                }
            } catch (PDOException $e) {
                // --
                $response = array('status' => 'ERROR', 'msg' => $e->getMessage());
            }
        } else {
            $response = array('status' => 'ERROR', 'msg' => 'No se enviaron los párametros necesarios, verificar.');
        }
        // --
        break;

    case 'GET':
        // --
        $input = filter_input_array(INPUT_GET);
        // --
        $response = array('status' => 'OK', 'data' => array(), 'msg' => '');
        // --
        break;

    case 'PUT':
        // --
        $input = json_decode(file_get_contents('php://input'), true);
        // --
        $response = array('status' => 'OK', 'data' => array(), 'msg' => '');
        // --
        break;

    case 'DELETE':
        // --
        $input = json_decode(file_get_contents('php://input'), true);
        // --
        $response = array('status' => 'OK', 'data' => array(), 'msg' => '');
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
