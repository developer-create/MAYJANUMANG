<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> Approved Fund Summary (FY: <?php echo $current_fy; ?>)
            <small>Consolidated report of all approved funds for current financial year</small>
        </h1>
    </section>

    <section class="content">
        <!-- Fund Status Cards -->
        <div class="row">
            <?php 
            $fund_display_names = [
                'MLA FUND' => 'MLA FUND',
                'MLA Sweechanudan' => 'Swecha Nidhi',
                'CLP Sweechanudan' => 'CLP Fund',
                'Jansampark Fund' => 'Jansampark Fund'
            ];
            
            $fund_colors = [
                'MLA FUND' => 'bg-aqua',
                'MLA Sweechanudan' => 'bg-green',
                'CLP Sweechanudan' => 'bg-yellow',
                'Jansampark Fund' => 'bg-red'
            ];
            
            foreach ($fund_limits as $fund_name => $total_allocation): 
                $used = isset($used_totals[$fund_name]) ? $used_totals[$fund_name] : 0;
                $available = $total_allocation - $used;
                $color = isset($fund_colors[$fund_name]) ? $fund_colors[$fund_name] : 'bg-blue';
                $display_name = isset($fund_display_names[$fund_name]) ? $fund_display_names[$fund_name] : $fund_name;
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box <?php echo $color; ?>">
                    <span class="info-box-icon"><i class="fa fa-inr"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><b><?php echo $display_name; ?></b></span>
                        <span class="info-box-number">
                            Total: <?php echo number_format($total_allocation); ?><br>
                            Used: <?php echo number_format($used); ?><br>
                            Avail: <?php echo number_format($available); ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-filter"></i> Filter & Fund Details</h3>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo site_url('fundSummary'); ?>" method="get">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Regi No</label>
                                        <input type="text" name="registration_no" class="form-control" value="<?php echo $filters['registration_no']; ?>" placeholder="Search Regi No">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fund Type</label>
                                        <select name="fund_type" class="form-control">
                                            <option value="">All Funds</option>
                                            <option value="MLA FUND" <?php echo $filters['fund_type'] == 'MLA FUND' ? 'selected' : ''; ?>>MLA FUND</option>
                                            <option value="MLA Sweechanudan" <?php echo $filters['fund_type'] == 'MLA Sweechanudan' ? 'selected' : ''; ?>>MLA Swechanudan</option>
                                            <option value="CLP Sweechanudan" <?php echo $filters['fund_type'] == 'CLP Sweechanudan' ? 'selected' : ''; ?>>CLP Swechanudan</option>
                                            <option value="Jansampark Fund" <?php echo $filters['fund_type'] == 'Jansampark Fund' ? 'selected' : ''; ?>>Jansampark Fund</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Financial Year</label>
                                        <select name="financial_year" class="form-control">
                                            <option value="">All FY</option>
                                            <?php for($y=2020; $y<=2027; $y++): 
                                                $fy = $y . '-' . ($y+1);
                                                $fy_short = $y . '-' . substr($y+1, 2);
                                            ?>
                                                <option value="<?php echo $fy; ?>" <?php echo $filters['financial_year'] == $fy ? 'selected' : ''; ?>><?php echo $fy; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" name="from_date" class="form-control" value="<?php echo $filters['from_date']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" name="to_date" class="form-control" value="<?php echo $filters['to_date']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="work_status" class="form-control">
                                            <option value="">All Status</option>
                                            <option value="Incomplete" <?php echo $filters['work_status'] == 'Incomplete' ? 'selected' : ''; ?>>Incomplete</option>
                                            <option value="In progress" <?php echo $filters['work_status'] == 'In progress' ? 'selected' : ''; ?>>In Progress</option>
                                            <option value="Complete" <?php echo $filters['work_status'] == 'Complete' ? 'selected' : ''; ?>>Complete</option>
                                            <option value="Reject" <?php echo $filters['work_status'] == 'Reject' ? 'selected' : ''; ?>>Reject</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary form-control"><i class="fa fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <a href="<?php echo site_url('fundSummary'); ?>" class="btn btn-default form-control"><i class="fa fa-refresh"></i> Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Fund Summary Data</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table id="fundSummaryTable" class="table table-hover">
                            <thead>
                                <tr style="color:white;font-size:15px;background-color:#020254;">
                                    <th>Sr No</th>
                                    <th>Regi No</th>
                                    <th>Financial Year</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <!--<th>Address</th>-->
                                    <th>Source</th>
                                    <th>District</th>
                                    
                                    <th>Block</th>
                                    <th>Booth No</th>
                                    <th>Booth Name</th>
                                    <th>Assembly</th>
                                    <th>Panchayat</th>
                                    <th>Village</th>
                                    <th>Majra/Faliya</th>
                                    <th>Department</th>
                                    <th>Work/Problem</th>
                                    <th>Status</th>
                                    <th>Approved Fund</th>
                                    <th>Approximate Cost</th>
                                    <th>Work Agency</th>
                                    <th>Remark</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total_cost = 0;
                                foreach ($funds_data as $row): 
                                    $total_cost += $row['approximate_cost'];
                                ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $row['registration_no']; ?></td>
                                    <td><?php 
                                        $display_year = $row['year'];
                                        if (strlen($display_year) == 4 && is_numeric($display_year)) {
                                            $next_year = (int)$display_year + 1;
                                            $display_year = $display_year . '-' . substr($next_year, 2);
                                        }
                                        echo $display_year; 
                                    ?></td>
                                    <td><?php echo $row['uname']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>
                                    <!--<td><?php echo isset($row['address']) && !empty($row['address']) ? $row['address'] : '-'; ?></td>-->
                                    <td><span class="label <?php echo $row['source'] == 'Jansunwai' ? 'label-info' : 'label-warning'; ?>"><?php echo $row['source']; ?></span></td>
                                    <td><?php echo isset($row['district_name']) && !empty($row['district_name']) ? $row['district_name'] : '-'; ?></td>
                                    
                                    <td><?php echo isset($row['block_name']) && !empty($row['block_name']) ? $row['block_name'] : '-'; ?></td>
                                    <td><?php echo isset($row['booth_no']) && !empty($row['booth_no']) ? $row['booth_no'] : '-'; ?></td>
                                    <td><?php echo isset($row['booth_name']) && !empty($row['booth_name']) ? $row['booth_name'] : '-'; ?></td>
                                    <td><?php echo isset($row['vidhan_sabha_name']) && !empty($row['vidhan_sabha_name']) ? $row['vidhan_sabha_name'] : '-'; ?></td>
                                    <td><?php echo isset($row['panchayat_name']) && !empty($row['panchayat_name']) ? $row['panchayat_name'] : '-'; ?></td>
                                    <td><?php echo isset($row['village_name']) && !empty($row['village_name']) ? $row['village_name'] : '-'; ?></td>
                                    <td><?php echo isset($row['majra_faliya']) && !empty($row['majra_faliya']) ? $row['majra_faliya'] : '-'; ?></td>
                                    <td><?php echo isset($row['department_name']) && !empty($row['department_name']) ? $row['department_name'] : '-'; ?></td>
                                    <td><?php echo isset($row['work_problem']) && !empty($row['work_problem']) ? $row['work_problem'] : '-'; ?></td>
                                    <td>
                                        <?php 
                                        $status_class = 'label-default';
                                        if($row['work_status'] == 'Complete') $status_class = 'label-success';
                                        if($row['work_status'] == 'In progress') $status_class = 'label-warning';
                                        ?>
                                        <span class="label <?php echo $status_class; ?>"><?php echo $row['work_status']; ?></span>
                                    </td>
                                    <td><?php echo $row['approved_fund']; ?></td>
                                    <td>₹<?php echo number_format($row['approximate_cost'], 2); ?></td>
                                    <td><?php echo isset($row['work_agency']) && !empty($row['work_agency']) ? $row['work_agency'] : '-'; ?></td>
                                    <td><?php echo isset($row['remark']) && !empty($row['remark']) ? $row['remark'] : '-'; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($row['date'])); ?></td>
                                </tr>
                                <?php 
                                endforeach; 
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div style="text-align: right; padding: 10px; font-weight: bold;">
                            Total Used Fund: ₹<?php echo number_format($total_cost, 2); ?>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<!-- DataTables and related plugins -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

