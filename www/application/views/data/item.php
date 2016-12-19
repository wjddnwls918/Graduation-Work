
		<!-- Content Header (Page header) -->
		<?foreach($practice_Drone_Data as $item)?>
	    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">드론 <?=$item['drone_idx']?> 비행일지
                    <small>날짜별 데이터 수집</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/welcome">Home</a></li>
                    <li class="active"><a href="/data/<?=$item['drone_idx']?>">Drone Information < <?=$item['drone_idx']?> ></li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
  
        <!-- Content Row -->
        <div class="row">
            <!-- Sidebar Column -->
			<div class="col-md-2">
				<div class="list-group">
					<a href="/data/1" class="list-group-item">드론1 비행일지</a>
					<a href="/data/2" class="list-group-item">드론2 비행일지</a>
					<a href="/data/3" class="list-group-item">드론3 비행일지</a>
                </div>
			</div>
			<!-- /.Sidebar Column -->
			
			<!-- Main content -->
	        <div class="col-md-10">
				<div class="col-xs-2"></div>
					<div class="col-xs-8">
						<div class="box-border:0">
							<div class="box-body table-responsive no-padding">			
								<table class="table  table-striped table-hover">
									<tr>
										<th><span style="font-size:20px; vertical-align:middle;">비행 날짜</span></th>
										<th><span style="font-size:20px; vertical-align:middle;">데이터 확인</span></th>
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
										<td ><h4><?=$item['idx_date']?></h4></td>		 
										<td><a href="/data/detail/<?=$item['drone_idx']?>/<?=$item['idx_date']?>"><button type="button" class="btn-custom btn-sm" >check</button></a></td>
									</tr>
									<?  										
										}
									?>
								</table>
							</div>
						</div>
						<div style="text-align: center;">
							<?=$page;?>
						</div>     
					</div>
            </div>
			<!-- /.Main content -->
        </div>	
		<!-- /.content row -->



