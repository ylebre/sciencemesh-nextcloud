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
        ['name' => 'reva#AddGrant', 'url' => '/~{userId}/AddGrant', 'verb' => 'POST'],
        ['name' => 'reva#CreateDir', 'url' => '/~{userId}/CreateDir', 'verb' => 'POST'],
        ['name' => 'reva#CreateHome', 'url' => '/~{userId}/CreateHome', 'verb' => 'POST'],
        ['name' => 'reva#CreateReference', 'url' => '/~{userId}/CreateReference', 'verb' => 'POST'],
        ['name' => 'reva#Delete', 'url' => '/~{userId}/Delete', 'verb' => 'POST'],
        ['name' => 'reva#EmptyRecycle', 'url' => '/~{userId}/EmptyRecycle', 'verb' => 'POST'],
        ['name' => 'reva#GetMD', 'url' => '/~{userId}/GetMD', 'verb' => 'POST'],
        ['name' => 'reva#GetPathByID', 'url' => '/~{userId}/GetPathByID', 'verb' => 'POST'],
        ['name' => 'reva#InitiateUpload', 'url' => '/~{userId}/InitiateUpload', 'verb' => 'POST'],
        ['name' => 'reva#ListFolder', 'url' => '/~{userId}/ListFolder', 'verb' => 'POST'],
        ['name' => 'reva#ListGrants', 'url' => '/~{userId}/ListGrants', 'verb' => 'POST'],
        ['name' => 'reva#ListRecycle', 'url' => '/~{userId}/ListRecycle', 'verb' => 'POST'],
        ['name' => 'reva#ListRevisions', 'url' => '/~{userId}/ListRevisions', 'verb' => 'POST'],
        ['name' => 'reva#Move', 'url' => '/~{userId}/Move', 'verb' => 'POST'],
        ['name' => 'reva#RemoveGrant', 'url' => '/~{userId}/RemoveGrant', 'verb' => 'POST'],
        ['name' => 'reva#RestoreRecycleItem', 'url' => '/~{userId}/RestoreRecycleItem', 'verb' => 'POST'],
        ['name' => 'reva#RestoreRevision', 'url' => '/~{userId}/RestoreRevision', 'verb' => 'POST'],
        ['name' => 'reva#SetArbitraryMetadata', 'url' => '/~{userId}/SetArbitraryMetadata', 'verb' => 'POST'],
        ['name' => 'reva#UnsetArbitraryMetadata', 'url' => '/~{userId}/UnsetArbitraryMetadata', 'verb' => 'POST'],
        ['name' => 'reva#UpdateGrant', 'url' => '/~{userId}/UpdateGrant', 'verb' => 'POST'],
        ['name' => 'reva#Upload', 'url' => '/~{userId}/Upload/{path}', 'verb' => 'PUT'],
        
/*        
        ['name' => 'storage#createHome', 'url' => '/~{userId}/CreateHome', 'verb' => 'POST'],
        ['name' => 'storage#listFolder', 'url' => '/~{userId}/ListFolder', 'verb' => 'POST'],
        ['name' => 'storage#initiateUpload', 'url' => '/~{userId}/InitiateUpload', 'verb' => 'POST'],
        ['name' => 'storage#upload', 'url' => '/~{userId}/Upload', 'verb' => 'POST'],
        ['name' => 'storage#handleUpload', 'url' => '/~{userId}/Upload/{path}', 'verb' => 'PUT'],
        ['name' => 'storage#getMD', 'url' => '/~{userId}/GetMD', 'verb' => 'POST'],
*/

        ['name' => 'storage#handleGet', 'url' => '/~{userId}/{path}', 'verb' => 'GET', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handlePost', 'url' => '/~{userId}/{path}', 'verb' => 'POST', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handlePut', 'url' => '/~{userId}/{path}', 'verb' => 'PUT', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handleDelete', 'url' => '/~{userId}/{path}', 'verb' => 'DELETE', 'requirements' => array('path' => '.+')],
        ['name' => 'storage#handleHead', 'url' => '/~{userId}/{path}', 'verb' => 'HEAD', 'requirements' => array('path' => '.+')],

        ['name' => 'app#appLauncher', 'url' => '/', 'verb' => 'GET'],
    ]
];
