<script type="text/javascript">
function del_q(cid) {
	cnfr = confirm("Are you sure you want to delete this Lead");
	if (cnfr) {
		document.location = "<?=BASEURL?>admin/delete_lead?lead_id=" + cid;
	}
}
</script>
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Leads</h1>
        <ol class="breadcrumb">
            <li><a href="<?=BASEURL?>admin">Admin</a></li>
            <li>Leads</li>
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
                <div class="row">
                    <div class="col-sm-6">
                        <div class="margin-bottom-15">
                            <button id="addToTable" class="btn btn-primary" type="button" onClick="document.location='<?=BASEURL?>admin/add_lead';">
                                <i class="icon md-plus" aria-hidden="true"></i> Add Leads
                            </button>
                        </div><!-- /margin-bottom-15 -->
                    </div><!-- /6 -->
                </div><!-- /row -->
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
							<th>Lead ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Services</th>
                            <th>Status</th>
                            <th>Reason</th>
                            <th>Clicks</th>
                            <th>At</th>
                            <th>Assign</th>
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
                            <th>Assign</th>
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
                                    <td><?=date('d-m-Y',strtotime($q['at']))?></td>
                                    <td>
                                        <a href="javascript://" data-toggle="modal" data-target="#myModal" class="btn btn-primary assign-package" data-id="<?=$q['lead_id']?>" data-name="<?=$q['name']?>" data-toggle="tooltip" data-original-title="Assign"><i class="fa fa-sign-in"></i></a>
                                    </td>
                                    <td class="actions">
                                        <a href="<?=BASEURL?>admin/edit_lead?id=<?=$q['lead_id']?>" class="btn btn-primary" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:del_q('<?=$q['lead_id']?>')" class="btn btn-danger" data-toggle="tooltip" data-original-title="Remove"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td colspan="5">
                                    No Packages found in the database
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
<?php $menu = 'leads'; ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ddd;">
        <strong class="modal-title id" id="myModalLabel"></strong>
        <strong class="modal-title name" style="float: right;" id="myModalLabel"></strong>
      </div>
    <form action="<?=BASEURL?>admin/assign-package" method="post"> 
      <div class="modal-body">
        <div class="form-group">
            <input type="hidden" name="id">
            <label for="">Package </label>
            <select name="package_id" class="form-control" required >
                <option value="">Select Package</option>
                <?php foreach ($package as $key => $p): ?>
                    <option value="<?=$p['package_id']?>"><?=$p['name']?></option>
                <?php endforeach ?>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Assign</button>
      </div>
    </form>
    </div>
  </div>
</div>




<script>
    $(function () {
        $('.assign-package').on('click', function() {
            $(".modal-title.id").text(' ');
            $(".modal-title.name").text(' ');
            $("input[name='id']").val(' ');
            var val_ = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            $(".modal-title.id").text('Lead #: '+val_);
            $(".modal-title.name").text('Lead Name: '+name);
            $("input[name='id']").val(val_);
        });
        $('#filter-search').on('submit', function(event) {
            event.preventDefault();
            $(".theatre-cover.image").fadeIn(100);
            $this = $(this);           
            $.post('<?=BASEURL?>admin/filter-search', {data: $this.serialize(), "action": 'lead'}, function(resp) {
                resp = JSON.parse(resp);
                $(".theatre-cover.image").fadeOut(100);
                $('#dataTable tbody').html(resp.rec);      
            });
        });
    })
</script>