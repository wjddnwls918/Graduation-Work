<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>기상 아이콘 정보</title>
	
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
  
  <body style="padding-top:0px;">
    <!-- Navigation -->
 
		      <!-- Content Wrapper. Contains page content -->
 
        <!-- /.container -->


    <!-- Page Content -->
  

        <!-- Page Heading/Breadcrumbs -->

	<div class="col-md-9" style="height:40px; background-color:#B7F0B1; margin-bottom:10px;">		
		
		<p style="padding-top:10px;"> <b>아이콘 설명 </b></p>

	</div>
            
	<div class="col-md-9">		 
	<table class="table table-bordered" id="popinfo">
		 <tr>
			 <th>
			 번호
			 </th>
			  <th>
			 아이콘
			 </th>
			  <th>
			 설명
			 </th>
			  <th>
			 번호
			 </th>
			  <th>
			 아이콘
			 </th>
			  <th>
			 설명
			 </th>
		 </tr>
		 
		 <tr>
			 <td style="vertical-align:middle">
			  1
			 </td>
			 <td>
			  <img src="/public/common/image/Clearly.png" width="40px" height="40px" >
			 </td>
			 <td style="vertical-align:middle">
			   맑음
			 </td>
			 <td style="vertical-align:middle">
			  2
			 </td>
			 <td>
			  <img src="/public/common/image/Little Cloudy.png" width="40px" height="40px" >
			 </td>
			 <td style="vertical-align:middle">
			  구름조금
			 </td>
		 </tr>
		 
		  <tr>
			 <td style="vertical-align:middle">
			  3
			 </td>
			 <td>
			  <img src="/public/common/image/Mostly Cloudy.png" width="40px" height="40px" >
			 </td>
			 <td style="vertical-align:middle">
			   구름많음
			 </td>
			 <td style="vertical-align:middle">
			  4
			 </td>
			 <td>
			   <img src="/public/common/image/Cloudy.png" width="40px" height="40px" >
			 </td>
			 <td style="vertical-align:middle">
			  흐림
			 </td>
		 </tr>
		 
		  <tr>
			 <td style="vertical-align:middle">
			  5
			 </td>
			 <td>
			   <img src="/public/common/image/Rainy.png" width="40px" height="40px" >
			 </td>
			 <td style="vertical-align:middle">
			   비
			 </td>
			 <td style="vertical-align:middle">
			  6
			 </td>
			 <td>
			  <img src="/public/common/image/SnowRain.png" width="40px" height="40px" >
			 </td>
			 <td style="vertical-align:middle">
			  비 또는 눈
			 </td>
		 </tr>
		 
		  <tr>
			 <td style="vertical-align:middle">
			  7
			 </td>
			 <td>
			  <img src="/public/common/image/Snow.png" width="40px" height="40px" >
			 </td>
			 <td style="vertical-align:middle">
			   눈
			 </td>
			 <td style="vertical-align:middle">
			  8
			 </td>
			 <td>
			  
			 </td>
			 <td>
			  
			 </td>
		 </tr>
		 
		 
		  <tr>
			 <td style="vertical-align:middle">
			  9
			 </td>
			 <td colspan="2">
			  <img src="/public/common/image/NB24.png" width="150px" height="150px" >
			
			 </td>
			
			
			 <td colspan="3" style="vertical-align:middle">
			   부이
			 </td>
		 </tr>
	</table>


	</div>
        <!-- /.row -->

 
	<!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
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