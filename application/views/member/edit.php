<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-list"></i> Survey Management
            <small>Edit Survey Details</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Update Survey Details</h3>
                    </div><!-- /.box-header -->

                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form action="<?php echo base_url()?>ServayController/updateServay/<?php echo $survey->id; ?>" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <h2>Edit Survey Form</h2>

                             <?php if (isset($upload_error) && !empty($upload_error)): ?>
                     <div class="alert alert-danger">
                        <?php echo $upload_error; ?>
                     </div>
                     <?php endif; ?>
                     <?php if (validation_errors()): ?>
                     <div class="alert alert-danger">
                        <?php echo validation_errors(); ?>
                     </div>
                     <?php endif; ?>
                     <div class="row">
                        <div class="form-group col-md-2">
                           <label for="district">District</label>
                           <select name="district" id="district" class="form-control select2" data-pre-val="<?php echo trim($survey->district); ?>">
                              <option value="">Select District</option>
                              <?php foreach ($districts as $district): ?>
                              <option value="<?php echo $district->id; ?>" <?php if( trim($survey->district)==$district->id){ echo "selected";} ?> ><?php echo $district->name; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="form-group col-md-2">
                           <label for="vidhan_sabha_id">Vidhan Sabha</label>
                           <select name="vidhan_sabha_id" id="vidhan_sabha_id" class="form-control select2" data-pre-val="<?php echo isset($survey->vidhan_sabha_id) ? trim($survey->vidhan_sabha_id) : ''; ?>">
                              <option value="" <?php echo (empty($survey->vidhan_sabha_id) || $survey->vidhan_sabha_id === '' || $survey->vidhan_sabha_id === null) ? 'selected' : ''; ?>>N/A</option>
                              <?php if (!empty($vidhan_sabhas)) { foreach ($vidhan_sabhas as $vs): ?>
                              <option value="<?php echo $vs->id; ?>" <?php if(isset($survey->vidhan_sabha_id) && trim($survey->vidhan_sabha_id)==$vs->id){ echo "selected";} ?>><?php echo htmlspecialchars($vs->vidhan_sabha_name); ?></option>
                              <?php endforeach; } ?>
                           </select>
                        </div>
                        <div class="form-group col-md-2">
                           <label for="samithi">Samithi</label>
                           <select name="samithi" id="samithi" class="form-control select2" data-pre-val="<?php echo trim($survey->samithi); ?>">
                              <option value="">Select Committee</option>
                              <?php foreach ($committees as $committee): ?>
                              <option value="<?php echo $committee->id; ?>" <?php if( trim($survey->samithi)==$committee->id){ echo "selected";} ?> ><?php echo $committee->name; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="form-group col-md-2">
                           <label for="block_name_number">Block Name</label>
                           <select name="block_name_number" id="block" class="form-control select2" data-pre-val="<?php echo trim($survey->block_name_number); ?>">
                              <option value="">Select Block</option>
                              <?php foreach ($blocks as $block): ?>
                              <option value="<?php echo $block->id; ?>"  <?php if( trim($survey->block_name_number)==$block->id){ echo "selected";} ?>  ><?php echo $block->name; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="form-group col-md-2">
                           <label for="janpad_panchayat">Janpad Panchayat</label>
                           <input type="text" class="form-control" id="janpad_panchayat" name="janpad_panchayat" value="<?php echo @$survey->janpad_panchayat; ?>" />
                        </div>
                        <div class="form-group col-md-2">
                           <label for="mandalam">Mandalam</label>
                           <input type="text" class="form-control" id="mandalam" name="mandalam" value="<?php echo @$survey->mandalam; ?>" />
                        </div>
                     </div>
                     
          <div class="row">
                        <div class="form-group col-md-3">
                           <label for="boothname">Booth Name</label>
                           <select name="boothname" id="booth"  class="form-control select2">
                              <option value="">Select Booth</option>
                           </select>
                        </div>
                        <div class="form-group col-md-3">
                           <label for="boothnumber">Booth Number</label>
                           <input type="text" class="form-control" id="boothnumber" name="boothnumber" value="<?php echo  $survey->boothnumber ?>" />
                        </div>
                     </div>

       <div class="row">
                        <div class="form-group col-md-3">
                           <label for="grampanchayat">Gram Panchayat</label>
                           <select name="grampanchayat" id="panchayat"  class="form-control select2">
                              <option value="">Select Panchayat</option>
                           </select>
                        </div>
                        <div class="form-group col-md-3">
                           <label for="village">Village</label>
                           <select name="village" id="village"  class="form-control select2">
                              <option value="">Select Village</option>
                           </select>
                        </div>
                     </div>
                     
                     
        <div class="row">
           
            <div class="form-group col-md-3">
                <label for="toll">Majra/Falia/Tolla</label>
                <input type="text" class="form-control" id="toll" name="toll" value="<?php echo $survey->toll; ?>">
            </div>
              <div class="form-group col-md-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $survey->name; ?>">
            </div>
        </div>

        <div class="row">
          
            <div class="form-group col-md-3">
                <label for="fathername">Father's Name</label>
                <input type="text" class="form-control" id="fathername" name="fathername" value="<?php echo $survey->fathername; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="jaati">Cast</label>
                <?php $currentJaati = trim((string)$survey->jaati); ?>
                <select name="jaati" id="jaati" class="form-control select2" data-pre-val="<?php echo $currentJaati; ?>">
                    <option value="">Select jaati</option>
                    <option value="ST (bhil)" <?php echo ($currentJaati == 'ST (bhil)' || $currentJaati == 'एस टी (भील)') ? 'selected' : ''; ?>>ST (bhil) / एस टी (भील)</option>
                    <option value="ST (Bhilala)" <?php echo ($currentJaati == 'ST (Bhilala)' || $currentJaati == 'एस टी (भिलाला)') ? 'selected' : ''; ?>>ST (Bhilala) / एस टी (भिलाला)</option>
                    <option value="General" <?php echo ($currentJaati == 'General' || $currentJaati == 'सामान्य') ? 'selected' : ''; ?>>General / सामान्य</option>
                    <option value="OBC" <?php echo ($currentJaati == 'OBC' || $currentJaati == 'अन्य पिछड़ा वर्ग') ? 'selected' : ''; ?>>OBC / अन्य पिछड़ा वर्ग</option>
                    <option value="SC" <?php echo ($currentJaati == 'SC' || $currentJaati == 'अनुसूचित जाति') ? 'selected' : ''; ?>>SC / अनुसूचित जाति</option>
                    <option value="ST" <?php echo ($currentJaati == 'ST' || $currentJaati == 'अनुसूचित जनजाति') ? 'selected' : ''; ?>>ST / अनुसूचित जनजाति</option>
                    <option value="Muslim" <?php echo ($currentJaati == 'Muslim' || $currentJaati == 'मुस्लिम') ? 'selected' : ''; ?>>Muslim / मुस्लिम</option>
                    <option value="Brahman" <?php echo ($currentJaati == 'Brahman' || $currentJaati == 'ब्राह्मण') ? 'selected' : ''; ?>>Brahman / ब्राह्मण</option>
                    <option value="Sirvi" <?php echo ($currentJaati == 'Sirvi') ? 'selected' : ''; ?>>Sirvi</option>
                    <option value="Maheshwari" <?php echo ($currentJaati == 'Maheshwari') ? 'selected' : ''; ?>>Maheshwari</option>
                    <option value="Prajapati" <?php echo ($currentJaati == 'Prajapati') ? 'selected' : ''; ?>>Prajapati</option>
                    <option value="Rajput" <?php echo ($currentJaati == 'Rajput') ? 'selected' : ''; ?>>Rajput</option>
                    <option value="Lohar" <?php echo ($currentJaati == 'Lohar') ? 'selected' : ''; ?>>Lohar</option>
                    <option value="Sikh" <?php echo ($currentJaati == 'Sikh') ? 'selected' : ''; ?>>Sikh</option>
                    <option value="Rathor" <?php echo ($currentJaati == 'Rathor') ? 'selected' : ''; ?>>Rathor</option>
                    <option value="Jain" <?php echo ($currentJaati == 'Jain') ? 'selected' : ''; ?>>Jain</option>
                    <option value="Bohra" <?php echo ($currentJaati == 'Bohra') ? 'selected' : ''; ?>>Bohra</option>
                    <option value="Patel" <?php echo ($currentJaati == 'Patel') ? 'selected' : ''; ?>>Patel</option>
                    <option value="Yadav" <?php echo ($currentJaati == 'Yadav') ? 'selected' : ''; ?>>Yadav</option>
                    <option value="other" <?php echo ($currentJaati == 'other') ? 'selected' : ''; ?>>other</option>
                </select>
            </div>
        </div>
 <div class="row">
                        <div class="form-group col-md-3">
                           <label for="dob">Date of Birth</label>
                           <input type="date" class="form-control" id="dob" name="dob" value="<?php echo ($survey->dob && $survey->dob != '0000-00-00') ? $survey->dob : ''; ?>" />
                        </div>
                        <div class="form-group col-md-3">
                           <label for="age">Age</label>
                           <input type="text" class="form-control" id="age" name="age" value="<?php echo $survey->age; ?>" />
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-3">
                           <label for="dom">Date of Marriage</label>
                           <input type="date" class="form-control" id="dom" name="dom" value="<?php echo ($survey->dom && $survey->dom != '0000-00-00') ? $survey->dom : ''; ?>"  />
                        </div>
                        <div class="form-group col-md-3">
                           <label for="education">Education</label>
                           <?php $currentEdu = trim((string)$survey->education); ?>
                           <select name="education" id="education" class="form-control select2" data-pre-val="<?php echo $currentEdu; ?>">
                              <option value="">Select Education</option>
                              <option value="uneducate" <?php echo ($currentEdu == 'uneducate' || $currentEdu == 'अशिक्षित') ? 'selected' : ''; ?>>Uneducate / अशिक्षित</option>
                              <option value="educate" <?php echo ($currentEdu == 'educate' || $currentEdu == 'साक्षर') ? 'selected' : ''; ?>>Educate / साक्षर</option>
                              <option value="5th" <?php echo ($currentEdu == '5th' || $currentEdu == 'प्राइमरी स्कूल (5th)') ? 'selected' : ''; ?>>5th / प्राइमरी स्कूल</option>
                              <option value="8th" <?php echo ($currentEdu == '8th' || $currentEdu == 'मिडिल स्कूल (8th)') ? 'selected' : ''; ?>>8th / मिडिल स्कूल</option>
                              <option value="10th" <?php echo ($currentEdu == '10th' || $currentEdu == 'हाई स्कूल (10th)') ? 'selected' : ''; ?>>10th / हाई स्कूल</option>
                              <option value="12th" <?php echo ($currentEdu == '12th' || $currentEdu == 'हायर सेकेंडरी स्कूल (12th)') ? 'selected' : ''; ?>>12th / हायर सेकेंडरी</option>
                              <option value="Gradute" <?php echo ($currentEdu == 'Gradute' || $currentEdu == 'स्नातक') ? 'selected' : ''; ?>>Gradute / स्नातक</option>
                              <option value="Post-Gradute" <?php echo ($currentEdu == 'Post-Gradute' || $currentEdu == 'स्नातकोत्तर') ? 'selected' : ''; ?>>Post-Gradute / स्नातकोत्तर</option>
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-3">
                           <label for="mobile">Mobile</label>
                           <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $survey->mobile; ?>"  />
                        </div>
                        <div class="form-group col-md-3">
                           <label for="votarcode">Votar Code</label>
                           <input type="text" class="form-control" id="votarcode" name="votarcode" value="<?php echo $survey->votarcode; ?>" />
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-3">
                           <label for="address">Address</label>
                           <textarea type="text" class="form-control" id="address" name="address"><?php echo $survey->address; ?></textarea>
                        </div>
                        <div class="form-group col-md-3">
                           <label for="gender">Gender</label>
                           <?php $currentGender = trim((string)$survey->gender); ?>
                           <select name="gender" id="gender" class="form-control select2" data-pre-val="<?php echo $currentGender; ?>">
                              <option value="">Select Gender</option>
                              <option value="Male" <?php echo ($currentGender == 'Male' || $currentGender == 'पुरुष') ? 'selected' : ''; ?>>Male / पुरुष</option>
                              <option value="Female" <?php echo ($currentGender == 'Female' || $currentGender == 'महिला') ? 'selected' : ''; ?>>Female / महिला</option>
                              <option value="other" <?php echo ($currentGender == 'other' || $currentGender == 'अन्य') ? 'selected' : ''; ?>>Other / अन्य</option>
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-3">
                           <label for="group">Group</label>
                           <input type="text" class="form-control" id="group" name="group"  value="<?php echo $survey->group; ?>"  />
                        </div>
                        <div class="form-group col-md-3">
                           <label for="vehicle">Vehicle</label> <br>
                           <?php 
                           $savedVehicles = [];
                           if (!empty($survey->vehicle) && $survey->vehicle != '0') {
                               if (strpos($survey->vehicle, '[') === 0) {
                                   $savedVehicles = json_decode($survey->vehicle, true);
                               } else {
                                   $savedVehicles = explode(',', $survey->vehicle);
                               }
                               $savedVehicles = array_map('trim', (array)$savedVehicles);
                           }
                           ?>
                           <input type="checkbox" id="vehicle_2w" name="vehicle[]" value="2 wheeler" <?php echo (in_array('2 wheeler', $savedVehicles) || in_array('दो पहिया', $savedVehicles)) ? 'checked' : ''; ?> /> 2 wheeler / दो पहिया<br>
                           <input type="checkbox" id="vehicle_4w" name="vehicle[]" value="4 wheeler" <?php echo (in_array('4 wheeler', $savedVehicles) || in_array('चार पहिया', $savedVehicles)) ? 'checked' : ''; ?> /> 4 wheeler / चार पहिया<br>
                           <input type="checkbox" id="vehicle_none" name="vehicle[]" value="Koi Vahan nhi" <?php echo (in_array('Koi Vahan nhi', $savedVehicles) || in_array('कोई वाहन नहीं है', $savedVehicles)) ? 'checked' : ''; ?> /> Koi Vahan nhi / कोई वाहन नहीं
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-3">
                           <label for="government_employee">Government Employee</label>
                           <input type="text" class="form-control" id="government_employee" name="government_employee"  value="<?php echo $survey->government_employee; ?>" />
                        </div>
                        <div class="form-group col-md-3">
                           <label for="parti">Party</label>
                           <?php $currentParty = trim((string)$survey->parti); ?>
                           <select name="parti" id="parti" class="form-control select2" data-pre-val="<?php echo $currentParty; ?>">
                              <option value="">Select Party</option>
                              <?php foreach ($parties as $party): ?>
                              <option value="<?php echo $party->id; ?>" <?php if( $currentParty == $party->id){ echo "selected";} ?> ><?php echo $party->name; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-3">
                           <label for="padvarsh">Padvarsh</label>
                           <input type="text" class="form-control" id="padvarsh" name="padvarsh"  value="<?php echo $survey->padvarsh; ?>"  />
                        </div>
                     </div>
                     
                     <div class="row">
                        <div class="form-group col-md-12">
                           <label for="code"><strong>Code</strong></label>
                           <?php 
                           $savedCodes = [];
                           if (!empty($survey->code) && $survey->code != '0') {
                               // Check if it's already a comma-separated string or a JSON array
                               if (strpos($survey->code, '[') === 0) {
                                   $savedCodes = json_decode($survey->code, true);
                               } else {
                                   $savedCodes = explode(',', $survey->code);
                               }
                               $savedCodes = array_map('trim', (array)$savedCodes);
                           }
                           ?>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_sc" name="code[]" value="SC" <?php echo in_array('SC', $savedCodes) ? 'checked' : ''; ?> /> SC
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_yc" name="code[]" value="YC" <?php echo in_array('YC', $savedCodes) ? 'checked' : ''; ?> /> YC
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_wc" name="code[]" value="WC" <?php echo in_array('WC', $savedCodes) ? 'checked' : ''; ?> /> WC
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_pa" name="code[]" value="PA" <?php echo in_array('PA', $savedCodes) ? 'checked' : ''; ?> /> PA
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_sm" name="code[]" value="SM" <?php echo in_array('SM', $savedCodes) ? 'checked' : ''; ?> /> SM
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_eo" name="code[]" value="EO" <?php echo in_array('EO', $savedCodes) ? 'checked' : ''; ?> /> EO
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_gs" name="code[]" value="GS" <?php echo in_array('GS', $savedCodes) ? 'checked' : ''; ?> /> GS
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_dcc" name="code[]" value="DCC" <?php echo in_array('DCC', $savedCodes) ? 'checked' : ''; ?> /> DCC
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_pw" name="code[]" value="PW" <?php echo in_array('PW', $savedCodes) ? 'checked' : ''; ?> /> PW
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_nl" name="code[]" value="NL" <?php echo in_array('NL', $savedCodes) ? 'checked' : ''; ?> /> NL
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_fr" name="code[]" value="FR" <?php echo in_array('FR', $savedCodes) ? 'checked' : ''; ?> /> FR
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_so" name="code[]" value="SO" <?php echo in_array('SO', $savedCodes) ? 'checked' : ''; ?> /> SO
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_st" name="code[]" value="ST" <?php echo in_array('ST', $savedCodes) ? 'checked' : ''; ?> /> ST
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_ref" name="code[]" value="REF" <?php echo in_array('REF', $savedCodes) ? 'checked' : ''; ?> /> REF
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_us" name="code[]" value="US" <?php echo in_array('US', $savedCodes) ? 'checked' : ''; ?> /> US
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_smw" name="code[]" value="SMW" <?php echo in_array('SMW', $savedCodes) ? 'checked' : ''; ?> /> SMW
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_dyc" name="code[]" value="DYC" <?php echo in_array('DYC', $savedCodes) ? 'checked' : ''; ?> /> DYC
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_obc" name="code[]" value="OBC" <?php echo in_array('OBC', $savedCodes) ? 'checked' : ''; ?> /> OBC
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_dt" name="code[]" value="DT" <?php echo in_array('DT', $savedCodes) ? 'checked' : ''; ?> /> DT
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_dp" name="code[]" value="DP" <?php echo in_array('DP', $savedCodes) ? 'checked' : ''; ?> /> DP
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_mla" name="code[]" value="MLA" <?php echo in_array('MLA', $savedCodes) ? 'checked' : ''; ?> /> MLA
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_avp" name="code[]" value="AVP" <?php echo in_array('AVP', $savedCodes) ? 'checked' : ''; ?> /> AVP
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_meet" name="code[]" value="MEET" <?php echo in_array('MEET', $savedCodes) ? 'checked' : ''; ?> /> MEET
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_media" name="code[]" value="MEDIA" <?php echo in_array('MEDIA', $savedCodes) ? 'checked' : ''; ?> /> MEDIA
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_xmla" name="code[]" value="X MLA" <?php echo in_array('X MLA', $savedCodes) ? 'checked' : ''; ?> /> X MLA
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_bc" name="code[]" value="BC (बूथ कमेटी)" <?php echo in_array('BC (बूथ कमेटी)', $savedCodes) ? 'checked' : ''; ?> /> BC (बूथ कमेटी)
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_pp" name="code[]" value="PP (पेज प्रभारी)" <?php echo in_array('PP (पेज प्रभारी)', $savedCodes) ? 'checked' : ''; ?> /> PP (पेज प्रभारी)
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_ip" name="code[]" value="IP (प्रभावशाली व्यक्ति)" <?php echo in_array('IP (प्रभावशाली व्यक्ति)', $savedCodes) ? 'checked' : ''; ?> /> IP (प्रभावशाली व्यक्ति)
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_fh" name="code[]" value="FH (परिवार का मुखिया)" <?php echo in_array('FH (परिवार का मुखिया)', $savedCodes) ? 'checked' : ''; ?> /> FH (परिवार का मुखिया)
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_smm" name="code[]" value="SMM (सोशल मीडिया मित्र)" <?php echo in_array('SMM (सोशल मीडिया मित्र)', $savedCodes) ? 'checked' : ''; ?> /> SMM (सोशल मीडिया मित्र)
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_ms" name="code[]" value="MS (महिला समिति)" <?php echo in_array('MS (महिला समिति)', $savedCodes) ? 'checked' : ''; ?> /> MS (महिला समिति)
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_fp" name="code[]" value="FP (फलिया प्रभारी)" <?php echo in_array('FP (फलिया प्रभारी)', $savedCodes) ? 'checked' : ''; ?> /> FP (फलिया प्रभारी)
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_er" name="code[]" value="ER (चुनाव प्रभारी)" <?php echo in_array('ER (चुनाव प्रभारी)', $savedCodes) ? 'checked' : ''; ?> /> ER (चुनाव प्रभारी)
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_senior" name="code[]" value="वरिष्ठ" <?php echo in_array('वरिष्ठ', $savedCodes) ? 'checked' : ''; ?> /> वरिष्ठ
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_youth" name="code[]" value="युवा" <?php echo in_array('युवा', $savedCodes) ? 'checked' : ''; ?> /> युवा
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_vp" name="code[]" value="वोटरप्रभारी(१० घर)" <?php echo in_array('वोटरप्रभारी(१० घर)', $savedCodes) ? 'checked' : ''; ?> /> वोटरप्रभारी(१० घर)
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_bla" name="code[]" value="BLA (बूथ लेवल एजेंट)" <?php echo in_array('BLA (बूथ लेवल एजेंट)', $savedCodes) ? 'checked' : ''; ?> /> BLA (बूथ लेवल एजेंट)
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_fm" name="code[]" value="FM (दानदाता)" <?php echo in_array('FM (दानदाता)', $savedCodes) ? 'checked' : ''; ?> /> FM (दानदाता)
                        </div>
                        <div class="form-group col-md-4">
                           <input type="checkbox" id="code_ak" name="code[]" value="AK (नवीन सदस्‍य को सक्रिय करना)" <?php echo in_array('AK (नवीन सदस्‍य को सक्रिय करना)', $savedCodes) ? 'checked' : ''; ?> /> AK (नवीन सदस्‍य को सक्रिय करना)
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-3">
                           <label for="respect_for_women">Nari Samman Yojna</label><br>
                           <input type="radio" id="respect_for_women_yes" name="respect_for_women" value="Yes" <?php echo (strtolower($survey->respect_for_women) == 'yes') ? 'checked' : ''; ?> /> Yes <br>
                           <input type="radio" id="respect_for_women_no" name="respect_for_women" value="No" <?php echo (strtolower($survey->respect_for_women) == 'no') ? 'checked' : ''; ?> /> No 
                        </div>
                        <div class="form-group col-md-3">
                           <label for="farmer_loan_waiver">Farmer Loan Waiver</label><br>
                           <input type="radio" id="farmer_loan_waiver_nahi" name="farmer_loan_waiver" value="Nahi" <?php echo ($survey->farmer_loan_waiver == 'Nahi' || $survey->farmer_loan_waiver == 'नही') ? 'checked' : ''; ?> /> Nahi / नही <br>
                           <input type="radio" id="farmer_loan_waiver_congress" name="farmer_loan_waiver" value="Congres" <?php echo ($survey->farmer_loan_waiver == 'Congres' || $survey->farmer_loan_waiver == 'कांग्रेस') ? 'checked' : ''; ?> /> Congress / कांग्रेस <br>
                           <input type="radio" id="farmer_loan_waiver_bjp" name="farmer_loan_waiver" value="BJP" <?php echo ($survey->farmer_loan_waiver == 'BJP' || $survey->farmer_loan_waiver == 'भाजपा') ? 'checked' : ''; ?> /> BJP / भाजपा
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-3">
                           <label for="facebook">Facebook</label>
                           <input type="text" class="form-control" id="facebook" name="facebook" required  value="<?php echo $survey->facebook; ?>"  />
                        </div>
                        <div class="form-group col-md-3">
                           <label for="instagram">Instagram</label>
                           <input type="text" class="form-control" id="instagram" name="instagram" required  value="<?php echo $survey->instagram; ?>"  />
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-3">
                           <label for="twitter">Twitter</label>
                           <input type="text" class="form-control" id="twitter" name="twitter"    value="<?php echo $survey->twitter; ?>"  />
                        </div>
                        <div class="form-group col-md-3">
                           <label for="image">Image</label>
                           <input type="file" class="form-control" id="image" name="image"      />
                           <?php if(@$survey->image != ''){ ?>
                              <div style="margin-top: 10px;">
                                 <img src="<?php echo base_url(); ?>uploads/userservey/<?php echo $survey->image; ?>" alt="Survey Image" style="max-width: 150px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                 <br>
                                 <small><a href="<?php echo base_url(); ?>uploads/userservey/<?php echo $survey->image; ?>" target="_blank">View Full Image</a></small>
                              </div>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-3">
                           <label for="reference">Reference</label>
                           <input type="text" class="form-control" id="reference" name="reference" required  value="<?php echo $survey->reference; ?>"  />
                        </div>
                        <div class="form-group col-md-3">
                           <label for="remark">Remark</label>
                           <input type="text" class="form-control" id="remark" name="remark" required  value="<?php echo $survey->remark; ?>"  />
                        </div>
                     </div>

                    <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

 
<!-- Include Select2 CSS and JS if not already included -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function () {
    var base_url = "<?php echo base_url()?>";
    
    // Store pre-selected values from PHP
    var selectedBoothId = '<?php echo $survey->boothname; ?>';
    var selectedPanchayatId = '<?php echo $survey->grampanchayat; ?>';
    var selectedVillageId = '<?php echo $survey->village; ?>';
    var selectedVidhanSabhaId = '<?php echo isset($survey->vidhan_sabha_id) ? (int)$survey->vidhan_sabha_id : ""; ?>';

    $("#district").change(function () {
        var districtId = $(this).val();
        var $vs = $("#vidhan_sabha_id");
        $vs.empty().append('<option value="">N/A</option>').prop("disabled", !districtId);
        if (districtId) {
            $.getJSON(base_url + "getVidhanSabhaByDistrict?district_id=" + districtId, function (data) {
                if (data && data.length) {
                    $.each(data, function (i, item) {
                        var sel = (item.id == selectedVidhanSabhaId) ? ' selected' : '';
                        $vs.append('<option value="' + item.id + '"' + sel + '>' + (item.vidhan_sabha_name || '') + '</option>');
                    });
                }
                if (!selectedVidhanSabhaId) { $vs.find('option[value=""]').prop('selected', true); }
                $vs.trigger('change.select2');
            });
        }
    });

    // 1. Initialize all Select2 elements
    $('.select2').select2({
        width: '100%'
    });

    // 2. Define AJAX loading functions
    function loadBooths(blockId, callback) {
        if (blockId && blockId != 0) {
            $.ajax({
                url: base_url + "api/get_booths_by_block",
                method: "POST",
                data: { block_id: blockId },
                dataType: 'json',
                success: function (response) {
                    $('#booth').empty().append('<option value="0">Select Booth</option>');
                    if (response.booths) {
                        $.each(response.booths, function (index, booth) {
                            var isSelected = (booth.id == selectedBoothId) ? ' selected' : '';
                            $('#booth').append('<option bnumbervalue="' + booth.bnumber + '" value="' + booth.id + '"' + isSelected + '>' + booth.name + '</option>');
                        });
                    }
                    $('#booth').trigger('change.select2');
                    if (callback) callback();
                }
            });
        }
    }

    function loadPanchayats(boothId, callback) {
        if (boothId && boothId != 0) {
            $.ajax({
                url: base_url + "api/get_panchayats_by_booth",
                method: "POST",
                data: { booth_id: boothId },
                dataType: 'json',
                success: function (response) {
                    $('#panchayat').empty().append('<option value="0">Select Panchayat</option>');
                    if (response.panchayats) {
                        $.each(response.panchayats, function (index, value) {
                            var isSelected = (value.id == selectedPanchayatId) ? ' selected' : '';
                            $('#panchayat').append('<option value="' + value.id + '"' + isSelected + '>' + value.name + '</option>');
                        });
                    }
                    $('#panchayat').trigger('change.select2');
                    if (callback) callback();
                }
            });
        }
    }

    function loadVillages(panchayatId, callback) {
        if (panchayatId && panchayatId != 0) {
            $.ajax({
                url: base_url + "api/get_villages_by_panchayat",
                type: "POST",
                data: { panchayat_id: panchayatId },
                dataType: "json",
                success: function (response) {
                    $("#village").empty().append('<option value="">Select Village</option>');
                    if (response.villages) {
                        $.each(response.villages, function (index, village) {
                            var isSelected = (village.id == selectedVillageId) ? ' selected' : '';
                            $("#village").append('<option value="' + village.id + '"' + isSelected + '>' + village.name + "</option>");
                        });
                    }
                    $('#village').trigger('change.select2');
                    if (callback) callback();
                }
            });
        }
    }

    // 3. Define Event Listeners
    $('#block').on('change', function () {
        var blockId = $(this).val();
        if (blockId && blockId != 0) {
            loadBooths(blockId);
        } else {
            $('#booth').empty().append('<option value="0">Select Booth</option>').trigger('change.select2');
            $('#panchayat').empty().append('<option value="0">Select Panchayat</option>').trigger('change.select2');
            $('#village').empty().append('<option value="">Select Village</option>').trigger('change.select2');
        }
    });

    $('#booth').on('change', function () {
        var boothId = $(this).val();
        var bnumber = $(this).find("option:selected").attr("bnumbervalue");
        if (boothId && boothId != 0) {
            if (bnumber) $("#boothnumber").val(bnumber);
            loadPanchayats(boothId);
        } else {
            $('#panchayat').empty().append('<option value="0">Select Panchayat</option>').trigger('change.select2');
            $('#village').empty().append('<option value="">Select Village</option>').trigger('change.select2');
        }
    });

    $('#panchayat').on('change', function () {
        var panchayatId = $(this).val();
        if (panchayatId && panchayatId != 0) {
            loadVillages(panchayatId);
        } else {
            $('#village').empty().append('<option value="">Select Village</option>').trigger('change.select2');
        }
    });

    // 4. Set initial selections for dependent dropdowns in sequence
    var initialBlockId = '<?php echo $survey->block_name_number; ?>';
    if (initialBlockId && initialBlockId != 0) {
        // Use standard 'change' event for Select2
        $('#block').val(initialBlockId).trigger('change');
        
        loadBooths(initialBlockId, function() {
            if (selectedBoothId && selectedBoothId != 0) {
                $('#booth').val(selectedBoothId).trigger('change');
                loadPanchayats(selectedBoothId, function() {
                    if (selectedPanchayatId && selectedPanchayatId != 0) {
                        $('#panchayat').val(selectedPanchayatId).trigger('change');
                        loadVillages(selectedPanchayatId, function() {
                            if (selectedVillageId) {
                                $('#village').val(selectedVillageId).trigger('change');
                            }
                        });
                    }
                });
            }
        });
    }

    // 5. Force update of non-dependent Select2 dropdowns (Robust matching with Hindi support)
    var syncSelects = ['district', 'samithi', 'parti', 'jaati', 'education', 'gender'];
    var hindiMap = {
        // Gender
        'पुरुष': 'Male',
        'महिला': 'Female',
        'अन्य': 'other',
        // Education
        'अशिक्षित': 'uneducate',
        'साक्षर': 'educate',
        'प्राइमरी स्कूल (5th)': '5th',
        'मिडिल स्कूल (8th)': '8th',
        'primary': '5th',
        'middle': '8th',
        'हाई स्कूल (10th)': '10th',
        'हायर सेकेंडरी स्कूल (12th)': '12th',
        'स्नातक': 'Gradute',
        'स्नातकोत्तर': 'Post-Gradute',
        // Cast (Jaati)
        'एस टी (भील)': 'ST (bhil)',
        'एसटी (भील)': 'ST (bhil)',
        'एस टी (भिलाला)': 'ST (Bhilala)',
        'सामान्य': 'General',
        'अन्य पिछड़ा वर्ग': 'OBC',
        'ओबीसी': 'OBC',
        'अनुसूचित जाति': 'SC',
        'एससी': 'SC',
        'अनुसूचित जनजाति': 'ST',
        'एसटी': 'ST',
        'मुस्लिम': 'Muslim',
        'ब्राह्मण': 'Brahman',
    };

    syncSelects.forEach(function(id) {
        var $el = $('#' + id);
        var rawVal = (String($el.attr('data-pre-val') || '')).trim();
        
        if (rawVal && rawVal !== '0' && rawVal !== 'null' && rawVal !== '') {
            // 1. Try direct match
            $el.val(rawVal).trigger('change');
            
            // 2. Try Hindi Map translation (Case-insensitive check)
            if (!$el.val() || $el.val() == "" || $el.val() == "0") {
                for (var key in hindiMap) {
                    if (key.trim() === rawVal || key.replace(/\s/g, '') === rawVal.replace(/\s/g, '')) {
                        $el.val(hindiMap[key]).trigger('change');
                        break;
                    }
                }
            }

            // 3. Robust fuzzy match loop
            if (!$el.val() || $el.val() == "" || $el.val() == "0") {
                $el.find('option').each(function() {
                    var optVal = String($(this).val() || '').trim().toLowerCase().replace(/\s/g, '');
                    var optText = String($(this).text() || '').trim().toLowerCase().replace(/\s/g, '');
                    var searchVal = rawVal.toLowerCase().replace(/\s/g, '');
                    
                    if (optVal === searchVal || optText === searchVal || optText.includes(searchVal)) {
                        $el.val($(this).val()).trigger('change');
                        return false;
                    }
                });
            }
        }
    });

    // Handle checkboxes fuzzy matching (Robust for Hindi/English mix)
    var rawVehicle = '<?php echo str_replace(["\r", "\n", "'"], ["", "", "\\'"], $survey->vehicle); ?>';
    if (rawVehicle && rawVehicle != '0' && rawVehicle != '') {
        var items = rawVehicle.split(',').map(function(s) { return s.trim().toLowerCase(); });
        var vehicleMatches = {
            'कोई वाहन नहीं है': 'koi vahan nhi',
            'दो पहिया': '2 wheeler',
            'चार पहिया': '4 wheeler'
        };

        $('input[name="vehicle[]"]').each(function() {
            var cbVal = $(this).val().toLowerCase().trim();
            var cbText = $(this).parent().text().toLowerCase().trim();
            
            var isMatched = items.some(function(item) {
                var cleanItem = item.replace(/\s/g, '');
                // Check direct, mapped, or partial match
                return cleanItem === cbVal.replace(/\s/g, '') || 
                       cleanItem === cbText.replace(/\s/g, '') ||
                       (vehicleMatches[item] && vehicleMatches[item] === cbVal) ||
                       (item.includes('2') && cbVal.includes('2')) ||
                       (item.includes('4') && cbVal.includes('4')) ||
                       (item.includes('vahan') && cbVal.includes('vahan')) ||
                       (item.includes('नहीं') && cbVal.includes('vahan'));
            });
            
            if (isMatched) {
                $(this).prop('checked', true);
            }
        });
    }
});
</script>


 