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
  
  <body  style="padding-top:0px;">
  <div class="col-md-9" style="height:40px; background-color:#B7F0B1; margin-bottom:10px;">		
		
		<p style="padding-top:10px;"><b>센서의 색에 따른 상태</b></p>

	</div>
  
				<div class="col-md-12" >
					<div id="map" style="position:relative; overflow:hidden;" ></div>
						<div class="disasterType disasterBorder">
							<table>
								<tr>
									<td><img src="/public/common/image/1.PNG" style="margin-top:15px; margin-left:10px;"></td>
									<td><span style="font-size:15px;"><b>안전</b></span></td>
								</tr>
								<tr>
									<td><img src="/public/common/image/2.PNG"  style="margin-left:10px;"></td>
									<td><span style="font-size:15px;"><b>화재주의</b></span></td>
								</tr>
								<tr>
									<td><img src="/public/common/image/3.PNG"  style="margin-left:10px;"></td>
									<td><span style="font-size:15px;"><b>화재위험</b></span></td>
								</tr>
								<tr>
									<td><img src="/public/common/image/4.PNG"  style="margin-left:10px;"></td>
									<td><span style="font-size:15px;"><b>지진주의</b></span></td>
								</tr>
								<tr>
									<td><img src="/public/common/image/5.PNG"  style="margin-left:10px;"></td>
									<td><span style="font-size:15px;"><b>지진위험</b></span></td>
								</tr>
								<tr>
									<td><img src="/public/common/image/6.PNG"  style="margin-left:10px;"></td>
									<td><span style="font-size:15px;"><b>홍수주의</b></span></td>
								</tr>
								<tr>
									<td><img src="/public/common/image/7.PNG"  style="margin-left:10px;"></td>
									<td><span style="font-size:15px;"><b>홍수위험</b></span></td>
								</tr>
							</table>
						</div>
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