<?php defined('BASEPATH') or exit('No direct script access allowed');

class Categories_model extends CI_Model
{
    private $_table = "categories";
    public $id;
    public $name;
    public $created_at;
    public $updated_at;
    public function rules()
    {
        return [
            [
                'filed' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        // return $this->db->get($this->_table)->result();
        $query = $this->db->query('SELECT * FROM categories');
        $result = $query->result();
        return $result;
    }
}
