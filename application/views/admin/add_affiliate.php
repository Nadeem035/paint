
<div class="page animsition">
    <div class="page-header">
      	<h1 class="page-title">
      		<?php error_reporting(0);
			if(isset($mode) && $mode=="edit") echo "Edit Affiliate: ".$q['title'];
			else echo "Add Affiliate";
			?>
		</h1>
      	<ol class="breadcrumb">
	        <li><a href="<?=BASEURL?>admin">Admin</a></li>
            <li><a href="<?=BASEURL?>admin/affiliate">Affiliates</a></li>
            <li>Add Affiliate</li>
      	</ol>
      	<div class="page-header-actions">
	        <a class="btn btn-sm btn-primary btn-round" href="<?=BASEURL?>" target="_blank">
          		<i class="icon md-link" aria-hidden="true"></i>
	          	<span class="hidden-xs">Website</span>
	        </a>
      	</div><!-- /page-header-actions -->
    </div><!-- /page-header -->
    <?php if (isset($_GET['msg'])):?>
		<div class="bg-success well">
			<p><?=$_GET['msg']?></p>
		</div>
	<?php endif;?>
    <div class="page-content container-fluid">
      	<div class="panel">
	        <div class="panel-body">
	          <form id="exampleFullForm" autocomplete="off" enctype="multipart/form-data" method="post" action="
	          	<?php
		  		if($mode != edit)echo BASEURL."admin/post_affiliate";
			  	else echo BASEURL."admin/update_affiliate";
		  		?>">
		  		<?php
				$required_string = "required";
				if(isset($mode) && $mode=="edit") {?>
					<input type="hidden" name="mode" value="edit" />
					<input type="hidden" name="aid" value="<?=$_GET['id']?>" />
					<input type="hidden" name="security" value="1ee344ecee344e778694777eb3323a" />
				<?php $required_string = '';
				}?>
	            <div class="row row-lg">
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Affiliate Name
								<span class="required">*</span>
							</label>
							<div class="col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="name" placeholder="Worker Name" required value="<?=$q['name']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Phone
								<span class="required">*</span>
							</label>
							<div class="col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="phone" placeholder="Phone #" required value="<?=$q['phone']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Email
								<span class="required">*</span>
							</label>
							<div class="col-lg-12 col-sm-9">
								<input type="email" class="form-control" name="email" placeholder="Email Address" required value="<?=$q['email']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Country
								<span class="required">*</span>
							</label>
							<div class="col-lg-12 col-sm-9">
								<select name="country" class="form-control">
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
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">City
								<span class="required">*</span>
							</label>
							<div class="col-lg-12 col-sm-9">
								<select name="city" class="form-control">
									<?php if ($q['city'] == 'lahore'): ?>
										<option value="lahore" selected>Lahore</option>
										<option value="multan">Multan</option>
									<?php elseif ($q['city'] == 'multan'): ?>
										<option value="multan" selected>Multan</option>
										<option value="lahore">Lahore</option>
									<?php else: ?>
										<option value="">Select City</option>
										<option value="lahore">Lahore</option>
										<option value="multan">Multan</option>
									<?php endif ?>
								</select>
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Address
								<span class="required">*</span>
							</label>
							<div class="col-lg-12 col-sm-9">
								<textarea name="address" class="form-control" rows="5"><?=$q['address']?></textarea>
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Profit %
								<span class="required">*</span>
							</label>
							<div class="col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="profit_per" placeholder="Profit %" required value="<?=$q['profit_per']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<?php if ($mode != 'edit'): ?>
		              	<div class="col-lg-12 form-horizontal">
							<div class="form-group form-material">
								<label class="col-lg-12 col-sm-3 control-label">Password
									<span class="required">*</span>
								</label>
								<div class="col-lg-12 col-sm-9">
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div><!-- /12 -->
							</div><!-- /form-group -->
		              	</div><!-- /12/form-horizontal -->
	              	<?php else: ?>
	              		<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Status
								<span class="required">*</span>
							</label>
							<div class="col-lg-4 col-sm-9">
			                  	<select class="form-control" name="status" value="<?=$q['status']?>">
								<?php	
									if ($mode == 'edit' && $q['status'] == 'inactive')
									{
								?>
									<option value="inactive" selected="selected">Inactive</option>
									<option value="active">Active</option>
								<?php	
									}
									elseif ($mode == 'edit' && $q['status'] == 'active')
									{
								?>
									<option value="inactive">Inactive</option>
									<option value="active" selected="selected">Active</option>
								<?php
									}
									else
									{
								?>
										<option value="" selected="selected">*--* Select *--*</option>
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
								<?php  
									}
								?>	
			                  </select>
			                </div>
			            </div>
	              	<?php endif ?>
	              	<div class="form-group form-material col-lg-12 text-right padding-top-m">
	                	<button type="submit" class="btn btn-primary">Submit</button> <a class="btn btn-danger waves-effect waves-light" href="<?=BASEURL?>admin/cat" class="cancel">Cancel</a>
	              	</div><!-- /form-group -->
	            </div><!-- /row/row-lg -->
	          </form>
	        </div><!-- /panel-body -->
      </div><!-- /panel -->
    </div>
</div><!-- /page/animsition -->
<?php $menu = 'cat'; ?>