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
        $response = array('status' => 'OK', 'data' => array(), 'msg' => '');
        // --
        break;

    case 'GET':
        // --
        $input = filter_input_array(INPUT_GET);
        // --
        $response = $functions->verified_token($jwt, $_SERVER['HTTP_AUTHORIZATION'], $jwt_public_key);
        // --
        if ($response['status'] === 'OK') {
            // --
            if (isset($input['id'])) {
                // --
                $id = intval($input['id']);
                $bind = array('id' => $id);
                // --
                try {
                    // --
                    $sql = 'SELECT 
                                id,
                                name,
                                user,
                                status
                            FROM user 
                            WHERE id = :id';
                    // --
                    $result = $pdo->fetchAll($sql, $bind);
                    // --
                    if ($result) {
                        // --
                        $response = array('status' => 'OK', 'data' => $result, 'msg' => 'Registros encontrados en el sistema.');
                    } else {
                        // --
                        $response = array('status' => 'ERROR', 'data' => array(), 'msg' => 'No se encontraron registros en el sistema.');
                    }
                } catch (PDOException $e) {
                    // --
                    $response = array('status' => 'ERROR', 'data' => array(), 'msg' => $e->getMessage());
                }
            } else {
                // --
                try {
                    // --
                    $sql = 'SELECT 
                                id,
                                name,
                                user,
                                status
                            FROM user';
                    // --
                    $result = $pdo->fetchAll($sql);
                    // --
                    if ($result) {
                        // --
                        $response = array('status' => 'OK', 'data' => $result, 'msg' => 'Registros encontrados en el sistema.');
                    } else {
                        // --
                        $response = array('status' => 'ERROR', 'data' => array(), 'msg' => 'No se encontraron registros en el sistema.');
                    }
                } catch (PDOException $e) {
                    // --
                    $response = array('status' => 'ERROR', 'data' => array(), 'msg' => $e->getMessage());
                }
            }
        }

        // --
        break;

    case 'PUT':
        // --
        $input = json_decode(file_get_contents('php://input'), true);
        if (empty($input)) {
            $input = filter_input_array(INPUT_POST);
        }
        // --
        $response = array('status' => 'OK', 'data' => array(), 'msg' => '');
        // --
        break;

    case 'DELETE':
        // --
        $input = json_decode(file_get_contents('php://input'), true);
        if (empty($input)) {
            $input = filter_input_array(INPUT_POST);
        }
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