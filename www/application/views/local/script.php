<script>  	

	var handle = false;

	$('#restart').click(function()
	{
		//console.log("tset!!");
		if(handle == false)
		{
			intervalAlarm = setInterval( function (){alarmBody();},2000);
			handle=true;
		}
		else if (handle ==true )
		{
			alert("동작 중 입니다.");
		}
		
	});
	
	$('#stop').click(function()
	{
		//console.log("tset!!");
		clearInterval(intervalAlarm);
		$("body").css("background","white");
		handle = false;
		alert("알람이 정지되었습니다 !!");
	});
	var checkflag = 0;
	
	var tempdata = [0,0,0,0,0,0];
	var co2data = [0,0,0,0,0,0];
	
	var tempcons=0.083;
	var co2cons= 0.01;
	
	var deltempcons = 4.16;
	var delco2cons =0.24;
	
	var realHmd = 0.4207;
	
	var warningPnt = ((30* tempcons * deltempcons) 
				+ (410* co2cons * delco2cons) ) * realHmd;
	
	var firePnt = ((40* tempcons * deltempcons) 
				+ (5000* co2cons * delco2cons) ) * realHmd;
	
	var alarmflag = false;

	var intervalAlarm;
	
	$(document).ready(function() {
		function get(){  //받아옴
				$.ajax({
			url : "/local_controller/get_info_json/<?=$localID?>",
			dataType : "json",
			success : function(data) {
				update_elements(data);  //업데
				updateFlotData(data);
				console.log(data);
				alarmtest(data);
			}
			
		});
		drawPlot();
		$(".chart-list li").click(function() {
			drawPlot();
		});
	}
	
	function update_elements(data)
	{
		$('.temperature').text(data['temperature']);
		$('.humidity').text(data['humidity']);
		$('.CO2').text(data['CO2']);
		$('.vibration').text(data['vibration']);
		$('.waterlevel').text(data['waterlevel']);		
	}
	
	setInterval(function(){get();},1000);
	
	intervalAlarm = setInterval(function() { alarmBody(); },2000);
	
	});
	
    var data = [], totalPoints = 100;

	
	function updateFlotData(drone_data)
	{
		if (data.length > totalPoints)
        data = data.slice(1);
        data.push(drone_data);

	}
	
	function get_activeTap()
	{
		var data_name="";
			switch($(".chart-list li.active").index()){
				case 0:
				data_name="temperature";
				break;
				case 1:
				data_name="humidity";
				break;
				case 2:
				data_name="CO2";
				break;
				case 3:
				data_name="vibration";
				break;
				case 4:
				data_name="waterlevel";
				break;
			}			
		return data_name;
	}

	function checkMinimum() 
	{
		var data_name=get_activeTap();
		var minimum= 999;
		for(var i=0; i<data.length; i++)
		{
			if(Number(data[i][data_name]) < minimum) 
			{
				minimum = Number(data[i][data_name]);
			}
		}
		return minimum;
	}
	
	function checkMaximum() 
	{
		var data_name=get_activeTap();
		var maximum= -999;
		for(var i=0; i<data.length; i++)
		{
			if(Number(data[i][data_name]) > maximum) 
			{
				maximum = Number(data[i][data_name]);
			}
		}
		return maximum;
	}

    function getFlotData() 
	{
		var data_name=get_activeTap();
		
      // Zip the generated y values with the x values
      var res = [];
	  var i = 0;
	  for ( ;i < totalPoints-data.length; ++i) {
		res.push([i, 0]);
		
	  }
	 // console.log("i"+i+"length"+data.length);
      for (var j = 0; j < data.length; ++j,++i) {
		  res.push([i, Number(data[j][data_name])]);
      }
      return res;
    }
	
	function drawPlot() 
	{
		
		var interactive_plot = $.plot("#interactive", [getFlotData()], {
		  grid: {
			borderColor: "#f3f3f3",
			borderWidth: 1,
			tickColor: "#f3f3f3"
		  },
		  
		  series: {
			shadowSize: 0, // Drawing is faster without shadows
			color: "#3c8dbc"
		  },
		  
		  lines: {
			fill: true, //Converts the line chart to area chart
			color: "#3c8dbc"
		  },
		  
		  yaxis: {
			min: checkMinimum()-10,
			max: checkMaximum()+10,
			show: true
		  },
		  
		  xaxis: {
			show: false
		  }
		});	
	}
    
    var updateInterval = 1000; //Fetch data ever x milliseconds
    var realtime = "on"; //If == to on then fetch data every x seconds. else stop fetching
    function update() {

      interactive_plot.setData([getFlotData()]);

      // Since the axes don't change, we don't need to call plot.setupGrid()
      interactive_plot.draw();
     
	 if (realtime === "on")
        setTimeout(update, updateInterval);
    }

    //INITIALIZE REALTIME DATA FETCHING
    if (realtime === "on") {
      update();
    }
    
	//REALTIME TOGGLE
    $("#realtime .btn").click(function () {
      if ($(this).data("toggle") === "on") {
        realtime = "on";
      }
      else {
        realtime = "off";
      }
      update();
    });
	
	

	
		function alarmtest(data)
		{
			//console.log(data.temperature);
			cal(data);
			
			//console.log(checkflag);
		}
	
		function cal(data)
		{
			
			var result = 0;
			var temp =0;
			/*
			if(data.temperature >=40 && data.temperature<45 )
					temp = data.temperature + 20;
			else if ( data.temperature >=45 && data.temperature<=50)	
					temp = data.temperature + 30;
				*/
				result = ((data.temperature* tempcons * deltempcons) 
				+ (data.CO2* co2cons * delco2cons) ) * realHmd;
		
				
				if ( result < warningPnt)
				{
					checkflag = 0;
					//평소
				}
						
				else if ( result >= warningPnt && result < firePnt )
				{
					checkflag = 1;
					//주의
				}
				
				else if ( result >= firePnt)
				{
					checkflag = 2;
					//화재
				}
				
				if((data.vibration >= 5) && (data.vibration<10)) {
					checkflag = 3;
				}
				
				else if(data.vibration >= 10) {
					checkflag = 4;
				}
				
				if((data.waterlevel >= 250) && (data.waterlevel<500)) {
						checkflag = 5;
				}
				else if(data.waterlevel>=500) {
						checkflag = 6;
				}
				
				
			
			
		}
		
		function alarmBody()
		{
			if (checkflag == 1)
			{
				if (alarmflag == false)
				{
					$("body").css("background-color","yellow");
					alarmflag = true;
				}				
				else if (alarmflag == true)
				{
					$("body").css("background-color","white");
					alarmflag = false;
				}
			}
			else if (checkflag == 2)
			{
				if (alarmflag == false)
				{
					$("body").css("background","red");
					alarmflag = true;
				}									
				else if (alarmflag == true)
				{
					
					
					$("body").css("background","white");
					alarmflag = false;
				}
				
			
			}
			else if (checkflag ==3)
			{
				if (alarmflag == false)
				{
					$("body").css("background","#B2A529");
					alarmflag = true;
				}									
				else if (alarmflag == true)
				{
					
					
					$("body").css("background","white");
					alarmflag = false;
				}
				
			
			}
			else if (checkflag == 4)
			{
				if (alarmflag == false)
				{
					$("body").css("background","#665C00");
					alarmflag = true;
				}									
				else if (alarmflag == true)
				{
					
					
					$("body").css("background","white");
					alarmflag = false;
				}
				
			
			}
			else if (checkflag == 5)
			{
				if (alarmflag == false)
				{
					$("body").css("background","#6799FF");
					alarmflag = true;
				}									
				else if (alarmflag == true)
				{
					
					
					$("body").css("background","white");
					alarmflag = false;
				}
				
			
			}
			else if (checkflag == 6)
			{
				if (alarmflag == false)
				{
					$("body").css("background","#0100FF");
					alarmflag = true;
				}									
				else if (alarmflag == true)
				{
					
					
					$("body").css("background","white");
					alarmflag = false;
				}
				
			
			}
			//console.log("alarm body test!!");
		}
	
	
 </script >
