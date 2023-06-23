<?php defined('BASEPATH') or exit('No direct script access allowed');

class Categories_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function searchData($name)
    {
        $this->db->like('name', $name);
        $query = $this->db->get('categories');
        return $query->result();
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

    public function categoryExists($category_id) {
        $this->db->where('id', $category_id);
        $query = $this->db->get('categories');
        
        return $query->num_rows() > 0;
    }
}
