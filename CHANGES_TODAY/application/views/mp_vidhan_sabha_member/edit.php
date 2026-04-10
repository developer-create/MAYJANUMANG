<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-edit" aria-hidden="true"></i> Edit MP Vidhan Sabha Member
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Member Details</h3>
                    </div>
                    <form role="form" id="memberForm" method="post" action="<?php echo site_url('mp_vidhan_sabha_member/update/'.$member['id']); ?>">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="month">Month</label>
                                        <input type="text" class="form-control" id="month" name="month" placeholder="Enter Month" value="<?php echo htmlspecialchars($member['month']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($member['date']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district_id">District</label>
                                        <select class="form-control" id="district_id" name="district_id">
                                            <option value="">Select District</option>
                                            <?php foreach ($districts as $district): ?>
                                                <option value="<?php echo $district['id']; ?>" <?php echo ($member['district_id'] == $district['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($district['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="block_id">Block</label>
                                        <select class="form-control" id="block_id" name="block_id">
                                            <option value="">Select Block</option>
                                            <?php foreach ($blocks as $block): ?>
                                                <option value="<?php echo $block['id']; ?>" <?php echo ($member['block_id'] == $block['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($block['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="panchayat_id">Panchayat</label>
                                        <select class="form-control" id="panchayat_id" name="panchayat_id">
                                            <option value="">Select Panchayat</option>
                                            <?php foreach ($panchayats as $panchayat): ?>
                                                <option value="<?php echo $panchayat['id']; ?>" <?php echo ($member['panchayat_id'] == $panchayat['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($panchayat['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vidhan_sabha_id">Vidhan Sabha</label>
                                        <select class="form-control" id="vidhan_sabha_id" name="vidhan_sabha_id">
                                            <option value="">Select Vidhan Sabha</option>
                                            <?php foreach ($vidhan_sabhas as $vs): ?>
                                                <option value="<?php echo $vs['id']; ?>" <?php echo ($member['vidhan_sabha_id'] == $vs['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($vs['vidhan_sabha_name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="village_id">Village</label>
                                        <select class="form-control" id="village_id" name="village_id">
                                            <option value="">Select Village</option>
                                            <?php foreach ($villages as $village): ?>
                                                <option value="<?php echo $village['id']; ?>" <?php echo ($member['village_id'] == $village['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($village['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo htmlspecialchars($member['name']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type="text" class="form-control" id="position" name="position" placeholder="Enter Position" value="<?php echo htmlspecialchars($member['position']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile_no">Mobile No</label>
                                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile No" value="<?php echo htmlspecialchars($member['mobile_no']); ?>">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h4>Additional Fields</h4>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bg">BG</label>
                                        <input type="text" class="form-control" id="bg" name="bg" value="<?php echo htmlspecialchars($member['bg']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bc">BC</label>
                                        <input type="text" class="form-control" id="bc" name="bc" value="<?php echo htmlspecialchars($member['bc']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="er">ER</label>
                                        <input type="text" class="form-control" id="er" name="er" value="<?php echo htmlspecialchars($member['er']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="br">BR</label>
                                        <input type="text" class="form-control" id="br" name="br" value="<?php echo htmlspecialchars($member['br']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ip">IP</label>
                                        <input type="text" class="form-control" id="ip" name="ip" value="<?php echo htmlspecialchars($member['ip']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sc">SC</label>
                                        <input type="text" class="form-control" id="sc" name="sc" value="<?php echo htmlspecialchars($member['sc']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sa">SA</label>
                                        <input type="text" class="form-control" id="sa" name="sa" value="<?php echo htmlspecialchars($member['sa']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="yc">YC</label>
                                        <input type="text" class="form-control" id="yc" name="yc" value="<?php echo htmlspecialchars($member['yc']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ap">AP</label>
                                        <input type="text" class="form-control" id="ap" name="ap" value="<?php echo htmlspecialchars($member['ap']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fp">FP</label>
                                        <input type="text" class="form-control" id="fp" name="fp" value="<?php echo htmlspecialchars($member['fp']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pp">PP</label>
                                        <input type="text" class="form-control" id="pp" name="pp" value="<?php echo htmlspecialchars($member['pp']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="wc">WC</label>
                                        <input type="text" class="form-control" id="wc" name="wc" value="<?php echo htmlspecialchars($member['wc']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pa">PA</label>
                                        <input type="text" class="form-control" id="pa" name="pa" value="<?php echo htmlspecialchars($member['pa']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pc">PC</label>
                                        <input type="text" class="form-control" id="pc" name="pc" value="<?php echo htmlspecialchars($member['pc']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ak">AK</label>
                                        <input type="text" class="form-control" id="ak" name="ak" value="<?php echo htmlspecialchars($member['ak']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fm">FM</label>
                                        <input type="text" class="form-control" id="fm" name="fm" value="<?php echo htmlspecialchars($member['fm']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="zp">ZP</label>
                                        <input type="text" class="form-control" id="zp" name="zp" value="<?php echo htmlspecialchars($member['zp']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="vp">VP</label>
                                        <input type="text" class="form-control" id="vp" name="vp" value="<?php echo htmlspecialchars($member['vp']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sr">SR</label>
                                        <input type="text" class="form-control" id="sr" name="sr" value="<?php echo htmlspecialchars($member['sr']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="in_field">IN</label>
                                        <input type="text" class="form-control" id="in_field" name="in_field" value="<?php echo htmlspecialchars($member['in_field']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="eo">EO</label>
                                        <input type="text" class="form-control" id="eo" name="eo" value="<?php echo htmlspecialchars($member['eo']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gs">GS</label>
                                        <input type="text" class="form-control" id="gs" name="gs" value="<?php echo htmlspecialchars($member['gs']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="us">US</label>
                                        <input type="text" class="form-control" id="us" name="us" value="<?php echo htmlspecialchars($member['us']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pw">PW</label>
                                        <input type="text" class="form-control" id="pw" name="pw" value="<?php echo htmlspecialchars($member['pw']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nl">NL</label>
                                        <input type="text" class="form-control" id="nl" name="nl" value="<?php echo htmlspecialchars($member['nl']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fr">FR</label>
                                        <input type="text" class="form-control" id="fr" name="fr" value="<?php echo htmlspecialchars($member['fr']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="so">SO</label>
                                        <input type="text" class="form-control" id="so" name="so" value="<?php echo htmlspecialchars($member['so']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="st">ST</label>
                                        <input type="text" class="form-control" id="st" name="st" value="<?php echo htmlspecialchars($member['st']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ob">OB</label>
                                        <input type="text" class="form-control" id="ob" name="ob" value="<?php echo htmlspecialchars($member['ob']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="smw">SMW</label>
                                        <input type="text" class="form-control" id="smw" name="smw" value="<?php echo htmlspecialchars($member['smw']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="smtw">SMTW</label>
                                        <input type="text" class="form-control" id="smtw" name="smtw" value="<?php echo htmlspecialchars($member['smtw']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="it">IT</label>
                                        <input type="text" class="form-control" id="it" name="it" value="<?php echo htmlspecialchars($member['it']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="test">TEST</label>
                                        <input type="text" class="form-control" id="test" name="test" value="<?php echo htmlspecialchars($member['test']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dyc">DYC</label>
                                        <input type="text" class="form-control" id="dyc" name="dyc" value="<?php echo htmlspecialchars($member['dyc']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dcc">DCC</label>
                                        <input type="text" class="form-control" id="dcc" name="dcc" value="<?php echo htmlspecialchars($member['dcc']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="obc">OBC</label>
                                        <input type="text" class="form-control" id="obc" name="obc" value="<?php echo htmlspecialchars($member['obc']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cell">CELL</label>
                                        <input type="text" class="form-control" id="cell" name="cell" value="<?php echo htmlspecialchars($member['cell']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mp">MP</label>
                                        <input type="text" class="form-control" id="mp" name="mp" value="<?php echo htmlspecialchars($member['mp']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dt">DT</label>
                                        <input type="text" class="form-control" id="dt" name="dt" value="<?php echo htmlspecialchars($member['dt']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dp">DP</label>
                                        <input type="text" class="form-control" id="dp" name="dp" value="<?php echo htmlspecialchars($member['dp']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="avp">AVP</label>
                                        <input type="text" class="form-control" id="avp" name="avp" value="<?php echo htmlspecialchars($member['avp']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="meet">MEET</label>
                                        <input type="text" class="form-control" id="meet" name="meet" value="<?php echo htmlspecialchars($member['meet']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="media">MEDIA</label>
                                        <input type="text" class="form-control" id="media" name="media" value="<?php echo htmlspecialchars($member['media']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mla_x_mla">MLA,X MLA</label>
                                        <input type="text" class="form-control" id="mla_x_mla" name="mla_x_mla" value="<?php echo htmlspecialchars($member['mla_x_mla']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="vech">VECH</label>
                                        <input type="text" class="form-control" id="vech" name="vech" value="<?php echo htmlspecialchars($member['vech']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="it_cell_exp">IT CELL EXP</label>
                                        <input type="text" class="form-control" id="it_cell_exp" name="it_cell_exp" value="<?php echo htmlspecialchars($member['it_cell_exp']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="info">INFO</label>
                                        <input type="text" class="form-control" id="info" name="info" value="<?php echo htmlspecialchars($member['info']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nsui">NSUI</label>
                                        <input type="text" class="form-control" id="nsui" name="nsui" value="<?php echo htmlspecialchars($member['nsui']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="imp">IMP</label>
                                        <input type="text" class="form-control" id="imp" name="imp" value="<?php echo htmlspecialchars($member['imp']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="advise">ADVISE</label>
                                        <input type="text" class="form-control" id="advise" name="advise" value="<?php echo htmlspecialchars($member['advise']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ref">REF</label>
                                        <input type="text" class="form-control" id="ref" name="ref" value="<?php echo htmlspecialchars($member['ref']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="remark">Remark</label>
                                <textarea class="form-control" id="remark" name="remark" rows="4" placeholder="Enter Remark"><?php echo htmlspecialchars($member['remark']); ?></textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo site_url('mp_vidhan_sabha_member'); ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
