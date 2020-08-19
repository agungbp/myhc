<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Superuser_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    // function graph() {
	// 	$data = $this->db->query("SELECT COUNT(*) as loginlog, MONTHNAME(log_time) as loginmonth FROM login_log WHERE YEAR(log_time) = YEAR(CURDATE()) GROUP BY MONTH(log_time)");
	// 	return $data->result();
    // }

    function graph() {
        $this->db->select('log_time, COUNT(*) AS total');
        $this->db->from('login_log');
        $this->db->where("DATE_FORMAT(log_time,'%Y-%m')", date('Y-m'));
        $this->db->group_by('CAST(log_time AS DATE)');
        $data = $this->db->get();

		return $data->result();
    }

    // ------- USER ------- //

    function user_add() {
        $data['nik']              = $this->input->post('nik');
        $data['user_type']        = $this->input->post('user_type');
        $data['user_application'] = 'MYHC';
        $data['user_status']      = 'Y';
        $data['user_createdate']  = date('Y-m-d H:i:s');
        
        $pass = $this->db->get_where('user', array('nik' => $data['nik'], 'user_application' => 'MYHC', 'user_type' => 'EMPLOYEE'))->row()->user_password;
        
        $data['user_password']    = $pass;

        $duplicate = $this->db->get_where('user', array('nik' => $data['nik'], 'user_application' => 'MYHC', 'user_type' => $data['user_type']))->num_rows();

        if($duplicate == 0){
            $this->db->insert('user', $data);

            return true;
        } else {
            return false;
        }
    }

    function user_edit($param2) {
        $data['nik']            = $this->input->post('nik');
        $data['user_type']      = $this->input->post('user_type');
        $data['user_status']    = $this->input->post('user_status');

        $this->db->where('user_id', $param2);
        $this->db->update('user', $data);

        return true;
    }

    function user_delete($param2) {
        $this->db->where('user_id', $param2);
        $this->db->delete('user');

        return true;
    }

    function reset_password($param2) {
        $data['user_password'] = md5('123456');

        $this->db->where('nik', $param2);
        $this->db->update('user', $data);

        return true;
    }


    // -------------- MARQUEE --------------- //

    function marquee_add() {
        $data['user_type']            = $this->input->post('user_type');
        $data['marquee_announcement'] = $this->input->post('marquee_announcement');
        $data['marquee_status']       = 'Active';
        $data['marquee_date']         = date('Y-m-d');
        $data['createby']             = $this->session->userdata('login_nik');

        $this->db->insert('marquee', $data);

        return true;
    }
    function marquee_edit($param2) {
        $data['user_type']            = $this->input->post('user_type');
        $data['marquee_announcement'] = $this->input->post('marquee_announcement');
        $data['marquee_status']       = $this->input->post('marquee_status');

        $this->db->where('marquee_id', $param2);
        $this->db->update('marquee', $data);

        return true;
    }
    function marquee_delete($param2) {
        $this->db->where('marquee_id', $param2);
        $this->db->delete('marquee');

        return true;
    }

}