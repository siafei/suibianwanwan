<?php 
namespace vendor\bootstrap ;


class App{

    /**
     * 执行应用程序
     * @access public
     * @return void
     */
    static public function run() {
		$pathinfo = explode('/',$_SERVER['PATH_INFO']) ;
        $class = 'app\Controller\\'.ucfirst($pathinfo[1]).'Controller' ;
        $action = 'index' ;
        if (!empty($pathinfo[2])) {
        	$action = $pathinfo[2] ;
        }
        $module  =  new $class;
        try{
            self::invokeAction($module,$action);
        } catch (\ReflectionException $e) { 
            // 方法调用发生异常后 引导到__call方法处理
            $method = new \ReflectionMethod($module,'__call');
            $method->invokeArgs($module,array($action,''));
        }
        return ;
    }

    public static function invokeAction($module,$action){
	if(!preg_match('/^[A-Za-z](\w)*$/',$action)){
		// 非法操作
		throw new \ReflectionException();
	}
	//执行当前操作
	$method =   new \ReflectionMethod($module, $action);
	if($method->isPublic() && !$method->isStatic()) {
		$class  =   new \ReflectionClass($module);
		$method->invoke($module);
	}else{
		// 操作方法不是Public 抛出异常
		throw new \ReflectionException();
	}
    }

}






























 ?>