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
	            <div class="col-md-12">
	                <div class="signup-form table-responsive">
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
                    	<form id="filter-search" method="post">
		                    <div class="row">
		                        <div class="col-sm-3">
		                            <div class="form-group">
		                                <input type="date" name="min-date" id="min" class="form-control" required>
		                            </div>
		                        </div>
		                        <div class="col-sm-3">
		                            <div class="form-group">
		                                <input type="date" name="max-date" id="max" class="form-control" required>
		                            </div>
		                        </div>
		                        <div class="col-sm-6">
		                            <div class="form-group">
		                                <button type="submit" class="btn btn-primary">Search</button>
		                                <button type="button" class="btn btn-warning" onclick="window.location.reload();">Reset All</button>
		                            </div>
		                        </div>
		                    </div>
		                </form> 
                        <table id="dataTable" class="table table-striped table-bordered table-sm">
		                    <thead>
		                        <tr>
		                            <th>Lead ID</th>
		                            <th>Name</th>
		                            <th>Phone</th>
		                            <th>Services</th>
		                            <!-- <th>Package Name</th> -->
		                            <th>Status</th>
		                            <th>Note</th>
		                            <th>At</th>
		                            <th>Action</th>
		                        </tr>
		                    </thead>
		                    <tfoot>
		                        <tr>
		                        	<th>Lead ID</th>
		                            <th>Name</th>
		                            <th>Phone</th>
		                            <th>Services</th>
		                            <!-- <th>Package Name</th> -->
		                            <th>Status</th>
		                            <th>Note</th>
		                            <th>At</th>
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
		                                    <?php 
		                                    	$row = array();
		                                    	$se = explode(',', $q['services']); 
		                                    	foreach ($se as $key => $s) {
		                                    		$query = $this->db->query("SELECT name FROM `category` WHERE `category_id` =  '$s';");
		                                    		$row[] = $query->row()->name;
		                                    	}
		                                    	$dat = implode(',', $row);
		                                    ?>
		                                    <td><?=$dat?></td>
		                                    <!-- <td><?=$q['p_name']?></td> -->
		                                    <td><?=$q['pl_status']?></td>
		                                    <td><?=$q['note']?></td>
		                                    <td><?=date('d-m-Y',strtotime($q['l_at']))?></td>
		                                    <td class="actions" align="center">
		                                        <a href="javascript://" data-painter-id="<?=$q['painter_lead_id']?>" data-id="<?=$q['lead_id']?>" data-name="<?=$q['name']?>" data-toggle="modal" data-target="#myModal" class="update-lead btn btn-primary" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
		                                        <a href="javascript://" data-painter-id="<?=$q['painter_lead_id']?>" data-id="<?=$q['lead_id']?>" data-name="<?=$q['name']?>" data-toggle="modal" data-target="#myshow" class="show-lead btn btn-warning" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></a>
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
	      		<select name="status" class="form-control" required>
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
	      				<option value="">Give Status</option>
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


<!-- Modal -->
<div class="modal fade" id="myshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ddd;">
        <strong class="modal-title id" id="myModalLabel"></strong>
        <strong class="modal-title name" style="float: right;" id="myModalLabel"></strong>
      </div>
      <div class="modal-body">
      	<table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>Lead ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th>Services</th>
                    <th>Status</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                	<th>Lead ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th>Services</th>
                    <th>Status</th>
                    <th>Note</th>
                </tr>
            </tfoot>
            <tbody>

            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
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
        $('.show-lead').on('click', function() {
            $("#myshow .modal-title.id").text(' ');
            $("#myshow .modal-title.name").text(' ');
            var val_ = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var id = $(this).attr('data-painter-id');
            $.post('<?=BASEURL?>painter/get_signle_lead', {id: id}, function(resp) {
            	resp = $.parseJSON(resp);
            	if (resp.status == true) {
            		$("#myshow table tbody").html(resp.data);
            	}
            });
            $("#myshow .modal-title.id").text('Lead #: '+val_);
            $("#myshow .modal-title.name").text('Lead Name: '+name);
        });
        $('#filter-search').on('submit', function(event) {
	        event.preventDefault();
	        $(".theatre-cover.image").fadeIn(100);
	        $this = $(this);           
	        $.post('<?=BASEURL?>painter/filter-search', {data: $this.serialize(), "action": 'lead'}, function(resp) {
	            resp = JSON.parse(resp);
	            $(".theatre-cover.image").fadeOut(100);
	            $('#dataTable tbody').html(resp.rec);      
	        });
	    });
    })
</script>