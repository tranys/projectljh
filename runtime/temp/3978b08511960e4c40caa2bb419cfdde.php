<?php /*a:1:{s:76:"E:\phpStudy\PHPTutorial\WWW\ljh\application\backstage\view\auth_rule\lst.htm";i:1551683033;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
<meta charset="UTF-8">
<title>欢迎页面-X-admin2.1</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
<link rel="stylesheet" href="/static/css/font.css">
<link rel="stylesheet" href="/static/css/xadmin.css">
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/static/js/xadmin.js"></script>
<script type="text/javascript" src="/static/js/cookie.js"></script>
<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
<!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
  <xblock>
    <button class="layui-btn" onclick="x_admin_show('添加','add.html')"><i class="layui-icon"></i>增加</button>
    <span class="x-right" style="line-height:40px">共有数据：<?php echo htmlentities($nums); ?> 条</span> </xblock>
  <table class="layui-table layui-form">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th >规则名称</th>
        <th >规则</th>
        <th width="25%" >操作</th>
    </thead>
    <tbody class="x-cate">
      <?php if(is_array($authRules) || $authRules instanceof \think\Collection || $authRules instanceof \think\Paginator): $i = 0; $__LIST__ = $authRules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <tr cate-id='<?php echo htmlentities($vo['id']); ?>' fid='<?php echo htmlentities($vo['pid']); ?>' >
        <td><?php echo htmlentities($vo['id']); ?></td>
        <td><?php if($vo['pid'] == '0'): ?><i class="layui-icon x-show" status='true'>&#xe623;</i><?php endif; if($vo['pid'] != '0'): ?>&nbsp;&nbsp;&nbsp;&nbsp;├<?php endif; ?>&nbsp;<?php echo htmlentities($vo['title']); ?></td>
        <td><?php echo htmlentities($vo['name']); ?></td>
        <td class="td-manage"><button class="layui-btn layui-btn layui-btn-xs"  onclick="x_admin_show('编辑','edit.html?id=<?php echo htmlentities($vo['id']); ?>')" ><i class="layui-icon">&#xe642;</i>编辑</button>
          <button <?php if($vo['pid'] != 0): ?> onclick="layer.msg('子级禁止添加！', {icon: 5});;" <?php endif; ?> class="layui-btn layui-btn-warm layui-btn-xs"  onclick="x_admin_show('编辑','add.html?pid=<?php echo htmlentities($vo['id']); ?>')" ><i class="layui-icon">&#xe642;</i>添加子栏目</button>
          <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,'<?php echo htmlentities($vo['id']); ?>')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button></td>
      </tr>
      <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
</div>
<script>
  layui.use(['form'], function(){
    form = layui.form;
  });
  /*单栏目-删除*/
  function member_del(obj,id){
      layer.confirm('确认要删除吗？',function(index){
          //发异步删除数据
          $.post("<?php echo url('del'); ?>",{'id':id},function(data){
            if(data=1){
              $(obj).parents("tr").remove();
              layer.msg('删除成功!',{icon:1,time:1000});
            }else{
              layer.msg('删除失败!',{icon:2,time:1000});
            }
          });
      });
  }
</script>
</body>
</html>