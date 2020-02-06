<script type="text/javascript">
function del_q(cid) {
	cnfr = confirm("Are you sure you want to delete this affiliates");
	if (cnfr) {
		document.location = "<?=BASEURL?>admin/delete_affiliates?affiliates_id=" + cid;
	}
}
</script>
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Affiliates</h1>
        <ol class="breadcrumb">
            <li><a href="<?=BASEURL?>admin">Admin</a></li>
            <li>Affiliates</li>
        </ol>
        <div class="page-header-actions">
            <a class="btn btn-sm btn-primary btn-round" href="<?=BASEURL?>" target="_blank">
                <i class="icon md-link" aria-hidden="true"></i>
                <span class="hidden-xs">Website</span>
            </a>
        </div><!-- /page-header-actions -->
    </div><!-- /page-header -->
    <?php if ($msg_code): ?>
    <div class="bg-success well">
        <p><?=$msg_code?></p>
    </div>
    <?php endif;?>
    <div class="page-content">
        <div class="panel">
            <div class="panel-body">
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
                <table class="table table-bordered table-hover dataTable table-striped width-full" data-plugin="dataTable" id="dataTable">
                    <thead>
                        <tr>
							<th>Affiliates # </th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>affiliates # </th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (count($affiliates) > 0) {
                            foreach ($affiliates as $q): ?>
                                <tr>
									<td><?=$q['affiliate_id']?></td>
                                    <td><?=$q['name']?></td>
                                    <td><?=$q['phone']?></td>
                                    <td><?=$q['email']?></td>
                                    <td><?=$q['country']?></td>
                                    <td><?=$q['city']?></td>
                                    <td><?=$q['address']?></td>
                                    <td><?=date('d-m-Y',strtotime($q['at']))?></td>
                                    <td><?=$q['status']?></td>
                                    <td class="actions">
                                        <a href="<?=BASEURL?>admin/edit_affiliate?id=<?=$q['affiliate_id']?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                                        <a href="javascript:del_q('<?=$q['affiliates_id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td colspan="3">
                                    No Category found in the database
                                </td>
                            </tr>
                            <?php
                        }?>
                    </tbody>
                </table>
            </div><!-- /panel-body -->
        </div><!-- /panel -->
      <!-- End Panel Basic -->
    </div><!-- /page-content -->
</div><!-- /page/animsition -->
<?php $menu = 'cat'; ?>


<script>
    $('#filter-search').on('submit', function(event) {
        event.preventDefault();
        $(".theatre-cover.image").fadeIn(100);
        $this = $(this);           
        $.post('<?=BASEURL?>admin/filter-search', {data: $this.serialize(), "action": 'affiliate'}, function(resp) {
            resp = JSON.parse(resp);
            $(".theatre-cover.image").fadeOut(100);
            $('#dataTable tbody').html(resp.rec);      
        });
    });
</script>