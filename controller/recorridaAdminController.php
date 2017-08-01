<?php
/*******************************************************************************
  * @ sábado, 27 de agosto de 2016 11:54:06
  * @package  
  * @author Adrian
  * @recorridaAdminController.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrian   
*******************************************************************************/   

Class recorridaAdminController Extends baseController {

    public function index(){

    }
    
    public function recorrida(){

        $recorrida_obj = new recorridaModel();
        if (isset($_SESSION['DATA_RECORRIDA_ADMIN'])){
            $recorrida = $recorrida_obj->_lista($_SESSION['DATA_RECORRIDA_ADMIN']);
        }else{
            $recorrida = $recorrida_obj->_lista();
        }
        #juzgados
        $juzgados_obj = new juzgadosModel();
        $juzgados = $juzgados_obj->_list();
        $data['juzgados'] = $juzgados;
         
        $caso_obj = new casosModel();
        foreach ($recorrida as $key=>$value) {
            $recorrida[$key]['caso'] = $caso_obj->_listRecorrida($value['id_caso']);	
        }
        $data['recorrida'] = $recorrida;
        $this->registry->template->show('listaRecorridaTribunales',$data);
    }

    public function limpiar(){

        $this->registry->template->show('deleteRecorridaTribunales',$data);
    }

    public function limpiarTodo(){

        if (isset($_POST)){
            $tribunales_obj = new recorridaModel();
            $res = $tribunales_obj->_deleteLista();
            unset($_SESSION['DATA_RECORRIDA_ADMIN']);
        }
        header("location:".__SITIO."index.php/recorridaAdmin/recorrida/");
    }
    
    ###
    #  viene del formulario de busqueda setea la session
    ###
    public function resultadobuscar(){

        if (isset($_POST['id_busqueda'])){
            $_SESSION['DATA_RECORRIDA_ADMIN'] = $_POST['busqueda'];
            if ($_POST['busqueda'] == '0'){
                header("location:".__SITIO."index.php/recorridaAdmin/quitarfiltro/");
            }
        }
        header("location:".__SITIO."index.php/recorridaAdmin/recorrida/"); 
    } 

    ###
    #  mata la session de filtro
    ###
    public function quitarfiltro(){
        
        unset($_SESSION['DATA_RECORRIDA_ADMIN']);
        header("location:".__SITIO."index.php/recorridaAdmin/recorrida/");
    }     
    
}

?>