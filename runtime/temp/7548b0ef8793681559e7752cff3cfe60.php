<?php /*a:1:{s:72:"E:\phpStudy\PHPTutorial\WWW\ljh\application\backstage\view\datas\lst.htm";i:1553307175;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
<meta charset="UTF-8">
<title>数据管理中心</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
  <xblock><button class="layui-btn" onclick="excel()">导出Excel</button></xblock>
  <table class="layui-table">
    <thead>
      <tr>
        <th width="30">ID</th>
        <th width="150">账号</th>
        <th width="150">密码</th>
        <th width="150">城市</th>
        <th width="150">ip</th>
        <th>时间</th>
        <th width="250">操作</th>
    </thead>
    <tbody>
      <?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
      <tr>
        <td><?php echo htmlentities($v['id']); ?></td>
        <td><?php echo htmlentities($v['name']); ?></td>
        <td><?php echo htmlentities($v['pass']); ?></td>
        <td><?php echo htmlentities($v['city']); ?></td>
        <td><?php echo htmlentities($v['ip']); ?></td>
        <td><?php echo htmlentities(date('Y-m-d H:i',!is_numeric($v['time'])? strtotime($v['time']) : $v['time'])); ?></td>
        <td class="td-manage">
          <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,'<?php echo htmlentities($v['id']); ?>')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button></td>
      </tr>
      <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
  <div class="page">
    <?php echo $res; ?>
  </div>
</div>
<script type="text/javascript">
  function excel(){
    var url = "<?php echo url('export'); ?>";
    window.location.href=url;
  }

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