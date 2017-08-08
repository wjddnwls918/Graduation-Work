<script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=61f79651c17b7db52c47db93b62de00d"></script>

<script>
	var selectDrone = 0;   // 선택된 드론을 판별해주는 변수입니다
	var lat = [];          // 지도에 선택된 위도들의 값이 들어있는 변수 
	var lng = [];          // 지도에 선택된 경도들의 값이 들어있는 변수
	
	var droneCount=0;           // 드론 충돌 방지에 사용될 드론 갯수 파악하는 변수
	var arrDroneFlag = [false, false, false];      // 드론 충돌 방지에 사용될 드론 flag 파악하는 배열
	var arrDroneLat;       // 드론 충돌 방지에 사용될 드론별 lat 배열
	var arrDroneLng;       // 드론 충돌 방지에 사용될 드론별 lng 배열
	
	<!-- 화재 실시간 감지 및 화재 지역 반경 표시 -->	
	var fireflag = [0,0,0,0,0,0];
	var warningflag = [0,0,0,0,0,0];

	var checkflag = [0,0,0,0,0,0];
	var lineCircle = ['#2F9D27', '#2F9D27', '#2F9D27', '#2F9D27', '#2F9D27', '#2F9D27'];
	
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
					//51.4
	var firePnt = ((40* tempcons * deltempcons) 
				+ (5000* co2cons * delco2cons) ) * realHmd;
	
	
	var circleLat = [36.766474 , 36.764978, 36.763454 , 36.76213 , 36.761547 , 36.760252 ];
	var circleLng = [127.28253 , 127.280798 , 127.282329, 127.284093 , 127.280664 , 127.278389 ];
	
	$(document).ready(function() 
	{
		
		
		function get(){  //받아옴
		
		
		$.ajax({
			url : "/map/get_info_fire",
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
				if(data[i]['vibration'] >=5 && data[i]['vibration'] < 10)
				{
					// 지진주의
					checkflag[i] = 3;
				}
				else if(data[i]['vibration'] >= 10) // 10이상
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
				lineCircle[i] = '#2F9D27';
			}
			else if(checkflag[i] == 1) {
				lineCircle[i] = '#FFE400';
			}
			else if(checkflag[i] == 2) {
				lineCircle[i] = '#FF0000';
			}
			else if(checkflag[i] == 3) {
				lineCircle[i] = '#B2A529';
			}
			else if(checkflag[i] == 4) {
				lineCircle[i] = '#665C00';
			}
			else if(checkflag[i] == 5) {
				lineCircle[i] = '#6799FF';
			}
			else if(checkflag[i] == 6) {
				lineCircle[i] = '#0100FF';
			}
		}
		
			// 지도에 표시할 원을 생성합니다
		var circle1 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.766474, 127.282530),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: lineCircle[0], // 선의 색깔입니다
			strokeOpacity: 0.5, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: '#CFE7FF', // 채우기 색깔입니다
			fillOpacity: 0  // 채우기 불투명도 입니다   
		}); 
		circleMarkers1.push(circle1);
		
		var circle2 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.764978, 127.280798),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: lineCircle[1], // 선의 색깔입니다
			strokeOpacity: 0.5, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: '#CFE7FF', // 채우기 색깔입니다
			fillOpacity: 0  // 채우기 불투명도 입니다   
		}); 
		circleMarkers2.push(circle2);
		
		var circle3 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.763454, 127.282329),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: lineCircle[2], // 선의 색깔입니다
			strokeOpacity: 0.5, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: '#CFE7FF', // 채우기 색깔입니다
			fillOpacity: 0  // 채우기 불투명도 입니다   
		}); 
		circleMarkers3.push(circle3);
		
		var circle4 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.762130, 127.284093),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: lineCircle[3], // 선의 색깔입니다
			strokeOpacity: 0.5, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: '#CFE7FF', // 채우기 색깔입니다
			fillOpacity: 0  // 채우기 불투명도 입니다   
		}); 
		circleMarkers4.push(circle4);
		
		var circle5 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.761547, 127.280664),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: lineCircle[4], // 선의 색깔입니다
			strokeOpacity: 0.5, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: '#CFE7FF', // 채우기 색깔입니다
			fillOpacity: 0  // 채우기 불투명도 입니다   
		}); 
		circleMarkers5.push(circle5);
		
		var circle6 = new daum.maps.Circle({
			center : new daum.maps.LatLng(36.760252, 127.278389),  // 원의 중심좌표 입니다 
			radius: 100, // 미터 단위의 원의 반지름입니다 
			strokeWeight: 2, // 선의 두께입니다 
			strokeColor: lineCircle[5], // 선의 색깔입니다
			strokeOpacity: 0.5, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
			strokeStyle: 'solid', // 선의 스타일 입니다
			fillColor: '#CFE7FF', // 채우기 색깔입니다
			fillOpacity: 0  // 채우기 불투명도 입니다   
		}); 
		circleMarkers6.push(circle6);
	// 지도에 원을 표시합니다 
		circle1.setMap(map);  circle2.setMap(map);  circle3.setMap(map); 
		circle4.setMap(map);  circle5.setMap(map);  circle6.setMap(map);	
	}
	
var droneFlag1 = false;
var droneFlag2 = false;
var droneFlag3 = false;


<!-- 드론 버튼 선택 -->
var chkbox1 = new DG.OnOffSwitch({
    el: '#drone1',
    height: 30,
    trackColorOn:'#FF0000',
    trackColorOff:'#666',
    trackBorderColor:'#555',
    textColorOff:'#fff',
	textOn:'ON',
    textOff:'OFF',
	listener: function(){
		droneFlag1 = chkbox1.checked;
		arrDroneFlag[0] = droneFlag1;
		//console.log(chkbox1.checked);
		if(droneFlag1) {
			selectDrone = 1;
			lat = []; lng = [];	
			droneCount++;
			//우진 추가
			drawLine1();
		}
		else {
			selectDrone = 0;
			droneFlag1 = false;
			droneCount--;
			//우진 추가
			delLine1();
		}
	}
});

