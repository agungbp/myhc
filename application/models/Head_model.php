<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Head_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function graphposition() {
        $this->db->select('employee_position, COUNT(*) AS emp');
        $this->db->from('employee');
        $this->db->where('branch_code', $this->session->userdata('login_branch'));
        $this->db->group_by('employee_position');
        $data = $this->db->get();
    
        return $data->result();
    }

    function graphstatus() {
        $this->db->select('employee_status, COUNT(*) AS emp');
        $this->db->from('employee');
        $this->db->where('branch_code', $this->session->userdata('login_branch'));
        $this->db->where('employee_status !=', 'Resign');
        $this->db->group_by('employee_status');
        $data = $this->db->get();

    return $data->result();
    }

    function graphsection() {
        $this->db->select('section_name, COUNT(*) AS emp');
        $this->db->from('employee');
        $this->db->join('section', 'employee.section_code = section.section_code');
        $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
        $this->db->group_by('employee.section_code');
        $data = $this->db->get();

    return $data->result();
    }

    function graphunit() {
        $this->db->select('section_name, COUNT(*) AS emp');
        $this->db->from('employee');
        $this->db->join('section', 'employee.section_code = section.section_code');
        $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
        $this->db->group_by('employee.section_code');
        $data = $this->db->get();

    return $data->result();
    }
    
    function graphvacancy() {
        $this->db->select('vacancy_position, COUNT(application_id) AS emp');
        $this->db->from('vacancy');
        $this->db->join('application', 'vacancy.vacancy_id = application.vacancy_id');
        $this->db->where('vacancy_lastdate >', date('Y-m-d'));
        $this->db->where('branch_code', $this->session->userdata('login_branch'));
        $this->db->group_by('vacancy_position');
        $data = $this->db->get();

        return $data->result();
    }
    
    function graphlevel() {
        $this->db->select('employee_level, COUNT(*) AS emp');
        $this->db->from('employee');
        $this->db->where('branch_code', $this->session->userdata('login_branch'));
        $this->db->group_by('employee_level');
        $data = $this->db->get();

		return $data->result();
	}


    // -------------- MARQUEE --------------- //

    function marquee_add() {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['user_type']            = $this->input->post('user_type');
        $data['marquee_announcement'] = $this->input->post('marquee_announcement');
        $data['marquee_status']       = 'Active';
        $data['marquee_date']         = date('Y-m-d');
        $data['createby']             = $this->session->userdata('login_nik');
        $data['regional_code']        = $user->regional_code;
        $data['branch_code']          = $user->branch_code;
        $data['origin_code']          = $user->origin_code;
        $data['zone_code']            = $user->zone_code;

        $this->db->insert('marquee', $data);

        return true;
    }
    function marquee_edit($marquee_id = '') {
        $data['user_type']            = $this->input->post('user_type');
        $data['marquee_announcement'] = $this->input->post('marquee_announcement');
        $data['marquee_status']       = $this->input->post('marquee_status');

        $this->db->where('marquee_id', $marquee_id);
        $this->db->update('marquee', $data);

        return true;
    }
    function marquee_delete($marquee_id = '') {
        $this->db->where('marquee_id', $marquee_id);
        $this->db->delete('marquee');

        return true;
    }

    // ------- SURVEY ------- //

    function survey_approved($survey_id = '') {
      $data['survey_status'] = 'Approved';
      $data['survey_note']   = null;
      $data['approveby']     = $this->session->userdata('login_nik');

      $this->db->where('survey_id', $survey_id);
      $this->db->update('survey', $data);

      return true;
  }

  function survey_declined($survey_id = '') {
      $data['survey_status'] = 'Declined';
      $data['survey_note']   = $this->input->post('survey_note');
      $data['approveby']     = $this->session->userdata('login_nik');

      $this->db->where('survey_id', $survey_id);
      $this->db->update('survey', $data);

      return true;
  }

}