<?php /*a:2:{s:35:"E:\tp\src\app\admin\view\index.html";i:1620814783;s:43:"E:\tp\src\app\admin\view\common\common.html";i:1620831379;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理中心</title>
  <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css" />
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo layui-hide-xs layui-bg-black">
      <img src="/static/images/logo.svg" width="36px"/> <span style="color: #1e9fff;font: icon;font-weight: 700;">后台管理中心</span>
    </div>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item" lay-unselect>
        <a href="javascript:;" lay-header-event="refresh" title="刷新">
          <i class="layui-icon layui-icon-refresh-3"></i>
        </a>
      </li>
      <li class="layui-nav-item layui-hide layui-show-md-inline-block">
        <a href="javascript:;">
          <img src="//tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg" class="layui-nav-img">
          tester
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">个人资料</a></dd>
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
        <li class="layui-nav-item layui-this"><a href="<?php echo url('index/index'); ?>"><i class="layui-icon layui-icon-home"></i> 控制台</a></li>
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
                <a href="javascript:;"><i class="layui-icon layui-icon-user"></i>&nbsp;普通用户</a>
                <dl class="layui-nav-child">
                  <dd class=""><a href="<?php echo url('user/add'); ?>">添加用户</a></dd>
                  <dd class=""><a href="<?php echo url('user/list'); ?>">用户列表</a></dd>
                </dl>
              </li>

              <li class="layui-nav-item" >
                <a href="javascript:;"><i class="layui-icon layui-icon-friends"></i>&nbsp;后台用户</a>
                <dl class="layui-nav-child">
                  <dd class=""><a href="<?php echo url('admin/add'); ?>">添加用户</a></dd>
                  <dd class=""><a href="<?php echo url('admin/list'); ?>">用户列表</a></dd>
                </dl>
              </li>
            </ul>

          </dl>

        </li>

    <!--    暂时不为厂商提供-->
        <!--
        <li class="layui-nav-item">
          <a href="javascript:;"><i class="layui-icon layui-icon-release"></i> 厂商管理</a>
          <dl class="layui-nav-child">
            <dd class="{block name=''}{/block}"><a href="javascript:;">添加厂商</a></dd>
            <dd><a href="javascript:;">厂商列表</a></dd>
          </dl>
        </li>-->

        <li class="layui-nav-item "><a href="<?php echo url('setting/index'); ?>"><i class="layui-icon layui-icon-set-sm"></i> 站点配置</a></li>
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <div class="layui-hide-sm layui-hide-lg layui-hide-md layui-bg-orange"><h1>请使用电脑访问后台~</h1></div>
    <!-- 内容主体区域 -->
    
<blockquote class="layui-elem-quote">欢迎来到后台页面</blockquote>

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
       menuRight: function(){
        layer.open({
          type: 1
          ,content: '<div style="padding: 15px;">处理右侧面板的操作</div>'
          ,area: ['260px', '100%']
          ,offset: 'rt' //右上角
          ,anim: 5
          ,shadeClose: true
        });
      },
      refresh:()=>{
        location.reload()
      }
    });

  });
</script>

</body>
</html>