var chkbox2 = new DG.OnOffSwitch({
    el: '#drone2',
    height: 30,
    trackColorOn:'#0100FF',
    trackColorOff:'#666',
    trackBorderColor:'#555',
    textColorOff:'#fff',
	textOn:'ON',
    textOff:'OFF',
	listener: function(){
		droneFlag2 = chkbox2.checked;
		arrDroneFlag[1] = droneFlag2;
		//console.log(chkbox2.checked);
		if(droneFlag2) {
			selectDrone = 2;
			lat = []; lng = [];	
			droneCount++;
			drawLine2();
		}
		else {
			selectDrone = 0;
			droneFlag2 = false;
			droneCount--;
			delLine2();
		}
	}
});

var chkbox3 = new DG.OnOffSwitch({
    el: '#drone3',
    height: 30,
    trackColorOn:'#2F9D27',
    trackColorOff:'#666',
    trackBorderColor:'#555',
    textColorOff:'#fff',
	textOn:'ON',
    textOff:'OFF',
	listener: function(){
		droneFlag3 = chkbox3.checked;
		arrDroneFlag[2] = droneFlag3;
		//console.log(chkbox3.checked);
		if(droneFlag3) {
			selectDrone = 3;
			lat = []; lng = [];	
			droneCount++;
			drawLine3();
		}
		else {
			selectDrone = 0;
			droneFlag3 = false;
			droneCount--;
			delLine3();
		}
	}
});	




<!-- 지도 생성 -->
	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
		mapOption = { 
			center: new daum.maps.LatLng(36.7638237, 127.28138339999998), // 지도의 중심좌표
			level: 4 // 지도의 확대 레벨
		};

	var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

	// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
	var mapTypeControl = new daum.maps.MapTypeControl();

	// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
	// daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
	map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);

	// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
	var zoomControl = new daum.maps.ZoomControl();
	map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);

	
<!-- 스테이션 위치 표시 -->

	// 지도에 폴리곤으로 표시할 영역데이터 배열입니다 
	var areas = [
    {
        name : '스테이션1',
        path : [
            new daum.maps.LatLng(36.76194686346905, 127.2802017053782),
            new daum.maps.LatLng(36.76158981063254, 127.28067358851341),
            new daum.maps.LatLng(36.76140328632766, 127.28047971667465),
            new daum.maps.LatLng(36.761776088024725, 127.28001629072665),
        ]
    }
	];


	
	var customOverlay = new daum.maps.CustomOverlay({});
	var infowindow = new daum.maps.InfoWindow({removable: true});

	
<!-- 드론 위치 실시간 표시하기 -->

	// 마커를 표시할 위치와 title 객체 배열입니다 
	var droneLat1 = 0; var droneLng1 = 0;
	var droneLat2 = 0; var droneLng2 = 0;
	var droneLat3 = 0; var droneLng3 = 0;
	var positions = [];
	var droneMarkers1 = [];
	var droneMarkers2 = [];
	var droneMarkers3 = [];

	$(document).ready(function() {
		function get() {
			$.ajax({
				url : "/map/get_info_json",
				dataType : "json",
				success : function(data) {
				droneGPS(data);  //업데이트
				},
			});		
			drawDrones(positions);
			delTraceLine();
			traceLine(); 
			
		}
		setInterval(function(){get();},1000);
	});

	function droneGPS(data) {   
		droneLat1 = data[0]['latitude']; droneLng1 = data[0]['longitude'];
		droneLat2 = data[1]['latitude']; droneLng2 = data[1]['longitude'];
		droneLat3 = data[2]['latitude']; droneLng3 = data[2]['longitude'];

		arrDroneLat = [droneLat1, droneLat2, droneLat3];
		arrDroneLng = [droneLng1, droneLng2, droneLng3];
		
		positions = [
		{
			title: '드론1', 
			latlng: new daum.maps.LatLng(droneLat1, droneLng1)
		},
		{
			title: '드론2', 
			latlng: new daum.maps.LatLng(droneLat2, droneLng2)
		},
		{
			title: '드론3', 
			latlng: new daum.maps.LatLng(droneLat3, droneLng3)
		}
	];
}

	function drawDrones(positions) {

	for(var i = 0; i < droneMarkers1.length; i++) {
		droneMarkers1[i].setMap(null);
	}
		
	// 마커 이미지의 이미지 주소입니다
	var droneImage1 = "/public/common/image/drone1.png"; 
	
	// 마커 이미지의 이미지 크기 입니다
	var imageSize1 = new daum.maps.Size(35, 35); 
	
	// 마커 이미지를 생성합니다    
	var markerImage1 = new daum.maps.MarkerImage(droneImage1, imageSize1); 
		
	// 마커를 생성합니다
	var marker1 = new daum.maps.Marker({
		map: map, // 마커를 표시할 지도
		position: positions[0].latlng, // 마커를 표시할 위치
		title : positions[0].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
		image : markerImage1 // 마커 이미지 
	});
	
	droneMarkers1.push(marker1);

	for(var i = 0; i < droneMarkers2.length; i++) {
		droneMarkers2[i].setMap(null);
	}
	
	var droneImage2 = "/public/common/image/drone2.png"; 
	var imageSize2 = new daum.maps.Size(35, 35); 
	var markerImage2 = new daum.maps.MarkerImage(droneImage2, imageSize2); 
		
	var marker2 = new daum.maps.Marker({
		map: map, 
		position: positions[1].latlng, 
		title : positions[1].title,
		image : markerImage2
	});
	
	droneMarkers2.push(marker2);
	
	for(var i = 0; i < droneMarkers3.length; i++) {
		droneMarkers3[i].setMap(null);
	}

	var droneImage3 = "/public/common/image/drone3.png"; 
	var imageSize3 = new daum.maps.Size(35, 35); 
	var markerImage3 = new daum.maps.MarkerImage(droneImage3, imageSize3); 
		
	var marker3 = new daum.maps.Marker({
		map: map,
		position: positions[2].latlng,
		title : positions[2].title,
		image : markerImage3
	});
	droneMarkers3.push(marker3);
}


