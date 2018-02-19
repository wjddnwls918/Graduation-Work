<?php
	$whitelist = array('/home/hosting_users/wangtou/www');
	if(in_array($_SERVER['DOCUMENT_ROOT'], $whitelist)) {
		//Action for allowed IP Addr
		//echo 'You are authorized here';
	} else {
		//Action for all other IP Addr
		//echo 'You are not authorized here.';
		echo "<br />IP Address: ".$_SERVER['DOCUMENT_ROOT'];
		exit;
	}
?>

		<!-- page header -->
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">로컬센서 관제
                    <small>실시간 로컬센서 관제</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/welcome">Home</a>
                    </li>
                    <li class="active"><a href="/local_controller">Local Sensor Control</li>

                </ol>
            </div>
        </div>
		<!-- page header end ->

        <!-- Content Row -->
        <div class="row">
            <!-- Sidebar Column -->
            <div class="col-md-2">
				 <div class="list-group">
				   <a href="/local_controller" class="list-group-item">로컬센서</a>

                </div>


			</div>


			<!-- Sidebar Column end -->

			<!-- Main Column -->
			<div class="col-md-10">
				<!-- board -->
				<div class="container" class="mediatest" style="margin-top:2%; margin-bottom:2%;">
				<div class="col-md-12" >
					<div class="col-sm-8" style="padding-left:5%;">
						<img  src="/public/common/image/t1_signal.png" width="80px" height="80px">
						<p>
						<b style="color:blue">학교 내</span></b> 로컬센서 입니다.<br>
						각 센서 이름을 <b><span style="color:red">Click</span></b>하면 관련 정보를 볼 수 있습니다.
						</p>
					</div>

				</div>
				</div>
				<!-- board end -->

				<!-- Local Sensor List -->
				<div class="col-md-12">

				<div class="row">
					<div class="btn-group btn-group-justified" role="group" aria-label="..."  >
					  <div class="btn-group" role="group">
						<button type="button" class="btn btn-default" id="sensor1" >Local Sensor <strong>1</strong></button>
					  </div>
					  <div class="btn-group" role="group">
						<button type="button" class="btn btn-default" id="sensor2">Local Sensor <strong>2</strong></button>
					  </div>
					  <div class="btn-group" role="group">
						<button type="button" class="btn btn-default" id="sensor3">Local Sensor <strong>3</strong></button>
					  </div>
						<div class="btn-group" role="group">
						<button type="button" class="btn btn-default" id="sensor4">Local Sensor <strong>4</strong></button>
					  </div>
						<div class="btn-group" role="group">
						<button type="button" class="btn btn-default" id="sensor5">Local Sensor <strong>5</strong></button>
					  </div>
						<div class="btn-group" role="group">
						<button type="button" class="btn btn-default" id="sensor6">Local Sensor <strong>6</strong></button>
					  </div>
					</div>
				</div>

				</div>
				<!-- 새로운 조작 버튼 넣을 자리 -->
				<div class="col-md-12">
					<div class="btn-group" role="group">
					<!--<input type="text" class="inputtext"/>
					<button type="button" class="testbutton" >test</button>-->
					</div>
				<div class="row">
				</div>
				</div>

				<!-- Local Sensor List end -->

				<div style="height:10px;"></div>

				<!-- map -->
				<div class ="container">
				<div class="row">
				<div id="map" style="width:80%; height:500px; margin-top:50px; "></div>
				</div>
				</div>
				<!-- map end -->
			</div>
			<!-- Main Column end -->
		</div>
		<!-- Cotent Row end -->
