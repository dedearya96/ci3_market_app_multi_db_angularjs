<?php defined('BASEPATH') or exit('No direct script access allowed');

class Categories_model extends CI_Model
{
    protected $created_at_field = 'created_at';
    protected $updated_at_field = 'updated_at';
    private $_table = "categories";
    public $id;
    public $name;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        parent::__construct();
    }

    public function before_insert($data)
    {
        $data[$this->created_at_field] =  date('Y-m-d H:i:s');
        $data[$this->created_at_field] = date('Y-m-d H:i:s');
    }

    public function before_update($data)
    {
        $data[$this->updated_at_field] = date('Y-m-d H:i:s');
        return $data;
    }


    public function getAll()
    {
        $query = $this->db->query('SELECT * FROM categories');
        $result = $query->result();
        return $result;
    }

    public function getById($id)
    {
        $query = $this->db->get_where('categories', ['id' => $id]);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function insertData($data)
    {
        return $this->db->insert('categories', $data);
    }

    public function updateData($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('categories', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('categories');
        
        return $this->db->affected_rows() > 0;
    }
}
