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

	var time = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
	//var time = [];
	var temperature = [];
	var humidity = [];
	var speed = [];
	var altitude = [];
	var CO2 = [];
	var modate;

	var avgtem=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var cnttem=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var avghum=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var cnthum=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var avgspeed=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var cntspeed=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var avgalt=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var cntalt=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var avgco2=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var cntco2=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

  function parse(str)
	{
		var h = str.substr(0,2);
		var m = str.substr(3,2);
		var s = str.substr(6,2);
		return new Date(2018,02,16,h,m,s);
	}

	/*for(var i =0; i<=24; i++)
	{
		time.push(i);
	}*/
	var temp;
	var temp2;
	var modi;
	<?
	for($i=0; $i<count($item); $i++)
	{
		//echo $item[$i]['idx_time'];
	?>
		//modate = parse("<?=$item[$i]['idx_time'] ?>");
		//console.log(modate.getHours());
		temp = "<?=$item[$i]['idx_time'] ?>";
		temp2 = temp.split(":");

		modi = parseInt(temp2[0]);

		//console.log(temp2[0]);
		/*for(var i = 0; i<24; i++)
		{
			console.log(avgtem[i]);
		}*/
		avgtem[modi]+= parseInt("<?=$item[$i]['temperature']?>");
		cnttem[modi]+= 1;
		avghum[modi]+= parseInt("<?=$item[$i]['humidity']?>");
		cnthum[modi]+= 1;
		avgspeed[modi]+= parseInt("<?=$item[$i]['speed']?>");
		cntspeed[modi]+= 1;
		avgalt[modi]+= parseInt("<?=$item[$i]['altitude']?>");
		cntalt[modi]+= 1;
		avgco2[modi]+= parseInt("<?=$item[$i]['CO2']?>");
		cntco2[modi]+= 1;

		//time.push("<?=$item[$i]['idx_time'] ?>");

		temperature.push("<?=$item[$i]['temperature']?>");
		humidity.push("<?=$item[$i]['humidity']?>");
		speed.push("<?=$item[$i]['speed']?>");
		altitude.push("<?=$item[$i]['altitude']?>");
		CO2.push(<?=$item[$i]['CO2']?>);
	<?
	}
	?>

	for(var i = 0; i<24; i++)
	{
		if(cnttem[i] == 0)
			avgtem[i] = 0;
		else
			avgtem[i] = avgtem[i] / cnttem[i];

		if(cnthum[i] == 0)
				avghum[i] = 0;
		else
				avghum[i] = avghum[i] / cnthum[i];

		if(cntspeed[i] == 0)
				avgspeed[i] = 0;
		else
				avgspeed[i] = avgspeed[i] / cntspeed[i];

		if(cntalt[i] == 0)
				avgalt[i] = 0;
		else
				avgalt[i] = avgalt[i] / cntalt[i];

		if(cntco2[i] == 0)
				avgco2[i] = 0;
		else
				avgco2[i] = avgco2[i] / cntco2[i];

	}

	/*for(var i=0; i<time.length; i++)
	{
		console.log(time[i]);
		console.log(typeof(time[i]));
		modate = parse(time[i]);
		//console.log(typeof(modate));
		console.log(modate.getHours());
	}*/

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
            data: avgtem,
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
            data: avghum,
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
            data: avgspeed,
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
            data: avgalt,
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
            data: avgco2,
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
