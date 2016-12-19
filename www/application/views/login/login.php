<html>
<head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
    <title></title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>
<body>

<div id="main">
 
    <header id="header" data-role="header" data-position="fixed"><!-- Header Start -->
        <blockquote>
        <p>
<?php
	<?php
		session_start();

		if(isset($_COOKIE['ci_session'])){ ?>
			<?php
			$user= $this->security->xss_clean($this->input->post('user'));
			$pass= $this->security->xss_clean($this->input->post('pass'));

			$result = $usrLog->loguearUsuario($user, $pass);

		if($result == TRUE){?>
			$data = $this->session->set_userdata('logged_in', $sessArray);
			$this->load->view('pages/admin', $data);
		}<?php
	}
	else{
		header('Location: login');
<?php   
}
?>
        </p>
        </blockquote>
		
    </header><!-- Header End -->
		<nav id="gnb"><!-- gnb Start -->
        <ul>
            <li><a rel="external" href="/ci/<?php echo $this->uri->segment(1);?>/lists/<?php echo $this->uri->segment(3);?>">Home</a></li>
        </ul>
    </nav><!-- gnb End -->
