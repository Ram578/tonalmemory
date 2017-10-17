<!DOCTYPE html>
<!--[if lt IE 7]>   <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>      <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>      <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>      <html class="no-js ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		 <title>AIMs - Admin Dashboard</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link href="<?=base_url();?>resources/css/cssBundle.css" rel="stylesheet" />
		<link href="<?=base_url();?>resources/css/admin.css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>resources/js/libraries/modernizr-2.6.2.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>resources/js/questionupload.js"></script>
		<script type="text/javascript">
			var strBaseURL = "<?=base_url();?>";
			var arrQuestions = <?php echo json_encode($Questions); ?>
		</script>
		</head>
	<body>
		
		<!-- Admin Dashboard Starts here -->
			<!-- Header goes here -->
			<nav class="navbar navbar-inverse navbar-fixed-top">
			  <div class="container">
				<div class="navbar-header">
				  <a class="navbar-brand" href="<?=base_url();?>userslist">Dashboard</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
				  <ul class="nav navbar-nav" style="float:none;">
					<li><a href="<?=base_url();?>userslist">Users List</a></li>
					<li><a href="<?=base_url();?>usertestresult">Test Result</a></li>
					<?php 
						$status = $this->session->userdata['EmployeeRole'];
						if($status == "admin") {
					?>
					<li class="dropdown active">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Test Questions<span class="caret" style="margin-left:10px;"></span></a>
						<ul class="dropdown-menu navbar-inverse">
							<li><a href="<?=base_url();?>uploadquestions">Upload Test Item</a></li>
							<li><a href="<?=base_url();?>uploadquestions/display_questions_order">Display Order</a></li>
						</ul>
					</li>
					<li><a href="<?=base_url();?>certilescores">Certile Scores</a></li>
					<li><a href="<?=base_url();?>subscores">Sub Scores</a></li>
					<?php
						}
					?>
					<li class="pull-right"><a href="<?=base_url();?>admindashboard/logout">Log Out</a></li>
				  </ul>
				</div><!--/.nav-collapse -->
			  </div>
			</nav>
			<!-- Header ends here -->
			<!-- Body Content goes here -->
				<section class="adminDashboardView">
					<div class="UserListView container">
						<div class="pull-right" style="color:#a94442; font-size:13px; padding:0 0 10px 0;">
			         		<?php
			         			print_r($this->session->flashdata('Errors'));
			         		?>
		         		</div>
						<form role="form" class="col-m-8 col-sm-8 col-xs-8 col-md-offset-2 col-sm-offset-2 col-xs-offset-2" method="POST" action="uploadquestions/uploadquestion" enctype="multipart/form-data" onsubmit="fnValidateQuestionUpload();">
						<div class="row">
								<input type="hidden" name="id" value="-1" id="hdnQuestionID">
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="uploadFile">Item Code:</label>
										<input type="text" id="sleItemCode" name="questioncode" class="form-control" placeholder="Item Code" />
									  </div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									 <div class="form-group">
									<label for="optioncolor">Choose Options Color:</label>
									<select name="optioncolor" id="cboOptionColor" class="form-control">
										<option value="-1"></option>
										<option value="green">Green</option>
										<option value="blue">Blue</option>
										<option value="yellow">yellow</option>
									</select>
								  </div>
								</div>
						  </div>
						  <div class="row">
						  		<div class="col-md-6 col-sm-6 col-xs-6">
									 <div class="form-group">
									<label for="email">Choose Options count to show:</label>
									<select name="optionscount" id="cboOptionCount" class="form-control">
										<option value="-1"></option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
								  </div>
								</div>
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="uploadFile">Please Upload Audio:</label>
										<input name="audioname" id="sleFile" type="file" class="form-control" id="uploadFile" />
									  </div>
								</div>
						  </div>
						  <div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6">
									 <div class="form-group">
									<label for="email">Choose correct Answer:</label>
									<select name="answer" id="cboCorrectAnswer" class="form-control">
										<option value="-1"></option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
								  </div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="form-group">
										<label for="uploadFile">Test Level :</label>
										<select name="questionlevel" id="cboQuestionLevel" class="form-control">
										<option value="-1"></option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
									  </div>
								</div>
						  </div>
							<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<button type="submit" class="btn btn-primary pull-right">SAVE</button>
						  </div>
						  </div>
						</form>
						<div class="testupload-data-view">
							<table width="100%" cellspacing="0" cellpadding="0" class="table table-bordered">
								<thead>
									<tr>
										<th width="10%">Item No</th>
										<th width="15%">Audio</th>
										<th width="10%">Options Count</th>
										<th width="5%">Acual Answer</th>
										<th width="10%">Test Level</th>
										<th width="10%">Action</th>
										<th width="5%">Active</th>
										<th width="5%">Includein Scoring</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach($Questions as $key => $question)
										{

											$intQuestionID = $question['id'];
											$intIncludeInScore = $question['includeinscoring'];
									?>
										<tr>
											<td><?=$question['questioncode'];?></td>
											<td><?=$question['audiofilename'];?></td>
											<td><?=$question['optionscount'];?></td>
											<td><?=$question['answer'];?></td>
											<td><?=$question['questionlevel'];?></td>
											<td>
												<a href="javascript:void(0)" class="edit" data-index="<?=$key;?>" data-questionid="<?=$question['id'];?>" id="aEditQuestion" >Edit</a> 
												<a href="javascript:void(0)" class="delete-btn" onclick=fnDeleteQuestion("<?=$question['id'];?>", "0");>Delete</a>
											</td>
											<td class="text-center">
												<input type="checkbox" name="active" <?php if($question['active']){ echo "checked"; } ?>  onchange=fnDeleteQuestion("<?=$question['id'];?>","<?php if($question['active']){ echo 0; }else{ echo 1; } ?>"); />
											</td>
											<td class="text-center">
												<input type="checkbox" name="includeinscoring" <?php if($question['includeinscoring']){ echo "checked"; } ?> onchange="fnIncludeInScore('<?=$intQuestionID;?>', '<?php if($intIncludeInScore){ echo 0; }else{ echo 1; } ?>');" />
											</td>
										</tr>
									<?php
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</section>
			<!-- Body Content ends here -->
		<!-- Admin Dashboard ends here -->
		
		<!-- JS files will load here -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit Item Test No 1</h4>
				  </div>
				  <div class="modal-body">
						<form role="form" >
						<div class="row">
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="uploadFile">Item No:</label>
										<input type="text" class="form-control" placeholder="Item Number" value="Item Test 01" />
									  </div>
								</div>
								
						  </div>
						  <div class="row">
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="uploadFile">Please Upload Audio:</label>
										<input type="file" class="form-control" id="uploadFile" />
									  </div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									 <div class="form-group">
									<label for="email">Choose Options count to show:</label>
									<select class="form-control">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
									</select>
								  </div>
								</div>
						  </div>
						  <div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6">
									 <div class="form-group">
									<label for="email">Choose correct Answer:</label>
									<select class="form-control">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
									</select>
								  </div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="form-group">
										<label for="uploadFile">Test Level :</label>
										<select class="form-control">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
									</select>
									  </div>
								</div>
						  </div>
							
						</form>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				  </div>
				</div>
			  </div>
			</div>
<?php include 'admin_footer.php'; ?>