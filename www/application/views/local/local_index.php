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
				<div class="col-md-12">
					<div class="col-md-3">
						<img class="sensorTapImg1" src="/public/common/image/t1_signal.png" width="100px" height="100px">
					</div>
					<div class="col-md-9" style="padding-left:20px; padding-top:20px">
						<p class="sensorTapWrite1"><b><span style="color:blue">학교 내</span></b> 로컬센서 입니다.<br>
						각 센서 이름을 <b><span style="color:red">Click</span></b>하면 관련 정보를 볼 수 있습니다.</p>
					</div>
				</div>
				<!-- board end -->
				
				<!-- Local Sensor List -->
				<div class="col-md-12">
					<div class="col-xs-12">
						<div style="margin: 0 15% 0 20%;">
							<ul class="localul">
								<li class="localli">				
									<a class="sensor1"><h4>Local Sensor <strong>1</strong></h5></a>
								</li>
								<li class="localli">
									<a class="sensor2"><h4>Local Sensor <strong>2</strong></h5></a>
								</li>
								<li class="localli">
									<a class="sensor3"><h4>Local Sensor <strong>3</strong></h5></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-xs-12">
						<div style="margin: 0 15% 7% 20%;">
							<ul class="localul">
								<li class="localli">
									<a class="sensor4"><h4>Local Sensor <strong>4</strong></h4></a>
								</li>
								
								<li class="localli">
									<a class="sensor5"><h4>Local Sensor <strong>5</strong></h4></a>
								</li>
										
								<li class="localli">
									<a class="sensor6"><h4>Local Sensor <strong>6</strong></h4></a>
								</li>
							</ul>
						</div>		
					</div>
				</div>
				<!-- Local Sensor List end -->
			
				<div style="height:10px;"></div>
				
				<!-- map -->
				<div id="map" style="width:70%;height:400px; margin-left:140px; "></div>
				<!-- map end -->
			</div>	
			<!-- Main Column end -->
		</div>
		<!-- Cotent Row end -->