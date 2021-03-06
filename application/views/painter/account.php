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
                            <li><a href="<?=BASEURL?>painter/leads/successful">Successful</a></li>
                            <li><a href="<?=BASEURL?>painter/leads/reject">Reject</a></li>
                        </ul>
                    </li>
                    <li class="list-group-item"><a href="<?=BASEURL?>painter/transactions">Transactions</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/account-setting" class="active">Account Setting</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/change-password">Change Password</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/logout">Logout</a></li>
				</ul>
			</div><!-- /4 -->
			<div class="col-md-9">
	            <div class="col-md-offset-1 col-md-11">
	                <div class="signup-form">
	                	<div id="alert"></div>   
	                	<div class="form-title">
                            <div class="form-block-title">
                            	<h2>Account Setting</h2>
                            </div>
                            <h4>Change Account Setting</h4>
                        </div>
	                    <form action="<?=BASEURL?>painter/change-account-setting" method="post" id="change-setting">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small-font">Name</label>
                                        <input type="text" class="form-control" id="name" value="<?=$user['name']?>" required name="name">
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small-font">Phone</label>
                                        <input type="text" class="form-control" id="phone" value="<?=$user['phone']?>" required name="phone">
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small-font">Email</label>
                                        <input type="email" class="form-control" value="<?=$user['email']?>" required disabled>
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small-font">Country</label>
                                        <select name="country" class="form-control" required>
                                        	<?php if ($user['country'] == 'pakistan'): ?>
                                                <option value="pakistan" selected>Pakistan</option>
                                                <option value="india">India</option>
                                            <?php elseif ($user['country'] == 'india'): ?>
                                                <option value="india" selected>India</option>
                                                <option value="pakistan">Pakistan</option>
                                            <?php else: ?>
								                <option value="">Select Country</option>
                                                <option value="pakistan">Pakistan</option>
                                                <option value="india">India</option>
                                            <?php endif ?>
								        </select>
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small-font">City</label>
                                        <select name="city" class="form-control" required >
                                        	<?php if ($user['city'] == 'lahore'): ?>
                                                <option value="lahore" selected>Lahore</option>
                                                <option value="multan">Multan</option>
                                            <?php elseif ($user['city'] == 'multan'): ?>
                                                <option value="multan" selected>Multan</option>
                                                <option value="lahore">Lahore</option>
                                            <?php else: ?>
                                                <option value="">Select City</option>
                                                <option value="lahore">Lahore</option>
                                                <option value="multan">Multan</option>
                                            <?php endif ?>
						                </select>
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-6">
			                    	<?php 
			                    		$service = explode(',', $user['services']);
			                    	?>
                                    <div class="form-group">
                                    	<label class="small-font">Services</label>
					                    <select class="services form-control" name="services[]" multiple>
					                        <?php foreach ($cat as $key => $c): ?>
					                        	<?php if (in_array($c['category_id'], $service)): ?>
					                            	<option value="<?=$c['category_id']?>" selected><?=$c['name']?></option>
					                        	<?php else: ?>
					                            	<option value="<?=$c['category_id']?>"><?=$c['name']?></option>
					                        	<?php endif ?>
					                        <?php endforeach ?>
					                    </select>
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="small-font">Address</label>
                                        <textarea name="address" id="address" class="form-control" rows="5"><?=$user['address']?></textarea>
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" value="Update Setting">
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
		$("#change-setting").on('submit', function(e) {
		    e.preventDefault();

		    $this = $(this);
		    $url = $this.attr('action');
		    $.post($url, {data: $this.serialize()}, function(resp) {
		        resp = JSON.parse(resp);
		        if (resp.status == true) {
                    $("#name").val(resp.data.name);
                    $("#phone").val(resp.data.phone);
                    $("#address").val(resp.data.address);
		        	$('#alert').html('<div class="alert alert-success">'+resp.msg+'</div>')
		        }else{
		        	$('#alert').html('<div class="alert alert-danger">'+resp.msg+'</div>')
		        }
		    });
		});
	})
</script>