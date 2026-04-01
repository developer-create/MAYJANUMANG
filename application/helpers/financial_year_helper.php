<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Financial Year Helper
 * Helper functions for managing financial years (2008-09 to 2026-27)
 */

/**
 * Generate financial years array
 * @param int $start_year - Starting year (default 2008)
 * @param int $end_year - Ending year (default 2027)
 * @return array - Array of financial years in format YYYY-YY
 */
if (!function_exists('get_financial_years')) {
    function get_financial_years($start_year = 2008, $end_year = 2027) {
        $financial_years = [];
        
        for ($year = $start_year; $year < $end_year; $year++) {
            $next_year = substr($year + 1, -2); // Get last 2 digits of next year
            $financial_year = $year . '-' . $next_year;
            $financial_years[$financial_year] = $financial_year;
        }
        
        return $financial_years;
    }
}

/**
 * Get current financial year
 * Financial year starts from April and ends in March
 * @return string - Current financial year in format YYYY-YY
 */
if (!function_exists('get_current_financial_year')) {
    function get_current_financial_year() {
        $current_date = new DateTime();
        $current_month = (int)$current_date->format('m');
        $current_year = (int)$current_date->format('Y');
        
        if ($current_month >= 4) {
            // April onwards - current year is start year
            $start_year = $current_year;
        } else {
            // January to March - previous year is start year
            $start_year = $current_year - 1;
        }
        
        $next_year = substr($start_year + 1, -2);
        return $start_year . '-' . $next_year;
    }
}

/**
 * Convert year and month to financial year
 * @param int $year - Year (e.g., 2025)
 * @param int $month - Month (1-12)
 * @return string - Financial year in format YYYY-YY
 */
if (!function_exists('get_financial_year_from_date')) {
    function get_financial_year_from_date($year, $month) {
        $month = (int)$month;
        $year = (int)$year;
        
        if ($month >= 4) {
            // April onwards - current year is start year
            $start_year = $year;
        } else {
            // January to March - previous year is start year
            $start_year = $year - 1;
        }
        
        $next_year = substr($start_year + 1, -2);
        return $start_year . '-' . $next_year;
    }
}

?>
