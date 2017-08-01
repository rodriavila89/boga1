<?php

/*******************************************************************************
  * @ Miércoles, 12 de Febrero de 2014 13:48:48
  * @package  
  * @author Adrián
  * @indexController.php
  * @version 1.0 
  * @copyright (c) 2014,  Adrián   
*******************************************************************************/  

Class indexController Extends baseController {

    public function index() {
        
        if (isset($_SESSION['__ID_USER'])){ 
            # se entra aca por defecto se muestra el listado 
            $estadisticas_obj = new estadisticasModel();
            $casos = $estadisticas_obj->_countCasos();
            $data['cantidad_casos'] = $casos;
            $directorios = $estadisticas_obj->_countDirectorio();
            $data['cantidad_directorio'] = $directorios;   
            $agenda = $estadisticas_obj->_countAgendaHoy();
            $data['cantidad_agenda'] = $agenda;   
            $tribunales_casos = $estadisticas_obj->_listaByTribunal();
            $tribunales_casos = utf8_array_decode($tribunales_casos);
            $data['tribunales_casos'] = json_encode($tribunales_casos); 
            $ultimosVisto_obj = new ultimosVistosModel();              
            $ultimos_casos = $ultimosVisto_obj->_listCasos();
            $data['ultimos_casos'] = $ultimos_casos; 
            $ultimos_directorio = $ultimosVisto_obj->_listDirectorio();
            $data['ultimos_directorio'] = $ultimos_directorio;
            # actualizacion
            $upgrade_obj = new upgradeModel();
            $version = $upgrade_obj->_version();
            $data['version'] = $version;
            # agenda semanal
            $agenda_obj = new agendaModel();
            $week = date("W");
            $semana = array();
            for($i=0; $i<7; $i++){
                $dia = date('Y-m-d', strtotime('01/01 +' . ($week - 1) . ' weeks third day +' . $i . ' day'));
                $semana[$i]['citas'] = $agenda_obj->_listDay($dia);
                $semana[$i]['dia'] = $dia;
            }
            $data['semana'] = $semana;
            # movimientos
            $casos_obj = new casosModel();
            $casos_movimientos = $casos_obj->_lista_homeMovimientos();
            $data['casos_movimientos'] = $casos_movimientos;
        }else{
            # ### 
        }
        $this->registry->template->show('index',$data);
    }

    public function login() {
        
        $this->registry->template->show('login');
    }   
            
    public function login_bd() {

        $user_obj = new usersModel();
        $ok = $user_obj->_login($_POST['user'],$_POST['password']);
        if ($ok > 0){
            $_SESSION['__ID_USER'] = $ok;
        }
        header('location:'.__SITIO.'index.php'); 
    }  
    
    public function logout() {

        unset($_SESSION['__ID_USER']);
        unset($_SESSION['ST_LISTA_CASOS']);
        unset($_SESSION['ST_LISTA_DIRECTORIO']);
        unset($_SESSION['DATA_BUSQUEDA_ADMIN']);
        unset($_SESSION['DATA_BUSQUEDA_ADMIN_DIRECTORIO']);
        unset($_SESSION['ST_DATA_BUSQUEDA_DIRECTORIO']);
        header('location:'.__SITIO.'index.php'); 
    }
    
    public function about() {

        $this->registry->template->show('acerca');
    }   
    
    public function clientes() {

        $this->registry->template->show('clientes');
    }

    public function loginCliente() {

        $publico_obj = new publicoModel();
        $ok = $publico_obj->_login($_POST['clave']);
        if (!empty($ok[0])){
            $data['cliente'] = $ok;
            $movimientos = $publico_obj->_list($ok[0]['id']);
            $data['movimientos'] = $movimientos;
            $this->registry->template->show('movimientos',$data);
        }else{
            $this->registry->template->show('clientes');
        }
    }

                     

}

?>