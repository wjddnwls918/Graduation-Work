<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>드론관제센터</title>
	
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/public/adminlte/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/public/adminlte/bootstrap/css/bootstrap.css.map">
	
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	
    <!-- jvectormap -->
    <link rel="stylesheet" href="/public/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="/public/adminlte/plugins/morris/morris.css">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	
    <link rel="stylesheet" href="/public/adminlte/bootstrap/css/modern-business.css">
	
	<link rel="stylesheet" href="/public/common/css/style.css">
	
	<link rel="stylesheet" href="/public/plugin/css/on-off-switch.css">
  </head>
  
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/welcome"><b>드론관제센터</b></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/Local_controller">로컬센서 관제</a>
                    </li>
                    <li>
                        <a href="/map">드론 관제</a>
                    </li>
                    <li class="dropdown">
                        <a href="/data/drone/1" class="dropdown-toggle" data-toggle="dropdown">드론 비행 일지 <b class="caret"></b></a>
                        <ul class="dropdown-menu">
							<li>
                                <a href="/data/lists">기록 페이지</a>
                            </li>	
						    <li>
                                <a href="/data/1">Drone1</a>
                            </li>
                            <li>
                                <a href="/data/2">Drone2</a>
                            </li>
                            <li>
                                <a href="/data/3">Drone3</a>
                            </li>
                        </ul>
                    </li>
					
				
					<li class="dropdown">
                        <a href="/wcondition" class="dropdown-toggle" data-toggle="dropdown">드론기상 <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/wcondition">드론예보</a>
                            </li>
                            <li>
                                <a href="/wcondition/weatherReport">스테이션 날씨</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/simul_controller">시뮬레이션</a>
                    </li>
					<li>
					</li>
					
                    <li>
                        <a href="/login/logout">로그아웃</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
		      <!-- Content Wrapper. Contains page content -->
 
        <!-- /.container -->

    <!-- Page Content -->
  

        <!-- Page Heading/Breadcrumbs -->

            
			  <div class="container">
			  