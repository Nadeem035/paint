<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="list-group">
					<li class="list-group-item"><a href="<?=BASEURL?>painter/dashboard">Dashboard</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/package">Packages</a></li>
					<li class="list-group-item">
						<span class="badge"><?=$count['count']?></span>
						<a href="javascript://" class="dropdown-class">Leads <i class="fa fa-caret-down"></i></a>
						<ul class="menu-drop">
                            <li><a href="<?=BASEURL?>painter/leads">All</a></li>
                            <li><a href="<?=BASEURL?>painter/leads/pending">Pending</a></li>
                            <li><a href="<?=BASEURL?>painter/leads/valid">Valid</a></li>
                            <li><a href="<?=BASEURL?>painter/leads/invalid">Invalid</a></li>
                        </ul>
					</li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/account-setting">Account Setting</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/change-password" class="active">Change Password</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/logout">Logout</a></li>
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
	                    <form action="<?=BASEURL?>painter/change-account-password" method="post" id="change-password">
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
		        	window.location.href = "<?=BASEURL?>painter/logout";
		        }else{
		        	$('#alert').html('<div class="alert alert-danger">'+resp.msg+'</div>')
		        }
		    });
		});
	})
</script>