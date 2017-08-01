<?php
    $site_path = realpath(dirname(__FILE__));
    define ('__SITE_PATH', $site_path);
    include __SITE_PATH . '/application/translate.php';
    $translate = new Translate();
    $config = 'includes/init.php';  
        if (file_exists($config)){   
            die;
    }     
    echo '<!DOCTYPE html>
        <html lang="en">
            <head>
                <base href=""/>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="">
                <meta name="author" content="">                        
                <title>:: '.ucfirst($translate->_('_instalacion_litigaronline')).'::</title>     
                <script src="includes/js/jquery-1.10.2.min.js"></script>
                <script src="includes/js/jquery-ui.min.js"></script>
                
                <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
                <link href="includes/bootstrap/css/sb-admin.css" rel="stylesheet"/>
                <link href="includes/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>                        
                <link href="includes/css/select2.css" rel="stylesheet">
                <link href="includes/css/styled.css" rel="stylesheet">';
    echo "<style>
        .row > div {
            background-color: #dedef8;
            box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;
        }
        </style>";                
         
    echo ' </head>
            <body>';
            
            $filename = 'includes/init.php';
            if (!isset($_POST['install'])) {
                $aux = explode('/',trim($_SERVER['PHP_SELF']));
                $carpeta = '';
                foreach ($aux as &$value) {
                    if ($value === 'install.php'){
                        break;
                    }  
                    $carpeta = $value;
                }                                                

    ?>               
                    
                    
    <div class="container">
         <br><br><br><br><br><br>
         <?php 
            
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $version = phpversion();
                $version = str_replace('.','',$version);
                $version = substr($version,0,2);
                if ($version < 53){ 
                    $ip_externa = getHostByName(php_uname('n'));
                }else{
                    $ip_externa = getHostByName(getHostName());
                }
                $intranet = 'http://'.$ip_externa.'/'.$carpeta.'/';
                //http://".$_SERVER['SERVER_ADDR'].'/'.$carpeta.'/'
                echo "<p>".ucfirst( sprintf($translate->_('_info_instalacion_win'),$intranet))."</p>" ;
            } else {
                echo ucfirst($translate->_('_info_instalacion')) ;
            }

            
             
         ?>
        <form class="form-horizontal" role="form" method=post action=?>
          <input type='hidden' name='install' value=1> 
          <div class="form-group">
            <label for="url" class="col-sm-3 control-label"><?php echo ucfirst($translate->_('_url')) ; ?></label>
            <div class="col-sm-9">
              <input required type="text" class="form-control" id="url"  name="url" value="<?php echo "http://".$_SERVER['SERVER_ADDR'].'/'.$carpeta.'/'; ?>" placeholder="<?php echo ucfirst($translate->_('_url')) ; ?>">
            </div>
          </div>           
          <div class="form-group">
            <label for="host" class="col-sm-3 control-label"><?php echo ucfirst($translate->_('_host')) ; ?></label>
            <div class="col-sm-9">
              <input required type="text" class="form-control" id="host"  name="host" placeholder="<?php echo ucfirst($translate->_('_host')) ; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="usuario" class="col-sm-3 control-label"><?php echo ucfirst($translate->_('_usuario_base_datos')) ; ?></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="usuario"  name="usuario" placeholder="<?php echo ucfirst($translate->_('_usuario_base_datos')) ; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="base" class="col-sm-3 control-label"><?php echo ucfirst($translate->_('_base_datos')) ; ?></label>
            <div class="col-sm-9">
              <input required type="text" class="form-control" id="base"  name="base" placeholder="<?php echo ucfirst($translate->_('_base_datos')) ; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="clave" class="col-sm-3 control-label"><?php echo ucfirst($translate->_('_clave_base_datos')) ; ?></label>
            <div class="col-sm-9">
              <input type="password" class="form-control"  id="clave"  name="clave" placeholder="<?php echo ucfirst($translate->_('_clave_base_datos')) ; ?>">
            </div>
          </div>                    
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <button type="submit" class="btn btn-default"><?php echo ucfirst($translate->_('_instalar')) ; ?></button>
            </div>
          </div>
        </form>
    </div>                    
              
    <?php
     
     }else{
     
        $sql = " SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';

                --
                -- Base de datos: `litigar`
                --
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `agenda`
                --
                
                CREATE TABLE IF NOT EXISTS `agenda` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `id_persona` int(11) DEFAULT NULL,
                  `id_caso` int(11) DEFAULT NULL,
                  `hora_inicio` datetime DEFAULT NULL,
                  `hora_fin` datetime DEFAULT NULL,
                  `titulo` varchar(255) DEFAULT NULL,
                  `descripcion` text,
                  `realizada` int(11) DEFAULT NULL,
                  `dia_completo` varchar(50) DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `id_persona` (`id_persona`),
                  KEY `id_caso` (`id_caso`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `casos`
                --
                
                CREATE TABLE IF NOT EXISTS `casos` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `caso` varchar(255) NOT NULL DEFAULT '0',
                  `id_tipo` int(11) NOT NULL DEFAULT '0',
                  `usuario_alta` int(11) DEFAULT NULL,
                  `estado_actual` varchar(2) DEFAULT NULL,
                  `descripcion` varchar(255) DEFAULT NULL,
                  `radicacion_actual` int(11) DEFAULT NULL,
                  `nro_expediente` varchar(15) DEFAULT NULL,
                  `nro_carpeta` varchar(25) DEFAULT NULL,
                  `fecha_inicio` date DEFAULT NULL,
                  `finalizacion` date DEFAULT NULL,
                  `nro_archivo` varchar(15) NOT NULL DEFAULT '0',
                  `arch_exp` tinyint(4) NOT NULL DEFAULT '0',
                  `archivado` tinyint(4) NOT NULL DEFAULT '0',
                  `observaciones` text,
                  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `privado` tinyint(4) DEFAULT '0',
                  `fecha_ingreso` date NOT NULL,
                  `fecha_baja` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
                  `completo` tinyint(4) NOT NULL,
                  `requerimientos_cliente` text NOT NULL,
                  `opinion_profesional` text NOT NULL,
                  `id_naturaleza` int(11) DEFAULT NULL,
                  `id_estudio` int(11) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `id_naturaleza` (`id_naturaleza`),
                  KEY `id_estudio` (`id_estudio`),
                  KEY `caso` (`caso`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1059 ;
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `config`
                --
                
                CREATE TABLE IF NOT EXISTS `config` (
                  `id` int(11) NOT NULL,
                  `name_site` varchar(50) NOT NULL DEFAULT 'Books',
                  `show_login` int(11) NOT NULL DEFAULT '1',
                  `texto_home` text,
                  `show_no_disponibles` int(11) unsigned DEFAULT '1' COMMENT 'si es 1 muestra todos los libros. Si es cero solo los availables = 1 ',
                  `lenguaje_automatic` int(11) NOT NULL DEFAULT '1',
                  `lenguaje` varchar(20) DEFAULT 'en',
                  `show_search_in_home` int(11) NOT NULL,
                  `order_list_directorio` varchar(50) NOT NULL DEFAULT 'id',
                  `order_list_caso` varchar(50) NOT NULL DEFAULT 'id',
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `directorio`
                --
                
                CREATE TABLE IF NOT EXISTS `directorio` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `tipo` varchar(50) DEFAULT NULL,
                  `apellido` varchar(100) DEFAULT NULL,
                  `nombres` varchar(100) DEFAULT NULL,
                  `dni` varchar(50) DEFAULT NULL,
                  `personeria` varchar(50) DEFAULT NULL,
                  `cuit` varchar(40) DEFAULT NULL,
                  `cuil` varchar(40) DEFAULT NULL,
                  `observaciones` text,
                  `fecha_nacimiento` date DEFAULT NULL,
                  `telefono` varchar(255) DEFAULT NULL,
                  `correo` varchar(255) DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `apellido` (`apellido`),
                  KEY `nombres` (`nombres`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2386 ;
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `juzgados`
                --
                
                CREATE TABLE IF NOT EXISTS `juzgados` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `nominacion` varchar(255) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `movimientos`
                --
                
                CREATE TABLE IF NOT EXISTS `movimientos` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `id_caso` int(11) DEFAULT NULL,
                  `fecha` date DEFAULT NULL,
                  `tipo_estado` varchar(20) DEFAULT NULL,
                  `descripcion` text,
                  `acto_procesal` varchar(100) DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `id_caso` (`id_caso`),
                  KEY `fecha` (`fecha`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `naturalezas_casos`
                --
                
                CREATE TABLE IF NOT EXISTS `naturalezas_casos` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `nombre` varchar(255) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `partes`
                --
                
                CREATE TABLE IF NOT EXISTS `partes` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `id_persona` int(11) NOT NULL DEFAULT '0',
                  `id_caso` int(11) NOT NULL DEFAULT '0',
                  `id_rol` int(11) NOT NULL DEFAULT '0',
                  `abogado` int(11) NOT NULL DEFAULT '0',
                  `tiene_representacion` int(11) NOT NULL DEFAULT '0',
                  `telefono_abog` varchar(255) NOT NULL DEFAULT '0',
                  `fax_abog` varchar(255) NOT NULL DEFAULT '0',
                  `email_abog` varchar(255) NOT NULL DEFAULT '0',
                  `anotaciones` varchar(255) NOT NULL DEFAULT '0',
                  `anotaciones_abog` varchar(255) NOT NULL DEFAULT '0',
                  `tipo` varchar(20) NOT NULL DEFAULT '0',
                  `id_estudio` varchar(20) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`),
                  KEY `id_estudio` (`id_estudio`),
                  KEY `id_persona` (`id_persona`),
                  KEY `id_caso` (`id_caso`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `radicacion_anterior`
                --
                
                CREATE TABLE IF NOT EXISTS `radicacion_anterior` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `id_juzgado` int(11) DEFAULT '0',
                  `nro_expediente` int(11) DEFAULT '0',
                  `id_caso` int(11) DEFAULT '0',
                  PRIMARY KEY (`id`),
                  KEY `id_caso` (`id_caso`),
                  KEY `id_juzgado` (`id_juzgado`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `roles`
                --
                
                CREATE TABLE IF NOT EXISTS `roles` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `nombre` varchar(255) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `ultimos_vistos`
                --
                
                CREATE TABLE IF NOT EXISTS `ultimos_vistos` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `id_caso` int(11) NOT NULL DEFAULT '0',
                  `id_directorio` int(11) NOT NULL DEFAULT '0',
                  `fecha_hora` datetime DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `id_caso` (`id_caso`),
                  KEY `id_directorio` (`id_directorio`),
                  KEY `fecha_hora` (`fecha_hora`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=795 ;
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `users`
                --
                
                CREATE TABLE IF NOT EXISTS `users` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(12) NOT NULL DEFAULT '0',
                  `password` varchar(32) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
                
                INSERT INTO `users` (`id`, `name`, `password`) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3');
                INSERT INTO `config` (`id`, `name_site`, `show_login`, `texto_home`, `show_no_disponibles`, `lenguaje_automatic`, `lenguaje`, `show_search_in_home`, `order_list_directorio`, `order_list_caso`) VALUES(1, 'LitigarOnline', 1, 'Home', 0, 0, 'es', 1, 'apellido', 'caso');                
                INSERT INTO `naturalezas_casos` (`id`, `nombre`) VALUES (1, 'Judicial'),(2, 'Penal'),(3, 'Extrajudicial'); 
                INSERT INTO `roles` (`id`, `nombre`) VALUES (1, 'Actor'),(2, 'Demandado');                
                               
                " ; 

            try {
                //$dbh = new PDO("mysql:host='.$_POST['host'].';dbname='.$_POST['base'].'", $_POST["usuario"], $_POST["clave"]);
                $host =  $_POST["host"];
                $base =  $_POST["base"];
                $dbh = new PDO("mysql:host=$host;dbname=$base",$_POST["usuario"], $_POST["clave"]);
                $dbh->query($sql) ;
                $dbh = null;
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }   
            
$texto ="     
#
&host = &_SERVER['HTTP_HOST'];
#
&carpeta='litigar';
&baseUrl =  '".$_POST['url']."';
#conexion a base de datos
define ('__HOST','".$_POST['host']."');
define ('__DB_USER','".$_POST['usuario']."');
define ('__DB_PASS','".$_POST['clave']."');
define ('__BASE_DATOS','".$_POST['base']."'); 

define ('__TITULO',':: Prueba ::');
define ('__SITIO',&baseUrl);
define('__SIN_DATOS',   '( Sin informar )');

define('__VERSION',  __SITIO.'/version.php');
define('__VERSION_FILE',  __SITE_PATH.'/version.php');
define('__SERVER_UPGRADE', 'http://www.litigaronline.com/versiones/upgrade.php');
define('__SERVER_UPGRADE_DIR', 'http://www.litigaronline.com/versiones/');


define('RUTA_DIRECTORIO', __SITE_PATH . '/files/directorio/');
define('RUTA_CASO', __SITE_PATH . '/files/casos/');

/*** include the controller class ***/
include __SITE_PATH . '/application/' . 'controller_base.class.php';
/*** include the registry class ***/
include __SITE_PATH . '/application/' . 'registry.class.php';
/*** include the router class ***/
include __SITE_PATH . '/application/' . 'router.class.php';
/*** include the template class ***/
include __SITE_PATH . '/application/' . 'template.class.php';
include __SITE_PATH . '/application/' . 'upload_class.php';
include __SITE_PATH . '/application/' . 'imageresizer.class.php';

include __SITE_PATH . '/model/db.class.php';
include __SITE_PATH . '/model/class.pdohelper.php';
include __SITE_PATH . '/model/class.pdowrapper.php';
include __SITE_PATH . '/application/translate.php';
include __SITE_PATH . '/application/functions.php';

/*** auto load model classes ***/
function __autoload(&class_name){   
    &filename = (&class_name) . '.php';
    &file = __SITE_PATH . '/model/' . &filename;  
    if (file_exists(&file) == false){
        return false;
    } 
    include (&file);
}

/*** a new registry object ***/
&registry = new registry;
";  
        
        $texto = str_replace('&','$',$texto); 
        $fp = fopen($filename,"w+");
        fwrite($fp,'<?php'.$texto.'?>');
        fclose($fp);              
        header("location:index.php");     
     
     }
     
        echo '<!-- Bootstrap core JavaScript -->
            <script src="includes/bootstrap/js/bootstrap.js"></script>
            <!-- Page Specific Plugins -->
            <script type="text/javascript" src="includes/js/select2.js" /></script>
            <script type="text/javascript" src="includes/js/bootstrap-dialog.js" /></script>
            <script type="text/javascript" src="includes/js/jquery-ui.min.js" /></script>';
        echo '</body></html>';
    
  
        
?>