function validateJobSubmission()
{
	var message = $.trim($('#message').val());	
	var check = true;
	if($('#terms').prop('checked') == false)
	{
		$('#error_msg').fadeIn("fast", function() { $(this).delay(2000).fadeOut("slow"); });
		check = false;
	}
	
	return check;
}

function checkJob()
{
	var expert_id = $.trim($('#expert_id').val());
	var check = true;
	if(expert_id == '')
	{	
		$('#error_msg').fadeIn("fast", function() { $(this).delay(2000).fadeOut("slow"); });
		check = false;
	}
	
	return check;
}

function watch(id)
{
	if(id != '' || id != '')
	{
		$('#spinner').show();

		$.ajax({
		  type: 'POST',
		  url: 'lib/api.php',
		  dataType: "JSON",
		  data: { action: 'watch', job_id: id },
		  success:function(data){
			$('#spinner').hide();

		  	if(data.status == 'success')
		  	{
				$('#error_msg').html(data.msg);
				$('#error_msg').fadeIn("fast", function() { $(this).delay(2000).fadeOut("slow"); });
		  	}
		  	else if(data.status == 'error')
		  	{
				$('#success_msg').html(data.msg);
				$('#success_msg').fadeIn("fast", function() { $(this).delay(2000).fadeOut("slow"); });		  		
		  	}		  	
		  	else if(data.status == 'invalid_access_token')
		  	{
		  		window.location = data.url;
		  	}
		  },
		  error:function(){

		  }
		});		
	}

}

function submitJob(id)
{
	if(id != '' || id != '')
	{
		$('#submi_spinner').show();
		steps = [];
		$( "input[name^=steps]" ).each(function( index, val ) {
			;
			var step = $.trim($(val).val());
			if(step != '')
				steps.push(step);
		});	


		$.ajax({
		  type: 'POST',
		  url: 'lib/api.php',
		  dataType: "JSON",
		  data: { action: 'submit', job_id: id, steps: steps },
		  success:function(data){
			$('#submit_spinner').hide();
			window.location = 'job.php?id='+id;
		  },
		  error:function(){

		  }
		});		
	}

}


function reOrder()
{
	$( "#steps_div span.badge" ).each(function( index, val ) {
		;
		$(val).html(index + 1);
	});	
}

function removeStep(obj)
{
	$(obj).parent().remove();
	reOrder();
}
function addMoreSteps()
{
	html = '<div class="well span2 tile"> <span style="cursor:pointer;" onclick="removeStep(this)" aria-hidden="true" class="glyphicon glyphicon-remove"></span> <span class="badge badge-info"></span> <input style="width:95%; float:right; margin-top:-5px;" type="text" class="form-control" name="steps[]" id="steps[]"></div>';
	$('#steps_div').append(html);
	reOrder();
}
function selectExpert(expert_id, obj)
{
	$('#expert_id').val(expert_id);
	$('.user_div').removeClass('active_user');
	$(obj).addClass('active_user');
}

function redirectToSearch()
{
	window.location = 'landing.php';
}

