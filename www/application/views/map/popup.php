<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>실시간 드론 상태</title>
	
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
  

    <!-- Page Content -->
  
	
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Sidebar Column -->
        
	
	<div class="col-md-12" >
	<section class="content-header">
      <h1>
        <h1>Drone No.<?=$data['drone_idx'];?>
      <small>실시간 드론상태</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content" style="padding-bottom:20%;">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="drone_<?=$data['drone_idx'];?>">

                <tr>
                  <th>Num</th>
                  <th>T</th>
                  <th>H</th>
				  <th>CO2</th>
                  <th>La</th>
                  <th>Ln</th>
                  <th>Al</th>
				  <th>S</th>
				  </tr>

                <tr class="data_row">
                  <td class="drone_idx" ><?=$data['drone_idx'];?></td>              
                  <td class="temperature"><div class="box" align ="center"><?echo $data['temperature'];?></div></td>
                  <td class="humidity"><div class="box" align ="center"><?echo $data['humidity'];?></div></td>
				  <td class="CO2"><div class="box" align ="center"><?echo $data['CO2'];?></div></td>
                  <td class="latitude"><div class="box" align ="center"><?echo $data['latitude'];?></div></td>
                  <td class="longitude"><div class="box" align ="center"><?echo $data['longitude'];?></div></td>
				  <td class="altitude"><div class="box" align ="center"><?echo $data['altitude'];?></div></td>
				  <td class="speed"><div class="box" align ="center"><?echo $data['speed'];?></div></td>
                </tr>
			</table>
			 
			 <!--------------- 그래프 기능 탭 --------------->
             
			<ul class="nav nav-tabs pull chart-list" class="" style="padding: auto">
              <li class="active">
				<a href="#revenue-chart" data-toggle="tab">온도(T)</a>
			  </li>
				<li><a href="#revenue-chart" data-toggle="tab">습도(H)</a></li>	
				<li><a href="#revenue-chart" data-toggle="tab">이산화탄소(CO2)</a></li>
				<li><a href="#revenue-chart" data-toggle="tab">고도(La)</a></li>
				<li><a href="#revenue-chart" data-toggle="tab">속도(S)</a></li>
            </ul>
		
				 <!--------------- 각 드론의 실시간 상태 그래프 --------------->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- interactive chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>
				<h3 class="box-title"><strong>Drone No.<?=$data['drone_idx'];?></strong> Real-Time Chart</h3>
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
					<div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; color: rgb(84, 84, 84);">
						<div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">	
					</div>
					
					<div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
					</div>
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
        </div>

        <!-- Page Heading/Breadcrumbs -->

    
 
 
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