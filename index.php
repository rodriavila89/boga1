<?php session_start();
 /*** error reporting on ***/
 error_reporting(0);
 /*** define the site path ***/
 $site_path = realpath(dirname(__FILE__));
 define ('__SITE_PATH', $site_path);
 $config = 'includes/init.php';  
    if (!file_exists($config)){   
        header("location:install.php");
        die;
 } 
 /*** include the init.php file ***/
 include $config;
 /*** load the router ***/
 $registry->router = new router($registry);
 /*** set the controller path ***/
 $registry->router->setPath (__SITE_PATH . '/controller');
 /*** load up the template ***/
 $registry->template = new template($registry);
 /*** load the controller ***/
 $registry->router->loader();

?>