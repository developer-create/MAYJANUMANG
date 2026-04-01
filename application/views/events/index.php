<div class="content-wrapper">
    <!-- Content Header (Page header) --> 
    
    <style>
        
        table.dataTable thead>tr>th.sorting:after, table.dataTable thead>tr>th.sorting_asc:after, table.dataTable thead>tr>th.sorting_desc:after, table.dataTable thead>tr>th.sorting_asc_disabled:after, table.dataTable thead>tr>th.sorting_desc_disabled:after, table.dataTable thead>tr>td.sorting:after, table.dataTable thead>tr>td.sorting_asc:after, table.dataTable thead>tr>td.sorting_desc:after, table.dataTable thead>tr>td.sorting_asc_disabled:after, table.dataTable thead>tr>td.sorting_desc_disabled:after{

color:#000000 !important;
    opacity: 60 !important;
}

table.dataTable thead>tr>th.sorting:before, table.dataTable thead>tr>th.sorting_asc:before, table.dataTable thead>tr>th.sorting_desc:before, table.dataTable thead>tr>th.sorting_asc_disabled:before, table.dataTable thead>tr>th.sorting_desc_disabled:before, table.dataTable thead>tr>td.sorting:before, table.dataTable thead>tr>td.sorting_asc:before, table.dataTable thead>tr>td.sorting_desc:before, table.dataTable thead>tr>td.sorting_asc_disabled:before, table.dataTable thead>tr>td.sorting_desc_disabled:before{

color:#000000 !important;
    opacity: 60 !important;
}

/* Calendar view - date numbers bigger and bold */
#eventsFullCalendar .fc-daygrid-day-number,
#eventsFullCalendar .fc-col-header-cell-cushion {
    font-size: 16px !important;
    font-weight: bold !important;
}
#eventsFullCalendar .fc-list-day-number {
    font-size: 15px !important;
    font-weight: bold !important;
}
    </style>
    <?php $eventsList = $events; /* Keep copy for calendar - table loop overwrites $events */ ?>
    <section class="content-header"> 
      <h1>
        <i class="fa fa-user-circle-o" aria-hidden="true"></i> Events Management
      </h1>
    </section>
    
    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('gcal_sync_success')): ?>
    <div class="alert alert-success alert-dismissible" style="margin: 15px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        <?php echo $this->session->flashdata('gcal_sync_success'); ?>
    </div>
    <?php endif; ?>
    
    <?php if ($this->session->flashdata('gcal_sync_warning')): ?>
    <div class="alert alert-warning alert-dismissible" style="margin: 15px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-warning"></i> Warning!</h4>
        <?php echo $this->session->flashdata('gcal_sync_warning'); ?>
        <br><small>Check admin panel to enable Google Calendar or verify credentials.</small>
    </div>
    <?php endif; ?>
    <!-- End Flash Messages -->
    
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
    <h3 class="box-title">Events List</h3>  
    <div style="display: inline-block; margin-left: 20px;">
        <label style="display: inline-block; margin-right: 5px;">Year:</label>
        <select id="yearFilter" class="form-control" style="width: 120px; display: inline-block;">
            <option value="">All Years</option>
            <?php 
            $currentYear = date('Y');
            for($year = $currentYear; $year >= 2020; $year--) {
                echo '<option value="' . $year . '">' . $year . '</option>';
            }
            ?>
        </select>
    </div>
    <div style="display: inline-block; margin-left: 15px;">
        <label style="display: inline-block; margin-right: 5px;">Month:</label>
        <select id="monthFilter" class="form-control" style="width: 150px; display: inline-block;">
            <option value="">All Months</option>
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>
        </select>
    </div>
    <div style="display: inline-block; margin-left: 15px;">
        <label style="display: inline-block; margin-right: 5px;">Date Range:</label>
        <input type="date" id="startDate" class="form-control" style="width: 150px; display: inline-block;" placeholder="Start Date">
        <span style="margin: 0 5px;">to</span>
        <input type="date" id="endDate" class="form-control" style="width: 150px; display: inline-block;" placeholder="End Date">
        <button id="filterByDate" class="btn btn-primary btn-sm" style="margin-left: 5px;">
            <i class="fa fa-filter"></i> Filter
        </button>
        <button id="clearDateFilter" class="btn btn-default btn-sm">
            <i class="fa fa-times"></i> Clear
        </button>
    </div>
    <?php
        $currentUserId = $this->session->userdata('userId') ?? ($this->vendorId ?? null);
        $calendarUser = null;
        if ($currentUserId) {
            $calendarUser = $this->db->get_where('tbl_users', ['userId' => $currentUserId, 'isDeleted' => 0])->row();
        }
        $gcalEnabled = !empty($calendarUser) && !empty($calendarUser->google_calendar_enabled);
    ?>
    <div style="float: right;">
        <a href="<?php echo site_url('events/create'); ?>" class="btn btn-success">Add New Events</a>
        <?php if ($gcalEnabled): ?>
            <a href="<?php echo site_url('events/disconnect-google-calendar'); ?>" class="btn btn-danger" style="margin-left: 8px;">Disconnect Google Calendar</a>
        <?php else: ?>
            <a href="<?php echo site_url('events/connect-google-calendar'); ?>" class="btn btn-primary" style="margin-left: 8px;">Connect Google Calendar</a>
        <?php endif; ?>
    </div>
    <div style="margin: 10px 0;">
        <button type="button" id="viewTable" class="btn btn-default btn-sm active"><i class="fa fa-list"></i> Table View</button>
        <button type="button" id="viewCalendar" class="btn btn-default btn-sm"><i class="fa fa-calendar"></i> Calendar View</button>
        <span style="margin-left: 15px; font-size: 12px; color: #666;">
            <span class="label label-danger" style="margin-right: 8px;">HIGH</span>
            <span class="label label-info" style="margin-right: 8px;">LOW</span>
            <span class="label label-default">Other</span>
        </span>
    </div>
