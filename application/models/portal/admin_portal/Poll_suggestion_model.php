<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Poll_suggestion_model extends MY_Model
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

    function check_active_poll()
    {
        $this->db->where('status', 0);
        $query = $this->db->get('poll_question');
        return $query;
    }

    function add_new_poll($poll_title)
    {
        $insert = $this->db->insert('poll_question', $poll_title);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        }
    }

    function insert_poll_choices($insert_data)
    {
        return $this->db->insert('poll_choices', $insert_data);
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

    function end_poll($poll_id)
    {
        $this->db->where('poll_id', $poll_id);
        $update = $this->db->update('poll_question', array('status' => 1));
        return $update?TRUE:FALSE;
    }

    function get_suggestion_count()
    {
        return $this->db->count_all('suggestion');
    }

    function getSuggestion($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('suggestion');
        return $query;
    }

}