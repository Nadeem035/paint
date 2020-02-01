
<div class="page animsition">
    <div class="page-header">
      	<h1 class="page-title">
      		<?php error_reporting(0);
			if(isset($mode) && $mode=="edit") echo "Edit Package: ".$q['title'];
			else echo "Add Package";
			?>
		</h1>
      	<ol class="breadcrumb">
	        <li><a href="<?=BASEURL?>admin">Admin</a></li>
            <li><a href="<?=BASEURL?>admin/packages">Packages</a></li>
            <li>Add Package</li>
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
		  		if($mode != edit)echo BASEURL."admin/post_package";
			  	else echo BASEURL."admin/update_package";
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
							<label class="col-lg-12 col-sm-3 control-label">Package Name
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="name" placeholder="Package Name" required value="<?=$q['name']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Package Detail
								<span class="required">*</span>
							</label>
							<div class="col-lg-12 col-sm-9">
								<textarea class="form-control" placeholder="Package Detail" name="detail" rows="5"><?=$q['detail']?></textarea>
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Package Price
								<span class="required">*</span>
							</label>
							<div class="col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="price" placeholder="Package Price" required value="<?=$q['price']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<?php if ($mode == 'edit'): ?>
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
	                	<button type="submit" class="btn btn-primary" id="validateButton1">Submit</button> <a class="btn btn-danger waves-effect waves-light" href="<?=BASEURL?>admin/cat" class="cancel">Cancel</a>
	              	</div><!-- /form-group -->
	            </div><!-- /row/row-lg -->
	          </form>
	        </div><!-- /panel-body -->
      </div><!-- /panel -->
    </div>
</div><!-- /page/animsition -->
<?php $menu = 'cat'; ?>