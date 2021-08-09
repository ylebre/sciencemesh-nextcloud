<?php
namespace OCA\ScienceMesh\AppInfo;

use \OCP\AppFramework\App;
use \OCA\ScienceMesh\Service\UserService;
use \OCA\ScienceMesh\Plugins\ScienceMeshSearchPlugin;

class ScienceMeshApp extends App {

    public const APP_ID = 'sciencemesh';
    public const SHARE_TYPE_REMOTE = 6;
    
    public function __construct(){
        parent::__construct(self::APP_ID);

        $container = $this->getContainer();
        $container->registerService('UserService', function($c) {
            return new \OCA\ScienceMesh\Service\UserService(
                $c->query('UserSession')
            );
        });
        $container->registerService('UserSession', function($c) {
            return $c->query('ServerContainer')->getUserSession();
        });

        // currently logged in user, userId can be gotten by calling the
        // getUID() method on it
        $container->registerService('User', function($c) {
            return $c->query('UserSession')->getUser();
        });

        $collaboration = $container->get('OCP\Collaboration\Collaborators\ISearch');
        $collaboration->registerPlugin(['shareType' => 'SHARE_TYPE_REMOTE', 'class' => ScienceMeshSearchPlugin::class]);
    }
}