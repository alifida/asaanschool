<!--  Global var site URL -->
<?php //pre($_SESSION ["reportConf"]); ?>
	 <script>
	 	var site_url = "<?php echo site_url(''); ?>";
	 	var base_url = "<?php echo base_url(); ?>";
	 	var currentPageUrl = window.location.href ;
	 	var currentTitle = document.title;
	 	var print_header_html="<div>";
	 	<?php if(isset($_SESSION ["reportConf"]) && !empty($_SESSION ["reportConf"])){?>
	 		var logo_width = '30px;';
	 		<?php if(isset($_SESSION ["reportConf"]["logo_width"]) && !empty($_SESSION ["reportConf"]["logo_width"])){?>
	 			logo_width = '<?= $_SESSION ["reportConf"]["logo_width"] ?>px';
		 	<?php }?>
	 		<?php if(isset($_SESSION ["reportConf"]["logo"]) && !empty($_SESSION ["reportConf"]["logo"])){?>
		 		print_header_html += "<img src='<?= $_SESSION ["reportConf"]["logo"]?>' alt='' style='float:left;margin-right: 20px; width: "+logo_width+"'/>";
		 	<?php }?>
	 		<?php if(isset($_SESSION ["reportConf"]["title"]) && !empty($_SESSION ["reportConf"]["title"])){?>
		 		print_header_html += "<h3 style='clear:right'><?= $_SESSION ["reportConf"]["title"]?></h3>";
		 	<?php }?>
	 		<?php if(isset($_SESSION ["reportConf"]["header_string"]) && !empty($_SESSION ["reportConf"]["header_string"])){?>
		 		print_header_html += "<h4 style='clear:right'><?= $_SESSION ["reportConf"]["header_string"]?></h4>";
		 	<?php }?>
	 	<?php }?>
	 		print_header_html += "</div>";
	 </script>
 	<script src="<?= base_url() ?>public/js/jquery-2.1.1.min.js"></script>
	<!-- Custom Theme JavaScript -->
	<script  src="<?= base_url() ?>public/js/asaanschool.js?v=<?= get_app_message("release.version")?>"></script>
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">



	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">



	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />

 
<link href="<?= base_url() ?>public/css/bootstrap.css?v=<?= get_app_message("release.version")?>" rel="stylesheet">

        <link href="<?= base_url() ?>public/fonts/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?= base_url() ?>public/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?= base_url() ?>public/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?= base_url() ?>public/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="<?= base_url() ?>public/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?= base_url() ?>public/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?= base_url() ?>public/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?= base_url() ?>public/css/asaanschool.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->




<!-- Bootstrap Core CSS -->

    <!-- MetisMenu CSS -->

    <!-- Timeline CSS -->

    <!-- Custom CSS -->

 <!-- Morris Charts CSS -->

   <!-- Custom Fonts -->


  <link href="<?= base_url() ?>public/css/plugins/tokeninput/token-input.css" rel="stylesheet">
  <link href="<?= base_url() ?>public/css/plugins/tokeninput/token-input-custom.css" rel="stylesheet">
  <link href="<?= base_url() ?>public/css/bootstrapValidator.css?v=<?= get_app_message("release.version")?>" rel="stylesheet">
  <link href="<?= base_url() ?>public/css/plugins/multiple_select/bootstrap-duallistbox.css" rel="stylesheet">


  <link href="<?= base_url() ?>public/css/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
  <link href="<?= base_url() ?>public/css/plugins/datatables/dataTables.responsive.css" rel="stylesheet">

  <link href="<?= base_url() ?>public/css/colorpicker/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>public/css/plugins/nestable.css" rel="stylesheet">

  
  <!-- File upload css 
  
	<link  href="< ?= base_url() ?>public/css/plugins/fileupload/main.css" rel="stylesheet" type="text/css"/>
	<link  href="< ?= base_url() ?>public/css/plugins/fileupload/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>
-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

