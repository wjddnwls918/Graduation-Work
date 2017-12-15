<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=cddcd2e91c1e74e228286a8b06ded53e"></script>

<script>
var checkflag = [0,0,0,0,0,0];
var lineCircle = ['#CFE7FF', '#CFE7FF', '#CFE7FF', '#CFE7FF', '#CFE7FF', '#CFE7FF'];

<!-- 화재 감지와 관련된 변수들 -->
var tempcons=0.083;
var co2cons= 0.01;

var deltempcons = 4.16;
var delco2cons =0.24;

var realHmd = 0.536;

var warningPnt = ((30* tempcons * deltempcons) 
			+ (410* co2cons * delco2cons) ) * realHmd;

var firePnt = ((40* tempcons * deltempcons) 
			+ (5000* co2cons * delco2cons) ) * realHmd;
<!-- 화재 감지 변수 끝 -->



$('.btnsimul').click(function()
{
	window.open("/simul_controller/pop", "btnsimul", "width=200, height=400, toolbar=no, menubar=no, scrollbars=no, resizable=yes")
	
});

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




<!-- 지도 생성 및 속성 설정 -->

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

<!-- 지도 생성 및 속성 설정 종료 -->

<!-- 학교 반경 표시 -->
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

<!-- 학교 반경 표시 끝 -->

<!-- 로컬 센서 위치 표시 -->
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
<!-- 로컬 센서 위치 표시 끝 -->	




/*

		$.ajax({
			url : "/info/get_info_json/<?=$drone_idx?>",
			dataType : "json",
			success : function(data) {
				update_elements(data);  //업데
				updateFlotData(data);
				console.log(data);
			}
			
		});







*/

	var idtest=0;
	var idtest2=0;
	//var temp = 0;
	//var hmd = 0;
	//var co2 = 0;
	
	$('.btn_command').click(function()
	{
		idtest = $(this).data("command") ;
		transSimul($(this).data("command"));
	});
	
	function transSimul(id,temp,hmd,co2,vib, water)
	{
		//console.log(id);
	
	
		console.log(id+" "+temp +" "+hmd+ " " + co2);
		$.ajax({
			url : "/Simul_controller/insertSimul/"+id+"/"+temp+"/"+hmd+"/"+co2+"/"+vib+"/"+water,
			dataType : "json",
			success : function(data) {
				console("insert completed");
			}
			
		});
		
	}
	
	function transDroneinfo(id,lat,lng)
	{
		console.log(id+" "+lat +" "+lng);
		
		$.ajax({
			url : "/Simul_controller/insertDronesimul/"+id+"/"+lat+"/"+lng,
			dataType : "json",
			success : function(data) {
				console("insert completed");
			}
			
		});
		
	}
	
	$('#localinfo').click(function()
	{ 
		idtest = $('.selecter option:selected').val();
		//idtest = $('dropdown-toggle option : selected').text();
		transSimul(idtest,$('#Temperature').val(),$('#Humidity').val(),$('#Co2').val(),$('#Vibration').val(),$('#Waterlevel').val() );
	});
	
	$('#latlng').click(function()
	{ 
		console.log("Tests!!!!!");
		idtest2 = $('.selecter2 option:selected').val();
		transDroneinfo(idtest2,$('#Latitude').val(),$('#Longitude').val());
		//idtest = $('.selecter option:selected').val();
		//idtest = $('dropdown-toggle option : selected').text();
		//transSimul(idtest,$('#Temperature').val(),$('#Humidity').val(),$('#Co2').val() );
	});
	
	
	
	
	
	
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

