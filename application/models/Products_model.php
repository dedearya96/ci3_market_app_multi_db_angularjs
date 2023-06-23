<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function searchData($name)
    {
        $this->db->select('p.id, c.name AS category, p.name, p.price, p.description, p.created_at, p.updated_at');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.categories_id');
        $this->db->like('p.name', $name);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAll()
    {
        $query = $this->db->query('SELECT p.id, c.name AS category, p.name, p.price, p.description, p.created_at, p.updated_at FROM products p JOIN categories c ON c.id= p.categories_id');
        $result = $query->result();
        return $result;
    }

    public function getById($id)
    {
        $query = $this->db->get_where('products', ['id' => $id]);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function insertData($data)
    {
        return $this->db->insert('products', $data);
    }

    public function updateData($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('products', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('products');
        return $this->db->affected_rows() > 0;
    }
}