<!----- 드론 위치 실시간 표시하기 종료 ------>

	// 지도에 영역데이터를 폴리곤으로 표시합니다 
	for (var i = 0, len = areas.length; i < len; i++) {
		displayArea(areas[i]);
	}

	// 다각형을 생상하고 이벤트를 등록하는 함수입니다
	function displayArea(area) {

    // 다각형을 생성합니다 
    var polygon = new daum.maps.Polygon({
        map: map, // 다각형을 표시할 지도 객체
        path: area.path,
        strokeWeight: 2,
        strokeColor: '#004c80',
        strokeOpacity: 0.8,
        fillColor: '#fff',
        fillOpacity: 0.7 
    });

    // 다각형에 mouseover 이벤트를 등록하고 이벤트가 발생하면 폴리곤의 채움색을 변경합니다 
    // 지역명을 표시하는 커스텀오버레이를 지도위에 표시합니다
    daum.maps.event.addListener(polygon, 'mouseover', function(mouseEvent) {
        polygon.setOptions({fillColor: '#09f'});

        customOverlay.setContent('<div class="area">' + area.name + '</div>');
        
        customOverlay.setPosition(mouseEvent.latLng); 
        customOverlay.setMap(map);
    });

    // 다각형에 mousemove 이벤트를 등록하고 이벤트가 발생하면 커스텀 오버레이의 위치를 변경합니다 
    daum.maps.event.addListener(polygon, 'mousemove', function(mouseEvent) {
        
        customOverlay.setPosition(mouseEvent.latLng); 
    });

    // 다각형에 mouseout 이벤트를 등록하고 이벤트가 발생하면 폴리곤의 채움색을 원래색으로 변경합니다
    // 커스텀 오버레이를 지도에서 제거합니다 
    daum.maps.event.addListener(polygon, 'mouseout', function() {
        polygon.setOptions({fillColor: '#fff'});
        customOverlay.setMap(null);
    }); 
}


<!------ 클릭시 해당 위치의 위도 및 경도 표시 ------>

	// 지도에 클릭 이벤트를 등록합니다
	// 지도를 클릭하면 마지막 파라미터로 넘어온 함수를 호출합니다
	daum.maps.event.addListener(map, 'click', function(mouseEvent) {        
	
	if((selectDrone == 1) || (selectDrone == 2) || (selectDrone == 3)) {
		// 클릭한 위도, 경도 정보를 가져옵니다 
		var latlng = mouseEvent.latLng;
		
		var message = '클릭한 위치의 위도는 ' + latlng.getLat() + typeof(latlng.getLat())+ ' 이고, ';
		message += '경도는 ' + latlng.getLng() + ' 입니다';
		
		lat.push(latlng.getLat());
		lng.push(latlng.getLng());
		console.log(message);
		console.log("선택된 위도의 배열 - " + lat);
		console.log("선택된 경도의 배열 - " + lng);
	}
	
	else {
		console.log("드론 선택이 되지 않아 위치를 전달할 수 없습니다.");
	}
	
});


