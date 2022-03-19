<?php  
// -- Time Zone
date_default_timezone_set('America/Lima');

// --
$config = array(
    // --
    'database' => array(
        // --
        'connection' => array(
            'db_host' => '127.0.0.1',
            'db_port' => 3306,
            'db_user' => 'root',
            'db_pass' => '',
            'db_name' => 'db_api_rest_php',
        )
    ),
    'jwt' => array(
        // -- It is necessary to generate a private and public key from the keys.php service (GET)
        'private_key' => 'Paste the generated private key here',
        'public_key' => 'Paste the generated public key here'
    )
);