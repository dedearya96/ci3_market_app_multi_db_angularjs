<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model');
        $this->load->library('form_validation');
    }

    public function search($name)
    {
        $products = $this->Products_model->searchData($name);
        $jsonData = json_encode($products);
        $this->output->set_output($jsonData);
    }

    public function index()
    {
        $data = $this->Products_model->getAll();
        $jsonData = json_encode($data);
        $this->output->set_output($jsonData);
    }

    public function show($id)
    {
        $data = $this->Products_model->getById($id);
        if ($data) {
            $jsonData = json_encode($data);
            $this->output->set_output($jsonData);
        } else {
            $jsonData = json_encode(['error' => 'Data not found']);
            $this->output->set_output($jsonData);
        }
    }

    public function insert()
    {
        $this->form_validation->set_rules(
            'categories_id',
            'Categories',
            'required'
        );
        if ($this->form_validation->run() == FALSE) {
            $response = array(
                'status' => 'error',
                'message' => validation_errors()
            );
        } else {
            $data = array(
                'categories_id' => $this->input->post('categories_id'),
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $result = $this->Products_model->insertData($data);
            if ($result) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Data inserted successfully'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Failed to insert data'
                );
            }
        }
        $jsonData = json_encode($response);
        $this->output->set_output($jsonData);
    }

    public function update($id)
    {
        $this->form_validation->set_rules(
            'categories_id',
            'Categories',
            'required'
        );
        if ($this->form_validation->run() == FALSE) {
            $response = array(
                'status' => 'error',
                'message' => validation_errors()
            );
        } else {
            $data = array(
                'categories_id' => $this->input->post('categories_id'),
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $result = $this->Products_model->updateData($id, $data);
            if ($result) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Data updated successfully'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Failed to updated data'
                );
            }
        }
        $jsonData = json_encode($response);
        $this->output->set_output($jsonData);
    }

    public function delete($id)
    {
        $result = $this->Products_model->deleteData($id);
        if ($result) {
            $response = array(
                'status' => 'success',
                'message' => 'Data deleted successfully',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Id not found or deletion failed'
            );
        }
        $this->output->set_output(json_encode($response));
    }
}