<!------------ 학교 반경 표시 ------------>
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

	
	<!-- 지도 클릭시 선 표시 -->

	var drawingFlag = false; // 선이 그려지고 있는 상태를 가지고 있을 변수입니다
	var moveLine; // 선이 그려지고 있을때 마우스 움직임에 따라 그려질 선 객체 입니다
	var clickLine; // 마우스로 클릭한 좌표로 그려질 선 객체입니다
	var clickLine1;
	var clickLine2;
	var clickLine3;
	var distanceOverlay; // 선의 거리정보를 표시할 커스텀오버레이 입니다
	var dots = {}; // 선이 그려지고 있을때 클릭할 때마다 클릭 지점과 거리를 표시하는 커스텀 오버레이 배열입니다.
	var cnt = 0; // 클릭시 몇번째 누른 거리인지 표시 해줌

	// 지도에 클릭 이벤트를 등록합니다
	// 지도를 클릭하면 선 그리기가 시작됩니다 그려진 선이 있으면 지우고 다시 그립니다
	daum.maps.event.addListener(map, 'click', function(mouseEvent) {

    // 마우스로 클릭한 위치입니다 
    var clickPosition = mouseEvent.latLng;
	
	var startPosition1 = new daum.maps.LatLng(droneLat1, droneLng1);
	var startPosition2 = new daum.maps.LatLng(droneLat2, droneLng2);
	var startPosition3 = new daum.maps.LatLng(droneLat3, droneLng3);
	
	if(droneFlag1 || droneFlag2 || droneFlag3) {
	// 지도 클릭이벤트가 발생했는데 선을 그리고있는 상태가 아니면
    if (!drawingFlag) {
        if(selectDrone == 1) {
			// 드론의 현재 위치와 화재가 발생한 위치를 이어주는 선을 삭제해줍니다
			delLine1();
			
            // 상태를 true로, 선이 그리고있는 상태로 변경합니다
            drawingFlag = true;

            // 지도 위에 선이 표시되고 있다면 지도에서 제거합니다
            deleteClickLine();

            // 지도 위에 커스텀오버레이가 표시되고 있다면 지도에서 제거합니다
            deleteDistnce();

            // 지도 위에 선을 그리기 위해 클릭한 지점과 해당 지점의 거리정보가 표시되고 있다면 지도에서 제거합니다
            deleteCircleDot();

            // 클릭한 위치를 기준으로 선을 생성하고 지도위에 표시합니다
            clickLine1 = new daum.maps.Polyline({
                map: map, // 선을 표시할 지도입니다 
                path: [startPosition1], // 선을 구성하는 좌표 배열입니다 클릭한 위치를 넣어줍니다
                strokeWeight: 3, // 선의 두께입니다 
                strokeColor: '#db4040', // 선의 색깔입니다
                strokeOpacity: 1, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
                strokeStyle: 'solid' // 선의 스타일입니다
            });

            // 선이 그려지고 있을 때 마우스 움직임에 따라 선이 그려질 위치를 표시할 선을 생성합니다
            moveLine = new daum.maps.Polyline({
                strokeWeight: 3, // 선의 두께입니다 
                strokeColor: '#db4040', // 선의 색깔입니다
                strokeOpacity: 0.5, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
                strokeStyle: 'solid' // 선의 스타일입니다    
            });

            // 클릭한 지점에 대한 정보를 지도에 표시합니다
            displayCircleDot(clickPosition, 0);
        }
        
        else if(selectDrone == 2) {
			// 드론의 현재 위치와 화재가 발생한 위치를 이어주는 선을 삭제해줍니다
			delLine2();
			
            // 상태를 true로, 선이 그리고있는 상태로 변경합니다
            drawingFlag = true;

            // 지도 위에 선이 표시되고 있다면 지도에서 제거합니다
            deleteClickLine();

            // 지도 위에 커스텀오버레이가 표시되고 있다면 지도에서 제거합니다
            deleteDistnce();

            // 지도 위에 선을 그리기 위해 클릭한 지점과 해당 지점의 거리정보가 표시되고 있다면 지도에서 제거합니다
            deleteCircleDot();

            // 클릭한 위치를 기준으로 선을 생성하고 지도위에 표시합니다
            clickLine2 = new daum.maps.Polyline({
                map: map, // 선을 표시할 지도입니다 
                path: [startPosition2], // 선을 구성하는 좌표 배열입니다 클릭한 위치를 넣어줍니다
                strokeWeight: 3, // 선의 두께입니다 
                strokeColor: '#0100FF', // 선의 색깔입니다
                strokeOpacity: 1, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
                strokeStyle: 'solid' // 선의 스타일입니다
            });

            // 선이 그려지고 있을 때 마우스 움직임에 따라 선이 그려질 위치를 표시할 선을 생성합니다
            moveLine = new daum.maps.Polyline({
                strokeWeight: 3, // 선의 두께입니다 
                strokeColor: '#0100FF', // 선의 색깔입니다
                strokeOpacity: 0.5, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
                strokeStyle: 'solid' // 선의 스타일입니다    
            });

            // 클릭한 지점에 대한 정보를 지도에 표시합니다
            displayCircleDot(clickPosition, 0);
        
        }
        else if(selectDrone == 3) {
			// 드론의 현재 위치와 화재가 발생한 위치를 이어주는 선을 삭제해줍니다
			delLine3();
			
            // 상태를 true로, 선이 그리고있는 상태로 변경합니다
            drawingFlag = true;

            // 지도 위에 선이 표시되고 있다면 지도에서 제거합니다
            deleteClickLine();

            // 지도 위에 커스텀오버레이가 표시되고 있다면 지도에서 제거합니다
            deleteDistnce();

            // 지도 위에 선을 그리기 위해 클릭한 지점과 해당 지점의 거리정보가 표시되고 있다면 지도에서 제거합니다
            deleteCircleDot();

            // 클릭한 위치를 기준으로 선을 생성하고 지도위에 표시합니다
            clickLine3 = new daum.maps.Polyline({
                map: map, // 선을 표시할 지도입니다 
                path: [startPosition3], // 선을 구성하는 좌표 배열입니다 클릭한 위치를 넣어줍니다
                strokeWeight: 3, // 선의 두께입니다 
                strokeColor: '#47C83E', // 선의 색깔입니다
                strokeOpacity: 1, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
                strokeStyle: 'solid' // 선의 스타일입니다
            });

            // 선이 그려지고 있을 때 마우스 움직임에 따라 선이 그려질 위치를 표시할 선을 생성합니다
            moveLine = new daum.maps.Polyline({
                strokeWeight: 3, // 선의 두께입니다 
                strokeColor: '#47C83E', // 선의 색깔입니다
                strokeOpacity: 0.5, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
                strokeStyle: 'solid' // 선의 스타일입니다    
            });

            // 클릭한 지점에 대한 정보를 지도에 표시합니다
            displayCircleDot(clickPosition, 0);
        
        }
            
    } else { // 선이 그려지고 있는 상태이면
        if(selectDrone == 1) {
            // 그려지고 있는 선의 좌표 배열을 얻어옵니다
            var path = clickLine1.getPath();

            // 좌표 배열에 클릭한 위치를 추가합니다
            path.push(clickPosition);

            // 다시 선에 좌표 배열을 설정하여 클릭 위치까지 선을 그리도록 설정합니다
            clickLine1.setPath(path);

            var distance = Math.round(clickLine1.getLength());
        }
        else if(selectDrone == 2) {
            // 그려지고 있는 선의 좌표 배열을 얻어옵니다
            var path = clickLine2.getPath();

            // 좌표 배열에 클릭한 위치를 추가합니다
            path.push(clickPosition);

            // 다시 선에 좌표 배열을 설정하여 클릭 위치까지 선을 그리도록 설정합니다
            clickLine2.setPath(path);

            var distance = Math.round(clickLine2.getLength());
        }
        else if(selectDrone == 3) {
            // 그려지고 있는 선의 좌표 배열을 얻어옵니다
            var path = clickLine3.getPath();

            // 좌표 배열에 클릭한 위치를 추가합니다
            path.push(clickPosition);

            // 다시 선에 좌표 배열을 설정하여 클릭 위치까지 선을 그리도록 설정합니다
            clickLine3.setPath(path);

            var distance = Math.round(clickLine3.getLength());
        }
        
        displayCircleDot(clickPosition, distance);
    }
	}
});
    
	// 지도에 마우스무브 이벤트를 등록합니다
	// 선을 그리고있는 상태에서 마우스무브 이벤트가 발생하면 그려질 선의 위치를 동적으로 보여주도록 합니다
	daum.maps.event.addListener(map, 'mousemove', function (mouseEvent) {

     // 지도 마우스무브 이벤트가 발생했는데 선을 그리고있는 상태이면
    if (drawingFlag){
        if(selectDrone == 1) {
            // 마우스 커서의 현재 위치를 얻어옵니다 
            var mousePosition = mouseEvent.latLng; 

            // 마우스 클릭으로 그려진 선의 좌표 배열을 얻어옵니다
            var path = clickLine1.getPath();

            // 마우스 클릭으로 그려진 마지막 좌표와 마우스 커서 위치의 좌표로 선을 표시합니다
            var movepath = [path[path.length-1], mousePosition];
            moveLine.setPath(movepath);    
            moveLine.setMap(map);

            var distance = Math.round(clickLine1.getLength() + moveLine.getLength()), // 선의 총 거리를 계산합니다
                content = '<div class="dotOverlay distanceInfo">거리 <span class="number">' + distance + '</span>m</div>'; // 커스텀오버레이에 추가될 내용입니다

            // 거리정보를 지도에 표시합니다
            showDistance(content, mousePosition); 
        }
        else if(selectDrone == 2) {
            // 마우스 커서의 현재 위치를 얻어옵니다 
            var mousePosition = mouseEvent.latLng; 

            // 마우스 클릭으로 그려진 선의 좌표 배열을 얻어옵니다
            var path = clickLine2.getPath();

            // 마우스 클릭으로 그려진 마지막 좌표와 마우스 커서 위치의 좌표로 선을 표시합니다
            var movepath = [path[path.length-1], mousePosition];
            moveLine.setPath(movepath);    
            moveLine.setMap(map);

            var distance = Math.round(clickLine2.getLength() + moveLine.getLength()), // 선의 총 거리를 계산합니다
                content = '<div class="dotOverlay distanceInfo">총거리 <span class="number">' + distance + '</span>m</div>'; // 커스텀오버레이에 추가될 내용입니다

            // 거리정보를 지도에 표시합니다
            showDistance(content, mousePosition); 
        }
        else if(selectDrone == 3) {
            // 마우스 커서의 현재 위치를 얻어옵니다 
            var mousePosition = mouseEvent.latLng; 

            // 마우스 클릭으로 그려진 선의 좌표 배열을 얻어옵니다
            var path = clickLine3.getPath();

            // 마우스 클릭으로 그려진 마지막 좌표와 마우스 커서 위치의 좌표로 선을 표시합니다
            var movepath = [path[path.length-1], mousePosition];
            moveLine.setPath(movepath);    
            moveLine.setMap(map);

            var distance = Math.round(clickLine3.getLength() + moveLine.getLength()), // 선의 총 거리를 계산합니다
                content = '<div class="dotOverlay distanceInfo">총거리 <span class="number">' + distance + '</span>m</div>'; // 커스텀오버레이에 추가될 내용입니다

            // 거리정보를 지도에 표시합니다
            showDistance(content, mousePosition); 
        }
          
    }             
});                 

	// 지도에 마우스 오른쪽 클릭 이벤트를 등록합니다
	// 선을 그리고있는 상태에서 마우스 오른쪽 클릭 이벤트가 발생하면 선 그리기를 종료합니다
	daum.maps.event.addListener(map, 'rightclick', function (mouseEvent) 
	{
			
		//받아옴
		
				console.log(lat);
				console.log(lat);
				console.log(lat);
				console.log(lat);
				console.log(lat);
				console.log(lat);
			$.post("http://218.150.181.154:3000/send_gps",
			{
				Latitude: lat,
				Longitude : lng
			},
			function(data, status){
				console.log("위도: " + lat + "\n경도: " + lng);
			});		
	
	
	// 추가
	var latlng = mouseEvent.latLng;
    
    var latitude = latlng.getLat();
	var longitude = latlng.getLng();
    
    $('input[id=latitudetest]').attr('value',latitude);
	$('input[id=longitudetest]').attr('value',longitude);
	
	console.log(latitude+","+longitude);
   
   // 지도 오른쪽 클릭 이벤트가 발생했는데 선을 그리고있는 상태이면
    if (drawingFlag) {
		lat = []; lng = [];
        if(selectDrone == 1) {
            // 마우스무브로 그려진 선은 지도에서 제거합니다
            moveLine.setMap(null);
            moveLine = null;  

            // 마우스 클릭으로 그린 선의 좌표 배열을 얻어옵니다
            var path = clickLine1.getPath();

            // 선을 구성하는 좌표의 개수가 2개 이상이면
            if (path.length > 1) {

                // 마지막 클릭 지점에 대한 거리 정보 커스텀 오버레이를 지웁니다
                if (dots[dots.length-1].distance) {
                    dots[dots.length-1].distance.setMap(null);
                    dots[dots.length-1].distance = null;    
                }

                var distance = Math.round(clickLine1.getLength()), // 선의 총 거리를 계산합니다
                    content = getTimeHTML(distance); // 커스텀오버레이에 추가될 내용입니다

                // 그려진 선의 거리정보를 지도에 표시합니다
                showDistance(content, path[path.length-1]);  

            } else {

                // 선을 구성하는 좌표의 개수가 1개 이하이면 
                // 지도에 표시되고 있는 선과 정보들을 지도에서 제거합니다.
                deleteClickLine();
                deleteCircleDot(); 
                deleteDistnce();

            }

            // 상태를 false로, 그리지 않고 있는 상태로 변경합니다
            drawingFlag = false;
        }
        else if(selectDrone == 2) {
            // 마우스무브로 그려진 선은 지도에서 제거합니다
            moveLine.setMap(null);
            moveLine = null;  

            // 마우스 클릭으로 그린 선의 좌표 배열을 얻어옵니다
            var path = clickLine2.getPath();

            // 선을 구성하는 좌표의 개수가 2개 이상이면
            if (path.length > 1) {

                // 마지막 클릭 지점에 대한 거리 정보 커스텀 오버레이를 지웁니다
                if (dots[dots.length-1].distance) {
                    dots[dots.length-1].distance.setMap(null);
                    dots[dots.length-1].distance = null;    
                }

                var distance = Math.round(clickLine2.getLength()), // 선의 총 거리를 계산합니다
                    content = getTimeHTML(distance); // 커스텀오버레이에 추가될 내용입니다

                // 그려진 선의 거리정보를 지도에 표시합니다
                showDistance(content, path[path.length-1]);  

            } else {

                // 선을 구성하는 좌표의 개수가 1개 이하이면 
                // 지도에 표시되고 있는 선과 정보들을 지도에서 제거합니다.
                deleteClickLine();
                deleteCircleDot(); 
                deleteDistnce();

            }

            // 상태를 false로, 그리지 않고 있는 상태로 변경합니다
            drawingFlag = false;
        }
        else if(selectDrone == 3) {
            // 마우스무브로 그려진 선은 지도에서 제거합니다
            moveLine.setMap(null);
            moveLine = null;  

            // 마우스 클릭으로 그린 선의 좌표 배열을 얻어옵니다
            var path = clickLine3.getPath();

            // 선을 구성하는 좌표의 개수가 2개 이상이면
            if (path.length > 1) {

                // 마지막 클릭 지점에 대한 거리 정보 커스텀 오버레이를 지웁니다
                if (dots[dots.length-1].distance) {
                    dots[dots.length-1].distance.setMap(null);
                    dots[dots.length-1].distance = null;    
                }

                var distance = Math.round(clickLine3.getLength()), // 선의 총 거리를 계산합니다
                    content = getTimeHTML(distance); // 커스텀오버레이에 추가될 내용입니다

                // 그려진 선의 거리정보를 지도에 표시합니다
                showDistance(content, path[path.length-1]);  

            } else {

                // 선을 구성하는 좌표의 개수가 1개 이하이면 
                // 지도에 표시되고 있는 선과 정보들을 지도에서 제거합니다.
                deleteClickLine();
                deleteCircleDot(); 
                deleteDistnce();

            }

            // 상태를 false로, 그리지 않고 있는 상태로 변경합니다
            drawingFlag = false;
        }
                  
    }   
});    

	// 클릭으로 그려진 선을 지도에서 제거하는 함수입니다
	function deleteClickLine() {
		if(selectDrone == 1) {
			if (clickLine1) {
				clickLine1.setMap(null);    
				clickLine1 = null;        
			}
		}
		else if(selectDrone == 2) {
			if (clickLine2) {
				clickLine2.setMap(null);    
				clickLine2 = null;        
			}
		}
		else if(selectDrone == 3) {
			if (clickLine3) {
				clickLine3.setMap(null);    
				clickLine3 = null;        
			}
		}
	}

	// 마우스 드래그로 그려지고 있는 선의 총거리 정보를 표시하거
	// 마우스 오른쪽 클릭으로 선 그리가 종료됐을 때 선의 정보를 표시하는 커스텀 오버레이를 생성하고 지도에 표시하는 함수입니다
	function showDistance(content, position) {
    
    if (distanceOverlay) { // 커스텀오버레이가 생성된 상태이면
        
        // 커스텀 오버레이의 위치와 표시할 내용을 설정합니다
        distanceOverlay.setPosition(position);
        distanceOverlay.setContent(content);
        
    } else { // 커스텀 오버레이가 생성되지 않은 상태이면
        
        // 커스텀 오버레이를 생성하고 지도에 표시합니다
        distanceOverlay = new daum.maps.CustomOverlay({
            map: map, // 커스텀오버레이를 표시할 지도입니다
            content: content,  // 커스텀오버레이에 표시할 내용입니다
            position: position, // 커스텀오버레이를 표시할 위치입니다.
            xAnchor: 0,
            yAnchor: 0,
            zIndex: 3  
        });      
    }
}

	// 그려지고 있는 선의 총거리 정보와 
	// 선 그리가 종료됐을 때 선의 정보를 표시하는 커스텀 오버레이를 삭제하는 함수입니다
	function deleteDistnce () {
		if (distanceOverlay) {
			distanceOverlay.setMap(null);
			distanceOverlay = null;
		}
	}

	// 선이 그려지고 있는 상태일 때 지도를 클릭하면 호출하여 
	// 클릭 지점에 대한 정보 (동그라미와 클릭 지점까지의 총거리)를 표출하는 함수입니다
	function displayCircleDot(position, distance) {

    // 클릭 지점을 표시할 빨간 동그라미 커스텀오버레이를 생성합니다
    var circleOverlay = new daum.maps.CustomOverlay({
        //content: '<span class="dot"></span>',
        position: position,
        zIndex: 1
    });

    // 지도에 표시합니다
    circleOverlay.setMap(map);

    if (distance > 0) {
        cnt++;
        // 클릭한 지점까지의 그려진 선의 총 거리를 표시할 커스텀 오버레이를 생성합니다
        var distanceOverlay = new daum.maps.CustomOverlay({
            //content: '<div class="dotOverlay">' + cnt + '번째 목적지 <span class="number">' + distance + '</span>m</div>',
            position: position,
            yAnchor: 1,
            zIndex: 2
        });

        // 지도에 표시합니다
        distanceOverlay.setMap(map);
    }

    // 배열에 추가합니다
    dots.push({circle:circleOverlay, distance: distanceOverlay});
}

	// 클릭 지점에 대한 정보 (동그라미와 클릭 지점까지의 총거리)를 지도에서 모두 제거하는 함수입니다
	function deleteCircleDot() {
		var i;

		for ( i = 0; i < dots.length; i++ ){
			if (dots[i].circle) { 
				dots[i].circle.setMap(null);
			}

			if (dots[i].distance) {
				dots[i].distance.setMap(null);
			}
		}
		dots = [];
	}

	// 마우스 우클릭 하여 선 그리기가 종료됐을 때 호출하여 
	// 그려진 선의 총거리 정보와 거리에 대한 도보, 자전거 시간을 계산하여
	// HTML Content를 만들어 리턴하는 함수입니다
	function getTimeHTML(distance) {
		var content = '<ul class="dotOverlay distanceInfo">';
	
		if(selectDrone == 1) {
			// 거리 >> HTML Content를 만들어 리턴합니다    
			content += '    <li>';
			content += '        <div class="label2">드론1 순찰경로 :</div><span class="number">' + distance + '</span>m';
			content += '    </li>';
		}
	
		else if(selectDrone == 2) {
			// 거리 >> HTML Content를 만들어 리턴합니다    
			content += '    <li>';
			content += '        <div class="label2">드론2 순찰경로 :</div><span class="number">' + distance + '</span>m';
			content += '    </li>';
		}
	
		else if(selectDrone == 3) {
			// 거리 >> HTML Content를 만들어 리턴합니다    
			content += '    <li>';
			content += '        <div class="label2">드론3 순찰경로 :</div><span class="number">' + distance + '</span>m';
			content += '    </li>';
		}
		content += '</ul>'

		return content;
	}


	
	
