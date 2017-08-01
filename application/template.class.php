<?php
Class Template {
/*
 * @the registry
 * @access private
 */
    private $registry;
    /*
     * @Variables array
     * @access private
     */
    private $vars = array();
    /**
     *
     * @constructor
     * @access public
     * @return void
     *
     */
    function __construct($registry) {
        $this->registry = $registry;
    }

     function show($name, $vars = array()) {
        $path = __SITE_PATH . '/views' . '/' . $name . '.php';
        if (file_exists($path) == false){
            throw new Exception('Template not found in '. $path);
            return false;
        }
            
            $name_site = $this->registry->router->config['name_site'];
            $show_login = $this->registry->router->config['show_login'];
            $lenguaje_automatic = $this->registry->router->config['lenguaje_automatic'];
            $lenguaje = $this->registry->router->config['lenguaje'];
            $order_list_directorio = $this->registry->router->config['order_list_directorio'];
            $order_list_caso = $this->registry->router->config['order_list_caso'];  
            $data['name_site'] = $name_site;
            $data['show_login'] = $show_login;
            $data['order_list_directorio'] = $order_list_directorio;
            $data['order_list_caso'] = $order_list_caso;
            $data['lenguaje'] = $lenguaje; 
            $data['lenguaje_automatic'] = $lenguaje_automatic;

        // Load variables
        if(is_array($vars)){
            foreach ($vars as $key => $value){
                $$key = $value;
            }
        }         
        $translate = new Translate();
        if ($lenguaje_automatic == 1){
            //nada...    
        }else{  
            $translate->setLocale($lenguaje);
            $translate->setAutomatic(false);    
        }
        
        if (isset($_SESSION['__ID_USER'])){
            include (__SITE_PATH.'/views/viewAdmin.php');  
        }else{
            include (__SITE_PATH.'/views/viewPublic.php'); 
        }
        
         

                      
    }
}
?>