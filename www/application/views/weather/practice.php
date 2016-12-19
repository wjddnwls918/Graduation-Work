	    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">드론예보
                    <small>드론 비행 안정성 예보</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/welcome">Home</a>
                    </li>
                    <li class="active"><a href="/wcondition">Drone Forecast</a></li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Sidebar Column -->
            <div class="col-md-2">
				<div class="list-group">
                   
				   <a href="/wcondition" class="list-group-item">드론 예보</a>
				   <a href="/wcondition/weatherReport" class="list-group-item">스테이션 날씨</a>
                </div>
			</div>
	
	
	
	
			<!-- Content Start!! -->
			<div class="col-md-10">

		
					<div class="col-md-12">
						<div class="col-md-3">
							<img class="weatherTapImg1" src="/public/common/image/flying.png" width="100px" height="100px">
						</div>
						<div class="col-md-9" style="padding-left:20px; padding-top:20px">
							<p class="weatherTapWrite1">현재기준 향후 12시간의<br> 
							<b><span style="color:blue">드론 비행</span></b>시 
							<b><span style="color:green">안전성 여부</span></b>를 알려드립니다.<br>
							드론 비행시 참고하시길 바랍니다.</p>
						</div>
					</div>
					
					<div class="col-md-8" id="droneName">
						<ul>
							<h4><li>한국기술교육대학교</li></h4>
						</ul>
					</div>

					
					<div class="col-md-12">
						<div class="col-md-12">
							<button type="button" class="btn btn-custom btn-xs btnSafety">안전도 설명</button>
						</div>
						<div class="col-md-12" style="margin-bottom:2px">
							<p style="float:left";>- 현재 날짜/시간:</p>
							<div class="col-md-10" id="Display_clock"></div>
						</div>
						
						<?
							$lastTime=-1; $lastScore="TEST";
						
							
							for($i=0; $i<5; $i++) {	
							
								// 드론 운행 시간일 때
								if($data[$i]['hour'] >= 21 && $data[$i]['hour'] < 6) {
									$w_condition='<strong>지금은</strong>'.$lastScore.'<strong>운행하지 않습니다.</strong>';
								}
											
								// 드론 운행 시간이 아닐 때
								else
								{
									$w_condition='<strong><span style="font-size:15pt">→ 지금은 드론이 운행되는 <span style="color:red">시간이 아닙니다.</span></span></strong>';
								}
							}
					
						?>
						
						<!--
						<div class="col-md-12" style="text-align:left">
								<?= $w_condition ?>
						</div>
					-->
						<div class="col-xs-12" style="padding-bottom : 7%;">
							<div class="video_single col-md-1">	
							</div>
				
							<div class="col-md-12">
								<table class="table" style="margin-top:10px;">
						
									<tr>
										<td style=" width:14%;"><h4><strong>날짜</strong></h4></td>
										<?
											$today = '';
											for($i=0; $i<5; $i++) {
												if($data[$i]['day']==0) {
													$today = '오늘';
												}
												else if($data[$i]['day']==1) {
													$today = '내일';
												}
												echo '<td style ="background-color:#FFFFFF"><h4>'.$today.'</h4></td>';
											}
										?>
									</tr>
							
									<tr>
										<td><h4><strong>시각<br>(KST)</strong></h4></td>
										<?
										for($i=0; $i<5; $i++) {
											$hour = $data[$i]['hour']+3;
											if($hour == 27)	$hour = 3;
											echo '<td style="background-color:#FFFFFF; vertical-align:middle"><h4>'.$data[$i]['hour'].'시 ~ '.$hour.'시</h4></td>';
										
										}
										?>
									</tr>
									
									<tr>
										<td><h4><strong>날씨</strong></h4></td>
										<?
											for($i=0; $i<5; $i++)
											{
												if($data[$i]['wfen'] == "Clear")
												{
													echo '<td><img src="/public/common/image/Clearly.png" title="맑음" width="30px" height="30px"></td>';

												}
												
												else if($data[$i]['wfen'] == "Partly Cloudy")
												{
													echo '<td><img src="/public/common/image/Little Cloudy.png" title="구름 조금" width="30px" height="30px"></td>';

												}
												
												else if($data[$i]['wfen'] == "Mostly Cloudy")
												{
													echo '<td><img src="/public/common/image/Mostly Cloudy.png" title="구름 많음" width="30px" height="30px"></td>';

												}
												
												else if($data[$i]['wfen'] == "Cloudy")
												{
													echo '<td><img src="/public/common/image/Cloudy.png" title="구름" width="30px" height="30px"></td>';

												}
												
												else if($data[$i]['wfen'] == "Rain")
												{
													echo '<td><img src="/public/common/image/Rainy.png" title="비" width="30px" height="30px"></td>';

												}
												
												else if($data[$i]['wfen'] == "Snow/Rain")
												{
													echo '<td><img src="/public/common/image/SnowRain.png" title="눈/비" width="30px" height="30px"></td>';

												}
												
												else if($data[$i]['wfen'] == "Snow")
												{
													echo '<td><img src="/public/common/image/Snow.png" title="눈" width="30px" height="30px"></td>';

												}
											}
										?>
									</tr>
									
									<tr>
										<td><h4><strong>기온</strong></h4></td>
										<?
											for($i=0; $i<5; $i++)
											{
												echo '<td style="vertical-align:middle">'.$data[$i]['temp'].'℃'.'</td>';	
											}
										?> 
									</tr>
									
									<tr>
										<td><h4><strong>풍속</strong></h4></td>
										<?
											for($i=0; $i<5; $i++)
											{	
												$windSpeed = $data[$i]['ws'];
												$windSpeed = substr($windSpeed, 0, 3);
												if($data[$i]['wd'] == 0)
												{
													echo '<td>'.$windSpeed.'m/s<br><img src="/public/common/image/n.png" width="30px" height="30px">'.'</td>';
													
												}
												
												else if($data[$i]['wd'] == 1)
												{
													echo '<td>'.$windSpeed.'m/s<br><img src="/public/common/image/n-e.png" width="30px" height="30px">'.'</td>';
												}
												
												else if($data[$i]['wd'] == 2)
												{
													echo '<td>'.$windSpeed.'m/s<br><img src="/public/common/image/e.png" width="30px" height="30px">'.'</td>';
												}
												else if($data[$i]['wd'] == 3)
												{
													echo '<td>'.$windSpeed.'m/s<br><img src="/public/common/image/s-e.png" width="30px" height="30px">'.'</td>';
												}
												else if($data[$i]['wd'] == 4)
												{
													echo '<td>'.$windSpeed.'m/s<br><img src="/public/common/image/s.png" width="30px" height="30px">'.'</td>';
												}
												else if($data[$i]['wd'] == 5)
												{
													echo '<td>'.$windSpeed.'m/s<br><img src="/public/common/image/s-w.png" width="30px" height="30px">'.'</td>';
												}
												else if($data[$i]['wd'] == 6)
												{
													echo '<td>'.$windSpeed.'m/s<br><img src="/public/common/image/w.png" width="30px" height="30px">'.'</td>';
												}
												
												else
												{
													echo '<td>'.$windSpeed.'m/s<br><img src="/public/common/image/n-w.png" width="30px" height="30px">'.'</td>';
												}
											}
										?>
									</tr>
									
									<tr>
										<td><h4><strong>강수확률</strong></h4></td>
										<?
											for($i=0; $i<5; $i++)
											{
												echo '<td style="vertical-align:middle">'.$data[$i]['pop'].'%</td>';	
											}
										?>
									</tr>
								
									<tr>
										<td rowspan="2" style="vertical-align: middle"><h4><strong>비행 안전도</strong></h4></td>
										<?
											// level1 : 빨강  ~  level10: 초록   level11: 미운영시간
											$level1 = '#FF0000'; $level2 = '#FF9090'; $level3 = '#DBC000'; 
											$level4 = '#FFFF6C'; $level5 = '#C9FFC3'; $level6 = '#B7F0B1'; 
											$level7 = '#86E57F'; $level8 = '#47C83E'; $level9 = '#2F9D27'; 
											$level10 = '#22741C'; $level11 = '#BDBDBD';
											
											//각 요건 점수 변수 초기화
											$pop_score = 0;
											$ws_score = 0;
											$temp_score = 0;
											$now;
											
											// 기상확률
											for($i=0; $i<5; $i++) {	
											
											//강수확률 점수화
											if(($data[$i]['pop']) >= 80)
												$pop_score = 0;
											else if(($data[$i]['pop']) >= 70)
												$pop_score = 50;
											else if(($data[$i]['pop']) >= 60)
												$pop_score = 60;
											else if(($data[$i]['pop']) >= 50)
												$pop_score = 70;
											else if(($data[$i]['pop']) >= 40)
												$pop_score = 80;
											else if(($data[$i]['pop']) >= 30)
												$pop_score = 90;
											else if(($data[$i]['pop']) >= 20)
												$pop_score = 96;
											else if(($data[$i]['pop']) >= 10)
												$pop_score = 98;
											else if(($data[$i]['pop']) >= 0)
												$pop_score = 100;
									
									
											//풍속 점수화
											if(($data[$i]['ws']) >= 9)
												$ws_score = 0;
											else if(($data[$i]['ws']) >= 8)
												$ws_score = 10;
											else if(($data[$i]['ws']) >= 7)
												$ws_score = 20;
											else if(($data[$i]['ws']) >= 6)
												$ws_score = 40;
											else if(($data[$i]['ws']) >= 5)
												$ws_score = 60;
											else if(($data[$i]['ws']) >= 4)
												$ws_score = 70;
											else if(($data[$i]['ws']) >= 3)
												$ws_score = 80;
											else if(($data[$i]['ws']) >= 2)
												$ws_score = 90;
											else if(($data[$i]['ws']) >= 1)
												$ws_score = 95;
											else if(($data[$i]['ws']) >= 0)
												$ws_score = 100;
											
										
											//온도 점수화
											if(($data[$i]['temp']) >= 60)
												$temp_score = 0;
											else if(($data[$i]['temp']) >= 30)
												$temp_score = 17;
											else if(($data[$i]['temp']) >= 20)
												$temp_score = 51;
											else if(($data[$i]['temp']) >= 10)
												$temp_score = 68;
											else if(($data[$i]['temp']) >= 0)
												$temp_score = 99;
											else if(($data[$i]['temp']) >= (-10))
												$temp_score = 68;
											else if(($data[$i]['temp']) >= (-20))
												$temp_score = 51;
											else if(($data[$i]['temp']) >= (-30))
												$temp_score = 17;
											else if(($data[$i]['temp']) >= (-40))
												$temp_score = 17;
											else if(($data[$i]['temp']) < (-40))
												$temp_score = 0;
											
											$w_score = (($pop_score*0.4) + ($ws_score*0.5) + ($temp_score*0.1));
												
												if($data[$i]['hour'] >= 6 && $data[$i]['hour'] <=18) {
													if($w_score < 30) {
														echo '<td style="background-color:'.$level1.'";><strong> Lv.1 <br> 위험 </strong></td>';
														$now = '불가';
													}
													else if(($w_score >= 30)&&($w_score < 36.5 )) {
														echo '<td style="background-color:'.$level2.'";><strong> Lv.2 <br> 위험 </strong></td>';
														$now = '불가';
													}
													else if(($w_score >= 36.5)&&($w_score < 59.5 )) {
														echo '<td style="background-color:'.$level3.'";><strong> Lv.3 <br> 주의 </strong></td>';
														$now = '주의';
													}
													else if(($w_score >= 59.5)&&($w_score < 64.5 )) {
														echo '<td style="background-color:'.$level4.'";><strong> Lv.4 <br> 주의 </strong></td>';
														$now = '주의';
													}
													else if(($w_score >= 64.5)&&($w_score < 77 )) {
														echo '<td style="background-color:'.$level5.'";><strong> Lv.5 <br> 안전 </strong></td>';
														$now = '주의';
													}
													else if(($w_score >= 77)&&($w_score < 78 )) {
														echo '<td style="background-color:'.$level6.'";><strong> Lv.6 <br> 안전 </strong></td>';
														$now = '안전';
													}
													else if(($w_score >= 78)&&($w_score < 80.4 )) {
														echo '<td style="background-color:'.$level7.'";><strong> Lv.7 <br> 안전 </strong></td>';
														$now = '안전';
													}
													else if(($w_score >= 80.4)&&($w_score < 96.9 )) {
														echo '<td style="background-color:'.$level8.'";><strong> Lv.8 <br> 안전 </strong></td>';
														$now = '안전';
													}
													else if(($w_score >= 96.9)&&($w_score < 98.2 )){
														echo '<td style="background-color:'.$level9.'";><strong> Lv.9 <br> 안전 </strong></td>';
														$now = '안전';
													}
													else if(($w_score >= 98.2)&&($w_score < 100 )) {
														echo '<td style="background-color:'.$level10.'";><strong> Lv.10 <br> 안전 </strong></td>';
														$now = '안전';
													}	
													if($i == 0 && (($data[$i]['hour']-3)==$lastTime) )
													{
														$lastScore = $now;
														//$lastTime = 
													}
													
												}
									
												else {
													echo '<td style="background-color: '.$level11.'; vertical-align:middle"><strong>미운행</strong></td>';
												}
											}
										?>		
									</tr>

								</table>
							</div>
					
				
						</div>


		 
						
					</div>
			</div>
		</div>