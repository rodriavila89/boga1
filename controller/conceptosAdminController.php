<?php
/*******************************************************************************
  * @ lunes, 14 de marzo de 2016 12:25:32 p.m.
  * @package
  * @author Adrian
  * @conceptosAdminController.php
  * @version 1.0
  * @copyright (c) 2015,  Adrian
*******************************************************************************/

Class conceptosAdminController Extends baseController {

    public function index() {

        $conceptos_obj = new conceptosModel();
        $conceptos = $conceptos_obj->_lista();
        $data['conceptos'] = $conceptos;
        $this->registry->template->show('listaConceptosAdmin',$data);
    }



    public function view(){

    }

    public function edit(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $conceptos_obj = new conceptosModel();
            $conceptos = $conceptos_obj->_get($id);
            $data['conceptos'] = $conceptos[0];
        }
        $this->registry->template->show('formConceptosAdmin',$data);
    }

    public function edit_bd(){

        $conceptos_obj = new conceptosModel();
        if (!isset($_POST['id'])){
            $res = $conceptos_obj->_insert($_POST);
        }else{
            $res = $conceptos_obj->_update($_POST);
        }
        header("location:".__SITIO."index.php/conceptosAdmin/");
    }


    public function delete(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $conceptos_obj = new conceptosModel();
            $conceptos = $conceptos_obj->_get($id);
            $data['conceptos'] = $conceptos[0];
        }
        $this->registry->template->show('deleteConceptosAdmin',$data);

    }

    public function deleteBd($data){

        if (isset($_POST)){
            $data = $_POST;
            $conceptos_obj = new conceptosModel();
            $res = $conceptos_obj->_delete($data['id']);
        }
        header("location:".__SITIO."index.php/conceptosAdmin/");
    }

}
?>