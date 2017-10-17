$('document').ready(function(){
	$('#uploadQtnsList').DataTable();
	
	$('.delete-btn').each(function(){
		$(this).on('click', function(){
			$(this).parent().parent().remove();
		});
	});

	$(".edit").each(function(){
		selectedItem = $(this);
		selectedItem.click(function(){
			index = $(this).attr("data-index");
			id = $(this).attr("data-questionid");
			fnEditQuestion(index, id);
		});
	});
	
	///// Display question order page /////
	//Sortable for practice and test questions in display order page
	/*
	$( "#practiceSortable" ).sortable({
		distance:30
	});
	*/
	
	//Sortable for test questions in display order page
	$( "#testSortable" ).sortable({
		//distance:30
	});
	
	//Save the sorted questions order for practice and test questions through ajax in pitch_questions_order table
	$('.saveBtn').on("click", "#saveQuestionOrder", function () {
		var questionsOrder = {};
		//questionsOrder['practice'] = $("#practiceSortable").sortable("toArray");
		questionsOrder['test'] = $("#testSortable").sortable("toArray");
		
		swal({
		  title: "Are you sure?",
		  text: "You want to save this question order!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-primary",
		  confirmButtonText: "Save",
		  closeOnConfirm: false
		},
		function(){
			var url = strBaseURL+'uploadquestions/save_question_order'; 
			var formData = {
				"question_order"  : questionsOrder
			};
			
			$.ajax({
				type: "POST",
				url: url,
				data: formData,
				success: function (result) {
					if(result == "success") 
					{
						//location.reload(true);
						swal("Success!", "Your questions order is saved successfully.", "success");
					} 
					else 
					{
						swal("Warning!", "Something went wrong.", "warning");
					}
				},
				error: function (err) {
					console.log(err);
				}
			}); 
		});
		
    }); 
	
});

function fnValidateQuestionUpload()
{
	
}

function fnDeleteQuestion(question_id, active)
{
	if(question_id)
	{
		$.ajax({
			'type'		: 'POST',
			'url'		: strBaseURL+'uploadquestions/deletequestion', 
			'ajax' 		: true,
			'data' 		: { questionid : question_id, active : active },
			'success' 	: function(){},
			'failure' 	: function(){}
		});
	}
}

function fnIncludeInScore(question_id, includeinscore)
{
	if(question_id)
	{
		$.ajax({
			'type'		: 'POST',
			'url'		: strBaseURL+'uploadquestions/includeinscore', 
			'ajax' 		: true,
			'data' 		: { questionid : question_id, includeinscore : includeinscore },
			'success' 	: function(){},
			'failure' 	: function(){}
		});
	}
}

function fnEditQuestion(index, question_id)
{
	if(question_id && arrQuestions.length)
	{
		if(arrQuestions[index])
		{
			$("#sleFile").attr("disabled", true);
			$("#hdnQuestionID").val(arrQuestions[index]['id']);
			$("#sleItemCode").val(arrQuestions[index]['questioncode']);
			$("#cboOptionColor").val(arrQuestions[index]['optioncolor']);
			$("#cboOptionCount").val(arrQuestions[index]['optionscount']);
			$("#cboCorrectAnswer").val(arrQuestions[index]['answer']);
			$("#cboQuestionLevel").val(arrQuestions[index]['questionlevel']);
		}
	}
}