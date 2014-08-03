<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>订餐系统</title>
    <link href="/Css/bootstrap.min.css" rel="stylesheet">
    <link href="/Css/dashboard.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/Js/ie10-viewport-bug-workaround.js"></script>
    <!--[if lt IE 9]>
      <script src="/Js/html5shiv.js"></script>
      <script src="/Js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="__GROUP__/Index">订餐系统后台管理</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="__GROUP__/Index/logout">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">

            <?php if($_SESSION['userinfo']['type']== 1): ?><ul class="nav nav-sidebar">
            <li<?php if ($content == 'syssetting') {echo ' class="active"';} ?>><a href="__GROUP__/User/lists/2">商户列表</a></li>
            <li<?php if ($content == 'syssetting') {echo ' class="active"';} ?>><a href="__GROUP__/User/lists/3">普通用户列表</a></li>
            <li<?php if ($content == 'syssetting') {echo ' class="active"';} ?>><a href="__GROUP__/User/showadd">添加用户</a></li>
          </ul><?php endif; ?>

          <ul class="nav nav-sidebar">
            <li<?php if ($content == 'helpsetting') {echo ' class="active"';} ?>><a href="__GROUP__/Food/lists">菜品列表</a></li>
             <?php if($_SESSION['userinfo']['type']== 2): ?><li<?php if ($content == 'gamesetting') {echo ' class="active"';} ?>><a href="__GROUP__/Food/add">添加菜肴</a></li><?php endif; ?>
          </ul>

          <ul class="nav nav-sidebar">
            <li<?php if ($content == 'delivsetting') {echo ' class="active"';} ?>><a href="__GROUP__/Order/lists">订单管理</a></li>
          </ul>

            <?php if($_SESSION['userinfo']['type']== 1): ?><ul class="nav nav-sidebar">
            <li><a href="javascript:;">系统配置</a></li>
          </ul><?php endif; ?>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">欢迎来到订餐系统后台管理</h2>
        </div>
      </div>
    </div>

<script src="/Js/jquery.min.js"></script>
    <script src="/Js/bootstrap.min.js"></script>
    <script src="/Js/docs.min.js"></script>
  </body>
</html>