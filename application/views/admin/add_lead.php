
<div class="page animsition">
    <div class="page-header">
      	<h1 class="page-title">
      		<?php error_reporting(0);
			if(isset($mode) && $mode=="edit") echo "Edit Lead: ".$q['title'];
			else echo "Add Lead";
			?>
		</h1>
      	<ol class="breadcrumb">
	        <li><a href="<?=BASEURL?>admin">Admin</a></li>
            <li><a href="<?=BASEURL?>admin/lead">Leads</a></li>
            <li>Add Lead</li>
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
		  		if($mode != edit)echo BASEURL."admin/post_lead";
			  	else echo BASEURL."admin/update_lead";
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
							<label class="col-lg-12 col-sm-3 control-label">Lead Name
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="name" placeholder="Lead Name" required value="<?=$q['name']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->	              	
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Phone
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="phone" placeholder="Phone" required value="<?=$q['phone']?>">
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
							<label class="col-lg-12 col-sm-3 control-label">Services
								<span class="required">*</span>
							</label>
							<?php 
	                    		$service = explode(',', $q['services']);
	                    	?>
							<div class="col-lg-12 col-sm-9">
								<select class="services form-control" name="services[]" multiple>
			                        <?php foreach ($cat as $key => $c): ?>
			                        	<?php if (in_array($c['category_id'], $service)): ?>
			                            	<option value="<?=$c['category_id']?>" selected><?=$c['name']?></option>
			                        	<?php else: ?>
			                            	<option value="<?=$c['category_id']?>"><?=$c['name']?></option>
			                        	<?php endif ?>
			                        <?php endforeach ?>
			                    </select>
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="form-group form-material">
						<label class="col-lg-12 col-sm-3 control-label">Status
							<span class="required">*</span>
						</label>
						<div class="col-lg-4 col-sm-9">
		                  	<select class="form-control" id="status" name="status" value="<?=$q['status']?>">
							<?php	
								if ($mode == 'edit' && $q['status'] == 'invalid')
								{
							?>
								<option value="new">New</option>
								<option value="invalid" selected="selected">Invalid</option>
								<option value="valid">Valid</option>
							<?php	
								}
								elseif ($mode == 'edit' && $q['status'] == 'valid')
								{
							?>
								<option value="new">New</option>
								<option value="invalid">Invalid</option>
								<option value="valid" selected="selected">Valid</option>
							<?php	
								}
								elseif ($mode == 'edit' && $q['status'] == 'new')
								{
							?>
								<option value="invalid">Invalid</option>
								<option value="valid">Valid</option>
								<option value="new" selected="selected">New</option>
							<?php
								}
								else
								{
							?>
									<option value="" selected="selected">*--* Select *--*</option>
									<option value="new">New</option>
									<option value="valid">Valid</option>
									<option value="invalid">Invalid</option>
							<?php  
								}
							?>	
		                  </select>
		                </div>
		            </div>
		            <?php if ($q['status'] == 'invalid'): ?>
		            	<div class="col-lg-12 form-horizontal">
							<div class="form-group form-material">
								<label class="col-lg-12 col-sm-3 control-label">InValid Reason</label>
								<div class="col-lg-12 col-sm-9">
									<textarea class="form-control" name="invalid_reason" rows="3" placeholder="Invalid Reason"><?=$q['invalid_reason']?></textarea>
								</div><!-- /12 -->
							</div><!-- /form-group -->
		              	</div><!-- /12/form-horizontal -->
		            <?php else: ?>
			            <div class="col-lg-12 form-horizontal" id="reason" style="display: none;">
							<div class="form-group form-material">
								<label class="col-lg-12 col-sm-3 control-label">InValid Reason</label>
								<div class="col-lg-12 col-sm-9">
									<textarea class="form-control" name="invalid_reason" rows="3" placeholder="Invalid Reason"><?=$q['invalid_reason']?></textarea>
								</div><!-- /12 -->
							</div><!-- /form-group -->
		              	</div><!-- /12/form-horizontal -->
		            <?php endif ?>
	              	<div class="form-group form-material col-lg-12 text-right padding-top-m">
	                	<button type="submit" class="btn btn-primary" id="validateButton1">Submit</button> 
	                	<a class="btn btn-danger waves-effect waves-light" href="<?=BASEURL?>admin/cat" class="cancel">Cancel</a>
	              	</div><!-- /form-group -->
	            </div><!-- /row/row-lg -->
	          </form>
	        </div><!-- /panel-body -->
      </div><!-- /panel -->
    </div>
</div><!-- /page/animsition -->
<?php $menu = 'cat'; ?>
<script>
	$(function () {
		$('#status').on('change', function() {
			var val_ = $(this).val();
			if (val_ == 'invalid') {
				$('#reason').css('display', 'block');
			}else{
				$('#reason').css('display', 'none');
			}
		});
	})
</script>