</div><!-- /.box-header -->
                <div id="eventsTableView">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover" id="eventTable">
                    <thead>
                      <tr style="color:white;font-size:15px;background-color:#020254;">
                       <th>Sr No</th>  
                       <th>Unique ID</th>
                       <th>District</th>
                       
                    <th>Year</th>
                    <th>Month</th>
                    <th>Day</th>
                    <th>Receiving Date</th>
                   
                    
                    <th>Program Date</th>
                    <th>Time</th>
                     <th>Event Type</th>
                     <th>Event Details</th>
                    <th>Priority</th>
                    <th>Venue City</th>
                    <th>Reference Person</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Probability</th>
                    <th>Duration</th>
                    <th>Attended</th>
                    <th>Press Conference</th>
                    <th>Dispatch Date</th>
                    <th>Dispatch Number</th>
                    <th>Remark</th>
                    <th>Added By</th>
                    <th>Google Calendar Status</th>
                    <th>Actions</th>
                </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($events as $key => $events): ?>
                    <tr>    
                           <td><?php  echo $key+1;?></td>
                           <td><strong><?php echo isset($events['unique_id']) ? $events['unique_id'] : '-'; ?></strong></td>
                           <td><?php echo $events['district']; ?></td>
                            
                            <td><?php echo $events['year']; ?></td>
                            <td><?php echo $events['month']; ?></td>
                            <td><?php echo isset($events['day']) && !empty($events['day']) ? $events['day'] : '-'; ?></td>
                            <td><?php echo $events['date']; ?></td>
                            
                            
                            <td><?php echo $events['program_date']; ?></td>
                            <td><?php echo $events['time']; ?></td>
                            <td><?php echo $events['event_type']; ?></td>
                            <td><?php echo $events['event_detail']; ?></td>
                            <td><?php echo $events['priority']; ?></td>
                            <td><?php echo $events['venue_city']; ?></td>
                            <td><?php echo $events['referance']; ?></td>
                            <td><?php echo $events['contact_number']; ?></td>
                            <td><?php echo $events['address']; ?></td>
                            <td><?php echo $events['name']; ?></td>
                            <td><?php echo $events['location']; ?></td>
                            <td><?php echo $events['probability']; ?></td>
                            <td><?php echo $events['tentative_duration']; ?></td>
                            <td><?php echo $events['attended']; ?></td>
                            <td><?php echo $events['press']; ?></td>
                            <td><?php echo $events['dispatch_date']; ?></td>
                            <td><?php echo $events['dispatch_number']; ?></td>
                            <td><?php echo $events['remark']; ?></td>
                            <td> 
                             <?php
                                 $uid = $events['created_by'];
                                 if ($uid) {
                                     $cc = $this->db->query(
                                         "SELECT * FROM `tbl_users` WHERE `userId`='$uid'"
                                     );
                                     $Uu = $cc->row();
                                     if ($Uu) {
                                         echo $Uu->name;
                                     }
                                 }
                                 ?>
                                 </td>
                            <td>
                                <?php 
                                $googleEventId = isset($events['google_event_id']) ? $events['google_event_id'] : null;
                                if (!empty($googleEventId)) {
                                    echo '<span class="label label-success"><i class="fa fa-check"></i> Synced</span>';
                                } else {
                                    echo '<span class="label label-warning"><i class="fa fa-clock-o"></i> Not Synced</span>';
                                }
                                ?>
                            </td>
                            <td>
                            <a href="<?php echo site_url('events/edit/'.$events['id']); ?>" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                            <a href="<?php echo site_url('events/delete/'.$events['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div><!-- /.box-body -->
                </div><!-- /#eventsTableView -->
                <div id="eventsCalendarView" style="display: none;">
                    <div class="box-body" style="padding: 15px;">
                        <div id="eventsFullCalendar"></div>
                    </div>
                </div>
                <div class="box-footer clearfix">
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section> 
</div> 

