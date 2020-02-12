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
                            	<h2>Generate Lead</h2>
                            </div>
                            <h4>Generate Lead</h4>
                        </div>
	                    <form action="<?=BASEURL?>affiliate/post_lead" method="post">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <label class="small-font">Name</label>
                                        <input type="text" class="form-control" required name="name">
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <label class="small-font">Phone</label>
                                        <input type="text" class="form-control" required name="phone">
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <label class="small-font">Country</label>
                                        <select name="country" class="form-control" required>
                                        	<?php if ($q['country'] == 'pakistan'): ?>
                                                <option value="pakistan" selected>Pakistan</option>
                                                <option value="india">India</option>
                                            <?php elseif ($q['country'] == 'india'): ?>
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
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <label class="small-font">Services</label>
                                        <select class="services form-control" name="services[]" multiple>
					                        <?php foreach ($cat as $key => $c): ?>
					                            <option value="<?=$c['category_id']?>"><?=$c['name']?></option>
					                        <?php endforeach ?>
					                    </select>
                                    </div><!-- /form-group -->
                                </div><!-- /3 -->
                                <div class="col-md-offset-1 col-md-10">
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" value="Generate Lead">
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