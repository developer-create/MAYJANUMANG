<div class="content-wrapper">
    <style>
    #pieChart {
        height: 300px !important;
        /* Adjust the height as needed */
        width: 200px;
        /* Optionally adjust the width */
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: center;
    }

    /* Table header styling for all dashboard tables */
    .table thead th {
        background-color: #337ab7 !important; /* Bootstrap primary blue */
        color: white !important;
        font-weight: bold !important;
        text-align: center !important;
        padding: 12px 8px !important;
        border: 1px solid #2e6da4 !important;
    }

    /* Alternative styling for different sections */
    #dashboardtable thead th {
        background-color: #3c8dbc !important; /* Light blue */
        color: white !important;
    }

    #dashboardtable1 thead th {
        background-color: #00a65a !important; /* Green */
        color: white !important;
    }

    #dashboardtable2 thead th {
        background-color: #f39c12 !important; /* Orange */
        color: white !important;
    }

    .gray {
        background-color: #818589 !important;
        color: white !important;
    }

    .light-gray {
        background-color: #95a5a6 !important;
        color: white !important;
    }

    .dark-gray {
        background-color: #7f8c8d !important;
        color: white !important;
    }

    /* Hover effect for table headers */
    .table thead th:hover {
        background-color: #286090 !important;
        transition: background-color 0.3s ease;
    }

    /* Ensure text remains visible in colored headers */
    .table thead th a {
        color: white !important;
        text-decoration: none;
    }

    .table thead th a:hover {
        color: #f0f0f0 !important;
        text-decoration: underline;
    }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
            <small>Control panel</small>
        </h1>
    </section>
    <section class="content" style="padding-left: 10px; padding-right: 10px;">
        <!-- First Row: Vidhan Sabha + Public Problems Cards (6 cards total) -->
        <div class="row" style="padding-left: 30px; padding-right: 30px;">
            <h3>My Assembly</h3>
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('ServayListing'); ?>" style="text-decoration: none;">
                <div class="small-box bg-aqua" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php $date=date('Y-m-d');
                     $cc=  $this->db->query("SELECT count(*) as todaytotal FROM `servayapp` s 
                                            JOIN `block` b ON s.block_name_number = b.id 
                                            WHERE s.create_date LIKE '%$date%' AND b.name != 'Other'");
                       $ca=$cc->row();
                       echo $ca->todaytotal;
                       ?></h3>
                        <h4>Today Vidhan Sabha</h4>
                        <p>Total Member</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('ServayListing'); ?>" style="text-decoration: none;">
                <div class="small-box bg-purple" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php 
                     $cc=  $this->db->query("SELECT count(*) as vidhansabha_total FROM `servayapp` s 
                                            JOIN `block` b ON s.block_name_number = b.id 
                                            WHERE b.name != 'Other'");
                       $ca=$cc->row();
                       echo $ca->vidhansabha_total;
                       ?></h3>
                        <h4>Vidhan Sabha</h4>
                        <p>Total Member</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('user/jansunwai'); ?>" style="text-decoration: none;">
                <div class="small-box bg-blue" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php $date=date('Y-m-d');
                     //date('Y-m-d');
                     $cc1=  $this->db->query("SELECT count(*) as userstoday FROM `jansunwai` ");
                     $ca2=$cc1->row();
                     echo $ca2->userstoday;
                     ?></h3>
                        <h4>Total</h4>
                        <p>Public Problems</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('user/jansunwai?status=Complete'); ?>" style="text-decoration: none;">
                <div class="small-box bg-green" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php
                     $cc12=  $this->db->query("SELECT count(*) as totalusers FROM `jansunwai` WHERE `work_status`='Complete'");
                     $cc122=$cc12->row();
                     echo $cc122->totalusers; ?></h3>
                        <h4>Complete</h4>
                        <p>Public Problems</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('user/jansunwai?status=Incomplete'); ?>" style="text-decoration: none;">
                <div class="small-box bg-red" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php $date=date('Y-m-d');
                     //date('Y-m-d');
                     $cc1=  $this->db->query("SELECT count(*) as userstoday FROM `jansunwai` WHERE  `work_status`='Incomplete' ");
                     $ca2=$cc1->row();
                     echo $ca2->userstoday;
                     ?></h3>
                        <h4>Incomplete</h4>
                        <p>Public Problems</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('user/jansunwai?status=In progress'); ?>" style="text-decoration: none;">
                <div class="small-box bg-yellow" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php
                     $cc12=  $this->db->query("SELECT count(*) as totalusers FROM `jansunwai` WHERE    `work_status`='In progress' ");
                     $cc122=$cc12->row();
                     echo $cc122->totalusers; ?></h3>
                        <h4>In-Progress</h4>
                        <p>Public Problems</p>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <!-- Third Row: MP Member + MP Problem Cards (6 cards total) -->
        <div class="row" style="padding-left: 30px; padding-right: 30px; margin-top: -20px;">
            <h3>All MP</h3>
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('ServayListing'); ?>" style="text-decoration: none;">
                <div class="small-box bg-aqua" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php $date=date('Y-m-d');
                     $cc=  $this->db->query("SELECT count(*) as todaytotal FROM `servayapp` s 
                                            JOIN `block` b ON s.block_name_number = b.id 
                                            WHERE s.create_date LIKE '%$date%' AND b.name = 'Other'");
                       $ca=$cc->row();
                       echo $ca->todaytotal;
                       ?><sup style="font-size: 20px"></sup></h3>
                        <h4>Today MP</h4>
                        <p>Total Member</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('ServayListing'); ?>" style="text-decoration: none;">
                <div class="small-box bg-purple" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php 
                     $cc=  $this->db->query("SELECT count(*) as mp_total FROM `servayapp` s 
                                            JOIN `block` b ON s.block_name_number = b.id 
                                            WHERE b.name = 'Other'");
                       $ca=$cc->row();
                       echo $ca->mp_total;
                       ?></h3>
                        <h4>All MP</h4>
                        <p>Total Member</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('Districtpublicproblem/Disctrictproblem'); ?>" style="text-decoration: none;">
                <div class="small-box bg-blue" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php $date=date('Y-m-d');
                     //date('Y-m-d');
                     $cc1=  $this->db->query("SELECT count(*) as userstoday FROM `districtpublicproblem` ");
                     $ca2=$cc1->row();
                     echo $ca2->userstoday;
                     ?></h3>
                        <h4>MP Total</h4>
                        <p>Public Problems</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('Districtpublicproblem/Disctrictproblem?status=Complete'); ?>" style="text-decoration: none;">
                <div class="small-box bg-green" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php
                     $cc12=  $this->db->query("SELECT count(*) as totalusers FROM `districtpublicproblem` WHERE `work_status`='Complete'");
                     $cc122=$cc12->row();
                     echo $cc122->totalusers; ?></h3>
                        <h4>MP Complete</h4>
                        <p>Public Problems</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('Districtpublicproblem/Disctrictproblem?status=Incomplete'); ?>" style="text-decoration: none;">
                <div class="small-box bg-red" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php $date=date('Y-m-d');
                     //date('Y-m-d');
                     $cc1=  $this->db->query("SELECT count(*) as userstoday FROM `districtpublicproblem` WHERE  `work_status`='Incomplete' ");
                     $ca2=$cc1->row();
                     echo $ca2->userstoday;
                     ?></h3>
                        <h4>MP Incompl.</h4>
                        <p>Public Problems</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <a href="<?php echo base_url('Districtpublicproblem/Disctrictproblem?status=In progress'); ?>" style="text-decoration: none;">
                <div class="small-box bg-yellow" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php
                     $cc12=  $this->db->query("SELECT count(*) as totalusers FROM `districtpublicproblem` WHERE    `work_status`='In progress' ");
                     $cc122=$cc12->row();
                     echo $cc122->totalusers; ?></h3>
                        <h4>MP InProg.</h4>
                        <p>Public Problems</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <form method="post" action="<?php echo base_url('user/index'); ?>">
                        <div class="row">
                            <!-- Start Date -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="<?php echo set_value('start_date'); ?>">
                                </div>
                            </div>
                            <!-- End Date -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        value="<?php echo set_value('end_date'); ?>">
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="col-md-4 col-sm-12 col-xs-12 d-flex align-items-end " style="margin-top: 22px;">
                                <div class="form-group">
                                    <label for=" "></label>
                                    <button type="submit" class="btn btn-primary">Filter Graph Data</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-xs-6">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <h4 style="margin-left: 20px;">Status By Block</h4>
                    <button onclick="printChart('barChart')" class="btn btn-primary">Print Bar Chart</button>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
            <div class="col-lg-6 col-xs-6">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <h4 style="margin-left: 20px;">Over-All Status</h4>
                    <button onclick="printChart('pieChart')" class="btn btn-primary">Print Pie Chart</button>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <form method="post" action="<?php echo base_url('user/index'); ?>">
                        <div class="row">
                            <!-- Start Block -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="block">Start Block:</label>
                                    <select id="block" name="blockname" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach($Allblocks as $eachblock) { ?>
                                        <option value="<?php echo $eachblock->id ?>"><?php echo $eachblock->name ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Start Date -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="<?php echo set_value('start_date'); ?>">
                                </div>
                            </div>
                            <!-- End Date -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        value="<?php echo set_value('end_date'); ?>">
                                </div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="box-body table-responsive no-padding">
                        <h3 style="text-align:center;"><b>My Assembly Department - Summary Report</b></h3>
                        <table class="table table-hover" id="dashboardtable">
                            <thead>
                                <tr>
                                    <th>Department Name</th>
                                    <th>Complete</th>
                                    <th>Incomplete</th>
                                    <th>In Progress</th>
                                    <th>Total</th>
                                    <!-- New Total column -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($results)): ?>
                                <?php foreach ($results as $row): ?>
                                <tr>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=&stage=&status=<?php echo $row->work_statuses ?>&department=<?php echo $row->department_id ?>">
                                            <?php echo $row->department_name; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=&stage=&status=Complete&department=<?php echo $row->department_id ?>">
                                            <?php echo $row->complete_count; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=&stage=&status=Incomplete&department=<?php echo $row->department_id ?>">
                                            <?php echo $row->incomplete_count; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=&stage=&status=In progress&department=<?php echo $row->department_id ?>">
                                            <?php echo $row->inprogress_count; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=&stage=&status=&department=<?php echo $row->department_id ?>">
                                            <?php echo $row->total_count; ?>
                                        </a>
                                    </td>
                                    <!-- Display total -->
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="5">No data available</td>
                                    <!-- Adjust colspan for total column -->
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <div class="box-body table-responsive no-padding">
                        <h3 style="text-align:center;"><b>MP Public Problems Department - Summary Report</b></h3>
                        <table class="table table-hover" id="dashboardtable">
                            <thead>
                                <tr>
                                    <th>Department Name</th>
                                    <th>Complete</th>
                                    <th>Incomplete</th>
                                    <th>In Progress</th>
                                    <th>Total Problems</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($public_problems_dept_summary)): ?>
                                <?php foreach ($public_problems_dept_summary as $row): ?>
                                <tr>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>Districtpublicproblem/Disctrictproblem?department=<?php echo $row->department_id ?>">
                                            <?php echo $row->department_name; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>Districtpublicproblem/Disctrictproblem?status=Complete&department=<?php echo $row->department_id ?>">
                                            <?php echo $row->completed; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a style="color:red;"
                                            href="<?php echo base_url()?>Districtpublicproblem/Disctrictproblem?status=Incomplete&department=<?php echo $row->department_id ?>">
                                            <?php echo $row->incomplete; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterdistrictpublicproblemlist?block=&stage=&status=In progress&department=<?php echo $row->department_id ?>">
                                            <?php echo $row->in_progress; ?>
                                        </a>
                                    </td>
                                    <td> <?php echo $row->total_problems; ?> </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="5">No data available</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <div class="box-body table-responsive no-padding">
                        <h3 style="text-align:center;"><b>MP Public Problems - Summary Report</b></h3>
                        <table class="table table-hover" id="dashboardtable2">
                            <thead>
                                <tr>
                                    <th>Total Records</th>
                                    <th>Today Records</th>
                                    <th>Total Incomplete</th>
                                    <th>Total Complete</th>
                                    <th>In Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($public_problems_summary)): ?>
                                <?php foreach ($public_problems_summary as $row): ?>
                                <tr>
                                    <td><?php echo $row->total_records; ?></td>
                                    <td><?php echo $row->today_records; ?></td>
                                    <td style="color:red;"><?php echo $row->total_incomplete; ?></td>
                                    <td><?php echo $row->total_complete; ?></td>
                                    <td><?php echo $row->in_progress; ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="7">No records found</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <div class="box-body table-responsive no-padding">
                        <h3 style="text-align:center;"><b>Public Problems - Summary Report</b></h3>
                        <table class="table table-hover" id="dashboardtable">
                            <thead>
                                <tr>
                                    <th>Block Name</th>
                                    <th>Total Records</th>
                                    <th>Today Records</th>
                                    <th>Total Incomplete</th>
                                    <th>Total Complete</th>
                                    <th class="gray">Stage 1 - Incomplete</th>
                                    <th class="gray">Stage 1 - Complete</th>
                                    <th class="gray">Stage 1 - In-progress</th>
                                    <th class="dark-gray">Stage 2 - Incomplete</th>
                                    <th class="dark-gray">Stage 2 - Complete</th>
                                    <th class="dark-gray">Stage 2 - In-progress</th>
                                    <th class="light-gray">Stage 3 - Incomplete</th>
                                    <th class="light-gray">Stage 3 - Complete</th>
                                    <th class="light-gray">Stage 3 - In-progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($records)): ?>
                                <?php foreach($records as $row): ?>
                                <?php 
                           $total_incomplete = $row->stage_1_incomplete + $row->stage_2_incomplete + $row->stage_3_incomplete;
                           $total_complete = $row->stage_1_complete + $row->stage_2_complete + $row->stage_3_complete;
                        ?>
                                <tr>
                                    <td><?= $row->block_name ?></td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=&status=">
                                            <?= $row->total_records ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=1&status=">
                                            <?= $row->today_count ?>
                                        </a>
                                    </td>
                                    <td style="color:red;">
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=&status=Incomplete">
                                            <?= $total_incomplete ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=&status=complete">
                                            <?= $total_complete ?>
                                        </a>
                                    </td>
                                    <td style="color:red;">
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=1&status=Incomplete">
                                            <?= $row->stage_1_incomplete ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=1&status=complete">
                                            <?= $row->stage_1_complete ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=1&status=In progress">
                                            <?= $row->stage_1_in_progress ?>
                                        </a>
                                    </td>
                                    <td style="color:red;">
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=2&status=Incomplete">
                                            <?= $row->stage_2_incomplete ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=2&status=complete">
                                            <?= $row->stage_2_complete ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=2&status=In progress">
                                            <?= $row->stage_2_in_progress ?>
                                        </a>
                                    </td>
                                    <td style="color:red;">
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=3&status=Incomplete">
                                            <?= $row->stage_3_incomplete ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=3&status=complete">
                                            <?= $row->stage_3_complete ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php echo base_url()?>user/filterJansunwai?block=<?php echo $row->block_id ?>&stage=3&status=In progress">
                                            <?= $row->stage_3_in_progress ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="14">No records found</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <div class="box-body table-responsive no-padding">
                        <h3 style="text-align:center;"><b>New Member Summary</b></h3>
                        <table class="table table-hover" id="dashboardtable1">
                            <thead>
                                <tr>
                                    <th>Block Name</th>
                                    <?php if (!empty($coding_types)) { foreach ($coding_types as $ct) : ?>
                                    <th><?php echo htmlspecialchars($ct['label']); ?></th>
                                    <?php endforeach; } ?>
                                    <th>Total Count</th>
                                    <th>Today Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $coding_types = isset($coding_types) ? $coding_types : [];
                                if (!empty($blocks)) :
                                    foreach ($blocks as $block) :
                                        $block_param = isset($block->block_id) ? 'block=' . $block->block_id : 'block=';
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($block->BlockName); ?></td>
                                    <?php foreach ($coding_types as $ct) :
                                        $col = $ct['col'];
                                        $count = isset($block->$col) ? (int)$block->$col : 0;
                                        $url = base_url('user/filterServaylisting') . '?' . $block_param . '&code=' . rawurlencode($ct['code_param']);
                                    ?>
                                    <td><a href="<?php echo $url; ?>"><?php echo $count; ?></a></td>
                                    <?php endforeach; ?>
                                    <td><?php echo isset($block->Total_Count) ? (int)$block->Total_Count : 0; ?></td>
                                    <td><?php echo isset($block->Today_Count) ? (int)$block->Today_Count : 0; ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else : ?>
                                <tr>
                                    <td colspan="<?php echo count($coding_types) + 3; ?>">No data available.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <div class="box-body table-responsive no-padding">
                        <h3 style="text-align:center;"><b>New Member Summary District</b></h3>
                        <table class="table table-hover" id="dashboardtable1">
                            <thead>
                                <tr>
                                    <th>Block Name</th>
                                    <?php if (!empty($coding_types)) { foreach ($coding_types as $ct) : ?>
                                    <th><?php echo htmlspecialchars($ct['label']); ?></th>
                                    <?php endforeach; } ?>
                                    <th>Total Count</th>
                                    <th>Today Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($districts)) :
                                    foreach ($districts as $block) :
                                        $district_param = isset($block->district_id) ? 'district_id=' . $block->district_id : 'district_id=';
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($block->DistrictName); ?></td>
                                    <?php foreach ($coding_types as $ct) :
                                        $col = $ct['col'];
                                        $count = isset($block->$col) ? (int)$block->$col : 0;
                                        $url = base_url('user/filterServaylisting') . '?' . $district_param . '&code=' . rawurlencode($ct['code_param']);
                                    ?>
                                    <td><a href="<?php echo $url; ?>"><?php echo $count; ?></a></td>
                                    <?php endforeach; ?>
                                    <td><?php echo isset($block->Total_Count) ? (int)$block->Total_Count : 0; ?></td>
                                    <td><?php echo isset($block->Today_Count) ? (int)$block->Today_Count : 0; ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else : ?>
                                <tr>
                                    <td colspan="<?php echo count($coding_types) + 3; ?>">No data available.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./col -->
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
    $('#dashboardtable, #dashboardtable1').DataTable({
        "processing": true,
        "serverSide": false,
        "dom": '<"top"lfB>rt<"bottom"ip>',
        "buttons": [{
            extend: 'excelHtml5',
            text: 'Export Excel',
            title: 'List'
        }],
        "paging": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "lengthMenu": [
            [10, 25, 50, 75, -1],
            [10, 25, 50, 75, "All"]
        ]
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('pieChart').getContext('2d');

// Data for pie chart
var statusCountData = <?php echo json_encode($status_count); ?>;
var statuses = [];
var counts = [];
var colors = {
    'Incomplete': 'red',
    'Complete': '#18d94b',
    'In progress': '#FFCE56'
};

// Prepare data for pie chart
statusCountData.forEach(function(item) {
    statuses.push(item.work_status);
    counts.push(item.total);
});

// Create pie chart
var pieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: statuses.map(function(status, index) {
            // Adding count with each label
            return `${status} (${counts[index]} records)`;
        }),
        datasets: [{
            data: counts,
            backgroundColor: statuses.map(status => colors[status] || '#CCCCCC'),
            hoverOffset: 4
        }]
    },
    options: {
        plugins: {
            legend: {
                display: true,
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        var label = tooltipItem.label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += tooltipItem.raw + ' records';
                        return label;
                    }
                }
            }
        }
    }
});
</script>
<script>
var ctx = document.getElementById('barChart').getContext('2d');

