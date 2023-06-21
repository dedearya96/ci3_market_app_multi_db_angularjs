<?php defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Categories_model');
        $this->load->library('form_validation');
       
    }

    public function index()
    {
        $data["categories" ]= $this->Categories_model->getAll();
        $this->load->view("category/list", $data);
        // $json = json_encode($data);
        // echo $json;
    }
}