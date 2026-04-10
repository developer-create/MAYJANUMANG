<style>
    button.dt-button.buttons-excel.buttons-html5 {
    left: 100px !important;
}
</style>
<link rel="stylesheet" href="<?php echo base_url('assets/css/samiti-filters.css'); ?>">
<div class="content-wrapper">
    <section class="content-header"> 
      <h1>
        <i class="fa fa-users" aria-hidden="true"></i> MP Vidhan Sabha Member Management
      </h1>
    </section>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">MP Vidhan Sabha Member List</h3>  
                    <a href="<?php echo site_url('mp_vidhan_sabha_member/create'); ?>"  class="btn btn-success"  style="float: right;">Add New Member</a>
                </div><!-- /.box-header -->
                
                <!-- Filters Section -->
                <div class="filter-section">
                    <form method="get" action="<?php echo site_url('mp_vidhan_sabha_member'); ?>" id="filterForm">
                        <div class="filter-row">
                            <div class="filter-group">
                                <label for="filter_district">जिला (District)</label>
                                <select name="filter_district" id="filter_district">
                                    <option value="">-- All Districts --</option>
                                    <?php if (!empty($districts)): foreach ($districts as $dist): ?>
                                    <option value="<?php echo $dist['id']; ?>" <?php echo (isset($filter_district) && $filter_district == $dist['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($dist['name']); ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                            
                            <div class="filter-group">
                                <label for="filter_block">ब्लॉक (Block)</label>
                                <select name="filter_block" id="filter_block">
                                    <option value="">-- All Blocks --</option>
                                    <?php if (!empty($blocks)): foreach ($blocks as $blk): ?>
                                    <option value="<?php echo $blk['id']; ?>" <?php echo (isset($filter_block) && $filter_block == $blk['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($blk['name']); ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                            
                            <div class="filter-group">
                                <label for="filter_vidhan_sabha">विधान सभा (Vidhan Sabha)</label>
                                <select name="filter_vidhan_sabha" id="filter_vidhan_sabha">
                                    <option value="">-- All Vidhan Sabha --</option>
                                    <?php if (!empty($vidhan_sabhas)): foreach ($vidhan_sabhas as $vs): ?>
                                    <option value="<?php echo $vs['id']; ?>" <?php echo (isset($filter_vidhan_sabha) && $filter_vidhan_sabha == $vs['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($vs['vidhan_sabha_name']); ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                            
                            <div class="filter-group">
                                <label for="filter_month">महीना (Month)</label>
                                <select name="filter_month" id="filter_month">
                                    <option value="">-- All Months --</option>
                                    <option value="1" <?php echo (isset($filter_month) && $filter_month == '1') ? 'selected' : ''; ?>>January</option>
                                    <option value="2" <?php echo (isset($filter_month) && $filter_month == '2') ? 'selected' : ''; ?>>February</option>
                                    <option value="3" <?php echo (isset($filter_month) && $filter_month == '3') ? 'selected' : ''; ?>>March</option>
                                    <option value="4" <?php echo (isset($filter_month) && $filter_month == '4') ? 'selected' : ''; ?>>April</option>
                                    <option value="5" <?php echo (isset($filter_month) && $filter_month == '5') ? 'selected' : ''; ?>>May</option>
                                    <option value="6" <?php echo (isset($filter_month) && $filter_month == '6') ? 'selected' : ''; ?>>June</option>
                                    <option value="7" <?php echo (isset($filter_month) && $filter_month == '7') ? 'selected' : ''; ?>>July</option>
                                    <option value="8" <?php echo (isset($filter_month) && $filter_month == '8') ? 'selected' : ''; ?>>August</option>
                                    <option value="9" <?php echo (isset($filter_month) && $filter_month == '9') ? 'selected' : ''; ?>>September</option>
                                    <option value="10" <?php echo (isset($filter_month) && $filter_month == '10') ? 'selected' : ''; ?>>October</option>
                                    <option value="11" <?php echo (isset($filter_month) && $filter_month == '11') ? 'selected' : ''; ?>>November</option>
                                    <option value="12" <?php echo (isset($filter_month) && $filter_month == '12') ? 'selected' : ''; ?>>December</option>
                                </select>
                            </div>
                            
                            <div class="filter-group">
                                <label for="filter_year">वर्ष (Year)</label>
                                <select name="filter_year" id="filter_year">
                                    <option value="">-- All Years --</option>
                                    <?php for ($y = 2020; $y <= 2030; $y++): ?>
                                    <option value="<?php echo $y; ?>" <?php echo (isset($filter_year) && $filter_year == $y) ? 'selected' : ''; ?>><?php echo $y; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            
                            <div class="filter-buttons">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                                <a href="<?php echo site_url('mp_vidhan_sabha_member'); ?>" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover" id="memberTable">
                    <thead>
                      <tr style="color:white;font-size:15px;background:#020254;"> 
                          <th>ID</th>
                          <th>Name</th>
                          <th>Position</th>
                          <th>Mobile No</th>
                          <th>District</th>
                          <th>Block</th>
                          <th>Vidhan Sabha</th>
                          <th>Created By</th>
                          <th>Created Time</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?php echo $member['id']; ?></td>
                        <td><?php echo htmlspecialchars($member['name']); ?></td>
                        <td><?php echo htmlspecialchars($member['position']); ?></td>
                        <td><?php echo htmlspecialchars($member['mobile_no']); ?></td>
                        <td><?php echo isset($member['district_name']) && $member['district_name'] ? htmlspecialchars($member['district_name']) : '-'; ?></td>
                        <td><?php echo isset($member['block_name']) && $member['block_name'] ? htmlspecialchars($member['block_name']) : '-'; ?></td>
                        <td><?php echo isset($member['vidhan_sabha_name']) && $member['vidhan_sabha_name'] ? htmlspecialchars($member['vidhan_sabha_name']) : '-'; ?></td>
                        <td><?php echo $member['created_by_name']; ?></td>
                        <td><?php echo date('d-m-Y H:i:s', strtotime($member['created_time'])); ?></td>
                        <td>
                            <a href="<?php echo site_url('mp_vidhan_sabha_member/edit/'.$member['id']); ?>"  class="btn btn-info"><i class="fa fa-pencil"></i></a>
                            <a href="<?php echo site_url('mp_vidhan_sabha_member/delete/'.$member['id']); ?>"  class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Member?');"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section> 
</div> 

<!-- DataTables and related plugins -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script>
$(document).ready(function() {
    $('#memberTable').DataTable({
        "processing": true,
        "serverSide": false,
        "dom": '<"top"lfB>rt<"bottom"ip>',
        "buttons": [
            {
                extend: 'excelHtml5',
                text: 'Export Excel',
                title: 'MP Vidhan Sabha Member List'
            }
        ],
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthMenu": [
            [10, 25, 50, 75, -1],
            [10, 25, 50, 75, "All"]
        ],
        "columnDefs": [
            { "orderable": false, "targets": 9 }
        ]
    });
});
</script>
