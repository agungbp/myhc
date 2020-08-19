<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    // // ------- LOAN ------- //

    // function mpp_add() {
    //     $data['nik']               = $this->session->userdata('login_nik');
    //     $data['mpp_numberofneeds'] = $this->input->post('mpp_numberofneeds');
    //     $data['mpp_position']      = $this->input->post('mpp_position');
    //     $data['section_code']      = $this->input->post('section_code');
    //     $data['unit_code']         = $this->input->post('unit_code');
    //     $data['zone_code']         = $this->input->post('zone_code');
    //     $data['mpp_requirements']  = $this->input->post('mpp_requirements');
    //     $data['mpp_jobdesc']       = $this->input->post('mpp_jobdesc');
    //     $data['mpp_date']          = date('Y-m-d');
    //     $data['mpp_status']        = 'Waiting for Approval';
    //     $data['mpp_file']          = $this->input->post('section_code') . '_' . $this->input->post('unit_code') . '_' . date('Y-m-d') . '_' . $_FILES['mpp_file']['name'];

    //     $this->db->insert('mpp', $data);

    //     if($_FILES['mpp_file']['name'] != '')
    //          move_uploaded_file($_FILES['mpp_file']['tmp_name'], 'uploads/mpp/' . $data['mpp_file']);

    //     return true;
    // }

    // function mpp_edit($mpp_id = '') {
    //     $data['mpp_numberofneeds'] = $this->input->post('mpp_numberofneeds');
    //     $data['mpp_position']      = $this->input->post('mpp_position');
    //     $data['section_code']      = $this->input->post('section_code');
    //     $data['unit_code']         = $this->input->post('unit_code');
    //     $data['zone_code']         = $this->input->post('zone_code');
    //     $data['mpp_requirements']  = $this->input->post('mpp_requirements');
    //     $data['mpp_jobdesc']       = $this->input->post('mpp_jobdesc');
    //     $data['mpp_date']          = date('Y-m-d');
    //     $data['mpp_status']        = 'Waiting for Approval';
    //     $data['mpp_note']          = null;
    //     if($_FILES['mpp_file']['name'] != '')
    //         $data['mpp_file'] = $this->input->post('section_code') . '_' . $this->input->post('unit_code') . '_' . date('Y-m-d') . '_' . $_FILES['mpp_file']['name'];

    //     $this->db->where('mpp_id', $mpp_id);
    //     $this->db->update('mpp', $data);

    //     if($_FILES['mpp_file']['name'] != '')
    //         move_uploaded_file($_FILES['mpp_file']['tmp_name'], 'uploads/mpp/' . $data['mpp_file']);

    //     return true;
    // }

}

?>