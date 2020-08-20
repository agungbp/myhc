<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Humancapital_model extends CI_Model {
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
    
    function graphuniform() {
        $this->db->from('uniform_stock');
        $this->db->where('branch_code', $this->session->userdata('login_branch'));
        $data = $this->db->get();

		return $data->result();
	}


    // ------- EMPLOYEE ------- //

    function employee_add() {
        $data['nik']                          = $this->input->post('nik');
        $data['employee_npwp']                = $this->input->post('employee_npwp');
        $data['employee_ktp']                 = $this->input->post('employee_ktp');
        $data['employee_ktpexpire']           = $this->input->post('employee_ktpexpire');
        $data['employee_name']                = $this->input->post('employee_name');
        $data['employee_bpjskesehatan']       = $this->input->post('employee_bpjskesehatan');
        $data['employee_bpjsketenagakerjaan'] = $this->input->post('employee_bpjsketenagakerjaan');
        $data['employee_birthplace']          = $this->input->post('employee_birthplace');
        $data['employee_birthdate']           = $this->input->post('employee_birthdate');
        $data['employee_gender']              = $this->input->post('employee_gender');
        $data['employee_marital']             = $this->input->post('employee_marital');
        $data['employee_religion']            = $this->input->post('employee_religion');
        $data['employee_phone']               = $this->input->post('employee_phone');
        $data['employee_phone2']              = $this->input->post('employee_phone2');
        $data['employee_address']             = $this->input->post('employee_address');
        $data['employee_city']                = $this->input->post('employee_city');
        $data['employee_banknumber']          = $this->input->post('employee_banknumber');
        $data['employee_education']           = $this->input->post('employee_education');
        $data['employee_university']          = $this->input->post('employee_university');
        $data['employee_major']               = $this->input->post('employee_major');
        $data['employee_join']                = $this->input->post('employee_join');
        $data['employee_position']            = $this->input->post('employee_position');
        $data['employee_status']              = $this->input->post('employee_status');
        $data['employee_level']               = $this->input->post('employee_level');
        $data['employee_type']                = $this->input->post('employee_type');
        $data['employee_area']                = $this->input->post('employee_area');
        $data['employee_zona']                = $this->input->post('employee_zona');
        $data['section_code']                 = $this->input->post('section_code');
        $data['unit_code']                    = $this->input->post('unit_code');
        $data['regional_code']                = $this->input->post('regional_code');
        $data['branch_code']                  = $this->input->post('branch_code');
        $data['origin_code']                  = $this->input->post('origin_code');
        $data['zone_code']                    = $this->input->post('zone_code');
        $data['orion_id']                     = $this->input->post('orion_id');
        $data['courier_id']                   = $this->input->post('courier_id');
        $data['createby']                     = $this->session->userdata('login_nik');
        $data['createdate']                   = date('Y-m-d H:i:s');

        $data2['nik']               = $this->input->post('nik');
        $data2['user_password']     = md5('123456');
        $data2['user_application']  = 'MYHC';
        $data2['user_status']       = 'Y';
        $data2['user_type']         = 'EMPLOYEE';
        $data2['user_createdate']   = date('Y-m-d H:i:s');

        $data3['nik']             = $this->input->post('nik');

        $duplicate = $this->db->get_where('employee', array('nik' => $this->input->post('nik')))->num_rows();

        if($duplicate == 0){
            $this->db->insert('employee', $data);

            if($_FILES['userfile']['name'] != '')
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/employee_image/' . $this->input->post('nik') . '.jpg');

            $this->db->insert('user', $data2);

            $duplicate2 = $this->db->get_where('file', array('nik' => $this->input->post('nik')))->num_rows();
            if($duplicate2 == 0){
                $this->db->insert('file', $data3);
            }

            return true;
        } else {
            return false;
        }
    }
    
    function employee_edit($nik = '') {
        $data['nik']                          = $this->input->post('nik');
        $data['employee_npwp']                = $this->input->post('employee_npwp');
        $data['employee_ktp']                 = $this->input->post('employee_ktp');
        $data['employee_ktpexpire']           = $this->input->post('employee_ktpexpire');
        $data['employee_name']                = $this->input->post('employee_name');
        $data['employee_bpjskesehatan']       = $this->input->post('employee_bpjskesehatan');
        $data['employee_bpjsketenagakerjaan'] = $this->input->post('employee_bpjsketenagakerjaan');
        $data['employee_birthplace']          = $this->input->post('employee_birthplace');
        $data['employee_birthdate']           = $this->input->post('employee_birthdate');
        $data['employee_gender']              = $this->input->post('employee_gender');
        $data['employee_marital']             = $this->input->post('employee_marital');
        $data['employee_religion']            = $this->input->post('employee_religion');
        $data['employee_phone']               = $this->input->post('employee_phone');
        $data['employee_phone2']              = $this->input->post('employee_phone2');
        $data['employee_address']             = $this->input->post('employee_address');
        $data['employee_city']                = $this->input->post('employee_city');
        $data['employee_banknumber']          = $this->input->post('employee_banknumber');
        $data['employee_education']           = $this->input->post('employee_education');
        $data['employee_university']          = $this->input->post('employee_university');
        $data['employee_major']               = $this->input->post('employee_major');
        $data['employee_join']                = $this->input->post('employee_join');
        $data['employee_position']            = $this->input->post('employee_position');
        $data['employee_status']              = $this->input->post('employee_status');
        $data['employee_level']               = $this->input->post('employee_level');
        $data['employee_type']                = $this->input->post('employee_type');
        $data['employee_area']                = $this->input->post('employee_area');
        $data['employee_zona']                = $this->input->post('employee_zona');
        $data['section_code']                 = $this->input->post('section_code');
        $data['unit_code']                    = $this->input->post('unit_code');
        $data['regional_code']                = $this->input->post('regional_code');
        $data['branch_code']                  = $this->input->post('branch_code');
        $data['origin_code']                  = $this->input->post('origin_code');
        $data['zone_code']                    = $this->input->post('zone_code');
        $data['orion_id']                     = $this->input->post('orion_id');
        $data['courier_id']                   = $this->input->post('courier_id');

        $this->db->where('nik', $nik);
        $this->db->update('employee', $data);
        
        if($_FILES['userfile']['name'] != '')
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/employee_image/' . $nik . '.jpg');

        $data2['nik']       = $this->input->post('nik');
        $data2['nik']       = $this->input->post('nik');
        $this->db->where('nik', $nik);
        $this->db->update('user', $data2);

        $data3['nik']       = $this->input->post('nik');
        $this->db->where('nik', $nik);
        $this->db->update('family', $data3);

        $data4['nik']       = $this->input->post('nik');
        $this->db->where('nik', $nik);
        $this->db->update('file', $data4);

        return true;
    }

    function employee_delete($nik = '') {
        $this->db->where('nik', $nik);
        $this->db->delete('employee');

        $this->db->where('nik', $nik);
        $this->db->delete('user');
        
        $this->db->where('nik', $nik);
        $this->db->delete('file');

        return true;
    }

    function employee_update_approve($param2, $param3) {
        $data['nik']                          = $this->input->post('nik');
        $data['employee_npwp']                = $this->input->post('employee_npwp');
        $data['employee_ktp']                 = $this->input->post('employee_ktp');
        $data['employee_ktpexpire']           = $this->input->post('employee_ktpexpire');
        $data['employee_name']                = $this->input->post('employee_name');
        $data['employee_bpjskesehatan']       = $this->input->post('employee_bpjskesehatan');
        $data['employee_bpjsketenagakerjaan'] = $this->input->post('employee_bpjsketenagakerjaan');
        $data['employee_birthplace']          = $this->input->post('employee_birthplace');
        $data['employee_birthdate']           = $this->input->post('employee_birthdate');
        $data['employee_gender']              = $this->input->post('employee_gender');
        $data['employee_marital']             = $this->input->post('employee_marital');
        $data['employee_religion']            = $this->input->post('employee_religion');
        $data['employee_phone']               = $this->input->post('employee_phone');
        $data['employee_phone2']              = $this->input->post('employee_phone2');
        $data['employee_address']             = $this->input->post('employee_address');
        $data['employee_city']                = $this->input->post('employee_city');
        $data['employee_banknumber']          = $this->input->post('employee_banknumber');
        $data['employee_education']           = $this->input->post('employee_education');
        $data['employee_university']          = $this->input->post('employee_university');
        $data['employee_major']               = $this->input->post('employee_major');
        // $data['employee_join']                = $this->input->post('employee_join');
        $data['employee_position']            = $this->input->post('employee_position');
        $data['employee_status']              = $this->input->post('employee_status');
        $data['employee_level']               = $this->input->post('employee_level');
        $data['employee_type']                = $this->input->post('employee_type');
        $data['employee_area']                = $this->input->post('employee_area');
        $data['employee_zona']                = $this->input->post('employee_zona');
        $data['section_code']                 = $this->input->post('section_code');
        $data['unit_code']                    = $this->input->post('unit_code');
        $data['regional_code']                = $this->input->post('regional_code');
        $data['branch_code']                  = $this->input->post('branch_code');
        $data['origin_code']                  = $this->input->post('origin_code');
        $data['zone_code']                    = $this->input->post('zone_code');
        $data['orion_id']                     = $this->input->post('orion_id');
        $data['courier_id']                   = $this->input->post('courier_id');

        $this->db->where('nik', $param3);
        $this->db->update('employee', $data);

        $data2['update_status']  =  'Approved';
        $data2['approveby']      = $this->session->userdata('login_nik');

        $this->db->where('update_id', $param2);
        $this->db->update('employee_update', $data2);

        return true;
    }

    function employee_shift_approve($param2, $param3) {
        $data['employee_area']                = $this->input->post('employee_area');
        $data['employee_zona']                = $this->input->post('employee_zona');

        $this->db->where('nik', $param3);
        $this->db->update('employee', $data);

        $data2['update_status']  =  'Approved';
        $data2['approveby']      = $this->session->userdata('login_nik');

        $this->db->where('update_id', $param2);
        $this->db->update('employee_update', $data2);

        return true;
    }

    function employee_update_decline($param2) {
        $data2['update_status']  =  'Declined';
        $data2['approveby']      = $this->session->userdata('login_nik');

        $this->db->where('update_id', $param2);
        $this->db->update('employee_update', $data2);

        return true;
    }


    function get_unit($section_code){
		$query = $this->db->get_where('unit', array('section_code' => $section_code));
		return $query;
    }

    function get_branch($regional_code){
		$query = $this->db->get_where('branch', array('regional_code' => $regional_code));
		return $query;
    }

    function get_origin($branch_code){
		$query = $this->db->get_where('origin', array('branch_code' => $branch_code));
		return $query;
    }

    function get_zone($origin_code){
		$query = $this->db->get_where('zone', array('origin_code' => $origin_code));
		return $query;
    }


    // ------- SPK ------- //

    function spk_add($param2) {
        $data['nik']               =   $param2;
        $data['spk_number']        =   $this->input->post('spk_number');
        $data['spk_startdate']     =   $this->input->post('spk_startdate');
        $data['spk_enddate']       =   $this->input->post('spk_enddate');
        $data['spk_position']      =   $this->input->post('spk_position');
        $data['spk_salary']        =   $this->input->post('spk_salary');
        $data['spk_salarytype']    =   $this->input->post('spk_salarytype');
        $data['spk_status']        =   $this->input->post('spk_status');
        $data['section_code']      =   $this->input->post('section_code');
        $data['unit_code']         =   $this->input->post('unit_code');
        $data['spk_createdate']    =   date('Y-m-d H:i:s');
        $data['createby']          =   $this->session->userdata('login_nik');
        
        $this->db->insert('spk', $data);

        $data2['section_code']        =   $this->input->post('section_code');
        $data2['unit_code']           =   $this->input->post('unit_code');
        $data2['employee_position']   =   $this->input->post('spk_position');
        $data2['employee_status']     =   $this->input->post('spk_status');
        $data2['employee_salary']     =   $this->input->post('spk_salary');
        $data2['employee_salarytype'] =   $this->input->post('spk_salarytype');

        $this->db->where('nik', $param2);
        $this->db->update('employee', $data2);

        return true;
    }
    function spk_edit($param2, $param3) {
        $data['spk_startdate']     =   $this->input->post('spk_startdate');
        $data['spk_enddate']       =   $this->input->post('spk_enddate');
        $data['spk_position']      =   $this->input->post('spk_position');
        $data['spk_salary']        =   $this->input->post('spk_salary');
        $data['spk_salarytype']    =   $this->input->post('spk_salarytype');
        $data['spk_status']        =   $this->input->post('spk_status');
        $data['section_code']      =   $this->input->post('section_code');
        $data['unit_code']         =   $this->input->post('unit_code');

        $this->db->where('spk_id', $param2);
        $this->db->update('spk', $data);

        $data2['section_code']        =   $this->input->post('section_code');
        $data2['unit_code']           =   $this->input->post('unit_code');
        $data2['employee_position']   =   $this->input->post('spk_position');
        $data2['employee_status']     =   $this->input->post('spk_status');

        $this->db->where('nik', $param3);
        $this->db->update('employee', $data2);

        return true;
    }
    function spk_delete($param2) {
        $this->db->where('spk_id', $param2);
        $this->db->delete('spk');

        return true;
    }


    // ------- ASSET ------- //

    function asset_add($param2) {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['nik']                 =   $param2;
        $data['asset_number']        =   $this->input->post('asset_number');
        $data['asset_serialnumber']  =   $this->input->post('asset_serialnumber');
        $data['asset_name']          =   $this->input->post('asset_name');
        $data['asset_merk']          =   $this->input->post('asset_merk');
        $data['asset_model']         =   $this->input->post('asset_model');
        $data['asset_spesification'] =   $this->input->post('asset_spesification');
        $data['asset_date']          =   $this->input->post('asset_date');
        $data['asset_status']        =   'Active';
        $data['createby']            =   $this->session->userdata('login_nik');
        $data['regional_code']       =   $user->regional_code;
        $data['branch_code']         =   $user->branch_code;
        $data['origin_code']         =   $user->origin_code;
        $data['zone_code']           =   $user->zone_code;
        
        $duplicate = $this->db->get_where('asset', array('asset_number' => $this->input->post('asset_number')))->num_rows();

        if($duplicate == 0){
            $this->db->insert('asset', $data);

            return true;
        } else {
            return false;
        }
    }
    function asset_edit($param2) {
        $data['asset_number']        =   $this->input->post('asset_number');
        $data['asset_serialnumber']  =   $this->input->post('asset_serialnumber');
        $data['asset_name']          =   $this->input->post('asset_name');
        $data['asset_merk']          =   $this->input->post('asset_merk');
        $data['asset_model']         =   $this->input->post('asset_model');
        $data['asset_spesification'] =   $this->input->post('asset_spesification');
        $data['asset_date']          =   $this->input->post('asset_date');
        $data['asset_status']        =   'Active';

        $this->db->where('asset_id', $param2);
        $this->db->update('asset', $data);

        return true;
    }
    function asset_delete($param2) {
        $this->db->where('asset_id', $param2);
        $this->db->delete('asset');

        return true;
    }
    function asset_create_approve($param2, $param3) {
        $data['nik']                 =   $param3;
        $data['asset_number']        =   $this->input->post('asset_number');
        $data['asset_serialnumber']  =   $this->input->post('asset_serialnumber');
        $data['asset_name']          =   $this->input->post('asset_name');
        $data['asset_merk']          =   $this->input->post('asset_merk');
        $data['asset_model']         =   $this->input->post('asset_model');
        $data['asset_spesification'] =   $this->input->post('asset_spesification');
        $data['asset_date']          =   $this->input->post('asset_date');
        $data['asset_status']        =   'Active';
        $data['regional_code']       =   $this->input->post('regional_code');
        $data['branch_code']         =   $this->input->post('branch_code');
        $data['origin_code']         =   $this->input->post('origin_code');
        $data['zone_code']           =   $this->input->post('zone_code');
        $data['createby']            =   $this->input->post('createby');

        $duplicate = $this->db->get_where('asset', array('asset_number' => $this->input->post('asset_number')))->num_rows();

        if($duplicate == 0){
            $this->db->insert('asset', $data);

            $data2['update_status']  =  'Approved';
            $data2['approveby']      = $this->session->userdata('login_nik');
    
            $this->db->where('update_id', $param2);
            $this->db->update('employee_update', $data2);
    
            return true;
        } else {
            return false;
        }
    }
    function asset_edit_approve($param2, $param3) {
        $data['asset_number']        =   $this->input->post('asset_number');
        $data['asset_serialnumber']  =   $this->input->post('asset_serialnumber');
        $data['asset_name']          =   $this->input->post('asset_name');
        $data['asset_merk']          =   $this->input->post('asset_merk');
        $data['asset_model']         =   $this->input->post('asset_model');
        $data['asset_spesification'] =   $this->input->post('asset_spesification');
        $data['asset_date']          =   $this->input->post('asset_date');
        $data['asset_status']        =   'Active';

        $this->db->where('asset_id', $param3);
        $this->db->update('asset', $data);

        $data2['update_status']  =  'Approved';
        $data2['approveby']      = $this->session->userdata('login_nik');

        $this->db->where('update_id', $param2);
        $this->db->update('employee_update', $data2);

        return true;
    }
    function asset_delete_approve($param2, $param3) {
        $this->db->where('asset_id', $param3);
        $this->db->delete('asset');

        $data2['update_status']  =  'Approved';
        $data2['approveby']      = $this->session->userdata('login_nik');

        $this->db->where('update_id', $param2);
        $this->db->update('employee_update', $data2);

        return true;
    }


    // ------------- TEGURAN -------------- //

    function teguran_add() {
        $data['nik']                 = $this->input->post('nik');
        $data['teguran_number']      = $this->input->post('teguran_number');
        $data['teguran_createdate']  = date('Y-m-d');
        $data['teguran_enddate']     = date('Y-m-d',  strtotime("+3 month"));
        $data['teguran_description'] = $this->input->post('teguran_description');
        $data['createby']            = $this->session->userdata('login_nik');

        $duplicate = $this->db->get_where('teguran', array('teguran_number' => $this->input->post('teguran_number')))->num_rows();

        if($duplicate == 0){
            $this->db->insert('teguran', $data);
            return true;
        } else {
            return false;
        }
    }
    function teguran_edit($param2) {
        $data['nik']                 = $this->input->post('nik');
        $data['teguran_number']      = $this->input->post('teguran_number');
        $data['teguran_description'] = $this->input->post('teguran_description');

        $this->db->where('teguran_id', $param2);
        $this->db->update('teguran', $data);

        return true;
    }
    function teguran_delete($param2) {
        $this->db->where('teguran_id', $param2);
        $this->db->delete('teguran');

        return true;
    }


    // ------- PANGGILAN ------- //

    function panggilan_add() {
        $data['nik']                   = $this->input->post('nik');
        $data['panggilan_number']      = $this->input->post('panggilan_number');
        $data['panggilan_place']       = $this->input->post('panggilan_place');
        $data['panggilan_date']        = $this->input->post('panggilan_date');
        $data['panggilan_time']        = $this->input->post('panggilan_time');
        $data['panggilan_meet']        = $this->input->post('panggilan_meet');
        $data['panggilan_description'] = $this->input->post('panggilan_description');
        $data['panggilan_createdate']  = date('Y-m-d');
        $data['createby']              = $this->session->userdata('login_nik');

        $duplicate = $this->db->get_where('panggilan', array('panggilan_number' => $this->input->post('panggilan_number')))->num_rows();

        if($duplicate == 0){
            $this->db->insert('panggilan', $data);
            return true;    
        } else {
            return false;
        }
    }
    function panggilan_edit($param2) {
        $data['nik']                   = $this->input->post('nik');
        $data['panggilan_place']       = $this->input->post('panggilan_place');
        $data['panggilan_date']        = $this->input->post('panggilan_date');
        $data['panggilan_time']        = $this->input->post('panggilan_time');
        $data['panggilan_meet']        = $this->input->post('panggilan_meet');
        $data['panggilan_description'] = $this->input->post('panggilan_description');

        $this->db->where('panggilan_id', $param2);
        $this->db->update('panggilan', $data);

        return true;
    }
    function panggilan_delete($param2) {
        $this->db->where('panggilan_id', $param2);
        $this->db->delete('panggilan');

        return true;
    }
    function panggilan_result($param2) {
        $data['panggilan_result']   = $this->input->post('panggilan_result');

        $this->db->where('panggilan_id', $param2);
        $this->db->update('panggilan', $data);

        return true;
    }


    // ------- PA ------- //

    function pa_add($param2) {
        $data['nik']          = $param2;
        $data['pa_year']      = $this->input->post('pa_year');
        $data['pa_assesment'] = $this->input->post('pa_assesment');
        $data['pa_date']      = date('Y-m-d');
        $data['createby']      = $this->session->userdata('login_nik');

        $this->db->insert('pa', $data);

        return true;
    }
    function pa_edit($param2) {
        $data['pa_year']      = $this->input->post('pa_year');
        $data['pa_assesment'] = $this->input->post('pa_assesment');

        $this->db->where('pa_id', $param2);
        $this->db->update('pa', $data);

        return true;
    }
    function pa_delete($param2) {
        $this->db->where('pa_id', $param2);
        $this->db->delete('pa');

        return true;
    }


    // ------- FAMILY ------- //

    function family_add($param2) {
        $data['nik']               =   $param2;
        $data['family_ktp']        =   $this->input->post('family_ktp');
        $data['family_bpjs']       =   $this->input->post('family_bpjs');
        $data['family_name']       =   $this->input->post('family_name');
        $data['family_status']     =   $this->input->post('family_status');

        $duplicate = $this->db->get_where('family', array('family_ktp' => $this->input->post('family_ktp')))->num_rows();

        if($duplicate == 0){
            $this->db->insert('family', $data);
    
            return true;
        } else {
            return false;
        }
    }
    function family_edit($param2) {
        $data['family_ktp']        =   $this->input->post('family_ktp');
        $data['family_bpjs']       =   $this->input->post('family_bpjs');
        $data['family_name']       =   $this->input->post('family_name');
        $data['family_status']     =   $this->input->post('family_status');

        $this->db->where('family_id', $param2);
        $this->db->update('family', $data);

        return true;
    }
    function family_delete($param2) {
        $this->db->where('family_id', $param2);
        $this->db->delete('family');

        return true;
    }
    function family_create_approve($param2, $param3) {
        $data['nik']               =   $param3;
        $data['family_ktp']        =   $this->input->post('family_ktp');
        $data['family_bpjs']       =   $this->input->post('family_bpjs');
        $data['family_name']       =   $this->input->post('family_name');
        $data['family_status']     =   $this->input->post('family_status');

        $this->db->insert('family', $data);

        $data2['update_status']  =  'Approved';
        $data2['approveby']      = $this->session->userdata('login_nik');

        $this->db->where('update_id', $param2);
        $this->db->update('employee_update', $data2);

        return true;
    }
    function family_edit_approve($param2, $param3) {
        $data['family_ktp']        =   $this->input->post('family_ktp');
        $data['family_bpjs']       =   $this->input->post('family_bpjs');
        $data['family_name']       =   $this->input->post('family_name');
        $data['family_status']     =   $this->input->post('family_status');

        $this->db->where('family_id', $param3);
        $this->db->update('family', $data);

        $data2['update_status']  =  'Approved';
        $data2['approveby']      = $this->session->userdata('login_nik');

        $this->db->where('update_id', $param2);
        $this->db->update('employee_update', $data2);

        return true;
    }
    function family_delete_approve($param2, $param3) {
        $this->db->where('family_id', $param3);
        $this->db->delete('family');

        $data2['update_status']  =  'Approved';
        $data2['approveby']      = $this->session->userdata('login_nik');

        $this->db->where('update_id', $param2);
        $this->db->update('employee_update', $data2);

        return true;
    }


    // ------- FILE ------- //

    function file_update_approve($param2, $param3) {
        $data['file_ktp']       = $this->input->post('file_ktp');
        $data['file_sim']       = $this->input->post('file_sim');
        $data['file_kk']        = $this->input->post('file_kk');
        $data['file_ijazah']    = $this->input->post('file_ijazah');
        $data['file_transkrip'] = $this->input->post('file_transkrip');
        $data['file_cv']        = $this->input->post('file_cv');
        $data['file_other']     = $this->input->post('file_other');

        $this->db->where('nik', $param3);
        $this->db->update('file', $data);

        $data2['update_status']  =  'Approved';
        $data2['approveby']      = $this->session->userdata('login_nik');

        $this->db->where('update_id', $param2);
        $this->db->update('employee_update', $data2);

        return true;
    }


    // -------------- SECTION --------------- //

    function section_add() {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();
        $data['section_code']   = $this->input->post('section_code');
        $data['section_name']   = $this->input->post('section_name');
        $data['section_head']   = $this->input->post('section_head');
        $data['createby']       = $this->session->userdata('login_nik');
        $data['regional_code']  = $user->regional_code;
        $data['branch_code']    = $user->branch_code;
        $data['origin_code']    = $user->origin_code;
        $data['zone_code']      = $user->zone_code;

        $duplicate = $this->db->get_where('section', array('section_code' => $this->input->post('section_code')))->num_rows();

        if($duplicate == 0){
            $this->db->insert('section', $data);
            return true;
        } else {
            return false;
        }
    }

    function section_edit($section_code = '') {
        $data['section_code'] = $this->input->post('section_code');
        $data['section_name'] = $this->input->post('section_name');
        $data['section_head'] = $this->input->post('section_head');

        $this->db->where('section_code', $section_code);
        $this->db->update('section', $data);

        return true;
    }

    function section_delete($section_code = '') {
        $this->db->where('section_code', $section_code);
        $this->db->delete('section');

        return true;
    }

    // -------------- UNIT --------------- //

    function unit_add() {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();
        $data['unit_code']      = $this->input->post('unit_code');
        $data['unit_name']      = $this->input->post('unit_name');
        $data['unit_head']      = $this->input->post('unit_head');
        $data['section_code']   = $this->input->post('section_code');
        $data['createby']       = $this->session->userdata('login_nik');
        $data['regional_code']  = $user->regional_code;
        $data['branch_code']    = $user->branch_code;
        $data['origin_code']    = $user->origin_code;
        $data['zone_code']      = $user->zone_code;

        $duplicate = $this->db->get_where('unit', array('unit_code' => $this->input->post('unit_code')))->num_rows();

        if($duplicate == 0){
            $this->db->insert('unit', $data);

            return true;
        } else {
            return false;
        }
    }
    function unit_edit($unit_code = '') {
        $data['unit_code']    = $this->input->post('unit_code');
        $data['unit_name']    = $this->input->post('unit_name');
        $data['unit_head']    = $this->input->post('unit_head');
        $data['section_code'] = $this->input->post('section_code');

        $this->db->where('unit_code', $unit_code);
        $this->db->update('unit', $data);

        return true;
    }
    function unit_delete($unit_code = '') {
        $this->db->where('unit_code', $unit_code);
        $this->db->delete('unit');

        return true;
    }


    // -------------- VACANCY --------------- //

    function vacancy_add() {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();
        $data['vacancy_id']           = substr(md5(microtime()),rand(0,26),6);
        $data['user_type']            = $this->input->post('user_type');
        $data['vacancy_position']     = $this->input->post('vacancy_position');
        $data['vacancy_level']        = $this->input->post('vacancy_level');
        $data['vacancy_section']      = $this->input->post('vacancy_section');
        $data['vacancy_unit']         = $this->input->post('vacancy_unit');
        $data['vacancy_publishdate']  = date('Y-m-d');
        $data['vacancy_lastdate']     = $this->input->post('vacancy_lastdate');
        $data['vacancy_placement']    = $this->input->post('vacancy_placement');
        $data['vacancy_requirements'] = $this->input->post('vacancy_requirement');
        $data['vacancy_jobdesc']      = $this->input->post('vacancy_jobdesc');
        $data['createby']             = $this->session->userdata('login_nik');
        $data['createdate']           = date('Y-m-d H:i:s');;
        $data['regional_code']        = $user->regional_code;
        $data['branch_code']          = $user->branch_code;
        $data['origin_code']          = $user->origin_code;
        $data['zone_code']            = $user->zone_code;

        $this->db->insert('vacancy', $data);

        return true;
    }
    function vacancy_edit($vacancy_id = '') {
        $data['user_type']            = $this->input->post('user_type');
        $data['vacancy_position']     = $this->input->post('vacancy_position');
        $data['vacancy_level']        = $this->input->post('vacancy_level');
        $data['vacancy_section']      = $this->input->post('vacancy_section');
        $data['vacancy_unit']         = $this->input->post('vacancy_unit');
        $data['vacancy_lastdate']     = $this->input->post('vacancy_lastdate');
        $data['vacancy_placement']    = $this->input->post('vacancy_placement');
        $data['vacancy_requirements'] = $this->input->post('vacancy_requirement');
        $data['vacancy_jobdesc']      = $this->input->post('vacancy_jobdesc');

        $this->db->where('vacancy_id', $vacancy_id);
        $this->db->update('vacancy', $data);

        return true;
    }
    function vacancy_delete($vacancy_id = '') {
        $this->db->where('vacancy_id', $vacancy_id);
        $this->db->delete('vacancy');

        return true;
    }


    // -------------- APPLICATION --------------- //

    function application_applied($nik = '') {
        $data['application_status'] = 'Applied';
        $data['approveby']          = $this->session->userdata('login_nik');

        $this->db->where('nik', $nik);
        $this->db->update('application', $data);

        return true;
    }

    function application_onreview($nik = '') {
        $data['application_status'] = 'On Review';
        $data['approveby']          = $this->session->userdata('login_nik');

        $this->db->where('nik', $nik);
        $this->db->update('application', $data);

        return true;
    }

    function application_psikotest($nik = '') {
        $data['application_status'] = 'Psikotest';
        $data['approveby']          = $this->session->userdata('login_nik');

        $this->db->where('nik', $nik);
        $this->db->update('application', $data);

        return true;
    }

    function application_interview($nik = '') {
        $data['application_status'] = 'Interview';
        $data['approveby']          = $this->session->userdata('login_nik');

        $this->db->where('nik', $nik);
        $this->db->update('application', $data);

        return true;
    }

    function application_hired($nik = '') {
        $data['application_status'] = 'Waiting for SPV Approval';
        $data['approveby']          = $this->session->userdata('login_nik');

        $this->db->where('nik', $nik);
        $this->db->update('application', $data);

        return true;
    }

    function application_declined($nik = '') {
        $data['application_status'] = 'Declined';
        $data['approveby']          = $this->session->userdata('login_nik');

        $this->db->where('nik', $nik);
        $this->db->update('application', $data);

        return true;
    }


    // -------------- SCHEDULE --------------- //

    function schedule_add() {
        $data['schedule_id']        = $this->input->post('vacancy_id') . '_' . $this->input->post('application_status') . '_' . $this->input->post('schedule_date');
        $data['schedule_date']      = $this->input->post('schedule_date');
        $data['schedule_time']      = $this->input->post('schedule_time');
        $data['schedule_place']     = $this->input->post('schedule_place');
        $data['schedule_note']      = $this->input->post('schedule_note');
        $data['vacancy_id']         = $this->input->post('vacancy_id');
        $data['application_status'] = $this->input->post('application_status');
        $data['createby']           = $this->session->userdata('login_nik');
        $data['createdate']         = date('Y-m-d H:i:s');

        $duplicate = $this->db->get_where('recruitment_schedule', array('schedule_id' => $data['schedule_id']))->num_rows();

        if($duplicate == 0){
            $this->db->insert('recruitment_schedule', $data);

            $this->db->from('application');
            $this->db->where('vacancy_id', $this->input->post('vacancy_id'));
            $this->db->where('application_status', $this->input->post('application_status'));
            $query = $this->db->get();
    
            foreach($query->result_array() as $row):
                $data2['schedule_id'] = $this->input->post('vacancy_id') . '_' . $this->input->post('application_status') . '_' . $this->input->post('schedule_date');
                $data2['nik']         = $row['nik'];
    
                $this->db->insert('recruitment_candidate', $data2);
            endforeach;
    
            return true;
        } else {
            return false;
        }
    }
    function schedule_edit($schedule_id = '') {
        $data['schedule_date']      = $this->input->post('schedule_date');
        $data['schedule_time']      = $this->input->post('schedule_time');
        $data['schedule_place']     = $this->input->post('schedule_place');
        $data['schedule_note']      = $this->input->post('schedule_note');
        $data['vacancy_id']         = $this->input->post('vacancy_id');
        $data['application_status'] = $this->input->post('application_status');

        $this->db->where('schedule_id', $schedule_id);
        $this->db->update('recruitment_schedule', $data);

        return true;
    }
    function schedule_delete($schedule_id = '') {
        $this->db->where('schedule_id', $schedule_id);
        $this->db->delete('recruitment_schedule');

        $this->db->where('schedule_id', $schedule_id);
        $this->db->delete('recruitment_candidate');

        return true;
    }
    function schedule_delete_candidate($nik = '') {
        $this->db->where('nik', $nik);
        $this->db->delete('recruitment_candidate');

        return true;
    }


    // ------- CANDIDATE ------- //

    function candidate_move_eksternal($candidate_ktp = '') {
        $data['nik']                          = $this->input->post('nik');
        $data['employee_npwp']                = $this->input->post('employee_npwp');
        $data['employee_ktp']                 = $this->input->post('employee_ktp');
        $data['employee_ktpexpire']           = $this->input->post('employee_ktpexpire');
        $data['employee_name']                = $this->input->post('employee_name');
        $data['employee_bpjskesehatan']       = $this->input->post('employee_bpjskesehatan');
        $data['employee_bpjsketenagakerjaan'] = $this->input->post('employee_bpjsketenagakerjaan');
        $data['employee_birthplace']          = $this->input->post('employee_birthplace');
        $data['employee_birthdate']           = $this->input->post('employee_birthdate');
        $data['employee_gender']              = $this->input->post('employee_gender');
        $data['employee_marital']             = $this->input->post('employee_marital');
        $data['employee_religion']            = $this->input->post('employee_religion');
        $data['employee_phone']               = $this->input->post('employee_phone');
        $data['employee_phone2']              = $this->input->post('employee_phone2');
        $data['employee_address']             = $this->input->post('employee_address');
        $data['employee_city']                = $this->input->post('employee_city');
        $data['employee_banknumber']          = $this->input->post('employee_banknumber');
        $data['employee_education']           = $this->input->post('employee_education');
        $data['employee_university']          = $this->input->post('employee_university');
        $data['employee_major']               = $this->input->post('employee_major');
        $data['employee_join']                = $this->input->post('employee_join');
        $data['employee_position']            = $this->input->post('employee_position');
        $data['employee_status']              = $this->input->post('employee_status');
        $data['employee_level']               = $this->input->post('employee_level');
        $data['employee_type']                = $this->input->post('employee_type');
        $data['employee_area']                = $this->input->post('employee_area');
        $data['employee_zona']                = $this->input->post('employee_zona');
        $data['section_code']                 = $this->input->post('section_code');
        $data['unit_code']                    = $this->input->post('unit_code');
        $data['regional_code']                = $this->input->post('regional_code');
        $data['branch_code']                  = $this->input->post('branch_code');
        $data['origin_code']                  = $this->input->post('origin_code');
        $data['zone_code']                    = $this->input->post('zone_code');
        $data['orion_id']                     = $this->input->post('orion_id');
        $data['courier_id']                   = $this->input->post('courier_id');
        $data['createby']                     = $this->session->userdata('login_nik');
        $data['createdate']                   = date('Y-m-d H:i:s');
        
        $data2['nik']               = $this->input->post('nik');
        $data2['user_password']     = md5('123456');
        $data2['user_application']  = 'MYHC';
        $data2['user_status']       = 'Y';
        $data2['user_type']         = 'EMPLOYEE';
        $data2['user_createdate']   = date('Y-m-d H:i:s');

        $data3['nik']               = $this->input->post('nik');

        $duplicate = $this->db->get_where('employee', array('nik' => $this->input->post('nik')))->num_rows();

        if($duplicate == 0){
            $this->db->insert('employee', $data);
            
            $this->db->insert('user', $data2);

            $duplicate2 = $this->db->get_where('file', array('nik' => $this->input->post('nik')))->num_rows();
            if($duplicate2 == 0){
                $this->db->insert('file', $data3);
            }
            
            // $this->db->where('candidate_ktp', $candidate_ktp);
            // $this->db->delete('candidate');
            
            return true;
        } else {
            return false;
        }
    }

    function candidate_move_internal($nik = '') {
        $data['nik']                          = $this->input->post('nik');
        $data['employee_npwp']                = $this->input->post('employee_npwp');
        $data['employee_ktp']                 = $this->input->post('employee_ktp');
        $data['employee_ktpexpire']           = $this->input->post('employee_ktpexpire');
        $data['employee_name']                = $this->input->post('employee_name');
        $data['employee_bpjskesehatan']       = $this->input->post('employee_bpjskesehatan');
        $data['employee_bpjsketenagakerjaan'] = $this->input->post('employee_bpjsketenagakerjaan');
        $data['employee_birthplace']          = $this->input->post('employee_birthplace');
        $data['employee_birthdate']           = $this->input->post('employee_birthdate');
        $data['employee_gender']              = $this->input->post('employee_gender');
        $data['employee_marital']             = $this->input->post('employee_marital');
        $data['employee_religion']            = $this->input->post('employee_religion');
        $data['employee_phone']               = $this->input->post('employee_phone');
        $data['employee_phone2']              = $this->input->post('employee_phone2');
        $data['employee_address']             = $this->input->post('employee_address');
        $data['employee_city']                = $this->input->post('employee_city');
        $data['employee_banknumber']          = $this->input->post('employee_banknumber');
        $data['employee_education']           = $this->input->post('employee_education');
        $data['employee_university']          = $this->input->post('employee_university');
        $data['employee_major']               = $this->input->post('employee_major');
        $data['employee_join']                = $this->input->post('employee_join');
        $data['employee_position']            = $this->input->post('employee_position');
        $data['employee_status']              = $this->input->post('employee_status');
        $data['employee_level']               = $this->input->post('employee_level');
        $data['employee_type']                = $this->input->post('employee_type');
        $data['employee_area']                = $this->input->post('employee_area');
        $data['employee_zona']                = $this->input->post('employee_zona');
        $data['section_code']                 = $this->input->post('section_code');
        $data['unit_code']                    = $this->input->post('unit_code');
        $data['regional_code']                = $this->input->post('regional_code');
        $data['branch_code']                  = $this->input->post('branch_code');
        $data['origin_code']                  = $this->input->post('origin_code');
        $data['zone_code']                    = $this->input->post('zone_code');
        $data['orion_id']                     = $this->input->post('orion_id');
        $data['courier_id']                   = $this->input->post('courier_id');
 
        $this->db->where('nik', $nik);
        $this->db->update('employee', $data);

        if($_FILES['userfile']['name'] != '')
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/employee_image/' . $nik . '.jpg');
        
        $data2['nik']       = $this->input->post('nik');

        $this->db->where('nik', $nik);
        $this->db->update('user', $data2);

        $this->db->where('nik', $nik);
        $this->db->delete('application');

        return true;
    }


    // // ------- MPP ------- //

    // function mpp_approve($mpp_id = '') {
    //     $data['mpp_status'] = 'Approved';

    //     $this->db->where('mpp_id', $mpp_id);
    //     $this->db->update('mpp', $data);

    //     return true;
    // }

    // function mpp_decline($mpp_id = '') {
    //     $data['mpp_status'] = 'Declined';
    //     $data['mpp_note']   = $this->input->post('mpp_note');

    //     $this->db->where('mpp_id', $mpp_id);
    //     $this->db->update('mpp', $data);

    //     return true;
    // }


    // ------- LOAN ------- //

    function loan_approved($loan_id = '', $loanquota_id = '') {
        $quota = $this->db->get_where('loan_quota', array('loanquota_id' => $loanquota_id))->row();
        $hutang = $this->db->get_where('loan', array('loan_id' => $loan_id))->row();
        
        if ($hutang->loan_amount <= $quota->loanquota_remaining) {
            $data['loan_realization'] = $this->input->post('loan_realization');
            $data['loan_status']      = 'Approved';
            $data['approveby']        = $this->session->userdata('login_nik');

            $this->db->where('loan_id', $loan_id);
            $this->db->update('loan', $data);
        
            $loan = $this->db->get_where('loan', array('loan_id' => $loan_id, 'loan_status' => 'Approved'))->row();
        
            $paypermonth = $loan->loan_amount / $loan->loan_tenor;

            $now = $data['loan_realization'];
            $time_now = strtotime($now); 
            $time = strtotime('+1 month', $time_now);

            for ($i = 1; $i <= $loan->loan_tenor; $i++) {
                $date = date('Y-m', $time);
                $time = strtotime('+1 month', $time);

                $data2['nik']                = $loan->nik;
                $data2['loan_id']            = $loan_id;
                $data2['loanquota_id']       = $loanquota_id;
                $data2['dtloan_installment'] = $i;
                $data2['dtloan_month']       = $date;
                $data2['dtloan_paypermonth'] = $paypermonth; //+ $interest;
                $data2['dtloan_status']      = 'Unpaid';

                $this->db->insert('loan_detail', $data2);
            }

            return true;
        } else {
            return false;
        }
    }

    function loan_declined($loan_id = '') {
        $data['loan_status'] = 'Declined';
        $data['loan_note']   = $this->input->post('loan_note');
        $data['approveby']   = $this->session->userdata('login_nik');

        $this->db->where('loan_id', $loan_id);
        $this->db->update('loan', $data);

        return true;
    }

    function loan_edit($loan_id = '', $loanquota_id = '') {
        $quota = $this->db->get_where('loan_quota', array('loanquota_id' => $loanquota_id))->row();
        $hutang = $this->db->get_where('loan', array('loan_id' => $loan_id))->row();
        
        $cek = $this->input->post('loan_status');
        $cek2 = $this->input->post('loan_realization');

        if($cek == 'Approved'){
            if($cek2 != '' || $cek2 != NULL){
                if ($hutang->loan_amount <= $quota->loanquota_remaining) {
                    $data['loan_realization'] = $this->input->post('loan_realization');
                    $data['loan_note']        = NULL;
                    $data['loan_status']      = $this->input->post('loan_status');
                    $data['approveby']        = $this->session->userdata('login_nik');

                    $this->db->where('loan_id', $loan_id);
                    $this->db->update('loan', $data);
                
                    $loan = $this->db->get_where('loan', array('loan_id' => $loan_id, 'loan_status' => 'Approved'))->row();
                
                    $paypermonth = $loan->loan_amount / $loan->loan_tenor;

                    $now = $data['loan_realization'];
                    $time_now = strtotime($now); 
                    $time = strtotime('+1 month', $time_now);

                    for ($i = 1; $i <= $loan->loan_tenor; $i++) {
                        $date = date('Y-m', $time);
                        $time = strtotime('+1 month', $time);

                        $data2['nik']                = $loan->nik;
                        $data2['loan_id']            = $loan_id;
                        $data2['loanquota_id']       = $loanquota_id;
                        $data2['dtloan_installment'] = $i;
                        $data2['dtloan_month']       = $date;
                        $data2['dtloan_paypermonth'] = $paypermonth; //+ $interest;
                        $data2['dtloan_status']      = 'Unpaid';

                        $this->db->insert('loan_detail', $data2);
                    }
                    return true;
                }
                return false;
            }
        } elseif($cek == 'Declined' || $cek == 'Pending'){
            $data['loan_status']      = $this->input->post('loan_status');
            $data['loan_note']        = $this->input->post('loan_note');
            $data['loan_realization'] = NULL;
            $data['approveby']        = $this->session->userdata('login_nik');

            $this->db->where('loan_id', $loan_id);
            $this->db->update('loan', $data);

            return true;
        }
    }

    function loan_quota($param2) {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['loanhistory_inout']    = $this->input->post('loanhistory_inout');
        $data['loanhistory_amount']   = $this->input->post('loanhistory_amount');
        $data['loanhistory_date']     = date('Y-m-d H:i:s');
        $data['nik']                  = $this->session->userdata('login_nik');
        $data['regional_code']        = $user->regional_code;
        $data['branch_code']          = $user->branch_code;
        $data['origin_code']          = $user->origin_code;
        $data['zone_code']            = $user->zone_code;

        $this->db->insert('loan_history', $data);

        $loanquota = $this->db->get_where('loan_quota', array('loanquota_id' => 1))->row();

        if ($data['loanhistory_inout'] == 'In'){
            $penambahan = $loanquota->loanquota_remaining + $this->input->post('loanhistory_amount');

            $data2['loanquota_remaining']  = $penambahan;

            $this->db->where('loanquota_id', $param2);
            $this->db->update('loan_quota', $data2);
        } elseif ($data['loanhistory_inout'] == 'Out'){
            $pengurangan = $loanquota->loanquota_remaining - $this->input->post('loanhistory_amount');

            $data3['loanquota_remaining']  = $pengurangan;

            $this->db->where('loanquota_id', $param2);
            $this->db->update('loan_quota', $data3);
        }

        return true;
    }


    // ------- RESIGN ------- //

    function resign_approved($resign_id = '', $nik = '') {
        $this->db->from('resign');
        $this->db->join('employee', 'resign.nik = employee.nik');
        $this->db->join('spk', 'resign.nik = spk.nik');
        // $this->db->join('leave_remaining', 'resign.nik = leave_remaining.nik');
        $this->db->where('resign_id', $resign_id);
        $this->db->where('resign.nik', $nik);
        // $this->db->where('leaverem_year', date('Y'));
        $this->db->order_by('spk_enddate', 'DESC');
        $this->db->limit(1);
        $employee = $this->db->get();


        // CALCULATE SEVERANCE

        $date1  = strtotime($employee->row()->employee_join);
        $date2  = strtotime('now'); 
        $diff   = abs($date2 - $date1);
        $years  = floor($diff / (365*60*60*24));

        if($years >= 3 && $years < 6){
            $severance = 2 * $employee->row()->spk_salary;
        } elseif($years >= 6 && $years < 9){
            $severance = 3 * $employee->row()->spk_salary;
        } elseif($years >= 9 && $years < 12){
            $severance = 4 * $employee->row()->spk_salary;
        } elseif($years >= 12 && $years < 15){
            $severance = 5 * $employee->row()->spk_salary;
        } elseif($years >= 15 && $years < 18){
            $severance = 6 * $employee->row()->spk_salary;
        } elseif($years >= 18 && $years < 21){
            $severance = 7 * $employee->row()->spk_salary;
        } elseif($years >= 21 && $years < 24){
            $severance = 8 * $employee->row()->spk_salary;
        } elseif($years >= 24){
            $severance = 10 * $employee->row()->spk_salary;
        }

        //$leave = $employee->row()->leaverem_remaining * 144000;


        // CALCULATE REMAINING LOAN

        $this->db->from('resign');
        $this->db->join('loan_detail', 'resign.nik = loan_detail.nik');
        $this->db->where('dtloan_status', 'Unpaid');
        $this->db->where('resign_id', $resign_id);
        $remloan = $this->db->get();

        if ($remloan->num_rows() > 0){
            $loan = $remloan->row()->dtloan_paypermonth * $remloan->num_rows();
        }

        // SEARCH ASSET

        $asset = $this->db->get_where('asset', array('nik' => $nik, 'asset_status' => 'Active'));

        if ($asset->num_rows() > 0){
            foreach($asset->result_array() as $row1):
                $data4['resignasset_type']   = 'Asset';
                $data4['resignasset_code']   = $row1['asset_number'];
                $data4['resignasset_qty']    = 1;
                $data4['resignasset_status'] = 'On Employee';
                $data4['resign_id']          = $resign_id;

                $this->db->insert('resign_asset', $data4);
            endforeach;
        }


        // SEARCH UNIFORM
        
        $this->db->from('uniform');
        $this->db->join('uniform_stock', 'uniform.uniformstock_code = uniform_stock.uniformstock_code');
        $this->db->where('nik', $nik);
        $this->db->where('uniform_inout', 'Out');
        $uniform = $this->db->get();

        if ($uniform->num_rows() > 0){
            foreach($uniform->result_array() as $row2):
                $data5['resignasset_type']   = 'Uniform';
                $data5['resignasset_code']   = $row2['uniformstock_code'];
                $data5['resignasset_qty']    = $row2['uniform_qty'];
                $data5['resignasset_status'] = 'On Employee';
                $data5['resign_id']          = $resign_id;

                $this->db->insert('resign_asset', $data5);
            endforeach;
        }


        // UPDATE TABEL RESIGN

        $data['resign_status']      = 'Approved';
        $data['resign_date']        = date('Y-m-d');
        $data['resign_severance']   = $severance;
        $data['resign_loan']        = $loan;
        // $data['resign_leave']       = $leave;
        // $data['resign_sum']         = $severance - $loan + $leave;
        $data['resign_paystatus']   = 'Unpaid';
        $data['approveby']          = $this->session->userdata('login_nik');

        $this->db->where('resign_id', $resign_id);
        $this->db->update('resign', $data);

        
        // UPDATE TABEL USER

        $data2['user_status']      = 'N';

        $this->db->where('nik', $nik);
        $this->db->update('user', $data2);


        // UPDATE TABEL EMPLOYEE

        $data3['employee_status']      = 'Resign';

        $this->db->where('nik', $nik);
        $this->db->update('employee', $data3);

        return true;
    }

    function resign_declined($resign_id = '') {
        $data['resign_status'] = 'Declined';
        $data['resign_note']   = $this->input->post('resign_note');
        $data['approveby']     = $this->session->userdata('login_nik');

        $this->db->where('resign_id', $resign_id);
        $this->db->update('resign', $data);

        return true;
    }

    function resign_paid($resign_id = '', $nik = '') {
        $data['resign_paystatus'] = 'Paid';

        $this->db->where('resign_id', $resign_id);
        $this->db->update('resign', $data);

        $data2['dtloan_status'] = 'Paid';

        $this->db->where('nik', $nik);
        $this->db->update('loan_detail', $data2);

        $data3['loan_status'] = 'Paid';

        $this->db->where('nik', $nik);
        $this->db->update('loan', $data3);

        return true;
    }

    function resignasset_update($resignasset_id = '') {
        $data['resignasset_status']   = 'Returned';

        $this->db->where('resignasset_id', $resignasset_id);
        $this->db->update('resign_asset', $data);

        return true;
    }


    // -------------- PLAFON --------------- //

    function plafon_add() {
        $data['nik']                       = $this->input->post('nik');
        $data['plafon_periode']            = $this->input->post('plafon_periode');
        $data['plafon_rawatinap']          = $this->input->post('plafon_rawatinap');
        $data['plafon_rawatjalan']         = $this->input->post('plafon_rawatjalan');
        $data['plafon_melahirkannormal']   = $this->input->post('plafon_melahirkannormal');
        $data['plafon_melahirkansectio']   = $this->input->post('plafon_melahirkansectio');
        $data['plafon_setkacamata']        = $this->input->post('plafon_setkacamata');
        $data['plafon_lensa']              = $this->input->post('plafon_lensa');
        $data['createby']                  = $this->session->userdata('login_nik');

        $duplicate = $this->db->get_where('plafon', array('nik' => $this->input->post('nik'), 'plafon_periode' => $this->input->post('plafon_periode')))->num_rows();

        if($duplicate == 0){
            $this->db->insert('plafon', $data);

            return true;
        } else {
            return false;
        }
    }
    function plafon_edit($plafon_id = '') {
        $data['nik']                       = $this->input->post('nik');
        $data['plafon_periode']            = $this->input->post('plafon_periode');
        $data['plafon_rawatinap']          = $this->input->post('plafon_rawatinap');
        $data['plafon_rawatjalan']         = $this->input->post('plafon_rawatjalan');
        $data['plafon_melahirkannormal']   = $this->input->post('plafon_melahirkannormal');
        $data['plafon_melahirkansectio']   = $this->input->post('plafon_melahirkansectio');
        $data['plafon_setkacamata']        = $this->input->post('plafon_setkacamata');
        $data['plafon_lensa']              = $this->input->post('plafon_lensa');

        $this->db->where('plafon_id', $plafon_id);
        $this->db->update('plafon', $data);

        return true;
    }
    function plafon_delete($plafon_id = '') {
        $this->db->where('plafon_id', $plafon_id);
        $this->db->delete('plafon');

        return true;
    }


    // -------------- RAWAT INAP --------------- //

    function rawatinap_update($rawatinap_id = '') {
        $data['rawatinap_coding']          = $this->input->post('rawatinap_coding');
        $data['rawatinap_namapasien']      = $this->input->post('rawatinap_namapasien');
        $data['rawatinap_keterangan']      = $this->input->post('rawatinap_keterangan');
        $data['rawatinap_tglkwitansi']     = $this->input->post('rawatinap_tglkwitansi');
        $data['rawatinap_jmldiajukan']     = $this->input->post('rawatinap_jmldiajukan');
        $data['rawatinap_jmldisetujui']    = $this->input->post('rawatinap_jmldisetujui');
        $data['rawatinap_pergantian']      = $this->input->post('rawatinap_pergantian');
        $data['rawatinap_jmlrealisasi']    = $this->input->post('rawatinap_jmlrealisasi');
        $data['rawatinap_bank']            = $this->input->post('rawatinap_bank');
        $data['rawatinap_rekeningpemilik'] = $this->input->post('rawatinap_rekeningpemilik');
        $data['rawatinap_rekeningnomor']   = $this->input->post('rawatinap_rekeningnomor');
        $data['rawatinap_status']          = $this->input->post('rawatinap_status');
        $data['rawatinap_note']            = $this->input->post('rawatinap_note');
        $data['approveby']                 = $this->session->userdata('login_nik');

        $this->db->where('rawatinap_id', $rawatinap_id);
        $this->db->update('rawatinap', $data);

        if($data['rawatinap_status'] == 'Approved'){
            $sisa   = $this->db->get_where('plafon', array('nik' => $this->input->post('nik'), 'plafon_periode' => date('Y')))->row()->plafon_rawatinap;
            $plafon = $sisa - $data['rawatinap_jmlrealisasi'];

            $data2['plafon_rawatinap'] = $plafon;

            $this->db->where('nik', $this->input->post('nik'));
            $this->db->where('plafon_periode', date('Y'));
            $this->db->update('plafon', $data2);
        }

        return true;
    }

    // -------------- RAWAT JALAN --------------- //

    function rawatjalan_update($rawatjalan_id = '') {
        $data['rawatjalan_coding']          = $this->input->post('rawatjalan_coding');
        $data['rawatjalan_namapasien']      = $this->input->post('rawatjalan_namapasien');
        $data['rawatjalan_keterangan']      = $this->input->post('rawatjalan_keterangan');
        $data['rawatjalan_tglkwitansi']     = $this->input->post('rawatjalan_tglkwitansi');
        $data['rawatjalan_plafonawal']      = $this->input->post('rawatjalan_plafonawal');
        $data['rawatjalan_jmldiajukan']     = $this->input->post('rawatjalan_jmldiajukan');
        $data['rawatjalan_jmlrealisasi']    = $this->input->post('rawatjalan_jmlrealisasi');
        $data['rawatjalan_sisaplafon']      = $this->input->post('rawatjalan_sisaplafon');
        $data['rawatjalan_bank']            = $this->input->post('rawatjalan_bank');
        $data['rawatjalan_rekeningpemilik'] = $this->input->post('rawatjalan_rekeningpemilik');
        $data['rawatjalan_rekeningnomor']   = $this->input->post('rawatjalan_rekeningnomor');
        $data['rawatjalan_status']          = $this->input->post('rawatjalan_status');
        $data['rawatjalan_note']            = $this->input->post('rawatjalan_note');
        $data['approveby']                  = $this->session->userdata('login_nik');

        $this->db->where('rawatjalan_id', $rawatjalan_id);
        $this->db->update('rawatjalan', $data);

        if($data['rawatjalan_status'] == 'Approved'){

            $data2['plafon_rawatjalan'] = $this->input->post('rawatjalan_sisaplafon');;

            $this->db->where('nik', $this->input->post('nik'));
            $this->db->where('plafon_periode', date('Y'));
            $this->db->update('plafon', $data2);
        }

        return true;
    }


    // -------------- MELAHIRKAN --------------- //

    function melahirkan_update($melahirkan_id = '') {
        $data['melahirkan_coding']          = $this->input->post('melahirkan_coding');
        $data['melahirkan_namapasien']      = $this->input->post('melahirkan_namapasien');
        $data['melahirkan_keterangan']      = $this->input->post('melahirkan_keterangan');
        $data['melahirkan_persalinan']      = $this->input->post('melahirkan_persalinan');
        $data['melahirkan_tglkwitansi']     = $this->input->post('melahirkan_tglkwitansi');
        $data['melahirkan_jmldiajukan']     = $this->input->post('melahirkan_jmldiajukan');
        $data['melahirkan_jmldisetujui']    = $this->input->post('melahirkan_jmldisetujui');
        $data['melahirkan_pergantian']      = $this->input->post('melahirkan_pergantian');
        $data['melahirkan_jmlrealisasi']    = $this->input->post('melahirkan_jmlrealisasi');
        $data['melahirkan_bank']            = $this->input->post('melahirkan_bank');
        $data['melahirkan_rekeningpemilik'] = $this->input->post('melahirkan_rekeningpemilik');
        $data['melahirkan_rekeningnomor']   = $this->input->post('melahirkan_rekeningnomor');
        $data['melahirkan_status']          = $this->input->post('melahirkan_status');
        $data['melahirkan_note']            = $this->input->post('melahirkan_note');
        $data['approveby']                  = $this->session->userdata('login_nik');

        $this->db->where('melahirkan_id', $melahirkan_id);
        $this->db->update('melahirkan', $data);

        if($data['melahirkan_status'] == 'Approved'){
            if($data['melahirkan_persalinan'] == 'NORMAL'){
                $sisa   = $this->db->get_where('plafon', array('nik' => $this->input->post('nik'), 'plafon_periode' => date('Y')))->row()->plafon_melahirkannormal;
                $plafon = $sisa - $data['melahirkan_jmlrealisasi'];

                $data2['plafon_melahirkannormal'] = $plafon;
            } else if ($data['melahirkan_persalinan'] == 'SECTIO'){
                $sisa   = $this->db->get_where('plafon', array('nik' => $this->input->post('nik'), 'plafon_periode' => date('Y')))->row()->plafon_melahirkansectio;
                $plafon = $sisa - $data['melahirkan_jmlrealisasi'];

                $data2['plafon_melahirkansectio'] = $plafon;
            }
            
            $this->db->where('nik', $this->input->post('nik'));
            $this->db->where('plafon_periode', date('Y'));
            $this->db->update('plafon', $data2);
        }

        return true;
    }


    // -------------- KACAMATA --------------- //

    function kacamata_update($kacamata_id = '') {
        $data['kacamata_coding']          = $this->input->post('kacamata_coding');
        $data['kacamata_keterangan']      = $this->input->post('kacamata_keterangan');
        $data['kacamata_tglkwitansi']     = $this->input->post('kacamata_tglkwitansi');
        $data['kacamata_jmldiajukan']     = $this->input->post('kacamata_jmldiajukan');
        $data['kacamata_jmldiganti']      = $this->input->post('kacamata_jmldiganti');
        $data['kacamata_bank']            = $this->input->post('kacamata_bank');
        $data['kacamata_rekeningpemilik'] = $this->input->post('kacamata_rekeningpemilik');
        $data['kacamata_rekeningnomor']   = $this->input->post('kacamata_rekeningnomor');
        $data['kacamata_status']          = $this->input->post('kacamata_status');
        $data['kacamata_note']            = $this->input->post('kacamata_note');
        $data['approveby']                = $this->session->userdata('login_nik');

        $this->db->where('kacamata_id', $kacamata_id);
        $this->db->update('kacamata', $data);

        if($data['kacamata_status'] == 'Approved'){
            if($data['kacamata_keterangan'] == 'LENSA'){
                $sisa   = $this->db->get_where('plafon', array('nik' => $this->input->post('nik'), 'plafon_periode' => date('Y')))->row()->plafon_lensa;
                $plafon = $sisa - $data['kacamata_jmldiganti'];

                $data2['plafon_lensa'] = $plafon;
            } else if ($data['kacamata_keterangan'] == 'SET KACAMATA'){
                $sisa   = $this->db->get_where('plafon', array('nik' => $this->input->post('nik'), 'plafon_periode' => date('Y')))->row()->plafon_setkacamata;
                $plafon = $sisa - $data['kacamata_jmldiganti'];

                $data2['plafon_setkacamata'] = $plafon;
            }
            
            $this->db->where('nik', $this->input->post('nik'));
            $this->db->where('plafon_periode', date('Y'));
            $this->db->update('plafon', $data2);
        }

        return true;
    }


    // --------------- UNIFORM --------------- //

    function uniform_In() {
        $data['uniform_inout']       = 'In';
        $data['uniformstock_code']   = $this->input->post('uniformstock_code');
        $data['uniform_qty']         = $this->input->post('uniform_qty');
        $data['nik']                 = $this->session->userdata('login_nik');
        $data['uniform_date']        = date('Y-m-d H:i:s');

        $this->db->insert('uniform', $data);

        return true;
    }
    function uniform_Out() {
        if($this->db->get_where('uniform_stock', array('uniformstock_code' => $this->input->post('uniformstock_code')))->row()->uniformstock_stock > 0){
            $data['uniform_inout']       = 'Out';
            $data['uniformstock_code']   = $this->input->post('uniformstock_code');
            $data['uniform_qty']         = $this->input->post('uniform_qty');
            $data['nik']                 = $this->input->post('nik');
            $data['uniform_date']        = date('Y-m-d H:i:s');
            
            $this->db->insert('uniform', $data);

            return true;
        } else {
            return false;
        }
    }
    function uniform_approve($uniformrequest_id = '') {
        $request = $this->db->get_where('uniform_request', array('uniformrequest_id' => $uniformrequest_id))->row();

        if($this->db->get_where('uniform_stock', array('uniformstock_code' => $request->uniformstock_code))->row()->uniformstock_stock > 0){
            $data['uniform_inout']       = 'Out';
            $data['uniformstock_code']   = $request->uniformstock_code;
            $data['uniform_qty']         = 1;
            $data['nik']                 = $request->nik;
            $data['uniform_date']        = date('Y-m-d H:i:s');
            
            $this->db->insert('uniform', $data);

            $data2['uniformrequest_status'] = 'Approved';
            $data2['approveby']             = $this->session->userdata('login_nik');

            $this->db->where('uniformrequest_id', $uniformrequest_id);
            $this->db->update('uniform_request', $data2);

            return true;
        } else {
            return false;
        }
    }
    function uniform_decline($uniformrequest_id = '') {
        $data['uniformrequest_status'] = 'Declined';
        $data['uniformrequest_note']   = $this->input->post('uniformrequest_note');
        $data['approveby']            = $this->session->userdata('login_nik');

        $this->db->where('uniformrequest_id', $uniformrequest_id);
        $this->db->update('uniform_request', $data);

        return true;
    }
    function uniform_add() {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['uniformstock_code']        = $this->input->post('uniformstock_type') . '-' . $this->input->post('uniformstock_gender') . '-' . $this->input->post('uniformstock_size');
        $data['uniformstock_type']        = $this->input->post('uniformstock_type');
        $data['uniformstock_gender']      = $this->input->post('uniformstock_gender');
        $data['uniformstock_size']        = $this->input->post('uniformstock_size');
        $data['uniformstock_stock']       = 0;
        $data['createby']                 = $this->session->userdata('login_nik');
        $data['regional_code']            = $user->regional_code;
        $data['branch_code']              = $user->branch_code;
        $data['origin_code']              = $user->origin_code;
        $data['zone_code']                = $user->zone_code;

        $this->db->insert('uniform_stock', $data);

        return true;
    }
    function uniform_edit($uniformstock_id = '') {
        $data['uniformstock_code']        = $this->input->post('uniformstock_type') . '-' . $this->input->post('uniformstock_gender') . '-' . $this->input->post('uniformstock_size');
        $data['uniformstock_type']        = $this->input->post('uniformstock_type');
        $data['uniformstock_gender']      = $this->input->post('uniformstock_gender');
        $data['uniformstock_size']        = $this->input->post('uniformstock_size');

        $this->db->where('uniformstock_id', $uniformstock_id);
        $this->db->update('uniform_stock', $data);

        return true;
    }
    function uniform_delete($uniformstock_id = '') {
        $this->db->where('uniformstock_id', $uniformstock_id);
        $this->db->delete('uniform_stock');

        return true;
    }


    // -------------- CLASS --------------- //

    function class_add() {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();
        $code = substr(md5(microtime()),rand(0,26),6);
        $data['class_id']             = $code;
        $data['class_name']           = $this->input->post('class_name');
        $data['class_periode']        = $this->input->post('class_periode');
        $data['class_date']           = date('Y-m-d');
        $data['class_status']         = "Active";
        $data['createby']             = $this->session->userdata('login_nik');
        $data['regional_code']        = $user->regional_code;
        $data['branch_code']          = $user->branch_code;
        $data['origin_code']          = $user->origin_code;
        $data['zone_code']            = $user->zone_code;

        $this->db->insert('elearning_class', $data);

        $employee = $this->input->post('nik');
        foreach ($employee as $row):
            if($row != ""){
                $data2['class_id']           = $code;
                $data2['nik']                = $row;
                $data2['student_status']     = 'Registered';
                $data2['student_createdate'] = date('Y-m-d H:i:s');
                $data2['createby']          = $this->session->userdata('login_nik');
                $this->db->insert('elearning_student', $data2);
            }
        endforeach;


        return true;
    }
    function class_edit($class_id = '') {
        $data['class_name']        = $this->input->post('class_name');
        $data['class_periode']        = $this->input->post('class_periode');
        $data['class_status']      = $this->input->post('class_status');

        $this->db->where('class_id', $class_id);
        $this->db->update('elearning_class', $data);

        // UPDATE EXISTING OPTION
        $student1 = $this->db->get_where('elearning_student', array('class_id' => $class_id))->result_array();
        foreach ($student1 as $row1):
            $data2['nik']                = $this->input->post('student_' . $row1['student_id']);
            $data2['student_status']     = 'Registered';
            $data2['student_createdate'] = date('Y-m-d H:i:s');

            if($data2['nik'] != NULL){
                $this->db->where('student_id',  $row1['student_id']);
                $this->db->update('elearning_student', $data2);
            }
        endforeach;

        // CREATE NEW OPTION
        $student2 = $this->input->post('nik');

        foreach($student2 as $row2):
            if($row2 != ""){
                $data3['class_id']       = $class_id;
                $data3['nik']            = $row2;
                $data3['student_status'] = 'Registered';
                $data2['student_createdate'] = date('Y-m-d H:i:s');
                $data3['createby']      = $this->session->userdata('login_nik');

                if($data3['nik'] != NULL){
                    $this->db->insert('elearning_student', $data3);
                }
            }
        endforeach;

        return true;
    }
    function class_delete($class_id = '') {
        $this->db->where('class_id', $class_id);
        $this->db->delete('elearning_class');

        $this->db->where('class_id', $class_id);
        $this->db->delete('elearning_materi');

        $this->db->where('class_id', $class_id);
        $this->db->delete('elearning_student');

        return true;
    }


    // -------------- MATERI --------------- //

    function materi_add($param2) {
        $data['class_id']             = $param2;
        $data['materi_name']          = $this->input->post('materi_name');
        $data['materi_file']          = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['materi_file']['name'])['extension'];
        $data['materi_create_date']   = date('Y-m-d');
        $data['materi_create_time']   = date('H:i:s');
        $data['materi_end_date']      = $this->input->post('materi_end_date');
        $data['materi_end_time']      = $this->input->post('materi_end_time');
        $data['createby']             = $this->session->userdata('login_nik');
        $data['createdate']           = date('Y-m-d H:i:s');

        $this->db->insert('elearning_materi', $data);

        if($_FILES['materi_file']['name'] != '')
            move_uploaded_file($_FILES['materi_file']['tmp_name'], 'uploads/materi/' . $data['materi_file']);

        return true;
    }
    function materi_edit($param2) {
        $data['materi_name']      = $this->input->post('materi_name');
        $data['materi_end_date']  = $this->input->post('materi_end_date');
        $data['materi_end_time']  = $this->input->post('materi_end_time');
        if($_FILES['materi_file']['name'] != '')
            $data['materi_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['materi_file']['name'])['extension'];

        if($_FILES['materi_file']['name'] != '')
            move_uploaded_file($_FILES['materi_file']['tmp_name'], 'uploads/materi/' . $data['materi_file']);

        $this->db->where('materi_id', $param2);
        $this->db->update('elearning_materi', $data);

        return true;
    }
    function materi_delete($param2) {
        $this->db->where('materi_id', $param2);
        $this->db->delete('elearning_materi');

        return true;
    }


    // ------- STUDENT ------- //

    function student_delete($student_id = '') {
        $this->db->where('student_id', $student_id);
        $this->db->delete('elearning_student');

        return true;
    }
    function student_done($student_id = '') {
        $data['student_status']      = 'Done';

        $this->db->where('student_id', $student_id);
        $this->db->update('elearning_student', $data);

        return true;
    }
    function student_approve($student_id = '') {
        $data['student_status']      = 'Registered';

        $this->db->where('student_id', $student_id);
        $this->db->update('elearning_student', $data);

        return true;
    }
    function student_decline($student_id = '') {
        $data['student_status']      = 'Declined';

        $this->db->where('student_id', $student_id);
        $this->db->update('elearning_student', $data);

        return true;
    }
    function student_pending($student_id = '') {
        $data['student_status']      = 'Pending';

        $this->db->where('student_id', $student_id);
        $this->db->update('elearning_student', $data);

        return true;
    }


    // -------------- EXAM --------------- //

    function exam_add() {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['exam_id']           = substr(md5(microtime()),rand(0,26),6);
        $data['exam_name']         = $this->input->post('exam_name');
        $data['exam_start_date']   = $this->input->post('exam_start_date');
        $data['exam_start_time']   = $this->input->post('exam_start_time');
        $data['exam_end_date']     = $this->input->post('exam_end_date');
        $data['exam_end_time']     = $this->input->post('exam_end_time');
        // $data['exam_random']       = $this->input->post('exam_random');
        $data['exam_random']       = 'N';
        $data['user_type']         = $this->input->post('user_type');
        $data['questionpack_id']   = $this->input->post('questionpack_id');
        $data['exam_token']        = substr(md5(microtime()),rand(0,26),12);
        $data['createby']          = $this->session->userdata('login_nik');
        $data['createdate']        = date('Y-m-d H:i:s');
        $data['regional_code']     = $user->regional_code;
        $data['branch_code']       = $user->branch_code;
        $data['origin_code']       = $user->origin_code;
        $data['zone_code']         = $user->zone_code;
        if($data['user_type'] == 'DEPARTMENT'){
            $data['exam_section']  = $this->input->post('section_code');
        }

        $this->db->insert('cbt_exam', $data);

        if($data['user_type'] == 'INDIVIDU'){
            $employee = $this->input->post('nik');
            foreach ($employee as $row):
                if($row != ""){
                    $data2['participants_id']      = $data['exam_id'] . '-' . $row;
                    $data2['nik']                  = $row;
                    $data2['exam_id']              = $data['exam_id'];
                    $data2['participants_status']  = 'Registered';

                    $cek = $this->db->get_where('cbt_participants', array('participants_id' => $data2['participants_id']))->num_rows();
                    if($cek == 0){
                        $this->db->insert('cbt_participants', $data2);
                    }
                }
            endforeach;
        } elseif($data['user_type'] == 'DEPARTMENT'){
            $section = $this->db->get_where('employee', array('section_code' => $this->input->post('section_code'), 'branch_code' => $this->session->userdata('login_branch'), 'employee_status !=' => 'Resign'))->result_array();
            foreach($section as $row2):
                if($row2 != ""){
                    $data3['participants_id']      = $data['exam_id'] . '-' . $row2['nik'];
                    $data3['nik']                  = $row2['nik'];
                    $data3['exam_id']              = $data['exam_id'];
                    $data3['participants_status']  = 'Registered';

                    $this->db->insert('cbt_participants', $data3);
                }
            endforeach;
        } elseif($data['user_type'] == 'ALL'){
            $all = $this->db->get_where('employee', array('branch_code' => $this->session->userdata('login_branch'), 'employee_status !=' => 'Resign'))->result_array();
            foreach($all as $row3):
                if($row3 != ""){
                    $data4['participants_id']      = $data['exam_id'] . '-' . $row3['nik'];
                    $data4['nik']                  = $row3['nik'];
                    $data4['exam_id']              = $data['exam_id'];
                    $data4['participants_status']  = 'Registered';

                    $this->db->insert('cbt_participants', $data4);
                }
            endforeach;
        }

        return true;
    }
    function exam_edit($exam_id = '') {
        $data['exam_name']         = $this->input->post('exam_name');
        $data['exam_start_date']   = $this->input->post('exam_start_date');
        $data['exam_start_time']   = $this->input->post('exam_start_time');
        $data['exam_end_date']     = $this->input->post('exam_end_date');
        $data['exam_end_time']     = $this->input->post('exam_end_time');
        // $data['exam_random']       = $this->input->post('exam_random');
        $data['exam_random']       = 'N';
        // $data['user_type']         = $this->input->post('user_type');
        $data['questionpack_id']   = $this->input->post('questionpack_id');

        $this->db->where('exam_id', $exam_id);
        $this->db->update('cbt_exam', $data);

        return true;
    }
    function exam_delete($exam_id = '') {
        $this->db->where('exam_id', $exam_id);
        $this->db->delete('cbt_exam');

        $this->db->where('exam_id', $exam_id);
        $this->db->delete('cbt_answer');

        $this->db->where('exam_id', $exam_id);
        $this->db->delete('cbt_participants');

        return true;
    }
    function reset_token($exam_id = '') {
        $data['exam_token'] = substr(md5(microtime()),rand(0,26),12);

        $this->db->where('exam_id', $exam_id);
        $this->db->update('cbt_exam', $data);

        return true;
    }


    // ------- PARTICIPANTS ------- //

    function participants_add($param2) {
        $data['participants_id']      = $param2 . '-' . $this->input->post('nik');
        $data['nik']                  = $this->input->post('nik');
        $data['exam_id']              = $param2;
        $data['participants_status']  = 'Registered';

        $cek = $this->db->get_where('cbt_participants', array('participants_id' => $data['participants_id']))->num_rows();
        if($cek == 0){
            $this->db->insert('cbt_participants', $data);
        }

        return true;
    }

    function participants_delete($param2) {
        $this->db->where('participants_id', $param2);
        $this->db->delete('cbt_participants');

        return true;
    }

    // ------- QUESTION PACKAGE ------- //

    function questionpack_add() {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['questionpack_name']         = $this->input->post('questionpack_name');
        $data['questionpack_createdate']   = date('Y-m-d H:i:s');
        $data['questionpack_status']       = 'Draft';
        $data['createby']                  = $this->session->userdata('login_nik');
        $data['regional_code']             = $user->regional_code;
        $data['branch_code']               = $user->branch_code;
        $data['origin_code']               = $user->origin_code;
        $data['zone_code']                 = $user->zone_code;

        $this->db->insert('cbt_questionpack', $data);

        return true;
    }
    function questionpack_edit($param2) {
        $data['questionpack_name']       =   $this->input->post('questionpack_name');
        // $data['questionpack_status']     =   'Draft';

        $this->db->where('questionpack_id', $param2);
        $this->db->update('cbt_questionpack', $data);

        return true;
    }
    function questionpack_delete($param2) {
        $this->db->where('questionpack_id', $param2);
        $this->db->delete('cbt_questionpack');

        $this->db->where('questionpack_id', $param2);
        $this->db->delete('cbt_question');

        return true;
    }
    function questionpack_requestapproval($param2) {
        $data['questionpack_status']       =   'Waiting for SPV Approval';

        $this->db->where('questionpack_id', $param2);
        $this->db->update('cbt_questionpack', $data);

        return true;
    }


    // ------- QUESTION ------- //

    function question_add($param2) {
        $data['questionpack_id']         =   $param2;
        $data['question_question']       =   $this->input->post('question_question');
        $data['question_type']           =   $this->input->post('question_type');
        if($data['question_type'] == 'PG'){
            $data['question_answer_a']       =   $this->input->post('question_answer_a');
            $data['question_answer_b']       =   $this->input->post('question_answer_b');
            $data['question_answer_c']       =   $this->input->post('question_answer_c');
            $data['question_answer_d']       =   $this->input->post('question_answer_d');
            $data['question_answer_e']       =   $this->input->post('question_answer_e');
            $data['question_answer_key']     =   $this->input->post('question_answer_key');
        }
        $data['question_bobot']          =   $this->input->post('question_bobot');
        $data['question_createdate']     =   date('Y-m-d H:i:s');
        $data['createby']                =   $this->session->userdata('login_nik');
        
        if($data['question_type'] == 'PG'){
            if($_FILES['question_question_file']['name'] != '' || $_FILES['question_answer_a_file']['name'] != '' || $_FILES['question_answer_b_file']['name'] != '' || $_FILES['question_answer_c_file']['name'] != '' || $_FILES['question_answer_d_file']['name'] != '' || $_FILES['question_answer_e_file']['name'] != '') {
                if($_FILES['question_question_file']['name'] != '')
                    $data['question_question_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_question_file']['name'])['extension'];
                if($_FILES['question_answer_a_file']['name'] != '')
                    $data['question_answer_a_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_answer_a_file']['name'])['extension'];
                if($_FILES['question_answer_b_file']['name'] != '')
                    $data['question_answer_b_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_answer_b_file']['name'])['extension'];
                if($_FILES['question_answer_c_file']['name'] != '')
                    $data['question_answer_c_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_answer_c_file']['name'])['extension'];
                if($_FILES['question_answer_d_file']['name'] != '')
                    $data['question_answer_d_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_answer_d_file']['name'])['extension'];
                if($_FILES['question_answer_e_file']['name'] != '')
                    $data['question_answer_e_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_answer_e_file']['name'])['extension'];    
            }
        }
        
        $this->db->insert('cbt_question', $data);

        if($data['question_type'] == 'PG'){
            if($_FILES['question_question_file']['name'] != '')
                move_uploaded_file($_FILES['question_question_file']['tmp_name'], 'uploads/cbt/' . $data['question_question_file']);
            if($_FILES['question_answer_a_file']['name'] != '')
                move_uploaded_file($_FILES['question_answer_a_file']['tmp_name'], 'uploads/cbt/' . $data['question_answer_a_file']);
            if($_FILES['question_answer_b_file']['name'] != '')
                move_uploaded_file($_FILES['question_answer_b_file']['tmp_name'], 'uploads/cbt/' . $data['question_answer_b_file']);
            if($_FILES['question_answer_c_file']['name'] != '')
                move_uploaded_file($_FILES['question_answer_c_file']['tmp_name'], 'uploads/cbt/' . $data['question_answer_c_file']);
            if($_FILES['question_answer_d_file']['name'] != '')
                move_uploaded_file($_FILES['question_answer_d_file']['tmp_name'], 'uploads/cbt/' . $data['question_answer_d_file']);
            if($_FILES['question_answer_e_file']['name'] != '')
                move_uploaded_file($_FILES['question_answer_e_file']['tmp_name'], 'uploads/cbt/' . $data['question_answer_e_file']);
        }
        return true;
    }

    function question_edit($param2) {
        $data['question_question']       =   $this->input->post('question_question');
        $data['question_type']           =   $this->input->post('question_type');
        if($data['question_type'] == 'PG'){
            $data['question_answer_a']       =   $this->input->post('question_answer_a');
            $data['question_answer_b']       =   $this->input->post('question_answer_b');
            $data['question_answer_c']       =   $this->input->post('question_answer_c');
            $data['question_answer_d']       =   $this->input->post('question_answer_d');
            $data['question_answer_e']       =   $this->input->post('question_answer_e');
            $data['question_answer_key']     =   $this->input->post('question_answer_key');
        }
        $data['question_bobot']          =   $this->input->post('question_bobot');

        if($data['question_type'] == 'PG'){
            if($_FILES['question_question_file']['name'] != '')
                $data['question_question_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_question_file']['name'])['extension'];
            if($_FILES['question_answer_a_file']['name'] != '')
                $data['question_answer_a_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_answer_a_file']['name'])['extension'];
            if($_FILES['question_answer_b_file']['name'] != '')
                $data['question_answer_b_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_answer_b_file']['name'])['extension'];
            if($_FILES['question_answer_c_file']['name'] != '')
                $data['question_answer_c_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_answer_c_file']['name'])['extension'];
            if($_FILES['question_answer_d_file']['name'] != '')
                $data['question_answer_d_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_answer_d_file']['name'])['extension'];
            if($_FILES['question_answer_e_file']['name'] != '')
                $data['question_answer_e_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['question_answer_e_file']['name'])['extension'];  
        }

        $this->db->where('question_id', $param2);
        $this->db->update('cbt_question', $data);

        if($data['question_type'] == 'PG'){
            if($_FILES['question_question_file']['name'] != '')
                move_uploaded_file($_FILES['question_question_file']['tmp_name'], 'uploads/cbt/' . $data['question_question_file']);
            if($_FILES['question_answer_a_file']['name'] != '')
                move_uploaded_file($_FILES['question_answer_a_file']['tmp_name'], 'uploads/cbt/' . $data['question_answer_a_file']);
            if($_FILES['question_answer_b_file']['name'] != '')
                move_uploaded_file($_FILES['question_answer_b_file']['tmp_name'], 'uploads/cbt/' . $data['question_answer_b_file']);
            if($_FILES['question_answer_c_file']['name'] != '')
                move_uploaded_file($_FILES['question_answer_c_file']['tmp_name'], 'uploads/cbt/' . $data['question_answer_c_file']);
            if($_FILES['question_answer_d_file']['name'] != '')
                move_uploaded_file($_FILES['question_answer_d_file']['tmp_name'], 'uploads/cbt/' . $data['question_answer_d_file']);
            if($_FILES['question_answer_e_file']['name'] != '')
                move_uploaded_file($_FILES['question_answer_e_file']['tmp_name'], 'uploads/cbt/' . $data['question_answer_e_file']);
        }

        return true;
    }
    function question_delete($param2) {
        $this->db->where('question_id', $param2);
        $this->db->delete('cbt_question');

        return true;
    }


    // ------------- REVIEW ESSAY ------------- //

    function essay_submit($param2) {

        $data['answer_score']      = $this->input->post('answer_score');
        if($data['answer_score'] == 0){
            $data['answer_result']     = 'Wrong';
        } else {
            $data['answer_result']     = 'Correct';
        }
        
        $this->db->where('answer_id', $param2);
        $this->db->update('cbt_answer', $data);

        $this->db->from('cbt_answer');
        $this->db->join('cbt_participants', 'cbt_answer.participants_id = cbt_participants.participants_id');
        $this->db->where('answer_id', $param2);
        $participants = $this->db->get();

        $correct = $this->db->get_where('cbt_answer', array('participants_id' => $participants->row()->participants_id, 'answer_result' => 'Correct'));
        $wrong = $this->db->get_where('cbt_answer', array('participants_id' => $participants->row()->participants_id, 'answer_result' => 'Wrong'));

        $this->db->select_sum('answer_score');
        $this->db->from('cbt_answer');
        $this->db->join('cbt_question', 'cbt_answer.question_id = cbt_question.question_id');
        $this->db->where('participants_id', $participants->row()->participants_id);
        $this->db->where('question_type', 'Essay');
        $essay = $this->db->get();
        
        $this->db->select_sum('answer_score');
        $this->db->from('cbt_answer');
        $this->db->where('participants_id', $participants->row()->participants_id);
        $this->db->where('answer_result', 'Correct');
        $score = $this->db->get();

        $data2['participants_correct']  = $correct->num_rows();
        $data2['participants_wrong']    = $wrong->num_rows();
        $data2['participants_essay']    = $essay->row()->answer_score;
        $data2['participants_score']    = $score->row()->answer_score;

        $this->db->where('participants_id', $participants->row()->participants_id);
        $this->db->update('cbt_participants', $data2);

        return true;
    }


    // function question_addessay($param2) {
    //     $data['questionpack_id']         =   $param2;
    //     $data['questionessay_question']       =   $this->input->post('questionessay_question');
    //     $data['questionessay_bobot']          =   $this->input->post('questionessay_bobot');
    //     $data['questionessay_createdate']     =   date('Y-m-d H:i:s');
    //     $data['createby']                = $this->session->userdata('login_nik');
        
    //     if($_FILES['questionessay_question_file']['name'] != '') {
    //         if($_FILES['questionessay_question_file']['name'] != '')
    //             $data['questionessay_question_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['questionessay_question_file']['name'])['extension'];  
    //     }
        
    //     $this->db->insert('cbt_questionessay', $data);

    //     if($_FILES['questionessay_question_file']['name'] != '')
    //         move_uploaded_file($_FILES['questionessay_question_file']['tmp_name'], 'uploads/cbt/' . $data['questionessay_question_file']);

    //     // $data2['questionpack_id']          =   $param2;
    //     // // $data2['questionjoin_order']       =   ;
    //     // $data2['questionjoin_createdate']  =   date('Y-m-d H:i:s');;
    //     // $data2['question_id']              =   $this->db->insert_id();

    //     // $this->db->insert('cbt_questionjoin', $data2);

    //     return true;
    // }

    // function question_editessay($param2) {
    //     $data['questionessay_question']       =   $this->input->post('questionessay_question');
    //     $data['questionessay_bobot']          =   $this->input->post('questionessay_bobot');

    //     if($_FILES['questionessay_question_file']['name'] != '')
    //         $data['questionessay_question_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['questionessay_question_file']['name'])['extension'];

    //     $this->db->where('questionessay_id', $param2);
    //     $this->db->update('cbt_questionessay', $data);

    //     if($_FILES['questionessay_question_file']['name'] != '')
    //         move_uploaded_file($_FILES['questionessay_question_file']['tmp_name'], 'uploads/cbt/' . $data['questionessay_question_file']);

    //     return true;
    // }
    // function question_deleteessay($param2) {
    //     $this->db->where('questionessay_id', $param2);
    //     $this->db->delete('cbt_questionessay');

    //     return true;
    // }


    // -------------- EGD E-ATTENDANCE --------------- //

    function egdattendance_add() {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['egdattendance_name']  = $this->input->post('egdattendance_name');
        $data['egdattendance_place'] = $this->input->post('egdattendance_place');
        $data['egdattendance_date']  = $this->input->post('egdattendance_date');
        $data['egdattendance_time']  = $this->input->post('egdattendance_time');
        $data['egdattendance_token'] = substr(md5(microtime()),rand(0,26),10);
        $data['createby']            = $this->session->userdata('login_nik');
        $data['createdate']          = date('Y-m-d H:i:s');
        $data['regional_code']       = $user->regional_code;
        $data['branch_code']         = $user->branch_code;
        $data['origin_code']         = $user->origin_code;
        $data['zone_code']           = $user->zone_code;

        $this->db->insert('egd_attendance', $data);

        return true;
    }
    function egdattendance_edit($egdattendance_id = '') {
        $data['egdattendance_name']  = $this->input->post('egdattendance_name');
        $data['egdattendance_place'] = $this->input->post('egdattendance_place');
        $data['egdattendance_date']  = $this->input->post('egdattendance_date');
        $data['egdattendance_time']  = $this->input->post('egdattendance_time');

        $this->db->where('egdattendance_id', $egdattendance_id);
        $this->db->update('egd_attendance', $data);

        return true;
    }
    function egdattendance_delete($egdattendance_id = '') {
        $this->db->where('egdattendance_id', $egdattendance_id);
        $this->db->delete('egd_attendance');

        $this->db->where('egdparticipants_id', $egdattendance_id);
        $this->db->delete('egd_participants');

        return true;
    }
    function egdparticipants_delete($egdparticipants_id = '') {
        $this->db->where('egdparticipants_id', $egdparticipants_id);
        $this->db->delete('egd_participants');

        return true;
    }

    
    // -------------- SURVEY --------------- //

    function survey_add() {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['survey_name']        = $this->input->post('survey_name');
        $data['survey_description'] = $this->input->post('survey_description');
        $data['survey_start_date']  = date('Y-m-d');
        $data['survey_start_time']  = date('H:i:s');
        $data['survey_status']      = 'Draft';
        $data['createby']           = $this->session->userdata('login_nik');
        $data['createdate']         = date('Y-m-d H:i:s');
        $data['regional_code']      = $user->regional_code;
        $data['branch_code']        = $user->branch_code;
        $data['origin_code']        = $user->origin_code;
        $data['zone_code']          = $user->zone_code;

        $this->db->insert('survey', $data);

        return true;
    }
    function survey_edit($survey_id = '') {
        $data['survey_name']        = $this->input->post('survey_name');
        $data['survey_description'] = $this->input->post('survey_description');
        $data['survey_end_date']    = $this->input->post('survey_end_date');
        $data['survey_end_time']    = $this->input->post('survey_end_time');
        $data['survey_status']      = $this->input->post('survey_status');

        $this->db->where('survey_id', $survey_id);
        $this->db->update('survey', $data);

        return true;
    }
    function survey_delete($survey_id = '') {
        $this->db->where('survey_id', $survey_id);
        $this->db->delete('survey');

        $this->db->where('survey_id', $survey_id);
        $this->db->delete('survey_question');

        $this->db->where('survey_id', $survey_id);
        $this->db->delete('survey_responds');

        $this->db->where('survey_id', $survey_id);
        $this->db->delete('survey_responden');

        return true;
    }
    function survey_requestapproval($survey_id = '') {
        $data['survey_status']       =   'Waiting for Approval';

        $this->db->where('survey_id', $survey_id);
        $this->db->update('survey', $data);

        return true;
    }


    // -------------- SURVEY QUESTION --------------- //

    function surveyquestion_add($param2) {
        $code = substr(md5(microtime()),rand(0,26),6);
        $data['surveyquestion_id']        = $code;
        $data['surveyquestion_question']  = $this->input->post('surveyquestion_question');
        $data['surveyquestion_type']      = $this->input->post('surveyquestion_type');
        $data['surveyquestion_time']      = date('Y-m-d H:i:s');
        $data['survey_id']                = $param2;
        $data['createby']                 = $this->session->userdata('login_nik');

        $this->db->insert('survey_question', $data);

        if($data['surveyquestion_type'] == 'Radio' || $data['surveyquestion_type'] == 'Checkbox') {
            $question = $this->input->post('surveyquestionoption_option');

            foreach ($question as $row):
                if($row != ""){
                    $data2['surveyquestion_id']           = $code;
                    $data2['surveyquestionoption_option'] = $row;
                    $this->db->insert('survey_question_option', $data2);
                }
            endforeach;
        }

        return true;
    }
    function surveyquestion_edit($param2) {
        $data['surveyquestion_question']  = $this->input->post('surveyquestion_question');
        $data['surveyquestion_type']      = $this->input->post('surveyquestion_type');

        $this->db->where('surveyquestion_id', $param2);
        $this->db->update('survey_question', $data);

        if($data['surveyquestion_type'] == 'Radio' || $data['surveyquestion_type'] == 'Checkbox') {
            // UPDATE EXISTING OPTION
            $surveyquestionoption = $this->db->get_where('survey_question_option', array('surveyquestion_id' => $param2))->result_array();
            foreach ($surveyquestionoption as $row):
                $data2['surveyquestionoption_option'] = $this->input->post('surveyquestionoption_' . $row['surveyquestionoption_id']);

                $this->db->where('surveyquestionoption_id',  $row['surveyquestionoption_id']);
                $this->db->update('survey_question_option', $data2);
            endforeach;

            // CREATE NEW OPTION
            $surveyquestionoption = $this->input->post('surveyquestionoption_option');

            foreach($surveyquestionoption as $row):
                if($row != ""){
                    $data3['surveyquestion_id']            = $param2;
                    $data3['surveyquestionoption_option']  = $row;
                    $this->db->insert('survey_question_option', $data3);
                }
            endforeach;
        }

        return true;
    }
    function surveyquestion_delete($param2) {
        $this->db->where('surveyquestion_id', $param2);
        $this->db->delete('survey_question');

        $this->db->where('surveyquestion_id', $param2);
        $this->db->delete('survey_responds');

        $this->db->where('surveyquestion_id', $param2);
        $this->db->delete('survey_question_option');

        return true;
    }

    function responden_delete($param2) {
        $this->db->where('responden_id', $param2);
        $this->db->delete('survey_responden');

        $this->db->where('responden_id', $param2);
        $this->db->delete('survey_responds');

        return true;
    }


    // ------------- UMRAH --------------- //

    function umrah_edit($param2) {
        $data['umrah_status']  =   $this->input->post('umrah_status');
        $data['umrah_date']    =   $this->input->post('umrah_date');
        $data['approveby']     = $this->session->userdata('login_nik');

        $this->db->where('nik', $param2);
        $this->db->update('umrah', $data);

        return true;
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




    // ------------ SPEAK UP -------------- //

    function speakup_read($speakup_id = '') {
        $data['speakup_status'] = 'Read';
        $data['approveby']      = $this->session->userdata('login_nik');

        $this->db->where('speakup_id', $speakup_id);
        $this->db->update('speakup', $data);

        return true;
    }

}