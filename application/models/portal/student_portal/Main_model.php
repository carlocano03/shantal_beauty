<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2022,
 *
 */
class Main_model extends MY_Model
{
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getAvailableSched()
    {
        $this->db->where('status', 0);
        $query = $this->db->get('church_schedule');
        return $query;
    }

    function check_schedule($month, $member_id)
    {
        $start_dt = date('Y-m-01', strtotime($month));
        $end_date_obj = date('Y-m-t', strtotime($month));

        $this->db->where('member_id', $member_id);
        $this->db->where('DATE(date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(date_from) <=', $end_date_obj);
        $query = $this->db->get('scholar_schedule');
        return $query;
    }

    function check_existing_schedule($start_dt, $end_date_obj)
    {
        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('DATE(date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(date_from) <=', $end_date_obj);
        $query = $this->db->get('scholar_schedule');
        return $query;
    }

    function insert_scholar_schedule($insert_sched)
    {
        $insert = $this->db->insert('scholar_schedule', $insert_sched);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        } 
    }

    function insert_scholar_selected_schedule($scholar_sched_id, $member_id, $start_dt, $end_date_obj, $time_in, $time_out, $day_week, $sched_id)
    {
        $day_week_num = $this->getDayOfWeekNumber($day_week);

        if ($day_week_num !== false) {
            // Get all dates of the specified day of the week between the start and end date
            $dates = $this->getDatesInRange($start_dt, $end_date_obj, $day_week_num);

            // Insert data for each date
            foreach ($dates as $date) {
                $this->saveSchedule($scholar_sched_id, $member_id, $date, $time_in, $time_out, $day_week, $sched_id);
            }
        }
    }

    function saveSchedule($scholar_sched_id, $member_id, $date, $time_in, $time_out, $day_week, $sched_id) {
        $data = [
            'scholar_sched_id'  => $scholar_sched_id,
            'member_id'         => $member_id,
            'sched_id'          => $sched_id,
            'schedule_date'     => $date,
            'time_from'         => $time_in,
            'time_to'           => $time_out,
            'day_name'          => $day_week,
            'date_created'      => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('scholar_selected_schedule', $data);
    }

    private function getDayOfWeekNumber($day_week) {
        $days = [
            'Monday' => 1,
            'Tuesday' => 2,
            'Wednesday' => 3,
            'Thursday' => 4,
            'Friday' => 5,
            'Saturday' => 6,
            'Sunday' => 7
        ];
        return isset($days[$day_week]) ? $days[$day_week] : false;
    }

    private function getDatesInRange($start_dt, $end_date_obj, $day_week_num) {
        $dates = [];
        $start_date = strtotime($start_dt);
        $end_date = strtotime($end_date_obj);

        while ($start_date <= $end_date) {
            if (date('N', $start_date) == $day_week_num) {
                $dates[] = date('Y-m-d', $start_date);
            }
            $start_date = strtotime('+1 day', $start_date);
        }
        return $dates;
    }
    
    function check_selected_sched($sched_id, $month)
    {
        $start_dt = date('Y-m-01', strtotime($month));
        $end_date_obj = date('Y-m-t', strtotime($month));

        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('sched_id', $sched_id);
        $this->db->where('DATE(date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(date_from) <=', $end_date_obj);
        $query = $this->db->get('scholar_schedule');
        return $query;
    }

    function get_student_schedule_list()
    {
        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $query = $this->db->get('scholar_selected_schedule');
        return $query;
    }

    function get_attendance_record($schedule_date)
    {
        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('attendance_date', $schedule_date);
        $query = $this->db->get('attendance_record');
        return $query;
    }

    function get_attendance($schedule_date, $remarks)
    {
        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('attendance_date', $schedule_date);
        $this->db->where('remarks', $remarks);

        if ($remarks == 'Time-In') {
            $this->db->order_by('attendance_id', 'ASC');
        } else {
            $this->db->order_by('attendance_id', 'DESC');
        }
        
        $query = $this->db->get('attendance_record');
        return $query->row_array();
    }

    //With Pagination
    function get_student_schedule_record($limit, $start)
    {
        $member_id = $this->session->userdata('scholarIn')['member_id'];

        // Subquery to get the first time-in
        $subquery_in = $this->db->select('attendance_date, MIN(time_transaction) as time_in')
                                ->from('attendance_record')
                                ->where('remarks', 'Time-In')
                                ->where('member_id', $member_id)
                                ->group_by('attendance_date')
                                ->get_compiled_select();

        // Subquery to get the last time-out
        $subquery_out = $this->db->select('attendance_date, MIN(time_transaction) as time_out')
                                 ->from('attendance_record')
                                 ->where('remarks', 'Time-Out')
                                 ->where('member_id', $member_id)
                                 ->group_by('attendance_date')
                                 ->get_compiled_select();

        $this->db->select('s.schedule_date, s.time_from, s.time_to, a.time_in, a2.time_out');
        $this->db->from('scholar_selected_schedule s');
        $this->db->join("($subquery_in) a", 's.schedule_date = a.attendance_date', 'left');
        $this->db->join("($subquery_out) a2", 's.schedule_date = a2.attendance_date', 'left');
        $this->db->where('s.member_id', $member_id);
        $this->db->where('s.schedule_date <', date('Y-m-d')); // Exclude the present date
        $this->db->limit($limit, $start);
        $this->db->order_by('s.schedule_date', 'DESC');
        
        $query = $this->db->get();
        return $query;
    }

    function get_attendance_count()
    {
        $member_id = $this->session->userdata('scholarIn')['member_id'];

        // Subquery to get the first time-in
        $subquery_in = $this->db->select('attendance_date, MIN(time_transaction) as time_in')
                                ->from('attendance_record')
                                ->where('remarks', 'Time-In')
                                ->where('member_id', $member_id)
                                ->group_by('attendance_date')
                                ->get_compiled_select();

        // Subquery to get the last time-out
        $subquery_out = $this->db->select('attendance_date, MAX(time_transaction) as time_out')
                                 ->from('attendance_record')
                                 ->where('remarks', 'Time-Out')
                                 ->where('member_id', $member_id)
                                 ->group_by('attendance_date')
                                 ->get_compiled_select();

        $this->db->select('s.schedule_date, s.time_from, a.time_in, a2.time_out');
        $this->db->from('scholar_selected_schedule s');
        $this->db->join("($subquery_in) a", 's.schedule_date = a.attendance_date', 'left');
        $this->db->join("($subquery_out) a2", 's.schedule_date = a2.attendance_date', 'left');
        $this->db->where('s.member_id', $member_id);
        $this->db->where('s.schedule_date <', date('Y-m-d')); // Exclude the present date
        
        return $this->db->count_all_results();
    }

    function getActiveRules()
    {
        $this->db->where('status', 0);
        $this->db->limit(1);
        $query = $this->db->get('late_rules');
        return $query;
    }

    function get_attendance_last_90_days($member_id, $no_days) {
        $this->db->select('schedule_date, time_from, time_to');
        $this->db->from('scholar_selected_schedule');
        $this->db->where('member_id', $member_id);
        $this->db->where('schedule_date >=', date('Y-m-d', strtotime('-'.$no_days.' days')));
        $this->db->order_by('schedule_date', 'ASC');
        $query = $this->db->get();
        
        return $query->result_array();
    }

    function get_attendance_record_data($member_id, $date) {
        $this->db->select('time_transaction');
        $this->db->from('attendance_record');
        $this->db->where('member_id', $member_id);
        $this->db->where('attendance_date', $date);
        $this->db->where('remarks', 'Time-In');
        $this->db->order_by('attendance_id', 'ASC');
        $query = $this->db->get();
        
        return $query->result_array();
    }

    function get_uploaded_letter($member_id, $date) {
        $this->db->select('excuse_id');
        $this->db->from('excuse_letter');
        $this->db->where('member_id', $member_id);
        $this->db->where('attendance_date', $date);
        $query = $this->db->get();
        
        return $query->num_rows() > 0;
    }

    function check_old_pass($old_pass) 
    {
        $this->db->where('user_id', $this->session->userdata('scholarIn')['user_id']);
        $res = $this->db->get('user_acct')->row_array();
        if (!$res) {
            return false;
        } else {
            $hash = $res['password'];
            if ($this->verify_password_hash($old_pass, $hash)) {
                return $res;
            } else {
                return false;
            }
        }
    }

    private function verify_password_hash($old_pass, $hash)
    {
        return password_verify($old_pass, $hash);
    }

    function update_password($update_password)
    {
        $this->db->where('user_id', $this->session->userdata('scholarIn')['user_id']);
        $update = $this->db->update('user_acct', $update_password);
        return $update?TRUE:FALSE;
    }

    function get_time_in($member_id)
    {
        // $start_dt = date('Y-m-01');
        // $end_date_obj = date('Y-m-t');

        // $this->db->select('CS.time_in');
        // $this->db->from('scholar_schedule SS');
        // $this->db->join('church_schedule CS', 'SS.sched_id = CS.sched_id', 'left');
        // // $this->db->where('DATE(SS.date_from) >=', $start_dt);  // Adjust the year as needed
        // // $this->db->where('DATE(SS.date_from) <=', $end_date_obj);
        // $this->db->where('member_id', $member_id);
        // $query = $this->db->get();
        // return $query->row();

        $this->db->where('member_id', $member_id);
        $query = $this->db->get('scholar_selected_schedule');
        return $query->result_array();
    }

    function get_attendance_data($schedule_date, $remarks, $no_days)
    {
        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('attendance_date >=', 'DATE_SUB(CURDATE(), INTERVAL ' . $this->db->escape($no_days) . ' DAY)', FALSE);
        $this->db->where('attendance_date', $schedule_date);
        $this->db->where('remarks', $remarks);
        $this->db->where('is_handled', 0);
        $this->db->order_by('attendance_id', 'ASC');
        $query = $this->db->get('attendance_record');
        return $query->row_array();
    }

    function get_total_late_count($member_id, $expected_time_in, $days_interval)
    {
        // $query = $this->db->query("
        //     SELECT COUNT(*) as late_count 
        //     FROM attendance_record 
        //     WHERE member_id = ? 
        //     AND remarks = 'Time-In' 
        //     AND time_transaction > ? 
        //     AND attendance_date >= DATE_SUB(CURDATE(), INTERVAL ? DAY)
        //     AND is_handled = 0
        // ", array($member_id, $expected_time_in, $days_interval));
        // return $query->row();
        $subquery = "
            SELECT MIN(time_transaction) AS earliest_time
            FROM attendance_record 
            WHERE member_id = ? 
            AND remarks = 'Time-In' 
            AND attendance_date >= DATE_SUB(CURDATE(), INTERVAL ? DAY)
            AND is_handled = 0
            GROUP BY attendance_date
        ";

        // Main query to count the number of late occurrences based on the earliest Time-In
        $query = $this->db->query("
            SELECT COUNT(*) as late_count
            FROM (
                $subquery
            ) AS earliest_times
            WHERE earliest_time > ?
        ", array($member_id, $days_interval, $expected_time_in));

        return $query->row();
    }

    function upload_letter_late($upload_letter)
    {
        $insert = $this->db->insert('uploaded_consecutive_late', $upload_letter);
        return $insert?TRUE:FALSE;
    }

    function getPollRequest()
    {
        $this->db->select('PQ.poll_question, PQ.poll_id, PQ.user_id, GROUP_CONCAT(PC.poll_choices_id, ":", PC.poll_choices SEPARATOR "|") as pollChoices');
        $this->db->from('poll_choices PC');
        $this->db->join('poll_question PQ', 'PC.poll_id = PQ.poll_id', 'left');
        $this->db->where('PQ.status', 0);
        $this->db->order_by('PC.poll_choices', 'ASC');
        $this->db->limit(1);
        $this->db->group_by('PQ.poll_question');
        $query = $this->db->get();
        return $query;
    }

    function get_poll_answer($poll_choices_id)
    {
        $this->db->where('poll_choices_id', $poll_choices_id);
        $query = $this->db->get('poll_answer');
        return $query;
    }

    function check_submitted_user($poll_id)
    {
        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('poll_id', $poll_id);
        $query = $this->db->get('poll_answer');
        return $query;
    }

    function submit_answer($insert_answer)
    {
        $insert = $this->db->insert('poll_answer', $insert_answer);
        return $insert?TRUE:FALSE;
    }

    function check_active_poll()
    {
        $this->db->where('status', 0);
        $query = $this->db->get('poll_question');
        return $query->num_rows();
    }

    function add_new_suggestion($insert_suggestion)
    {
        $insert = $this->db->insert('suggestion', $insert_suggestion);
        return $insert?TRUE:FALSE;
    }
}