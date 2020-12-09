<?php


// Definimos los recursos disponibles
$allowedResourceTypes = [
    'books',
    'authors',
    'genres',
];

// Validamos que el recurso este disponible
$resouserType = $_GET['resource_type'];

if( !in_array( $resouserType, $allowedResourceTypes ) ) {

    http_response_code( 400 );
    die;
};

$books = [
    1 => [
        'titulo' => 'Lo que el viento se llevo',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
    2 => [
        'titulo' => 'Pacman',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
    3 => [
        'titulo' => 'Lo que el viento se llevo',
        'id_autor' => 3,
        'id_genero' => 3,
    ],
];

header('Content-Type: aplication/json');

// Obtenemos el id del recursos buscado
$resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';

// Generamos la respuesta ausmiento que el pedido es correcto
switch (strtoupper( $_SERVER['REQUEST_METHOD'])) {
    case 'GET':
        if( empty($resourceId) ) {
            echo json_encode($books, true);
        } else {
            if( array_key_exists( $resourceId, $books ) ) {
                echo json_encode( $books[ $resourceId ] );
            } else {
                http_response_code(404);
            }
        }
        
        break;

    case 'POST':
        $json = file_get_contents('php://input');
        $books[] = json_decode($json, true);

        // echo array_keys($books)[count($books)-1];

        echo json_encode($books);

        break;
    case 'PUT':
        // Validamos que el recurso exista
        if(!empty($resourceId) && array_key_exists($resourceId, $books) ) {
            // entrada cruda
            $json = file_get_contents('php://input');
            $books[$resourceId] = json_decode($json, true);

            echo json_encode($books);
        }

        break;

    case 'DELETE':
        // Validamos que el recurso exista
        if(!empty($resourceId) && array_key_exists($resourceId, $books) ) {
            unset($books[ $resourceId ]);
        }

        echo json_encode($books);
        
        break;
    
    default:
        echo strtoupper( $_SERVER['REQUEST_METHOD']); 
        break;
}