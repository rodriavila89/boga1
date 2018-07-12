<?php

/*******************************************************************************
  * @ Jueves, 27 de Marzo de 2014 12:00:51
  * @package  
  * @author Adrián
  * @casosAdminController.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  

Class casosAdminController Extends baseController {
    
    ###
    # muestra el listado
    ###
    public function index(){

        $id = $this->registry->router->id;
        $order_list_caso = $this->registry->router->config['order_list_caso']; 
        $order_list_casos = '';
        $order_list_casos2 = 'test2';
        if ($id != '-1'){
                $desde = $id;
                $_SESSION['ST_LISTA_CASOS'] = $desde;
        }elseif($_SESSION['ST_LISTA_CASOS']){
                $desde = $_SESSION['ST_LISTA_CASOS'];
        }else {
                $desde = 0;
        } 
        $casos_obj = new casosModel();
        $hasta = 15;
        if (isset($_SESSION['DATA_BUSQUEDA_ADMIN'])){
            $casos = $casos_obj->_list($order_list_caso,$desde,$hasta,$_SESSION['DATA_BUSQUEDA_ADMIN']);
        }elseif($_SESSION['DATA_BUSQUEDA_ADMIN_FECHA']){
            $casos = $casos_obj->_list($order_list_caso,$desde,$hasta,$_SESSION['DATA_BUSQUEDA_ADMIN_FECHA']);
        }else{
            $casos = $casos_obj->_list($order_list_caso,$desde,$hasta);
        }
        $cantidad = $casos['cantidad'];
        $casos = $casos['data'];
        $data['order_list_caso'] = $order_list_caso;
        $data['casos'] = $casos;
        $data['cantidad'] = $cantidad; 
        $data['paginacion'] = paginacion($cantidad,$hasta,$desde,__SITIO.'index.php/casosAdmin/list/');  
        $this->registry->template->show('listaCasosAdmin',$data);
    }
    
    ###
    # muestra el formulario para agregar un nuevo caso
    ###
    public function add(){
     
        $naturaleza_obj = new naturalezasCasosModel();
        $naturalezas = $naturaleza_obj->_list();
        $data['naturalezas'] = $naturalezas;
        $this->registry->template->show('formCasoNuevoAdmin',$data);
    }        
    
    ###
    # muestra el formulario para editar un caso
    ###
    public function edit(){
        
        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $casos_obj = new casosModel();
            $caso = $casos_obj->_get($id);
            $data['caso'] = $caso[0];
            # naturalezas
            $naturaleza_obj = new naturalezasCasosModel();
            $naturalezas = $naturaleza_obj->_list();
            $data['naturalezas'] = $naturalezas; 
            # juzgados
            $juzgados_obj = new juzgadosModel();
            $juzgados = $juzgados_obj->_list();            
            $data['juzgados'] = $juzgados; 
            # radicaciones anteriores
            $radicacion_obj = new radicacionModel();
            $radicacion = $radicacion_obj->_listBycaso($id);            
            $data['radicaciones'] = $radicacion;
            # partes                    
            $partes_obj = new partesModel();
            $partes = $partes_obj->_listByCasos($id);            
            $data['partes'] = $partes;  
            # roles                    
            $roles_obj = new rolesModel();
            $roles = $roles_obj->_list();            
            $data['roles'] = $roles;
            # agenda 
            $agenda_obj = new agendaModel();
            $agenda = $agenda_obj->_listCaso($id);
            $agenda = utf8_array_decode($agenda);
            $data['agenda'] = json_encode($agenda);
            # movimientos
            $movimientos_obj = new movimientosModel();
            $movimientos = $movimientos_obj->_list_por_caso($id);
            $data['movimientos'] = $movimientos;    
            # contabilidad >> vemos los convenios y cuotas
            $convenios_obj = new conveniosModel();
            $convenios = $convenios_obj->_list_por_caso($id);
            $data['convenios'] = $convenios;
            # moviminetos contables del caso
            $contabilidad_obj = new contabilidadModel();
            $contabilidad = $contabilidad_obj->_list_por_caso($id);
            $ingreso_por_caso = $contabilidad_obj->_ingreso_por_caso($id);
            $egreso_por_caso = $contabilidad_obj->_egreso_por_caso($id);
            $data['ingreso'] = $ingreso_por_caso;
            $data['egreso'] = $egreso_por_caso;
            $data['contables'] = $contabilidad;
            # si esta en recorrida de tribunales
            $recorrida_obj = new recorridaModel();
            $recorrida = $recorrida_obj->_getCaso($id);
            $data['recorrida'] = $recorrida;
            # liquidaciones
            $liquidaciones_obj = new liquidacionesModel();
            $liquidaciones = $liquidaciones_obj->_getCasos($id);
            $data['liquidaciones'] = $liquidaciones; 
           
            $convenios_abiertos = $convenios_obj->_list_por_caso_abiertos($id);
            $data['convenios_abiertos'] = $convenios_abiertos;
            # insertamos en el ultimo visto
            $ultimoVistos_obj = new ultimosVistosModel();
            $dat['id_caso'] = $id;
            $res = $ultimoVistos_obj->_insert($dat);
        }      
        $this->registry->template->show('formCasoAdmin',$data);
    }       
    
    ###
    # accion sobre la base de datos
    ###
    public function edit_bd(){

        $casos_obj = new casosModel();
        if (!isset($_POST['id'])){
            $res = $casos_obj->_insert($_POST);
        }else{
            $aux = $casos_obj->_update($_POST);
            $res = $_POST['id'];
        }
        header("location:".__SITIO."index.php/casosAdmin/edit/".$res."/");
    }   
    
    ###
    # cuando se realiza una nueva radicacion
    ###
    public function editradicacion(){

        $casos_obj = new casosModel();
        $caso = $casos_obj->_get($_POST['id']);
        $data['id'] = $_POST['id'];
        $data['radicacion_actual'] = $_POST['select_nuevo_juzgado'];
        $data['nro_expediente'] = $_POST['nro_expediente'];
        $res = $casos_obj->_update($data);
       if ($caso[0]['radicacion_actual'] != ''){
            $radicacion_obj = new radicacionModel();
            $data_radicacion['id_juzgado'] = $caso[0]['radicacion_actual'];
            $data_radicacion['id_caso'] = $_POST['id'];
            $data_radicacion['nro_expediente'] = $caso[0]['nro_expediente'];
            $radicacion = $radicacion_obj->_insert($data_radicacion);
        }
        header("location:".__SITIO."index.php/casosAdmin/edit/".$_POST['id']."/");
    }  
    
    ###
    # cuando se realiza un nuevo movimiento
    ###
    public function editmovimiento(){

        $movimientos_obj = new movimientosModel();
        $datos_movimiento = $_POST;
        if(isset($_POST['publico'])){
            if ($_POST['publico']=='on'){
                $datos_movimiento['publico'] = 1;
            }
        }
        if ($_POST['id'] == -1){
            $movimientos = $movimientos_obj->_insert($datos_movimiento);
        }else{
            $movimientos = $movimientos_obj->_update($datos_movimiento);
        }
        header("location:".__SITIO."index.php/casosAdmin/edit/".$_POST['id_caso']."/");
    }   
    
    ###
    # cuando se realiza una nueva radicacion
    ###
    public function editparte(){

        $aux['id_caso'] = $_POST['id'];
        $aux['id_persona'] = $_POST['select_nueva_parte']; 
        $aux['id_rol'] = $_POST['id_rol']; 
        $aux['tipo'] = $_POST['tipo'];  
        $partes_obj = new partesModel();
        $partes = $partes_obj->_insert($aux);
        header("location:".__SITIO."index.php/casosAdmin/edit/".$_POST['id']."/");
    }     
    
    ###
    # muestra los datos del caso
    ###
    public function view(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $casos_obj = new casosModel();
            $caso = $casos_obj->_get($id);
            $data['caso'] = $caso[0];
            # radicaciones anteriores
            $radicacion_obj = new radicacionModel();
            $radicacion = $radicacion_obj->_listBycaso($id);            
            $data['radicaciones'] = $radicacion;
            # partes                    
            $partes_obj = new partesModel();
            $partes = $partes_obj->_listByCasos($id);            
            $data['partes'] = $partes; 
            # movimientos
            $movimientos_obj = new movimientosModel();
            $movimientos = $movimientos_obj->_list_por_caso($id);
            $data['movimientos'] = $movimientos;
            # se inserta en los ultimos vistos
            $ultimoVistos_obj = new ultimosVistosModel();
            $dat['id_caso'] = $id;
            $res = $ultimoVistos_obj->_insert($dat);
            # moviminetos contables del caso
            $contabilidad_obj = new contabilidadModel();
            $contabilidad = $contabilidad_obj->_list_por_caso($id);
            $data['contabilidad'] = $contabilidad;
            $ingreso_por_caso = $contabilidad_obj->_ingreso_por_caso($id);
            $egreso_por_caso = $contabilidad_obj->_egreso_por_caso($id);
            $data['ingreso'] = $ingreso_por_caso;
            $data['egreso'] = $egreso_por_caso;
            # recorrida de tribunales
            $recorrida_obj = new recorridaModel();
            $recorrida = $recorrida_obj->_getCaso($id);
            $data['recorrida'] = $recorrida;
            # liquidaciones
            $liquidaciones_obj = new liquidacionesModel();
            $liquidaciones = $liquidaciones_obj->_getCasos($id);
            $data['liquidaciones'] = $liquidaciones;

        }                                   
        $this->registry->template->show('viewCasoAdmin',$data);
    }   
    
    ###
    # muestra el formulario para eliminar el caso
    ###
    public function delete(){
                     
        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $casos_obj = new casosModel();
            $caso = $casos_obj->_get($id);
            $data['caso'] = $caso[0];
        }        
        $this->registry->template->show('deleteCasoAdmin',$data);
    }      
    
    ###
    # elimina el caso y todas sus vinculaciones
    ###
    public function deleteBd(){
    
        # datos del caso
        $casos_obj = new casosModel();
        $data = $_POST;
        $directorio = $casos_obj->_delete($data); 
        header("location:".__SITIO."index.php/casosAdmin/");
        die;    
    } 
    
    ###
    #  viene del formulario de busqueda setea la session
    ###
    public function resultadobuscar(){

        if (isset($_POST['id_busqueda'])){
            if ($_POST['id_busqueda']==1){
                # matamos las sesiones de la busqueda por texto
                $_SESSION['DATA_BUSQUEDA_ADMIN'] = $_POST['busqueda'];
                $_SESSION['ST_DATA_BUSQUEDA_CASO'] = 0;
                unset($_SESSION['ST_LISTA_CASOS']);
                unset($_SESSION['DATA_BUSQUEDA_ADMIN_FECHA']);
            }else{
                # matamos las sesiones de la busqueda por texto
                unset($_SESSION['DATA_BUSQUEDA_ADMIN']);
                unset($_SESSION['ST_DATA_BUSQUEDA_CASO']);
                unset($_SESSION['ST_LISTA_CASOS']);
                $_SESSION['DATA_BUSQUEDA_ADMIN_FECHA'] = array(validar_fecha_insert($_POST['fecha_desde']),validar_fecha_insert($_POST['fecha_hasta']),$_POST['con_mov']);
                $_SESSION['ST_DATA_BUSQUEDA_CASO'] = 1;
                unset($_SESSION['ST_LISTA_CASOS']);
            }
        }
        header("location:".__SITIO."index.php/casosAdmin/");
    } 

    ###
    #  mata la session de filtro
    ###
    public function quitarfiltro(){
        
        unset($_SESSION['DATA_BUSQUEDA_ADMIN']);
        unset($_SESSION['ST_DATA_BUSQUEDA_CASO']);
        unset($_SESSION['ST_LISTA_CASOS']);
        unset($_SESSION['DATA_BUSQUEDA_ADMIN_FECHA']);
        header("location:".__SITIO."index.php/casosAdmin/");
    } 
    
    ###
    #  agrega un convenio y las cuotas
    ###
    public function addconvenio(){

        $convenios_obj = new conveniosModel();
        $convenios = $convenios_obj->_insert($_POST);
        header("location:".__SITIO."index.php/casosAdmin/edit/".$_POST['id']."/");
    }

    ###
    #  cobra una cuota del convenio
    ###
    public function cobrarcuota(){

        $convenios_obj = new conveniosModel();
        $convenios = $convenios_obj->_pago_cuota($_POST);
        $datos = $_POST;
        $datos['id_concepto'] = 3;
        $datos['id_caso'] = $datos['id'];
        unset($datos['convenios']);
        unset($datos['id']);
        $datos['fecha'] = mostrar_fecha_esp($datos['fecha']);
        $contabilidad_obj = new contabilidadModel();
        $convenios = $contabilidad_obj->_insert($datos);
        header("location:".__SITIO."index.php/casosAdmin/edit/".$datos['id_caso']."/");
    }

    ###
    #  inserta una nueva liquidacion
    ###
    public function nuevaliqui(){

        $datos = $_POST; 
        $datos['id_caso'] = $datos['id'];
        $datos['caso'] = $datos['autos'];
        $datos['juzgado'] = $datos['juzgado_liqui'];
        unset($datos['id']);
        unset($datos['autos']);
        unset($datos['juzgado_liqui']);
        unset($datos['interes_anual_lectura']);
        unset($datos['total_parcial']);
        unset($datos['iva_lectura']);
        $datos['fecha_exibicion'] = validar_fecha_insert($datos['fecha_exibicion']);
        $datos['fecha_act'] = validar_fecha_insert($datos['fecha_act']);
        $dias = dias_transcurridos($datos['fecha_exibicion'],$datos['fecha_act']);
        $datos['dias'] = intval($dias+ 1);
        $liquidaciones_obj = new liquidacionesModel();
        $convenios = $liquidaciones_obj->_insert($datos);
        header("location:".__SITIO."index.php/casosAdmin/edit/".$datos['id_caso']."/");
    }

    ###
    #  edita una liquidacion
    ###
    public function editarliqui(){

        $datos = $_POST;
        $datos['caso'] = $datos['autos'];
        $datos['juzgado'] = $datos['juzgado_liqui'];
        unset($datos['autos']);
        unset($datos['juzgado_liqui']);
        unset($datos['interes_anual_lectura']);
        unset($datos['total_parcial']);
        unset($datos['iva_lectura']);
        unset($datos['interes_punitorio_anual_total']);
        $datos['fecha_exibicion'] = validar_fecha_insert($datos['fecha_exibicion']);
        $datos['fecha_act'] = validar_fecha_insert($datos['fecha_act']);
        $dias = dias_transcurridos($datos['fecha_exibicion'],$datos['fecha_act']);
        $datos['dias'] = intval($dias);
        $liquidaciones_obj = new liquidacionesModel();
        $convenios = $liquidaciones_obj->_update($datos);
        header("location:".__SITIO."index.php/casosAdmin/edit/".$datos['id_caso']."/");
    }


    public function reporteliquidaciontxt(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $liquidaciones_obj = new liquidacionesModel();
            $liquidaciones = $liquidaciones_obj->_get($id);
            $liq = $liquidaciones[0];
            echo "<center>Planilla de Liquidaci&oacute;n</center><br />";
            echo "Expediente: ".$liq['expediente']."<br />";
            echo "Autos: \"".$liq['caso']."\" <br />";
            echo "Juzgado: ".$liq['juzgado']."<br /><hr>";
            echo $liq['rubro_cabecera']." - ".$liq['titulo_cabecera']."<br />";
            echo "<table width=100% border=0>";
            echo "<tr><td width=40%>&nbsp;</td><td width=30%>Capital inicial</td><td width=30%> $ ".round($liq['capital_inicial'],2)."</td></tr>";
            echo "<tr><td width=40%>Fecha de exigib.: ".mostrar_fecha_esp($liq['fecha_exibicion'])." </td><td width=30%> D&iacute;as:</td><td width=30%> ".$liq['dias']."</td></tr>";
            echo "<tr><td width=40%>Fecha de act.: ".mostrar_fecha_esp($liq['fecha_act'])." </td><td width=30%><td width=30%></td></tr>";
            echo "<tr><td width=40%>Int. Comp. Anuales (%) ".$liq['interes_anual']."</td><td width=30%>Incremento:</td><td width=30%> $ ".round($liq['interes_anual_total'],2)."</td></tr>";
            echo "<tr><td width=40%>Int. Punitorios Anuales (%) ".$liq['interes_punitorio_anual']."</td><td width=30%>Incremento:</td><td width=30%> $ ".round($liq['interes_punitorio_anual_total'],2)."</td></tr>";
            echo "<tr><td width=40%>IVA s/int. (%) ".$liq['iva']."</td><td width=30%>Monto:</td><td width=30%> $ ".round($liq['interes_iva_total'],2)."</td></tr>";
            echo "<tr><td width=40%>&nbsp;</td><td width=30%>&nbsp;Total</td><td width=30%> $ ".round($liq['total_cabecera'],2)."</td></tr>";
            echo "<tr><td width=40%>&nbsp;</td><td width=30%>&nbsp;Total Parcial</td><td width=30%> $ ".round($liq['total_cabecera'],2)."</td></tr>";
            echo "<tr><td colspan=3><hr></td></tr>";
            $aux = $liq['total_cabecera'];
            $gastos = 0;
            $interes_de_capital = $liq['interes_punitorio_anual_total'] + $liq['interes_punitorio_anual_total'];
            foreach ($liq['items'] as $key=>$value) {
                $aux  = $aux + $value['capital'];
                $gastos = $gastos + $value['capital'];
                echo "<tr><td colspan=3>Rubro ".$value['rubro']."</td></tr>";
                echo "<tr><td width=40%>&nbsp;</td><td width=30%>Capital inicial</td><td width=30%> $ ".round($value['capital'],2)."</td></tr>";
                echo "<tr><td width=40%>Fecha de exigib.: ".mostrar_fecha_esp($value['fecha_exibicion_items'])." </td><td width=30%> D&iacute;as:</td><td width=30%> ".$value['dias']."</td></tr>";
                echo "<tr><td colspan=3>Fecha de act.: ".mostrar_fecha_esp($value['fecha_act_items'])." </td></tr>";
                echo "<tr><td width=40%>&nbsp;</td><td width=30%>Total</td><td width=30%> $ ".round($value['capital'],2)."</td></tr>";
                echo "<tr><td width=40%>&nbsp;</td><td width=30%>Total Parcial</td><td width=30%> $ ".round($aux,2)."</td></tr>";
                echo "<tr><td colspan=3><hr></td></tr>";
            }
            echo "<tr><td></td><td>Total Planilla </td><td> $ ".round($aux,2)."</td></tr>";
            echo "</table>";
            echo "Resumen<br />";
            echo "<table width=100% border=0>";
            echo "<tr><td width=60%>Capital:  $ ".round($liq['capital_inicial'],2)."</td><td></td></tr>";
            echo "<tr><td width=60%>Capital</td><td>$ ".round($liq['capital_inicial'],2)."</td> </tr>";
            echo "<tr><td width=60%>Inter&eacute;s de Capital:  $ ".round($interes_de_capital,2)."</td><td></td></tr>";
            echo "<tr><td width=60%>Saldo de inter&eacute;s de Capital</td><td>$ ".round($interes_de_capital,2)."</td> </tr>";
            echo "<tr><td width=60%>IVA sobre Capital y/o Inter&eacute;s :  $ ".round($liq['interes_iva_total'],2)."</td><td></td></tr>";
            echo "<tr><td width=60%>Saldo de IVA sobre Capital y/o Inter&eacute;s </td><td>$ ".round($liq['interes_iva_total'],2)."</td> </tr>";
            echo "<tr><td width=60%>Gastos :  $ ".round($gastos,2)."</td><td></td></tr>";
            echo "<tr><td width=60%>Saldo de Gastos </td><td>$ ".round($gastos,2)."</td> </tr>";
            echo "<tr><td width=60%><b>Total General</b></td><td><b>$ ".round($aux,2)."</b></td> </tr>";
            echo "</table>";
            $decimal = explode('.',round($aux,2));
            $fecha = traducefecha(date('m/d/Y'));
            echo "<p>La presente planilla asciende al d&iacute;a ".$fecha." a la suma de ". strtoupper(num2letras(round($aux,2),true,false))." CON ".$decimal[1]."/100</p>";
            die;
        }

    }




    

}            
?>
