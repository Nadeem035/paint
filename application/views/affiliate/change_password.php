<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="list-group">
					<li class="list-group-item"><a href="<?=BASEURL?>affiliate/dashboard">Dashboard</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>affiliate/package">Packages</a></li>
					<li class="list-group-item">
						<!-- <span class="badge">14</span> -->
						<a href="javascript://" class="dropdown-class">Leads <i class="fa fa-caret-down"></i></a>
						<ul class="menu-drop">
                            <li><a href="<?=BASEURL?>affiliate/leads">All</a></li>
                            <li><a href="<?=BASEURL?>affiliate/leads/new">New</a></li>
                            <li><a href="<?=BASEURL?>affiliate/leads/active">Active</a></li>
                            <li><a href="<?=BASEURL?>affiliate/leads/inactive">Inactive</a></li>
                        </ul>
					</li>
					<li class="list-group-item"><a href="<?=BASEURL?>affiliate/transactions">Transactions</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>affiliate/account-setting">Account Setting</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>affiliate/change-password" class="active">Change Password</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>affiliate/logout">Logout</a></li>
				</ul>
			</div><!-- /4 -->
			<div class="col-md-8">
	            <div class="col-md-offset-2 col-md-10">
	                <div class="signup-form">
	                	<div id="alert"></div>   
	                	<div class="form-title">
                            <div class="form-block-title">
                            	<h2>Change Password</h2>
                            </div>
                            <h4>Change Password</h4>
                        </div>
	                    <form action="<?=BASEURL?>affiliate/change-account-password" method="post" id="change-password">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <label class="small-font">Old Password</label>
                                        <input type="password" class="form-control" required name="password">
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <label class="small-font">New Password</label>
                                        <input type="password" class="form-control" required name="new-password">
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <label class="small-font">Confirm Password</label>
                                        <input type="password" class="form-control" required name="confirm-password">
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" value="Update Password">
                                    </div>
                                </div><!-- /3 -->
                            </div><!-- /row -->
                        </form>
	                </div><!-- /signup-form -->
	            </div><!-- /6 -->
			</div><!-- /8 -->
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /dashboard -->

<script>
	$(function () {
		$("#change-password").on('submit', function(e) {
		    e.preventDefault();

		    $this = $(this);
		    $url = $this.attr('action');
		    $.post($url, {data: $this.serialize()}, function(resp) {
		        resp = JSON.parse(resp);
		        if (resp.status == true) {
		        	window.location.href = "<?=BASEURL?>affiliate/logout";
		        }else{
		        	$('#alert').html('<div class="alert alert-danger">'+resp.msg+'</div>')
		        }
		    });
		});
	})
</script>