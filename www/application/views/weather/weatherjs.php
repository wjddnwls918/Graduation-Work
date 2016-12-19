<script>

	var Weather = function(){
		this._tm ="";	
		this._ts = "";	
		this._x = "";	
		this._y = "";	
	}

	Weather.prototype = {getTm: function(){return this._tm;},setTm: function(tm){this._tm = tm;},getTs: function(){return this._ts;},setTs: function(ts){this._ts = ts;},getX: function(){return this._x;},setX: function(x){this._x = x;},getY: function(){return this._y;},setY: function(y){this._y = y;}}

	var Data = function(){
		this._hour = 0;		
		this._day = 0;		
		this._temp = 0;		
		this._tmx = 0;		
		this._tmn = 0;		
		this._sky = 0;			
		this._pth = 0;			
		this._wfKor = "";	
		this._wfEn = "";		
		this._pop = 0;		
		this._r12 = 0.0;			
		this._s12 = 0.0;		
		this._ws = 0.0;			
		this._wd = 0;			
		this._wdKor = "";	
		this._wdEn = "";	
		this._reh = 0;		
	}

	Data.prototype = {getHour: function(){ return this._hour; }, setHour: function(hour){ this._hour = hour; },getDay: function(){ return this._day; }, setDay: function(day){ this._day = day; },getTemp: function(){ return this._temp; }, setTemp: function(temp){ this._temp = temp; },getTmx: function(){ return this._tmx; }, setTmx: function(tmx){ this._tmx = tmx; },getTmn: function(){ return this._tmn; }, setTmn: function(tmn){ this._tmn = tmn; },getSky: function(){ return this._sky; }, setSky: function(sky){ this._sky = sky; },getPth: function(){ return this._pth; }, setPth: function(pth){ this._pth = pth; },getWfKor: function(){ return this._wfKor; }, setWfKor: function(wfKor){ this._wfKor = wfKor; },getWfEn: function(){ return this._wfEn; }, setWfEn: function(wfEn){ this._wfEn = wfEn; },getPop: function(){ return this._pop; }, setPop: function(pop){ this._pop = pop; },getR12: function(){ return this._r12; }, setR12: function(r12){ this._r12 = r12; },getS12: function(){ return this._s12; }, setS12: function(s12){ this._s12 = s12; },getWs: function(){ return this._ws; }, setWs: function(ws){ this._ws = ws; },getWd: function(){ return this._wd; }, setWd: function(wd){ this._wd = wd; },getWdKor: function(){ return this._wdKor; }, setWdKor: function(wdKor){ this._wdKor = wdKor; },getWdEn: function(){ return this._wdEn; }, setWdEn: function(wdEn){ this._wdEn = wdEn; },getReh: function(){ return this._reh; }, setReh: function(reh){ this._reh = reh; }}

	var myWeather = new Weather();
	var myData;

	function xmlPars(xml) {
		if ($(xml).find("wid").find("data").length > 0) {
			myWeather.setTm($(xml).find("tm").text());
			myWeather.setTs($(xml).find("ts").text());
			myWeather.setX($(xml).find("x").text());
			myWeather.setY($(xml).find("y").text());

			myData = new Array($(xml).find("wid").find("data").length);
			$(xml).find("wid").find("body").find("data").each(function(idx) {
				myData[idx] = new Data();
				myData[idx].setHour($(this).find("hour").text());
				myData[idx].setDay($(this).find("day").text());
				myData[idx].setTemp($(this).find("temp").text());
				myData[idx].setTmx($(this).find("tmx").text());
				myData[idx].setTmn($(this).find("tmn").text());
				myData[idx].setSky($(this).find("sky").text());
				myData[idx].setPth($(this).find("pth").text());
				myData[idx].setWfKor($(this).find("wfKor").text());
				myData[idx].setWfEn($(this).find("wfEn").text().replace(/^\s+|\s+$/g,""));
				myData[idx].setPop($(this).find("pop").text());
				myData[idx].setR12($(this).find("r12").text());
				myData[idx].setS12($(this).find("s12").text());
				myData[idx].setWs($(this).find("ws").text());
				myData[idx].setWd($(this).find("wd").text());
				myData[idx].setWdKor($(this).find("wdKor").text());
				myData[idx].setWdEn($(this).find("wdEn").text());
				myData[idx].setReh($(this).find("reh").text());
			});
			printWeather($('#weather'),myWeather,myData);
		}
	}

	function printWeather(obj, weatherHeader,arr,len){
		if (len==null) { var len = arr.length; }
		
		var str = "";
		str += '<table class="weatherTable">';
		
		var printRefrshDate = "";

		printRefrshDate += weatherHeader.getTm().slice(0,4)+"?? "+weatherHeader.getTm().slice(4,6)+"?? "+weatherHeader.getTm().slice(6,8)+"?? ("+weatherHeader.getTm().slice(8,10)+":"+weatherHeader.getTm().slice(10,12)+") ???";
		str += '<caption>'+printRefrshDate+'</caption>';
		str += '<thead>';

		str += '<tr><th align="center">??￥</th>';
		
		var col0 = 0;
		var col1 = 0;
		var col2 = 0;
		
		for (var i=0; i<len; i++) {
			if ( arr[i].getDay()==0 ) col0 += 1;
			else if ( arr[i].getDay()==1 ) col1 += 1;
			else if ( arr[i].getDay()==2 ) col2 += 1;
		}
		
		var day_bak = 9;
		
		for (var i=0; i<len; i++) {
			if (day_bak!=arr[i].getDay()) {
				if ( arr[i].getDay()==0 ) str += '<th colspan='+col0+'>????</th>';
				
				else if ( arr[i].getDay()==1 ) str += '<th colspan='+col1+'>????</th>';
				
				else if ( arr[i].getDay()==2 ) str += '<th colspan='+col2+'>??</th>';
			}
			day_bak = arr[i].getDay();
		}
		
		str += '</tr>'

		str += '<tr><th>?ð?</th>';
		for (var i=0; i<len; i++) str += '<th>'+arr[i].getHour()+'</th>';
		str += '</tr>';
		str += '</thead>';

		str += '<tbody>';

		str += '<tr><th>????</th>';
		
		for (var i=0; i<len; i++) {
			if (arr[i].getHour()>18 || arr[i].getHour()<6) {
				var imgPath = './icons/'+arr[i].getWfEn()+'_night'+'.png';
			}
			
			else {
				var imgPath = './icons/'+arr[i].getWfEn()+'.png';
			}
			str += '<td><img src="'+imgPath+'" alt='+arr[i].getWfKor()+' width="50" height="50"><br/>'+arr[i].getWfKor()+'</td>';
		}
		
		str += '</tr>';

		str += '<tr><th>???(??)</th>';
		
		for (var i=0; i<len; i++) str += '<td>'+arr[i].getTemp()+'</td>';
		str += '</tr>';

		str += '<tr><th>????(mm)</th>';
		
		for (var i=0; i<len; i++) {
			if (arr[i].getR12()==0.0) str += '<td>-</td>';
			
			else str += '<td>'+arr[i].getR12()+'</td>';
		}
		str += '</tr>';

		str += '<tr><th>???????(%)</th>';
		
		for (var i=0; i<len; i++) str += '<td>'+arr[i].getPop()+'</td>';
		str += '</tr>';

		str += '<tr><th>????(%)</th>';
		
		for (var i=0; i<len; i++) str += '<td>'+arr[i].getReh()+'</td>';
		str += '</tr>';

		str += '<tr><th>???(m/s)</th>';
		
		for (var i=0; i<len; i++) str += '<td>'+arr[i].getWdKor()+'('+arr[i].getWs()+')</td>';
		str += '</tr>';

		str += '<tbody>';
		str += '</table>';
		obj.html(str);
	}

</script>