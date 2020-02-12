
<div class="page animsition">
    <div class="page-header">
      	<h1 class="page-title">
      		<?php error_reporting(0);
			if(isset($mode) && $mode=="edit") echo "Edit Category: ".$q['title'];
			else echo "Add Category";
			?>
		</h1>
      	<ol class="breadcrumb">
	        <li><a href="<?=BASEURL?>admin">Admin</a></li>
            <li><a href="<?=BASEURL?>admin/cat">Categories</a></li>
            <li>Add Category</li>
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
		  		if($mode != edit)echo BASEURL."admin/post_cat";
			  	else echo BASEURL."admin/update_cat";
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
							<label class="col-lg-12 col-sm-3 control-label">Category Name
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="name" placeholder="Category Name" required value="<?=$q['name']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="col-lg-12 form-horizontal">
		                <div class="example-wrap">
							<h4 class="example-title">Icon</h4>
							<div class="example">
								<input type="file" id="input-file-now-icon" data-plugin="dropify" required data-default-file="<?=UPLOADS.$q['icon']?>"/>
								<input type="text" name="icon" required value="<?=$q['icon']?>" hidden>
							</div><!-- /example -->
						</div><!-- /example-wrap -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Detail
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<textarea name="detail" rows="10" class="form-control" placeholder="Category Name"><?=$q['detail']?></textarea>
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="col-lg-12 form-horizontal">
		                <div class="example-wrap">
							<h4 class="example-title">IMG</h4>
							<div class="example">
								<input type="file" id="input-file-now-img" data-plugin="dropify" required data-default-file="<?=UPLOADS.$q['img']?>"/>
								<input type="text" name="img" required value="<?=$q['img']?>" hidden>
							</div><!-- /example -->
						</div><!-- /example-wrap -->
	              	</div><!-- /12/form-horizontal -->
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

<script>
$(function(){
	$("#input-file-now-img").on('change',function(){
		$("#validateButton1").text('Wait File Is Uploading');
		var data = new FormData();
    	data.append('img', $(this).prop('files')[0]);
	    $.ajax({
	        type: 'POST',
	        processData: false,
	        contentType: false,
	        data: data,
	        url: '<?=BASEURL?>admin/post-photo-ajax',
	        dataType : 'json',
	        success: function(resp){
	       		if (resp.status == true)
	       		{
	       			$("#validateButton1").removeAttr('disabled');
	       			$("#validateButton1").text('Submit');
	       			$("input[name='img']").val(resp.img);
	       		}
	       		else
	       		{
	       			alert(resp.msg)
	       			$("#validateButton1").text('Upload An Iange First');
	       		}
	        }
	    });
	})
	$("#input-file-now-icon").on('change',function(){
		$("#validateButton1").text('Wait File Is Uploading');
		var data = new FormData();
    	data.append('img', $(this).prop('files')[0]);
	    $.ajax({
	        type: 'POST',
	        processData: false,
	        contentType: false,
	        data: data,
	        url: '<?=BASEURL?>admin/post-photo-ajax',
	        dataType : 'json',
	        success: function(resp){
	       		if (resp.status == true)
	       		{
	       			$("#validateButton1").removeAttr('disabled');
	       			$("#validateButton1").text('Submit');
	       			$("input[name='icon']").val(resp.img);
	       		}
	       		else
	       		{
	       			alert(resp.msg)
	       			$("#validateButton1").text('Upload An Iange First');
	       		}
	        }
	    });
	})
})
</script>