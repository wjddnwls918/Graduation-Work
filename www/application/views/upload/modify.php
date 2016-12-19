
<form action="/Data/mk_upload/<?=$view_data['board_id']?>" method="post" id ="write_action" class="span10" style="padding-top:3%;">



	<input type="text" name="subject" placeholder="제목" id="input01" class="span12" value="<?php echo $view_data['subject'];?>"/>
	<textarea name="contents" placeholder="본문" id ="input02" class="span12" rows="15">
	<?php echo $view_data['contents']?></textarea>
	<input class="btn btn-sm btn-custom" id="write_btn" type="submit"/>
	<a href="/data/lists" class="btn btn-sm btn-custom">목록 </a>

</form>

<script src="/public/ckeditor/ckeditor.js"></script>

<script>
	CKEDITOR.replace('contents',{
		
		'filebrowserUploadUrl':'/data/ck_upload'
		
	});
</script>