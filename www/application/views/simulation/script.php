<script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=61f79651c17b7db52c47db93b62de00d"></script>

<script> 
	var localNum=100;
	var listenMarker;
	var checkFireIcon = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var checkFlagIcon = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var checkButton;

	var resetT = [30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30];
	var resetH = [60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60];
	var resetC = [380,380,380,380,380,380,380,380,380,380,380,380,380,380,380,380];
	var usualT = [30,31,34,33,32,32,33,31,32,30,32,33,31,32,30,31];
	var usualH = [62,64,61,62,61,63,60,64,63,64,61,62,65,61,62,61];
	var usualC = [381,382,378,377,383,380,382,379,381,374,382,370,372,371,380,381];
	var fireT = [31,32,35,34,31,38,103,32,33,48,33,34,32,33,31,32];
	var fireH = [63,65,62,61,60,62,20,63,64,51,62,63,64,62,61,62];
	var fireC = [372,399,387,373,380,1325,7223,401,378,3201,1050,2489,381,387,379,393];
	var flagNotT1 = [31,32,53,31,32,35,34,31,32,33,32,33,34,35,34,32];
	var flagNotH1 = [44,38,35,47,39,41,42,38,44,41,36,35,36,40,37,39];
	var flagNotC1 = [1280,1781,3274,372,2199,1887,1973,380,372,978,379,370,388,391,372,369];
	var flagNotT2 = [32,33,38,31,32,34,34,30,33,34,31,34,35,34,32,33];
	var flagNotH2 = [44,39,38,48,40,40,41,39,43,40,35,36,37,39,38,38];
	var flagNotC2 = [1080,1501,2689,373,1720,1279,1644,381,371,877,380,371,387,390,371,365];
	var flagFireT1 = [32,33,31,32,30,53,31,30,31,34,33,32,33,31,32,30];
	var flagFireH1 = [61,62,65,61,62,40,61,62,64,61,62,61,60,64,63,64];
	var flagFireC1 = [1382,2370,372,371,2380,3274,381,381,382,378,377,383,382,379,381,374];
	var flagFireT2 = [32,48,30,33,47,105,31,30,30,33,33,32,33,32,32,30];
	var flagFireH2 = [62,60,65,63,60,5,62,62,63,62,62,62,61,63,63,62];
	var flagFireC2 = [3381,4207,371,378,4332,6680,382,382,381,379,378,384,381,380,380,378];

	var resetBattery = [100,100,100,100,100,100,100,100,100];
	var resetCondition = ['대기','대기','대기','대기','대기','대기','대기','대기','대기'];
	var resetDistance = [0,0,0,0,0,0,0,0,0];
	var droneBattery1 = [100,100,100,100,2,95,100,10,75];
	var droneCondition1 = ['대기','대기','대기','대기','고장/수리','대기','대기','고장/수리','임무중'];
	var droneDistance1 = ['·','·','·','·','·','·','·','·','·'];
	var droneBattery2 = [100,100,100,100,100,80,95,75,100];
	var droneCondition2 = ['대기','대기','대기','대기','대기','대기','대기','대기','대기'];
	var droneDistance2 = [430,430,430,558,558,558,139,139,139];
	var droneBattery3 = [100,100,45,100,100,95,15,100,100];
	var droneCondition3 = ['대기','대기','임무중','대기','대기','대기','고장/수리','대기','대기'];
	var droneDistance3 = [425,425,192,382,382,382,378,378,378];
	var droneBattery4 = [100,100,100,90,100,80,100,70,40];
	var droneCondition4 = ['대기','대기','대기','대기','임무중','대기','대기','대기','대기'];
	var droneDistance4 = [386,386,386,367,298,337,304,304,304];

	var checkstate =[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var checkflag=[false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false];

	var lastTemp = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var lastHmd = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var lastCO2 = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

	var curT;
	var curH;
	var curC;

	curT = resetT;
	curH = resetH;
	curC = resetC;


	//값들 설정 
	var warningFlag = false;
	var warnTemp=20,warnHmd=20,warnCO2=600;
	var alrmTemp=50,alrmHmd=35,alrmCO2=3000;
	var realTemp=100,realHmd=30,realCO2=5000;

	function firecheck(curT,curH,curC)
	{
		var deltaTemp,deltaHmd,deltaCO2;

		for(var i=0; i<curT.length; i++)
		{
			//real con
			if( (curT[i] >= realTemp) && (curH[i] <= realHmd) && (curC[i] >= realCO2) && checkflag[i] == false )
			{
				checkFireIcon[i] = 1;
				alert("화재발생 로컬 번호 : "+ (i+1) );
				continue;
			}
		
			if( checkflag[i] == false)
			{
				deltaTemp = curT[i]-resetT[i];
				deltaHmd = resetH[i]-curH[i];
				deltaCO2 = curC[i] - resetC[i];
				if( deltaTemp >= warnTemp && deltaHmd >= warnHmd && deltaCO2 >= warnCO2)
				{
					checkflag[i] = true;
					checkFlagIcon[i] = 1;
					
					lastTemp[i] = curT[i];
					lastHmd[i] = curH[i];
					lastCO2[i] = curC[i];
					alert("화재 flag 발생 : "+ (i+1) );

					continue;
				}
				else{
					checkflag[i] = false;
				}	
			}
			
			else if (checkflag[i] == true)
			{
				deltaTemp = curT[i] - lastTemp[i];
				deltaHmd = lastHmd[i] - curH[i];
				deltaCO2 = curC[i] - lastCO2[i];
				
				if( (deltaTemp >= alrmTemp) && (deltaHmd >= alrmHmd) && (deltaCO2 >= alrmCO2) )
				{
					checkFireIcon[i] = 1;
					alert("화재의심 로컬 번호 : "+ (i+1));
				}
				
				else{
					checkflag[i] = false;
					alert("화재가 아니었음 : "+ (i+1) );
				}
			}
		}
	}

	$(document).ready(function() 
	{	
		$(".btn.btn-link").click(function(){
			selectLocal($(this).parent().index()-1);
		});	
		
		$(".btn.btn-default.reset").click(function() {
			showLocalTable(resetT, resetH, resetC);
			showDroneTable(resetBattery, resetCondition, resetDistance);
			checkFireIcon = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
			checkFlagIcon = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
			checkFlag = [false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false];
			localNum = 100;
			checkButton = 0;
			curT = resetT;
			curH = resetH;
			curC = resetC;
			
			firecheck(curT,curH,curC);
			drawtest(resetCondition);
		});
		
		$(".btn.btn-default.usual").click(function() {
			showLocalTable(usualT, usualH, usualC);
			showDroneTable(droneBattery1, droneCondition1, droneDistance1);
			checkButton = 1;
			curT = usualT;
			curH = usualH;
			curC = usualC;
			
			firecheck(curT,curH,curC);
			drawtest(droneCondition1);
		});
		
		$(".btn.btn-default.fire").click(function() {
			showLocalTable(fireT, fireH, fireC);
			showDroneTable(droneBattery2, droneCondition2, droneDistance2);
			checkButton = 2;
			curT = fireT;
			curH = fireH;
			curC = fireC;
			
			firecheck(curT,curH,curC);
			drawtest(droneCondition2);
		});
		
		$(".btn.btn-default.flagNot1").click(function() {
			showLocalTable(flagNotT1, flagNotH1, flagNotC1);
			showDroneTable(droneBattery3, droneCondition3, droneDistance3);
			checkButton = 3;
			curT = flagNotT1;
			curH = flagNotH1;
			curC = flagNotC1;
			
			firecheck(curT,curH,curC);
			drawtest(droneCondition3);
		});
		
		$(".btn.btn-default.flagNot2").click(function() {
			showLocalTable(flagNotT2, flagNotH2, flagNotC2);
			showDroneTable(droneBattery3, droneCondition3, resetDistance);
			checkButton = 3;
			curT = flagNotT2;
			curH = flagNotH2;
			curC = flagNotC2;
			
			firecheck(curT,curH,curC);
			drawtest(droneCondition3);
		});
		
		$(".btn.btn-default.flagFire1").click(function() {
			showLocalTable(flagFireT1, flagFireH1, flagFireC1);
			showDroneTable(droneBattery4, droneCondition4, droneDistance4);
			checkButton = 4;
			curT = flagFireT1;
			curH = flagFireH1;
			curC = flagFireC1;
			
			firecheck(curT,curH,curC);
			drawtest(droneCondition4);
		});
		
		$(".btn.btn-default.flagFire2").click(function() {
			showLocalTable(flagFireT2, flagFireH2, flagFireC2);
			showDroneTable(droneBattery4, droneCondition4, droneDistance4);
			checkButton = 4;
			curT = flagFireT2;
			curH = flagFireH2;
			curC = flagFireC2;
			
			firecheck(curT,curH,curC);
			drawtest(droneCondition4);
		});
	});

	function selectLocal(param) {
		localNum = param;
		drawtest();
	}

	function showLocalTable(tt, hh, cc) {	
		var tmp = ""; var hmd = ""; var co2 = "";
		tmp += "<td><strong>온도(℃)</strong></td>";
		hmd += "<td><strong>습도(%)</strong></td>";
		co2 += "<td><strong>이산화탄소(ppm)</strong></td>";
		
		for(var i=0; i<tt.length; i++) {
			tmp += "<td>";
			tmp += tt[i];
			tmp += "</td>";
		}
		
		for(var i=0; i<hh.length; i++) {
			hmd += "<td>";
			hmd += hh[i];
			hmd += "</td>";
		}
		
		for(var i=0; i<cc.length; i++) {
			co2 += "<td>";
			co2 += cc[i];
			co2 += "</td>"
		}
		document.getElementById("tableTemp").innerHTML = tmp;
		document.getElementById("tableHmd").innerHTML = hmd;
		document.getElementById("tableCO2").innerHTML = co2;
	}

	function showDroneTable(bb, cc, dd) {
		var btr = ""; var cdt = ""; var dst = "";
		btr += "<td><strong>배터리(%)</strong></td>";
		cdt += "<td><strong>상태</strong></td>";
		dst += "<td><strong>거리(m)</strong></td>";
		
		for(var i=0; i<bb.length; i++) {
			btr += "<td>";
			btr += bb[i];
			btr += "</td>";
		}
		
		for(var i=0; i<cc.length; i++) {
			cdt += "<td>";
			cdt += cc[i];
			cdt += "</td>";
		}
		
		for(var i=0; i<dd.length; i++) {
			dst += "<td>";
			dst += dd[i];
			dst += "</td>"
		}
		
		document.getElementById("tableBattery").innerHTML = btr;
		document.getElementById("tableCondition").innerHTML = cdt;
		document.getElementById("tableDistance").innerHTML = dst;
	}
	
	
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

	
	// 학교영역분할을 하는 좌표 배열에
	var linePath1 = [
		new daum.maps.LatLng(36.76527237543727, 127.27845426402638),
		new daum.maps.LatLng(36.76028435828802, 127.28242321276461)
	];
	var linePath2 = [
		new daum.maps.LatLng(36.76527237543727, 127.27845426402638),
		new daum.maps.LatLng(36.76782041678214, 127.28316767855429)
	];
	var linePath3 = [
		new daum.maps.LatLng(36.76782041678214, 127.28316767855429),
		new daum.maps.LatLng(36.76389834342341, 127.28598123516826)
	];    
	var linePath4 = [
		new daum.maps.LatLng(36.76389834342341, 127.28598123516826),
		new daum.maps.LatLng(36.75910302798499, 127.27704325973744)
	];    
	var linePath5 = [
		new daum.maps.LatLng(36.75910302798499, 127.27704325973744),
		new daum.maps.LatLng(36.760331215664856, 127.27589413952695)
	];   
	var linePath6 = [
		new daum.maps.LatLng(36.760331215664856, 127.27589413952695),
		new daum.maps.LatLng(36.765247829721766, 127.28501463699452)
	];     
	var linePath7 = [
		new daum.maps.LatLng(36.763999516365544, 127.27942965554885),
		new daum.maps.LatLng(36.76658376466493, 127.28405915539871)
	];     
	var linePath8 = [
		new daum.maps.LatLng(36.76696816651627,127.28156289403864),
		new daum.maps.LatLng(36.76175892679653, 127.28567650251325)
	];     
	var linePath9 = [
		new daum.maps.LatLng(36.76175892679653, 127.28567650251325),
		new daum.maps.LatLng(36.7589258974051, 127.27957363898805)
	];     
	var linePath10 = [
		new daum.maps.LatLng(36.7589258974051, 127.27957363898805),
		new daum.maps.LatLng(36.76131813550929, 127.27774559769857)
	];       
	var linePath11 = [
		new daum.maps.LatLng(36.766061880608, 127.27993554816587),
		new daum.maps.LatLng(36.76093376904408, 127.28406071751542)
	];       
	var linePath12 = [
		new daum.maps.LatLng(36.76203579825668, 127.27912574109743),
		new daum.maps.LatLng(36.759517199082964, 127.28103169039085)
	]; 


	// 지도에 폴리곤으로 표시할 영역데이터 배열입니다 
	var areas = [
		{
			name : 'Station 1',
			path : [
				new daum.maps.LatLng(36.761474, 127.279762),
				new daum.maps.LatLng(36.761141, 127.280198),
				new daum.maps.LatLng(36.761036, 127.280068),
				new daum.maps.LatLng(36.761400, 127.279631)
			]
		}, {
			name : 'Station 2',
			path : [
			   new daum.maps.LatLng(36.766478, 127.281022),
			   new daum.maps.LatLng(36.766929, 127.281644),
			   new daum.maps.LatLng(36.766800, 127.281786),
			   new daum.maps.LatLng(36.766338, 127.281183)
			   
			]
		}, {
			name : 'Station 3',
			path : [
				new daum.maps.LatLng(36.761282, 127.284486),
				new daum.maps.LatLng(36.761300, 127.284965),
				new daum.maps.LatLng(36.761071, 127.284949),
				new daum.maps.LatLng(36.761047, 127.284536)
			]
		}
	];


	// 마커를 표시할 위치와 title 객체 배열입니다 
	var positions = [
		{
			title: 'local1', 
			latlng: new daum.maps.LatLng(36.76678491663423, 127.28283906154353)
		},
		{
			title: 'local2', 
			latlng: new daum.maps.LatLng(36.76543085574562, 127.283842100572)
		},
		{
			title: 'local3', 
			latlng: new daum.maps.LatLng(36.7641578322533, 127.28486780405947)
		},
		{
			title: 'local4',
			latlng: new daum.maps.LatLng(36.76589640556859, 127.28132377149113)
		},
		{
			title: 'local5', 
			latlng: new daum.maps.LatLng(36.76462377567695, 127.28219272405815)
		},
		{
			title: 'local6', 
			latlng: new daum.maps.LatLng(36.76331469520693, 127.28322951142893)
		},
		{
			title: 'local7', 
			latlng: new daum.maps.LatLng(36.76207753359792, 127.28433372695929)
		},
		{
			title: 'local8',
			latlng: new daum.maps.LatLng(36.76503503982769, 127.27975261465973)
		},
		{
			title: 'local9', 
			latlng: new daum.maps.LatLng(36.76378028479611, 127.28068884807706)
		},
		{
			title: 'local10', 
			latlng: new daum.maps.LatLng(36.76252515103341, 127.28178184565066)
		},
		{
			title: 'local11', 
			latlng: new daum.maps.LatLng(36.76124331993332, 127.28272911587078)
		},
		{
			title: 'local12',
			latlng: new daum.maps.LatLng(36.76163649354278, 127.2803226492568)
		},
		{
			title: 'local13', 
			latlng: new daum.maps.LatLng(36.76051695265567, 127.2812369273003)
		},
		{
			title: 'local14', 
			latlng: new daum.maps.LatLng(36.760972963638004, 127.27892029898618)
		},
		{
			title: 'local15', 
			latlng: new daum.maps.LatLng(36.759790408455316, 127.27981196209412)
		},
		{
			title: 'local16',
			latlng: new daum.maps.LatLng(36.76017459027602, 127.27737189527272)
		}
	];

	
	// 임무 수행중인 드론 좌표 지정
	var dronePosition1 = [
		{
			title: 'Drone1-1', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone1-2', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone1-3', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone2-1',
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone2-2', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone2-3', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-1', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-2',
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-3', 
			latlng: new daum.maps.LatLng(36.760642, 127.283442)
		}
	];

	var dronePosition2 = [
		{
			title: 'Drone1-1', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone1-2', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone1-3', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone2-1',
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone2-2', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone2-3', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-1', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-2',
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-3', 
			latlng: new daum.maps.LatLng(0, 0)
		}
	];

	var dronePosition3 = [
		{
			title: 'Drone1-1', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone1-2', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone1-3', 
			latlng: new daum.maps.LatLng(36.765097, 127.282984)
		},
		{
			title: 'Drone2-1',
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone2-2', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone2-3', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-1', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-2',
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-3', 
			latlng: new daum.maps.LatLng(36.760642, 127.283442)
		}
	];

	var dronePosition4 = [
		{
			title: 'Drone1-1', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone1-2', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone1-3', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone2-1',
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone2-2', 
			latlng: new daum.maps.LatLng(36.766057, 127.284018)
		},
		{
			title: 'Drone2-3', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-1', 
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-2',
			latlng: new daum.maps.LatLng(0, 0)
		},
		{
			title: 'Drone3-3', 
			latlng: new daum.maps.LatLng(0, 0)
		}
	];
	
	
	<!----------------- 지도 설정 ----------------->

	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
		mapOption = { 
			center: new daum.maps.LatLng(36.7638237, 127.28138339999998), // 지도의 중심좌표
			level: 4 // 지도의 확대 레벨
		};

	// 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
	var map = new daum.maps.Map(mapContainer, mapOption),
		customOverlay = new daum.maps.CustomOverlay({}),
		infowindow = new daum.maps.InfoWindow({removable: true}); 

	// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
	var mapTypeControl = new daum.maps.MapTypeControl();

	// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
	// daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
	map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);

	// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
	var zoomControl = new daum.maps.ZoomControl();
	map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);

	
	<!------------------ 로컬 센서 이미지 표시 ------------------>

	var sensorMarkers = [];
	var droneMarkers = [];
	
	// 마커 이미지의 이미지 주소입니다
	function drawtest(condition)
	{
		// 배열에 추가된 마커들을 지도에 표시하거나 삭제하는 함수입니다
		for(var i = 0; i < sensorMarkers.length; i++) {
			sensorMarkers[i].setMap(null);
		}           
		
		for(var i=0; i<droneMarkers.length; i++) {
			droneMarkers[i].setMap(null);
		}
		
		var imageSrc1 = "/public/common/image/sensor.PNG"; 
		var imageSrc2 = "/public/common/image/clickedSensor.PNG";
		var fireSrc1 = "/public/common/image/fire.png";
		var fireSrc2 = "/public/common/image/clicked_fire.png";
		var flagSrc = "/public/common/image/flagIcon.png";
		var droneSrc = "/public/common/image/simulDrone.png";
		var blankSrc = "/public/common/image/simulDrone.png";
		
		sensorMarkers = [];	
		
		for (var i = 0; i < positions.length; i ++) {	
			// 마커 이미지의 이미지 크기 입니다
			var imageSize = new daum.maps.Size(14, 14); 
			var clickedSize = new daum.maps.Size(20, 20);
			var fireSize = new daum.maps.Size(40, 40);
			var clickedFireSize = new daum.maps.Size(50, 50);
			var flagSize = new daum.maps.Size(35, 35);
			
			// 마커 이미지를 생성합니다    
			var markerImage = new daum.maps.MarkerImage(imageSrc1, imageSize); 
			var clickedImage = new daum.maps.MarkerImage(imageSrc2, clickedSize);
			var markerFire = new daum.maps.MarkerImage(fireSrc1, fireSize);
			var clickedFire = new daum.maps.MarkerImage(fireSrc2, clickedFireSize);
			var flagImage = new daum.maps.MarkerImage(flagSrc, flagSize);
			
			// 마커를 생성합니다
			var whichImage;
	
			if((1 == checkFlagIcon[i]) && (1 != checkFireIcon[i])) {
				whichImage = flagImage;
				checkFlagIcon[i] = 0;
			}
			else if((i == localNum) && (1 == checkFireIcon[i]) && (1 != checkFlagIcon[i])) {
				whichImage = clickedFire;
			}
			
			else if((i == localNum) && (1 != checkFireIcon[i]) && (1 != checkFlagIcon[i])) {
				whichImage = clickedImage;
			}
			
			else if((i != localNum) && (1 == checkFireIcon[i]) && (1 != checkFlagIcon[i])) {
				whichImage = markerFire;
			}
			
			else { 
				whichImage = markerImage;
			}
			
			var marker = new daum.maps.Marker({
				map: map, // 마커를 표시할 지도
				position: positions[i].latlng, // 마커를 표시할 위치
				title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
				image : whichImage // 마커 이미지 
			});
			
			sensorMarkers.push(marker);
		}
		
		for (var i = 0; i < condition.length; i ++) {
		
			// 마커 이미지의 이미지 크기 입니다
			var droneSize = new daum.maps.Size(30, 30); 
			var blankSize = new daum.maps.Size(0, 0);
			
			// 마커 이미지를 생성합니다    
			var droneImage = new daum.maps.MarkerImage(droneSrc, droneSize); 
			var blankImage = new daum.maps.MarkerImage(blankSrc, blankSize);
			
			var whichDrone;
			var whichPosition;
			
			if(condition[i] == "임무중") {
				whichDrone = droneImage;
			}
			
			else {
				whichDrone = blankImage;
			}
			
			if(checkButton == 1)	
				whichPosition = dronePosition1;
			
			else if(checkButton == 2) 	
				whichPosition = dronePosition2;
			
			else if(checkButton == 3) 	
				whichPosition = dronePosition3;
			
			else if(checkButton == 4)	
				whichPosition = dronePosition4;

			// 마커를 생성합니다
			var marker = new daum.maps.Marker({
				map: map, // 마커를 표시할 지도
				position: whichPosition[i].latlng, // 마커를 표시할 위치
				title : whichPosition[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
				image : whichDrone // 마커 이미지 
			});
			droneMarkers.push(marker);
		}	
	};

		var imageSrc1 = "/public/common/image/sensor.PNG";
			
		for (var i = 0; i < positions.length; i ++) {
			// 마커 이미지의 이미지 크기 입니다
			var imageSize = new daum.maps.Size(14, 14); 
			
			// 마커 이미지를 생성합니다    
			var markerImage = new daum.maps.MarkerImage(imageSrc1, imageSize); 

			var listenMarker = new daum.maps.Marker({
				map: map, // 마커를 표시할 지도
				position: positions[i].latlng, // 마커를 표시할 위치
				title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
				image : markerImage // 마커 이미지 
			});
		}


	<!------------------ 스테이션 활동 반경 설정 ------------------>

	// 지도에 표시할 원을 생성합니다
	var circle1 = new daum.maps.Circle({
		center : new daum.maps.LatLng(36.761267, 127.279883),  // 원의 중심좌표 입니다 
		radius: 500, // 미터 단위의 원의 반지름입니다 
		strokeWeight: 0, // 선의 두께입니다 
		strokeColor: '#75B8FA', // 선의 색깔입니다
		strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed', // 선의 스타일 입니다
		fillColor: '#B2EBF4', // 채우기 색깔입니다
		fillOpacity: 0.3  // 채우기 불투명도 입니다   
	}); 

	var circle2 = new daum.maps.Circle({
		center : new daum.maps.LatLng(36.766601, 127.281424),  // 원의 중심좌표 입니다 
		radius: 500, // 미터 단위의 원의 반지름입니다 
		strokeWeight: 0, // 선의 두께입니다 
		strokeColor: '#75B8FA', // 선의 색깔입니다
		strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed', // 선의 스타일 입니다
		fillColor: '#CEF279', // 채우기 색깔입니다
		fillOpacity: 0.3  // 채우기 불투명도 입니다   
	}); 
		
	var circle3 = new daum.maps.Circle({
		center : new daum.maps.LatLng(36.761275, 127.284686),  // 원의 중심좌표 입니다 
		radius: 500, // 미터 단위의 원의 반지름입니다 
		strokeWeight: 0, // 선의 두께입니다 
		strokeColor: '#75B8FA', // 선의 색깔입니다
		strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed', // 선의 스타일 입니다
		fillColor: '#D1B2FF', // 채우기 색깔입니다
		fillOpacity: 0.3  // 채우기 불투명도 입니다   
	}); 
	
	
	// 지도에 원을 표시합니다 
	circle1.setMap(map); 
	circle2.setMap(map);
	circle3.setMap(map);
		
	
	<!------------------ 학교 반경 표시 ------------------->

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


	<!------------------ 학교 분할 영역 표시 ------------------>
	
	// 지도에 학교분할영역 선을 생성합니다
	var polyline1 = new daum.maps.Polyline({
		path: linePath1, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});
		
	var polyline2 = new daum.maps.Polyline({
		path: linePath2, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});    
	var polyline3 = new daum.maps.Polyline({
		path: linePath3, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});        
	var polyline4 = new daum.maps.Polyline({
		path: linePath4, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});
	var polyline5 = new daum.maps.Polyline({
		path: linePath5, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});   
	var polyline6 = new daum.maps.Polyline({
		path: linePath6, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});      
	var polyline7 = new daum.maps.Polyline({
		path: linePath7, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});      
	var polyline8 = new daum.maps.Polyline({
		path: linePath8, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});      
	var polyline9 = new daum.maps.Polyline({
		path: linePath9, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});      
	var polyline10 = new daum.maps.Polyline({
		path: linePath10, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});      
	var polyline11 = new daum.maps.Polyline({
		path: linePath11, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});     
	var polyline12 = new daum.maps.Polyline({
		path: linePath12, // 선을 구성하는 좌표배열 입니다
		strokeWeight: 1.3, // 선의 두께 입니다
		strokeColor: '#8C8C8C', // 선의 색깔입니다
		strokeOpacity: 0.7, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
		strokeStyle: 'dashed' // 선의 스타일입니다
	});      
		
	// 지도에 학교영역을 표시합니다 
	polyline1.setMap(map);  
	polyline2.setMap(map);
	polyline3.setMap(map);
	polyline4.setMap(map);
	polyline5.setMap(map);
	polyline6.setMap(map);    
	polyline7.setMap(map);    
	polyline8.setMap(map);    
	polyline9.setMap(map);    
	polyline10.setMap(map);    
	polyline11.setMap(map);    
	polyline12.setMap(map);  

	
	<!------------------ 스테이션 위치 표시 ------------------>

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

		// 다각형에 click 이벤트를 등록하고 이벤트가 발생하면 다각형의 이름과 면적을 인포윈도우에 표시합니다 
		daum.maps.event.addListener(polygon, 'click', function(mouseEvent) {
			var content = '<div class="info">' + 
						'   <div class="title"><h4>' + area.name + '</h4></div>';

			infowindow.setContent(content); 
			infowindow.setPosition(mouseEvent.latLng); 
			infowindow.setMap(map);
		});
	}

	// 마커를 클릭했을 때 마커 위에 표시할 인포윈도우를 생성합니다
	var iwContent = '<div style="padding:5px;">Hello World!</div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
		iwRemoveable = true; // removeable 속성을 ture 로 설정하면 인포윈도우를 닫을 수 있는 x버튼이 표시됩니다

	// 인포윈도우를 생성합니다
	var infowindow = new daum.maps.InfoWindow({
		content : iwContent,
		removable : iwRemoveable
	});

	// 마커에 클릭이벤트를 등록합니다
	daum.maps.event.addListener(listenMarker, 'click', function() {
		  // 마커 위에 인포윈도우를 표시합니다
		  infowindow.open(map, listenMarker);  
	});
</script>