<div class="content-wrapper">
    <!-- Content Header (Page header) --> 
    <section class="content-header"> 
      <h1>
        <i class="fa fa-user-circle-o" aria-hidden="true"></i> Visitors Management
      </h1>
    </section>

    <section class="content"> 
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Visitors List</h3>  
                    <a href="<?php echo site_url('visitors/create'); ?>"  class="btn btn-success"  style="float: right;">Add New Visitor</a>

                    <form method="post" action="<?php echo site_url('visitors'); ?>" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-2">
                                <select id="districtFilter" class="form-control">
                                    <option value="">All Districts</option>
                                    <?php foreach ($districts as $district): ?>
                                        <option value="<?php echo $district; ?>"><?php echo $district; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select id="vidhanFilter" class="form-control">
                                    <option value="">All Vidhan Sabha</option>
                                    <?php foreach ($vidhan_sabhas as $vidhan): ?>
                                        <option value="<?php echo $vidhan; ?>"><?php echo $vidhan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select id="blockFilter" class="form-control">
                                    <option value="">All Blocks</option>
                                    <?php foreach ($blocks as $block): ?>
                                        <option value="<?php echo htmlspecialchars($block); ?>">
                                            <?php echo htmlspecialchars($block); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="year" id="yearFilter" class="form-control">
                                    <option value="">Select Year</option>
                                    <?php
                                    $current_year = date('Y');
                                    for ($i = $current_year; $i >= $current_year - 5; $i--) {
                                        $selected = (isset($filters['year']) && $filters['year'] == $i) ? 'selected' : '';
                                        echo "<option value='{$i}' {$selected}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="month" id="monthFilter" class="form-control">
                                    <option value="">Select Month</option>
                                    <?php
                                    $months = [
                                        '01' => 'January',
                                        '02' => 'February',
                                        '03' => 'March',
                                        '04' => 'April',
                                        '05' => 'May',
                                        '06' => 'June',
                                        '07' => 'July',
                                        '08' => 'August',
                                        '09' => 'September',
                                        '10' => 'October',
                                        '11' => 'November',
                                        '12' => 'December'
                                    ];
                                    foreach ($months as $key => $value) {
                                        $selected = (isset($filters['month']) && $filters['month'] == $key) ? 'selected' : '';
                                        echo "<option value='{$key}' {$selected}>{$value}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary form-control">Filter</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover" id="visitorTable">
                    <thead>
                      <tr style="color:white;font-size:15px;background:#020254;"> 
                        <th>Sr No</th>
                        <th>District</th>
                        <th>Vidhan Sabha</th>
                        <th>Block</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Post</th>
                        <th>Place</th>
                        <th>Mobile No.</th>
                        <th>In-coming/Visitor</th>
                        <th>Message</th>
                        <th>Visitor Type</th>
                        <th>Attend by</th>
                        
                        <th>REMARK (क्या कारवाही की गई)</th>
                        <th>USD Coding</th>
                        <th>भईया के निर्देश </th>
                        <th>Added By </th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($visitors as $key => $visitor): ?>
                    <tr class="clickable-row" data-visitor-id="<?php echo htmlspecialchars($visitor['id']); ?>" style="cursor: pointer;">
                        <td><?php echo $key+1; ?></td>
                        <td><?php 
                        // Get district name if ID is stored
                        $district_val = $visitor['district'];
                        if(is_numeric($district_val)) {
                            $this->db->where('id', $district_val);
                            $district = $this->db->get('district')->row_array();
                            echo isset($district['name']) ? htmlspecialchars($district['name']) : htmlspecialchars($district_val);
                        } else {
                            echo htmlspecialchars($district_val);
                        }
                        ?></td>
                        <td><?php 
                        // Get vidhan_sabha name if ID is stored
                        $vidhan_val = $visitor['vidhan_sabha'];
                        if(is_numeric($vidhan_val)) {
                            $this->db->where('id', $vidhan_val);
                            $vidhan = $this->db->get('vidhan_sabha')->row_array();
                            echo isset($vidhan['name']) ? htmlspecialchars($vidhan['name']) : htmlspecialchars($vidhan_val);
                        } else {
                            echo htmlspecialchars($vidhan_val);
                        }
                        ?></td>
                        <td><?php 
                        $block_id = $visitor['block'];
                        $this->db->where('id', $block_id);
                        $block = $this->db->get('block')->row_array();
                        echo isset($block['block_name']) ? htmlspecialchars($block['block_name']) : htmlspecialchars($block['name'] ?? '-');
?></td>
                        <td><?php echo $visitor['date']; ?></td>
                        <td><?php echo $visitor['time']; ?></td>
                        <td><?php echo $visitor['name']; ?></td>
                        <td><?php echo $visitor['category']; ?></td>
                        <td><?php echo $visitor['post']; ?></td>
                        <td><?php echo $visitor['place']; ?></td>
                        <td><?php echo $visitor['mobile_no']; ?></td>
                        <td><?php echo $visitor['in_coming_visitor']; ?></td>
                        <td><?php echo $visitor['message']; ?></td>
                        <td><?php echo $visitor['type']; ?></td>
                        <td><?php echo $visitor['attend']; ?></td>
                        <td><?php echo $visitor['remark']; ?></td>
                        <td><?php echo !empty($visitor['uss_coding']) ? $visitor['uss_coding'] : '-'; ?></td>
                        <td><?php echo $visitor['bhaiya_ke_nirdesh']; ?></td>
                        <td><?php $createdBy = $visitor['createdBy'];
                        $query = $this->db->query("SELECT name FROM tbl_users WHERE userId = ?", array($createdBy));
$row = $query->row();
  echo $row ? $row->name : 'Unknown'; 

?></td>
                        <td>
                            <a href="<?php echo site_url('visitors/edit/'.$visitor['id']); ?>" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                            <a href="<?php echo site_url('visitors/delete/'.$visitor['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
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

<!-- Modal for Viewing Visitor Details -->
<div class="modal fade" id="recordModal" tabindex="-1" role="dialog" aria-labelledby="recordModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="width: 90%; max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="recordModalLabel">Visitor Details</h4>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div id="recordDetails" style="margin-bottom: 30px;">
                    <h4 style="border-bottom: 2px solid #3c8dbc; padding-bottom: 10px; margin-bottom: 20px;">Visitor Information</h4>
                    <div class="row" id="recordData">
                        <div class="text-center">
                            <i class="fa fa-spinner fa-spin fa-2x"></i> Loading...
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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
    var table = $('#visitorTable').DataTable({
        "processing": true,
        "serverSide": false,
        "dom": '<"top"lfB>rt<"bottom"ip>',
        "buttons": [
            {
                extend: 'excelHtml5',
                text: 'Export Excel',
                title: 'Visitors List'
            }
        ],
        "paging": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "lengthMenu": [
            [10, 25, 50, 75, -1],
            [10, 25, 50, 75, "All"]
        ]
    });
    // Click to view modal
    $(document).on('click', '.clickable-row', function(e) {
        // Don't trigger if clicking on action buttons or links
        if ($(e.target).closest('a, button').length) {
            return;
        }
        
        var recordId = $(this).data('visitor-id');
        $('#recordData').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i> Loading...</div>');
        $('#recordModal').modal('show');
        
        // Load record details
        $.ajax({
            url: '<?php echo site_url("visitors/get_visitor_details/"); ?>' + recordId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    displayRecordData(response.data);
                } else {
                    $('#recordData').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function() {
                $('#recordData').html('<div class="alert alert-danger">Error loading visitor details</div>');
            }
        });
    });
    
    function displayRecordData(data) {
        var html = '<div class="row">';
        html += '<div class="col-md-6"><p><strong>Name:</strong> ' + (data.name || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>District:</strong> ' + (data.district || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>Vidhan Sabha:</strong> ' + (data.vidhan_sabha || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>Block:</strong> ' + (data.block_name || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>Date:</strong> ' + (data.date || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>Time:</strong> ' + (data.time || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>Category:</strong> ' + (data.category || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>Post:</strong> ' + (data.post || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>Place:</strong> ' + (data.place || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>Mobile No:</strong> ' + (data.mobile_no || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>In-coming/Visitor:</strong> ' + (data.in_coming_visitor || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>Type:</strong> ' + (data.type || '-') + '</p></div>';
        html += '<div class="col-md-12"><p><strong>Message:</strong> ' + (data.message || '-') + '</p></div>';
        html += '<div class="col-md-12"><p><strong>Remark:</strong> ' + (data.remark || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>Attend By:</strong> ' + (data.attend || '-') + '</p></div>';
        html += '<div class="col-md-6"><p><strong>USS Coding:</strong> ' + (data.uss_coding || '-') + '</p></div>';
        html += '<div class="col-md-12"><p><strong>भईया के निर्देश:</strong> ' + (data.bhaiya_ke_nirdesh || '-') + '</p></div>';
        html += '</div>';
        
        $('#recordData').html(html);
    }
    // Filter bindings
    $('#districtFilter').on('change', function () {
        table.column(1).search(this.value).draw(); // District column index
    });
    $('#vidhanFilter').on('change', function () {
        table.column(2).search(this.value).draw(); // Vidhan Sabha column index
    });
   // in your $(document).ready, after you init DataTables:
$('#blockFilter').on('change', function () {
  // we escape the value so special chars don’t break the regex,
  // then use ^…$ to force an exact match on the block name
  var val = $.fn.dataTable.util.escapeRegex(this.value);
  table
    .column(3)            // 0-based index of your “Block” column
    .search(val ? '^'+val+'$' : '', true, false)
    .draw();
});

});
</script>