<!-- 지도 ON / OFF 관련 함수 -->
function setDragZoom(zoomable, draggable) { 
    var map1Control = document.getElementById('btnSetmap1');
    var map2Control = document.getElementById('btnSetmap2'); 
    if (zoomable === true && draggable === true) {
        map.setZoomable(zoomable); map.setDraggable(draggable);   
        map1Control.className = 'selected_btn2';
        map2Control.className = 'btn2';
    } else {
        map.setZoomable(false); map.setDraggable(false);
        map2Control.className = 'selected_btn2';
        map1Control.className = 'btn2';
    }
}






	// 명령 테스트용  명령 테스트용  명령 테스트용  명령 테스트용
	$(document).ready(function() {
		$(".btn_command").click(function(){
			//alert("Test");
			send_command($(this).data("command"));
		});
		
		function send_command(control){  //받아옴
			$.post("http://218.150.181.154:3000/receive_command",
			{
				command: control
			
			},
			function(data, status){
				console.log("Data: " + data + "\nStatus: " + status);
			});		
		}
	
		$("#cmd_btn").click(function(){
			$.post("http://218.150.181.154:3000/flight_command",
			{
				throttle: $("#throttle").val(),
				pitch: $("#pitch").val(),
				yaw: $("#yaw").val(),
				roll: $("#roll").val()
			},
			function(data, status){
				console.log("Data: " + data + "\nStatus: " + status);
			});
		})
	});

