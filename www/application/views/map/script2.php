
<!-- <script type="text/javascript" src="jquery.ajax-cross-origin.min.js"></script> -->
<script>

$('#droneNameClick1').click(function() {
		window.open("/map/pop_drone_info/1", "popdrone1", "width=600, height=900, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
});

$('#droneNameClick2').click(function() {
		window.open("/map/pop_drone_info/2", "popdrone2", "width=600, height=900, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
});

$('#droneNameClick3').click(function() {
		window.open("/map/pop_drone_info/3", "popdrone3", "width=600, height=900, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
});




$("#inputdata").click(function()
{
	var input_data =$("#inputtest").val();
	var lat_data = $("#latitudetest").val();
	var lng_data = $("#longitudetest").val();
	var add_data;
	
	console.log(typeof(input_data));
	console.log(input_data +","+ lat_data+","+lng_data);

	if($('input:radio[id="startcheck"]').is(":checked") == true)
	{
		add_data = 1;		
		
	}	
	else if( $('input:radio[id="stopcheck"]').is(":checked") == true )
	{
		add_data = 2;				
	}
		
	else if( $('input:radio[id="takeoffcheck"]').is(":checked") == true )
	{
		add_data = 3;				
		
	}
	
	
	else if( $('input:radio[id="landingcheck"]').is(":checked") == true )
	{
		add_data = 4;				
		
	}

	$.ajax(
	{
		url: "http://218.150.181.154:3000/?data1=" +add_data,
		
		// 크로스도메인 핵심!! 
		dataType: 'jsonp',
		
		success : function(data)
		{
			data = JSON.parse(data);
			console.log(data);
		},
		error : function(xhr)
		{
			console.log("실패 - ", xhr);
		}
	}
	);
	
});

//안씀~~
$("#dronebutton_start1").click(function(){
	
	console.log($("#inputtest").val());
	start_data = $("#inputtest").val();
	
	$.ajax(
	{
		url: "http://218.150.181.154:3000/?sendData=" + start_data+"&data1=1",
		// 크로스도메인 핵심!! 
		dataType: 'jsonp',
		
		success : function(data)
		{
			data = JSON.parse(data);
			console.log(data);
		},
		error : function(xhr)
		{
			console.log("실패 - ", xhr);
		}
	}
	);
});


$("#dronebutton_stop1").click(function(){
	

	console.log($("#inputtest").val());
	stop_data = $("#inputtest").val();
	$.ajax(
	{
		url: "http://218.150.181.154:3000/?sendData=" + stop_data+"&data1=2",
		
		//크로스도메인 핵심!! 
		dataType: 'jsonp',
		
		success : function(data)
		{
			data = JSON.parse(data);
			console.log(data);
		},
		error : function(xhr)
		{
			console.log("실패 - ", xhr);
		}
	}
   );
});

$("#dronebutton_move1").click(function(){
	

	console.log($("#inputtest").val());
	move_data = $("#inputtest").val();
	
	$.ajax(
	{
		url: "http://218.150.181.154:3000/?sendData=" + move_data+"&data1=3",
		
		// 크로스도메인 핵심!! 
		dataType: 'jsonp',
		
		success : function(data)
		{
			data = JSON.parse(data);
			console.log(data);
		},
		error : function(xhr)
		{
			console.log("실패 - ", xhr);

		}
      }
	);
});


function button1_click(param)
{
	console.log(param);
	data1=$("#exampleInputEmail1").data("email");
	
	console.log(data1);
	$.ajax(
	{
		url: "http://218.150.181.154:3000/?sendData=" + param+"&data1="+data1+"&data2="+data2,
		
		/* 크로스도메인 핵심!! */
		dataType: 'jsonp',
		
		success : function(data)
		{
			data = JSON.parse(data);
			console.log(data);
		},
		error : function(xhr)
		{
			console.log("실패 - ", xhr);
		}
	  }
	);

}
</script>