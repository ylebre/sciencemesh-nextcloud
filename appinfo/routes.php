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
        ['name' => 'storage#handleGet', 'url' => '/@{userId}/{path}', 'verb' => 'GET', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handlePost', 'url' => '/@{userId}/{path}', 'verb' => 'POST', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handlePut', 'url' => '/@{userId}/{path}', 'verb' => 'PUT', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handleDelete', 'url' => '/@{userId}/{path}', 'verb' => 'DELETE', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handlePatch', 'url' => '/@{userId}/{path}', 'verb' => 'PATCH', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handleHead', 'url' => '/@{userId}/{path}', 'verb' => 'HEAD', 'requirements' => array('path' => '.+')],

        ['name' => 'app#appLauncher', 'url' => '/', 'verb' => 'GET'],
    ]
];
