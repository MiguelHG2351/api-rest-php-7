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
            }
        }
        
        break;

    case 'POST':
        
        break;
    case 'PUT':
        
        break;

    case 'DELETE':
        
        break;
    
    default:
        echo strtoupper( $_SERVER['REQUEST_METHOD']); 
        break;
}