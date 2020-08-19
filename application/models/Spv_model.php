<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spv_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function graphposition() {
        $this->db->select('employee_position, COUNT(*) AS emp');
        $this->db->from('employee');
        $this->db->join('section', 'employee.section_code = section.section_code');
        $this->db->where('employee.section_code', $this->session->userdata('login_section'));
        $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
        $this->db->group_by('employee_position');
        $data = $this->db->get();
        
		return $data->result();
    }

    function graphstatus() {
		$this->db->select('employee_status, COUNT(*) AS emp');
        $this->db->from('employee');
        $this->db->join('section', 'employee.section_code = section.section_code');
        $this->db->where('employee.section_code', $this->session->userdata('login_section'));
        $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
        $this->db->where('employee_status !=', 'Resign');
        $this->db->group_by('employee_status');
        $data = $this->db->get();

		return $data->result();
    }

    function graphunit() {
        $this->db->select('unit_name, COUNT(*) AS emp');
        $this->db->from('employee');
        $this->db->join('section', 'employee.section_code = section.section_code');
        $this->db->join('unit', 'employee.unit_code = unit.unit_code');
        $this->db->where('employee.section_code', $this->session->userdata('login_section'));
        $this->db->where('employee.branch_code', $this->session->userdata('login_branch'));
        $this->db->group_by('employee.unit_code');
        $data = $this->db->get();
        
		return $data->result();
    }

    // ------- EMPLOYEE ------- //

    function employee_edit($nik = '') {
        $data['nik']                  = $nik;
        $data['employee_area']        = $this->input->post('employee_area');
        $data['employee_zona']        = $this->input->post('employee_zona');
        $data['update_id']            = substr(md5(microtime()),rand(0,26),6);

        $this->db->insert('employee_shifttmp', $data);

        $data2['update_id']      = $data['update_id'];
        $data2['update_date']    = date('Y-m-d H:i:s');
        $data2['update_status']  = 'Waiting for Approval';
        $data2['update_type']    = 'Shift';
        $data2['update_process'] = 'Update';
        $data2['nik']            = $nik;

        $this->db->insert('employee_update', $data2);

        return true;
    }

    function application_approve($nik = '') {
        $data['application_status'] = 'SPV Approved';
        $data['approveby']          = $this->session->userdata('login_nik');

        $this->db->where('nik', $nik);
        $this->db->update('application', $data);

        return true;
    }

    function application_decline($nik = '') {
        $data['application_status'] = 'SPV Declined';
        $data['approveby']          = $this->session->userdata('login_nik');

        $this->db->where('nik', $nik);
        $this->db->update('application', $data);

        return true;
    }
    function application_hireapprove($nik = '') {
        $data['application_status'] = 'Hired';
        $data['approveby']          = $this->session->userdata('login_nik');

        $this->db->where('nik', $nik);
        $this->db->update('application', $data);

        return true;
    }

    function application_hiredecline($nik = '') {
        $data['application_status'] = 'Hire Declined';
        $data['approveby']          = $this->session->userdata('login_nik');

        $this->db->where('nik', $nik);
        $this->db->update('application', $data);

        return true;
    }


    // ------- LOAN ------- //

    function loan_approved($loan_id = '') {
        $data['loan_status'] = 'SPV Approved';
        $data['loan_note']   = null;
        $data['approveby']   = $this->session->userdata('login_nik');

        $this->db->where('loan_id', $loan_id);
        $this->db->update('loan', $data);

        return true;
    }

    function loan_declined($loan_id = '') {
        $data['loan_status'] = 'SPV Declined';
        $data['loan_note']   = $this->input->post('loan_note');
        $data['approveby']   = $this->session->userdata('login_nik');

        $this->db->where('loan_id', $loan_id);
        $this->db->update('loan', $data);

        return true;
    }


    // ------- ELEARNING ------- //

    function elearning_approved($student_id = '') {
        $data['student_status'] = 'SPV Approved';
        $data['createby']       = $this->session->userdata('login_nik');

        $this->db->where('student_id', $student_id);
        $this->db->update('elearning_student', $data);

        return true;
    }

    function elearning_declined($student_id = '') {
        $data['elearning_status'] = 'SPV Declined';
        $data['createby']         = $this->session->userdata('login_nik');

        $this->db->where('student_id', $student_id);
        $this->db->update('elearning_student', $data);

        return true;
    }


    // ------- RESIGN ------- //

    function resign_approved($resign_id = '') {
        $data['resign_status'] = 'SPV Approved';
        $data['resign_note']   = null;
        $data['approveby']     = $this->session->userdata('login_nik');

        $this->db->where('resign_id', $resign_id);
        $this->db->update('resign', $data);

        return true;
    }

    function resign_declined($resign_id = '') {
        $data['resign_status'] = 'SPV Declined';
        $data['resign_note']   = $this->input->post('resign_note');
        $data['approveby']     = $this->session->userdata('login_nik');

        $this->db->where('resign_id', $resign_id);
        $this->db->update('resign', $data);

        return true;
    }


    // ------- QUESTION PACK ------- //

    function questionpack_approved($questionpack_id = '') {
        $data['questionpack_status'] = 'Approved';
        $data['questionpack_note']   = null;
        $data['approveby']           = $this->session->userdata('login_nik');

        $this->db->where('questionpack_id', $questionpack_id);
        $this->db->update('cbt_questionpack', $data);

        return true;
    }

    function questionpack_declined($questionpack_id = '') {
        $data['questionpack_status'] = 'Declined';
        $data['questionpack_note']   = $this->input->post('questionpack_note');
        $data['approveby']           = $this->session->userdata('login_nik');

        $this->db->where('questionpack_id', $questionpack_id);
        $this->db->update('cbt_questionpack', $data);

        return true;
    }

}

?>