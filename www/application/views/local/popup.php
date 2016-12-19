<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>실시간 로컬 센서</title>
	
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
  
  <body class="alarm">
  

    <!-- Page Content -->
  

        <!-- Page Heading/Breadcrumbs -->
			<button type ="button" class ="btn-custom" id="restart" style="float:right; margin-right:10px;" >알람 재개</button>
            <button type ="button" class ="btn-custom" id ="stop" style="float:right; margin-right:10px;" >알람 정지</button>
			  <div class="container">
			  <div class="col-md-9" >
   <section class="content-header">
      <h1>
        Local Sensor No.<?=$data['localId'];?><br>
      <small>실시간 데이터</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="drone_<?=$data['localId'];?>">
                <tr>
                  <th>로컬센서 번호</th>
                  <th>온도 (˚C)</th>
                  <th>습도 (%)</th>
				  <th>이산화탄소 (ppm)</th>
				  <th>진동 </th>
				  <th>수위 </th>
			
                <tr class="data_row">
                  <td class="localID" ><?=$data['localId'];?></td>              
                  <td class="temperature"><div class="box" align ="center"><?=$data['temperature'];?></div></td>
                  <td class="humidity"><div class="box" align ="center"><?=$data['humidity'];?></div></td>
				  <td class="CO2"><div class="box" align ="center"><?=$data['CO2'];?></div></td>
                  <td class="vibration"><div class="box" align ="center"><?=$data['vibration'];?></div></td>
                  <td class="waterlevel"><div class="box" align ="center"><?=$data['waterlevel'];?></div></td>
				</tr>
			</table>
			 
			<!--------------- 그래프 기능 탭 --------------->
             
			<ul class="nav nav-tabs pull chart-list" class="" style="padding: auto">
              <li class="active">
				<a href="#revenue-chart" data-toggle="tab">온도</a>
			  </li>
				<li><a href="#revenue-chart" data-toggle="tab">습도</a></li>	
				<li><a href="#revenue-chart" data-toggle="tab">이산화탄소</a></li>
				<li><a href="#revenue-chart" data-toggle="tab">진동</a></li>
				<li><a href="#revenue-chart" data-toggle="tab">수위</a></li>
            </ul>
		
			<!--------------- 각 드론의 실시간 상태 그래프 --------------->
			
			<section class="content">
			<div class="row">
				<div class="col-xs-12">
				
					<!-- interactive chart -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<i class="fa fa-bar-chart-o"></i>
							<h3 class="box-title"><strong>Local Sensor No.<?=$data['localId'];?></strong> Real-Time Chart</h3>
				   
							<div class="box-tools pull-right">
								Real time
								<div class="btn-group" id="realtime" data-toggle="btn-toggle">
									<button type="button" class="btn btn-default btn-xs active" data-toggle="on">On</button>
									<button type="button" class="btn btn-default btn-xs" data-toggle="off">Off</button>
								</div>
							</div>
						</div>
			
						<div class="box-body">
							<div id="interactive" style="height: 500px; padding: 0px; position: relative;">
								<canvas class="flot-base" width="1048" height="500px" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 983px; height: 500px;"></canvas>
									<div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; color: rgb(84, 84, 84);"></div>
									<div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"></div>
									<div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"></div>
							</div>
							<canvas class="flot-overlay" width="1048" height="500" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 983px; height: 500px;"></canvas>
						</div>
					</div>

				</div>
			</div>
			
			</div>
		  </div>
		</div>
	</div>
</div>
</section>
</section>



 </div>
 
 
   <script src="/public/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/public/adminlte/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/public/adminlte/plugins/fastclick/fastclick.min.js"></script>

    <!-- Sparkline -->
    <script src="/public/adminlte/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="/public/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/public/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="/public/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="/public/adminlte/plugins/chartjs/Chart.min.js"></script>
	<script src="/public/adminlte/plugins/Morris/morris.js"></script>
	<script src="/public/adminlte/plugins/Morris/raphael.js"></script>
	<script src="/public/common/js/Chart.bundle.js"></script>
	<script src="/public/common/js/Chart.js"></script>
	<script src="/public/common/js/Chart.min.js"></script>
		

	<script src="/public/adminlte/plugins/flot/jquery.flot.min.js"></script>
	<script src="/public/adminlte/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="/public/adminlte/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="/public/adminlte/plugins/flot/jquery.flot.categories.min.js"></script>
	
	
	<!-- 실시간 관제부분 스위치 적용 -->
	<!--<script src="/public/plugin/js/jquery-1.11.2.min.js"></script>-->
	<script src="/public/plugin/js/on-off-switch.js"></script>
	<script src="/public/plugin/js/on-off-switch-onload.js"></script>
	
	

  </body>
</html>