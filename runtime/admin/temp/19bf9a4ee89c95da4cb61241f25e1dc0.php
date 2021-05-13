<?php /*a:2:{s:39:"E:\tp\src\app\admin\view\adminlist.html";i:1620819166;s:43:"E:\tp\src\app\admin\view\common\common.html";i:1620819180;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理中心</title>
  <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css" />
</head>
<body>
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo layui-hide-xs layui-bg-black">应急响应中心</div>
    <!-- 头部区域（可配合layui 已有的水平导航） -->
            <ul class="layui-nav layui-layout-left">
                <!-- 移动端显示 -->
                <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-header-event="menuLeft">
                    <i class="layui-icon layui-icon-spread-left"></i>
                </li>
                <li class="layui-nav-item layui-hide-xs "><a href="<?php echo url('index/index'); ?>"><i class="layui-icon layui-icon-home"></i> 主页</a></li>
                <li class="layui-nav-item layui-hide-xs"><a href="">nav 3</a></li>
                <li class="layui-nav-item">
                    <a href="javascript:;">其他配置</a>
                    <dl class="layui-nav-child">
                        <dd><a href="">menu 11</a></dd>
                        <dd><a href="">menu 22</a></dd>
                        <dd><a href="">menu 33</a></dd>
                    </dl>
                </li>
            </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item layui-hide layui-show-md-inline-block">
        <a href="javascript:;">
          <img src="//tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg" class="layui-nav-img">
          tester
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">管理资料</a></dd>
          <dd><a href="">退出系统</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item" lay-header-event="menuRight" lay-unselect>
        <a href="javascript:;">
          <i class="layui-icon layui-icon-more-vertical"></i>
        </a>
      </li>
    </ul>
  </div>

  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree" lay-filter="test" lay-shrink="all">
        <li class="layui-nav-item">
          <a class="" href="javascript:;"><i class="layui-icon layui-icon-senior"></i> 漏洞管理</a>
          <dl class="layui-nav-child">
            <dd class=""><a href="<?php echo url('bug/index'); ?>">漏洞列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;"><i class="layui-icon layui-icon-release"></i> 文章管理</a>
          <dl class="layui-nav-child">
            <dd class=""><a href="<?php echo url('post/addpost'); ?>">添加文章</a></dd>
            <dd class=""><a href="<?php echo url('post/index'); ?>">文章列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;"><i class="layui-icon layui-icon-gift" style="font-size: 18px;"></i> 活动管理</a>
          <dl class="layui-nav-child">
            <dd class=""><a href="<?php echo url('gift/add'); ?>">添加活动</a></dd>
            <dd class=""><a href="<?php echo url('gift/list'); ?>">活动列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;"><i class="layui-icon layui-icon-group"></i> 用户管理</a>

          <dl class="layui-nav-child">
            <ul class="layui-nav layui-nav-tree" >
              <li class="layui-nav-item" >
                <a href="javascript:;"><i class="layui-icon layui-icon-user"></i>普遍用户</a>
                <dl class="layui-nav-child">
                  <dd class=""><a href="<?php echo url('user/add'); ?>">添加用户</a></dd>
                  <dd class=""><a href="<?php echo url('user/list'); ?>">用户列表</a></dd>
                </dl>
              </li>

              <li class="layui-nav-item" >
                <a href="javascript:;"><i class="layui-icon layui-icon-friends"></i>后台用户</a>
                <dl class="layui-nav-child">
                  <dd class=""><a href="<?php echo url('admin/add'); ?>">添加用户</a></dd>
                  <dd class="
layui-this
"><a href="<?php echo url('admin/list'); ?>">用户列表</a></dd>
                </dl>
              </li>
            </ul>

          </dl>

        </li>
<!--        暂时不为厂商提供-->
        <!--
        <li class="layui-nav-item">
          <a href="javascript:;"><i class="layui-icon layui-icon-release"></i> 厂商管理</a>
          <dl class="layui-nav-child">
            <dd class="{block name=''}{/block}"><a href="javascript:;">添加厂商</a></dd>
            <dd><a href="javascript:;">厂商列表</a></dd>
          </dl>
        </li>-->
        <li class="layui-nav-item"><a href="javascript:;"><i class="layui-icon layui-icon-set-sm"></i> 站点配置</a></li>
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <!-- 内容主体区域 -->
    
<blockquote class="layui-elem-quote">
  管理员列表

</blockquote>


  </div>

<!--  <div class="layui-footer">-->
<!--     底部固定区域 -->
<!--  </div>-->
</div>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script>
  //JS
  layui.use(['element', 'layer', 'util'], function(){
    var element = layui.element
            ,layer = layui.layer
            ,util = layui.util
            ,$ = layui.$;

    //头部事件
    util.event('lay-header-event', {
      //左侧菜单事件
      menuLeft: function(othis){
        layer.msg('展开左侧菜单的操作', {icon: 0});
      }
      ,menuRight: function(){
        layer.open({
          type: 1
          ,content: '<div style="padding: 15px;">处理右侧面板的操作</div>'
          ,area: ['260px', '100%']
          ,offset: 'rt' //右上角
          ,anim: 5
          ,shadeClose: true
        });
      }
    });

  });
</script>
</body>
</html>