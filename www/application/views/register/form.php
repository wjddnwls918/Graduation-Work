
 <div class="login-box well" style="max-width: 400px; margin: 0 auto; margin-top: 30px;">
 <legend>회원가입</legend>
    <?php echo validation_errors(); ?>
    <form class="webform-horizon" action="/login/register" method="post" style="padding-top:5%;">
      <div class="form-group" style="text-align: left">
        <label for="inputEmail">이메일</label>
       
          <input type="text" class ="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="이메일">
       
      </div>
      <div class="form-group" style="text-align: left">
        <label  for="nickname">닉네임</label>
        
          <input type="text" class ="form-control" id="nickname" name="nickname" value="<?php echo set_value('nickname'); ?>"  placeholder="닉네임">
       
      </div>
      <div class="form-group" style="text-align: left">
        <label class="control-label" for="password">비밀번호</label>
        
          <input type="password" class ="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>"   placeholder="비밀번호">
       
      </div>      
      <div class="form-group" style="text-align: left">
        <label class="control-label" for="re_password">비밀번호 확인</label>
        
          <input type="password" class ="form-control" id="re_password" name="re_password" value="<?php echo set_value('re_password'); ?>"   placeholder="비밀번호 확인">
       
      </div>
      <div class="form-group">
        <label class="control-label"></label>
       
          <input type="submit" class="btn btn-custom" value="회원가입" />
       
      </div>      
    </form>


 
</div>