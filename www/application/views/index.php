<!-- Content Header (Page header) -->
   <!-- 로그인 화면 -->
    <!-- Main content -->
    
	
	<!-- 컨트롤러 Login.php에 있는 $this->session->set_flashdata('login_message','로그인에 실패 했습니다.');	부분 -->
		<?
			if($this->session->flashdata('login_message'))
			{
		?>
			<script>
				alert('<?=$this->session->flashdata('login_message')?>');
			
			</script>
			
		<?
			}
			if($this->session->flashdata('logout_message'))
			{
		?>
			<script>
				alert('<?=$this->session->flashdata('logout_message')?>');
			
			</script>
			
		<?
			}
		?>
	
		
		<img src="/public/common/image/main.png" width="400" style="max-width: 100%; margin-top: 10%;">
          <div class="login-box well" style="max-width: 400px; margin: 0 auto; margin-top: 30px;">
            <form class ="webform-horizon" action="/login/authentication" method="post">
                <legend>로그인</legend>
                
				<div class="form-group" style="text-align: left">
                    <label for="username-email">아이디</label>
                    <input type="text" class="form-control" id="email" name ="email" placeholder="email" style="width:100%" />
                </div>
                
				<div class="form-group" style="text-align: left">
                    <label for="password">비밀번호</label>
                    <input type="password" class="form-control" id="password" name ="password" placeholder="Password"  style="width:100%;">
                </div>
                
				<div class="form-group">
                    <input type="submit" class="btn btn-default btn-login-submit btn-block m-t-md" value="Login" />
                </div>
           
            </form>
          </div>
	
	

	
    <!-- /.content --> 