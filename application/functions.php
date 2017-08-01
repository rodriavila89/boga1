<?php



function sanitize($text) {
    //$text = htmlspecialchars($text, ENT_QUOTES);
    //$text = str_replace("\n\r","\n",$text);
    //$text = str_replace("\r\n","\n",$text);
    //$text = str_replace("\n","<br>",$text);
    return $text;
}

function super_unique($valor,$result=array()){

        foreach ($valor as $key => $value) {
            //check $array array or not
            if (is_array($value)){ 
                $result = super_unique($value,$result); 
            } else {  
                array_push($result,$value) ;
            }
        }
    
    return $result;
}
//----------------------------------------------------------------------
function utf8_array_encode($input){ 
    $return = array(); 
    foreach ($input as $key => $val) 
    { 
        if( is_array($val) ) 
        { 
            $return[$key] = utf8_array_encode($val); 
        } 
        else 
        { 
            $return[$key] = utf8_decode($val); 
        } 
    } 
    return $return;           
} 
//----------------------------------------------------------------------
function utf8_array_decode($input){ 
    $return = array(); 
    foreach ($input as $key => $val) 
    { 
        if( is_array($val) ) 
        { 
            $return[$key] = utf8_array_decode($val); 
        } 
        else 
        { 
            $return[$key] = utf8_encode($val); 
        } 
    } 
    return $return;           
} 


//----------------------------------------------------------------------
function campo_to_simple_array($res = array(),$campo){
  
  if (empty($res)){
    return -1;
  }
  $array = array();
  foreach ($res as $key=>$value) {
    
    foreach ($value as $k=>$v) {
        if ($k == $campo){
            $array[] = $value[$campo];
            }
    }
  }
  return $array;
}


function addfileMovimiento($id_caso,$id_movimiento,$archivos){
        
        $path = RUTA_CASO.$id_caso.'/';
        $path_movimiento = $path.'/movimientos/'.$id_movimiento; 

        if (!is_dir($path)){
            @mkdir($path);
        }
        if (!is_dir(RUTA_CASO.$id_caso.'/movimientos/')){
            @mkdir(RUTA_CASO.$id_caso.'/movimientos/');
        } 
        
        if (!is_dir(RUTA_CASO.$id_caso.'/movimientos/'.$id_movimiento)){
            @mkdir(RUTA_CASO.$id_caso.'/movimientos/'.$id_movimiento);
        }                
        $data = array();
        $error = false;
        foreach($archivos as $file){
            if(move_uploaded_file($file['tmp_name'], $path_movimiento.'/'.basename($file['name']))){
                $files[] = $path_movimiento .$file['name'];
            }else{
                $error = true;
            }
        }
        if (is_dir(RUTA_CASO.$id_caso.'/movimientos/')){
            unlink(RUTA_CASO.$id_caso.'/movimientos/');
        }        
        if ($error==true){
            array('error' => 'There was an error uploading your files');
        }else{
            $data = array('success' => RUTA_CASO.$id_caso.'/movimientos/', 'formData' => $_POST);
        }
        return $data;

}

//-------------------------------------------------------------------   

function deletefileMovimiento($id_caso,$id_movimiento,$archivo){
        
        $path_movimiento = RUTA_CASO.$id_caso.'/movimientos/'.$id_movimiento;
        $data = unlink(RUTA_CASO.$id_caso.'/movimientos/'.$id_movimiento.'/'.$archivo);
        return $data;
}

//-------------------------------------------------------------------   
    
function archivos_contenidos($ruta){
    
        $retorno = array();
        if (is_dir($ruta)) {
            if ($handle = opendir($ruta)) {
                while (false !== ($file = readdir($handle))) { 
                    if ($file != '.' && $file != '..' && $file != '.svn' ) { 
                        $retorno[] =  $file; 
                    } 
                    clearstatcache();
                } 
                closedir($handle);
            }
        }
        else{
            //die("ruta no valida ".$ruta);
            return -1;
        }
        if (count($retorno)>0)
            return $retorno;
        else
            return -1;  
}

//-------------------------------------------------------------------
// function to check if a number is odd or even
    function par($number){
        $result = $number % 2;
        if($result == 0) {
            return true;
        } else {
            return false;
        }
  }
  
  
