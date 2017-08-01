<?php

/*******************************************************************************
  * @ Viernes, 28 de Marzo de 2014 12:36:55
  * @package  
  * @author Adrián
  * @directorioAdminController.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/   

Class directorioAdminController Extends baseController {
    
    public function index(){

        $id = $this->registry->router->id;
        $order_list_directorio= $this->registry->router->config['order_list_directorio'];  
        if ($id != -1){
                $desde = $id;
                $_SESSION['ST_LISTA_DIRECTORIO'] = $desde;
        }elseif($_SESSION['ST_LISTA_DIRECTORIO']){
                $desde = $_SESSION['ST_LISTA_DIRECTORIO'];
        }else {
                $desde = 0;
        } 
        $hasta = 20;
        $directorio_obj = new directorioModel();
        if (isset($_SESSION['DATA_BUSQUEDA_ADMIN_DIRECTORIO'])){
            $directorio = $directorio_obj->_list($order_list_directorio,$desde,$hasta,$_SESSION['DATA_BUSQUEDA_ADMIN_DIRECTORIO']);
        }else{
            $directorio = $directorio_obj->_list($order_list_directorio,$desde,$hasta);
        }        
        
        $data['directorio'] = $directorio['data'];
        $cantidad = $directorio['cantidad'];
        $data['cantidad'] = $cantidad;    
        $data['order_list_directorio'] = $order_list_directorio;
        $data['paginacion'] = paginacion($cantidad,$hasta,$desde,__SITIO.'index.php/directorioAdmin/list/');     
        $this->registry->template->show('listaDirectorioAdmin',$data);
    }
    
    public function add(){

        $this->registry->template->show('formDirectorioNuevoAdmin',$data);
    }    
    
    public function delete(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            # datos del directorio
            $directorio_obj = new directorioModel();
            $directorio = $directorio_obj->_get($id);
            $data['directorio'] = $directorio[0];
        }
        $this->registry->template->show('deleteDirectorioAdmin',$data);
    }        
    
    public function edit(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            # datos del directorio
            $directorio_obj = new directorioModel();
            $directorio = $directorio_obj->_get($id);
            $data['directorio'] = $directorio[0];
            # agenda 
            $agenda_obj = new agendaModel();
            $agenda = $agenda_obj->_listDirectorio($id);
            $data['agenda'] = json_encode($agenda);
            # agenda 
            $casos_obj = new casosModel();
            $casos = $casos_obj->_listPorDirectorio($id,1,0,2000);
            $cantidad = $casos['cantidad'];
            $casos = $casos['data'];
            $data['order_list_casos'] = $order_list_casos;
            $data['casos'] = $casos; 
            $data['paginacion'] = paginacion($cantidad,$hasta,$desde,__SITIO.'index.php/casosAdmin/list/'); 
            # ultimos vistos
            $ultimoVistos_obj = new ultimosVistosModel();
            $dat['id_directorio'] = $id;
            $res = $ultimoVistos_obj->_insert($dat);                         
        }
        $this->registry->template->show('formDirectorioAdmin',$data);
    }    
    
    public function edit_bd(){

        $directorio_obj = new directorioModel();
        if (!isset($_POST['id'])){
            $res = $directorio_obj->_insert($_POST);
        }else{
            $aux = $directorio_obj->_update($_POST);
            $res = $_POST['id'];
        }
        header("location:".__SITIO."index.php/directorioAdmin/edit/".$res."/");
    } 
    
    public function view(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            # datos del directorio
            $directorio_obj = new directorioModel();
            $directorio = $directorio_obj->_get($id);
            $data['directorio'] = $directorio[0];
            # agenda 
            $agenda_obj = new agendaModel();
            $agenda = $agenda_obj->_listDirectorio($id);
            # agenda 
            $casos_obj = new casosModel();
            $casos = $casos_obj->_listPorDirectorio($id,1,0,2000);
            $cantidad = $casos['cantidad'];
            $casos = $casos['data'];
            $data['order_list_casos'] = $order_list_casos;
            $data['casos'] = $casos; 
            $data['paginacion'] = paginacion($cantidad,$hasta,$desde,__SITIO.'index.php/casosAdmin/list/'); 
            # ultimos vistos
            $ultimoVistos_obj = new ultimosVistosModel();
            $dat['id_directorio'] = $id;
            $res = $ultimoVistos_obj->_insert($dat);                         
        }
        $this->registry->template->show('viewDirectorioAdmin',$data);
    }    
    
    public function deleteBd(){

        # datos del directorio
        $directorio_obj = new directorioModel();
        $data = $_POST;
        $directorio = $directorio_obj->_delete($data); 
        header("location:".__SITIO."index.php/directorioAdmin/");
        die;
    }           


    ###
    #  viene del formulario de busqueda setea la session
    ###
    public function resultadobuscar(){
        
        if (isset($_POST['id_busqueda'])){
            $_SESSION['DATA_BUSQUEDA_ADMIN_DIRECTORIO'] = $_POST['busqueda'];
            $_SESSION['ST_DATA_BUSQUEDA_DIRECTORIO'] = 0;
            unset($_SESSION['ST_LISTA_DIRECTORIO']);
        }
        header("location:".__SITIO."index.php/directorioAdmin/");
    } 

    ###
    #  mata la session de filtro
    ###
    public function quitarfiltro(){
        
        unset($_SESSION['DATA_BUSQUEDA_ADMIN_DIRECTORIO']);
        unset($_SESSION['ST_DATA_BUSQUEDA_DIRECTORIO']);
        unset($_SESSION['ST_LISTA_DIRECTORIO']);
        header("location:".__SITIO."index.php/directorioAdmin/");
    }


}            
?>