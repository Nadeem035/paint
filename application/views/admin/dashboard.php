<div class="page animsition">
  <div class="page-content padding-30 container-fluid">
    <div class="row" data-plugin="matchHeight" data-by-row="true">
      <div class="col-lg-3 col-sm-6">
        <!-- Widget Linearea One-->
        <div class="widget widget-shadow" id="widgetLineareaOne">
          <div class="widget-content">
            <div class="padding-20 padding-top-10 text-center">
              <div class="clearfix">
                <div class="grey-800 padding-vertical-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>Total Income</div>
                <div class="grey-700 font-size-30"><?=$income['total']?></div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-lg-3 col-sm-6">
        <!-- Widget Linearea One-->
        <div class="widget widget-shadow" id="widgetLineareaOne">
          <div class="widget-content">
            <div class="padding-20 padding-top-10 text-center">
              <div class="clearfix">
                <div class="grey-800 padding-vertical-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom margin-right-5"></i> Pending Debits Affiliates </div>
                <div class="grey-700 font-size-30"><?=$debit['total']?></div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-lg-3 col-sm-6">
        <!-- Widget Linearea One-->
        <div class="widget widget-shadow" id="widgetLineareaOne">
          <div class="widget-content">
            <div class="padding-20 padding-top-10 text-center">
              <div class="clearfix">
                <div class="grey-800 padding-vertical-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>Total Profit </div>
                <div class="grey-700 font-size-30">0</div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-lg-3 col-sm-6">
        <!-- Widget Linearea One-->
        <div class="widget widget-shadow" id="widgetLineareaOne">
          <div class="widget-content">
            <div class="padding-20 padding-top-10 text-center">
              <div class="clearfix">
                <div class="grey-800 padding-vertical-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>Total Categories</div>
                <div class="grey-700 font-size-30"><?=$cat['total']?></div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-lg-3 col-sm-6">
        <!-- Widget Linearea One-->
        <div class="widget widget-shadow" id="widgetLineareaOne">
          <div class="widget-content">
            <div class="padding-20 padding-top-10 text-center">
              <div class="clearfix">
                <div class="grey-800 padding-vertical-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>Total Painters</div>
                <div class="grey-700 font-size-30"><?=$painter['total']?></div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Active</th>
                      <th>Inactive</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td><?=$painter['total_active']?></td>
                    <td><?=$painter['total_inactive']?></td>
                    <td><?=$painter['total']?></td>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-lg-3 col-sm-6">
        <!-- Widget Linearea One-->
        <div class="widget widget-shadow" id="widgetLineareaOne">
          <div class="widget-content">
            <div class="padding-20 padding-top-10 text-center">
              <div class="clearfix">
                <div class="grey-800 padding-vertical-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>Total Affiliates</div>
                <div class="grey-700 font-size-30"><?=$affiliate['total']?></div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Active</th>
                      <th>Inactive</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td><?=$affiliate['total_active']?></td>
                    <td><?=$affiliate['total_inactive']?></td>
                    <td><?=$affiliate['total']?></td>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-lg-3 col-sm-6">
        <!-- Widget Linearea One-->
        <div class="widget widget-shadow" id="widgetLineareaOne">
          <div class="widget-content">
            <div class="padding-20 padding-top-10 text-center">
              <div class="clearfix">
                <div class="grey-800 padding-vertical-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>Total Workers</div>
                <div class="grey-700 font-size-30"><?=$worker['total']?></div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Active</th>
                      <th>Inactive</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td><?=$worker['total_active']?></td>
                    <td><?=$worker['total_inactive']?></td>
                    <td><?=$worker['total']?></td>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-lg-3 col-sm-6">
        <!-- Widget Linearea One-->
        <div class="widget widget-shadow" id="widgetLineareaOne">
          <div class="widget-content">
            <div class="padding-20 padding-top-10 text-center">
              <div class="clearfix">
                <div class="grey-800 padding-vertical-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>Total Leads</div>
                <div class="grey-700 font-size-30"><?=$lead['total']?></div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>New</th>
                      <th>Valid</th>
                      <th>Invalid</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td><?=$lead['total_new']?></td>
                    <td><?=$lead['total_valid']?></td>
                    <td><?=$lead['total_invalid']?></td>
                    <td><?=$lead['total']?></td>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-lg-3 col-sm-6">
        <!-- Widget Linearea One-->
        <div class="widget widget-shadow" id="widgetLineareaOne">
          <div class="widget-content">
            <div class="padding-20 padding-top-10 text-center">
              <div class="clearfix">
                <div class="grey-800 padding-vertical-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>Total Packages</div>
                <div class="grey-700 font-size-30"><?=$package['total']?></div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Active</th>
                      <th>Inactive</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td><?=$package['total_active']?></td>
                    <td><?=$package['total_inactive']?></td>
                    <td><?=$package['total']?></td>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-lg-3 col-sm-6">
        <!-- Widget Linearea One-->
        <div class="widget widget-shadow" id="widgetLineareaOne">
          <div class="widget-content">
            <div class="padding-20 padding-top-10 text-center">
              <div class="clearfix">
                <div class="grey-800 padding-vertical-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>Leads Assigned</div>
                <div class="grey-700 font-size-30"><?=$lead['total']?></div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><abbr title="Not Assigned">New</abbr> </th>
                      <?php foreach ($all_package as $key => $p): ?>
                        <th><?=$p['name']?></th>
                      <?php endforeach ?>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td><?=$lead['total_new']?></td>
                      <?php foreach ($package_lead as $key => $pl): ?>
                        <td><?=$pl['total']?></td>
                      <?php endforeach ?>
                    <td><?=$lead['total']?></td>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
    </div>
  </div>
</div>