/* 이거 사용할거임     이거 사용할거임      이거 사용할거임
$(document).ready(function() {
	$(".btn_command").click(function(){
		if(selectDrone != 0) {
			if(lat.length == 0 || lng.length == 0) {
				alert("경로가 없습니다. 경로를 먼저 입력하세요.");
			}
			else {
				send_command(lat, lng, $(this).data("command"));
			//alert($(this).text());
			}
		}
		else {
			alert("드론이 선택되지 않았습니다");
		}
	});
		
	
	function send_command(lati, lngi, control){  //받아옴
		$.post("http://192.168.0.110:3000/receive_command",
		{
			latitude: lati,
			longitude: lngi,
			command: control
			
		},
	function(data, status){
		console.log("Data: " + data + "\nStatus: " + status);
	});
			
			
	}
});
*/






  //드론 충돌 방지 시작 
  
  //droneLat1~3 droneLng1~3
  //새로운 2번의 드론좌표
  var newDroneLat1;
  var newDroneLng1;
  // 새로운 3번의 드론좌표
  var newDroneLat2;
  var newDroneLng2;
  $(document).ready(function() 
  {  
	setInterval( function(){ preventCollision(); } , 5000 );
  });
  

	  
  function preventCollision()
  {
	  console.log("드론 충돌 관련 내용은 preventCollision 함수의 alert 주석을 삭제하세요.");
	if(droneCount == 2) {
		twoDrone();
	}
	
	else if(droneCount == 3) {
		threeDrone();
	}
	 
  }
  
  function twoDrone()
  {
	var onDrone = [0,0];
	var distanceLat = 0;
	var distanceLng = 0;
	var distance = 0;
	
	var j=0;
	for(var i=0; i<3; i++) {
		if(arrDroneFlag[i] == true) {
			onDrone[j] = i;
			j++;
		}
	}
	
	var oa = arrDroneLat[onDrone[1]];
	var ob = arrDroneLng[onDrone[1]];
	
	distanceLat = 69.1 * (arrDroneLat[onDrone[1]] - arrDroneLat[onDrone[0]]);
	distanceLng = 56 * (arrDroneLng[onDrone[1]] - arrDroneLng[onDrone[0]]);
	
	distance = Math.sqrt(Math.pow(distanceLat,2)+Math.pow(distanceLng,2));
	//console.log("처음 두 드론 사이의 거리    " + distance);
	// 원래 while(distance < 0.03)
	// 아래는 보여주기용
	while(distance < 0.1) {		
		arrDroneLat[onDrone[1]] = Number(arrDroneLat[onDrone[1]]) + 0.0000144;
		arrDroneLng[onDrone[1]] = Number(arrDroneLng[onDrone[1]]) + 0.0000188;
		
		distanceLat = 69.1 * (arrDroneLat[onDrone[1]] - arrDroneLat[onDrone[0]]);
		distanceLng = 56 * (arrDroneLng[onDrone[1]] - arrDroneLng[onDrone[0]]);
		
		distance = Math.sqrt(Math.pow(distanceLat,2)+Math.pow(distanceLng,2));
	}
	
	if(oa!=arrDroneLat[onDrone[1]] && ob!=arrDroneLng[onDrone[1]]) {
		newDroneLat1 = arrDroneLat[onDrone[1]];
		newDroneLng1 = arrDroneLng[onDrone[1]];
		
		//alert((onDrone[1]+1) + "번 드론의 새로운 좌표  " + newDroneLat1 + ", " + newDroneLng1);
	}
	else {
		//alert("드론 " + (onDrone[0]+1) +"번과 " + (onDrone[1]+1) +"번은 충돌 가능 없음");
	}
	
  }
  
  
  function threeDrone()
  {
	//alert("드론 1번의 위치 " + arrDroneLat[0] + ",  " + arrDroneLng[0]);
	var distanceLat = 0;
	var distanceLng = 0;
	var distance = 0;

	var oa = arrDroneLat[1];
	var ob = arrDroneLng[1];
	var oaa = arrDroneLng[2];
	var obb = arrDroneLng[2];
	
	<!-- 1번 드론과 2번 드론 계산 -->
	
	distanceLat = 69.1 * (arrDroneLat[1] - arrDroneLat[0]);
	distanceLng = 56 * (arrDroneLng[1] - arrDroneLng[0]);
	
	distance = Math.sqrt(Math.pow(distanceLat,2)+Math.pow(distanceLng,2));
	//console.log("처음 두 드론 사이의 거리    " + distance);
	// 원래 while(distance < 0.03)
	// 아래는 보여주기용
	while(distance < 0.1) {		
		arrDroneLat[1] = Number(arrDroneLat[1]) + 0.0000144;
		arrDroneLng[1] = Number(arrDroneLng[1]) + 0.0000188;
		
		distanceLat = 69.1 * (arrDroneLat[1] - arrDroneLat[0]);
		distanceLng = 56 * (arrDroneLng[1] - arrDroneLng[0]);
		
		distance = Math.sqrt(Math.pow(distanceLat,2)+Math.pow(distanceLng,2));
	}
	
	if(oa!=arrDroneLat[1] && ob!=arrDroneLng[1]) {
		newDroneLat1 = arrDroneLat[1];
		newDroneLng1 = arrDroneLng[1];
		
		//alert("드론 2번의 새로운 좌표  " + newDroneLat1 + ", " + newDroneLng1);
	}
	else {
		//alert("드론 1번과 2번은 충돌 가능성 없음");
	}
	
	<!-- 1번 드론과 2번 드론 계산 후 2번 드론의 새로운 좌표 생성 종료 -->
	
	<!-- 3번 드론과 1번 드론 그리고 2번 드론의 각각 길이 계산 -->
	var disLat1 = 69.1 * (arrDroneLat[2] - arrDroneLat[0]);
	var disLng1 = 69.1 * (arrDroneLat[2] - arrDroneLat[0]);
	var disLat2 = 69.1 * (arrDroneLat[2] - arrDroneLat[1]);
	var disLng2 = 69.1 * (arrDroneLat[2] - arrDroneLat[1]);
	
	var dis1 = Math.sqrt(Math.pow(disLat1,2)+Math.pow(disLng1,2));
	var dis2 = Math.sqrt(Math.pow(disLat2,2)+Math.pow(disLng2,2));
	
	while(dis1 < 0.1 || dis2 < 0.1) {
		arrDroneLat[2] = Number(arrDroneLat[2]) + 0.0000144;
		arrDroneLng[2] = Number(arrDroneLng[2]) + 0.0000188;
		
		disLat1 = 69.1 * (arrDroneLat[2] - arrDroneLat[0]);
		disLng1 = 56 * (arrDroneLng[2] - arrDroneLng[0]);
		disLat2 = 69.1 * (arrDroneLat[2] - arrDroneLat[1]);
		disLng2 = 56 * (arrDroneLng[2] - arrDroneLng[1]);
		
		var dis1 = Math.sqrt(Math.pow(disLat1,2)+Math.pow(disLng1,2));
		var dis2 = Math.sqrt(Math.pow(disLat2,2)+Math.pow(disLng2,2));
	}
	
	if(oaa!=arrDroneLat[2] && obb!=arrDroneLng[2]) {
		newDroneLat2 = arrDroneLat[2];
		newDroneLng2 = arrDroneLng[2];
		//alert("드론 3번의 새로운 좌표  " + newDroneLat2 + ", " + newDroneLng2);
	}
	else {
		//alert("드론 1번, 2번, 3번은 충돌 가능성 없음");
	}
	
  }
  
  
  // 드론 충돌 방지 끝

  
  //우진 추가
   var newpath1 =[];
   
   var newpath2 =[];
   
   var newpath3 =[];
   
   var polyline1;
   var polyline2;
   var polyline3;
   //1번
  function drawLine1()
  {
		if(polyline1) {
			delLine1();
		}
		else {
			for (i=0; i < checkflag.length; i++)
			{
				
				if ( checkflag[i] == 0 )
				{
					
					//평소
					continue;
				}
						
				else if ( checkflag[i] == 1 )
				{
					newpath1.push( new daum.maps.LatLng(droneLat1, droneLng1 ));
					newpath1.push( new daum.maps.LatLng(circleLat[i], circleLng[i] ));
					//주의
				}
				
				else if ( checkflag[i] == 2 )
				{
					
					//화재
					newpath1.push( new daum.maps.LatLng(droneLat1, droneLng1 ));
					newpath1.push( new daum.maps.LatLng(circleLat[i], circleLng[i] ));
				}
				
				//console.log("1");
			}
			
			
			polyline1 = new daum.maps.Polyline({
				map: map,
				path: [newpath1],
				strokeWeight: 3,
				strokeColor: '#db4040',
				strokeOpacity: 0.8,
				strokeStyle: 'dot'
			});
			
			
			
			polyline1.setPath(newpath1);
			
			polyline1.setMap(map);
		}
  }
  
  function delLine1()
  {
	  if(polyline1) {
		  polyline1.setMap(null);
		  polyline1 = null;
		  newpath1 = [];
	  }
  }
  
  
  //2번
    function drawLine2()
  {
		if(polyline2) {
			delLine2();
		}
		else {
	  
			for (i=0; i < checkflag.length; i++)
			{
				
				if ( checkflag[i] == 0 )
				{
					
					//평소
					continue;
				}
						
				else if ( checkflag[i] == 1 )
				{
					newpath2.push( new daum.maps.LatLng(droneLat2, droneLng2 ));
					newpath2.push( new daum.maps.LatLng(circleLat[i], circleLng[i] ));
					//주의
				}
				
				else if ( checkflag[i] == 2 )
				{
					
					//화재
					newpath2.push( new daum.maps.LatLng(droneLat2, droneLng2 ));
					newpath2.push( new daum.maps.LatLng(circleLat[i], circleLng[i] ));
				}
				
				
			}
			
			
			polyline2 = new daum.maps.Polyline({
				map: map,
				path: [
					newpath2
				],
				strokeWeight: 3,
				strokeColor: '#0100FF',
				strokeOpacity: 0.8,
				strokeStyle: 'dot'
			});
			
			
			
			polyline2.setPath(newpath2);
			
			polyline2.setMap(map);
		}
  }
  
  function delLine2()
  {
	  if(polyline2) {
		  polyline2.setMap(null);
		  polyline2 = null;
		  newpath2 = [];
	  }
  }

   //3번
   
    function drawLine3()
  {
		if(polyline3) {
				delLine3();
			}
		else {
	  
			for (i=0; i < checkflag.length; i++)
			{
				
				if ( checkflag[i] == 0 )
				{
					
					//평소
					continue;
				}
						
				else if ( checkflag[i] == 1 )
				{
					newpath3.push( new daum.maps.LatLng(droneLat3, droneLng3 ));
					newpath3.push( new daum.maps.LatLng(circleLat[i], circleLng[i] ));
					//주의
				}
				
				else if ( checkflag[i] == 2 )
				{
					
					//화재
					newpath3.push( new daum.maps.LatLng(droneLat3, droneLng3 ));
					newpath3.push( new daum.maps.LatLng(circleLat[i], circleLng[i] ));
				}
				
				
			}
			
			
			polyline3 = new daum.maps.Polyline({
				map: map,
				path: [
					newpath3
				],
				strokeWeight: 3,
				strokeColor: '#47C83E',
				strokeOpacity: 0.8,
				strokeStyle: 'dot'
			});
			
			
			
			polyline3.setPath(newpath3);
			
			polyline3.setMap(map);
		}
  }
  
  function delLine3()
  {
	  if(polyline3) {
		  polyline3.setMap(null);
		  polyline3 = null;
		  newpath3 = [];
	  }
  }
  
  
  <!-- 드론 움직이면 폴리라인 생성 해주기-->
  <!-- 형 실험 끝나면 없애거나 따로 처리를 해주거나 해야됨 -->
  var tracePath = [];
  var tracePolyline;
  function traceLine() {
	  
	tracePath.push(new daum.maps.LatLng(droneLat1, droneLng1));
	  
	tracePolyline = new daum.maps.Polyline({
		map: map,
		path: [
			tracePath
		],
		strokeWeight: 3,
		strokeColor: '#000000',
		strokeOpacity: 0.8,
		strokeStyle: 'dot'
	});
	
	tracePolyline.setPath(tracePath);
			
	tracePolyline.setMap(map);
  }
  
  function delTraceLine()
  {
	  if(tracePolyline) {
		  tracePolyline.setMap(null);
		  tracePolyline = null;
		  //tracePath = [];
	  }
	  
  }
  
  
</script>