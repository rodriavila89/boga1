      <?php
      
            $config = $this->registry->router->config;
            $name_site = $config['name_site'];
            if (isset($_SESSION['__ID_USER'])){
                $controller = $this->registry->router->controller;
                $action = $this->registry->router->action;
                $agenda_hoy = $this->registry->router->agenda_hoy;
                
      ?>
      <!-- Sidebar -->

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>        
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"><?php echo $name_site;?></a>
               
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <?php echo ucfirst($translate->_('_agenda'));?> <span class="badge"><?php echo count($agenda_hoy);?></span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">
                    <?php
                        $cantidad_agenda = count($agenda_hoy);
                        echo $cantidad_agenda." ".ucfirst($translate->_('_citas_de_agenda'));
                    
                    ?>
               
                </li>
                
                <?php
                
                    foreach ($agenda_hoy as $key=>$value) {
                        $aux = explode(' ',$value['start']);
                        $hora = '';
                        if ($aux[1] !='00:00:00'){
                            $hora = '<br /><span class="time">&nbsp;&nbsp;<i class="fa fa-clock-o"></i>&nbsp;&nbsp;'.$aux[1].'</span>';
                        }
                        echo '<li class="message-preview">';
                        
                        if($value['id_persona'] != null or $value['id_persona'] != ''){
                            $href = "index.php/directorioAdmin/view/".$value['id_persona']."/";
                            $cita = "<span class='avatar'><i class='fa fa-calendar fa-2x rediconcolor'></i></span>&nbsp;";
                            $cita .= "<span class='name'>&nbsp;&nbsp;".ucfirst($translate->_('_cita_de_directorio'))." <b>[ ".$value['title']." ]</b><br />&nbsp;".$value['nombres']." ".$value['apellido']."</span>";
                        }
                       if($value['id_caso'] != null or $value['id_caso'] != ''){
                            $href = "index.php/casosAdmin/view/".$value['id_caso']."/";
                            $cita = "<span class='avatar'><i class='fa fa-calendar fa-2x blueiconcolor'></i></span>&nbsp;";
                            $cita .= "<span class='name'>&nbsp;&nbsp;".ucfirst($translate->_('_cita_de_caso'))." <b>[ ".$value['title']." ]</b><br />&nbsp;".$value['caso']."</span>";
                        }
                        if(($value['id_caso'] == null or $value['id_caso'] == '') and ($value['id_persona'] == null or $value['id_persona'] == '')){
                            $href = "index.php/agendaAdmin/";
                            $cita = "<span class='avatar'><i class='fa fa-calendar fa-2x greeniconcolor'></i></span>&nbsp;";
                            $cita .= "<span class='name'>&nbsp;&nbsp;".ucfirst($translate->_('_cita_general'))." <b>[ ".$value['title']." ]</b></span>";
                        } 
                        echo "<a href='".$href."'>";
                        echo $cita.$hora;
                        echo "</a>";
                        echo "</li>";
                        echo '<li class="divider"></li>';
                    }

                ?>
                <li><a href="index.php/agendaAdmin/"><?php echo ucfirst($translate->_('_ver'))."&nbsp;";?><span class="badge"><?php echo $cantidad_agenda;?></span></a></li>
              </ul>
            </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                       <li><a href="index.php/indexAdmin/profile/"><i class="fa fa-user"></i><?php echo '&nbsp;'.ucfirst($translate->_('_perfil')) ; ?></a></li>
                        <li><a href="index.php/indexAdmin/config/"><i class="fa fa-gear"></i><?php echo '&nbsp;'.ucfirst($translate->_('_configuracion')) ; ?></a></li>
                        <li class="divider"></li>
                        <li><a href="index.php/index/logout/"><i class="fa fa-power-off"></i><?php echo '&nbsp;'.ucfirst($translate->_('_salir')) ; ?></a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>
        <!-- /.navbar-static-top -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="index.php"><i class="fa fa-dashboard fa-fw"></i>&nbsp;<?php echo ucfirst($translate->_('_panel')) ; ?></a>
                    </li>
                    <li>
                        <a href="index.php/casosAdmin"><i class="fa fa-files-o fa-fw"></i>&nbsp;<?php echo ucfirst($translate->_('_casos')) ; ?></a>
                    </li> 

                    <li>
                        <a href="index.php/directorioAdmin/"><i class="fa fa-user fa-fw"></i>&nbsp;<?php echo ucfirst($translate->_('_directorio')) ; ?></a>
                    </li> 
                                                                     
                    <li>
                        <a href="index.php/recorridaAdmin/recorrida/"><i class="fa fa-bell"></i>&nbsp;<?php echo ucfirst($translate->_('_recorridatribunales')) ; ?></a>
                    </li>                      
                                             
                    <li>
                        <a href="index.php/contabilidadAdmin"><i class="fa fa-files-o fa-fw"></i>&nbsp;<?php echo ucfirst($translate->_('_contabilidad')) ; ?></a>
                    </li>                     
                                       
                    <li>
                        <a href="index.php/agendaAdmin/"><i class="fa fa-calendar fa-fw"></i>&nbsp;<?php echo ucfirst($translate->_('_agenda')) ; ?></a>
                    </li>
                    <li <?php if ($controller=='tribunalesAdmin' or $controller=='naturalezasAdmin' or $controller=='rolesAdmin' or $controller=='conceptosAdmin') echo "class='active';" ?>>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>&nbsp;<?php echo ucfirst($translate->_('_configuracion')) ; ?><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="index.php/tribunalesAdmin/">&nbsp;<?php echo ucfirst($translate->_('_tribunales')) ; ?></a>
                            </li>
                            <li>
                                <a href="index.php/naturalezasAdmin/">&nbsp;<?php echo ucfirst($translate->_('_naturalezas')) ; ?></a>
                            </li>
                            <li>
                                <a href="index.php/rolesAdmin/">&nbsp;<?php echo ucfirst($translate->_('_roles')) ; ?></a>
                            </li> 
                            <li>
                                <a href="index.php/conceptosAdmin/">&nbsp;<?php echo ucfirst($translate->_('_conceptos_contables')) ; ?></a>
                            </li>
                            <li>
                                <a href="index.php/upgradeAdmin/">&nbsp;<?php echo ucfirst($translate->_('_actualizaciones')) ; ?></a>
                            </li>                                                        
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>  
                    <li>
                        <a href="index.php/indexAdmin/acerca/"><i class="fa fa-rocket fa-fw"></i>&nbsp;<?php echo ucfirst($translate->_('_about')) ; ?></a>
                    </li>                                                           
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>


      
      <?php
      
            }
      
      ?>
             
