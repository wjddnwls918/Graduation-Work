<?foreach($practice_Drone_Data as $item)?>
	    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">관리자 작성페이지
                    <small>관리자 기록페이지</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/welcome">Home</a></li>
                  
                </ol>
            </div>
        </div>
        <!-- /.row -->
  
        <!-- Content Row -->
        <div class="row">
            <!-- Sidebar Column -->
			<!--
			
			<div class="col-md-2">
				<div class="list-group">
					<a href="/data/1" class="list-group-item">드론1 비행일지</a>
					<a href="/data/2" class="list-group-item">드론2 비행일지</a>
					<a href="/data/3" class="list-group-item">드론3 비행일지</a>
                </div>
			</div>
			-->
			<!-- /.Sidebar Column -->
			
			<!-- Main content -->
	        <div class="col-md-12">
				<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="box-border:0">
							<div class="box-body table-responsive no-padding">			
								<table class="table  table-striped table-hover">
									<tr>
										<th><span style="font-size:20px; vertical-align:middle;">번호</span></th>
										<th><span style="font-size:20px; vertical-align:middle;">제목</span></th>
										<th><span style="font-size:20px; vertical-align:middle;">작성자</span></th>
										<th><span style="font-size:20px; vertical-align:middle;">조회수</span></th>
										<th><span style="font-size:20px; vertical-align:middle;">작성일</span></th>
										<th><span style="font-size:20px; vertical-align:middle;">확인</span></th>
									</tr>
									<?
										foreach($practice_Drone_Data as $item){
											$count = 0;
											$check = 0;	
											$num =1;
											
											//echo "<tr>";
										//	echo "<td>".$num."</td>";
											//$num++;
									?>
									<tr>
										<td ><h4><?=$item['board_id']?></h4></td>
										<td ><h4><?=$item['subject']?></h4></td>
										<td ><h4><?=$item['user_name']?></h4></td>
										<td ><h4><?=$item['hits']?></h4></td>
										<td ><h4><?=$item['reg_date']?></h4></td>
										
										<td><a href="/data/view/<?=$item['board_id']?>"><button type="button" class="btn-custom btn-sm" >check</button></a></td>
									</tr>
									<?  										
										}
									?>
								</table>
							</div>
						</div>
					
							<div class="col-md-12" >
							
								<form class="form-inline" style="float:right;" action="/search" method="post">
								  <div class="form-group">
														
										<select class="form-control selecter" name="_type">
										  <option value="title">제목</option>
										  <option value="contents">내용</option>
										  <option value="writer">작성자</option>
									
										</select>									
								
									<input type="text" class="form-control" name ="_text" id="exampleInputName2" placeholder="검색할 내용을 입력하세요">
								  </div>
								 
								  <button type="submit" class="btn btn-default">검색</button>
								  <a href="/data/add"   class="btn btn-default"> 글 쓰기 </a>   
								</form>
							
				
							 
							  
															  
							</div>
							
					
						<div class ="col-sm-12" style="padding-left: 33%">
							<?=$page;?> 
						</div>     
						
					</div>
            </div>
			<!-- /.Main content -->
        </div>	
		<!-- /.content row -->
