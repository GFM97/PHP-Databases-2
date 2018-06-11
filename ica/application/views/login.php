<div class="container-fluid">
	<div class="row justify-content-md-center">
		<div class="card-wrapper">
			<div class="card fat">
				<div class="card-body">
					<h4 class="card-title">Login</h4>
					<?=form_open('login/submit');?>

						<div class="form-group">
							<label for="email">E-Mail Address</label>

							<input id="email" type="email" class="form-control" name="email" required autofocus>
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" type="password" class="form-control" name="password" required data-eye>
						</div>

						<div class="form-group no-margin">
							<button type="submit" class="btn btn-primary btn-block" >
								<?=anchor('backend', 'Login')?>
							</button>
						</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
	</div>
</div>
