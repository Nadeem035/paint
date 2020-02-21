<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="list-group">
					<li class="list-group-item"><a href="<?=BASEURL?>painter/dashboard" class="active">Dashboard</a></li>
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
					<li class="list-group-item"><a href="<?=BASEURL?>painter/account-setting">Account Setting</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/change-password">Change Password</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/logout">Logout</a></li>
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
                                    <h4>Today Leads</h4>
                                    <h2><?=$total['total_today']?></h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="blocks">
                                    <h4>This Week Leads</h4>
                                    <h2><?=$total['total_week']?></h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="blocks">
                                    <h4>This Month Leads</h4>
                                    <h2><?=$total['total_month']?></h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="blocks">
                                    <h4>This Year Leads</h4>
                                    <h2><?=$total['total_year']?></h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="blocks">
                                    <h4>Total Pay</h4>
                                    <h2><?=$pay['total']?></h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="blocks">
                                    <h4>Today Pay</h4>
                                    <?php if ($pay['total_today']): ?>
                                        <h2><?=$pay['total_today']?></h2>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="blocks">
                                    <h4>This Week Pay</h4>
                                    <h2><?=$pay['total_week']?></h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="blocks">
                                    <h4>This Month Pay</h4>
                                    <h2><?=$pay['total_month']?></h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="blocks">
                                    <h4>This Year Pay</h4>
                                    <h2><?=$pay['total_year']?></h2>
                                </div>
                            </div>
                    	</div>
                    </div>
                </div><!-- /signup-form -->
			</div><!-- /8 -->
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /dashboard -->