<style>
/* DataTables buttons styling */
.dt-buttons {
    float: left;
    margin-right: 10px;
    margin-bottom: 10px;
}

button.dt-button {
    background-color: #3c8dbc !important;
    color: white !important;
    border: 1px solid #367fa9 !important;
    padding: 8px 15px !important;
    margin-right: 5px !important;
    border-radius: 3px !important;
    font-size: 13px !important;
}

button.dt-button:hover {
    background-color: #367fa9 !important;
}

button.dt-button.buttons-excel {
    background-color: #28a745 !important;
    border-color: #218838 !important;
}

button.dt-button.buttons-excel:hover {
    background-color: #218838 !important;
}

/* Length menu styling */
.dataTables_length {
    float: left;
    margin-left: 15px;
}

.dataTables_length select {
    padding: 5px;
    border: 1px solid #d2d6de;
    border-radius: 3px;
}

/* Wrapper styling */
.dataTables_wrapper {
    overflow-x: auto;
    clear: both;
}

/* Table column width */
table.table th, 
table.table td {
    padding: 10px !important;
    font-size: 13px !important;
}

/* Style for DataTables sorting arrows */
table.dataTable thead>tr>th.sorting:after, 
table.dataTable thead>tr>th.sorting_asc:after, 
table.dataTable thead>tr>th.sorting_desc:after {
    color: #000000 !important;
    opacity: 0.6 !important;
}

table.dataTable thead>tr>th.sorting:before, 
table.dataTable thead>tr>th.sorting_asc:before, 
table.dataTable thead>tr>th.sorting_desc:before {
    color: #000000 !important;
    opacity: 0.6 !important;
}

.dataTables_info {
    float: left;
    padding-top: 15px;
}

.dataTables_paginate {
    float: right;
    padding-top: 0px;
}

.paginate_button {
    padding: 5px 10px !important;
    margin: 2px !important;
    border: 1px solid #ddd !important;
    border-radius: 3px !important;
}

.paginate_button.current {
    background-color: #3c8dbc !important;
    color: white !important;
    border-color: #367fa9 !important;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var table = $('#fundSummaryTable').DataTable({
        "processing": true,
        "serverSide": false,
        "dom": '<"top"lfB>rt<"bottom"ip>',
        "buttons": [
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-download"></i> Export Excel',
                title: 'Approved Fund Summary Report',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Print',
                title: 'Approved Fund Summary Report'
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-columns"></i> Show/Hide Columns',
                titleAttr: 'Show/Hide Columns'
            }
        ],
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "pageLength": 20,
        "lengthMenu": [
            [10, 20, 50, 100, 500, -1],
            [10, 20, 50, 100, 500, "All"]
        ],
        "order": [[17, "desc"]], // Order by Date column
        "rowCallback": function(row, data, index) {
            // Auto-increment serial number based on current page
            var pageInfo = table.page.info();
            var serialNumber = pageInfo.iStart + index + 1;
            $('td:eq(0)', row).html(serialNumber);
        }
    });
});
</script>

