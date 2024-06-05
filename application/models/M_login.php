<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function checkUsernamePassword()
    {
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');

        $this->db->select('*');
        $this->db->from('login');
        $this->db->where('visible', 1);
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get();
        return $query->row();
    }

    function checkUsernameExist()
    {
        $username     = $this->input->post('username');

        $this->db->select('*');
        $this->db->from('login');
        $this->db->where('visible', 1);
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row();
    }

    function checkPassword()
    {
        $this->db->select('*');
        $this->db->from('login');
        $this->db->where('visible', 1);
        $this->db->where('idLogin', $this->session->userdata('idLogin'));
        $this->db->where('password', $this->input->post('password'));
        $query = $this->db->get();
        return $query->row();
    }

    function getAll()
    {
        $this->db->select('*');
        $this->db->from('login');
        $this->db->where('visible', 1);
        $this->db->order_by('idLogin', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function getById($id)
    {
        $this->db->select('*');
        $this->db->from('login');
        $this->db->where('visible', 1);
        $this->db->where('idLogin', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function save()
    {
        $this->db->trans_begin();

        $data['nama'] = $this->input->post('nama');
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');

        $this->db->insert('login', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function update($id)
    {
        $this->db->trans_begin();

        $data['nama'] = $this->input->post('nama');
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');

        $this->db->where('idLogin', $id);
        $this->db->update('login', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function delete($id)
    {
        $this->db->trans_begin();

        $data['visible'] = 0;

        $this->db->where('idLogin', $id);
        $this->db->update('login', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
}
