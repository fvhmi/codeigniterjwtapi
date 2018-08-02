<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
       
    require APPPATH . 'controllers/Rest.php';
    
    class Api extends Rest
    {

        function __construct($config = 'rest')
        {
            parent::__construct($config);
            $this->load->database();
            $this->cektoken();
        }

        /* index page */
        function index_get($table = '', $id = '')
        {
            if ($table == '') {
                redirect(base_url());
            } else {
                $get_id = 'id';
                if ($id == '') {
                // baseurl/?table=nama_table (semua data)
                    $data = $this->db->get($table)->result();
                } else {
                // baseurl/?table=nama_table&id=id (satu data)
                    $this->db->where($get_id, $id);
                    $data = $this->db->get($table)->result();
                }
                $this->response(["data" => $data,'status'=>'success',], 200);
            }
        }

        function index_post($table = '')
        { // baseurl/?table=nama_table
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('image', 'Image', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');

            if ($this->form_validation->run() == TRUE)
            {
                $insert = $this->db->insert($table, $this->post());
                $id = $this->db->insert_id();
                if ($insert) {
                    $response = array(
                        'data' => $this->post(),
                        'table' => $table,
                        'id' => $id,
                        'status' => 'success'
                        );
                    $this->response($response, 200);
                } else {
                    $this->response(['status' => 'fail', 502]);
                }
            } else {
                $this->response([
                    'status' => 'error',
                    // 'msg'   => validation_errors(),
                    'name' => form_error('name'),
                    'description' => form_error('description'),
                    'price' => form_error('price'),
                    'image' => form_error('image')
                ]);
            }
        }

        function index_put($table = '', $id = '')
        { // baseurl/nama_table/id
            $this->load->library('form_validation');

            $data = $this->put();

            $this->form_validation->set_data($data);

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('image', 'Image', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');

            if ($this->form_validation->run() == TRUE)
            {
                $get_id = 'id';
                $this->db->where($get_id, $id);
                $update = $this->db->update($table, $this->put());
                if ($update) {
                    $response = array(
                        'data' => $this->put(),
                        'table' => $table,
                        'id' => $id,
                        'status' => 'success'
                        );
                    $this->response($response, 200);
                } else {
                    $this->response(['status' => 'fail', 502]);
                }
            } else {
                $this->response([
                    'status' => 'error',
                    // 'msg'   => validation_errors(),
                    'name' => form_error('name'),
                    'description' => form_error('description'),
                    'price' => form_error('price'),
                    'image' => form_error('image')
                ]);
            }
        }

        function index_delete($table = '', $id = '')
        {
            $get_id = 'id';
            $this->db->where($get_id, $id);
            $delete = $this->db->delete($table);
            if ($delete) {
                $response = array(
                    'table' => $table,
                    'id' => $id,
                    'status' => 'success'
                    );
                $this->response($response, 201);
            } else {
                $this->response(['status' => 'fail', 502]);
            }
        }
    }