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
							<th>Transactions # </th>
                            <th>Painter ID</th>
                            <th>Name</th>
                            <th>Affiliate ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Transactions # </th>
                            <th>Painter ID</th>
                            <th>Name</th>
                            <th>Affiliate ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (count($transactions) > 0) {
                            foreach ($transactions as $q): ?>
                                <tr>
									<td><?=$q['transaction_id']?></td>
                                    <td><?=$q['painter_id']?></td>
                                    <td><?=$q['p_name']?></td>
                                    <td><?=$q['affiliate_id']?></td>
                                    <td><?=$q['a_name']?></td>
                                    <td><?=$q['amount']?></td>
                                    <td><?=date('d-m-Y',strtotime($q['t_at']))?></td>
                                    <td><?=$q['t_status']?></td>
                                    <td class="actions">
                                        <a href="javascript://" class="btn btn-sm btn-icon btn-pure btn-default on-default" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td colspan="3">
                                    No Transactions found in the database
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
                    <th>Transactions # </th>
                    <th>Painter ID</th>
                    <th>Name</th>
                    <th>Affiliate ID</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Transactions # </th>
                    <th>Painter ID</th>
                    <th>Name</th>
                    <th>Affiliate ID</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>At</th>
                    <th>Status</th>
                    <th>Action</th>
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
    $('#filter-search').on('submit', function(event) {
        event.preventDefault();
        $(".theatre-cover.image").fadeIn(100);
        $this = $(this);           
        $.post('<?=BASEURL?>admin/filter-search', {data: $this.serialize(), "action": 'transaction'}, function(resp) {
            resp = JSON.parse(resp);
            $(".theatre-cover.image").fadeOut(100);
            $('#dataTable tbody').html(resp.rec);      
        });
    });

    $('.show-affiliate').on('click', function() {
        $("#myshow .modal-title.id").text(' ');
        $("#myshow .modal-title.name").text(' ');
        var name = $(this).attr('data-name');
        var id = $(this).attr('data-affiliate-id');
        $.post('<?=BASEURL?>admin/get_signle_affiliate', {id: id}, function(resp) {
            resp = $.parseJSON(resp);
            if (resp.status == true) {
                $("#myshow table tbody").html(resp.data);
                $('#myshow').modal('show');
            }
        });
        $("#myshow .modal-title.id").text('Affiliate #: '+id);
        $("#myshow .modal-title.name").text('Affiliate Name: '+name);
    });

    $('.pay-affiliate').on('click', function() {
        $("#pay_affiliate .modal-title.amount").text(' ');
        $("#pay_affiliate .modal-title.name").text(' ');
        $("#affiliate_id").val(' ');
        var name = $(this).attr('data-name');
        var id = $(this).attr('data-affiliate-id');
        var amount = $(this).attr('data-amount');
        /*$.post('<?=BASEURL?>admin/get_signle_affiliate', {id: id}, function(resp) {
            resp = $.parseJSON(resp);
            if (resp.status == true) {
                $("#pay_affiliate table tbody").html(resp.data);
                $('#pay_affiliate').modal('show');
            }
        });*/
        $("#pay_affiliate .modal-title.amount").text('Amount #: '+amount);
        $("#pay_affiliate .modal-title.name").text('Affiliate Name: '+name);
        $("#affiliate_id").val(id);
        $('#pay_affiliate').modal('show');
    });
</script>