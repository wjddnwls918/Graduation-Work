  <script>
            $(document).ready(function() {
                $("#write_btn").click(function() {
                    if ($("#input01").val() == '') {
                        alert('제목을 입력해 주세요.');
                        $("#input01").focus();
                        return false;
                    } 
					
					/*else if ($("#input02").val() == '') {
                        alert('내용을 입력해 주세요.');
                        $("#input02").focus();
                        return false;
                    } 
					*/
					
					else {
                        $("#write_action").submit();
                    }
                });
            });
       </script>