var lat = [];
var lng = [];
$(function ()
{
	
	daum.maps.event.addListener(map, 'click', function(mouseEvent) {        
	
	
		// 클릭한 위도, 경도 정보를 가져옵니다 
		var latlng = mouseEvent.latLng;
		
		var message = '클릭한 위치의 위도는 ' + latlng.getLat() + typeof(latlng.getLat())+ ' 이고, ';
		message += '경도는 ' + latlng.getLng() + ' 입니다';
		
		//lat.push(latlng.getLat());
		//lng.push(latlng.getLng());
		console.log(message);
		//console.log("선택된 위도의 배열 - " + lat);
		//console.log("선택된 경도의 배열 - " + lng);
	
	
	$('#Latitude').val(Number(latlng.getLat()));
	$('#Longitude').val(Number(latlng.getLng()));
	//var testlatitude = document.getElementById("Latitude");
	//var testlongitude =  document.getElementById("Longitude");	
	
	//testlatitude.innerHTML = Number(latlng.getLat());
	//testlongitude.innerHTML = Number(latlng.getLng());
});
	
	
});




	<!-- 드론 충돌 방지 -->
  
  //droneLat1~3 droneLng1~3
  //새로운 2번의 드론좌표
  var newDroneLat1;
  var newDroneLng1;
  // 새로운 3번의 드론좌표
  var newDroneLat2;
  var newDroneLng2;
  
  $('#collision').click(function() 
  {
	preventCollision();
  });
    
  function preventCollision()
  {
	//alert("드론 1번의 위치 " + arrDroneLat[0] + ",  " + arrDroneLng[0]);
	var distanceLat = 0;
	var distanceLng = 0;
	var distance = 0;

	var oa = arrDroneLat[1];
	var ob = arrDroneLng[1];
	var oaa = arrDroneLng[2];
	var obb = arrDroneLng[2];
	
	var dis1;
	var dis2;
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
		
		alert("드론 2번의 새로운 좌표  " + newDroneLat1 + ", " + newDroneLng1);
	}
	else {
		alert("드론 1번과 2번은 충돌 가능성 없음");
	}
	
	<!-- 1번 드론과 2번 드론 계산 후 2번 드론의 새로운 좌표 생성 종료 -->
	
	<!-- 3번 드론과 1번 드론 그리고 2번 드론의 각각 길이 계산 -->
	var disLat1 = 69.1 * (arrDroneLat[2] - arrDroneLat[0]);
	var disLng1 = 69.1 * (arrDroneLat[2] - arrDroneLat[0]);
	var disLat2 = 69.1 * (arrDroneLat[2] - arrDroneLat[1]);
	var disLng2 = 69.1 * (arrDroneLat[2] - arrDroneLat[1]);
	
	dis1 = Math.sqrt(Math.pow(disLat1,2)+Math.pow(disLng1,2));
	dis2 = Math.sqrt(Math.pow(disLat2,2)+Math.pow(disLng2,2));
	//console.log("(1)3번과 1번 2번 계산: " + dis1 + "   " + dis2);
	
	while(dis1 < 0.1 || dis2 < 0.1) {
		arrDroneLat[2] = Number(arrDroneLat[2]) + 0.0000144;
		arrDroneLng[2] = Number(arrDroneLng[2]) + 0.0000188;
		
		disLat1 = 69.1 * (arrDroneLat[2] - arrDroneLat[0]);
		disLng1 = 56 * (arrDroneLng[2] - arrDroneLng[0]);
		disLat2 = 69.1 * (arrDroneLat[2] - arrDroneLat[1]);
		disLng2 = 56 * (arrDroneLng[2] - arrDroneLng[1]);
		
		dis1 = Math.sqrt(Math.pow(disLat1,2)+Math.pow(disLng1,2));
		dis2 = Math.sqrt(Math.pow(disLat2,2)+Math.pow(disLng2,2));
		//console.log("(1)3번과 1번 2번 계산: " + dis1 + "   " + dis2);
	}
	
	if(oaa!=arrDroneLat[2] && obb!=arrDroneLng[2]) {
		newDroneLat2 = arrDroneLat[2];
		newDroneLng2 = arrDroneLng[2];
		alert("드론 3번의 새로운 좌표  " + newDroneLat2 + ", " + newDroneLng2);
	}
	else {
		alert("드론 1번, 2번, 3번은 충돌 가능성 없음");
	}
	
  }
  
  
  <!-- 드론 충돌 방지 끝 -->


  <!-- rssi data 받아오기 -->
  $(document).ready(function () {
	  function getRSSI1(){  //받아옴
		$.ajax({
			url : "/Simul_controller/rssi/7",
			dataType : "json",
			success : function(data) {
				//console.log(data);
				document.getElementById("rssi1").innerHTML = data['rssi'];
			}
				
		});
		$.ajax({
			url : "/Simul_controller/rssi/8",
			dataType : "json",
			success : function(data) {
				//console.log(data);
				document.getElementById("rssi2").innerHTML = data['rssi'];
			}
				
		});
	  }
	  setInterval( function () { getRSSI1();  },2000);
	});
  <!-- rssi data 받아오기 끝 -->
  
  
  
  
</script>