<div class="content-wrapper">
    <style>
    <style>
    /* Premium Dashboard Styles */
    #pieChart { height: 400px !important; width: 100%; }
    #barChart { height: 400px !important; width: 100%; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 8px; text-align: center; }

    /* Modern Table headers */
    .table thead th {
        background-color: var(--sidebar-bg, #111827) !important;
        color: white !important;
        font-weight: 600 !important;
        font-family: 'Outfit', sans-serif !important;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        border: none !important;
        padding: 15px 10px !important;
    }
    #dashboardtable thead th { background: linear-gradient(135deg, #1e3a8a, #3b82f6) !important; color: white !important; }
    #dashboardtable1 thead th { background: linear-gradient(135deg, #064e3b, #10b981) !important; color: white !important; }
    #dashboardtable2 thead th { background: linear-gradient(135deg, #78350f, #f59e0b) !important; color: white !important; }
    .table tbody tr { transition: all 0.3s ease; }
    .table tbody tr td { border-bottom: 1px solid #f1f5f9 !important; border-top: none !important; vertical-align: middle !important; }
    
    .gray { background-color: #64748b !important; color: white !important; }
    .light-gray { background-color: #94a3b8 !important; color: white !important; }
    .dark-gray { background-color: #475569 !important; color: white !important; }

    .table thead th a { color: white !important; text-decoration: none; }
    .table thead th a:hover { color: #f8fafc !important; text-decoration: underline; }

    /* New Card Gradients & Styling */
    .small-box {
        position: relative;
        border-radius: 16px !important;
        overflow: hidden;
        color: #ffffff !important;
        margin-bottom: 25px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
        padding: 5px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .small-box .inner {
        position: relative;
        z-index: 2;
        padding: 15px !important;
        text-align: left !important;
    }
    .small-box h3 {
        font-size: 32px !important;
        font-weight: 800 !important;
        font-family: 'Outfit', sans-serif !important;
        margin: 0 0 5px 0 !important;
        letter-spacing: -1px;
    }
    .small-box h4 {
        font-size: 15px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        margin: 0 0 5px 0 !important;
        letter-spacing: 0.5px;
        opacity: 0.9;
    }
    .small-box p {
        font-size: 13px !important;
        font-weight: 400 !important;
        opacity: 0.8;
        margin: 0 !important;
    }
    
    /* Background Icon using Pseudo-element */
    .small-box::after {
        font-family: "FontAwesome";
        content: "\f200"; /* Pie chart icon */
        position: absolute;
        top: 15px;
        right: -10px;
        font-size: 70px;
        color: rgba(255,255,255,0.15);
        z-index: 1;
        transition: transform 0.4s ease;
    }
    .small-box:hover::after { transform: scale(1.1) rotate(-15deg); }
    .small-box:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }

    /* Gradients */
    .bg-aqua { background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%) !important; }
    .bg-aqua::after { content: "\f0c0"; } /* users */
    
    .bg-purple { background: linear-gradient(135deg, #8b5cf6 0%, #5b21b6 100%) !important; }
    .bg-purple::after { content: "\f19c"; } /* building */
    
    .bg-blue { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important; }
    .bg-blue::after { content: "\f0e8"; } /* sitemap */
    
    .bg-green { background: linear-gradient(135deg, #10b981 0%, #047857 100%) !important; }
    .bg-green::after { content: "\f058"; } /* check-circle */
    
    .bg-orange { background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%) !important; }
    .bg-orange::after { content: "\f071"; } /* warning */
    
    .bg-yellow { background: linear-gradient(135deg, #eab308 0%, #a16207 100%) !important; }
    .bg-yellow::after { content: "\f110"; } /* spinner */
    
    .reject-card { background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%) !important; }
    .reject-card::after { content: "\f057"; } /* times-circle */

    .reject-card .inner h3, .reject-card .inner h4, .reject-card .inner p { color: white !important; }
    
    /* Box Wrappers */
    .box.box-primary {
        border-top: none !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03) !important;
        border-radius: 16px !important;
        padding: 20px !important;
        margin-bottom: 30px !important;
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
    }

    .box-body {
        flex: 1 !important;
        display: flex !important;
        flex-direction: column !important;
    }

    .box-body canvas {
        flex: 1 !important;
    }
    
    /* Form Enhancements */
    form label { font-weight: 500 !important; color: #475569; }
    .btn-primary { border-radius: 8px !important; padding: 10px 20px !important; font-weight: 600 !important; }

    /* Section Headings */
    h3 {
        font-family: 'Outfit', sans-serif !important;
        font-weight: 700 !important;
        color: var(--sidebar-bg, #1e293b);
        margin-bottom: 20px;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 10px;
        display: inline-block;
    }

    /* 8-column layout for cards (12.5% each) */
    .row {
        display: flex !important;
        flex-wrap: wrap !important;
        margin-left: -5px !important;
        margin-right: -5px !important;
    }

    .col-lg-1-5, .col-md-1-5, .col-sm-1-5, .col-xs-12 {
        flex: 0 0 12.5% !important;
        max-width: 12.5% !important;
        padding-left: 5px !important;
        padding-right: 5px !important;
        box-sizing: border-box !important;
    }

    .col-xs-12:first-child {
        flex: 0 0 100% !important;
        max-width: 100% !important;
    }

    @media (max-width: 1200px) {
        .col-lg-1-5, .col-md-1-5, .col-sm-1-5, .col-xs-12 {
            flex: 0 0 16.666% !important;
            max-width: 16.666% !important;
        }
        .col-xs-12:first-child {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
    }

    @media (max-width: 992px) {
        .col-lg-1-5, .col-md-1-5, .col-sm-1-5, .col-xs-12 {
            flex: 0 0 20% !important;
            max-width: 20% !important;
        }
        .col-xs-12:first-child {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
    }

    @media (max-width: 768px) {
        .col-lg-1-5, .col-md-1-5, .col-sm-1-5, .col-xs-12 {
            flex: 0 0 25% !important;
            max-width: 25% !important;
        }
        .col-xs-12:first-child {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
    }

    @media (max-width: 480px) {
        .col-lg-1-5, .col-md-1-5, .col-sm-1-5, .col-xs-12 {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }
        .col-xs-12:first-child {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
    }

    /* Chart row alignment */
    .row > [class*='col-'] {
        display: flex !important;
        flex-direction: column !important;
    }

    .col-lg-6, .col-xs-6 {
        display: flex !important;
        flex-direction: column !important;
    }

    .col-lg-6 .box-primary, .col-xs-6 .box-primary {
        height: 100% !important;
    }
    </style>
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
            <small>Control panel</small>
        </h1>
    </section>
    <section class="content" style="padding-left: 10px; padding-right: 10px;">
        <!-- First Row: My Assembly Cards (8 cards total in one row) -->
        <div class="row" style="padding-left: 30px; padding-right: 30px;">
            <div class="col-xs-12">
                <h3>My Assembly</h3>
            </div>
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
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
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
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
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
                <!-- small box -->
                <a href="<?php echo base_url('user/jansunwai'); ?>" style="text-decoration: none;">
                <div class="small-box bg-blue" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php $date=date('Y-m-d');
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
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
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
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
                <!-- small box -->
                <a href="<?php echo base_url('user/jansunwai?status=Incomplete'); ?>" style="text-decoration: none;">
                <div class="small-box bg-orange" style="cursor: pointer; background-color: #9f9d15ff !important;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php $date=date('Y-m-d');
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
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
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
            <!-- ./col -->
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
                <!-- small box -->
                <div class="small-box reject-card">
                    <div class="inner" style="text-align: center;">
                        <h3><?php
                     $cc12=  $this->db->query("SELECT count(*) as totalusers FROM `jansunwai` WHERE `work_status`='Reject' ");
                     $cc122=$cc12->row();
                     echo $cc122->totalusers; ?></h3>
                        <h4>Rejected</h4>
                        <p>Public Problems</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Second Row: All MP Cards (8 cards total in one row) -->
        <div class="row" style="padding-left: 30px; padding-right: 30px; margin-top: -20px;">
            <div class="col-xs-12">
                <h3>All MP</h3>
            </div>
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
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
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
                <!-- small box -->
                <a href="<?php echo base_url('ServayListing'); ?>" style="text-decoration: none;">
                <div class="small-box bg-purple" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php 
                     $cc=  $this->db->query("SELECT count(*) as mp_total FROM `servayapp`");
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
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
                <!-- small box -->
                <a href="<?php echo base_url('Districtpublicproblem/Disctrictproblem'); ?>" style="text-decoration: none;">
                <div class="small-box bg-blue" style="cursor: pointer;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php $date=date('Y-m-d');
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
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
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
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
                <!-- small box -->
                <a href="<?php echo base_url('Districtpublicproblem/Disctrictproblem?status=Incomplete'); ?>" style="text-decoration: none;">
                <div class="small-box bg-orange" style="cursor: pointer; background-color: #9f9d15ff !important;">
                    <div class="inner" style="text-align: center;">
                        <h3><?php $date=date('Y-m-d');
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
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
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
            <div class="col-lg-1-5 col-md-1-5 col-sm-1-5 col-xs-12">
                <!-- small box -->
                <div class="small-box reject-card">
                    <div class="inner" style="text-align: center;">
                        <h3><?php
                     $cc12=  $this->db->query("SELECT count(*) as totalusers FROM `districtpublicproblem` WHERE `work_status`='Reject' ");
                     $cc122=$cc12->row();
                     echo $cc122->totalusers; ?></h3>
                        <h4>MP Rejected</h4>
                        <p>Public Problems</p>
                    </div>
                </div>
            </div>
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
                        <h3 style="text-align:center;"><b>Vidhan Sabha Party Worker Core Summary</b></h3>
                        <table class="table table-hover" id="dashboardtable1">
                            <thead>
                                <tr>
                                    <th>Block Name</th>
                                    <th>Total Count</th>
                                    <th>Today Count</th>
                                    <?php if (!empty($coding_types)) { foreach ($coding_types as $ct) : ?>
                                    <th><?php echo htmlspecialchars($ct['label']); ?></th>
                                    <?php endforeach; } ?>
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
                                    <td><?php echo isset($block->Total_Count) ? (int)$block->Total_Count : 0; ?></td>
                                    <td><?php echo isset($block->Today_Count) ? (int)$block->Today_Count : 0; ?></td>
                                    <?php foreach ($coding_types as $ct) :
                                        $col = $ct['col'];
                                        $count = isset($block->$col) ? (int)$block->$col : 0;
                                        $url = base_url('user/filterServaylisting') . '?' . $block_param . '&code=' . rawurlencode($ct['code_param']);
                                    ?>
                                    <td><a href="<?php echo $url; ?>"><?php echo $count; ?></a></td>
                                    <?php endforeach; ?>
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
                        <h3 style="text-align:center;"><b>MP Party Worker Core Summary</b></h3>
                        <table class="table table-hover" id="dashboardtable1">
                            <thead>
                                <tr>
                                    <th>Block Name</th>
                                    <th>Total Count</th>
                                    <th>Today Count</th>
                                    <?php if (!empty($coding_types)) { foreach ($coding_types as $ct) : ?>
                                    <th><?php echo htmlspecialchars($ct['label']); ?></th>
                                    <?php endforeach; } ?>
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
                                    <td><?php echo isset($block->Total_Count) ? (int)$block->Total_Count : 0; ?></td>
                                    <td><?php echo isset($block->Today_Count) ? (int)$block->Today_Count : 0; ?></td>
                                    <?php foreach ($coding_types as $ct) :
                                        $col = $ct['col'];
                                        $count = isset($block->$col) ? (int)$block->$col : 0;
                                        $url = base_url('user/filterServaylisting') . '?' . $district_param . '&code=' . rawurlencode($ct['code_param']);
                                    ?>
                                    <td><a href="<?php echo $url; ?>"><?php echo $count; ?></a></td>
                                    <?php endforeach; ?>
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

        <!-- Fund Summary Section -->
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <div class="box-body table-responsive no-padding">
                        <h3 style="text-align:center;"><b>Fund Summary</b></h3>
                        <table class="table table-hover" id="dashboardtable">
                            <thead>
                                <tr>
                                    <th>Fund Name</th>
                                    <th>Complete</th>
                                    <th>Incomplete</th>
                                    <th>In Progress</th>
                                    <th>Total</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($fund_summary)): ?>
                                <?php foreach ($fund_summary as $row): ?>
                                <tr>
                                    <td><?php echo $row->fund_name; ?></td>
                                    <td><?php echo $row->complete_count; ?></td>
                                    <td><?php echo $row->incomplete_count; ?></td>
                                    <td><?php echo $row->inprogress_count; ?></td>
                                    <td><?php echo $row->total_count; ?></td>
                                    <td><?php echo number_format($row->total_amount, 2); ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="6">No data available</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Summary Section -->
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <div class="box-body table-responsive no-padding">
                        <h3 style="text-align:center;"><b>Project Summary</b></h3>
                        <table class="table table-hover" id="dashboardtable">
                            <thead>
                                <tr>
                                    <th>Work Name</th>
                                    <th>Active</th>
                                    <th>Completed</th>
                                    <th>Pending</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($project_summary)): ?>
                                <?php foreach ($project_summary as $row): ?>
                                <tr>
                                    <td><?php echo $row->work_name; ?></td>
                                    <td><?php echo $row->active_count; ?></td>
                                    <td><?php echo $row->completed_count; ?></td>
                                    <td><?php echo $row->pending_count; ?></td>
                                    <td><?php echo $row->total_count; ?></td>
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
        </div>

        <!-- Event Summary Section -->
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <div class="box-body table-responsive no-padding">
                        <h3 style="text-align:center;"><b>Event Summary</b></h3>
                        <table class="table table-hover" id="dashboardtable">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Approved</th>
                                    <th>Pending</th>
                                    <th>Rejected</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($event_summary)): ?>
                                <?php foreach ($event_summary as $row): ?>
                                <tr>
                                    <td><?php echo $row->event_name; ?></td>
                                    <td><?php echo $row->approved_count; ?></td>
                                    <td><?php echo $row->pending_count; ?></td>
                                    <td><?php echo $row->rejected_count; ?></td>
                                    <td><?php echo $row->total_count; ?></td>
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
        </div>

        <!-- Visitor Summary Section -->
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box box-primary" style="padding-left: 10px; padding-right: 10px;">
                    <div class="box-body table-responsive no-padding">
                        <h3 style="text-align:center;"><b>Visitor Summary</b></h3>
                        <table class="table table-hover" id="dashboardtable">
                            <thead>
                                <tr>
                                    <th>District</th>
                                    <th>Total Visitors</th>
                                    <th>Today Visitors</th>
                                    <th>This Month Visitors</th>
                                    <th>This Year Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($visitor_summary)): ?>
                                <?php foreach ($visitor_summary as $row): ?>
                                <tr>
                                    <td><?php echo $row->district; ?></td>
                                    <td><?php echo $row->total_visitors; ?></td>
                                    <td><?php echo $row->today_visitors; ?></td>
                                    <td><?php echo $row->month_visitors; ?></td>
                                    <td><?php echo $row->year_visitors; ?></td>
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