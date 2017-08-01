<?php
        echo '<!DOCTYPE html>
                <html lang="en">
                    <head>
                        <base href="'.__SITIO.'"/>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta name="description" content="">
                        <meta name="author" content="">                        
                        <title>:: '.$name_site.' ::</title>     
                        <script src="'.__SITIO.'/includes/js/jquery-1.10.2.min.js"></script>
                        <link href="'.__SITIO.'/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
                        <link href="'.__SITIO.'/includes/bootstrap/css/sb-admin.css" rel="stylesheet"/>
                        <link href="'.__SITIO.'/includes/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>                        
                        <link href="'.__SITIO.'/includes/css/styled.css" rel="stylesheet">
                        <link href="'.__SITIO.'/includes/css/styled_public.css" rel="stylesheet">
                        <script type="text/javascript" src="'.__SITIO.'/includes/js/javasrc.js" /></script>
                    </head>
                    <body><div>
                        <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
                          <div class="container">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="index.php" >'.$name_site.'</a>
                            </div>
                            <div class="collapse navbar-collapse">
                              <ul class="nav navbar-nav">
                                <li><a href="'.__SITIO.'index.php/index/login/">'.ucfirst($translate->_('_login')).'</a></li>';
                                
                              echo '</ul>
                            </div><!-- /.nav-collapse -->
                          </div><!-- /.container -->
                        </div><!-- /.navbar -->  

                    ';
            
        include ($path); 
     


    echo '</div>
            <!-- Bootstrap core JavaScript -->
            <script src="'.__SITIO.'/includes/bootstrap/js/bootstrap.js"></script>
            <!-- Page Specific Plugins -->
            <script type="text/javascript" src="'.__SITIO.'/includes/js/sb-admin.js" /></script>
            <script type="text/javascript" src="'.__SITIO.'/includes/js/metisMenu/jquery.metisMenu.js" /></script
            <script type="text/javascript" src="'.__SITIO.'/includes/js/jquery-ui.min.js" /></script>'; 
        echo '</body></html>';
        
?>              