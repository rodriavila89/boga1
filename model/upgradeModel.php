<?php
/*******************************************************************************
  * @ Lunes, 14 de Abril de 2014 10:50:36
  * @package  
  * @author Adrián
  * @upgradeModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  
class upgradeModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    # lee la maquina donde esta el software
    public function _version(){

        $getVersions = $this->url_get_contents(__VERSION);  
        return $getVersions;                 
    }                                   
    
    # lee en el servidor la ultima version
    public function _ultmaVersion(){
        
        $getVersions = $this->url_get_contents(__SERVER_UPGRADE) or die ('ERROR');
        return $getVersions; 
    } 
    
    # actualiza a la ultima version
    public function _actualizar(){
        
        $ultima = trim($this->_ultmaVersion());  
        $conjuntodearchivos = $this->url_get_contents(__SERVER_UPGRADE_DIR.$ultima.'/index.php') or die (__SERVER_UPGRADE_DIR.$ultima.'/index.php'); 
        if ( !is_dir( __SITE_PATH.'/versiones/'.$ultima ) ){ 
            mkdir ( __SITE_PATH.'/versiones/'.$ultima );
        }
        $archivos = explode(";", $conjuntodearchivos);
        # models*a.txt*php; 
        # bajamos los archivs de la actualizacion
        foreach ($archivos as $value) {
            $value = str_replace("\\n", "", $value);
            $array_data = explode("*", $value);
            $data_ruta = $array_data[0];
            $data_archivo = $array_data[1];
            $data_extension = $array_data[2];
            $contenido_archivo = $this->url_get_contents(__SERVER_UPGRADE_DIR.$ultima.'/'.$data_archivo); 
            $ar = fopen(__SITE_PATH.'/versiones/'.$ultima.'/'.$data_archivo,"w") or die("Problemas en la creacion  ".__SITE_PATH.'/versiones/'.$ultima.'/'.$data_archivo);
            fputs($ar,$contenido_archivo);
            fclose($ar);
            $res = explode(".", $data_archivo);
            # renombramos el archivo
            $res_final = $res[0].".".$data_extension;
            $archivo_final = __SITE_PATH.'/versiones/'.$ultima.'/'.$res[0].".".$data_extension;
            rename(__SITE_PATH.'/versiones/'.$ultima.'/'.$data_archivo,$archivo_final);
            #renombramos y reemplazamos el nuevo archivo 
            copy($archivo_final,__SITE_PATH.'/'.trim($data_ruta).'/'.$res_final);
        }
        $ar = fopen(__VERSION_FILE,"w+");
        fputs($ar,$ultima);
        fclose($ar);        
        
    }
    
    function url_get_contents ($Url) {
        if (!function_exists('curl_init')){ 
            die('CURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }         
       
    
}


?>