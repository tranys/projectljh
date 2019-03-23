<?php /*a:1:{s:74:"E:\phpStudy\PHPTutorial\WWW\ljh\application\backstage\view\login\index.htm";i:1553306003;}*/ ?>
<!doctype html>
<html  class="x-admin-sm">
<head>
<meta charset="UTF-8">
<title>后台登录-X-admin2.1</title>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="stylesheet" href="/static/css/font.css">
<link rel="stylesheet" href="/static/css/xadmin.css">
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="/static/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/static/js/xadmin.js"></script>
<script type="text/javascript" src="/static/js/cookie.js"></script>
</head>
<body class="login-bg">
<div class="login layui-anim layui-anim-up">
  <div class="message">x-admin2.0-管理登录</div>
  <div id="darkbannerwrap"></div>
  <form method="post" class="layui-form" >
    <input name="uname" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
    <hr class="hr15">
    <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
    <hr class="hr15">
    <input name="code" placeholder="验证码"  type="text" lay-verify="required" class="layui-input" style="width: 50%;float: left;">
    <img src="<?php echo captcha_src(); ?>" onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random();" style="cursor: pointer;height: 50px;width: 50%;">
    <hr class="hr15">
    <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
    <hr class="hr20" >
  </form>
</div>
<script>
  $(function  () {
      layui.use('form', function(){
        var form = layui.form;
        //监听提交
        form.on('submit(login)', function(data){
          $.post("<?php echo url('login/index'); ?>",data.field,function(data){
            if(data==1){
              layer.msg('您已登陆，请勿重复登陆！', {icon: 6});
              window.location.href="<?php echo url('backstage/index/index'); ?>";
            }else if(data==2){
              layer.msg('验证码错误，请重试！', {icon: 5}); 
            }else if(data==3){
              layer.msg('登陆成功！', {icon: 6}); 
              window.location.href="<?php echo url('backstage/index/index'); ?>";
            }else if(data==4){
              layer.msg('该账户已停用！', {icon: 5}); 
            }else{
              layer.msg('用户名或密码错误，请重试！', {icon: 5}); 
            }
          });
          return false;
        });
      });
  })
</script> 
<!-- 底部结束 --> 
</body>
</html>