<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

    //기상청에서 데이터를 파싱해오는 class 입니다.
	class KmaWeather
   {
		function area_weather_xml_parser($x,$y)
	{
		$array = array(); 

		$url1="www.kma.go.kr";

		$url2="GET /";

		$url2.="wid/queryDFS.jsp?gridx=".$x."&gridy=".$y;

		$url2.=" HTTP/1.0\r\nHost:www.kma.go.kr\r\n\r\n";

		$fp2 = fsockopen ($url1, 80, $errno, $errstr,30 );

		if (!$fp2) echo "?   $errstr ($errno)<br />n";

		else
		{
			fputs ($fp2, $url2);

			$i = 0; $j=0;

			while (!feof($fp2))
			{
				$line=fgets ($fp2,512);

				if(preg_match("/<tm>/",$line))$array['date']= $this->iconv_UTF_8(trim(strip_tags($line))); 

				if($i==$j++ && preg_match("/<data>/",$line))
				{
					$area=preg_split("/\"/",$line);
					$area=preg_split("/\"/",$area[1]);
					
					$number = iconv_UTF_8($area[0]);// iconv('UTF-8','EUC-KR',$area[0]); 

					$array[$i]= $number; 
				}

				if(preg_match("/<hour>/",$line))$array[$i]['hour']=$this-> iconv_UTF_8(trim(strip_tags($line))); //시간 18일 경우  15~18시

				if(preg_match("/<day>/",$line))$array[$i]['day']= $this->iconv_UTF_8(trim(strip_tags($line)));  //0:오늘 1:내일 2:모레

				if(preg_match("/<temp>/",$line))$array[$i]['temp']=$this-> iconv_UTF_8(trim(strip_tags($line))); //현재시간온도

				if(preg_match("/<pty>/",$line))$array[$i]['pty']=$this-> iconv_UTF_8(trim(strip_tags($line))); //강수상태코드  0:없음  1:비  2: 비/눈  3: 눈/비  4:눈

				//if(preg_match("/<wfKor>/",$line))$array[$i]['wfkor']=$this-> iconv_UTF_8(trim(strip_tags($line))); //날씨한국어  1:맑음 2:구름조금 3:구름많음 4:흐림 5:비 6:눈/비  7:눈

				if(preg_match("/<wfEn>/",$line))$array[$i]['wfen']=$this-> iconv_UTF_8(trim(strip_tags($line))); //날씨영어  1:Clearly 2:Little Cloudy 3:Mostly Cloudy 4:Cloudy 5:Rainy 6:Snow/Rain  7:Snow

				if(preg_match("/<pop>/",$line))$array[$i]['pop']= $this->iconv_UTF_8(trim(strip_tags($line))); //강수확률%

				//바람이나 강수확률은 제외 필요하신분은 기상청에서 제공하는 pdf파일 참조해서 추가하세요 
				
				if(preg_match("/<ws>/",$line))$array[$i]['ws']= $this->iconv_UTF_8(trim(strip_tags($line)));
				
				if(preg_match("/<wd>/",$line))$array[$i]['wd']= $this->iconv_UTF_8(trim(strip_tags($line)));
				
				if(preg_match("/<sky>/",$line))$array[$i]['sky']= $this->iconv_UTF_8(trim(strip_tags($line)));
				
				if(preg_match("/<reh>/",$line))$array[$i]['reh']= $this->iconv_UTF_8(trim(strip_tags($line)));
				
				if(preg_match("/<r12>/",$line))$array[$i]['r12']= $this->iconv_UTF_8(trim(strip_tags($line)));
				
				if(preg_match("</data>",$line))$i++;
			}
		}
		fclose($fp2);

		return $array;
	}

	function iconv_UTF_8($str)
	{
		 return iconv('UTF-8','EUC-KR',$str); 
	}
  }
    
	
	class Wcondition extends CI_Controller {

		public function index()
		{
			if(!$this->session->userdata('is_login'))
			{
				$this->load->helper('url');
				redirect('/welcome');
			}//if문 끝
		
			else
			{
			//추가
			
			$this->load->view('include/header');
	
			$obj = new KmaWeather;
	
			$data = $obj->area_weather_xml_parser(66,109);
	
			$this->load->view('weather/practice',array("data"=>$data) );
			
			$this->load->view('include/footer');
			$this->load->view('weather/script');
		
			}//else문 끝
		
		}//index함수 끝
		
		
		
		
		public function weatherReport() 
		{
			if(!$this->session->userdata('is_login'))
			{
				$this->load->helper('url');
				redirect('/welcome');
			}//if문 끝
		
			else
			{
			//추가
			
			$this->load->view('include/header');
	
			$obj = new KmaWeather;
	
			//천안 지역
			$data = $obj->area_weather_xml_parser(66,109);
	
			$this->load->view('weather/report',array("data"=>$data) );
			
			$this->load->view('include/footer');
			
			$this->load->view('weather/script2');
			}//else문 끝
		
		}//index함수 끝
		
		
		public function pop()
		{
			if(!$this->session->userdata('is_login'))
			{
				$this->load->helper('url');
				redirect('/welcome');
			}//if문 끝
			
				else
			{
				$this->load->view('weather/iconInfo');
				//$this->load->view('include/footer');
			}
		}
		
		public function safetypop()
		{
			if(!$this->session->userdata('is_login'))
			{
				$this->load->helper('url');
				redirect('/welcome');
			}//if문 끝
			
				else
			{
				$this->load->view('weather/safetyinfo');
				//$this->load->view('include/footer');
			}
		}
		
		
		
		
	}
