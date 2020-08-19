<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Get_model extends CI_Model {

    function get_image_url($type = '', $nik = '') {
        if (file_exists('uploads/' . $type . '_image/' . $nik . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $nik . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    function get_image_vacancy_url1($vacancy_image = '') {
        if (file_exists('uploads/vacancy/' . $vacancy_image))
            $image_url = base_url() . 'uploads/vacancy/' . $vacancy_image;
        else
            $image_url = base_url() . 'uploads/vacancy.jpg';

        return $image_url;
    }

    function get_image_vacancy_url() {
        $image_url = base_url() . 'uploads/vacancy.jpg';

        return $image_url;
    }

    function get_image_question_url($question_question_file = '') {
        if (file_exists('uploads/cbt/' . $question_question_file))
            $image_url = base_url() . 'uploads/cbt/' . $question_question_file;
        else    
            $image_url = '';

        return $image_url;
    }

    function get_image_qrcode_url($nik = '') {
        if (file_exists('uploads/qrcode/' . $nik  . '.png'))
            $image_url = base_url() . 'uploads/qrcode/' . $nik . '.png';
        else    
            $image_url = '';

        return $image_url;
    }

    function get_image_vacancy_qrcode_url($vacancy_id = '') {
        if (file_exists('uploads/vacancy_qrcode/' . $vacancy_id  . '.png'))
            $image_url = base_url() . 'uploads/vacancy_qrcode/' . $vacancy_id . '.png';
        else    
            $image_url = '';

        return $image_url;
    }

    function get_image_egdattendance_qrcode_url($egdattendance_token = '') {
        if (file_exists('uploads/egdattendance_qrcode/' . $egdattendance_token  . '.png'))
            $image_url = base_url() . 'uploads/egdattendance_qrcode/' . $egdattendance_token . '.png';
        else    
            $image_url = '';

        return $image_url;
    }

}

?>