// Data for bar chart
var statusCountData = <?php echo json_encode($status_count_by_block); ?>;
var blocks = [];
var incompleteCounts = [];
var completeCounts = [];
var inProgressCounts = [];

statusCountData.forEach(function(item) {
    var index = blocks.indexOf(item.block_name);
    if (index === -1) {
        blocks.push(item.block_name);
        incompleteCounts.push(0);
        completeCounts.push(0);
        inProgressCounts.push(0);
        index = blocks.length - 1;
    }
    if (item.work_status === 'Incomplete') {
        incompleteCounts[index] += item.total;
    } else if (item.work_status === 'Complete') {
        completeCounts[index] += item.total;
    } else if (item.work_status === 'In progress') {
        inProgressCounts[index] += item.total;
    }
});

var barChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: blocks,
        datasets: [{
            label: 'Incomplete',
            data: incompleteCounts,
            backgroundColor: 'red',
        }, {
            label: 'Complete',
            data: completeCounts,
            backgroundColor: '#18d94b',
        }, {
            label: 'In Progress',
            data: inProgressCounts,
            backgroundColor: '#FFCE56',
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Print chart function
function printChart(chartId) {
    var chartCanvas = document.getElementById(chartId);
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Print Chart</title></head><body>');
    printWindow.document.write('<img src="' + chartCanvas.toDataURL() + '"/>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
}
</script>