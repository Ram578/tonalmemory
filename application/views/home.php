<?=$Header;?>
	<div class="intro-wrapper registrer-wrapper">
	<!-- Registration Block goes here -->
         <form class="form-horizontal col-lg-4 col-md-5 col-sm-6 col-xs-6" role="form" id="ToneRegisterForm" action="home/register" method="POST" autocomplete="false">
         		<?php
         			print_r($this->session->flashdata('Errors'));
         		?>
                <!--h2>Registration Form</h2-->
                <div class="form-group">
                    <label for="sleFirstName" class="col-sm-4 control-label">First Name : </label>
                    <div class="col-sm-8">
                        <input type="text" id="sleFirstName" placeholder="First Name" class="form-control" maxlength="30" minlength="2" name="firstname" autocomplete="false" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="sleLastName" class="col-sm-4 control-label">Last Name : </label>
                    <div class="col-sm-8">
                         <input type="text" id="sleLastName" placeholder="Last Name" class="form-control" maxlength="30" minlength="2" name="lastname" autocomplete="false" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="sleAge" class="col-sm-4 control-label">Age in Years : </label>
                    <div class="col-sm-8">
                        <input type="text" id="sleAge" class="form-control" maxlength="3" name="age" autocomplete="false" />
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="control-label col-sm-4">Gender : </label>
                    <input type="hidden" name="gender" id="hdnGender">
                    <div class="col-sm-6">
                        <div class="row">
                             <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" id="rdMaleGender" value="Male" name="sex" onclick="$('#hdnGender').val($(this).val());">Male
                                </label>
                            </div>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" id="rdFeMaleGender" name="sex" value="Female" onclick="$('#hdnGender').val($(this).val());">Female
                                </label>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.form-group -->
               <div class="form-group">
                    <label for="sleFileNumber" class="col-sm-4 control-label">File Number :</label>
                    <div class="col-sm-8">
                         <input type="text" id="sleFileNumber" placeholder="File Number" class="form-control" name="filenumber" value="103B-D-2017-" autocomplete="false" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-4">
                        <button disabled="disabled" type="submit" id="RegisterBtn" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form> <!-- /form -->
    	<!-- Registration Block ends here -->
		</div>
		<!-- JS files will load here -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="resources/js/formValidator.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#ToneRegisterForm').bootstrapValidator({
					message: 'This value is not valid',
					fields: {
						firstname: {
							validators: {
								notEmpty: {
									message: 'The firstname is required and can\'t be empty'
								},
								stringLength: {
									min: 2,
									max: 30,
									message: 'The firstname must be more than 1 and less than 30 characters long'
								},
								regexp: {
									regexp: /^[a-zA-Z0-9_\.]+$/,
									message: 'The firstname can only consist of alphabetical, number, dot and underscore'
								}
							}
						},
					   lastname: {
							validators: {
								notEmpty: {
									message: 'The lastname is required and can\'t be empty'
								},
								stringLength: {
									min: 2,
									max: 30,
									message: 'The lastname must be more than 1 and less than 30 characters long'
								},
								regexp: {
									regexp: /^[a-zA-Z0-9_\.]+$/,
									message: 'The lastname can only consist of alphabetical, number, dot and underscore'
								}
							}
						},
						age: {
							validators: {
								notEmpty: {
									message: 'The age is required and can\'t be empty'
								},
								stringLength: {
									min: 1,
									max: 3,
									message: 'The age must be more than 1 and less than 3 characters long'
								},
								regexp: {
									regexp: /^[0-9]+$/,
									message: 'The age can only consist of number'
								}
							}
						},
						gender: {
							validators: {
								notEmpty: {
									message: 'The gender is required and can\'t be empty'
								}
							}
						},
						fileNumber: {
							validators: {
								notEmpty: {
									message: 'The file Number is required and can\'t be empty'
								},
								
								regexp: {
									regexp: /^[a-zA-Z0-9-]+$/,
									message: 'The File Number can only consist of alphabetical, number, Hypen'
								}
							}
						},
					  
						
					}
				});
			});
		</script>
<?=$Footer;?>