<?php
/*******************************************************************************
  * @ viernes, 19 de febrero de 2016 21:03:35
  * @package  
  * @author Adrian
  * @contabilidadAdminController.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrian   
*******************************************************************************/   

Class contabilidadAdminController Extends baseController {
    
    public function index(){

        if (isset($_POST['fecha_desde'])){
            $primer_dia = validar_fecha_insert($_POST['fecha_desde']);
            $ultimo_dia = validar_fecha_insert($_POST['fecha_hasta']);
        }else{
            $primer_dia = primer_dia_mes_actual();
            $ultimo_dia = ultimo_dia_mes_actual();
        }
        $contabilidad_obj = new contabilidadModel();
        $contabilidad = $contabilidad_obj->_list($primer_dia,$ultimo_dia);
        $egreso = $contabilidad_obj->_egreso($primer_dia,$ultimo_dia);
        $ingreso = $contabilidad_obj->_ingreso($primer_dia,$ultimo_dia);
        $data['contabilidad'] = $contabilidad;
        $data['egreso'] = $egreso;
        $data['ingreso'] = $ingreso;
        $data['primer_dia'] = $primer_dia;
        $data['ultimo_dia'] = $ultimo_dia;
        $data['total'] =  ($ingreso[0]['ingreso']) - ($egreso[0]['egreso']);
        $this->registry->template->show('listaContabilidadAdmin',$data);
    }
    
    ###
    # muestra el formulario para agregar un nuevo
    ###
    public function add(){
     
        $this->registry->template->show('formContableNuevoAdmin',$data);
    }

    ###
    # accion sobre la base de datos
    ###
    public function edit_bd(){

        $contabilidad_obj = new contabilidadModel();
        if (!isset($_POST['id'])){
            $res = $contabilidad_obj->_insert($_POST);
        }else{
            $aux = $contabilidad_obj->_update($_POST);
            $res = $_POST['id'];
        }
        if (isset($_POST['id_caso'])){
            header("location:".__SITIO."index.php/casosAdmin/edit/".$_POST['id_caso']."/");
        }else{
            header("location:".__SITIO."index.php/contabilidadAdmin/");
        }
        
    }
    
    ###
    # muestra el formulario para eliminar el caso
    ###
    public function delete(){
                     
        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $contable_obj = new contabilidadModel();
            $contable = $contable_obj->_get($id);
            $data['contable'] = $contable[0];
        } /**/       
        $this->registry->template->show('deleteContabilidadAdmin',$data);
    }      
    
    ###
    # elimina el caso y todas sus vinculaciones
    ###
    public function deleteBd(){
    
        # datos del caso
        $contable_obj = new contabilidadModel();
        $data = $_POST;
        $contable = $contable_obj->_delete($data); 
        header("location:".__SITIO."index.php/contabilidadAdmin/");
        die;    
    }     
    
    

    

}            
?>