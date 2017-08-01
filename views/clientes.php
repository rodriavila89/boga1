<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Clientes</h1>
        </div>
    </div>

        <div class="row">
            <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Clientes
                        </div>
                        <div class="panel-body">
                            <form action='index.php/index/loginCliente/' method=post >
                            
                            <div class="form-group">
            				    <label for="nominacion"><?php echo ucfirst($translate->_('_ingreseclavecliente')) ; ?></label>
                                    <input type="password" class="form-control" id="clave" name="clave"  required />
            				</div>    

                              <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                              </div>                                                     
                            
                            </form>
                        </div>
                        <div class="panel-footer">
                            <p class="text-right">
                                
                            </p>
                        </div>
                    </div>

                 
          </div><!-- /.row -->
     </div> 
</div>