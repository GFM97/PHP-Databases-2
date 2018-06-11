<div class="container-fluid">
	<div class="row justify-content-md-center h-100">
		<div class="card-wrapper">
			<div class="card fat">
				<div class="card-body">
					<h4 class="card-title">Register</h4>
					<?=form_open('register/submit');?>

						<div class="form-group">
							<label for="name">Name</label>
							<input id="name" type="text" class="form-control" name="name" required autofocus>
						</div>

						<div class="form-group">
							<label for="email">E-Mail Address</label>
							<input id="email" type="email" class="form-control" name="email" required>
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" type="password" class="form-control" name="password" required data-eye>
						</div>

						<div class="form-group no-margin">
							<button type="submit" class="btn btn-primary btn-block">
								Register
							</button>
						</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
	</div>
</div>
