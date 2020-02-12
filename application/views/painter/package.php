<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="list-group">
					<?php if ($user['package_id'] < 1): ?>
						<li class="list-group-item"><a href="<?=BASEURL?>painter/logout">Logout</a></li>
					<?php else: ?>
						<li class="list-group-item"><a href="<?=BASEURL?>painter/dashboard">Dashboard</a></li>
						<li class="list-group-item"><a href="<?=BASEURL?>painter/package" class="active">Packages</a></li>
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
						<li class="list-group-item"><a href="<?=BASEURL?>painter/account-setting">Account Setting</a></li>
						<li class="list-group-item"><a href="<?=BASEURL?>painter/change-password">Change Password</a></li>
						<li class="list-group-item"><a href="<?=BASEURL?>painter/logout">Logout</a></li>
					<?php endif ?>
				</ul>
			</div><!-- /4 -->
			<div class="col-md-8">
	            <div class="col-md-offset-2 col-md-10">
	                <div class="signup-form">
	                	<div id="alert"></div>   
	                	<div class="form-title">
                            <div class="form-block-title">
                            	<h2>Package</h2>
                            </div>
                            <h4>Welcome <?=$user['name']?></h4>
                            <hr>
                            <style>
                            	.clear{clear: both;}
                            	strong.left{
                            		float: left;
                            	}
                            	strong.right{
                            		float: right;
                            	}
                            </style>
                            <div>
                            	<div class="clear"></div>
	                            <strong class="left"></strong>
	                            <strong class="right"></strong>
                            	<div class="clear"></div>
                            </div>
                        </div>
                        <form action="<?=BASEURL?>painter/package_purchase" method="post">
	                        <div class="form-group">
		                        <label for="package">Select Package</label>
		                        <select name="package_id" id="package" class="form-control" required>
		                        	<option value="">Select Package</option>
		                        	<?php foreach ($package as $key => $p): ?>
		                        		<option value="<?=$p['package_id']?>" data-price="<?=$p['price']?>" data-name="<?=$p['name']?>"><?=$p['name']?></option>
		                        	<?php endforeach ?>
		                        </select>
	                        </div>
	                        <div class="form-group">
		                        <label>Select Package</label>
		                        <select name="payment_method" class="form-control" required>
		                        	<option value="paypal">Paypal</option>
		                        </select>
	                        </div>
	                        <div class="form-group">
		                        <label>Account Info</label>
		                        <input type="text" class="form-control" name="account_info" required>
	                        </div>
	                        <div class="form-group">
		                        <label>Amount</label>
		                        <input type="text" class="form-control" name="amount" required>
	                        </div>
	                        <div class="form-group">
	                        	<input type="submit" value="Submit" class="btn btn-primary">
	                        </div>
                        </form>
	                </div><!-- /signup-form -->
	            </div><!-- /6 -->
			</div><!-- /8 -->
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /dashboard -->
<script>
	$(function () {
		$('#package').on('change', function() {
			var price = $('option:selected', this).attr('data-price');
			var name = $('option:selected', this).attr('data-name');
			$('strong.left').text('Package Name: ' + name);
			$('strong.right').text('Price: ' + price);
		});
	})
</script>