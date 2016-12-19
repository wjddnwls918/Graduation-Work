	    <!-- content header -->
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">비행일지
                    <small>비행 경로 및 데이터 확인</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/welcome/afterlogin">Home</a>
                    </li>
                    <li class="active">Flight Log</li>
					
                </ol>
            </div>
        </div>
        <!-- content header end -->
		

		<!-- main -->
		<div class="row">
				<?
					$count = 0;
					
					for($i=0; $i<count($item); $i++)
					{
						$count = $i;

					}
				?>
            <!-- sidebar column -->
            <div class="col-md-2">
				 <div class="list-group">
					<a href="/data/1" class="list-group-item">드론1 비행일지</a>
					<a href="/data/2" class="list-group-item">드론2 비행일지</a>
					<a href="/data/3" class="list-group-item">드론3 비행일지</a>
                </div>
			</div>
			<!-- sidebar column end -->
			
			<!-- map&information column -->
			<div class="col-lg-10">
				<button class="btn btn-default btn-sm btn_command" onclick="setBounds()">드론 경로 확인</button> 	
				<button class="btn btn-default btn-sm btn_command" id="contents" style="margin-left:700px" value="<?=$item[$count]['drone_idx']?>">목록 </button>
				<!-- map -->
				<div style="margin-top:10px;">
					<div class="col-lg-8">
						<div id="map" style="width: 600px; height:550px;" ></div>		
					</div>
				</div>
				<!-- map end -->
				
				<!-- information -->
				<div class="col-lg-3">
					<div class="pad box-pane-right bg-light-blue" style="border: 1px solid black; min-height: 550px; text-align:center;">
						<h3 class="description-header"><strong>드론번호 : <?=$item[$count]['drone_idx']?> </strong></h3>		
						<br/>
							
						<h4 class="description-header"><strong>시작위치</strong></h4>					  
						<span class="description-text">위도 :  <?=$item[0]['latitude']?></br></span>      
						<span class="description-text">경도 : <?=$item[0]['longitude']?></br></span>     
						<br />

						<h4 class="description-header"><strong>비행시간 (H:M:S)<br></strong></h4>     
						<span class="description-text">
						<?
							$difTime = (strtotime($item[$count]['idx_time']))-(strtotime($item[0]['idx_time']));
									
							$total_time = $difTime;
										
							$hours=floor($total_time/3600);
							$time = $total_time- ($hours*3600);
							$min = floor($time/60);
							$sec = $time-($min*60);
						?>
									
						<?=date("H:i:s",mktime($hours,$min,$sec))?></br></span>
						<br />
						
						<h4 class="description-header"><strong>목표지점</strong></h4>
						<span class="description-text">위도 : <?=$item[$count]['latitude']?></br></span>
						<span class="description-text">경도 : <?=$item[$count]['longitude']?></br></span>
						<br />

						<h4 class="description-header"><strong>출발시간 (H:M:S)<br></strong></h4>					  
						<span class="description-text"><?=$item[0]['idx_time']?></br></span>		
						<br />	
						
						<h4 class="description-header"><strong>착륙시간 (H:M:S)<br></strong></h4>					  
						<span class="description-text"><?=$item[$count]['idx_time']?></br></span> 
					</div>	
				</div> 
				<!-- information end -->
			</div>
			<!-- map&information column -->
		</div>
		<!-- main end -->		
				
		<!-- data graph -->
		</br >
		<div class ="content">
			<div>
				<h4><strong>- 누적 데이터</strong></h4>
			</div>
			<canvas id="myChart" width="200px" height="80px"></canvas>
		</div>	
		<!-- data graph end -->