<!-- DataTables and related plugins -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<!-- FullCalendar for Calendar View -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<!-- Include Moment.js for date sorting -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.4/sorting/datetime-moment.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<script>
// Events data for calendar (color-coded by priority)
var calendarEventsData = <?php
$cal_events = array();
$edit_base = site_url('events/edit/');
foreach ($eventsList as $ev) {
    $prog_date = isset($ev['program_date']) ? trim($ev['program_date']) : '';
    if (empty($prog_date)) continue; // Skip events without program date
    $priority = isset($ev['priority']) ? strtoupper(trim($ev['priority'])) : '';
    if ($priority === 'HIGH') {
        $color = '#dc3545'; // red
    } elseif ($priority === 'LOW') {
        $color = '#17a2b8'; // info blue
    } else {
        $color = '#6c757d'; // gray
    }
    $time = isset($ev['time']) ? trim($ev['time']) : '';
    if (!empty($time) && preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', $time) && substr_count($time, ':') == 1) {
        $time .= ':00'; // Normalize HH:MM to HH:MM:SS for ISO
    }
    $title = isset($ev['name']) ? $ev['name'] : (isset($ev['event_detail']) ? $ev['event_detail'] : 'Event');
    if (empty($title)) $title = 'Event #' . (isset($ev['unique_id']) ? $ev['unique_id'] : $ev['id']);
    $start = $prog_date;
    if (!empty($time)) {
        $start .= 'T' . $time;
    } else {
        $start .= 'T09:00:00';
    }
    $cal_events[] = array(
        'id' => $ev['id'],
        'title' => $title . ' (' . ($priority ?: 'N/A') . ')',
        'start' => $start,
        'url' => $edit_base . $ev['id'],
        'backgroundColor' => $color,
        'borderColor' => $color,
        'extendedProps' => array(
            'priority' => $priority,
            'district' => isset($ev['district']) ? $ev['district'] : '',
            'venue_city' => isset($ev['venue_city']) ? $ev['venue_city'] : '',
            'event_type' => isset($ev['event_type']) ? $ev['event_type'] : ''
        )
    );
}
echo json_encode($cal_events);
?>;
</script>

