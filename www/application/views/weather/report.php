	    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">스테이션 날씨
                    <small>스테이션 날씨 예보</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/welcome">Home</a>
                    </li>
                    <li class="active"><a href="/wcondition/weatherReport">Station Weather</a></li>
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
	
			<div class="col-md-10">

				<div class="col-md-12">
					<div class="col-md-3">
						<img class="weatherTapImg2" src="/public/common/image/forecast.png" width="100px" height="100px">
					</div>
					<div class="col-md-9" style="padding-left:20px; padding-top:20px">
						<p class="weatherTapWrite2"> 스테이션이 위치한 곳의 <span style="color:red">날씨</span>를 볼 수 있습니다.<br>
						드론 비행 전 <span style="color:green">참고</span>하시길 바랍니다.</p>
					</div>
				</div>
			
				<div class="col-md-8" id="droneName">
					<ul>
						<h4><li>충청남도 천안시 동남구 병천면</li></h4>
					</ul>
				</div>
				
				<div class="col-md-12">
					<button type="button" class="btn btn-custom btn-xs btnWeather">아이콘설명</button>
					<span>
					<?
						if(date("w") == 0)	$date = '일';
						else if(date("w") == 1) $date = '월';
						else if(date("w") == 2) $date = '화';
						else if(date("w") == 3) $date = '수';
						else if(date("w") == 4) $date = '목';
						else if(date("w") == 5) $date = '금';
						else  $date = '토';
						
						echo date("Y")."년 ". date("n")."월 ".date("j")."일 ".$date."요일 ".date("H").':'.date("i"). " 발표";
					?>
					</span>
				</div>
				
				<div class="col-md-12" style="margin-bottom:3%">
					<table class="table">
						<tr>
							<td width="100px" style="vertical-align:middle">시간</td>
							<?
							for($i=0; $i<3; $i++)
							{
								if($i==0) {
									echo '<td colspan="2"><span style="font-size:20px">'.$data[$i]['hour'].'시</span></td>';
								}
								else {
									echo '<td>'.$data[$i]['hour'].'시</td>';
								}
							}
							?>
						</tr>
						
						<tr>
							<td style="vertical-align:middle">날씨,기온</td>
							<?
							for($i=0; $i<3; $i++) 
							{	
								$wd = '';
								
								if($data[$i]['wd'] == 0) $wd = '북';
								else if($data[$i]['wd'] == 1) $wd = '북동';
								else if($data[$i]['wd'] == 2) $wd = '동';
								else if($data[$i]['wd'] == 3) $wd = '남동';
								else if($data[$i]['wd'] == 4) $wd = '남';
								else if($data[$i]['wd'] == 5) $wd = '남서';
								else if($data[$i]['wd'] == 6) $wd = '서';
								else $wd = '북서';
								
								if($i==0) {
									$rs = $data[$i]['r12'];
										if($rs == '0.0') {
											$rs = '-';
										}
								
									if($data[$i]['wfen'] == "Clear")
									{
										echo '<td width="20%" rowspan="2" style="vertical-align:middle";><img src="/public/common/image/Clearly.png" title="맑음" width="65px" height="65px"></td>';

									}
									
									else if($data[$i]['wfen'] == "Partly Cloudy")
									{
										echo '<td width="20%" rowspan="2" style="vertical-align:middle";><img src="/public/common/image/Little Cloudy.png" title="구름 조금" width="65px" height="65px"></td>';

									}
									
									else if($data[$i]['wfen'] == "Mostly Cloudy")
									{
										echo '<td width="20%" rowspan="2" style="vertical-align:middle";><img src="/public/common/image/Mostly Cloudy.png" title="구름 많음" width="65px" height="65px"></td>';

									}
									
									else if($data[$i]['wfen'] == "Cloudy")
									{
										echo '<td width="20%" rowspan="2" style="vertical-align:middle";><img src="/public/common/image/Cloudy.png" title="구름" width="65px" height=65px"></td>';

									}
									
									else if($data[$i]['wfen'] == "Rain")
									{
										echo '<td width="20%" rowspan="2" style="vertical-align:middle"><img src="/public/common/image/Rainy.png" title="비" width="65px" height="65px"></td>';

									}
									
									else if($data[$i]['wfen'] == "Snow/Rain")
									{
										echo '<td width="20%" rowspan="2" style="vertical-align:middle"><img src="/public/common/image/SnowRain.png" title="눈/비" width="65px" height="65px"></td>';

									}
									
									else if($data[$i]['wfen'] == "Snow")
									{
										echo '<td width="20%" rowspan="2" style="vertical-align:middle"><img src="/public/common/image/Snow.png" title="눈" width="65px" height="65px"></td>';

									}
									echo '<td width="10%" rowspan="2" style="vertical-align:middle"><span style="font-size:25px">'.$data[$i]['temp'].'℃</span><br>'.$wd.' '.$data[$i]['ws'].'m/s<br>'.$data[$i]['reh'].'%<br>'.$rs.'</td>';
								}
								else {
									if($data[$i]['wfen'] == "Clear")
									{
										echo '<td style="vertical-align:middle"><img src="/public/common/image/Clearly.png" title="맑음" width="40px" height="40px">'.$data[$i]['temp'].'℃</td>';

									}
									
									else if($data[$i]['wfen'] == "Partly Cloudy")
									{
										echo '<td style="vertical-align:middle"><img src="/public/common/image/Little Cloudy.png" title="구름 조금" width="40px" height="40px">'.$data[$i]['temp'].'℃</td>';

									}
									
									else if($data[$i]['wfen'] == "Mostly Cloudy")
									{
										echo '<td style="vertical-align:middle"><img src="/public/common/image/Mostly Cloudy.png" title="구름 많음" width="40px" height="40px">'.$data[$i]['temp'].'℃</td>';

									}
									
									else if($data[$i]['wfen'] == "Cloudy")
									{
										echo '<td style="vertical-align:middle"><img src="/public/common/image/Cloudy.png" title="구름" width="40px" height=40px">'.$data[$i]['temp'].'℃</td>';

									}
									
									else if($data[$i]['wfen'] == "Rain")
									{
										echo '<td style="vertical-align:middle"><img src="/public/common/image/Rainy.png" title="비" width="65px" height="65px">'.$data[$i]['temp'].'℃</td>';

									}
									
									else if($data[$i]['wfen'] == "Snow/Rain")
									{
										echo '<td style="vertical-align:middle"><img src="/public/common/image/SnowRain.png" title="눈/비" width="65px" height="65px">'.$data[$i]['temp'].'℃</td>';

									}
									
									else if($data[$i]['wfen'] == "Snow")
									{
										echo '<td style="vertical-align:middle"><img src="/public/common/image/Snow.png" title="눈" width="65px" height="65px">'.$data[$i]['temp'].'℃</td>';

									}
								}
							}
							?>
						</tr>
						
						<tr>
							<td>풍향,풍속<br>습도<br>1시간 강수량</td>
							<?
								for($i=1; $i<3; $i++) {
									$wd = '';
								
									if($data[$i]['wd'] == 0) $wd = '북';
									else if($data[$i]['wd'] == 1) $wd = '북동';
									else if($data[$i]['wd'] == 2) $wd = '동';
									else if($data[$i]['wd'] == 3) $wd = '남동';
									else if($data[$i]['wd'] == 4) $wd = '남';
									else if($data[$i]['wd'] == 5) $wd = '남서';
									else if($data[$i]['wd'] == 6) $wd = '서';
									else $wd = '북서';
									
									echo '<td>'.$wd.' '.$data[$i]['ws'].'m/s<br>'.$data[$i]['reh'].'%</td>';
								}
							?>
						</tr>
					</table>
				</div>
				
			
				
				
				<div class="col-md-12" style="padding-bottom:7%;">
					<div class="col-md-12">
						<p align="right" style="color:blue">
						<?
							if(date("w") == 0)	$date = '일';
							else if(date("w") == 1) $date = '월';
							else if(date("w") == 2) $date = '화';
							else if(date("w") == 3) $date = '수';
							else if(date("w") == 4) $date = '목';
							else if(date("w") == 5) $date = '금';
							else  $date = '토';
						
						echo date("Y")."년 ". date("n")."월 ".date("j")."일 (".$date.")요일 ".date("H").':00'." 발표";
						?>
						</p>
					</div>
					<table class="table table-condensed">
							<?
								$cnt1=0;
								$cnt2=0;
								$cnt3=0;
								
								for($i=0; $i<count($data)-1; $i++ )
								{
									//0개수
									if($data[$i]['day'] == 0)
										$cnt1++;
									
									//1개수
									else if($data[$i]['day'] == 1)
										$cnt2++;
									//2개수
									
									else if($data[$i]['day'] == 2)
										$cnt3++;
									
								}				

									//echo $cnt1."<br>";
									//echo $cnt2."<br>";
									//echo $cnt3."<br>";
								
							
							?>
				 
							<tr>
								<td style="width:10%"><b>날짜</b></td>
								<td colspan="<?=$cnt1?>"><b>오늘</b></td>
								<td colspan="<?=$cnt2?>"><b>내일</b></td>
								<td colspan="<?=$cnt3?>"><b>모레</b></td>
							</tr>
				 
							<tr>
							   <td><b>시각</b></td>
							
							  <?
							   //echo count($data);
								for($i=0; $i<count($data)-1; $i++)
								{
									echo '<td><b>'.$data[$i]['hour'].'시</b></td>';
									
									
								}
							  ?>
							</tr>
						
							<tr>
							
							  <td><b>날씨</b></td>
							   <?
								for($i=0; $i<count($data)-1; $i++)
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
							
							  <td>강수확률(%)</td>
							   <?
								for($i=0; $i<count($data)-1; $i++)
								{
									echo '<td style="vertical-align:middle">'.$data[$i]['pop'].'</td>';	
								}
							  ?>
							
							</tr>
							
							<tr>
							
							  <td>기온(℃)</td>
								<?
								for($i=0; $i<count($data)-1; $i++)
								{
									$temp = substr($data[$i]['temp'], 0, 2);
									echo '<td style="color:red">'.$temp.'</td>';	
								}
							  ?> 
							</tr>
							
							<tr>
							
							  <td style="vertical-align: middle";>풍속(m/s)</td>
							   <?
								for($i=0; $i<count($data)-1; $i++)
								{	
									$windSpeed = $data[$i]['ws'];
									$windSpeed = substr($windSpeed, 0, 1);
									
									if($data[$i]['wd'] == 0)
									{
										echo '<td style="color:blue"><b>'.$windSpeed.'</b><br><img src="/public/common/image/n.png" width="30px" height="30px">'.'</td>';
										
									}
									
									else if($data[$i]['wd'] == 1)
									{
										echo '<td style="color:blue"><b>'.$windSpeed.'</b><br><img src="/public/common/image/n-e.png" width="30px" height="30px">'.'</td>';
									}
									
									else if($data[$i]['wd'] == 2)
									{
										echo '<td style="color:blue"><b>'.$windSpeed.'</b><br><img src="/public/common/image/e.png" width="30px" height="30px">'.'</td>';
									}
									else if($data[$i]['wd'] == 3)
									{
										echo '<td style="color:blue"><b>'.$windSpeed.'</b><br><img src="/public/common/image/s-e.png" width="30px" height="30px">'.'</td>';
									}
									else if($data[$i]['wd'] == 4)
									{
										echo '<td style="color:blue"><b>'.$windSpeed.'</b><br><img src="/public/common/image/s.png" width="30px" height="30px">'.'</td>';
									}
									else if($data[$i]['wd'] == 5)
									{
										echo '<td style="color:blue"><b>'.$windSpeed.'</b><br><img src="/public/common/image/s-w.png" width="30px" height="30px">'.'</td>';
									}
									else if($data[$i]['wd'] == 6)
									{
										echo '<td style="color:blue"><b>'.$windSpeed.'</b><br><img src="/public/common/image/w.png" width="30px" height="30px">'.'</td>';
									}
									
									else
									{
										echo '<td style="color:blue"><b>'.$windSpeed.'</b><br><img src="/public/common/image/n-w.png" width="30px" height="30px">'.'</td>';
									}
								}
							  ?>  
							</tr>
							
							<tr>
							  <td>습도(%)</td>
							   <?
								for($i=0; $i<count($data)-1; $i++)
								{
									echo '<td style="color:green"><b>'.$data[$i]['reh'].'</b></td>';
								}
							  ?>
							</tr>
					</table>
				</div>
		 
		 
			</div>
		</div>