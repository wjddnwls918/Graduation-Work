<script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=
61f79651c17b7db52c47db93b62de00d"></script>

<script>

var whiteListLocal = ['/local_controller/pop_local_info/1', '/local_controller/pop_local_info/2',
					'/local_controller/pop_local_info/3', '/local_controller/pop_local_info/4',
					'/local_controller/pop_local_info/5', '/local_controller/pop_local_info/6'];

					
$('.sensor1').click(function() {
	var link = "/local_controller/pop_local_info/1";
	
	if(whiteListLocal.indexOf(link)!== -1)
		link=link;
	else
		link = "";
	
	window.open(link, "sensor1", "width=600, height=900, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
});

$('.sensor2').click(function() {
	var link = "/local_controller/pop_local_info/2";
	
	if(whiteListLocal.indexOf(link)!== -1)
		link=link;
	else
		link = "";
	
	window.open(link, "sensor2", "width=600, height=900, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
});

$('.sensor3').click(function() {
	var link = "/local_controller/pop_local_info/3";
	
	if(whiteListLocal.indexOf(link)!== -1)
		link=link;
	else
		link = "";
	
	window.open(link, "sensor3", "width=600, height=900, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
});

$('.sensor4').click(function() {
	var link = "/local_controller/pop_local_info/4";
	
	if(whiteListLocal.indexOf(link)!== -1)
		link=link;
	else
		link = "";
	
	window.open(link, "sensor4", "width=600, height=900, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
});

$('.sensor5').click(function() {
	var link = "/local_controller/pop_local_info/5";
	
	if(whiteListLocal.indexOf(link)!== -1)
		link=link;
	else
		link = "";
	
	window.open(link, "sensor5", "width=600, height=900, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
});

$('.sensor6').click(function() {
	var link = "/local_controller/pop_local_info/6";
	
	if(whiteListLocal.indexOf(link)!== -1)
		link=link;
	else
		link = "";

	window.open(link, "sensor6", "width=600, height=900, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
});

	// checkflag가 0 - 이상없음, 1 - 화재주의, 2 - 화재위험, 3 - 지진주의, 4 - 지진위험, 5 - 홍수주의, 6 - 홍수위험
	var checkflag = [0,0,0,0,0,0];
	var fillCircle = ['#2F9D27', '#2F9D27', '#2F9D27', '#2F9D27', '#2F9D27', '#2F9D27'];
	var tempdata = [0,0,0,0,0,0];
	var co2data = [0,0,0,0,0,0];
	
	var tempcons=0.083;
	var co2cons= 0.01;
	
	var deltempcons = 4.16;
	var delco2cons =0.24;
	
	var realHmd = 0.536;
	//41
	var warningPnt = ((30* tempcons * deltempcons) 
				+ (410* co2cons * delco2cons) ) * realHmd;
	//50.4
	var firePnt = ((40* tempcons * deltempcons) 
				+ (5000* co2cons * delco2cons) ) * realHmd;
	
	
	
	var emergency = true;
  
	// 학교구역을 구성하는 좌표 배열입니다. 이 좌표들을 이어서 다각형을 표시합니다
	var polygonPath = [
		new daum.maps.LatLng(36.767525, 127.283738),
		new daum.maps.LatLng(36.767879, 127.281104),
		new daum.maps.LatLng(36.767345, 127.280764),
		new daum.maps.LatLng(36.766425, 127.280407), 
		new daum.maps.LatLng(36.765249, 127.278442),
		new daum.maps.LatLng(36.763164, 127.280148),
		new daum.maps.LatLng(36.759745, 127.276289),
		new daum.maps.LatLng(36.759240, 127.277822),
		new daum.maps.LatLng(36.759703, 127.279995),
		new daum.maps.LatLng(36.760791, 127.284555),
		new daum.maps.LatLng(36.760849, 127.285361),
		new daum.maps.LatLng(36.762462, 127.285131),
		new daum.maps.LatLng(36.763708, 127.285184),
		new daum.maps.LatLng(36.765391, 127.284725),
		new daum.maps.LatLng(36.765393, 127.284711),
		new daum.maps.LatLng(36.766046, 127.284121),
		new daum.maps.LatLng(36.767138, 127.284293)
	];


	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
		mapOption = { 
			center: new daum.maps.LatLng(36.763605, 127.281697), // 지도의 중심좌표
			level: 4 // 지도의 확대 레벨
		};

	// 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
	var map = new daum.maps.Map(mapContainer, mapOption); 

	// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
	var mapTypeControl = new daum.maps.MapTypeControl();

	// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
	// daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
	map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);

	// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
	var zoomControl = new daum.maps.ZoomControl();
	map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);


<!-- 학교 반경 표시 -->

	// 지도에 표시할 다각형을 생성합니다
	var polygon = new daum.maps.Polygon({
		path:polygonPath, // 그려질 다각형의 좌표 배열입니다
		strokeWeight: 1, // 선의 두께입니다
		strokeColor: '#353535', // 선의 색깔입니다
		strokeOpacity: 0.8, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'shortdash', // 선의 스타일입니다
		fillColor: '#A2FF99', // 채우기 색깔입니다
		fillOpacity: 0 // 채우기 불투명도 입니다
	});

	// 지도에 다각형을 표시합니다
	polygon.setMap(map);



	
	

	if(emergency) {
		// 마커를 표시할 위치와 내용을 가지고 있는 객체 배열입니다 
		var positions = [
			{
				content: '<div style="text-align:center; color:red"><h4><strong>병천동면 파출소<br>(041-570-0382)</strong></h4></div>', 
				latlng: new daum.maps.LatLng(36.763457, 127.297597)
			},
			{
				content: '<div style="text-align:center; color:red"><h4><strong>병천119 안전센터<br>(041-564-1112)</strong></h4></div>', 
				latlng: new daum.maps.LatLng(36.764183, 127.300876)
			},
			{
				content: '<div style="text-align:center; color:red"><h4><strong>독립기념관119<br>(119)</strong></h4></div>', 
				latlng: new daum.maps.LatLng(36.781324, 127.221602)
			},
			{
				content: '<div style="text-align:center; color:red"><h4><strong>목천북면파출소<br>(041-557-2112)</strong></h4></div>', 
				latlng: new daum.maps.LatLng(36.7856749, 127.23576249999996)
			}
		];

		for (var i = 0; i < positions.length; i ++) {
			// 마커를 생성합니다
			var marker = new daum.maps.Marker({
				map: map, // 마커를 표시할 지도
				position: positions[i].latlng // 마커의 위치
			});

			// 마커에 표시할 인포윈도우를 생성합니다 
			var infowindow = new daum.maps.InfoWindow({
				content: positions[i].content // 인포윈도우에 표시할 내용
			});

			// 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
			// 이벤트 리스너로는 클로저를 만들어 등록합니다 
			// for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
			daum.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
			daum.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
		}

		// 인포윈도우를 표시하는 클로저를 만드는 함수입니다 
		function makeOverListener(map, marker, infowindow) {
			return function() {
				infowindow.open(map, marker);
			};
		}
	
		// 인포윈도우를 닫는 클로저를 만드는 함수입니다 
		function makeOutListener(infowindow) {
			return function() {
				infowindow.close();
			};
		}
	}
	
	    

	$(document).ready(function() 
	{
		
		
		function get(){  //받아옴
		
		
		$.ajax({
			url : "/local_controller/get_info_fire",
			dataType : "json",
			success : function(data) {
				
				//console.log(data);
				calFire(data);
				calVibration(data);
				calWaterlevel(data);
				drawCircle(checkflag);
			}
			
		});
		}
		
		function calFire(data)
		{
			
			var result =0;
			
		
			
			for (i=0; i < data.length; i++)
			{
				result = ((data[i]['temperature']* tempcons * deltempcons) 
				+ (data[i]['CO2']* co2cons * delco2cons) ) * realHmd;
				
				if ( result < warningPnt)
				{
					checkflag[i] = 0;
					//평소
				}
						
				else if ( result >= warningPnt && result < firePnt )
				{
					checkflag[i] = 1;
					//주의
				}
				
				else if ( result >= firePnt)
				{
					checkflag[i] = 2;
					//화재
				}
			}
			
		}
		
		function calVibration(data)
		{
			for (i=0; i < data.length; i++)
			{
				if(data[i]['vibration'] >=100&& data[i]['vibration'] < 200)
				{
					// 지진주의
					checkflag[i] = 3;
				}
				else if(data[i]['vibration'] >= 200) // 10이상
				{
					// 지진위험
					checkflag[i] = 4;
				}
			}
			
		}
		
		function calWaterlevel(data)
		{
			for (i=0; i < data.length; i++)
			{
				if(data[i]['waterlevel'] >= 250 && data[i]['waterlevel'] < 500)
				{
					// 홍수주의
					checkflag[i] = 5;
				}
				else if(data[i]['waterlevel'] >= 500) // 500이상
				{
					// 홍수위험
					checkflag[i] = 6;
				}
			}
		}
		
		setInterval( function () { get();  },2000);
		
	});
	
var circleMarkers1 = []; var circleMarkers2 = []; var circleMarkers3 = [];
var circleMarkers4 = []; var circleMarkers5 = []; var circleMarkers6 = [];

	function drawCircle(checkflag) {
		for(var i = 0; i < circleMarkers1.length; i++) {
			circleMarkers1[i].setMap(null);
			circleMarkers2[i].setMap(null);
			circleMarkers3[i].setMap(null);
			circleMarkers4[i].setMap(null);
			circleMarkers5[i].setMap(null);
			circleMarkers6[i].setMap(null);
		}
		
		for(var i=0; i<checkflag.length; i++) {
			if(checkflag[i] == 0) {
				fillCircle[i] = '#2F9D27';
			}
			else if(checkflag[i] == 1) {
				fillCircle[i] = '#FFE400';
			}
			else if(checkflag[i] == 2) {
				fillCircle[i] = '#FF0000';
			}
			else if(checkflag[i] == 3) {
				fillCircle[i] = '#B2A529';
			}
			else if(checkflag[i] == 4) {
				fillCircle[i] = '#665C00';
			}
			else if(checkflag[i] == 5) {
				fillCircle[i] = '#6799FF';
			}
			else if(checkflag[i] == 6) {
				fillCircle[i] = '#0100FF';
			}
		}
			// 지도에 표시할 원을 생성합니다
		var circle1 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.766474, 127.282530),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: '#75B8FA', // 선의 색깔입니다
			strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: fillCircle[0], // 채우기 색깔입니다
			fillOpacity: 0.7  // 채우기 불투명도 입니다   
		}); 
		circleMarkers1.push(circle1);
		
		var circle2 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.764978, 127.280798),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: '#75B8FA', // 선의 색깔입니다
			strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: fillCircle[1], // 채우기 색깔입니다
			fillOpacity: 0.7  // 채우기 불투명도 입니다   
		}); 
		circleMarkers2.push(circle2);
		
		var circle3 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.763454, 127.282329),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: '#75B8FA', // 선의 색깔입니다
			strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: fillCircle[2], // 채우기 색깔입니다
			fillOpacity: 0.7  // 채우기 불투명도 입니다   
		}); 
		circleMarkers3.push(circle3);
		
		var circle4 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.762130, 127.284093),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: '#75B8FA', // 선의 색깔입니다
			strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: fillCircle[3], // 채우기 색깔입니다
			fillOpacity: 0.7  // 채우기 불투명도 입니다   
		}); 
		circleMarkers4.push(circle4);
		
		var circle5 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.761547, 127.280664),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: '#75B8FA', // 선의 색깔입니다
			strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: fillCircle[4], // 채우기 색깔입니다
			fillOpacity: 0.7  // 채우기 불투명도 입니다   
		}); 
		circleMarkers5.push(circle5);
		
		var circle6 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.760252, 127.278389),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: '#75B8FA', // 선의 색깔입니다
			strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: fillCircle[5], // 채우기 색깔입니다
			fillOpacity: 0.7  // 채우기 불투명도 입니다   
		}); 
		circleMarkers6.push(circle6);
		
	// 지도에 원을 표시합니다 
	circle1.setMap(map);  circle2.setMap(map);  circle3.setMap(map); 
	circle4.setMap(map);  circle5.setMap(map);  circle6.setMap(map);
	}
	
	
	// 마커를 표시할 위치입니다 
	var position1 =  new daum.maps.LatLng(36.766474, 127.282530);
	var position2 =  new daum.maps.LatLng(36.764978, 127.280798);
	var position3 =  new daum.maps.LatLng(36.763454, 127.282329);
	var position4 =  new daum.maps.LatLng(36.762130, 127.284093);
	var position5 =  new daum.maps.LatLng(36.761547, 127.280664);
	var position6 =  new daum.maps.LatLng(36.760252, 127.278389);
	
	// 마커를 생성합니다
	var marker1 = new daum.maps.Marker({ position: position1 });
	var marker2 = new daum.maps.Marker({ position: position2 });
	var marker3 = new daum.maps.Marker({ position: position3 });
	var marker4 = new daum.maps.Marker({ position: position4 });
	var marker5 = new daum.maps.Marker({ position: position5 });
	var marker6 = new daum.maps.Marker({ position: position6 });
		
	// 마커를 지도에 표시합니다.
	marker1.setMap(map); marker2.setMap(map); marker3.setMap(map);
	marker4.setMap(map); marker5.setMap(map); marker6.setMap(map);

	var iwContent1 = '<div style="padding:5px;">로컬센서 1<br>위도:36.766474<br>경도:127.282530</div>';
	var iwContent2 = '<div style="padding:5px;">로컬센서 2<br>위도:36.764978<br>경도:127.280798</div>';
	var iwContent3 = '<div style="padding:5px;">로컬센서 3<br>위도:36.763454<br>경도:127.282329</div>';
	var iwContent4 = '<div style="padding:5px;">로컬센서 4<br>위도:36.762130<br>경도:127.284093</div>';
	var iwContent5 = '<div style="padding:5px;">로컬센서 5<br>위도:36.761547<br>경도:127.280664</div>';
	var iwContent6 = '<div style="padding:5px;">로컬센서 6<br>위도:36.760252<br>경도:127.278389</div>';

	var infowindow1 = new daum.maps.InfoWindow({ content : iwContent1 });
	var infowindow2 = new daum.maps.InfoWindow({ content : iwContent2 });
	var infowindow3 = new daum.maps.InfoWindow({ content : iwContent3 });
	var infowindow4 = new daum.maps.InfoWindow({ content : iwContent4 });
	var infowindow5 = new daum.maps.InfoWindow({ content : iwContent5 });
	var infowindow6 = new daum.maps.InfoWindow({ content : iwContent6 });
	
	daum.maps.event.addListener(marker1, 'mouseover', function() { infowindow1.open(map, marker1); });
	daum.maps.event.addListener(marker2, 'mouseover', function() { infowindow2.open(map, marker2); });
	daum.maps.event.addListener(marker3, 'mouseover', function() { infowindow3.open(map, marker3); });
	daum.maps.event.addListener(marker4, 'mouseover', function() { infowindow4.open(map, marker4); });
	daum.maps.event.addListener(marker5, 'mouseover', function() { infowindow5.open(map, marker5); });
	daum.maps.event.addListener(marker6, 'mouseover', function() { infowindow6.open(map, marker6); });

		
	daum.maps.event.addListener(marker1, 'mouseout', function() { infowindow1.close(); });
	daum.maps.event.addListener(marker2, 'mouseout', function() { infowindow2.close(); });
	daum.maps.event.addListener(marker3, 'mouseout', function() { infowindow3.close(); });
	daum.maps.event.addListener(marker4, 'mouseout', function() { infowindow4.close(); });
	daum.maps.event.addListener(marker5, 'mouseout', function() { infowindow5.close(); });
	daum.maps.event.addListener(marker6, 'mouseout', function() { infowindow6.close(); });
	
	
</script>