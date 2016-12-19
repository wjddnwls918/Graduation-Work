<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('page_nav')){
      function page_nav($total,$scale,$p_num,$page,$query,$controller,$function=NULL)
        {
        		if($function) $function='/'.$function;
                $URL="/admin/".$controller.$function;

                $total_page = ceil($total/$scale);
                if (!$page) $page = 1;
                $page_list = ceil($page/$p_num)-1;
                
				$navigation="";
				
                // 페이지 리스트의 첫번째가 아닌 경우엔 [1]...[prev] 버튼을 생성한다.
                if ($page_list>0) 
                {
						$navigation = "<li class='paginate_button'><a href='{$URL}/1/$query'>1</a></li>";
						$navigation .= "<li class='paginate_button disabled'><a>...</a></li>";
						$prev_page = ($page_list)*$p_num; 
						//$prev_page = ($page_list-1)*$p_num+1;
						$navigation .= "<li class='paginate_button previous'><a href='$URL/$prev_page/$query'>Previous</a></li>"; 
						
                }

                // 페이지 목록 가운데 부분 출력
                $page_end=($page_list+1)*$p_num;
                if ($page_end>$total_page) $page_end=$total_page;

                for ($setpage=$page_list*$p_num+1;$setpage<=$page_end;$setpage++)
                {
                        if ($setpage==$page) {
                                $navigation .= "<li class='paginate_button active'><a>$setpage</a></li>";
                        } else {
							
                                $navigation .= "<li class='paginate_button'><a href='$URL/$setpage/$query'>$setpage</a></li> ";
                        }
                }

                // 페이지 목록 맨 끝이 $total_page 보다 작을 경우에만, [next]...[$total_page] 버튼을 생성한다.
                if ($page_end<$total_page) 
                {	
                        $next_page = ($page_list+1)*$p_num+1;
                        $navigation .= "<li class='paginate_button next' ><a href='$URL/$next_page/$query' >Next</a></li>";
						$navigation .= "<li class='paginate_button disabled'><a>...</a></li>";
                        $navigation .= "<li class='paginate_button'><a href='$URL/$total_page/$query'>$total_page</a></li>";
                }
        
                return $navigation;
        }
}