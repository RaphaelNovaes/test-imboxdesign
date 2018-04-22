<!-- Nav -->
<div class="container nav-heading">
    <ul class="nav nav-pills">
        <li role="presentation"><a href="<?=base_url()?>">Home</a></li>
        <li role="presentation" class="active"><a href="students">Students</a></li>
    </ul>
    <hr>
</div>
<!-- Nav -->

<!-- Content -->
<div class="container">
    <!-- <div class="alert alert-success" role="alert">Load Students here :)</div> -->
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Students</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addStudentsModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Student</span></a>
						<a href="#deleteStudentsModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
                </div>
            </div>
            <div class="table-filter">
	            <div class="row">
					<input type="text" id='search' class="form-control">
	            	<button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
				</div>
			</div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th>Fist Name</th>
						<th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id='dataTable'></tbody>
            </table>
			<div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addStudentsModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id='addForm' action="#">
					<div class="modal-header">						
						<h4 class="modal-title">Add Students</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>First Name</label>
							<input type="text" id="first_name" name="first_name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Last name</label>
							<input type="text" id="last_name" name="last_name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" id="password" name="password" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Repeat Password</label>
							<input type="password" id="password2" class="form-control" required>
							<span id='pass2err' class="error-msg" type='hidden'></span>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" id="email" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="tel" pattern="^\d{10,}$" id="phone" name="phone" class="form-control" required>
							<span class="phone-exp">e.g (9999999999) 10 digts*</span>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editStudentsModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id='editForm' action="#">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Students</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<input type="hidden" name='id_student' class="form-control" required>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>First Name</label>
							<input type="text" name='first_name' class="form-control" required>
						</div>
						<div class="form-group">
							<label>Last name</label>
							<input type="text" name='last_name' class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name='email' class="form-control" required>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" name='phone' class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Change Password Modal HTML -->
	<div id="changePassStudentsModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id='editPassForm' action="#">
					<div class="modal-header">						
						<h4 class="modal-title">Change Password</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<input type="hidden" name='id_student' class="form-control" required>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Old Password</label>
							<input type="password" name='old_password' class="form-control" required>
							<span class="error-msg"></span>
						</div>
						<div class="form-group">
							<label>New Password</label>
							<input type="password" name='password' class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteStudentsModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id='delForm'>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Students</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
						<span id='opChecked' class="error-msg"></span>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Content -->