function paginacion($total,$pp,$st,$url) {
            
            if($total>$pp) {
                    $resto=$total%$pp;
            if($resto==0) {
                    $pages=$total/$pp;
            } else {
                    $pages=(($total-$resto)/$pp)+1;
            }
 
            if($pages>10) {
                    $current_page=($st/$pp)+1;
            if($st==0) {
                    $first_page=0;
                    $last_page=10;
            } else
            if(($current_page >= 5) && ($current_page <=($pages-5)) ){
                $first_page=$current_page-5;
                $last_page=$current_page+5;
            }else
             if($current_page<5) {
                $first_page=0;
                $last_page=$current_page+5+(5-$current_page);
            } else {
                $first_page=$current_page-5-(($current_page+5)-$pages);
                $last_page=$pages;
            }
            } else {
                $first_page=0;
                $last_page=$pages;
            }
 
            for($i=$first_page;$i< $last_page;$i++) {
                    $pge=$i+1;
                    $nextst=$i*$pp;
            if($st==$nextst) {
                    $page_nav .= '&nbsp;<a><b>'.$pge.'</b></a>'; 
            } else {
                    $page_nav .= '&nbsp;<a href="'.$url.$nextst.'/">'.$pge.'</a>'; 
            }}
 
            if($st==0) { $current_page = 1; } else { $current_page = ($st/$pp)+1; }
 
            if($current_page< $pages) {
                    $page_last = '&nbsp;<a href="'.$url.($pages-1)*$pp.'/">>></a>';
                    $page_next = '&nbsp;<a href="'.$url.$current_page*$pp.'/">></a>';
            }
 
            if($st>0) {     
                    $page_first = '&nbsp;<a href="'.$url.'0/"><<</a>'; 
                    $page_previous = '&nbsp;<a href="'.$url.($current_page-2)*$pp.'/">< </a>';
                }
            }
            return array ($page_first,$page_previous,$page_nav,$page_next,$page_last);
} 

function validar_fecha_insert($fecha){

    $fecha = str_replace("/","-",$fecha);
    $array = explode("-", $fecha);
    if (count($array) !=3){
       return false;
    }
    //checkdate ( int $month , int $day , int $year )
    if (checkdate ($array[1],$array[0],$array[2])){
       return $array[2].'-'.$array[1].'-'.$array[0];
    }else{
       return false;
    }
}

function mostrar_fecha_esp($fecha){

    $array = explode("-", $fecha);
    if (count($array) !=3){
       return false;
    }
    return $array[2].'/'.$array[1].'/'.$array[0];

}

// 2016-03-01 ->  MM/DD/YYYY
function mostrar_fecha_esp_javascript($fecha){

    $array = explode("-", $fecha);
    if (count($array) !=3){
       return false;
    }
    return $array[1].'/'.$array[2].'/'.$array[0];

}

function ultimo_dia_mes_actual() {

      $month = date('m');
      $year = date('Y');
      $day = date("d", mktime(0,0,0, $month+1, 0, $year));
      return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
};

function primer_dia_mes_actual() {

      $month = date('m');
      $year = date('Y');
      return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
}

function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); 
    $dias = floor($dias);		
	return $dias;
}

