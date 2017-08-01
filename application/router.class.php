<?php

class router {
     /*
     * @the registry
     */
     private $registry;
     /*
     * @the controller path
     */
     private $path;
     private $args = array();
     public $file;
     public $controller;
     public $action;
     public $id; 
     function __construct($registry) {
            $this->registry = $registry;
     }
     /**
     *
     * @set controller directory path
     *
     * @param string $path
     *
     * @return void
     *
     */
     function setPath($path) {
    
        /*** check if path i sa directory ***/
        if (is_dir($path) == false){
            throw new Exception ('Invalid controller path: `' . $path . '`');
        }
        /*** set the path ***/
        $this->path = $path;
    }
    
    
     /**
     *
     * @load the controller
     * @access public
     * @return void
     *
     */
     public function loader(){
        
        /*** check the route ***/
        $this->getController();
        /*** if the file is not there diaf ***/
        if (is_readable($this->file) == false){
            $this->file = $this->path.'/error404.php';
            $this->controller = 'error404';
        }
        /*** include the controller ***/
        include $this->file;
        /*** a new controller class instance ***/
        $class = $this->controller . 'Controller';
        $controller = new $class($this->registry);
        /*** check if the action is callable ***/
        if (is_callable(array($controller, $this->action)) == false){
            $action = 'index';
        }else{
            $action = $this->action;
        }

           $config_obj = new configModel();
           $config = $config_obj->_get();
           $this->config = $config[0]; 
           
           $agenda_obj = new agendaModel();
           $agenda_hoy = $agenda_obj->_listHoy();
           $this->agenda_hoy = $agenda_hoy;            

        /*** run the action ***/
        $controller->$action();
     }
    
    
     /**
     *
     * @get the controller
     *
     * @access private
     *
     * @return void
     *
     */
    private function getController(){

        $Uri = new URI();
        $this->controller = $Uri->getSegment(2,'index'); 
        $this->action = $Uri->getSegment(3,'index');
        $this->id = $Uri->getSegment(4,'-1'); 
		$modulos_no_login = array('index','otro');
        if (!isset($_SESSION['__ID_USER'])){
            if (!in_array ($this->controller, $modulos_no_login)){
                /*if (!isset($_SESSION['redir'])){
                    $_SESSION['redir'] = $_SERVER['REDIRECT_URL'];
                } */
                header('location:'.__SITIO.'/index.php/index/login/');
            }
        } 
        /*** set the file path ***/
        $this->file = $this->path .'/'. $this->controller . 'Controller.php';
    }
}

class URI
{
   var $uri;
   var $segments = array();

   function __construct()
   {
      $uri = $_SERVER['REQUEST_URI'];
      $pieces = explode("index.php",$uri);
      $this->uri = $pieces[1]; 
      $this->segments = explode('/',$this->uri);
   }

   function getSegment($id,$default = false)
   {
      $id = (int)($id - 1); //if you type 1 then it needs to be 0 as arrays are zerobased
      return isset($this->segments[$id]) ? $this->segments[$id] : $default;
   }
}

?>