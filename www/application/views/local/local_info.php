 <!-- Content Header (Page header) -->
   


   <section class="content-header">
      <h1>
        <h1>Local Sensor No.<?=$data['localId'];?>
      <small>실시간 로컬상태</small>
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
				  <th>위도 </th>
				  <th>경도 </th>
			
                <tr class="data_row">
                  <td class="localID" ><?=$data['localId'];?></td>              
                  <td class="temperature"><div class="box" align ="center"><?echo $data['temperature'];?></div></td>
                  <td class="humidity"><div class="box" align ="center"><?echo $data['humidity'];?></div></td>
				  <td class="CO2"><div class="box" align ="center"><?echo $data['CO2'];?></div></td>
                  <td class="latitude"><div class="box" align ="center"><?echo $data['latitude'];?></div></td>
                  <td class="longitude"><div class="box" align ="center"><?echo $data['longitude'];?></div></td>
				</tr>
			</table>
			 
			<!--------------- 그래프 기능 탭 --------------->
             
			<ul class="nav nav-tabs pull chart-list" class="" style="padding: auto">
              <li class="active">
				<a href="#revenue-chart" data-toggle="tab">온도</a>
			  </li>
				<li><a href="#revenue-chart" data-toggle="tab">습도</a></li>	
				<li><a href="#revenue-chart" data-toggle="tab">이산화탄소</a></li>
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