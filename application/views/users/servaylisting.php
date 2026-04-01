<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Member Management
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php
               $this->load->helper('form');
               $error = $this->session->flashdata('error');
               if($error)
               {
               ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php } ?>
                <?php  
               $success = $this->session->flashdata('success');
               if($success)
               {
               ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Member List</h3>
                        <a href="<?php echo base_url() ?>ServayController/createServay"
                            class="btn btn-info btn-sm pull-right  ">Add New</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#all-records" aria-controls="all-records" role="tab" data-toggle="tab" data-tab="all">All Records</a>
                            </li>
                            <li role="presentation">
                                <a href="#vidhan-sabha-records" aria-controls="vidhan-sabha-records" role="tab" data-toggle="tab" data-tab="vidhan-sabha">Vidhan Sabha Member</a>
                            </li>
                            <li role="presentation">
                                <a href="#mp-records" aria-controls="mp-records" role="tab" data-toggle="tab" data-tab="mp">MP Member</a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="all-records">
                                <br>
                                <!-- Filter Form for All Records -->
                                <div id="filter-form">
                                    <form method="post" action="<?php echo base_url('user/servaylisting'); ?>">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="block">Block</label>
                                                    <select name="block" id="block" class="form-control">
                                                        <option value="">Select Block</option>
                                                        <?php
                                                  $userid = $this->session->userdata('userId');
                                                  $sessionBlockId = $this->session->userdata('blockId');
                                                  //  $this->db->where('id !=', 6);
                                                  if ($sessionBlockId != 0) {
                                                      $userBlockIds = $this->db->select('blockId')
                                                         ->from('tbl_users')
                                                         ->where('userId', $userid)
                                                         ->get()
                                                         ->row()
                                                         ->blockId;
                                                         
                                                         $blockIdsArray = explode(',', $userBlockIds);
                                                         $this->db->where_in('block.id', $blockIdsArray);
                                                  }
                                                  $blocks = $this->db->get('block')->result();
                                                  foreach ($blocks as $blk) {
                                                     echo "<option value='{$blk->id}'>{$blk->name}</option>";
                                                  }
                                                  ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="year">Year</label>
                                                    <select name="year" id="year" class="form-control">
                                                        <option value="">Select Year</option>
                                                        <?php
                                                  // Generate year options
                                                  $current_year = date('Y');
                                                  for ($i = $current_year; $i >= $current_year - 5; $i--) {
                                                      echo "<option value='{$i}'>{$i}</option>";
                                                  }
                                                  ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="vehicle">Vehicle</label>
                                                    <select name="vehicle" id="vehicle" class="form-control">
                                                        <option value="">Select Vehicle</option>
                                                        <?php
                                                  $months = [
                                                      '2 व्हीलर' => '2 व्हीलर',
                                                      '4 व्हीलर' => '4 व्हीलर',
                                                      '2 व्हीलर,4 व्हीलर' => 'Both', 
                                                  ];
                                                  foreach ($months as $key => $value) {
                                                      echo "<option value='{$key}'>{$value}</option>";
                                                  }
                                                  ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="samithi">Samiti</label>
                                                    <select name="samithi" id="samithi" class="form-control">
                                                        <option value="">Select Samiti</option>
                                                        <?php
                                                  // Fetch blocks from database
                                                  $blocks = $this->db->get('samiti')->result();
                                                  foreach ($blocks as $blk) {
                                                      echo "<option value='{$blk->id}'>{$blk->name}</option>";
                                                  }
                                                  ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="district">District</label>
                                                    <select name="district" id="filter_district" class="form-control">
                                                        <option value="">Select District</option>
                                                        <?php
                                                        if (!empty($districts_list)) {
                                                            foreach ($districts_list as $d) {
                                                                echo '<option value="' . (int)$d->id . '">' . htmlspecialchars($d->name) . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="vidhan_sabha_id">Vidhan Sabha</label>
                                                    <select name="vidhan_sabha_id" id="filter_vidhan_sabha" class="form-control">
                                                        <option value="">Select Vidhan Sabha</option>
                                                        <option value="0">N/A (no Vidhan Sabha)</option>
                                                        <?php
                                                        if (!empty($vidhan_sabhas_list)) {
                                                            foreach ($vidhan_sabhas_list as $vs) {
                                                                $vsId = isset($vs['id']) ? $vs['id'] : $vs->id;
                                                                $vsName = isset($vs['vidhan_sabha_name']) ? $vs['vidhan_sabha_name'] : $vs->vidhan_sabha_name;
                                                                $dName = isset($vs['district_name']) ? $vs['district_name'] : (isset($vs->district_name) ? $vs->district_name : '');
                                                                echo '<option value="' . (int)$vsId . '">' . htmlspecialchars($vsName) . ($dName ? ' (' . htmlspecialchars($dName) . ')' : '') . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="code">Code</label>
                                                    <select name="code" id="code" class="form-control">
                                                        <option value="">Select Code</option>
                                                        <option value="SC">SC</option>
                                                        <option value="YC">YC</option>
                                                        <option value="WC">WC</option>
                                                        <option value="PA">PA</option>
                                                        <option value="SM">SM</option>
                                                        <option value="EO">EO</option>
                                                        <option value="GS">GS</option>
                                                        <option value="DCC">DCC</option>
                                                        <option value="PW">PW</option>
                                                        <option value="NL">NL</option>
                                                        <option value="FR">FR</option>
                                                        <option value="SO">SO</option>
                                                        <option value="ST">ST</option>
                                                        <option value="REF">REF</option>
                                                        <option value="US">US</option>
                                                        <option value="SMW">SMW</option>
                                                        <option value="DYC">DYC</option>
                                                        <option value="OBC">OBC</option>
                                                        <option value="DT">DT</option>
                                                        <option value="DP">DP</option>
                                                        <option value="MLA">MLA</option>
                                                        <option value="AVP">AVP</option>
                                                        <option value="MEET">MEET</option>
                                                        <option value="MEDIA">MEDIA</option>
                                                        <option value="X MLA">X MLA</option>
                                                        <option value="BC (बूथ कमेटी)">BC (बूथ कमेटी)</option>
                                                        <option value="PP (पेज प्रभारी)">PP (पेज प्रभारी)</option>
                                                        <option value="IP (प्रभावशाली व्यक्ति)">IP (प्रभावशाली व्यक्ति)</option>
                                                        <option value="FH (परिवार का मुखिया)">FH (परिवार का मुखिया)</option>
                                                        <option value="SMM (सोशल मीडिया मित्र)">SMM (सोशल मीडिया मित्र)</option>
                                                        <option value="MS (महिला समिति)">MS (महिला समिति)</option>
                                                        <option value="FP (फलिया प्रभारी)">FP (फलिया प्रभारी)</option>
                                                        <option value="ER (चुनाव प्रभारी)">ER (चुनाव प्रभारी)</option>
                                                        <option value="वरिष्ठ">वरिष्ठ</option>
                                                        <option value="युवा">युवा</option>
                                                        <option value="वोटरप्रभारी(१० घर)">वोटरप्रभारी(१० घर)</option>
                                                        <option value="BLA (बूथ लेवल एजेंट)">BLA (बूथ लेवल एजेंट)</option>
                                                        <option value="FM (दानदाता)">FM (दानदाता)</option>
                                                        <option value="AK (नवीन सदस्‍य को सक्रिय करना)">AK (नवीन सदस्‍य को सक्रिय करना)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" class="btn btn-primary form-control">Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="vidhan-sabha-records">
                                <br>
                                <p class="text-info">Showing Vidhan Sabha Members (records with block values, excluding Other)</p>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="mp-records">
                                <br>
                                <p class="text-info">Showing MP Members (records with "Other" block designation)</p>
                            </div>
                        </div>
                        
                        <!-- Main Data Table (Always Visible) -->
                        <div class="table-responsive" style="margin-top: 15px;">
                        <table id="feedbackTa" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="color:white;font-size:15px;background:#020254;">
                                            <th>#</th>
                                            <th>Created By</th>
                                            <th>District</th>
                                            <th>Vidhan Sabha</th>
                                            <th>Name</th>
                                            <th>Votar Id</th>
                                            <th>Mobile</th>
                                            <th>Father Name</th>
                                            <th>Date Of Birth</th>
                                            <th>Date Of marriage</th>
                                            <th>Block Name</th>
                                            <th>Janpad Panchayat</th>
                                            <th>Mandalam</th>
                                            <th>Booth Name</th>
                                            <th>Booth Number</th>
                                            <th>Grampanchayat</th>
                                            <th>Village</th>
                                            <th>Samiti</th>

                                            <th>Toll/Majra</th>
                                            <th>Caste</th>
                                            <th>Age</th>
                                            <th>Education</th>
                                            <th>Address</th>
                                            <th>Gender</th>
                                            <th>Vehicle</th>
                                            <th>Group</th>
                                            <th>Government Employee</th>
                                            <th>Party</th>
                                            <th>पद वर्ष </th>
                                            <th>Code</th>
                                            <th>Nari Samman Yojna </th>
                                            <th>Farmer Loan Waiver</th>
                                            <th>Facebook</th>
                                            <th>Instagram</th>
                                            <th>Twitter</th>
                                            <th>Reference</th>
                                            <th>Remark</th>
                                            <th>Start Lat</th>
                                            <th>Start long</th>
                                            <th>Start Date</th>
                                            <th>End Lat</th>
                                            <th>End long</th>
                                            <th>End Date</th>
                                            <th>Image</th>
                                            <th>Created On</th>
                                            <th>Update Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                 if(!empty($userRecords))
                                 {
                                     $i=1;
                                     foreach($userRecords  as  $key => $record)
                                     {
                                         if($record->servayid!='own')
                                         {
                                 ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php $uid=$record->user_id;
                                    if($uid!='')
                                    {
                                    $cc=$this->db->query("SELECT * FROM `tbl_users` WHERE `userId`='$uid'");
                                    @$Uu=$cc->row();
                                    if(@$Uu->name!='')
                                    {
                                        echo @$Uu->name;
                                    }
                                    }
                                    ?></td>
                                            <td>
                                                <?php $district_id= $record->district;
                                       $q=$this->db->query("SELECT * FROM `district` WHERE `id`='$district_id' ");
                                       $row=$q->row();
                                       if(!empty($row)){
                                       echo $row->name;
                                       }
                                       ?>
                                            </td>
                                            <td>
                                                <?php
                                                $vidhan_sabha_id = isset($record->vidhan_sabha_id) ? $record->vidhan_sabha_id : null;
                                                if (!empty($vidhan_sabha_id) && (int)$vidhan_sabha_id > 0) {
                                                    $vsq = $this->db->query("SELECT vidhan_sabha_name FROM vidhan_sabha WHERE id = " . (int)$vidhan_sabha_id);
                                                    $vsrow = $vsq ? $vsq->row() : null;
                                                    echo $vsrow ? htmlspecialchars($vsrow->vidhan_sabha_name) : 'N/A';
                                                } else {
                                                    echo 'N/A';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo @$record->name ?></td>
                                            <td><?php echo @$record->votarcode ?></td>
                                            <td><?php echo @$record->mobile ?></td>
                                            <td><?php echo @$record->fathername ?></td>
                                             <td><?php if(!empty($record->dob) && $record->dob != '0000-00-00'){ echo date('d-m-Y',strtotime($record->dob));} ?>
                                             </td>
                                             <td><?php if(!empty($record->dom) && $record->dom != '0000-00-00'){ echo date('d-m-Y',strtotime($record->dom));} ?>
                                             </td>
                                            <td>
                                                <?php $block_name_number= $record->block_name_number;
                                       $q=$this->db->query("SELECT * FROM `block` WHERE `id`='$block_name_number' ");
                                       $row=$q->row();
                                       if(!empty($row)){
                                       echo $row->name;
                                       }
                                       ?>
                                            </td>
                                            <td><?php echo @$record->janpad_panchayat; ?></td>
                                            <td><?php echo @$record->mandalam; ?></td>
                                            <td>
                                                <?php $boothnumber= $record->boothname;
                                       $q=$this->db->query("SELECT * FROM `booth` WHERE `id`='$boothnumber' ");
                                       $row=$q->row();
                                       if(!empty($row)){
                                       echo $row->name;
                                       }
                                       ?>
                                            </td>
                                            <td><?php echo @$record->boothnumber; ?> </td>
                                            <td>
                                                <?php $grampanchayat= $record->grampanchayat;
                                       $q=$this->db->query("SELECT * FROM `panchayat` WHERE `id`='$grampanchayat' ");
                                       $row=$q->row();
                                       if(!empty($row)){
                                       echo $row->name;
                                       }
                                       ?>
                                            </td>
                                            <td>
                                                <?php $village= $record->village;
                                       $q=$this->db->query("SELECT * FROM `village` WHERE `id`='$village' ");
                                       $row=$q->row();
                                       if(!empty($row)){
                                       echo $row->name;
                                       }
                                       ?>
                                            </td>
                                            <td>
                                                <?php $samiti= $record->samithi;
                                       $q=$this->db->query("SELECT * FROM `samiti` WHERE `id`='$samiti' ");
                                       $row=$q->row();
                                       if(!empty($row)){
                                       echo $row->name;
                                       }
                                       ?>
                                            </td>

                                            <td><?php echo @$record->toll;  ?></td>
                                            <td><?php echo @$record->jaati; ?></td>
                                            <td><?php echo @$record->age; ?></td>
                                            <td><?php echo @$record->education; ?></td>
                                            <td><?php echo @$record->address; ?></td>
                                            <td><?php echo @$record->gender; ?></td>
                                            <td><?php echo @$record->vehicle; ?></td>
                                            <td><?php echo @$record->group; ?></td>
                                            <td><?php echo @$record->government_employee; ?></td>
                                            <td>
                                                <?php $parti= $record->parti;
                                       $q=$this->db->query("SELECT * FROM `party` WHERE `id`='$parti' ");
                                       $row=$q->row();
                                       if(!empty($row)){
                                       echo $row->name;
                                       }
                                       ?>
                                            </td>
                                            <td><?php echo @$record->padvarsh; ?></td>
                                            <td><?php echo @$record->code; ?></td>
                                            <td><?php echo @$record->respect_for_women; ?></td>
                                            <td><?php echo @$record->farmer_loan_waiver; ?></td>
                                            <td><?php echo @$record->facebook; ?></td>
                                            <td><?php echo @$record->instagram; ?></td>
                                            <td><?php echo @$record->twitter; ?></td>
                                            <td><?php echo @$record->reference; ?></td>
                                            <td><?php echo @$record->remark; ?></td>
                                            <td><?php echo @$record->lat; ?></td>
                                            <td><?php echo @$record->long; ?></td>
                                            <td><?php echo @$record->startdate; ?></td>
                                            <td><?php echo @$record->end_lat; ?></td>
                                            <td><?php echo @$record->end_long; ?></td>
                                            <td><?php echo @$record->enddate; ?></td>
                                            <td><?php if(@$record->image!=''){ ?>
                                                <a href='<?php echo base_url() ?>uploads/userservey/<?php echo $record->image; ?>'
                                                    class="btn btn-sm btn-primary" target="_blank" title="View Image">
                                                    <i class="fa fa-eye"></i>
                                                    view File
                                                </a>
                                                <?php }else{ echo"No-Image";} ?>
                                            </td>
                                            <td><?php echo $record->create_date ?></td>
                                            <td><?php echo @$record->update_date ?></td>
                                            <td class="text-center">
                                                <!--<a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->id; ?>" title="Login history"><i class="fa fa-history"></i></a> | -->
                                                <a class="btn btn-sm btn-info"
                                                    href="<?php echo base_url().'ServayController/editServay/'.$record->id; ?>"
                                                    title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-sm btn-info"
                                                    href="<?php echo base_url().'editservayview/'.$record->id; ?>"
                                                    title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a class="btn btn-sm btn-danger"
                                                    href="<?php echo base_url().'User/deletestatus/'.$record->id; ?>"
                                                    data-userid="<?php echo $record->id; ?>" title="Delete"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                 }
                                 }
                                 }
                                 ?>
                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>

<!-- Survey Detail Modal -->
<div class="modal fade" id="surveyDetailModal" tabindex="-1" role="dialog" aria-labelledby="surveyDetailModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="surveyDetailModalLabel"><i class="fa fa-user"></i> Survey Details - <span id="modal-title-name"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div id="modal-image-container" style="margin-bottom: 20px;">
                            <!-- Image will be injected here -->
                        </div>
                        <div class="well well-sm">
                            <span class="detail-label">Votar ID / Code</span>
                            <span class="detail-value"><span id="modal-votar-id"></span> / <span id="modal-code"></span></span>
                        </div>
                        <div class="well well-sm">
                            <span class="detail-label">Created Date</span>
                            <span class="detail-value" id="modal-created-date"></span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <!-- Column 1 -->
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Member Name</span>
                                <span class="detail-value" id="modal-name"></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Father Name</span>
                                <span class="detail-value" id="modal-father"></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Gender / Age</span>
                                <span class="detail-value"><span id="modal-gender"></span> / <span id="modal-age"></span> yrs</span>
                            </div>
                            
                            <!-- Column 2 -->
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Block</span>
                                <span class="detail-value" id="modal-block"></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Janpad Panchayat</span>
                                <span class="detail-value" id="modal-janpad"></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Mandalam</span>
                                <span class="detail-value" id="modal-mandalam"></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Panchayat</span>
                                <span class="detail-value" id="modal-panchayat"></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Village</span>
                                <span class="detail-value" id="modal-village"></span>
                            </div>

                            <!-- Column 3 -->
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Booth / Number</span>
                                <span class="detail-value"><span id="modal-booth-name"></span> (<span id="modal-booth-no"></span>)</span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Toll</span>
                                <span class="detail-value" id="modal-toll"></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Mobile</span>
                                <span class="detail-value" id="modal-mobile"></span>
                            </div>

                            <!-- Column 4 -->
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Education</span>
                                <span class="detail-value" id="modal-education"></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Cast (Jaati)</span>
                                <span class="detail-value" id="modal-jaati"></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Address</span>
                                <span class="detail-value" id="modal-address"></span>
                            </div>

                            <!-- Column 5 -->
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">DOB / DOM</span>
                                <span class="detail-value"><span id="modal-dob"></span> / <span id="modal-dom"></span></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Vehicle</span>
                                <span class="detail-value" id="modal-vehicle"></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Group</span>
                                <span class="detail-value" id="modal-group"></span>
                            </div>

                            <!-- Column 6 -->
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Govt Employee</span>
                                <span class="detail-value" id="modal-gov-emp"></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Party / Post Year</span>
                                <span class="detail-value"><span id="modal-party"></span> / <span id="modal-pad"></span></span>
                            </div>
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Reference</span>
                                <span class="detail-value" id="modal-reference"></span>
                            </div>

                            <!-- Row 7 -->
                            <div class="col-md-4 modal-detail-row">
                                <span class="detail-label">Nari Samman / Loan Waiver</span>
                                <span class="detail-value"><span id="modal-nari"></span> / <span id="modal-loan"></span></span>
                            </div>
                            <div class="col-md-8 modal-detail-row">
                                <span class="detail-label">Remark</span>
                                <span class="detail-value" id="modal-remark"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Social Media & Technical Details -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading"><b>Social Media</b></div>
                            <div class="panel-body">
                                <div><b>FB:</b> <span id="modal-fb"></span></div>
                                <div><b>IG:</b> <span id="modal-ig"></span></div>
                                <div><b>TW:</b> <span id="modal-tw"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Samiti & Technical Details</b></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>Samiti:</b> <span id="modal-samiti"></span><br>
                                        <b>Created By:</b> <span id="modal-member-id"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Start:</b> <span id="modal-start-date"></span> (<span id="modal-start-lat"></span>, <span id="modal-start-long"></span>)<br>
                                        <b>End:</b> <span id="modal-end-date"></span> (<span id="modal-end-lat"></span>, <span id="modal-end-long"></span>)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="#" id="modal-edit-btn" class="btn btn-primary">Edit Record</a>
            </div>
        </div>
    </div>
</div>
<!-- DataTables and related plugins -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<style>
    #feedbackTa tbody tr {
        cursor: pointer;
    }
    #feedbackTa tbody tr:hover {
        background-color: #f5f5f5;
    }
    .modal-detail-row {
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
        padding-bottom: 8px;
    }
    .detail-label {
        font-weight: bold;
        color: #555;
        display: block;
        text-transform: uppercase;
        font-size: 0.85em;
    }
    .detail-value {
        font-size: 1.1em;
        word-break: break-all;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script>
// Custom search function for member filtering
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        // Only apply to our specific table
        if (settings.nTable.id !== 'feedbackTa') {
            return true;
        }
        
        // Get active tab
        var activeTab = $('ul.nav-tabs li.active a').attr('data-tab');
        
        if (activeTab === 'all') {
            return true; // Show all records
        } else if (activeTab === 'vidhan-sabha') {
            // Vidhan Sabha Members: records with any block value (not empty, not Other)
            // Block Name column is index 9 (0-based)
            var blockName = data[9] || ''; // Get block name from column
            return blockName.trim() !== '' && blockName.trim() !== '-' && blockName.trim() !== 'N/A' && blockName.trim().toLowerCase() !== 'other';
        } else if (activeTab === 'mp') {
            // MP Members: records with "Other" block designation  
            // Block Name column is index 9 (0-based)
            var blockName = data[9] || '';
            return blockName.trim().toLowerCase() === 'other';
        }
        
        return true;
    }
);

$(document).ready(function() {
    // Initialize DataTable
    var table = $('#feedbackTa').DataTable({
        "processing": true,
        "serverSide": false,
        "dom": '<"top"lfB>rt<"bottom"ip>',
        "buttons": [{
            extend: 'excelHtml5',
            text: 'Export Excel',
            title: 'Member List'
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
    
    // Tab click handler
    $('ul.nav-tabs a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        // Update active tab tracking
        $('ul.nav-tabs li').removeClass('active');
        $(this).parent().addClass('active');
        
        // Show/hide filter form based on active tab
        var activeTab = $(this).attr('data-tab');
        if (activeTab === 'all') {
            $('#filter-form').show();
        } else {
            $('#filter-form').hide();
        }
        
        // Redraw table to apply new filter
        table.draw();
    });

    // Row click handler
    $('#feedbackTa tbody').on('click', 'tr', function() {
        var data = table.row(this).data();
        if (!data) return;

        // Indices:
        // 1: Member (User) Name, 3: Applicant Name, 4: Votar Id, 5: Mobile, 6: Father, 7: DOB, 8: DOM
        // 9: Block, 10: Booth Name, 11: Booth No, 12: Grampanchayat, 13: Village, 14: Samiti, 15: Toll
        // 16: Jaati, 17: Age, 18: Education, 19: Address, 20: Gender, 21: Vehicle, 22: Group
        // 23: Gov Emp, 24: Party, 25: Pad Varsh, 26: Code, 27: Nari Samman, 28: Farmer Loan
        // 29-31: Social, 32: Reference, 33: Remark, 34-39: Tech, 40: Image, 41: Created, 43: Action

        $('#modal-title-name').text(data[3]);
        $('#modal-name').text(data[3]);
        $('#modal-father').text(data[6]);
        $('#modal-gender').text(data[20 + 2]);
        $('#modal-age').text(data[17 + 2]);
        
        $('#modal-block').text(data[9]);
        $('#modal-janpad').text(data[10]);
        $('#modal-mandalam').text(data[11]);
        
        $('#modal-panchayat').text(data[12 + 2]);
        $('#modal-village').text(data[13 + 2]);
        $('#modal-booth-name').text(data[10 + 2]);
        $('#modal-booth-no').text(data[11 + 2]);
        $('#modal-toll').text(data[15 + 2]);
        $('#modal-mobile').text(data[5]);
        
        $('#modal-education').text(data[18 + 2]);
        $('#modal-jaati').text(data[16 + 2]);
        $('#modal-address').text(data[19 + 2]);
        
        $('#modal-dob').text(data[7]);
        $('#modal-dom').text(data[8]);
        $('#modal-vehicle').text(data[21 + 2]);
        $('#modal-group').text(data[22 + 2]);
        
        $('#modal-gov-emp').text(data[23 + 2]);
        $('#modal-party').text(data[24 + 2]);
        $('#modal-pad').text(data[25 + 2]);
        $('#modal-reference').text(data[32 + 2]);
        
        $('#modal-nari').text(data[27 + 2]);
        $('#modal-loan').text(data[28 + 2]);
        $('#modal-remark').text(data[33 + 2]);
        
        $('#modal-fb').text(data[29 + 2]);
        $('#modal-ig').text(data[30 + 2]);
        $('#modal-tw').text(data[31 + 2]);
        
        $('#modal-votar-id').text(data[4]);
        $('#modal-code').text(data[26 + 2]);
        $('#modal-samiti').text(data[14 + 2]);
        $('#modal-member-id').text(data[1]);
        
        $('#modal-created-date').text(data[41 + 2]);
        $('#modal-start-date').text(data[36 + 2]);
        $('#modal-start-lat').text(data[34 + 2]);
        $('#modal-start-long').text(data[35 + 2]);
        $('#modal-end-date').text(data[39 + 2]);
        $('#modal-end-lat').text(data[37 + 2]);
        $('#modal-end-long').text(data[38 + 2]);

        // Handle image
        var imgHtml = data[42];
        var imgSrc = $(imgHtml).attr('src');
        if (imgSrc) {
            $('#modal-image-container').html('<img src="' + imgSrc + '" class="img-responsive img-thumbnail" style="max-height: 250px; margin: 0 auto; cursor: pointer;" onclick="window.open(\'' + imgSrc + '\', \'_blank\')">');
        } else {
            $('#modal-image-container').html('<div class="well">No Image</div>');
        }

        // Handle Edit Link - correct index 43
        var actionHtml = data[43];
        var editHref = $(actionHtml).find('a[title="Edit"]').attr('href');
        if (!editHref) {
             editHref = $(actionHtml).filter('a[title="Edit"]').attr('href');
        }
        
        if (editHref) {
            $('#modal-edit-btn').attr('href', editHref).show();
        } else {
            // Fallback: search all anchors for edit
            var found = false;
            $(actionHtml).each(function() {
                if ($(this).attr('title') == 'Edit' || $(this).attr('href').indexOf('editservayview') !== -1) {
                    $('#modal-edit-btn').attr('href', $(this).attr('href')).show();
                    found = true;
                    return false;
                }
            });
            if (!found) $('#modal-edit-btn').hide();
        }

        $('#surveyDetailModal').modal('show');
    });
});
</script>
