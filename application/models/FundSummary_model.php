<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class FundSummary_model extends CI_Model {

    public function get_funds_data($filters = []) {
        // Query for jansunwai
        $this->db->select("j.id, j.registration_no, j.uname, j.mobile, j.district, 'Jansunwai' as source, j.work_problem, 
                          CASE 
                            WHEN TRIM(j.approved_fund) LIKE 'MLA Swechanudan' THEN 'MLA Sweechanudan'
                            WHEN TRIM(j.approved_fund) LIKE 'MLA Sweechanudan' THEN 'MLA Sweechanudan'
                            WHEN TRIM(j.approved_fund) LIKE 'CLP %' THEN 'CLP Sweechanudan'
                            WHEN TRIM(LOWER(j.approved_fund)) LIKE 'jan%sampark%fund' THEN 'Jansampark Fund'
                            WHEN TRIM(j.approved_fund) LIKE 'जन%संपर्क%' THEN 'Jansampark Fund'
                            WHEN TRIM(j.approved_fund) LIKE 'जन%सम्पर्क%' THEN 'Jansampark Fund'
                            ELSE TRIM(j.approved_fund)
                          END as approved_fund, 
                          j.approximate_cost, j.createdAt as date, j.year, 
                          COALESCE(dist.name, j.district) as district_name, COALESCE(b.name, '') as block_name, COALESCE(p.name, '') as panchayat_name, COALESCE(v.name, '') as village_name, 
                          COALESCE(d.name, '') as department_name, j.work_status, j.booth_no, COALESCE(booth.name, j.booth_name) as booth_name, j.majra_faliya, COALESCE(j.assembly, '') as vidhan_sabha_name,
                          j.work_agency, j.remark, j.address");
        $this->db->from('jansunwai j');
        $this->db->join('district dist', 'dist.id = j.district', 'left');
        $this->db->join('block b', 'b.id = j.block', 'left');
        $this->db->join('panchayat p', 'p.id = j.panchayat_name', 'left');
        $this->db->join('village v', 'v.id = j.village', 'left');
        $this->db->join('department d', 'd.id = j.department', 'left');
        $this->db->join('booth', 'booth.id = j.booth_name', 'left');
        $this->db->where('j.approved_fund !=', '');
        $this->db->where('j.approved_fund IS NOT NULL', NULL, FALSE);
        
        $query1 = $this->db->get_compiled_select();

        // Query for districtpublicproblem
        $this->db->select("dp.id, dp.registration_no, dp.uname, dp.mobile, dp.district, 'MP Public Problem' as source, dp.work_problem, 
                          CASE 
                            WHEN TRIM(dp.approved_fund) LIKE 'MLA Swechanudan' THEN 'MLA Sweechanudan'
                            WHEN TRIM(dp.approved_fund) LIKE 'MLA Sweechanudan' THEN 'MLA Sweechanudan'
                            WHEN TRIM(dp.approved_fund) LIKE 'CLP %' THEN 'CLP Sweechanudan'
                            WHEN TRIM(LOWER(dp.approved_fund)) LIKE 'jan%sampark%fund' THEN 'Jansampark Fund'
                            WHEN TRIM(dp.approved_fund) LIKE 'जन%संपर्क%' THEN 'Jansampark Fund'
                            WHEN TRIM(dp.approved_fund) LIKE 'जन%सम्पर्क%' THEN 'Jansampark Fund'
                            ELSE TRIM(dp.approved_fund)
                          END as approved_fund, 
                          dp.approximate_cost, dp.createdAt as date, dp.year, 
                          COALESCE(dist.name, dp.district) as district_name, COALESCE(b.name, '') as block_name, COALESCE(p.name, '') as panchayat_name, COALESCE(v.name, '') as village_name, 
                          COALESCE(d.name, '') as department_name, dp.work_status, dp.booth_no, dp.booth_name, dp.majra_faliya, COALESCE(dp.assembly, '') as vidhan_sabha_name,
                          dp.work_agency, dp.remark, dp.address");
        $this->db->from('districtpublicproblem dp');
        $this->db->join('district dist', 'dist.id = dp.district', 'left');
        $this->db->join('block b', 'b.id = dp.block', 'left');
        $this->db->join('panchayat p', 'p.id = dp.panchayat', 'left');
        $this->db->join('village v', 'v.id = dp.village', 'left');
        $this->db->join('department d', 'd.id = dp.department', 'left');
        $this->db->where('dp.approved_fund !=', '');
        $this->db->where('dp.approved_fund IS NOT NULL', NULL, FALSE);
        
        $query2 = $this->db->get_compiled_select();

        // UNION both queries
        $combined_query = "({$query1}) UNION ({$query2})";
        
        // Wrap combined query to apply filters
        $sql = "SELECT * FROM ({$combined_query}) as combined_funds WHERE 1=1";
        
        if (!empty($filters['fund_type'])) {
            $fund_type = $filters['fund_type'];
            // Since combined_funds already has normalized 'approved_fund', we can filter on that
            $sql .= " AND approved_fund = " . $this->db->escape($fund_type);
        }
        
        // Use only financial_year if provided (priority over year)
        if (!empty($filters['financial_year'])) {
            $fin_year = $filters['financial_year'];
            $parts = explode('-', $fin_year);
            if (count($parts) == 2) {
                $start_year = $parts[0];
                $fin_year_short = $start_year . '-' . substr($parts[1], -2);
                
                $sql .= " AND (year = " . $this->db->escape($start_year) . 
                        " OR year = " . $this->db->escape($fin_year) . 
                        " OR year = " . $this->db->escape($fin_year_short) . ")";
            }
        } else if (!empty($filters['year'])) {
            // Fallback to year filter if financial_year not provided
            $sql .= " AND year = " . $this->db->escape($filters['year']);
        }
        
        if (!empty($filters['from_date'])) {
            $sql .= " AND DATE(date) >= " . $this->db->escape($filters['from_date']);
        }
        
        if (!empty($filters['to_date'])) {
            $sql .= " AND DATE(date) <= " . $this->db->escape($filters['to_date']);
        }
        
        if (!empty($filters['work_status'])) {
            $sql .= " AND work_status = " . $this->db->escape($filters['work_status']);
        }

        if (!empty($filters['registration_no'])) {
            $sql .= " AND registration_no LIKE " . $this->db->escape('%' . $filters['registration_no'] . '%');
        }

        $sql .= " ORDER BY date DESC";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_fund_totals($filters = []) {
        // Shared filter building logic for the inner parts of the union
        $filter_sql = "";
        
        $financial_year = isset($filters['financial_year']) ? $filters['financial_year'] : null;
        if($financial_year) {
            $parts = explode('-', $financial_year);
            if (count($parts) == 2) {
                $start_year = $parts[0];
                $fin_year_short = $start_year . '-' . substr($parts[1], -2);
                
                $filter_sql .= " AND (year = " . $this->db->escape($start_year) . 
                               " OR year = " . $this->db->escape($financial_year) . 
                               " OR year = " . $this->db->escape($fin_year_short) . ")";
            }
        } else if (!empty($filters['year'])) {
            $filter_sql .= " AND year = " . $this->db->escape($filters['year']);
        }
        
        if (!empty($filters['from_date'])) {
            $filter_sql .= " AND DATE(createdAt) >= " . $this->db->escape($filters['from_date']);
        }
        
        if (!empty($filters['to_date'])) {
            $filter_sql .= " AND DATE(createdAt) <= " . $this->db->escape($filters['to_date']);
        }
        
        if (!empty($filters['work_status'])) {
            $filter_sql .= " AND work_status = " . $this->db->escape($filters['work_status']);
        }
        
        if (!empty($filters['registration_no'])) {
            $filter_sql .= " AND registration_no LIKE " . $this->db->escape('%' . $filters['registration_no'] . '%');
        }

        // Subquery for jansunwai with normalization
        $sql1 = "SELECT 
                    CASE 
                        WHEN TRIM(approved_fund) LIKE 'MLA Swechanudan' THEN 'MLA Sweechanudan'
                        WHEN TRIM(approved_fund) LIKE 'MLA Sweechanudan' THEN 'MLA Sweechanudan'
                        WHEN TRIM(approved_fund) LIKE 'CLP %' THEN 'CLP Sweechanudan'
                        WHEN TRIM(LOWER(approved_fund)) LIKE 'jan%sampark%fund' THEN 'Jansampark Fund'
                        WHEN TRIM(approved_fund) LIKE 'जन%संपर्क%' THEN 'Jansampark Fund'
                        WHEN TRIM(approved_fund) LIKE 'जन%सम्पर्क%' THEN 'Jansampark Fund'
                        ELSE TRIM(approved_fund)
                    END as approved_fund, 
                    COALESCE(approximate_cost, 0) as approximate_cost
                FROM jansunwai
                WHERE approved_fund IS NOT NULL AND approved_fund != ''" . $filter_sql;

        // Subquery for districtpublicproblem with normalization
        $sql2 = "SELECT 
                    CASE 
                        WHEN TRIM(approved_fund) LIKE 'MLA Swechanudan' THEN 'MLA Sweechanudan'
                        WHEN TRIM(approved_fund) LIKE 'MLA Sweechanudan' THEN 'MLA Sweechanudan'
                        WHEN TRIM(approved_fund) LIKE 'CLP %' THEN 'CLP Sweechanudan'
                        WHEN TRIM(LOWER(approved_fund)) LIKE 'jan%sampark%fund' THEN 'Jansampark Fund'
                        WHEN TRIM(approved_fund) LIKE 'जन%संपर्क%' THEN 'Jansampark Fund'
                        WHEN TRIM(approved_fund) LIKE 'जन%सम्पर्क%' THEN 'Jansampark Fund'
                        ELSE TRIM(approved_fund)
                    END as approved_fund, 
                    COALESCE(approximate_cost, 0) as approximate_cost
                FROM districtpublicproblem
                WHERE approved_fund IS NOT NULL AND approved_fund != ''" . $filter_sql;
        
        // Combined query - group by normalized names
        $combined_sql = "SELECT approved_fund, SUM(approximate_cost) as total_used 
                        FROM (({$sql1}) UNION ALL ({$sql2})) as combined 
                        GROUP BY approved_fund";
        
        $query = $this->db->query($combined_sql);
        $results = $query->result_array();
        
        $fund_map = [];
        foreach ($results as $row) {
            if ($row['approved_fund']) {
                $fund_map[$row['approved_fund']] = $row['total_used'];
            }
        }
        
        return $fund_map;
    }
}
