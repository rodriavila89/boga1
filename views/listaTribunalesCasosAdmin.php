        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class='inline'><?php echo ucfirst($translate->_('_tribunal')).'</h1>&nbsp;&nbsp;<i class="fa fa-angle-double-right blueiconcolor"></i>&nbsp;&nbsp;<small>'.$tribunal['nominacion'].'</small>' ; ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-right">
                                 <a class="btn btn-info" href="index.php/tribunalesAdmin/"><i class="fa fa-plus"></i>&nbsp;<?php echo ucfirst($translate->_('_lista')) ; ?></a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><?php echo ucfirst($translate->_('_tribunal')) ; ?></th>
                                            <th><?php echo ucfirst($translate->_('_acciones')) ; ?></th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                    <?php
                                        foreach ($casos as $key=>$value) {
                                            echo "<tr class='odd gradeX'>";
                                            echo "<td style='width:85%'><a href='index.php/casosAdmin/view/".$value['id']."/'>".$value['caso']."</a></td>";
                                            echo "<td style='width:15%;' class='text-center'>
                                                    <a class='editar' href='index.php/casosAdmin/edit/".$value['id']."/'><i class='fa fa-pencil-square-o fa-lg blueiconcolor'></i></a></span>&nbsp;
                                                    <a class='ver' href='index.php/casosAdmin/view/".$value['id']."/'><i class='fa fa-info-circle fa-lg greeniconcolor'></i></a>&nbsp;
                                                    <a class='eliminar' href='index.php/casosAdmin/delete/".$value['id']."/'><i class='fa fa-trash-o fa-lg rediconcolor'></i></a>
                                                 </td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        
<?php

    $file =  "english.txt";
    if ($lenguaje_automatic == 1){
        $file =  "english.txt";
    }else{
        if ($lenguaje =='es'){
            $file =  "spanish.txt";    
        }
        if ($lenguaje =='fr'){
            $file =  "french.txt";    
        } 
        if ($lenguaje =='it'){
            $file =  "italian.txt";    
        } 
        if ($lenguaje =='pt'){
            $file =  "portuguese_brasil.txt";    
        }  
        if ($lenguaje =='en'){
            $file =  "english.txt";    
        }                             
    }
    
?>        
        

<script type="text/javascript">
$(document).ready(function() {
    $("#dataTables-example").dataTable( {
        "oLanguage": {
            "sUrl": "<?php echo __SITIO.'includes/js/dataTables/'.$file;?>",
        } ,"iDisplayLength": 50
    } );
    
    $('.editar').tooltip({
        'show': true,
            'placement': 'bottom',
            'title': "<?php echo ucfirst($translate->_('_editar_tool')) ; ?>"
    });    

    $('.ver').tooltip({
        'show': true,
            'placement': 'bottom',
            'title': "<?php echo ucfirst($translate->_('_ver_tool')) ; ?>"
    });
    
    $('.eliminar').tooltip({
        'show': true,
            'placement': 'bottom',
            'title': "<?php echo ucfirst($translate->_('_eliminar_tool')) ; ?>"
    });     
    
    
} );





</script> 
        
