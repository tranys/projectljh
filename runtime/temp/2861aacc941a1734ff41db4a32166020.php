<?php /*a:1:{s:71:"E:\phpStudy\PHPTutorial\WWW\ljh\application\backstage\view\user\lst.htm";i:1553304065;}*/ ?>
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
    <button class="layui-btn" onclick="x_admin_show('添加','/backstage/user/add')"><i class="layui-icon"></i>增加</button>
    <span class="x-right" style="line-height:40px">共有数据：<?php echo htmlentities($nums); ?> 条</span> </xblock>
  <table class="layui-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>登录名</th>
        <th>角色</th>
        <th>加入时间</th>
        <th>上次登录</th>
        <th>状态</th>
        <th>操作</th>
    </thead>
    <tbody>
      <?php if(is_array($adminRes) || $adminRes instanceof \think\Collection || $adminRes instanceof \think\Paginator): $i = 0; $__LIST__ = $adminRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <tr>
        <td><?php echo htmlentities($vo['id']); ?></td>
        <td><?php echo htmlentities($vo['uname']); ?></td>
        <td><?php echo htmlentities($vo['groupname']); ?></td>
        <td><?php echo htmlentities(date("Y-m-d H:i:s",!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></td>
        <td><?php echo htmlentities(date("Y-m-d H:i:s",!is_numeric($vo['last_time'])? strtotime($vo['last_time']) : $vo['last_time'])); ?></td>
        <td class="td-status"><span <?php if($vo['status'] == 1): ?> class="layui-btn layui-btn-normal" <?php else: ?> class="layui-btn layui-btn-danger" <?php endif; ?> id="<?php echo htmlentities($vo['id']); ?>" onclick="changestatus(this)"><?php if($vo['status'] == 1): ?>启用<?php else: ?>禁用<?php endif; ?></span></td>
        <td class="td-manage">
          <button class="layui-btn layui-btn layui-btn-xs"  onclick="x_admin_show('编辑','/backstage/user/edit.html?id=<?php echo htmlentities($vo['id']); ?>')" ><i class="layui-icon">&#xe642;</i>编辑</button>
          <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,'<?php echo htmlentities($vo['id']); ?>')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
        </td>
      </tr>
      <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
</div>
<script>
layui.use('laydate', function(){
  var laydate = layui.laydate;
  
  //执行一个laydate实例
  laydate.render({
    elem: '#start' //指定元素
  });

  //执行一个laydate实例
  laydate.render({
    elem: '#end' //指定元素
  });
});
function changestatus(o){
    var id = $(o).attr('id');
    $.post("<?php echo url('changestatus'); ?>",{'id':id},function(data){
      if(data==1){
        $(o).removeClass();
        $(o).addClass('layui-btn layui-btn-danger');
        $(o).text("禁用");
      }else if(data==0){
        layer.msg('禁止修改系统管理员状态！',{icon:2,time:1000});
      }else{
        $(o).removeClass();
        $(o).addClass('layui-btn layui-btn-normal');
        $(o).text("启用");
      }
    });
}
function member_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        //发异步删除数据
        $.post("<?php echo url('del'); ?>",{'id':id},function(data){
          if(data==1){
            $(obj).parents("tr").remove();
            layer.msg('删除成功!',{icon:1,time:1000});
          }else if(data==0){
            layer.msg('禁止删除系统管理员!',{icon:2,time:1000});
          }else{
            layer.msg('删除失败!',{icon:2,time:1000});
          }
        });
    });
}
</script> 
</body>
</html>