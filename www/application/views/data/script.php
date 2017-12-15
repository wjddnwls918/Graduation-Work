<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=cddcd2e91c1e74e228286a8b06ded53e"></script>
<script src="/public/common/js/Chart.js"></script>

<script> 
	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
		mapOption = { 
			center: new daum.maps.LatLng(36.7637515, 127.2819829), // 지도의 중심좌표
			level: 3 // 지도 확대 레벨
		};  

	var map = new daum.maps.Map(mapContainer, mapOption); // 지도 생성
	
	// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤 생성
	var mapTypeControl = new daum.maps.MapTypeControl();

	// 지도에 컨트롤을 추가, 컨트롤이 표시될 위치를 TOPRIGHT(오른쪽 위)로 설정
	map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);

	// 지도 확대 축소를 제어할 수 있는 줌 컨트롤을 생성
	var zoomControl = new daum.maps.ZoomControl();
	map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);

	// 선을 구성하는 좌표 배열, 이 좌표들을 이어서 선을 표시
	var linePath = [];
	var points = [];
	
	<?
	for($i=0; $i<count($item); $i++)
	{
		//데이터 표현 방법 체크
		//echo $item[$i]['idx_time'];
	?>
	
	var checkLat = new daum.maps.LatLng(<?=$item[$i]['latitude']?>, <?=$item[$i]['longitude']?>);
	var checkPnt = new daum.maps.LatLng(<?=$item[$i]['latitude']?>, <?=$item[$i]['longitude']?>);
	
	linePath.push(checkLat);
	points.push(checkPnt);
	
	<?	
	}
	?>

	// 선 생성
	var polyline = new daum.maps.Polyline({
		path: linePath, // 선을 구성하는 좌표배열
		strokeWeight: 5, // 선의 두께
		strokeColor: '#2F9D27', // 선의 색깔입
		strokeOpacity: 0.7, // 선의 불투명도(1~0)
		strokeStyle: 'solid' // 선의 스타일
	});

	// 지도에 선 표시
	polyline.setMap(map);  
	
	var imageSrc1 = '/public/common/image/data_icon.png', // 마커이미지의 주소
	imageSize = new daum.maps.Size(30, 30), // 마커이미지의 크기
    imageOption = {offset: new daum.maps.Point(14, 32)}; // 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정
	var markerImage = new daum.maps.MarkerImage(imageSrc1, imageSize, imageOption)
	
	// 지도를 재설정할 범위정보를 가지고 있을 LatLngBounds 객체를 생성
	var bounds = new daum.maps.LatLngBounds();    
	var i, marker;
	
	for (i = 0; i < points.length; i++) {
		// 배열의 좌표들이 잘 보이게 마커를 지도에 추가
		marker = new daum.maps.Marker({ 
			position : points[i],
			image : markerImage
		});
		marker.setMap(map);
		
		// LatLngBounds 객체에 좌표를 추가
		bounds.extend(points[i]);
	}

	function setBounds() {
		// LatLngBounds 객체에 추가된 좌표들을 기준으로 지도의 범위를 재설정합니다
		// 이때 지도의 중심좌표와 레벨이 변경될 수 있습니다
		map.setBounds(bounds);
	}
	
	
	
	
	
	// 그래프 만들기
	var ctx= document.getElementById("myChart");
 
	var time = [];
   		
	var temperature = [];
	var humidity = [];
	var speed = [];
	var altitude = [];
	var CO2 = [];
   
	<?
	for($i=0; $i<count($item); $i++)
	{
		//echo $item[$i]['idx_time'];
	?>
		time.push("<?=$item[$i]['idx_time'] ?>");
		temperature.push("<?=$item[$i]['temperature']?>");
		humidity.push("<?=$item[$i]['humidity']?>");
		speed.push("<?=$item[$i]['speed']?>");
		altitude.push("<?=$item[$i]['altitude']?>");
		CO2.push(<?=$item[$i]['CO2']?>);
	<?	
	}
	?>
	
   var myChart = new Chart(ctx, {
    type: 'line',
	
    data: {
        labels: time,
		
        datasets: [{
			
			label: "Temperature(℃)",
            fill: false,
            lineTension: 0,
            
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(20,20,50,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: temperature,
            spanGaps: true,
        },
		{
			label: "Humidity(%)",
            fill: false,
            lineTension: 0,
            
            borderColor: "rgba(255, 172, 119, 0.9)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(20,20,50,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(50,30,10,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: humidity,
            spanGaps: true,
		},
		{
			label: "Speed(km/h)",
            fill: false,
            lineTension: 0,
            
            borderColor: "rgba(92, 172, 0, 0.9)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(20,20,50,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(50,30,10,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: speed,
            spanGaps: true,
		},
		{
			label: "Altitude(m)",
            fill: false,
            lineTension: 0,
            
            borderColor: "rgba(100,100,200,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(20,20,50,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(50,30,10,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: altitude,
            spanGaps: true,
		},
		{
			label: "CO2(ppm)",
            fill: false,
            lineTension: 0,
            
            borderColor: "rgba(198, 66, 136, 0.9)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(20,20,50,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(50,30,10,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: CO2,
            spanGaps: true,
		}]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
	});
   
	$('#contents').click(function() {
		window.location.href = "/data/drone/"+$(this).val();
	});
	
	
            
 </script >