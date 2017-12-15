<!-- Content Header (Page header) -->
    <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">드론관제
				<small>실시간 드론관제 및 제어</small>
			</h1>
			<ol class="breadcrumb">
                    <li><a href="/welcome">Home</a>
                    </li>
                    <li class="active"><a href="/map">Control Drone</li>
					
            </ol>
		</div>
	</div>
    <!-- /.row -->
	
	
	<div class="row">
        <!-- Sidebar Column -->
        <div class="col-md-2">
			<div class="list-group">
                <a href="#" class="list-group-item">드론관제</a>
            </div>
		</div>
		
		
		<div class="col-md-10">    
			<div class="col-md-12" id="droneDiv1">
					
					<div class="container">
					<div class="row" style="padding-top:2%; padding-left:3% "> 
					
						<img  src="/public/common/image/control.png" width="80px" height="80px" >
						<p >드론 관제 페이지입니다.<br>
						각 드론을 <b><span style="color:red">Click</span></b>하면 컨트롤 할 수 있습니다.</p>
							
					</div>
					</div>
					<div class="col-md-12" >
						<p><b><h5>관제방법</h5></b><p>
						<ul class="droneManual">
							<li><b>명령 전달 전 드론을 선택합니다.  (ON/OFF)</b></li>
							<li><b>특정 로컬 센서의 데이터 값이 변하는 경우 해당 위치의 색이 변합니다.</b></li>
							<li><b>특정 지역의 색이 변한 경우 드론을 선택하면 해당 위치와의 최단 경로가 보입니다.</b></li>
							<li><b>관리자는 자신이 원하는 정찰 경로를 지도에서 선택할 수 있습니다.</b></li>
							<li><b>정찰 경로 확정 후 명령 버튼(Power, Stop, Descent)를 누르면 명령이 드론에 전달됩니다.</b></li>
							<!--<li><b>최종발표때에는 style.css > #controlDrone 에 있는 height 조절 필요함</b></li>-->
						</ul>
					</div>
			</div>
				
			<!--------------- 실시간 관제 영상 -------------->
			<div class="container">
			<div class="col-md-10" style="float:left;">
			<div class="col-md-4" id="controlDrone">    
				<div class="col-sm-12" style="margin-bottom:10px" id="droneNameBottom">
					<p class="droneName"><a id="droneNameClick1">Drone <strong>No.1</a></strong></a></p>
					
					<button type="button" id="drone1" value="0" style="display: none; "></button>
					
				</div>  
	

				<div class="col-md-12" style="margin-bottom:10px;">
					<div class="btn-group btn-group-justified" role="group" aria-label="...">
				  <div class="btn-group" role="group">
					<button type="button" class="btn btn-default btn_command" data-command="1"> Power</button>
				  </div>
				  <div class="btn-group" role="group">
					<button type="button" class="btn btn-default btn_command" data-command="2"> Middle</button>
				  </div>
				  <div class="btn-group" role="group">
					<button type="button" class="btn btn-default btn_command" data-command="3"> Right</button>
					
				  </div>					
				</div>
				
				
				
					<!-- 실제버튼 
					<button type="button"  class="btn btn-success btn-sm btn_command" style="margin: 3px" data-command="1">Power</button>
					<button type="button"  class="btn btn-success btn-sm btn_command" style="margin: 3px" data-command="2">Stop</button>
					<button type="button"  class="btn btn-success btn-sm btn_command" style="margin: 3px" data-command="3">Descent</button>
					-->
					<!-- 테스트용 버튼 -->
					<!--
					<button type="button"  class="btn btn-custom btn-sm btn_command" style="margin-right: 30px" data-command="1">Power</button>
					<button type="button"  class="btn btn-custom btn-sm btn_command" style="margin-right: 30px" data-command="2">Stop</button>
					<button type="button"  class="btn btn-custom btn-sm btn_command"  data-command="3">Landing</button>
					-->
					<!--<button type="button"  class="btn btn-custom btn-sm btn_command" data-command="4">TEKJHSKJT</button> -->
					<!--
					<label>throttle <input class="col-md-12" id="throttle" type="number" value=1000></label>
					<label>pitch <input class="col-md-12" id="pitch" type="number" value=1500></label>
					<label>roll <input class="col-md-12" id="roll" type="number" value=1500></label>
					<label>yaw <input class="col-md-12" id="yaw" type="number" value=1500></label></br>
					
				<button class="btn btn-success btn-sm" id="cmd_btn">전송</button>
					-->
				</div>
				
				<!-- 아님 스트리밍
				<div class="col-md-12" style="border: 1px solid #BDBDBD; height:auto;">
					<img src="http://218.150.181.163:10323/?action=stream">
				</div>
				-->
				<div class="video_single">
					<div class ="my-box">
				<!--<div class="col-md-4" style="border: 1px solid #BDBDBD; filter:alpha(opacity=50);">
					<img src="http://192.168.0.103:8080/?action=stream" style="width:400%; height:auto;">
				</div>-->
						<img src="http://192.168.0.105:8080/?action=stream"/>
					</div>
				</div>

				<div class="col-md-4" style="filter:alpha(opacity=50)">
				</div>
			</div>
	  
	  
			<div class="col-md-4" id="controlDrone">
				<div class="col-sm-12" style="margin-bottom:10px" id="droneNameBottom">
					<p class="droneName"><a id="droneNameClick2">Drone <strong>No.2</a></strong></p>
					<button type="button" id="drone2" value="0" style="display: none;"></button>
				</div>
				
				<div class="col-md-12" style="margin-bottom:10px;">
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
				  <div class="btn-group" role="group">
					<button type="button" class="btn btn-default btn_command" data-command="1"> Power</button>
				  </div>
				  <div class="btn-group" role="group">
					<button type="button" class="btn btn-default btn_command" data-command="2"> Middle</button>
				  </div>
				  <div class="btn-group" role="group">
					<button type="button" class="btn btn-default btn_command" data-command="3"> Right</button>
				  </div>
				</div>
				<!--
					<button type="button"  class="btn btn-custom btn-sm btn_command" style="margin-right: 30px" data-command="1">Power</button>
					<button type="button"  class="btn btn-custom btn-sm btn_command" style="margin-right: 30px" data-command="2">Stop</button>
					<button type="button"  class="btn btn-custom btn-sm btn_command"  data-command="3">Landing</button>
					-->
				</div>
				
				<div class="col-md-4" style="border: 1px solid #BDBDBD; filter:alpha(opacity=50);">
					<img src="경로">
				</div>
			</div>

			<div class="col-md-4" id="controlDrone">
				<div class="col-sm-12" style="margin-bottom:10px" id="droneNameBottom">
					<p class="droneName"><a id="droneNameClick3">Drone <strong>No.3</a></strong></p>
					<button type="button" id="drone3" value="0" style="display: none;"></button>
				</div>
				
				<div class="col-md-12" style="margin-bottom:10px;">
					<div class="btn-group btn-group-justified" role="group" aria-label="...">
				  <div class="btn-group" role="group">
					<button type="button" class="btn btn-default btn_command" data-command="1"> Power</button>
				  </div>
				  <div class="btn-group" role="group">
					<button type="button" class="btn btn-default btn_command" data-command="2"> Middle</button>
				  </div>
				  <div class="btn-group" role="group">
					<button type="button" class="btn btn-default btn_command" data-command="3"> Right</button>
				  </div>
				</div>
				<!--
					<button type="button"  class="btn btn-custom btn-sm btn_command" style="margin-right: 30px" data-command="1">Power</button>
					<button type="button"  class="btn btn-custom btn-sm btn_command" style="margin-right: 30px" data-command="2">Stop</button>
					<button type="button"  class="btn btn-custom btn-sm btn_command"  data-command="3">Landing</button>
					-->
				</div>
				
				
				<div class="col-md-4" style="border: 1px solid #BDBDBD; filter:alpha(opacity=50);">
					<img src="경로">
				</div>
			</div>
			</div>
		</div>
			<!-- 지도 -->
			<div class="video_single col-md-12">
				<br />
					<div id="map" style="width:100%; height:500px; margin:auto; position:relative; overflow:hidden;" ></div>

						<!-- 지도 ON / OFF -->
						<div class="custom_typecontrol2 radius_border">
							<span id="btnSetmap1" class="selected_btn2" onclick="setDragZoom(true,true)">지도 ON</span>
							<span id="btnSetmap2" class="btn2" onclick="setDragZoom(false,false)">지도 OFF</span>
						</div>
					<h2 id="current_coordinate"></h2>
			</div>
    </div>
   </div>