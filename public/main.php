<?php 

class Http{

	public static $instance;


	public function __construct(){
		$http = new swoole_http_server("127.0.0.1", 9501);;

		$http->on('Start',array($this,'onStart')) ;
		$http->on('WorkerStart' , array( $this , 'onWorkerStart'));
		$http->on('request', function ($request, $response) {
			if( isset($request->server) ) {
				foreach ($request->server as $key => $value) {
                    unset($_SERVER[ strtoupper($key) ]);
					$_SERVER[ strtoupper($key) ] = $value;
				}
			}
			if( isset($request->header) ) {
				foreach ($request->header as $key => $value) {
                    unset($_SERVER[ strtoupper($key) ]);
					$_SERVER[ strtoupper($key) ] = $value;
				}
			}
            unset($_GET);
			if( isset($request->get) ) {
				foreach ($request->get as $key => $value) {
					$_GET[ $key ] = $value;
				}
			}
            unset($_POST);
			if( isset($request->post) ) {
				foreach ($request->post as $key => $value) {
					$_POST[ $key ] = $value;
				}
			}
            unset($_COOKIE);
			if( isset($request->cookie) ) {
				foreach ($request->cookie as $key => $value) {
					$_COOKIE[ $key ] = $value;
				}
			}
            unset($_FILES);
			if( isset($request->files) ) {
				foreach ($request->files as $key => $value) {
					$_FILES[ $key ] = $value;
				}
			}
			ob_start();
            vendor\bootstrap\App::run();
		    $result = ob_get_contents();
		  	ob_end_clean();
		  	$response->end($result);

		});
		$http->start();
	}

	public function onStart(){
		swoole_set_process_name('swoole_master') ;
		
	}



	public function onWorkerStart(){
		require_once '../vendor/bootstrap/bootstrap.php';
	}



	public static function getInstance() {
		if (!self::$instance) {
            self::$instance = new Http();
        }
        return self::$instance;
	}


}





Http::getInstance();










 ?>