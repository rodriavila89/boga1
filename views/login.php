<style>

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
<div class="container">
      <div>
        <div class="row">
          <div class="col-lg-12">
      <form class="form-signin" method="post" action="index.php/index/login_bd/">
        <h2 class="form-signin-heading"><?php echo ucfirst($translate->_('_registrarse')) ; ?></h2>
        <input type="text" class="form-control" placeholder="<?php echo ucfirst($translate->_('_usuario')) ; ?>" id="user"  name="user" required autofocus> <br>
        <input type="password" class="form-control" placeholder="<?php echo ucfirst($translate->_('_clave')) ; ?>" required  id="password" name="password">
        <!-- 
        <label class="checkbox">
          <input type="checkbox" value="remember-me" id="check"> Remember me
        </label>  -->
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo ucfirst($translate->_('_ingresar')) ; ?></button>
      </form>

          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->
</div>      
