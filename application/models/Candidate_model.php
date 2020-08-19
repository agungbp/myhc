<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Candidate_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function candidate_edit() {
        $data['candidate_ktpexpire']        = $this->input->post('candidate_ktpexpire');
        $data['candidate_birthplace']       = $this->input->post('candidate_birthplace');
        $data['candidate_birthdate']        = $this->input->post('candidate_birthdate');
        $data['candidate_gender']           = $this->input->post('candidate_gender');
        $data['candidate_marital']          = $this->input->post('candidate_marital');
        $data['candidate_religion']         = $this->input->post('candidate_religion');
        $data['candidate_phone']            = $this->input->post('candidate_phone');
        $data['candidate_phone2']           = $this->input->post('candidate_phone2');
        $data['candidate_address']          = $this->input->post('candidate_address');
        $data['candidate_city']             = $this->input->post('candidate_city');
        $data['candidate_education']        = $this->input->post('candidate_education');
        $data['candidate_university']       = $this->input->post('candidate_university');
        $data['candidate_major']            = $this->input->post('candidate_major');
        $data['candidate_gpa']              = $this->input->post('candidate_gpa');
        
        $this->db->where('candidate_ktp', $this->session->userdata('login_nik'));
        $this->db->update('candidate', $data);

        if($_FILES['userfile']['name'] != '')
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/candidate_image/' . $this->session->userdata('login_nik') . '.jpg');

        return true;
    }


    // ------- FAMILY ------- //

    function family_add() {
        $data['nik']               =   $this->session->userdata('login_nik');
        $data['family_ktp']        =   $this->input->post('family_ktp');
        $data['family_status']     =   $this->input->post('family_status');
        $data['family_name']       =   $this->input->post('family_name');

        $this->db->insert('family', $data);

        return true;
    }

    function family_edit($param2) {
        $data['family_ktp']        =   $this->input->post('family_ktp');
        $data['family_status']     =   $this->input->post('family_status');
        $data['family_name']       =   $this->input->post('family_name');

        $this->db->where('family_id', $param2);
        $this->db->update('family', $data);

        return true;
    }

    function family_delete($param2) {
        $this->db->where('family_id', $param2);
        $this->db->delete('family');

        return true;
    }


    // ------- EDUCATION ------- //

    function education_add() {
        $data['nik']                  =   $this->session->userdata('login_nik');
        $data['education_level']      =   $this->input->post('education_level');
        $data['education_university'] =   $this->input->post('education_university');
        $data['education_major']      =   $this->input->post('education_major');
        $data['education_gpa']        =   $this->input->post('education_gpa');
        $data['education_yearstart']  =   $this->input->post('education_yearstart');
        $data['education_yearend']    =   $this->input->post('education_yearend');

        $this->db->insert('education', $data);

        return true;
    }

    function education_edit($param2) {
        $data['education_level']      =   $this->input->post('education_level');
        $data['education_university'] =   $this->input->post('education_university');
        $data['education_major']      =   $this->input->post('education_major');
        $data['education_gpa']        =   $this->input->post('education_gpa');
        $data['education_yearstart']  =   $this->input->post('education_yearstart');
        $data['education_yearend']    =   $this->input->post('education_yearend');

        $this->db->where('education_id', $param2);
        $this->db->update('education', $data);

        return true;
    }

    function education_delete($param2) {
        $this->db->where('education_id', $param2);
        $this->db->delete('education');

        return true;
    }


    // ------- CERTIFICATION ------- //

    function certification_add($param2) {
        $data['nik']                     =   $this->session->userdata('login_nik');
        $data['certification_number']    =   $this->input->post('certification_number');
        $data['certification_name']      =   $this->input->post('certification_name');
        $data['certification_organizer'] =   $this->input->post('certification_organizer');
        $data['certification_year']      =   $this->input->post('certification_year');
        if($_FILES['certification_file']['name'] != '')
            $data['certification_file']      =   $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['certification_file']['name'])['extension'];

        $duplicate = $this->db->get_where('certification', array('certification_number' => $this->input->post('certification_number')))->num_rows();

        if($duplicate == 0){
            $this->db->insert('certification', $data);

            if($_FILES['certification_file']['name'] != '')
                move_uploaded_file($_FILES['certification_file']['tmp_name'], 'uploads/file/certification/' . $data['certification_file']);
    
            return true;
        } else {
            return false;
        }
    }

    function certification_edit($param2) {
        $data['certification_number']    =   $this->input->post('certification_number');
        $data['certification_name']      =   $this->input->post('certification_name');
        $data['certification_organizer'] =   $this->input->post('certification_organizer');
        $data['certification_year']      =   $this->input->post('certification_year');
        if($_FILES['certification_file']['name'] != '')
            $data['certification_file']  =   $this->session->userdata('login_nik') . '_' . date('YmdHis') . '.' . pathinfo($_FILES['certification_file']['name'])['extension'];

        $this->db->where('certification_number', $param2);
        $this->db->update('certification', $data);

        if($_FILES['certification_file']['name'] != '')
            move_uploaded_file($_FILES['certification_file']['tmp_name'], 'uploads/file/certification/' . $data['certification_file']);

        return true;
    }

    function certification_delete($param2) {
        $this->db->where('certification_number', $param2);
        $this->db->delete('certification');

        return true;
    }


    // ------- ORGANIZATION ------- //

    function organization_add() {
        $data['nik']                     =   $this->session->userdata('login_nik');
        $data['organization_type']       =   $this->input->post('organization_type');
        $data['organization_name']       =   $this->input->post('organization_name');
        $data['organization_position']   =   $this->input->post('organization_position');
        $data['organization_yearstart']  =   $this->input->post('organization_yearstart');
        $data['organization_yearend']    =   $this->input->post('organization_yearend');

        $this->db->insert('organization', $data);

        return true;
    }

    function organization_edit($param2) {
        $data['organization_type']       =   $this->input->post('organization_type');
        $data['organization_name']       =   $this->input->post('organization_name');
        $data['organization_position']   =   $this->input->post('organization_position');
        $data['organization_yearstart']  =   $this->input->post('organization_yearstart');
        $data['organization_yearend']    =   $this->input->post('organization_yearend');

        $this->db->where('organization_id', $param2);
        $this->db->update('organization', $data);

        return true;
    }

    function organization_delete($param2) {
        $this->db->where('organization_id', $param2);
        $this->db->delete('organization');

        return true;
    }


    // ------- COMPANY ------- //

    function company_add() {
        $data['nik']               =   $this->session->userdata('login_nik');
        $data['company_type']      =   $this->input->post('company_type');
        $data['company_name']      =   $this->input->post('company_name');
        $data['company_position']  =   $this->input->post('company_position');
        $data['company_status']    =   $this->input->post('company_status');
        $data['company_yearstart'] =   $this->input->post('company_yearstart');
        $data['company_yearend']   =   $this->input->post('company_yearend');
        $data['company_jobdesc']   =   $this->input->post('company_jobdesc');

        $this->db->insert('company', $data);

        return true;
    }

    function company_edit($param2) {
        $data['company_type']      =   $this->input->post('company_type');
        $data['company_name']      =   $this->input->post('company_name');
        $data['company_position']  =   $this->input->post('company_position');
        $data['company_status']    =   $this->input->post('company_status');
        $data['company_yearstart'] =   $this->input->post('company_yearstart');
        $data['company_yearend']   =   $this->input->post('company_yearend');
        $data['company_jobdesc']   =   $this->input->post('company_jobdesc');

        $this->db->where('company_id', $param2);
        $this->db->update('company', $data);

        return true;
    }

    function company_delete($param2) {
        $this->db->where('company_id', $param2);
        $this->db->delete('company');

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


    // ------- EXAM ------- //

    function view($param2){
        $this->load->library('pagination');
        
		// $query = "SELECT * FROM cbt_exam JOIN cbt_questionpack ON cbt_exam.questionpack_id = cbt_questionpack.questionpack_id JOIN cbt_question ON cbt_question.questionpack_id = cbt_questionpack.questionpack_id WHERE exam_id = '" . $param2 . "'";

        $query = "SELECT * FROM cbt_exam JOIN cbt_questionpack ON cbt_exam.questionpack_id = cbt_questionpack.questionpack_id JOIN cbt_question ON cbt_question.questionpack_id = cbt_questionpack.questionpack_id WHERE exam_id = '" . $param2 . "' ORDER BY question_type DESC";

		$config['base_url'] = base_url('candidate/exam/question/'.$param2);
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
}

?>