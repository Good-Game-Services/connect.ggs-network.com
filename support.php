<html>
<?php 
if(!session_id()){
	session_start();
}
require("config/db.php");
$title = "Support";
require("layout/head.php"); // $title = "page title"

if(checkUserSession($db) !== True){
	header("location: $_SUPPORT_FILE");exit; //$_SUPPORT_FILE --> /config/value.php
}

$user = searchUser_bSession($db, $_COOKIE["user_session"]);

if($user["admin"] != 1){
	error("You are not admin.", $_HOME_FILE);exit;
}
?>

<body class=" pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>

<div id="wrapper">

<?php
$support = "active";
$userName = $user["firstName"] . " " . $user["lastName"];
require("layout/menu.php");
?>
        <div id="page-wrapper" class="gray-bg" style="min-height: 1263px;">
        <?php
		require("layout/navtop.php");
		?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Support</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="support.php">Support</a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Support</h5>
                        </div>
                        <div class="ibox-content">
                            <form id="support_ticket" method="POST" action="" class="form-horizontal">
								<div class="form-group"><label class="col-sm-1 control-label">Title</label>
									<div class="col-sm-10"><input type="text" name="title" value="" class="form-control" autocomplete="off"></div>
								</div>
								<div class="form-group"><label class="col-sm-1 control-label">Text</label>
									<div class="col-sm-10"><input type="text" name="text" value="" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-1">
										<button id="supbtn" class="btn btn-primary" name="submit" type="submit">Send</button>
									</div>
								</div>
							</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- footer -->
		<?php require("layout/footer.php") ?>
		<!-- ./fotter -->
	</div>
</div>

<!-- Mainly scripts -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins/toastr/toastr.min.js"></script>
<script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/plugins/pace/pace.min.js"></script>

<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script>
    $("#support_ticket").on('submit',(function(e) {
	e.preventDefault();
	$.ajax({
		url: "ajax/request/account/support.php",
		type: "POST",
		data:  new FormData(this),
		dataType:  'json',
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function () {
			$('#supbtn').text('Processing...').prop('disabled', true)
		},
		success: function(r) {
			if(r.success){
				toastr.success(r.message)
			} else {
				toastr.error(r.message)
			}
		},
		error: function(){
			
			
		},
		complete: function(){
			$('#supbtn').text('Login').prop('disabled', false)
		}
   });
}));
</script>
</body>
</html>