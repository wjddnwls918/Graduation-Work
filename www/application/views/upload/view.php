	<?
		//foreach($view_data as $item)
		//{
		 /* echo $view_data['board_id'];
	      echo $view_data['subject'];
		 echo $view_data['user_name'];
		 echo $view_data['hits'];
		 echo $view_data['reg_date'];
										
			*/					
									
		//}			
	?>
	
	<article id="board_area">
                <header>
                    <h1></h1>
                </header>
                <table cellspacing="0" cellpadding="0" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><?=$view_data['subject']?></th>
                            <th scope="col">이름: <?=$view_data['user_name']?></th>
                            <th scope="col">조회수: <?=$view_data['hits']?></th>
                            <th scope="col">등록일: <?=$view_data['reg_date']?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="4" style="height:500px;">
                                <?=$view_data['contents']?>
                            </th>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">
                                <a href="/data/lists" class="btn btn-sm btn-custom">목록 </a>
                                <a href="/data/modify/<?=$view_data['board_id']?>"   class="btn btn-sm btn-custom"> 수정 </a>
                                <a href="/data/file_del/<?=$view_data['board_id']?>"   class="btn btn-sm btn-custom"> 삭제 </a>
                                <a href="/data/add"   class="btn btn-sm btn-custom"> 글 쓰기 </a>                
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </article>