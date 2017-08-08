	    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">시뮬레이션
                    <small>상황 시뮬레이션</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/welcome">Home</a>
                    </li>
                    <li class="active"><a href="/Simul_controller">Simulation</li>
				</ol>
            </div>
        </div>
		


		<div class="row">
			<!-- Sidebar Column -->
			<div class="col-md-2">
				<div class="list-group">
					   
				<a href="#" class="list-group-item">시뮬레이션</a>
					 
				</div>
			</div>
			
			<div class="col-md-10">
				<div class=	"col-md-12" style="border-bottom: 3px solid #EAEAEA; margin: 0 0 10px 0">
					<h4 style="margin-right:10px; float:left;">Local Data ></h4>
					<form class="form-inline">
						<div class="form-group">
						
							<select class="form-control selecter">
							  <option value="1">1</option>
							  <option value="2">2</option>
							  <option value="3">3</option>
							  <option value="4">4</option>
							  <option value="5">5</option>
							  <option value="6">6</option>
							</select>
						</div>
						<div class="form-group" >
						
							<input type="number" class="form-control input-sm" id="Temperature" placeholder="Input Tempterature(℃)">
						</div>
						<div class="form-group">
						
							<input type="number" class="form-control input-sm" id="Humidity" placeholder="Input Humidity(%)">
						</div>
						<div class="form-group">
						
							<input type="number" class="form-control input-sm" id="Co2" placeholder="Input Co2(ppm)">
						</div>
						
						<div class="form-group" style="margin-left:60px;">
						
							<input type="number" class="form-control input-sm" id="Vibration" placeholder="Input Vibration(0-10000)">
						</div>
						<div class="form-group">
						
							<input type="number" class="form-control input-sm" id="Waterlevel" placeholder="Input Waterlevel(0-500)">
						</div>
					  <button type="button" style="margin-left: 30px; margin-bottom:5px; float:right;" class="btn btn-default" id="localinfo">Start</button>
					</form>
				</div>
				
								
				
				<div class=	"col-md-12" style="border-bottom: 3px solid #EAEAEA; margin: 0 0 10px 0">
					<h4 style="margin-right:10px; float:left;">Drone Data ></h4>
					<!--<button type="button"  id="simulation1" class="btn btn-info btn-sm btn_command" style="margin-top: 4px; margin-right: 10px" data-command="1">Simulation1</button>
					<button type="button"  id="simulation2" class="btn btn-info btn-sm btn_command" style="margin-top: 4px; margin-right: 10px" data-command="2">Simulation2</button>
					<button type="button"  id="simulation3" class="btn btn-info btn-sm btn_command" style="margin-top: 4px; margin-right: 10px" data-command="3">Simulation3</button>
					<button type="button"  id="simulation4" class="btn btn-info btn-sm btn_command" style="margin-top: 4px; margin-right: 10px" data-command="4">Simulation4</button>
					<button type="button"  id="simulation5" class="btn btn-info btn-sm btn_command" style="margin-top: 4px;" data-command="5">Simulation 5</button>
					-->
				<form class="form-inline">
				<div class="form-group">
				
					<select class="form-control selecter2">
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  
					</select>
				</div>
				  <div class="form-group" >
					
					<input type="number" class="form-control" id="Latitude" placeholder="Input Latitude">
				  </div>
				  <div class="form-group">
					
					<input type="number" class="form-control" id="Longitude" placeholder="Input Longitude">
				  </div>
			
				  <button type="button" style="margin-left: 24px;" class="btn btn-default" id="latlng">Start</button>
				</form>
				</div>
				
				
				<div class=	"col-md-12">
					<h4 style="margin-right:10px; float:left;">Header Drone Control Button ></h4>
					<button type="button"  class="btn btn-custom btn-sm btn_command" style="margin-top: 4px; margin-right: 10px" data-command="1">Power</button>
					<button type="button"  class="btn btn-custom btn-sm btn_command" style="margin-top: 4px; margin-right: 10px" data-command="2">Stop</button>
					<button type="button"  class="btn btn-custom btn-sm btn_command" style="margin-top: 4px;" data-command="3">Descent</button>
					<button type="button"  class="btn btn btn-warning btn-sm btn_command" style="margin-top: 4px; margin-left:18%; margin-right:1px;"id="collision">충돌감지</button>
					<div style="float:right; border : 3px solid #EAEAEA; vertical-align:middle; width:100px; height:35px;" id="rssi1" > 
					0
					</div>
					<div style="float:right; border : 3px solid #EAEAEA; vertical-align:middle; width:100px; height:35px;" id="rssi2"> 
					0
					</div>
					
				</div>
				

				
				<!--------------- 실시간 관제 영상 -------------->
				<div class="col-md-12">
				<div class="col-md-4" id="controlDrone">    
					<div class="col-md-12" style="margin-bottom:10px" id="droneNameBottom">
						<p class="droneName" >Drone <strong><img src="/public/common/image/drone1.png" style="width:30px; height:30px; float:right">(Header)</strong></a></p>
						<button type="button" id="drone1" value="0" style="display: none; "></button>
					</div>  
		
					<div class="col-md-12" style="margin:10px auto;">
						
					</div>
					
					<div class="col-md-4" style="border: 1px solid #BDBDBD; filter:alpha(opacity=50);">
						<img src="경로">
					</div>
				</div>
		  
		  
				<div class="col-md-4" id="controlDrone">
					<div class="col-md-12" style="margin-bottom:10px" id="droneNameBottom">
						<p class="droneName" >Drone <strong><img src="/public/common/image/drone2.png" style="width:30px; height:30px;">(Slave)</strong></p>
						<button type="button" id="drone2" value="0" style="display: none;"></button>
					</div>
					
					<div class="col-md-12" style="margin-bottom:10px;">
					</div>
					
					<div class="col-md-4" style="border: 1px solid #BDBDBD; filter:alpha(opacity=50);">
						<img src="경로">
					</div>
				</div>

				<div class="col-md-4" id="controlDrone">
					<div class="col-md-12" style="margin-bottom:10px" id="droneNameBottom">
						<p class="droneName" >Drone <strong><img src="/public/common/image/drone3.png" style="width:30px; height:30px;">(Slave)</strong></p>
						<button type="button" id="drone3" value="0" style="display: none;"></button>
					</div>
					
					<div class="col-md-12" style="margin-bottom:10px;">
					</div>
					
					
					<div class="col-md-4" style="border: 1px solid #BDBDBD; filter:alpha(opacity=50);">
						<img src="경로">
					</div>
				</div>
				</div>
				
				<div class="col-md-12" style="padding-top : 10px;">
					<button type="button" class="btn btn-custom btn-xs btnsimul">아이콘설명</button>
					
				</div>
				
				<div class="col-md-12" >
					<div id="map" style="width:100%; height:500px; margin:auto; position:relative; overflow:hidden;" ></div>
				</div>
		
		
		
		
			</div>
		</div>