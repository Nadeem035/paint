<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="list-group">
					<li class="list-group-item"><a href="<?=BASEURL?>painter/dashboard">Dashboard</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/package">Packages</a></li>
					<li class="list-group-item">
						<span class="badge"><?=$count['count']?></span>
						<a href="javascript://" class="dropdown-class active">Leads <i class="fa fa-caret-down"></i></a>
						<ul class="menu-drop">
                            <li><a href="<?=BASEURL?>painter/leads">All</a></li>
                            <li><a href="<?=BASEURL?>painter/leads/pending">Pending</a></li>
                            <li><a href="<?=BASEURL?>painter/leads/valid">Valid</a></li>
                            <li><a href="<?=BASEURL?>painter/leads/invalid">Invalid</a></li>
                        </ul>
					</li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/account-setting">Account Setting</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/change-password">Change Password</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>painter/logout">Logout</a></li>
				</ul>
			</div><!-- /4 -->
			<div class="col-md-9">
	            <div class="col-md-12">
	                <div class="signup-form">
	                	<div id="alert">
	                		<?php if (isset($_GET['msg'])): ?>
	                			<div class="alert alert-danger"><?=$_GET['msg']?></div>
	                		<?php endif ?>
	                	</div>   
	                	<div class="form-title">
                            <div class="form-block-title">
                            	<h2>Leads</h2>
                            </div>
                            <h4>All Leads</h4>
                        </div>
                    	<br>
                        <table id="dataTable" class="table table-striped table-bordered table-sm">
		                    <thead>
		                        <tr>
		                            <th>Lead ID</th>
		                            <th>Name</th>
		                            <th>Phone</th>
		                            <th>Services</th>
		                            <th>Status</th>
		                            <th>Reason</th>
		                            <th>Clicks</th>
		                            <th>Action</th>
		                        </tr>
		                    </thead>
		                    <tfoot>
		                        <tr>
		                        	<th>Lead ID</th>
		                            <th>Name</th>
		                            <th>Phone</th>
		                            <th>Services</th>
		                            <th>Status</th>
		                            <th>Reason</th>
		                            <th>Clicks</th>
		                            <th>Action</th>
		                        </tr>
		                    </tfoot>
		                    <tbody>
		                        <?php
		                        if (count($leads) > 0) {
		                            foreach ($leads as $q): ?>
		                                <tr>
		                                    <td><?=$q['lead_id']?></td>
		                                    <td><?=$q['name']?></td>
		                                    <td><?=$q['phone']?></td>
		                                    <td><?=$q['services']?></td>
		                                    <td><?=$q['status']?></td>
		                                    <td><?=$q['invalid_reason']?></td>
		                                    <td><?=$q['clicks']?></td>
		                                    <td class="actions">
		                                        <a href="javascript://" data-painter-id="<?=$q['painter_lead_id']?>" data-id="<?=$q['lead_id']?>" data-name="<?=$q['name']?>" data-toggle="modal" data-target="#myModal" class="update-lead btn btn-primary" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
		                                    </td>
		                                </tr>
		                                <?php endforeach;
		                        } //end if
		                        else {
		                            ?>
		                            <tr>
		                                <td colspan="8">
		                                    No Leads found in the database
		                                </td>
		                            </tr>
		                            <?php
		                        }?>
		                    </tbody>
		                </table>
	                </div><!-- /signup-form -->
	            </div><!-- /6 -->
			</div><!-- /8 -->
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /dashboard -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ddd;">
        <strong class="modal-title id" id="myModalLabel"></strong>
        <strong class="modal-title name" style="float: right;" id="myModalLabel"></strong>
      </div>
      <form action="<?=BASEURL?>painter/update_lead_status" method="post">
	      <div class="modal-body">
	      	<div class="form-group">
	      		<input type="hidden" name="id">
	      		<label for="status">Status</label>
	      		<select name="status" class="form-control">
	      			<?php if ($status == 'pending'): ?>
	      				<option value="pending" selected>Pending</option>
	      				<option value="successful">Successful</option>
	      				<option value="reject">Reject</option>
	      			<?php elseif ($status == 'successful'): ?>
	      				<option value="reject">Reject</option>
	      				<option value="successful" selected>Successful</option>
	      				<option value="pending">Pending</option>
	      			<?php elseif ($status == 'reject'): ?>
	      				<option value="reject" selected>Reject</option>
	      				<option value="pending">Pending</option>
	      				<option value="successful">Successful</option>
	      			<?php else: ?>
	      				<option value="pending">Pending</option>
	      				<option value="reject">Reject</option>
	      				<option value="successful">Successful</option>
	      			<?php endif ?>
	      		</select>
	      	</div>
	      	<div class="form-group">
	      		<label for="note">Note</label>
	      		<textarea name="note" class="form-control" rows="5"></textarea>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>


<script>
    $(function () {
        $('.update-lead').on('click', function() {
            $(".modal-title.id").text(' ');
            $(".modal-title.name").text(' ');
            $("input[name='id']").val(' ');
            var val_ = $(this).attr('data-id');
            var id = $(this).attr('data-painter-id');
            var name = $(this).attr('data-name');
            $(".modal-title.id").text('Lead #: '+val_);
            $(".modal-title.name").text('Lead Name: '+name);
            $("input[name='id']").val(id);
        });
    })
</script>