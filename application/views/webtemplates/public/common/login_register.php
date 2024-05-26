<?php ?>
<div class="modal modal-primary" id="ms-account-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog animated zoomIn animated-3x" role="document">
		<div class="modal-content">
			<div class="modal-header shadow-2dp no-pb">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"> <i class="zmdi zmdi-close"></i>
					</span>
				</button>
				<div class="modal-title text-center">
					<span class="ms-logo ms-logo-white ms-logo-sm mr-1">M</span>
					<h3 class="no-m ms-site-title">
						Material <span>Style</span>
					</h3>
				</div>
				<div class="modal-header-tabs">
					<ul class="nav nav-tabs nav-tabs-full nav-tabs-3 nav-tabs-primary" role="tablist">
						<li role="presentation" class="active"><a href="#ms-login-tab" aria-controls="ms-login-tab" role="tab" data-toggle="tab" class="withoutripple"> <i class="zmdi zmdi-account"></i> Login
						</a></li>
						<li role="presentation"><a href="#ms-register-tab" aria-controls="ms-register-tab" role="tab" data-toggle="tab" class="withoutripple"> <i class="zmdi zmdi-account-add"></i> Register
						</a></li>
						<li role="presentation"><a href="#ms-recovery-tab" aria-controls="ms-recovery-tab" role="tab" data-toggle="tab" class="withoutripple"> <i class="zmdi zmdi-key"></i> Recovery Pass
						</a></li>
					</ul>
				</div>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="ms-login-tab">
						<form autocomplete="off">
							<fieldset>
								<div class="form-group label-floating">
									<div class="input-group">
										<span class="input-group-addon"> <i class="zmdi zmdi-account"></i>
										</span> <label class="control-label" for="ms-form-user">Username</label> <input type="text" id="ms-form-user" class="form-control">
									</div>
								</div>
								<div class="form-group label-floating">
									<div class="input-group">
										<span class="input-group-addon"> <i class="zmdi zmdi-lock"></i>
										</span> <label class="control-label" for="ms-form-pass">Password</label> <input type="password" id="ms-form-pass" class="form-control">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-md-6">
										<div class="form-group no-mt">
											<div class="checkbox">
												<label> <input type="checkbox"> Remember Me
												</label>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<button class="btn btn-raised btn-primary pull-right">Login</button>
									</div>
								</div>
							</fieldset>
						</form>
						
					</div>
					<div role="tabpanel" class="tab-pane fade" id="ms-register-tab">
						<form>
							<fieldset>
								<div class="form-group label-floating">
									<div class="input-group">
										<span class="input-group-addon"> <i class="zmdi zmdi-account"></i>
										</span> <label class="control-label" for="ms-form-user2">Username</label> <input type="text" id="ms-form-user2" class="form-control">
									</div>
								</div>
								<div class="form-group label-floating">
									<div class="input-group">
										<span class="input-group-addon"> <i class="zmdi zmdi-email"></i>
										</span> <label class="control-label" for="ms-form-email">Email</label> <input type="email" id="ms-form-email" class="form-control">
									</div>
								</div>
								<div class="form-group label-floating">
									<div class="input-group">
										<span class="input-group-addon"> <i class="zmdi zmdi-lock"></i>
										</span> <label class="control-label" for="ms-form-pass2">Password</label> <input type="password" id="ms-form-pass2" class="form-control">
									</div>
								</div>
								<div class="form-group label-floating">
									<div class="input-group">
										<span class="input-group-addon"> <i class="zmdi zmdi-lock"></i>
										</span> <label class="control-label" for="ms-form-pass3">Re-type Password</label> <input type="password" id="ms-form-pass3" class="form-control">
									</div>
								</div>
								<button class="btn btn-raised btn-block btn-primary">Register Now</button>
							</fieldset>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="ms-recovery-tab">
						<fieldset>
							<div class="form-group label-floating">
								<div class="input-group">
									<span class="input-group-addon"> <i class="zmdi zmdi-account"></i>
									</span> <label class="control-label" for="ms-form-user3">Username</label> <input type="text" id="ms-form-user3" class="form-control">
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="input-group">
									<span class="input-group-addon"> <i class="zmdi zmdi-email"></i>
									</span> <label class="control-label" for="ms-form-email2">Email</label> <input type="email" id="ms-form-email2" class="form-control">
								</div>
							</div>
							<button class="btn btn-raised btn-block btn-primary">Send Password</button>
						</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
