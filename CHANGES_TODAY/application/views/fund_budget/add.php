<div class="content-wrapper">
    <section class="content-header">
        <h1>नया फंड बजट</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">विवरण</h3>
                        <a href="<?php echo site_url('fundBudget'); ?>" class="btn btn-default btn-sm" style="float:right;">वापस</a>
                    </div>
                    <?php echo form_open('fundBudget/save'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label>वित्तीय वर्ष</label>
                            <select name="financial_year" class="form-control" required>
                                <option value="">— चुनें —</option>
                                <?php krsort($financial_years);
                                foreach ($financial_years as $fy): ?>
                                    <option value="<?php echo htmlspecialchars($fy); ?>"><?php echo htmlspecialchars($fy); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>फंड</label>
                            <select name="fund_key" class="form-control" required>
                                <option value="">— चुनें —</option>
                                <?php foreach ($fund_keys as $fk): ?>
                                    <option value="<?php echo htmlspecialchars($fk); ?>"><?php echo htmlspecialchars(isset($fund_labels[$fk]) ? $fund_labels[$fk] : $fk); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>कुल राशि (₹)</label>
                            <input type="number" name="total_amount" class="form-control" step="0.01" min="0" required value="<?php echo set_value('total_amount'); ?>">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">सेव</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>
