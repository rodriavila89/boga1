<?php

# CLASE USUARIO PARA GESTIONAR A LOS USUARIOS DEL SISTEMA



class usersModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _login($usuario=NULL,$password=NULL){
    
        if( $usuario!=null and $password!=null){
            # se limpian variables
            $usuario = htmlspecialchars(trim($usuario), ENT_QUOTES);        
            $password = md5(htmlspecialchars(trim($password), ENT_QUOTES));
            # se realiza la consulta a la base de datos
            $sql = "SELECT id FROM users WHERE name = '$usuario' AND password='$password'";
            $r = $this->db->pdoQuery($sql)->results();
            # retorna resultado en boolean
            if (empty($r)){
                return 0;
            }else{
                return $r[0]['id'];
            }
        }
        else
           return 0;    
    }  
    
    public function _get(){
        
        $sql = "SELECT * FROM users where id = ".$_SESSION['__ID_USER']; 
        $res = $this->db->pdoQuery($sql)->results();
        return $res;    
    }      
    
    
    public function _update($data){
    
        $where = array('id'=>$_SESSION['__ID_USER']); 
        unset($data['password_old']); 
        unset($data['password2']);
        
        if(isset($data['name'])){
            $data['name'] = $data['name'];
        }
                
        if(isset($data['password'])){
            $data['password'] =  md5(trim($data['password']));
        }
        $res = $this->db->update('users', $data, $where)->affectedRows();
        return $res;    
       
    }         
  
 
    
}
?>
