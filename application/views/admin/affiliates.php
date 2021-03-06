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
                            <th>Address</th>
                            <th>At</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Amount</th>
                            <th>Pay</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>affiliates # </th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>At</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Amount</th>
                            <th>Pay</th>
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
                                    <td><?=$q['address']?></td>
                                    <td><?=date('d-m-Y',strtotime($q['at']))?></td>
                                    <td><?=$q['status']?></td>
                                    <td class="actions">
                                        <a href="javascript://" class="btn btn-sm btn-icon btn-pure btn-default on-default show-affiliate" data-name="<?=$q['name']?>" data-affiliate-id="<?=$q['affiliate_id']?>" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-eye" aria-hidden="true"></i></a>
                                        <a href="<?=BASEURL?>admin/edit_affiliate?id=<?=$q['affiliate_id']?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                                        <a href="javascript:del_q('<?=$q['affiliates_id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>
                                    </td>
                                    <td><?=$q['pending_amount']?></td>
                                    <td><button class="btn btn-primary pay-affiliate" data-name="<?=$q['name']?>" data-affiliate-id="<?=$q['affiliate_id']?>" data-amount="<?=$q['pending_amount']?>">Pay</button></td>
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
                    <th>Affiliate ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Link</th>
                    <th>Pending Amount</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Affiliate ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Link</th>
                    <th>Pending Amount</th>
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




<!-- Modal -->
<div class="modal fade" id="pay_affiliate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ddd;">
        <strong class="modal-title name"id="myModalLabel"></strong>
        <strong class="modal-title amount" style="float: right;"  id="myModalLabel"></strong>
      </div>
      <form action="<?=BASEURL?>admin/pay_affiliate" method="post">
            <div class="modal-body">
                <input type="hidden" id="affiliate_id" name="affiliate_id">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" name="amount" class="form-control" placeholder="Enter Amount To Pay">
                </div><!-- /form-group -->
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Pay</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
      </form>
    </div>
  </div>
</div>

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