<script>
$(document).ready(function() {
    // Register moment.js for DataTables date sorting
    $.fn.dataTable.moment('YYYY-MM-DD'); // Adjust format if needed (e.g., 'DD-MM-YYYY')

    var table = $('#eventTable').DataTable({
        "processing": true,
        "serverSide": false,
        "dom": '<"top"lfB>rt<"bottom"ip>',
        "buttons": [
            {
                extend: 'excelHtml5',
                text: 'Export Excel',
                title: 'Events List'
            }
        ],
        "paging": true,
        "searching": true,
        "ordering": true, // Enable ordering
        "info": true,
        "lengthMenu": [[10, 25, 50, 75, -1], [10, 25, 50, 75, "All"]],
        "columnDefs": [
            { "type": "date", "targets": 4 } // Enable sorting on the "Program Date" column
        ]
    });

    // Filter table based on selected month
    $('#monthFilter').on('change', function() {
        var selectedMonth = $(this).val();
        table.column(4).search(selectedMonth).draw(); // Column 4 is the 'Month' column (after Unique ID column)
    });

    // Filter table based on selected year
    $('#yearFilter').on('change', function() {
        var selectedYear = $(this).val();
        table.column(3).search(selectedYear).draw(); // Column 3 is the 'Year' column
    });

    // Custom date range filtering function for Program Date
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            
            // If no dates selected, show all rows
            if (startDate === '' && endDate === '') {
                return true;
            }
            
            // Get Program Date from column 7 (index 7 - 0-based: Sr No, Unique ID, District, Year, Month, Day, Receiving Date, Program Date)
            var programDate = data[7] || '';
            
            // Parse dates for comparison (assuming format YYYY-MM-DD)
            var start = startDate ? new Date(startDate) : null;
            var end = endDate ? new Date(endDate) : null;
            var rowDate = null;
            
            // Parse the program date
            if (programDate) {
                rowDate = new Date(programDate);
            }
            
            // If rowDate is invalid, exclude this row when date filter is active
            if (!rowDate || isNaN(rowDate.getTime())) {
                return false;
            }
            
            // Normalize dates to ignore time component
            if (start) start.setHours(0, 0, 0, 0);
            if (end) end.setHours(23, 59, 59, 999);
            rowDate.setHours(0, 0, 0, 0);
            
            // Check if row date is within range
            if (start && end) {
                return rowDate >= start && rowDate <= end;
            } else if (start) {
                return rowDate >= start;
            } else if (end) {
                return rowDate <= end;
            }
            
            return true;
        }
    );

    // Apply date range filter
    $('#filterByDate').on('click', function() {
        table.draw();
    });

    // Clear date range filter
    $('#clearDateFilter').on('click', function() {
        $('#startDate').val('');
        $('#endDate').val('');
        table.draw();
    });

    // Also trigger filter when dates change
    $('#startDate, #endDate').on('change', function() {
        table.draw();
    });

    // View toggle: Table / Calendar
    $('#viewTable').on('click', function() {
        $('#eventsTableView').show();
        $('#eventsCalendarView').hide();
        $('#viewTable').addClass('active');
        $('#viewCalendar').removeClass('active');
    });
    $('#viewCalendar').on('click', function() {
        $('#eventsTableView').hide();
        $('#eventsCalendarView').show();
        $('#viewCalendar').addClass('active');
        $('#viewTable').removeClass('active');
        if (!$('#eventsFullCalendar').data('calendar-initialized')) {
            var calendarEl = document.getElementById('eventsFullCalendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                events: calendarEventsData,
                eventClick: function(info) {
                    if (info.event.url) {
                        window.location.href = info.event.url;
                    }
                }
            });
            calendar.render();
            $('#eventsFullCalendar').data('calendar-initialized', true);
        }
    });
});
</script>

// <script>
// $(document).ready(function() {
//     var table = $('#eventTable').DataTable({
//         "processing": true,
//         "serverSide": false,
//         "dom": '<"top"lfB>rt<"bottom"ip>',
//         "buttons": [
//             {
//                 extend: 'excelHtml5',
//                 text: 'Export Excel',
//                 title: 'Events List'
//             }
//         ],
//         "paging": true,
//         "searching": true,
//         "ordering": false,
//         "info": true,
//         "lengthMenu": [[10, 25, 50, 75, -1], [10, 25, 50, 75, "All"]]
//     });

//     // Filter table based on selected month
//     $('#monthFilter').on('change', function() {
//         var selectedMonth = $(this).val();
//         table.column(3).search(selectedMonth).draw(); // Column 3 is the 'Month' column
//     });
// });
// </script>
// <script>
// $(document).ready(function() {
//     $('#eventTable').DataTable({
//         "processing": true, // Show processing indicator 
//         "serverSide": false, // Enable server-side processing
//         "dom": '<"top"lfB>rt<"bottom"ip>', // Control layout: l=lengthMenu, f=filter, B=buttons, t=table, i=info, p=pagination
//         "buttons": [
//             {
//                 extend: 'excelHtml5',
//                 text: 'Export Excel',
//                 title: 'Events List'
//             }
//         ],
//         "paging": true, // Enable pagination
//         "searching": true, // Enable searching
//         "ordering": false, // Disable ordering
//         "info": true, // Display info about table
//         "lengthMenu": [ // Add lengthMenu to allow user to select number of entries to display
//             [10, 25, 50, 75, -1], // Page length options
//             [10, 25, 50, 75, "All"] // Text for the options
//         ]
//     });
// });
// </script>
