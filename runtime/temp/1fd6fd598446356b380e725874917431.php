<?php /*a:1:{s:77:"E:\phpStudy\PHPTutorial\WWW\ljh\application\backstage\view\auth_group\key.htm";i:1551687773;}*/ ?>
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
  <form class="layui-form">
    <input type="hidden" name="id" value="<?php echo htmlentities($authGroups['id']); ?>">
    <blockquote class="layui-elem-quote" style="font-size: 16px;font-weight: 600;"><?php echo htmlentities($authGroups['title']); ?></blockquote>
    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <div class="layui-input-block">
        <table class="layui-table" style="width: 1300px !important;">
          <thead>
              <tr>
                  <th style="width:15px;">
                      <input id="chkAll" value="全选" type="checkbox" lay-skin="primary" lay-filter="allChoose">
                  </th>
                  <th style="width:50px;"><span class="text">一级权限</span></th>
                  <th><span class="text">二级权限</span></th>
              </tr>
          </thead>
          <tbody>
              <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
              <tr>
                  <td>
                      <input <?php if(in_array($vo['id'],$rules)){echo 'checked="checked"';}?> id="<?php echo htmlentities($vo['id']); ?>" value="<?php echo htmlentities($vo['id']); ?>" name="rules[]" dataid="id-<?php echo htmlentities($vo['id']); ?>" lay-skin="primary" type="checkbox" value="true" class="checkbox-parent" lay-filter="allChoose1">
                  </td>
                  <td><input <?php if(in_array($vo['id'],$rules)){echo 'checked="checked"';}?> id="<?php echo htmlentities($vo['id']); ?>" value="<?php echo htmlentities($vo['id']); ?>" name="rules[]" dataid="id-<?php echo htmlentities($vo['id']); ?>" type="checkbox" value="true" title="<?php echo htmlentities($vo['title']); ?>" class="checkbox-parent"></td>
                  <td>
                    <?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): if( count($vo['children'])==0 ) : echo "" ;else: foreach($vo['children'] as $key=>$vo2): ?>
                      <input <?php if(in_array($vo2['id'],$rules)){echo 'checked="checked"';}?> id="<?php echo htmlentities($vo2['id']); ?>" value="<?php echo htmlentities($vo2['id']); ?>" name="rules[]" dataid="id-<?php echo htmlentities($vo['id']); ?>-<?php echo htmlentities($vo2['id']); ?>" title="<?php echo htmlentities($vo2['title']); ?>" class="checkbox-child" name="form-field-checkbox" type="checkbox" value="true">
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </td>
              </tr>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
      </table>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="L_repass" class="layui-form-label"> </label>
      <button  class="layui-btn" lay-filter="*" lay-submit=""> 提交 </button>
    </div>
  </form>
</div>
<script>
  layui.use(['form','layer'], function(){
      $ = layui.jquery;
    var form = layui.form
    ,layer = layui.layer;

    form.on('checkbox(allChoose)', function(data){
      var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
      child.each(function(index, item){
          item.checked = data.elem.checked;
      });
      form.render('checkbox');
    });

    form.on('checkbox(allChoose1)', function(data){
      var child = $(data.elem).parents('tr').find('input[type="checkbox"]');
      child.each(function(index, item){
          item.checked = data.elem.checked;
      });
      form.render('checkbox');
    });

    //监听提交
    form.on('submit(*)', function(data){
      $.post("<?php echo url('key'); ?>",data.field,function(data){
        if(data=1){
          layer.alert("提交成功！", {icon: 6},function () {
            // 获得frame索引
            var index = parent.layer.getFrameIndex(window.name);
            //关闭当前frame
            parent.layer.close(index);
            window.parent.location.reload();
          });
        }
      });
      return false;
    });
    
    
  });


  $(function () {
    //动态选择框，上下级选中状态变化
    $('input.checkbox-parent').on('change', function () {
        var dataid = $(this).attr("dataid");
        $('input[dataid^=' + dataid + ']').prop('checked', $(this).is(':checked'));
    });
    $('input.checkbox-child').on('change', function () {
        var dataid = $(this).attr("dataid");
        dataid = dataid.substring(0, dataid.lastIndexOf("-"));
        var parent = $('input[dataid=' + dataid + ']');
        if ($(this).is(':checked')) {
            parent.prop('checked', true);
            //循环到顶级
            while (dataid.lastIndexOf("-") != 2) {
                dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                parent = $('input[dataid=' + dataid + ']');
                parent.prop('checked', true);
            }
        } else {
            //父级
            if ($('input[dataid^=' + dataid + '-]:checked').length == 0) {
                parent.prop('checked', false);
                //循环到顶级
                while (dataid.lastIndexOf("-") != 2) {
                    dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                    parent = $('input[dataid=' + dataid + ']');
                    if ($('input[dataid^=' + dataid + '-]:checked').length == 0) {
                        parent.prop('checked', false);
                    }
                }
            }
        }
    });
});
</script>
</body>
</html>