<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus" aria-hidden="true"></i> Add MP Vidhan Sabha Member
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Member Details</h3>
                    </div>
                    <form role="form" id="memberForm" method="post" action="<?php echo site_url('mp_vidhan_sabha_member/store'); ?>">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="month">Month</label>
                                        <input type="text" class="form-control" id="month" name="month" placeholder="Enter Month">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" id="date" name="date">
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
                                                <option value="<?php echo $district['id']; ?>"><?php echo htmlspecialchars($district['name']); ?></option>
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
                                                <option value="<?php echo $block['id']; ?>"><?php echo htmlspecialchars($block['name']); ?></option>
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
                                                <option value="<?php echo $panchayat['id']; ?>"><?php echo htmlspecialchars($panchayat['name']); ?></option>
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
                                                <option value="<?php echo $vs['id']; ?>"><?php echo htmlspecialchars($vs['vidhan_sabha_name']); ?></option>
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
                                                <option value="<?php echo $village['id']; ?>"><?php echo htmlspecialchars($village['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type="text" class="form-control" id="position" name="position" placeholder="Enter Position">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile_no">Mobile No</label>
                                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile No">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h4>Additional Fields</h4>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bg">BG</label>
                                        <input type="text" class="form-control" id="bg" name="bg">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bc">BC</label>
                                        <input type="text" class="form-control" id="bc" name="bc">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="er">ER</label>
                                        <input type="text" class="form-control" id="er" name="er">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="br">BR</label>
                                        <input type="text" class="form-control" id="br" name="br">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ip">IP</label>
                                        <input type="text" class="form-control" id="ip" name="ip">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sc">SC</label>
                                        <input type="text" class="form-control" id="sc" name="sc">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sa">SA</label>
                                        <input type="text" class="form-control" id="sa" name="sa">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="yc">YC</label>
                                        <input type="text" class="form-control" id="yc" name="yc">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ap">AP</label>
                                        <input type="text" class="form-control" id="ap" name="ap">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fp">FP</label>
                                        <input type="text" class="form-control" id="fp" name="fp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pp">PP</label>
                                        <input type="text" class="form-control" id="pp" name="pp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="wc">WC</label>
                                        <input type="text" class="form-control" id="wc" name="wc">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pa">PA</label>
                                        <input type="text" class="form-control" id="pa" name="pa">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pc">PC</label>
                                        <input type="text" class="form-control" id="pc" name="pc">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ak">AK</label>
                                        <input type="text" class="form-control" id="ak" name="ak">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fm">FM</label>
                                        <input type="text" class="form-control" id="fm" name="fm">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="zp">ZP</label>
                                        <input type="text" class="form-control" id="zp" name="zp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="vp">VP</label>
                                        <input type="text" class="form-control" id="vp" name="vp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sr">SR</label>
                                        <input type="text" class="form-control" id="sr" name="sr">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="in_field">IN</label>
                                        <input type="text" class="form-control" id="in_field" name="in_field">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="eo">EO</label>
                                        <input type="text" class="form-control" id="eo" name="eo">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gs">GS</label>
                                        <input type="text" class="form-control" id="gs" name="gs">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="us">US</label>
                                        <input type="text" class="form-control" id="us" name="us">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pw">PW</label>
                                        <input type="text" class="form-control" id="pw" name="pw">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nl">NL</label>
                                        <input type="text" class="form-control" id="nl" name="nl">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fr">FR</label>
                                        <input type="text" class="form-control" id="fr" name="fr">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="so">SO</label>
                                        <input type="text" class="form-control" id="so" name="so">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="st">ST</label>
                                        <input type="text" class="form-control" id="st" name="st">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ob">OB</label>
                                        <input type="text" class="form-control" id="ob" name="ob">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="smw">SMW</label>
                                        <input type="text" class="form-control" id="smw" name="smw">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="smtw">SMTW</label>
                                        <input type="text" class="form-control" id="smtw" name="smtw">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="it">IT</label>
                                        <input type="text" class="form-control" id="it" name="it">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="test">TEST</label>
                                        <input type="text" class="form-control" id="test" name="test">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dyc">DYC</label>
                                        <input type="text" class="form-control" id="dyc" name="dyc">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dcc">DCC</label>
                                        <input type="text" class="form-control" id="dcc" name="dcc">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="obc">OBC</label>
                                        <input type="text" class="form-control" id="obc" name="obc">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cell">CELL</label>
                                        <input type="text" class="form-control" id="cell" name="cell">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mp">MP</label>
                                        <input type="text" class="form-control" id="mp" name="mp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dt">DT</label>
                                        <input type="text" class="form-control" id="dt" name="dt">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dp">DP</label>
                                        <input type="text" class="form-control" id="dp" name="dp">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="avp">AVP</label>
                                        <input type="text" class="form-control" id="avp" name="avp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="meet">MEET</label>
                                        <input type="text" class="form-control" id="meet" name="meet">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="media">MEDIA</label>
                                        <input type="text" class="form-control" id="media" name="media">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mla_x_mla">MLA,X MLA</label>
                                        <input type="text" class="form-control" id="mla_x_mla" name="mla_x_mla">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="vech">VECH</label>
                                        <input type="text" class="form-control" id="vech" name="vech">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="it_cell_exp">IT CELL EXP</label>
                                        <input type="text" class="form-control" id="it_cell_exp" name="it_cell_exp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="info">INFO</label>
                                        <input type="text" class="form-control" id="info" name="info">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nsui">NSUI</label>
                                        <input type="text" class="form-control" id="nsui" name="nsui">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="imp">IMP</label>
                                        <input type="text" class="form-control" id="imp" name="imp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="advise">ADVISE</label>
                                        <input type="text" class="form-control" id="advise" name="advise">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ref">REF</label>
                                        <input type="text" class="form-control" id="ref" name="ref">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="remark">Remark</label>
                                <textarea class="form-control" id="remark" name="remark" rows="4" placeholder="Enter Remark"></textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo site_url('mp_vidhan_sabha_member'); ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
