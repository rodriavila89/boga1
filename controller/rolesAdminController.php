<?php
/*******************************************************************************
  * @ Miércoles, 09 de Abril de 2014 12:00:31
  * @package  
  * @author Adrián
  * @rolesAdminController.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  

Class rolesAdminController Extends baseController {
    
    public function index(){

        $roles_obj = new rolesModel();
        $roles = $roles_obj->_list();
        $data['roles'] = $roles;
        $this->registry->template->show('listaRolesAdmin',$data);
    }
    
    public function view(){

    }    
    
    public function edit(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $roles_obj = new rolesModel();
            $roles = $roles_obj->_get($id);
            $data['roles'] = $roles[0]; 
        }
        $this->registry->template->show('formRolesAdmin',$data);
    }    
    
    public function edit_bd(){

        $roles_obj = new rolesModel();
        if (!isset($_POST['id'])){
            $res = $roles_obj->_insert($_POST);
        }else{
            $res = $roles_obj->_update($_POST);
        }
        header("location:".__SITIO."index.php/rolesAdmin/");
    }     

    
    public function delete(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $roles_obj = new rolesModel();
            $roles = $roles_obj->_get($id);
            $data['roles'] = $roles[0];
            $cantidad = $roles_obj->_getCantidadPartes($id);
            $data['cantidad_asignaciones'] = $cantidad; 
        }
        $this->registry->template->show('deleteRolesAdmin',$data);
    
    }  
    
    public function deleteBd($data){
        
        if (isset($_POST)){
            $data = $_POST;
            $roles_obj = new rolesModel();
            $res = $roles_obj->_delete($data['id']);
            $partes_obj = new partesModel();
            $partes = $partes_obj->_deleteByRol($data['id']);
        }
        header("location:".__SITIO."index.php/rolesAdmin/");
    }   
    
}            
?>