<?php
namespace OCA\ScienceMesh\Controller;

use OCA\ScienceMesh\ServerConfig;
use OCA\ScienceMesh\PlainResponse;
use OCA\ScienceMesh\ResourceServer;
use OCA\ScienceMesh\NextcloudAdapter;

use OCP\IRequest;
use OCP\IUserManager;
use OCP\IURLGenerator;
use OCP\ISession;
use OCP\IConfig;

use OCP\Files\IRootFolder;
use OCP\Files\IHomeStorage;
use OCP\Files\SimpleFS\ISimpleRoot;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\Response;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Http\ContentSecurityPolicy;
use OCP\AppFramework\Controller;

class StorageController extends Controller {
	/* @var IURLGenerator */
	private $urlGenerator;

	/* @var ISession */
	private $session;
	
	public function __construct($AppName, IRootFolder $rootFolder, IRequest $request, ISession $session, IUserManager $userManager, IURLGenerator $urlGenerator, $userId, IConfig $config, \OCA\ScienceMesh\Service\UserService $UserService) 
	{
		parent::__construct($AppName, $request);
		require_once(__DIR__.'/../../vendor/autoload.php');
		$this->config = new \OCA\ScienceMesh\ServerConfig($config, $urlGenerator, $userManager);
		$this->rootFolder = $rootFolder;
		$this->request     = $request;
		$this->urlGenerator = $urlGenerator;
		$this->session = $session;
	}

	private function getFileSystem() {
		// Create the Nextcloud Adapter
		$adapter = new NextcloudAdapter($this->sciencemeshFolder);
		$filesystem = new \League\Flysystem\Filesystem($adapter);
		return $filesystem;
	}

	private function getStorageUrl($userId) {
		$storageUrl = $this->urlGenerator->getAbsoluteURL($this->urlGenerator->linkToRoute("sciencemesh.storage.handleHead", array("userId" => $userId, "path" => "foo")));
		$storageUrl = preg_replace('/foo$/', '', $storageUrl);
		return $storageUrl;
	}

	private function initializeStorage($userId) {
		$this->userFolder = $this->rootFolder->getUserFolder($userId);
		if (!$this->userFolder->nodeExists("sciencemesh")) {
			$this->userFolder->newFolder("sciencemesh"); // Create the Sciencemesh directory for storage if it doesn't exist.
		}
		$this->sciencemeshFolder = $this->userFolder->get("sciencemesh");
		$this->filesystem = $this->getFileSystem();
		$this->baseUrl = $this->getStorageUrl($userId);
	}
	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function handleRequest($userId, $path) {
		$this->rawRequest = \Laminas\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
		$this->response = new \Laminas\Diactoros\Response();

		$this->initializeStorage($userId);
		$this->resourceServer = new ResourceServer($this->filesystem, $this->response);

		$request = $this->rawRequest;
		$baseUrl = $this->getStorageUrl($userId);		
		$this->resourceServer->setBaseUrl($baseUrl);
		$response = $this->resourceServer->respondToRequest($request);	
		return $this->respond($response);
	}
	
	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function handleGet($userId, $path) {	
		return $this->handleRequest($userId, $path);
	}
	
	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function handlePost($userId, $path) {
		return $this->handleRequest($userId, $path);
	}
	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function handlePut() { // $userId, $path) {
		// FIXME: Adding the correct variables in the function name will make nextcloud
		// throw an error about accessing put twice, so we will find out the userId and path from $_SERVER instead;
		
		// because we got here, the request uri should look like:
		// /index.php/apps/sciencemesh/~{userId}/{path}
		$pathInfo = explode("~", $_SERVER['REQUEST_URI']);
		$pathInfo = explode("/", $pathInfo[1], 2);
		$userId = $pathInfo[0];
		$path = $pathInfo[1];

		return $this->handleRequest($userId, $path);
	}
	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function handleDelete($userId, $path) {
		return $this->handleRequest($userId, $path);
	}
	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function handleHead($userId, $path) {
		return $this->handleRequest($userId, $path);
	}
	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function handlePatch($userId, $path) {
		return $this->handleRequest($userId, $path);
	}

	private function respond($response) {
		$statusCode = $response->getStatusCode();
		$response->getBody()->rewind();
		$headers = $response->getHeaders();

		$body = $response->getBody()->getContents();
		error_log($body);
		$result = new PlainResponse($body);

		foreach ($headers as $header => $values) {
			foreach ($values as $value) {
				$result->addHeader($header, $value);
			}
		}
		
		$result->setStatus($statusCode);
		return $result;
	}

	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function createHome($userId) {
		$this->initializeStorage($userId);
		$response = new \Laminas\Diactoros\Response();
                $response->getBody()->write(json_encode("OK"));
                $response = $response->withHeader("Content-type", "application/json");
                $response = $response->withStatus(200);
                return $this->respond($response);
	}

	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function listFolder($userId) {
		error_log(json_encode($userId));
		error_log(json_encode($_GET));
		error_log(json_encode($_POST));
		$this->initializeStorage($userId);
		$request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
		$response = new \Laminas\Diactoros\Response();
		$path = "/";
		$contents = $this->listDirectory($path);
                if ($contents !== false) {
                        $response->getBody()->write($contents);
                        $response = $response->withHeader("Content-type", "application/json");
                        $response = $response->withStatus(200);
                }
                return $this->respond($response);
	}

	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function initiateUpload($userId) {
		$this->initializeStorage($userId);
		$request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
		$response = new \Laminas\Diactoros\Response();
                $response->getBody()->write(json_encode("OK"));
                $response = $response->withHeader("Content-type", "application/json");
                $response = $response->withStatus(200);
                return $this->respond($response);
	}

	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function upload($userId) {
		$this->initializeStorage($userId);
		$request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
		$response = new \Laminas\Diactoros\Response();
                $response->getBody()->write(json_encode("OK"));
                $response = $response->withHeader("Content-type", "application/json");
                $response = $response->withStatus(200);
                return $this->respond($response);
	}

	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function handleUpload($userId, $path) {
		$this->initializeStorage($userId);
		$request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
		$response = new \Laminas\Diactoros\Response();

		$filesystem = $this->filesystem;
		$contents = $request->getBody()->getContents();
		if ($filesystem->has($path)) {
			$success = $filesystem->update($path, $contents);
			if ($success) {
				$response = $response->withStatus(200);
			} else {
				$response = $response->withStatus(500);
			}
		} else {
			$success = $filesystem->write($path, $contents);
			if ($success) {
				$response = $response->withStatus(201);
			} else {
				$response = $response->withStatus(500);
			}
		}
                return $this->respond($response);
	}

	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function getMD($userId) {
		// FIXME: Get the path from the request;
		
		$this->initializeStorage($userId);
		$request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
		$response = new \Laminas\Diactoros\Response();

		$path = "/test.txt";
		$filesystem = $this->filesystem;
		if ($filesystem->has($path)) {
			$metadata = $filesystem->getMetaData($path);
			$response->getBody()->write(json_encode($metadata));
			$response = $response->withStatus(200);
			$response = $response->withHeader("Content-type", "application/json");
		} else {
			$response = $response->withStatus(404);
		}
                return $this->respond($response);
	}

	private function listDirectory($path) {
		$filesystem = $this->filesystem;
		if ($path == "/") {
			$listContents = $filesystem->listContents(".");// FIXME: this is a patch to make it work for Solid-Nextcloud; we should be able to just list '/';
		} else {
			$listContents = $filesystem->listContents($path);
		}
		return json_encode($listContents, JSON_PRETTY_PRINT);
	}
}
