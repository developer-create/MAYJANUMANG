<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Jansunwai Details</h3>
                    </div>
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="editJansunwai" enctype="multipart/form-data"  action="<?php echo base_url() ?>user/updateJansunwai" method="post">
                        <div class="box-body">
                            <input type="hidden" name="id" value="<?php echo $jansunwai->id; ?>">
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sector_name">Sector Name</label>
                                        <input type="text" class="form-control required" id="sector_name" name="sector_name" value="<?php echo set_value('sector_name', $jansunwai->sector_name); ?>">
                                        <?php echo form_error('sector_name', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="micro_sector_no">Micro Sector No.</label>
                                        <input type="text" class="form-control required" id="micro_sector_no" name="micro_sector_no" value="<?php echo set_value('micro_sector_no', $jansunwai->micro_sector_no); ?>">
                                        <?php echo form_error('micro_sector_no', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="micro_sector_name">Micro Sector Name</label>
                                        <input type="text" class="form-control required" id="micro_sector_name" name="micro_sector_name" value="<?php echo set_value('micro_sector_name', $jansunwai->micro_sector_name); ?>">
                                        <?php echo form_error('micro_sector_name', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <!-- Date (First - to auto-fetch Month and Year) -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date">Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control required" id="date" name="date" value="<?php echo set_value('date', $jansunwai->date); ?>">
                                        <?php echo form_error('date', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>

                                <!-- Month (Auto-filled from Date) -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="month">Month <span class="text-danger">*</span> (Auto-filled)</label>
                                        <?php
                                        $selected_month = isset($jansunwai->month) ? $jansunwai->month : set_value('month');
                                        ?>
                                        <select name="month" id="month" class="form-control required" readonly>
                                            <option value="">Select Date First</option>
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
                                                $selected = ($key == $selected_month) ? 'selected' : '';
                                                echo "<option value='{$key}' {$selected}>{$value}</option>";
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error('month', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>

                                <!-- Financial Year (Auto-filled from Date) -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="year">Financial Year <span class="text-danger">*</span> (Auto-filled)</label>
                                        <?php
                                        $this->load->helper('financial_year');
                                        $financial_years = get_financial_years(2008, 2027);
                                        $selected_year = isset($jansunwai->year) ? $jansunwai->year : set_value('year');
                                        ?>
                                        <select name="year" id="year" class="form-control required" readonly>
                                            <option value="">Select Date First</option>
                                            <?php
                                            krsort($financial_years);
                                            foreach ($financial_years as $fy) {
                                                $selected = ($fy == $selected_year) ? 'selected' : '';
                                                echo "<option value='{$fy}' {$selected}>{$fy}</option>";
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error('year', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="district">District</label>
                                        <input type="text" class="form-control required" id="district" name="district" value="<?php echo set_value('district', $jansunwai->district); ?>">
                                        <?php echo form_error('district', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="assembly">Assembly</label>
                                        <input type="text" class="form-control required" id="assembly" name="assembly" value="<?php echo set_value('assembly', $jansunwai->assembly); ?>">
                                        <?php echo form_error('assembly', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="block">Block</label>
                                        <select  class="form-control select2 required" id="block" name="block">
                                            <option value="0">Select</option>
                                             <?php   foreach($blocks as $eachblock){ ?>
                                        <option value="<?php echo $eachblock['id'] ?>"  <?php if($jansunwai->block==$eachblock['id']){ echo "selected";} ?>    ><?php echo $eachblock['name'] ?></option>
                                         <?php } ?>
                                        </select>
                                        <?php echo form_error('block', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                              
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="recommended_letter_no">Recommended Letter No.</label>
                                        <input type="text" class="form-control required" id="recommended_letter_no" name="recommended_letter_no" value="<?php echo set_value('recommended_letter_no', $jansunwai->recommended_letter_no); ?>">
                                        <?php echo form_error('recommended_letter_no', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                           
                              <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="booth_name">Booth Name</label>
                                        <!--<input type="text" class="form-control required" id="booth_name" name="booth_name" value="<?php echo set_value('booth_name', $jansunwai->booth_name); ?>">-->
                                        <select class="form-control select2 required" id="booth_name" name="booth_name">
                                            <option value="0">Select Booth</option>
                                            <!-- Booth options will be populated dynamically based on selected Block -->
                                        </select>
                                        <?php echo form_error('booth_name', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="booth_no">Booth No.</label>
                                        <!--<input type="text" class="form-control required" id="booth_no" name="booth_no" value="<?php echo set_value('booth_no', $jansunwai->booth_no); ?>">-->
                                         <select class="form-control select2 required" id="booth_no" name="booth_no">
                                            <option value="0">Select Booth</option>
                                            <!-- Booth options will be populated dynamically based on selected Block -->
                                        </select>
                                        <?php echo form_error('booth_no', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                             
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="panchayat_name">Panchayat Name</label>
                                        <!--<input type="text" class="form-control required" id="panchayat_name" name="panchayat_name" value="<?php echo set_value('panchayat_name', $jansunwai->panchayat_name); ?>">-->
                                        <select class="form-control select2 required" id="panchayat_name" name="panchayat_name" required>
                                            <option value="0">Select Panchayat</option>
                                            <!-- Panchayat options will be populated dynamically based on selected Booth -->
                                        </select>
                                        <?php echo form_error('panchayat_name', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="village">Village</label>
                                        <!--<input type="text" class="form-control required" id="village" name="village" value="<?php echo set_value('village', $jansunwai->village); ?>">-->
                                        <select class="form-control select2 required" id="village" name="village" required>
                                            <option value="0">Select Village</option>
                                          </select>
                                          <?php echo form_error('village', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="majra_faliya">Majra-Faliya</label>
                                        <input type="text" class="form-control required" id="majra_faliya" name="majra_faliya" value="<?php echo set_value('majra_faliya', $jansunwai->majra_faliya); ?>">
                                        <?php echo form_error('majra_faliya', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                               
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="work_problem">Work/Problem</label>
                                        <input type="text" class="form-control required" id="work_problem" name="work_problem" value="<?php echo set_value('work_problem', $jansunwai->work_problem); ?>">
                                        <?php echo form_error('work_problem', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                             
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="office">Office</label>
                                        <input type="text" class="form-control required" id="office" name="office" value="<?php echo set_value('office', $jansunwai->office); ?>">
                                        <?php echo form_error('office', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="approximate_cost">Approximate Cost</label>
                                        <input type="number" step="0.01" class="form-control required" id="approximate_cost" name="approximate_cost" value="<?php echo set_value('approximate_cost', $jansunwai->approximate_cost); ?>">
<?php echo form_error('approximate_cost', '<div class="text-danger">', '</div>'); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                    <select  class="form-control select2 required" id="department" name="department">
                                            <option value="0">Select</option>
                                        <?php foreach($departments as $eachblock){ ?>
                                        <option value="<?php echo $eachblock['id'] ?>" <?php if($jansunwai->department==$eachblock['id']){ echo "selected";} ?> ><?php echo $eachblock['name'] ?></option>
                                        <?php } ?>
                                        </select>
                                        <?php echo form_error('department', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <!-- Approved Fund -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="approved_fund">Approved Fund</label>
                                        <select class="form-control" id="approved_fund" name="approved_fund">
                                            <option value="">Select Fund</option>
                                            <option value="MLA FUND" <?php echo set_select('approved_fund', 'MLA FUND', $jansunwai->approved_fund === 'MLA FUND'); ?>>MLA FUND</option>
                                            <option value="MLA Swechanudan" <?php echo set_select('approved_fund', 'MLA Swechanudan', $jansunwai->approved_fund === 'MLA Swechanudan'); ?>>MLA Swechanudan</option>
                                            <option value="CLP Swechanudan" <?php echo set_select('approved_fund', 'CLP Swechanudan', $jansunwai->approved_fund === 'CLP Swechanudan'); ?>>CLP Swechanudan</option>
                                            <option value="Jansampark Fund" <?php echo set_select('approved_fund', 'Jansampark Fund', $jansunwai->approved_fund === 'Jansampark Fund'); ?>>Jansampark Fund</option>
                                            <option value="others" <?php echo set_select('approved_fund', 'others', !in_array($jansunwai->approved_fund, ['MLA FUND', 'MLA Swechanudan', 'CLP Swechanudan', 'Jansampark Fund', '', null]) && !empty($jansunwai->approved_fund)); ?>>Others</option>
                                        </select>
                                        <?php echo form_error('approved_fund', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <!-- Approved Fund (Others) - Initially Hidden -->
                                <div class="col-md-4" id="approved_fund_other_wrapper" style="display:<?php echo (!in_array($jansunwai->approved_fund, ['MLA FUND', 'MLA Swechanudan', 'CLP Swechanudan', 'Jansampark Fund', '', null]) && !empty($jansunwai->approved_fund)) ? 'block' : 'none'; ?>;">
                                    <div class="form-group">
                                        <label for="approved_fund_other">Enter Fund Name</label>
                                        <input type="text" class="form-control" id="approved_fund_other" name="approved_fund_other"
                                            value="<?php echo set_value('approved_fund_other', (!in_array($jansunwai->approved_fund, ['MLA FUND', 'MLA Swechanudan', 'CLP Swechanudan', 'Jansampark Fund', '', null]) ? $jansunwai->approved_fund : '')); ?>"
                                            placeholder="Enter custom fund name">
                                        <?php echo form_error('approved_fund_other', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Work Agency -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="work_agency">Work Agency</label>
                                        <input type="text" class="form-control" id="work_agency" name="work_agency"
                                            value="<?php echo set_value('work_agency', $jansunwai->work_agency); ?>"
                                            placeholder="Enter work executing agency">
                                        <?php echo form_error('work_agency', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="priority">Priority</label>
                                        <input type="text" class="form-control required" id="priority" name="priority" value="<?php echo set_value('priority', $jansunwai->priority); ?>">
                                        <?php echo form_error('priority', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ts_no_date">TS No/Date</label>
                                        <input type="text" class="form-control required" id="ts_no_date" name="ts_no_date" value="<?php echo set_value('ts_no_date', $jansunwai->ts_no_date); ?>">
                                        <?php echo form_error('ts_no_date', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="as_no_date">AS No/Date</label>
                                        <input type="text" class="form-control required" id="as_no_date" name="as_no_date" value="<?php echo set_value('as_no_date', $jansunwai->as_no_date); ?>">
                                        <?php echo form_error('as_no_date', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                           
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type_of_work">Type of Work</label>
                                        <?php
                                            $q=$this->db->query("select * from workType");
                                          $worktypes=  $q->result();
                                        ?>
                                        <select class="form-control select2 required" id="type_of_work" name="type_of_work">
                                            <option value="">-- Select Work Type --</option>
                                            <?php foreach ($worktypes as $each_aa): ?>
                                                <option value="<?= $each_aa->name ?>"
                                                    <?= set_select('type_of_work', $each_aa->name, ($each_aa->name == $jansunwai->type_of_work)) ?>>
                                                    <?= htmlspecialchars($each_aa->name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('type_of_work', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <!-- Sub Work Type -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sub_work_type_id">Sub Work Type</label>
                                        <select class="form-control select2" id="sub_work_type_id" name="sub_work_type_id">
                                            <option value="">Select Sub Work Type</option>
                                        </select>
                                        <?php echo form_error('sub_work_type_id', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="middle_men">Middle Men</label>
                                        <input type="text" class="form-control required" id="middle_men" name="middle_men" value="<?php echo set_value('middle_men', $jansunwai->middle_men); ?>">
                                        <?php echo form_error('middle_men', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cont_no">Cont No</label>
                                        <input type="text" class="form-control required" id="cont_no" name="cont_no" value="<?php echo set_value('cont_no', $jansunwai->cont_no); ?>">
                                        <?php echo form_error('cont_no', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="beneficial">Beneficial</label>
                                        <input type="text" class="form-control required" id="beneficial" name="beneficial" value="<?php echo set_value('beneficial', $jansunwai->beneficial); ?>">
                                        <?php echo form_error('beneficial', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Cont No.</label>
                                        <input type="text" class="form-control required" id="mobile" name="mobile" value="<?php echo set_value('mobile', $jansunwai->mobile); ?>">
                                        <?php echo form_error('mobile', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>
 
                            
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="po">PO</label>
                                        <input type="text" class="form-control required" id="po" name="po" value="<?php echo set_value('po', $jansunwai->po); ?>">
                                        <?php echo form_error('po', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="account_details">Account Details</label>
                                        <textarea class="form-control required" id="account_details" name="account_details"><?php echo set_value('account_details', $jansunwai->account_details); ?></textarea>
                                        <?php echo form_error('account_details', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <!--<div class="col-md-4">-->
                                <!--    <div class="form-group">-->
                                <!--        <label for="work_status">Work Status</label>-->
                                        <!--<input type="text" class="form-control required" id="work_status" name="work_status" value="<?php echo set_value('work_status', $jansunwai->work_status); ?>">-->
                                <!--         <select class="form-control required select2" id="work_status" name="work_status">             -->
                                <!--            <option value="0" >Select Status</option>-->
                                <!--            <option value="Incomplete" <?php if($jansunwai->work_status== 'Incomplete'){ echo "selected";} ?>>Incomplete</option>-->
                                <!--             <option value="In progress" <?php if($jansunwai->department== 'In progress' ){ echo "selected";} ?>>In progress</option>-->
                                <!--             <option value="Complete" <?php if($jansunwai->department== 'Complete'){ echo "selected";} ?>>Complete</option>-->
                                <!--        </select>-->
                                <!--        <?php echo form_error('work_status', '<div class="text-danger">', '</div>'); ?>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>

                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_proof_number">Adhar Card Number</label>
                                        <input type="text" class="form-control required" id="id_proof_number" name="id_proof_number" 
                                            value="<?php echo set_value('id_proof_number', $jansunwai->id_proof_number); ?>">
                                        <?php echo form_error('id_proof_number', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="residential_number">IFSC Number</label>
                                        <input type="text" class="form-control required" id="residential_number" name="residential_number" 
                                            value="<?php echo set_value('residential_number', $jansunwai->residential_number); ?>">
                                        <?php echo form_error('residential_number', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="po">Avedan</label>
                                        <input type="file" name="file" />
                                        <?php echo form_error('file', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="document_upload">Upload Document (Set Of Complete Doc Pdf)</label>
                                        <input type="file" class="form-control" id="document_upload" name="document_upload">
                                        <?php echo form_error('document_upload', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label for="remark">Remark/Goshana</label>
                                <textarea class="form-control required" id="remark" name="remark_goshana"><?php echo set_value('remark_goshana', $jansunwai->remark_goshana); ?></textarea>
                                <?php echo form_error('remark_goshana', '<div class="text-danger">', '</div>'); ?>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Update" />
                            <a href="<?php echo base_url(); ?>user/jansunwai" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <?php
                $success = $this->session->flashdata('success');
                if ($success) {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>

                <?php
                $error = $this->session->flashdata('error');
                if ($error) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
</div>

 
 
 
 
 
 
 
 
 <script type="text/javascript">
$(document).ready(function() {
    function loadBoothsByBlock() {
        var blockId = $('#block').val();
        if (blockId != 0) {
            $.ajax({
                url: '<?php echo site_url('panchayat/getBoothsByBlock'); ?>',
                method: 'POST',
                data: { blockid: blockId },
                dataType: 'json',
                success: function(response) {
                    $('#booth_name').empty().append('<option value="0">Select Booth</option>');
                    $('#booth_no').empty().append('<option value="0">Select Booth No.</option>');
                    $.each(response, function(index, value) {
                        var selectedName = (value.id == '<?php echo $jansunwai->booth_name; ?>') ? 'selected' : '';
                        var selectedNo = (value.id == '<?php echo $jansunwai->booth_no; ?>') ? 'selected' : '';
                        $('#booth_name').append('<option  bnumbervalue="' + value.bnumber + '" value="' + value.id + '" ' + selectedName + '>' + value.name + '</option>');
                    });
                    $('#booth_no').empty().append('<option value="0">Select Booth No.</option>');

                    loadPanchayatByBooth();
                }
            });
        } else {
            $('#booth_name').empty().append('<option value="0">Select Booth</option>');
            $('#booth_no').empty().append('<option value="0">Select Booth No.</option>');
        }
    }

    function loadPanchayatByBooth() {
        var boothid = $('#booth_name').val();
        if (boothid != 0) {
            
             var selectedBooth = $('#booth_name option:selected');
        var bnumber = selectedBooth.attr('bnumbervalue');
        
         if (bnumber) {
            $('#booth_no').empty().append('<option value="0">Select Booth No.</option>');
            $('#booth_no').append('<option value="' + selectedBooth.val() + '" selected>' + bnumber + '</option>');
        } else {
            $('#booth_no').empty().append('<option value="0">Select Booth No.</option>');
        }
        
        
            $.ajax({
                url: '<?php echo site_url('panchayat/getpanchayatidByBooth'); ?>',
                method: 'POST',
                data: { boothid: boothid },
                dataType: 'json',
                success: function(response) {
                    $('#panchayat_name').empty().append('<option value="0">Select Panchayat</option>');
                    $.each(response, function(index, value) {
                        var selected = (value.id == '<?php echo $jansunwai->panchayat_name; ?>') ? 'selected' : '';
                        $('#panchayat_name').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                    });

                    loadVillageByPanchayat();
                }
            });
        } else {
            $('#panchayat_name').empty().append('<option value="0">Select Panchayat</option>');
        }
    }

    function loadVillageByPanchayat() {
        var panchayatid = $('#panchayat_name').val();
        if (panchayatid != 0) {
            $.ajax({
                url: '<?php echo site_url('panchayat/getvillageBypanchayat'); ?>',
                method: 'POST',
                data: { panchayatid: panchayatid },
                dataType: 'json',
                success: function(response) {
                    $('#village').empty().append('<option value="0">Select Village</option>');
                    $.each(response, function(index, value) {
                        var selected = (value.id == '<?php echo $jansunwai->village; ?>') ? 'selected' : '';
                        $('#village').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#village').empty().append('<option value="0">Select Village</option>');
        }
    }

    // Load Sub Work Types based on selected Type of Work
    function loadSubWorkTypes(workTypeName, selectedSubWorkTypeId) {
        if (workTypeName) {
            $.ajax({
                url: '<?php echo site_url('user/getSubWorkTypesByWorkType'); ?>',
                method: 'POST',
                data: {
                    work_type_name: workTypeName
                },
                dataType: 'json',
                success: function(response) {
                    $('#sub_work_type_id').empty();
                    $('#sub_work_type_id').append('<option value="">Select Sub Work Type</option>');
                    if (response.success && response.subtypes && response.subtypes.length > 0) {
                        $.each(response.subtypes, function(index, value) {
                            var selected = (selectedSubWorkTypeId && value.id == selectedSubWorkTypeId) ? 'selected' : '';
                            $('#sub_work_type_id').append('<option value="' + value.id + '" ' + selected + '>' + 
                                value.name + '</option>');
                        });
                    }
                },
                error: function() {
                    $('#sub_work_type_id').empty();
                    $('#sub_work_type_id').append('<option value="">Select Sub Work Type</option>');
                }
            });
        } else {
            $('#sub_work_type_id').empty();
            $('#sub_work_type_id').append('<option value="">Select Sub Work Type</option>');
        }
    }

    // Load Sub Work Types on page load if Type of Work is already selected
    var currentWorkType = $('#type_of_work').val();
    var currentSubWorkTypeId = <?php echo isset($jansunwai->sub_work_type_id) && $jansunwai->sub_work_type_id ? $jansunwai->sub_work_type_id : 'null'; ?>;
    if (currentWorkType) {
        loadSubWorkTypes(currentWorkType, currentSubWorkTypeId);
    }

    // Filter Sub Work Type when Type of Work changes
    $('#type_of_work').change(function() {
        var workTypeName = $(this).val();
        loadSubWorkTypes(workTypeName, null);
    });

    // Auto-fill Month and Financial Year from Date
    $('#date').on('change', function() {
        var dateValue = $(this).val();
        
        if (dateValue) {
            // Parse the date
            var date = new Date(dateValue);
            var month = String(date.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
            var year = date.getFullYear();
            
            // Set the month dropdown
            $('#month').val(month).trigger('change');
            
            // Calculate financial year
            var monthNum = parseInt(month);
            var financialYear;
            
            if (monthNum >= 4) {
                // April onwards - current year is start year
                var nextYear = String(year + 1).slice(-2);
                financialYear = year + '-' + nextYear;
            } else {
                // January to March - previous year is start year
                var prevYear = year - 1;
                var currentYearLast2 = String(year).slice(-2);
                financialYear = prevYear + '-' + currentYearLast2;
            }
            
            // Set the financial year dropdown
            $('#year').val(financialYear).trigger('change');
        } else {
            // Clear if date is empty
            $('#month').val('').trigger('change');
            $('#year').val('').trigger('change');
        }
    });

    // Trigger all AJAX calls on page load
    loadBoothsByBlock();
    
    // Trigger change events when a selection is made by the user
    $('#block').change(loadBoothsByBlock);
    $('#booth_name').change(loadPanchayatByBooth);
    $('#panchayat_name').change(loadVillageByPanchayat);

    // Handle Approved Fund "Others" option
    $('#approved_fund').change(function() {
        var selectedFund = $(this).val();
        if (selectedFund === 'others') {
            $('#approved_fund_other_wrapper').slideDown();
            $('#approved_fund_other').addClass('required');
        } else {
            $('#approved_fund_other_wrapper').slideUp();
            $('#approved_fund_other').removeClass('required');
            $('#approved_fund_other').val('');
        }
    });

    // Trigger on page load to show/hide based on current value
    var currentFund = $('#approved_fund').val();
    if (currentFund === 'others') {
        $('#approved_fund_other_wrapper').show();
        $('#approved_fund_other').addClass('required');
    }

    // Form submission - save custom fund if "others" is selected
    $('#editJansunwai').on('submit', function(e) {
        var selectedFund = $('#approved_fund').val();
        var customFund = $('#approved_fund_other').val();
        
        if (selectedFund === 'others' && !empty(customFund)) {
            // Save custom fund to database
            $.ajax({
                url: '<?php echo base_url('user/saveCustomApprovedFund'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    fund_name: customFund,
                    description: 'Custom fund - ' + customFund
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Custom fund saved successfully');
                    }
                },
                error: function() {
                    console.log('Error saving custom fund');
                }
            });
        }
    });

    // Helper function to check if string is empty
    function empty(mixed_var) {
        if (mixed_var === "" || mixed_var === 0 || mixed_var === "0" || mixed_var === null || 
            mixed_var === false || (typeof mixed_var === "undefined")) {
            return true;
        }
        return false;
    }
    
    // Trigger auto-fill if date already has a value (for edit mode)
    if ($('#date').val()) {
        $('#date').trigger('change');
    }
});
</script>


 
 
 
 
 
 
 