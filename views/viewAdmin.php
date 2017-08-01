<?php
        echo '<!DOCTYPE html>
                <html lang="en">
                    <head>
                        <base href="'.__SITIO.'"/>
                        <meta charset="iso8859-1">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta name="description" content="">
                        <meta name="author" content="">                        
                        <title>:: '.$name_site.' ::</title>     
                        <script src="'.__SITIO.'/includes/js/jquery-1.10.2.min.js"></script>
                        <script src="'.__SITIO.'/includes/js/jquery-ui.min.js"></script>
                        
                        <link href="'.__SITIO.'/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
                        <link href="'.__SITIO.'/includes/bootstrap/css/sb-admin.css" rel="stylesheet"/>
                        <link href="'.__SITIO.'/includes/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>                        
                        <link href="'.__SITIO.'/includes/css/select2.css" rel="stylesheet">
                        <link href="'.__SITIO.'/includes/css/bootstrap-dialog.css" rel="stylesheet">
                        <link href="'.__SITIO.'/includes/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
                        <link href="'.__SITIO.'/includes/css/styled.css" rel="stylesheet">
                        <link href="'.__SITIO.'/includes/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
                        <link href="'.__SITIO.'/includes/css/plugins/datepicker/bootstrap-datetimepicker.css" rel="stylesheet" />
                        <link href="'.__SITIO.'/includes/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" />
                        <link href="'.__SITIO.'/includes/css/bootstrap-switch.min.css" rel="stylesheet" />
                        
                        <script type="text/javascript" src="'.__SITIO.'/includes/js/javasrc.js" /></script>
                        <script type="text/javascript" src="'.__SITIO.'/includes/js/upload/jquery.fileupload.js" /></script>
                        <script type="text/javascript" src="'.__SITIO.'/includes/js/upload/jquery.iframe-transport.js" /></script>
                        <script type="text/javascript" src="'.__SITIO.'/includes/js/bootstrap-switch.min.js" /></script>
                        
                    </head>
                    <body><div  id="wrapper">';
        include (__SITE_PATH.'/views/menu.php');            
        include ($path); 
        echo '        
        <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modallabel"></h4>
              </div>
              <div class="modal-body" id="modalbody">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnok" class="btn btn-primary">Ok</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->';        


    echo '</div>
            <!-- Bootstrap core JavaScript -->
            <script src="'.__SITIO.'/includes/bootstrap/js/bootstrap.js"></script>
            <!-- Page Specific Plugins -->
            <script type="text/javascript" src="'.__SITIO.'/includes/js/sb-admin.js" /></script>
            <script type="text/javascript" src="'.__SITIO.'/includes/js/select2.js" /></script>
            <script type="text/javascript" src="'.__SITIO.'/includes/js/moment.js" /></script>
            <script type="text/javascript" src="'.__SITIO.'/includes/js/datepicker/bootstrap-datetimepicker.js" /></script>
            <script type="text/javascript" src="'.__SITIO.'/includes/js/morris/raphael-2.1.0.min.js" /></script>
            <script type="text/javascript" src="'.__SITIO.'/includes/js/morris/morris.js" /></script>
            <script type="text/javascript" src="'.__SITIO.'/includes/js/bootstrap-dialog.js" /></script>
            <script type="text/javascript" src="'.__SITIO.'/includes/js/metisMenu/jquery.metisMenu.js" /></script
            <script type="text/javascript" src="'.__SITIO.'/includes/js/jquery-ui.min.js" /></script> 
            <script type="text/javascript" src="'.__SITIO.'/includes/js/dataTables/jquery.dataTables.js"></script>
            <script type="text/javascript" src="'.__SITIO.'/includes/js/fullcalendar/fullcalendar.js"></script>
            <script type="text/javascript" src="'.__SITIO.'/includes/js/dataTables/dataTables.bootstrap.js"></script>';
        echo '</body></html>';
        
?>        