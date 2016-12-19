<script>
// <![CDATA[// 



 window.onload = function startClock() { // internal clock //
	var today=new Date();
	var y=today.getFullYear();
	var M=today.getMonth();
	var d=today.getDate();
	var h=today.getHours();
	var m=today.getMinutes();
	var s=today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	M = checkDate(M);
	M = checkTime(M);
	
	if(d<'10') {
		d = '0'+d;
	}
	
	if(h<'10') {
		h = '0'+h;
	}
	
	var time=y+"년 "+M+"월 "+d+"일  "+h+"시 "+m+"분 "+s+"초";
	
	document.getElementById('Display_clock').innerHTML = time;
	
	var t = setTimeout(function(){startClock()},500);
}

	function checkTime(i) {
	
	if (i<10) {i = "0" + i};  // add zero in front of numbers < 10 
		return i;
	}

	function checkDate(i) {
		i = i+1 ;  // to adjust real month
		return i;
	}
// ]]>

$('.btnSafety').click(function()
{
	//console.log("test");
	
	window.open("/wcondition/safetypop", "btnSafety", "width=600, height=600, toolbar=no, menubar=no, scrollbars=no, resizable=yes")
});

$(function()
{
	//console.log("Testset");
});


</script>