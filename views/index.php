<?php
        if (isset($_SESSION['__ID_USER'])){
            include (__SITE_PATH.'/views/indexAdmin.php');  
        }else{
            include (__SITE_PATH.'/views/indexPublic.php'); 
        }

?>