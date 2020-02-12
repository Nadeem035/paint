<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="list-group">
					<li class="list-group-item"><a href="<?=BASEURL?>affiliate/dashboard" class="active">Dashboard</a></li>
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
					<li class="list-group-item"><a href="<?=BASEURL?>affiliate/change-password">Change Password</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>affiliate/logout">Logout</a></li>
				</ul>
			</div><!-- /4 -->
			<div class="col-md-9">
                <div class="signup-form">
                	<div id="alert"></div>   
                	<div class="form-title">
                        <div class="form-block-title">
                        	<h2>Dashboard</h2>
                        </div>
                        <h4>Welcome <?=$user['name']?></h4>
                    </div>
                    <label>Affiliate Reference Link:</label>
                    <div class="url">
                    	<input type="text" value="<?=BASEURL.'lead/'.$user['link']?>" class="form-control">
                    </div><br>
                    <div class="block-section">
                    	<div class="row">
                    		<div class="col-md-4">
                    			<div class="blocks">
                    				<h4>Total Leads</h4>
                    				<h2><?=$total['total']?></h2>
                    			</div>
                    		</div>
                    		<div class="col-md-4">
                    			<div class="blocks">
                    				<h4>New Leads</h4>
                    				<h2><?=$total['total_new']?></h2>
                    			</div>
                    		</div>
                    		<div class="col-md-4">
                    			<div class="blocks">
                    				<h4>Valid Leads</h4>
                    				<h2><?=$total['total_valid']?></h2>
                    			</div>
                    		</div>
                    		<div class="col-md-4">
                    			<div class="blocks">
                    				<h4>Invalid Leads</h4>
                    				<h2><?=$total['total_invalid']?></h2>
                    			</div>
                    		</div>
                    		<?php foreach ($package as $key => $p): ?>
                    			<?php if ($p['p_name'] != null): ?>
		                    		<div class="col-md-4">
		                    			<div class="blocks">
		                    				<h4><?=$p['p_name']?> Leads</h4>
		                    				<h2><?=$p['c']?></h2>
		                    			</div>
		                    		</div>
                    			<?php endif ?>
                    		<?php endforeach ?>
                    	</div>
                    </div>
                </div><!-- /signup-form -->
			</div><!-- /8 -->
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /dashboard -->