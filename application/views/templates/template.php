<?php $this->load->view('templates/header.php'); ?>
<body class="g-sidenav-show  bg-gray-200">
<?php $this->load->view('templates/aside.php') ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<?php $this->load->view('templates/navbar.php');?>
<div class="container-fluid py-4">
	<?= $contents ?>
<?php $this->load->view('templates/footer.php');
 ?>
