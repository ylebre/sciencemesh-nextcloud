<?php
/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\ScienceMesh\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
    'routes' => [
        ['name' => 'storage#createHome', 'url' => '/~{userId}/CreateHome', 'verb' => 'POST'],
        ['name' => 'storage#listFolder', 'url' => '/~{userId}/ListFolder', 'verb' => 'POST'],
        ['name' => 'storage#initiateUpload', 'url' => '/~{userId}/InitiateUpload', 'verb' => 'POST'],
        ['name' => 'storage#upload', 'url' => '/~{userId}/Upload', 'verb' => 'POST'],
        ['name' => 'storage#handleUpload', 'url' => '/~{userId}/Upload/{path}', 'verb' => 'PUT'],
        ['name' => 'storage#getMD', 'url' => '/~{userId}/GetMD', 'verb' => 'POST'],

        ['name' => 'storage#handleGet', 'url' => '/~{userId}/{path}', 'verb' => 'GET', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handlePost', 'url' => '/~{userId}/{path}', 'verb' => 'POST', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handlePut', 'url' => '/~{userId}/{path}', 'verb' => 'PUT', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handleDelete', 'url' => '/~{userId}/{path}', 'verb' => 'DELETE', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handleHead', 'url' => '/~{userId}/{path}', 'verb' => 'HEAD', 'requirements' => array('path' => '.+')],

        ['name' => 'app#appLauncher', 'url' => '/', 'verb' => 'GET'],
    ]
];
