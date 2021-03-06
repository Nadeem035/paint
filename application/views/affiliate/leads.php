<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="list-group">
					<li class="list-group-item"><a href="<?=BASEURL?>affiliate/dashboard">Dashboard</a></li>
					<li class="list-group-item"><a href="<?=BASEURL?>affiliate/package">Packages</a></li>
					<li class="list-group-item">
						<!-- <span class="badge">14</span> -->
						<a href="javascript://" class="dropdown-class active">Leads <i class="fa fa-caret-down"></i></a>
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
                        <div>
                        	<a href="<?=BASEURL?>affiliate/add_lead" class="btn btn-primary"><i class="fa fa-plus"></i> Add Lead</a>
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
		                            <th>Status</th>
		                            <th>Reason</th>
		                            <th>Clicks</th>
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
		                            <th>Status</th>
		                            <th>Reason</th>
		                            <th>Clicks</th>
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
		                                    <td><?=$q['status']?></td>
		                                    <td><?=$q['invalid_reason']?></td>
		                                    <td><?=$q['clicks']?></td>
		                                    <td><?=$q['at']?></td>
		                                    <?php if ($q['status'] == 'new'): ?>
			                                    <td class="actions">
			                                        <a href="<?=BASEURL?>affiliate/edit-lead/<?=$q['lead_id']?>" class="btn btn-primary" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
			                                        <a href="javascript:del_q('<?=$q['lead_id']?>')" class="btn btn-danger" data-toggle="tooltip" data-original-title="Remove"><i class="fa fa-trash-o"></i></a>
			                                    </td>
		                                    <?php else: ?>
		                                    	<td>
		                                    		<a href="javascript://" class="btn btn-primary" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
		                                    		<a href="javascript://" class="btn btn-danger" data-toggle="tooltip" data-original-title="Remove"><i class="fa fa-trash-o"></i></a>
		                                    	</td>
		                                    <?php endif ?>
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

<script>
	$(function () {
		$("#change-password").on('submit', function(e) {
		    e.preventDefault();

		    $this = $(this);
		    $url = $this.attr('action');
		    $.post($url, {data: $this.serialize()}, function(resp) {
		        resp = JSON.parse(resp);
		        if (resp.status == true) {
		        	window.location.href = "<?=BASEURL?>affiliate/logout";
		        }else{
		        	$('#alert').html('<div class="alert alert-danger">'+resp.msg+'</div>')
		        }
		    });
		});
		$('#filter-search').on('submit', function(event) {
	        event.preventDefault();
	        $(".theatre-cover.image").fadeIn(100);
	        $this = $(this);           
	        $.post('<?=BASEURL?>affiliate/filter-search', {data: $this.serialize(), "action": 'lead'}, function(resp) {
	            resp = JSON.parse(resp);
	            $(".theatre-cover.image").fadeOut(100);
	            $('#dataTable tbody').html(resp.rec);      
	        });
	    });
	})	
</script>