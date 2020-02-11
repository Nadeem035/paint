<script type="text/javascript">
function del_q(iid, url) {
	cnfr = confirm("Are you sure you want to delete this Slider");
	if (cnfr) {
		document.location = "<?=BASEURL?>admin/delete_slide?slider_id="+iid;
	}
}
</script>
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Slider</h1>
        <ol class="breadcrumb">
            <li><a href="<?=BASEURL?>admin">Admin</a></li>
            <li>Slider</li>
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
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Data</h3>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="margin-bottom-15">
                            <button id="addToTable" class="btn btn-primary" type="button" onClick="document.location='<?=BASEURL?>admin/add-slide';">
                                <i class="icon md-plus" aria-hidden="true"></i> Add Slide
                            </button>
                        </div><!-- /margin-bottom-15 -->
                    </div><!-- /6 -->
                </div><!-- /row -->
                <table class="table table-bordered table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Slide</th>
							<th>Link</th>
							<th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
							<th>Slide</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (count($slides) > 0) {
                            foreach ($slides as $q): ?>
                                <tr>
                                    <td><img src="<?=UPLOADS.$q['img']?>" width="400"></td>
									<td><a href="<?=$q['link']?>"><?=$q['link']?></a></td>
                                    <td class="actions">
                                        <a href="#" class="btn btn-sm btn-icon btn-pure btn-default hidden on-editing save-row"
                                        data-toggle="tooltip" data-original-title="Save"><i class="icon md-wrench" aria-hidden="true"></i></a>
                                        <a href="#" class="btn btn-sm btn-icon btn-pure btn-default hidden on-editing cancel-row"
                                        data-toggle="tooltip" data-original-title="Delete"><i class="icon md-close" aria-hidden="true"></i></a>
                                        <a href="<?=BASEURL?>admin/edit-slide?id=<?=$q['slider_id']?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                                        <a href="javascript:del_q('<?=$q['slider_id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td colspan="4">
                                    No Slide found in the database
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
<?php $menu = 'slider'; ?>