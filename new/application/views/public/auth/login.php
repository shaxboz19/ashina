<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Admin panel "Online Service Group"</title>
    <meta name="author" content="OSG" />
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/admin/img/favicon.ico" />    
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/newlogin/css/reset.css">    
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>    
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/newlogin/css/style.css">    
    <script type="text/javascript" src="<?=base_url()?>assets/admin/js/jquery/jquery.min.js"></script>    
    <script src="<?=base_url()?>assets/admin/newlogin/js/index.js"></script>  
  </head>

  <body>

<style>
body {
 background: url(<?=base_url()?>assets/admin/newlogin/bg.jpg) top repeat !important;
}
.alert{
    padding: 10px;
text-align: center;
color: red;
margin-left: 55px;
margin-right: 55px;
font-size: 18px;
}
#password:-webkit-autofill, #username:-webkit-autofill{
    height: 35px !important;
       margin-top: 15px;
}
</style>
<script>
$(window).resize(function(){
    $('.login_form').css({
        position:'absolute',
        left: ($(window).width() - $('.login_form').outerWidth())/2,
        top: ($(window).height() - $('.login_form').outerHeight())/2
    });   
});

$(window).resize();
</script>
<div class="rerun">
<a href="https://osg.uz/" title="Online Service Group"><img src="<?=base_url()?>assets/admin/newlogin/logo.png" /></a>
</div>
<div class="container">
  <div class="card"></div>
  <div class="card">
  <?=msg()?>
    <h1 class="title"><span>Вход в панель</span> OSG CMS</h1>
     <?=form_open()?>
      <div class="input-container">
        <input type="text" id="username" name="username" required="required"/>
        <label for="Username">Пользователь</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="password" name="password" required="required"/>
        <label for="Password">Пароль</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button><span>Вход в систему</span></button>
      </div>      
    </form>
    
  </div>
  <div class="copy">
    <a href="https://osg.uz/" title="Online Service Group"><p> OOO "Online Service Group"</p></a>
    <p>&copy; <?=date('Y')?>. Все права защищены.</p>
    </div> 
</div>   

  </body>
</html>