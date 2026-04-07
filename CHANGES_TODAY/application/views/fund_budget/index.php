<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-sliders"></i> फंड बजट सीमा (वित्तीय वर्ष अनुसार)</h1>
        <small>MLA FUND, Swecha Nidhi, CLP Fund, Jansampark — कुल राशि यहाँ सेट करें</small>
    </section>
    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">बजट सूची</h3>
                        <a href="<?php echo site_url('fundBudget/add'); ?>" class="btn btn-success" style="float:right;">नया जोड़ें</a>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>वित्तीय वर्ष</th>
                                    <th>फंड</th>
                                    <th>कुल राशि (₹)</th>
                                    <th>क्रियाएँ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($rows)): ?>
                                    <tr><td colspan="4">कोई रिकॉर्ड नहीं। कृपया नया जोड़ें।</td></tr>
                                <?php else: ?>
                                    <?php foreach ($rows as $r): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($r['financial_year']); ?></td>
                                            <td><?php echo htmlspecialchars(isset($fund_labels[$r['fund_key']]) ? $fund_labels[$r['fund_key']] : $r['fund_key']); ?></td>
                                            <td><?php echo number_format((float) $r['total_amount'], 2); ?></td>
                                            <td>
                                                <a href="<?php echo site_url('fundBudget/edit/' . (int) $r['id']); ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a href="<?php echo site_url('fundBudget/delete/' . (int) $r['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('डिलीट करें?');"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
