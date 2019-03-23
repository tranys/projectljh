<?php /*a:4:{s:74:"E:\phpStudy\PHPTutorial\WWW\ljh\application\backstage\view\index\index.htm";i:1553302906;s:74:"E:\phpStudy\PHPTutorial\WWW\ljh\application\backstage\view\common\head.htm";i:1553305218;s:74:"E:\phpStudy\PHPTutorial\WWW\ljh\application\backstage\view\common\left.htm";i:1553306741;s:76:"E:\phpStudy\PHPTutorial\WWW\ljh\application\backstage\view\common\footer.htm";i:1551574647;}*/ ?>
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
<body>
<!-- 顶部开始 --> 
<div class="container">
  <div class="logo"><a href="<?php echo url('backstage/index/index'); ?>">CMS</a></div>
  <div class="left_open"> <i title="展开左侧栏" class="iconfont">&#xe699;</i> </div>
  <ul class="layui-nav right" lay-filter="">
    <li class="layui-nav-item"> <a href="javascript:;"><?php echo htmlentities($uname); ?></a>
      <dl class="layui-nav-child">
        <dd><a href="<?php echo url('Logout/logout'); ?>">退出</a></dd>
      </dl>
    </li>
    <li class="layui-nav-item to-index"><a href="/" target="_blank">前台首页</a></li>
  </ul>
</div>
 
<!-- 顶部结束 --> 
<!-- 中部开始 --> 
<!-- 左侧菜单开始 --> 
<div class="left-nav">
  <div id="side-nav">
    <ul id="nav">
      <li> <a href="javascript:;"> <i class="iconfont">&#xe723;</i> <cite>数据管理</cite> <i class="iconfont nav_right">&#xe697;</i> </a>
        <ul class="sub-menu">
          <li> <a _href="<?php echo url('datas/lst'); ?>"> <i class="iconfont">&#xe6a7;</i> <cite>数据列表</cite> </a> </li >
        </ul>
      </li>
      <?php if($userStatus == 1): ?>
      <li> <a href="javascript:;"> <i class="iconfont">&#xe723;</i> <cite>用户管理</cite> <i class="iconfont nav_right">&#xe697;</i> </a>
        <ul class="sub-menu">
          <li> <a _href="<?php echo url('user/lst'); ?>"> <i class="iconfont">&#xe6a7;</i> <cite>用户列表</cite> </a> </li >
        </ul>
      </li>
      <li> <a href="javascript:;"> <i class="iconfont">&#xe723;</i> <cite>权限配置</cite> <i class="iconfont nav_right">&#xe697;</i> </a>
        <ul class="sub-menu">
          <li> <a _href="<?php echo url('auth_rule/lst'); ?>"> <i class="iconfont">&#xe6a7;</i> <cite>规则管理</cite> </a> </li >
          <li> <a _href="<?php echo url('auth_group/lst'); ?>"> <i class="iconfont">&#xe6a7;</i> <cite>用户组管理</cite> </a> </li >
        </ul>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</div>
<!-- <div class="x-slide_left"></div> --> 
<!-- 左侧菜单结束 --> 
<!-- 右侧主体开始 -->
<div class="page-content">
  <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
    <ul class="layui-tab-title">
      <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
        <iframe src="<?php echo url('index/welcome'); ?>" frameborder="0" scrolling="yes" class="x-iframe"></iframe>
      </div>
    </div>
  </div>
</div>
<div class="page-content-bg"></div>
<!-- 右侧主体结束 --> 
<!-- 中部结束 --> 
<!-- 底部开始 --> 
<div class="footer">
  <div class="copyright">Copyright ©2017 x-admin v2.3 All Rights Reserved</div>
</div>
 
<!-- 底部结束 -->
</body>
</html>