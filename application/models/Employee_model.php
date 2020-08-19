<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }


    // ------- EMPLOYEE ------- //

    function employee_edit($nik = '') {
        $data['nik']                  = $this->input->post('nik');
        $data['employee_npwp']        = $this->input->post('employee_npwp');
        $data['employee_ktp']         = $this->input->post('employee_ktp');
        $data['employee_ktpexpire']   = $this->input->post('employee_ktpexpire');
        $data['employee_bpjskesehatan']       = $this->input->post('employee_bpjskesehatan');
        $data['employee_bpjsketenagakerjaan'] = $this->input->post('employee_bpjsketenagakerjaan');
        $data['employee_name']        = $this->input->post('employee_name');
        $data['employee_birthplace']  = $this->input->post('employee_birthplace');
        $data['employee_birthdate']   = $this->input->post('employee_birthdate');
        $data['employee_gender']      = $this->input->post('employee_gender');
        $data['employee_marital']     = $this->input->post('employee_marital');
        $data['employee_religion']    = $this->input->post('employee_religion');
        $data['employee_phone']       = $this->input->post('employee_phone');
        $data['employee_phone2']      = $this->input->post('employee_phone2');
        $data['employee_address']     = $this->input->post('employee_address');
        $data['employee_city']        = $this->input->post('employee_city');
        $data['employee_banknumber']  = $this->input->post('employee_banknumber');
        $data['employee_education']   = $this->input->post('employee_education');
        $data['employee_university']  = $this->input->post('employee_university');
        $data['employee_major']       = $this->input->post('employee_major');
        // $data['employee_join']        = $this->input->post('employee_join');
        $data['employee_position']    = $this->input->post('employee_position');
        $data['employee_status']      = $this->input->post('employee_status');
        $data['employee_level']       = $this->input->post('employee_level');
        $data['employee_type']        = $this->input->post('employee_type');
        $data['employee_area']        = $this->input->post('employee_area');
        $data['employee_zona']        = $this->input->post('employee_zona');
        $data['section_code']         = $this->input->post('section_code');
        $data['unit_code']            = $this->input->post('unit_code');
        $data['regional_code']        = $this->input->post('regional_code');
        $data['branch_code']          = $this->input->post('branch_code');
        $data['origin_code']          = $this->input->post('origin_code');
        $data['zone_code']            = $this->input->post('zone_code');
        $data['orion_id']             = $this->input->post('orion_id');
        $data['courier_id']           = $this->input->post('courier_id');
        $data['update_id']            = substr(md5(microtime()),rand(0,26),6);

        $this->db->insert('employee_tmp', $data);

        if($_FILES['userfile']['name'] != '')
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/employee_image/' . $nik . '.jpg');

        $data2['update_id']      = $data['update_id'];
        $data2['update_date']    = date('Y-m-d H:i:s');
        $data2['update_status']  = 'Waiting for Approval';
        $data2['update_type']    = 'Personal';
        $data2['update_process'] = 'Update';
        $data2['nik']            = $this->input->post('nik');

        $this->db->insert('employee_update', $data2);

        return true;
    }


    // ------- ASSET ------- //

    function asset_add($param2) {
        $user = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['nik']                 =   $param2;
        $data['asset_id']            =   substr(md5(microtime()),rand(0,26),6);
        $data['asset_number']        =   $this->input->post('asset_number');
        $data['asset_serialnumber']  =   $this->input->post('asset_serialnumber');
        $data['asset_name']          =   $this->input->post('asset_name');
        $data['asset_merk']          =   $this->input->post('asset_merk');
        $data['asset_model']         =   $this->input->post('asset_model');
        $data['asset_spesification'] =   $this->input->post('asset_spesification');
        $data['asset_date']          =   $this->input->post('asset_date');
        $data['asset_status']        =   'Active';
        $data['update_id']           =   substr(md5(microtime()),rand(0,26),6);
        $data['createby']            = $this->session->userdata('login_nik');
        $data['regional_code']       = $user->regional_code;
        $data['branch_code']         = $user->branch_code;
        $data['origin_code']         = $user->origin_code;
        $data['zone_code']           = $user->zone_code;

        $this->db->insert('asset_tmp', $data);

        $data2['update_id']      = $data['update_id'];
        $data2['update_date']    = date('Y-m-d H:i:s');
        $data2['update_status']  = 'Waiting for Approval';
        $data2['update_type']    = 'Asset';
        $data2['update_process'] = 'Create';
        $data2['nik']            = $data['nik'];

        $this->db->insert('employee_update', $data2);

        return true;
    }
    function asset_edit($param2, $param3) {
        $data['nik']                 =   $param3;
        $data['asset_number']        =   $this->input->post('asset_number');
        $data['asset_serialnumber']  =   $this->input->post('asset_serialnumber');
        $data['asset_name']          =   $this->input->post('asset_name');
        $data['asset_merk']          =   $this->input->post('asset_merk');
        $data['asset_model']         =   $this->input->post('asset_model');
        $data['asset_spesification'] =   $this->input->post('asset_spesification');
        $data['asset_date']          =   $this->input->post('asset_date');
        $data['asset_status']        =   'Active';
        $data['update_id']           =   substr(md5(microtime()),rand(0,26),6);
        $data['asset_id']            =   $param2;

        $this->db->insert('asset_tmp', $data);

        $data2['nik']            = $param3;
        $data2['update_id']      = $data['update_id'];
        $data2['update_date']    = date('Y-m-d H:i:s');
        $data2['update_status']  = 'Waiting for Approval';
        $data2['update_type']    = 'Asset';
        $data2['update_process'] = 'Update';

        $this->db->insert('employee_update', $data2);

        return true;
    }
    function asset_delete($param2, $param3) {
        $data['nik']              = $param3;
        $data['update_id']        = substr(md5(microtime()),rand(0,26),6);
        $data['asset_id']         = $param2;

        $this->db->insert('asset_tmp', $data);

        $data2['nik']            = $param3;
        $data2['update_id']      = $data['update_id'];
        $data2['update_date']    = date('Y-m-d H:i:s');
        $data2['update_status']  = 'Waiting for Approval';
        $data2['update_type']    = 'Asset';
        $data2['update_process'] = 'Delete';

        $this->db->insert('employee_update', $data2);

        return true;
    }


    // ------- FAMILY ------- //

    function family_add($param2) {
        $data['nik']               =   $param2;
        $data['family_id']         =   substr(md5(microtime()),rand(0,26),6);
        $data['family_ktp']        =   $this->input->post('family_ktp');
        $data['family_bpjs']       =   $this->input->post('family_bpjs');
        $data['family_name']       =   $this->input->post('family_name');
        $data['family_status']     =   $this->input->post('family_status');
        $data['update_id']         =   substr(md5(microtime()),rand(0,26),6);

        $this->db->insert('family_tmp', $data);

        $data2['update_id']      = $data['update_id'];
        $data2['update_date']    = date('Y-m-d H:i:s');
        $data2['update_status']  = 'Waiting for Approval';
        $data2['update_type']    = 'Family';
        $data2['update_process'] = 'Create';
        $data2['nik']            = $data['nik'];

        $this->db->insert('employee_update', $data2);

        return true;
    }
    function family_edit($param2, $param3) {
        $data['nik']               =   $param3;
        $data['family_ktp']        =   $this->input->post('family_ktp');
        $data['family_bpjs']       =   $this->input->post('family_bpjs');
        $data['family_name']       =   $this->input->post('family_name');
        $data['family_status']     =   $this->input->post('family_status');
        $data['update_id']         =   substr(md5(microtime()),rand(0,26),6);
        $data['family_id']    =   $param2;

        $this->db->insert('family_tmp', $data);

        $data2['nik']            = $param3;
        $data2['update_id']      = $data['update_id'];
        $data2['update_date']    = date('Y-m-d H:i:s');
        $data2['update_status']  = 'Waiting for Approval';
        $data2['update_type']    = 'Family';
        $data2['update_process'] = 'Update';

        $this->db->insert('employee_update', $data2);

        return true;
    }
    function family_delete($param2, $param3) {
        $data['family_ktp']     = $param2;
        $data['nik']            = $param3;
        $data['update_id']      = substr(md5(microtime()),rand(0,26),6);
        $data['family_id']      = $param2;

        $this->db->insert('family_tmp', $data);

        $data2['nik']            = $param3;
        $data2['update_id']      = $data['update_id'];
        $data2['update_date']    = date('Y-m-d H:i:s');
        $data2['update_status']  = 'Waiting for Approval';
        $data2['update_type']    = 'Family';
        $data2['update_process'] = 'Delete';

        $this->db->insert('employee_update', $data2);

        return true;
    }


    // -------------- RAWAT INAP --------------- //

    function rawatinap_add() {
        $karyawan = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['nik']                   = $this->session->userdata('login_nik');
        $data['rawatinap_coding']      = $karyawan->unit_code;
        $data['rawatinap_keterangan']  = $this->input->post('rawatinap_keterangan');
        $data['rawatinap_tglkwitansi'] = $this->input->post('rawatinap_tglkwitansi');
        $data['rawatinap_jmldiajukan'] = $this->input->post('rawatinap_jmldiajukan');
        $data['rawatinap_applydate']   = date('Y-m-d H:i:s');
        $data['rawatinap_status']      = 'Waiting for Approval';

        if($this->input->post('rawatinap_keterangan') == 'KARYAWAN'){
            $data['rawatinap_namapasien']  = $karyawan->employee_name;
            $data['rawatinap_pergantian']  = '100%';
        } else {
            $data['rawatinap_namapasien']  = $this->input->post('rawatinap_namapasien');
            $data['rawatinap_pergantian']  = '75%%';
        }

        if($this->input->post('rawatinap_rekening') == 'PRIBADI'){
            $data['rawatinap_bank']            = 'BNI';
            $data['rawatinap_rekeningpemilik'] = $karyawan->employee_name;
            $data['rawatinap_rekeningnomor']   = $karyawan->employee_banknumber;
        } else {
            $data['rawatinap_bank']            = $this->input->post('rawatinap_bank');
            $data['rawatinap_rekeningpemilik'] = $this->input->post('rawatinap_rekeningpemilik');
            $data['rawatinap_rekeningnomor']   = $this->input->post('rawatinap_rekeningnomor');
        }

        if($_FILES['rawatinap_file']['name'] != '')
            $data['rawatinap_file']       = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['rawatinap_file']['name'])['extension'];

        $this->db->insert('rawatinap', $data);

        if($_FILES['rawatinap_file']['name'] != '')
            move_uploaded_file($_FILES['rawatinap_file']['tmp_name'], 'uploads/rawatinap/' . $data['rawatinap_file']);

        return true;
    }


    // -------------- RAWAT INAP --------------- //

    function rawatjalan_add() {
        $karyawan = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['nik']                    = $this->session->userdata('login_nik');
        $data['rawatjalan_coding']      = $karyawan->unit_code;
        $data['rawatjalan_keterangan']  = $this->input->post('rawatjalan_keterangan');
        $data['rawatjalan_tglkwitansi'] = $this->input->post('rawatjalan_tglkwitansi');
        $data['rawatjalan_jmldiajukan'] = $this->input->post('rawatjalan_jmldiajukan');
        $data['rawatjalan_applydate']   = date('Y-m-d H:i:s');
        $data['rawatjalan_status']      = 'Waiting for Approval';

        if($this->input->post('rawatjalan_keterangan') == 'KARYAWAN'){
            $data['rawatjalan_namapasien']  = $karyawan->employee_name;
        } else {
            $data['rawatjalan_namapasien']  = $this->input->post('rawatjalan_namapasien');
        }

        if($this->input->post('rawatjalan_rekening') == 'PRIBADI'){
            $data['rawatjalan_bank']            = 'BNI';
            $data['rawatjalan_rekeningpemilik'] = $karyawan->employee_name;
            $data['rawatjalan_rekeningnomor']   = $karyawan->employee_banknumber;
        } else {
            $data['rawatjalan_bank']            = $this->input->post('rawatjalan_bank');
            $data['rawatjalan_rekeningpemilik'] = $this->input->post('rawatjalan_rekeningpemilik');
            $data['rawatjalan_rekeningnomor']   = $this->input->post('rawatjalan_rekeningnomor');
        }

        if($_FILES['rawatjalan_file']['name'] != '')
            $data['rawatjalan_file']       = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['rawatjalan_file']['name'])['extension'];

        $this->db->insert('rawatjalan', $data);

        if($_FILES['rawatjalan_file']['name'] != '')
            move_uploaded_file($_FILES['rawatjalan_file']['tmp_name'], 'uploads/rawatjalan/' . $data['rawatjalan_file']);

        return true;
    }


    // -------------- MELAHIRKAN --------------- //

    function melahirkan_add() {
        $karyawan = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['nik']                    = $this->session->userdata('login_nik');
        $data['melahirkan_coding']      = $karyawan->unit_code;
        $data['melahirkan_keterangan']  = $this->input->post('melahirkan_keterangan');
        $data['melahirkan_persalinan']  = $this->input->post('melahirkan_persalinan');
        $data['melahirkan_tglkwitansi'] = $this->input->post('melahirkan_tglkwitansi');
        $data['melahirkan_jmldiajukan'] = $this->input->post('melahirkan_jmldiajukan');
        $data['melahirkan_applydate']   = date('Y-m-d H:i:s');
        $data['melahirkan_status']      = 'Waiting for Approval';

        if($this->input->post('melahirkan_keterangan') == 'KARYAWAN'){
            $data['melahirkan_namapasien']  = $karyawan->employee_name;
            $data['melahirkan_pergantian']  = '100%';
        } else {
            $data['melahirkan_namapasien']  = $this->input->post('melahirkan_namapasien');
            $data['melahirkan_pergantian']  = '75%';
        }

        if($this->input->post('melahirkan_rekening') == 'PRIBADI'){
            $data['melahirkan_bank']            = 'BNI';
            $data['melahirkan_rekeningpemilik'] = $karyawan->employee_name;
            $data['melahirkan_rekeningnomor']   = $karyawan->employee_banknumber;
        } else {
            $data['melahirkan_bank']            = $this->input->post('melahirkan_bank');
            $data['melahirkan_rekeningpemilik'] = $this->input->post('melahirkan_rekeningpemilik');
            $data['melahirkan_rekeningnomor']   = $this->input->post('melahirkan_rekeningnomor');
        }

        if($_FILES['melahirkan_file']['name'] != '')
            $data['melahirkan_file']       = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['melahirkan_file']['name'])['extension'];

        $this->db->insert('melahirkan', $data);

        if($_FILES['melahirkan_file']['name'] != '')
            move_uploaded_file($_FILES['melahirkan_file']['tmp_name'], 'uploads/melahirkan/' . $data['melahirkan_file']);

        return true;
    }


    // -------------- KACAMATA --------------- //

    function kacamata_add() {
        $karyawan = $this->db->get_where('employee', array('nik' => $this->session->userdata('login_nik')))->row();

        $data['nik']                    = $this->session->userdata('login_nik');
        $data['kacamata_coding']      = $karyawan->unit_code;
        $data['kacamata_keterangan']  = $this->input->post('kacamata_keterangan');
        $data['kacamata_tglkwitansi'] = $this->input->post('kacamata_tglkwitansi');
        $data['kacamata_jmldiajukan'] = $this->input->post('kacamata_jmldiajukan');
        $data['kacamata_applydate']   = date('Y-m-d H:i:s');
        $data['kacamata_status']      = 'Waiting for Approval';

        if($this->input->post('kacamata_rekening') == 'PRIBADI'){
            $data['kacamata_bank']            = 'BNI';
            $data['kacamata_rekeningpemilik'] = $karyawan->employee_name;
            $data['kacamata_rekeningnomor']   = $karyawan->employee_banknumber;
        } else {
            $data['kacamata_bank']            = $this->input->post('kacamata_bank');
            $data['kacamata_rekeningpemilik'] = $this->input->post('kacamata_rekeningpemilik');
            $data['kacamata_rekeningnomor']   = $this->input->post('kacamata_rekeningnomor');
        }

        if($_FILES['kacamata_file']['name'] != '')
            $data['kacamata_file']       = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['kacamata_file']['name'])['extension'];

        $this->db->insert('kacamata', $data);

        if($_FILES['kacamata_file']['name'] != '')
            move_uploaded_file($_FILES['kacamata_file']['tmp_name'], 'uploads/kacamata/' . $data['kacamata_file']);

        return true;
    }


    // -------------- UNIFORM --------------- //

    function uniform_add() {
        $data['nik']                   = $this->session->userdata('login_nik');
        $data['uniformrequest_type']   = $this->input->post('uniformrequest_type');
        $data['uniformstock_code']     = $this->input->post('uniformstock_code');
        $data['uniformrequest_date']   = date('Y-m-d H:i:s');
        $data['uniformrequest_status'] = 'Waiting for Approval';

        $this->db->insert('uniform_request', $data);

        return true;
    }


    // ------- LOAN ------- //

    function loan_add() {
        $loanquota = $this->db->get_where('loan_quota', array('branch_code' => $this->session->userdata('login_branch')))->row();

        $data['nik']                = $this->session->userdata('login_nik');
        $data['loan_phone']         = $this->input->post('loan_phone');
        $data['loan_salary']        = $this->input->post('loan_salary');
        $data['loan_amount']        = $this->input->post('loan_amount');
        $data['loan_tenor']         = $this->input->post('loan_tenor');
        $data['loan_max']           = $this->input->post('loan_max');
        $data['loan_paypermonth']   = $this->input->post('loan_paypermonth');
        $data['loan_purpose']       = $this->input->post('loan_purpose');
        $data['loan_description']   = $this->input->post('loan_description');
        $data['loan_apply']         = date('Y-m-d H:i:s');
        $data['loan_status']        = 'Waiting for SPV Approval';
        $data['loanquota_id']       = $loanquota->loanquota_id;

        $this->db->insert('loan', $data);

        return true;
    }


    // ------- RESIGN ------- //

    function resign_add() {
        $data['nik']                = $this->session->userdata('login_nik');
        $data['resign_reason']      = $this->input->post('resign_reason');
        $data['resign_createdate']  = date('Y-m-d H:i:s');
        $data['resign_status']      = 'Waiting for SPV Approval';
        if($_FILES['resign_file']['name'] != '')
            $data['resign_file'] = $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['resign_file']['name'])['extension'];

        if($_FILES['resign_file']['name'] != '')
            move_uploaded_file($_FILES['resign_file']['tmp_name'], 'uploads/resign/' . $data['resign_file']);

        $this->db->insert('resign', $data);

        return true;
    }


    // ------- CLASS ------- //

    function class_join() {
        $data['nik']                 = $this->session->userdata('login_nik');
        $data['class_id']            = $this->input->post('class_id');
        $data['student_status']      = 'Waiting for SPV Approval';
        $data['student_createdate']  = date('Y-m-d H:i:s');

        $this->db->insert('elearning_student', $data);

        return true;
    }
    function class_leave($param2) {
        $this->db->where('nik', $param2);
        $this->db->delete('elearning_student');

        return true;
    }

    // ------- SURVEY ------- //

    function survey_submit($param2) {
        $question = $this->db->get_where('survey_question', array('survey_id' => $param2));

        for($i = 1; $i <= $question->num_rows(); $i++) {
            $data['responds_id']       = $param2 . '-' . $this->session->userdata('login_nik') . '-' . $this->input->post('surveyquestion_id_'. $i);
            $data['responden_id']      = $param2 . '-' . $this->session->userdata('login_nik');
            $data['survey_id']         = $param2;
            $data['surveyquestion_id'] = $this->input->post('surveyquestion_id_'. $i);
            foreach ($question->result_array() as $row):
                if ($row['surveyquestion_type'] != 'Checkbox'){
                    $data['responds_answer'] = $this->input->post('responds_answer_'. $i);
                } else {
                    $data['responds_answer'] = json_encode($this->input->post('responds_answer_'. $i));
                }
            endforeach;

            $this->db->insert('survey_responds', $data);
        }

        $data2['responden_id']      = $param2 . '-' . $this->session->userdata('login_nik');
        $data2['nik']               = $this->session->userdata('login_nik');
        $data2['survey_id']         = $param2;

        $this->db->insert('survey_responden', $data2);

        return true;
    }


    // ------- APPLICATION ------- //

    function application_apply($param3) {
        $data['nik']                = $this->session->userdata('login_nik');
        $data['vacancy_id']         = $param3;
        $data['application_date']   = date('Y-m-d H:i:s');
        $data['application_status'] = 'Applied';

        $this->db->insert('application', $data);

        return true;
    }


    // ------- EGD ATTENDANCE ------- //

    function egdattendance_attend($param2, $param3) {
        $cek = $this->db->get_where('egd_attendance', array('egdattendance_token' => $param2))->num_rows();

        if($cek > 0){
            $data['egdparticipants_id']      = $param3 . '-' . $this->session->userdata('login_nik');
            $data['egdparticipants_clockin'] = date('Y-m-d H:i:s');
            $data['egdattendance_id']        = $param3;
            $data['nik']                     = $this->session->userdata('login_nik');
            
            $duplicate = $this->db->get_where('egd_participants', array('egdparticipants_id' => $data['egdparticipants_id']))->num_rows();

            if($duplicate == 0){
                $this->db->insert('egd_participants', $data);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function egdattendance_attendmanual() {
        $data['egdparticipants_id']      = $this->input->post('egdattendance_id') . '-' . $this->session->userdata('login_nik');
        $data['egdparticipants_clockin'] = date('Y-m-d H:i:s');
        $data['egdattendance_id']        = $this->input->post('egdattendance_id');
        $data['nik']                     = $this->session->userdata('login_nik');
        
        $duplicate = $this->db->get_where('egd_participants', array('egdparticipants_id' => $data['egdparticipants_id']))->num_rows();

        if($duplicate == 0){
            $this->db->insert('egd_participants', $data);
            return true;
        } else {
            return false;
        }
    }


    // ------- EXAM ------- //

    function view($param2){
        $this->load->library('pagination');
        
		// $query = "SELECT * FROM cbt_exam JOIN cbt_questionpack ON cbt_exam.questionpack_id = cbt_questionpack.questionpack_id JOIN cbt_question ON cbt_question.questionpack_id = cbt_questionpack.questionpack_id WHERE exam_id = '" . $param2 . "'";

        $query = "SELECT * FROM cbt_exam JOIN cbt_questionpack ON cbt_exam.questionpack_id = cbt_questionpack.questionpack_id JOIN cbt_question ON cbt_question.questionpack_id = cbt_questionpack.questionpack_id WHERE exam_id = '" . $param2 . "' ORDER BY question_type DESC";

		$config['base_url'] = base_url('employee/exam/question/'.$param2);
		$config['total_rows'] = $this->db->query($query)->num_rows();
		$config['per_page'] = 1;
        $config['uri_segment'] = 5;
        $config['num_links'] = 1000;
        $config['use_page_numbers'] = TRUE;
        
        $config['full_tag_open']   = '<div class="row justify-content-center">';
        $config['full_tag_close']  = '</div>';

        $config['first_link']      = ''; 
        $config['first_tag_open']  = '<div class="col-3 border border-primary rounded text-center" style="display: none;">';
        $config['first_tag_close'] = '</div>';
        
        $config['last_link']       = ''; 
        $config['last_tag_open']   = '<div class="col-3 border border-primary rounded text-center" style="display: none;">';
        $config['last_tag_close']  = '</div>';
        
        $config['next_link']       = ''; 
        $config['next_tag_open']   = '<div class="col-3 border border-primary rounded text-center" style="display: none;">';
        $config['next_tag_close']  = '</div>';
        
        $config['prev_link']       = ''; 
        $config['prev_tag_open']   = '<div class="col-3 border border-primary rounded text-center" style="display: none;">';
        $config['prev_tag_close']  = '</div>';

        $config['cur_tag_open']    = '<div class="col-3 border border-primary rounded text-center" style="margin: 3px;"><a href="#">';
        $config['cur_tag_close']   = '</a></div>';
        
        $config['num_tag_open']    = '<div class="col-3 border border-primary rounded text-center" style="margin: 3px;">';
        $config['num_tag_close']   = '</div>';
		
		$this->pagination->initialize($config);
		
        $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
        $pages = $page - 1;
        if($pages <= 0 || $page == 0){
            $pages = 0;
        }
		$query .= " LIMIT ".$pages.", ".$config['per_page'];
		
		$data['limit']      = $config['per_page'];
		$data['total_rows'] = $config['total_rows'];
		$data['pagination'] = $this->pagination->create_links();
        $data['soal']       = $this->db->query($query)->result_array();
        $data['soal1']      = $this->db->query($query)->row();
        $data['page_title'] = 'EXAM';
        $data['exam_id']    = $param2;
		
		return $data;
    }

    function exam_answer($param2) {
        $this->db->from('cbt_exam');
        $this->db->join('cbt_questionpack', 'cbt_exam.questionpack_id = cbt_questionpack.questionpack_id');
        $this->db->join('cbt_question', 'cbt_question.questionpack_id = cbt_questionpack.questionpack_id');
        $this->db->where('exam_id', $param2);
        $question = $this->db->get();

        for($i = 1; $i <= $question->num_rows(); $i++) {
            $data['answer_id']       = $param2.'-'.$this->session->userdata('login_nik').'-'.$this->input->post('question_id_'. $i);
            $data['participants_id'] = $param2.'-'.$this->session->userdata('login_nik');
            $data['exam_id']         = $param2;
            $data['question_id']     = $this->input->post('question_id_'. $i);
            $data['answer_answer']   = $this->input->post('answer_answer_'. $i);

            if($this->input->post('answer_answer_'. $i) == $this->input->post('question_answer_key_'. $i)){
                $data['answer_result']   = 'Correct';
            } else {
                $data['answer_result']   = 'Wrong';
            }
            
            $cek = $this->db->get_where('cbt_answer', array('answer_id' => $data['answer_id']))->num_rows();

            if($cek == 0){
                $this->db->insert('cbt_answer', $data);
            } else {
                $this->db->where('answer_id', $data['answer_id']);
                $this->db->update('cbt_answer', $data);
            }
        }

        $correct = $this->db->get_where('cbt_answer', array('participants_id' => $data['participants_id'], 'answer_result' => 'Correct'))->num_rows();
        $wrong = $this->db->get_where('cbt_answer', array('participants_id' => $data['participants_id'], 'answer_result' => 'Wrong'))->num_rows();
        $score = ($correct / $question->num_rows()) * 100;

        $data2['participants_end']      = date('Y-m-d H:i:s');
        $data2['participants_correct']  = $correct;
        $data2['participants_wrong']    = $wrong;
        $data2['participants_score']    = $score;
        $data2['participants_status']   = 'Finished';

        $this->db->where('participants_id', $data['participants_id']);
        $this->db->update('cbt_participants', $data2);

        return true;
    }

    function exam_answer2($param2, $param4, $param5) {
        $this->db->from('cbt_question');
        $this->db->where('question_id', $param4);
        $question = $this->db->get();

        $data['answer_id']       = $param2 . '-' . $this->session->userdata('login_nik') . '-' . $param4;
        $data['participants_id'] = $param2 . '-' . $this->session->userdata('login_nik');
        $data['exam_id']         = $param2;
        $data['question_id']     = $param4;
        $data['answer_answer']   = $param5;
        $data['answer_score']    = $question->row()->question_bobot;
        
        if($param5 == $question->row()->question_answer_key){
            $data['answer_result']   = 'Correct';
        } else {
            $data['answer_result']   = 'Wrong';
        }
        
        $cek = $this->db->get_where('cbt_answer', array('answer_id' => $data['answer_id']))->num_rows();

        if($cek == 0){
            $this->db->insert('cbt_answer', $data);
        } else {
            $this->db->where('answer_id', $data['answer_id']);
            $this->db->update('cbt_answer', $data);
        }

        return true;
    }

    function exam_answeressay($param2, $param4) {
        $this->db->from('cbt_question');
        $this->db->where('question_id', $param4);
        $question = $this->db->get();

        $data['answer_id']       = $param2 . '-' . $this->session->userdata('login_nik') . '-' . $param4;
        $data['participants_id'] = $param2 . '-' . $this->session->userdata('login_nik');
        $data['exam_id']         = $param2;
        $data['question_id']     = $param4;
        $data['answer_answer']   = $this->input->post('answer_answer');
        $data['answer_score']    = $question->row()->question_bobot;
        
        $cek = $this->db->get_where('cbt_answer', array('answer_id' => $data['answer_id']))->num_rows();

        if($cek == 0){
            $this->db->insert('cbt_answer', $data);
        } else {
            $this->db->where('answer_id', $data['answer_id']);
            $this->db->update('cbt_answer', $data);
        }

        return true;
    }

    function exam_finish($param2) {
        // $this->db->from('cbt_exam');
        // $this->db->join('cbt_questionpack', 'cbt_exam.questionpack_id = cbt_questionpack.questionpack_id');
        // $this->db->join('cbt_question', 'cbt_question.questionpack_id = cbt_questionpack.questionpack_id');
        // $this->db->where('exam_id', $param2);
        // $question = $this->db->get();

        $correct = $this->db->get_where('cbt_answer', array('participants_id' => $param2 . '-' . $this->session->userdata('login_nik'), 'answer_result' => 'Correct'));
        $wrong = $this->db->get_where('cbt_answer', array('participants_id' => $param2 . '-' . $this->session->userdata('login_nik'), 'answer_result' => 'Wrong'));
        // $score = ($correct->num_rows() / $question->num_rows()) * 100;

        $this->db->select_sum('answer_score');
        $this->db->from('cbt_answer');
        $this->db->where('participants_id', $param2 . '-' . $this->session->userdata('login_nik'));
        $this->db->where('answer_result', 'Correct');
        $pg = $this->db->get();

        $data2['participants_end']      = date('Y-m-d H:i:s');
        $data2['participants_correct']  = $correct->num_rows();
        $data2['participants_wrong']    = $wrong->num_rows();
        $data2['participants_pg']       = $pg->row()->answer_score;
        $data2['participants_score']    = $pg->row()->answer_score;
        $data2['participants_status']   = 'Finished';

        $this->db->where('participants_id', $param2 . '-' . $this->session->userdata('login_nik'));
        $this->db->update('cbt_participants', $data2);

        return true;
    }



    // -------------- SPEAKUP --------------- //

    function speakup_add() {
        $data['nik']                   = $this->session->userdata('login_nik');
        $data['speakup_subject']       = $this->input->post('speakup_subject');
        $data['speakup_description']   = $this->input->post('speakup_description');
        $data['speakup_createdate']    = date('Y-m-d H:i:s');
        $data['speakup_status']        = 'Unread';

        $this->db->insert('speakup', $data);

        return true;
    }
}

?>