/*!
  @function num2letras ()
  @abstract Dado un n?mero lo devuelve escrito.
  @param $num number - N?mero a convertir.
  @param $fem bool - Forma femenina (true) o no (false).
  @param $dec bool - Con decimales (true) o no (false).
  @result string - Devuelve el n?mero escrito en letra.

*/
function num2letras($num, $fem = true, $dec = true) {
//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande");
   $matuni[2]  = "dos";
   $matuni[3]  = "tres";
   $matuni[4]  = "cuatro";
   $matuni[5]  = "cinco";
   $matuni[6]  = "seis";
   $matuni[7]  = "siete";
   $matuni[8]  = "ocho";
   $matuni[9]  = "nueve";
   $matuni[10] = "diez";
   $matuni[11] = "once";
   $matuni[12] = "doce";
   $matuni[13] = "trece";
   $matuni[14] = "catorce";
   $matuni[15] = "quince";
   $matuni[16] = "dieciseis";
   $matuni[17] = "diecisiete";
   $matuni[18] = "dieciocho";
   $matuni[19] = "diecinueve";
   $matuni[20] = "veinte";
   $matunisub[2] = "dos";
   $matunisub[3] = "tres";
   $matunisub[4] = "cuatro";
   $matunisub[5] = "quin";
   $matunisub[6] = "seis";
   $matunisub[7] = "sete";
   $matunisub[8] = "ocho";
   $matunisub[9] = "nove";

   $matdec[2] = "veint";
   $matdec[3] = "treinta";
   $matdec[4] = "cuarenta";
   $matdec[5] = "cincuenta";
   $matdec[6] = "sesenta";
   $matdec[7] = "setenta";
   $matdec[8] = "ochenta";
   $matdec[9] = "noventa";
   $matsub[3]  = 'mill';
   $matsub[5]  = 'bill';
   $matsub[7]  = 'mill';
   $matsub[9]  = 'trill';
   $matsub[11] = 'mill';
   $matsub[13] = 'bill';
   $matsub[15] = 'mill';
   $matmil[4]  = 'millones';
   $matmil[6]  = 'billones';
   $matmil[7]  = 'de billones';
   $matmil[8]  = 'millones de billones';
   $matmil[10] = 'trillones';
   $matmil[11] = 'de trillones';
   $matmil[12] = 'millones de trillones';
   $matmil[13] = 'de trillones';
   $matmil[14] = 'billones de trillones';
   $matmil[15] = 'de billones de trillones';
   $matmil[16] = 'millones de billones de trillones';

   $num = trim((string)@$num);
   if ($num[0] == '-') {
      $neg = 'menos ';
      $num = substr($num, 1);
   }else
      $neg = '';
   while ($num[0] == '0') $num = substr($num, 1);
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
   $zeros = true;
   $punt = false;
   $ent = '';
   $fra = '';
   for ($c = 0; $c < strlen($num); $c++) {
      $n = $num[$c];
      if (! (strpos(".,'''", $n) === false)) {
         if ($punt) break;
         else{
            $punt = true;
            continue;
         }

      }elseif (! (strpos('0123456789', $n) === false)) {
         if ($punt) {
            if ($n != '0') $zeros = false;
            $fra .= $n;
         }else

            $ent .= $n;
      }else

         break;

   }
   $ent = '     ' . $ent;
   if ($dec and $fra and ! $zeros) {
      $fin = ' coma';
      for ($n = 0; $n < strlen($fra); $n++) {
         if (($s = $fra[$n]) == '0')
            $fin .= ' cero';
         elseif ($s == '1')
            $fin .= $fem ? ' una' : ' un';
         else
            $fin .= ' ' . $matuni[$s];
      }
   }else
      $fin = '';
   if ((int)$ent === 0) return 'Cero' . $fin;
   $tex = '';
   $sub = 0;
   $mils = 0;
   $neutro = false;
   while ( ($num = substr($ent, -3)) != '   ') {
      $ent = substr($ent, 0, -3);
      if (++$sub < 3 and $fem) {
         $matuni[1] = 'una';
         $subcent = 'as';
      }else{
         $matuni[1] = $neutro ? 'un' : 'uno';
         $subcent = 'os';
      }
      $t = '';
      $n2 = substr($num, 1);
      if ($n2 == '00') {
      }elseif ($n2 < 21)
         $t = ' ' . $matuni[(int)$n2];
      elseif ($n2 < 30) {
         $n3 = $num[2];
         if ($n3 != 0) $t = 'i' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }else{
         $n3 = $num[2];
         if ($n3 != 0) $t = ' y ' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }
      $n = $num[0];
      if ($n == 1) {
         $t = ' ciento' . $t;
      }elseif ($n == 5){
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
      }elseif ($n != 0){
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
      }
      if ($sub == 1) {
      }elseif (! isset($matsub[$sub])) {
         if ($num == 1) {
            $t = ' mil';
         }elseif ($num > 1){
            $t .= ' mil';
         }
      }elseif ($num == 1) {
         $t .= ' ' . $matsub[$sub] . '?n';
      }elseif ($num > 1){
         $t .= ' ' . $matsub[$sub] . 'ones';
      }
      if ($num == '000') $mils ++;
      elseif ($mils != 0) {
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
         $mils = 0;
      }
      $neutro = true;
      $tex = $t . $tex;
   }
   $tex = $neg . substr($tex, 1) . $fin;
   return ucfirst($tex);
}

function traducefecha($fecha)
   	{
   	$fecha= strtotime($fecha); // convierte la fecha de formato mm/dd/yyyy a marca de tiempo
   	$diasemana=date("w", $fecha);// optiene el número del dia de la semana. El 0 es domingo
      	 switch ($diasemana)
      	 {
      	 case "0":
         	 $diasemana="Domingo";
         	 break;
      	 case "1":
         	 $diasemana="Lunes";
         	 break;
      	 case "2":
         	 $diasemana="Martes";
         	 break;
      	 case "3":
         	 $diasemana="Miércoles";
         	 break;
      	 case "4":
         	 $diasemana="Jueves";
         	 break;
      	 case "5":
         	 $diasemana="Viernes";
         	 break;
      	 case "6":
         	 $diasemana="Sábado";
         	 break;
      	 }
   	 $dia=date("d",$fecha); // día del mes en número
   	 $mes=date("m",$fecha); // número del mes de 01 a 12
      	 switch($mes)
      	 {
      	 case "01":
         	 $mes="Enero";
         	 break;
      	 case "02":
         	 $mes="Febrero";
         	 break;
      	 case "03":
         	 $mes="Marzo";
         	 break;
      	 case "04":
         	 $mes="Abril";
         	 break;
      	 case "05":
         	 $mes="Mayo";
         	 break;
      	 case "06":
         	 $mes="Junio";
         	 break;
      	 case "07":
         	 $mes="Julio";
         	 break;
      	 case "08":
         	 $mes="Agosto";
         	 break;
      	 case "09":
         	 $mes="Septiembre";
         	 break;
      	 case "10":
         	 $mes="Octubre";
         	 break;
      	 case "11":
         	 $mes="Noviembre";
         	 break;
      	 case "12":
         	 $mes="Diciembre";
         	 break;
      	 }
   	$ano=date("Y",$fecha); // optenemos el año en formato 4 digitos
   	//$fecha= $diasemana." ".$dia." de ".$mes." de ".$ano; // unimos el resultado en una unica cadena
    $fecha = " ".$dia." de ".$mes." de ".$ano; // unimos el resultado en una unica cadena
   	return $fecha; //enviamos la fecha al programa
   	}



?>