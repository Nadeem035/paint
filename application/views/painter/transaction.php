<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="list-group">
					<li class="list-group-item"><a href="<?=BASEURL?>painter/dashboard">Dashboard</a></li>
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
					<li class="list-group-item"><a class="active" href="<?=BASEURL?>painter/transactions">Transactions</a></li>
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
                            	<h2>Transactions <small>(<?=$user['name']?>)</small></h2>
                            </div>
                            <h4>All Transactions</h4>
                        </div>
                    	<br>
                        <table id="dataTable" class="table table-striped table-bordered table-sm">
		                    <thead>
		                        <tr>
		                            <th>ID</th>
		                            <th>Amount</th>
		                            <th>At</th>
		                            <th>Status</th>
		                        </tr>
		                    </thead>
		                    <tfoot>
		                        <tr>
		                        	<th>ID</th>
		                            <th>Amount</th>
		                            <th>At</th>
		                            <th>Status</th>	
		                        </tr>
		                    </tfoot>
		                    <tbody>
		                        <?php
		                        if (count($transactions) > 0) {
		                            foreach ($transactions as $q): ?>
		                                <tr>
		                                    <td><?=$q['transaction_id']?></td>
		                                    <td><?=$q['amount']?></td>
		                                    <td><?=date('d-m-Y',strtotime($q['at']))?></td>
		                                    <td><?=$q['status']?></td>
		                                </tr>
		                                <?php endforeach;
		                        } //end if
		                        else {
		                            ?>
		                            <tr>
		                                <td colspan="8">
		                                    No Transactions found in the database
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
