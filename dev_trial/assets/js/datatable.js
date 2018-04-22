$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	//Charge dataTable
	getMainData();
	
	// Select/Deselect checkboxes
	$("#selectAll").click(function(){
		if(this.checked){
			$('.rowCheckBox').each(function(){
				this.checked = true;                        
			});
		} else{
			$('.rowCheckBox').each(function(){
				this.checked = false;                        
			});
		} 
	});
	$('.rowCheckBox').click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});

	//Send to create
	$('#addForm').submit(function() {

		//Valid password before submit
		var ret = matchPasswords($('#password'), $('#password2'));

		if(ret){
			$.post(
				'newStudent',
				$('#addForm').serialize(),
				'json'
			).done(function(data){
				actionAfterAjax(data.status);
			});

			$(this)[0].reset();
		
			$('#addStudentsModal .close').click();
		}

		return false;
	});

	//Send to deleted
	$('#delForm').submit(function() {

		if($.options.length > 0){
			$.post('delStudents',{'students':$.options},'json').done(function(data){
				actionAfterAjax(data.status);
			});

			delete $.options;

			$("#selectAll").prop("checked", false);

			$('#deleteStudentsModal .close').click();
		}else{
			$('#opChecked').empty();
	    	$('#opChecked').append("It didn't select data");
		}


		return false;
	});

	//Send to change
	$('#editForm').submit(function() {
		
		$.post(
			'updStudent',
			$('#editForm').serialize(),
			'json'
		).done(function(data){
			actionAfterAjax(data.status);
		});

		$(this)[0].reset();
		
		$('#editStudentsModal .close').click();

		return false;
	});

	//Send password to change
	$('#editPassForm').submit(function() {
		
		$.post(
			'updPassStudent',
			$('#editPassForm').serialize(),
			'json'
		).done(function(data){
			if(data.status !== true && data.status !== false){
				$('.error-msg', '#editPassForm').empty().append(data.status);
			}else{
				actionAfterAjax(data.status);
				$('#changePassStudentsModal .close').click();
			}
		});

		$(this)[0].reset();

		return false;
	});

	//Check row clicked delete
	$('#dataTable').on('click', '.delete', function(){
		$(this).parent().parent().find(':checkbox').prop('checked', true);
	});

	//Check row clicked edit
	$('#dataTable').on('click', '.edit', function(){
		var id = $(this).parent().parent().find(':checkbox').val();

		$.get('getStudent', {'id':id}, 'json').done(function(data){
			$.each(data.students, function(key, value) { 
				$('[name='+key+']', '#editForm').val(value);
			});
		});
	});

	//Check row clicked editpass
	$('#dataTable').on('click', '.editpass', function(){
		var id = $(this).parent().parent().find(':checkbox').val();

		$('[name=id_student]', '#editPassForm').val(id);
	});

	//Get selected rows after modal's open
	$("#deleteStudentsModal").on('shown.bs.modal', function(){
    	$.options = [];

    	$('#opChecked').empty();

	    $('[name=options\\[\\]]:checked').each(function() {

	    	$.options.push($(this).val());
	    });
	});

	//Empty modal's error message
	$("#changePassStudentsModal").on('shown.bs.modal', function(){
    	$('.error-msg', '#editPassForm').empty();
	});

	$('.table-filter .btn').click(function() {
		getMainData();
	});

	//Get main data
	function getMainData(){
		var search = $('#search').val();
		$.get('getStudents',{'search':search},'json').done(function(data){
			$('#dataTable').empty();
			if(data.status){
				$.each(data.students, addRow);
			}else{
				$('#dataTable').append($("<tr><td colspan=6><div class='alert alert-secondary' role='alert'>No Data</div></td></tr>"));
				$('#errorDBModal').modal({show:true});
			}
		});
	}

	function actionAfterAjax(status){
		if(!status)
			$('#errorDBModal').modal({show:true});
		else
			getMainData();
	}

	function addRow(key, value){
		var row = 
			"<tr>"+
				"<td>"+
					'<span class="custom-checkbox">'+
						'<input type="checkbox" class="rowCheckBox" name="options[]" value="'+value.id_student+'">'+
						'<label for=""></label>'+
					"</span>"+
				"</td>"+
                "<td>"+value.first_name+"</td>"+
                "<td>"+value.last_name+"</td>"+
				"<td>"+value.email+"</td>"+
                "<td>"+value.phone+"</td>"+
                "<td>"+
                    '<a href="#editStudentsModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>'+
                    '<a href="#deleteStudentsModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>'+
                    '<a href="#changePassStudentsModal" class="editpass" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Change Password">&#xE90D;</i></a>'+
                "</td>"+
            "</tr>";

        $('#dataTable').append(row);
	}

	function matchPasswords(field1, field2){
		if(field1.val() != field2.val()){
			$('#pass2err').html('Passwords do not match').show();
			return false;
		}else{
			$('#pass2err').empty().hide();
			return true;
		}
	}
});