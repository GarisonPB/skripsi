<?php

class Input_Data extends CI_Controller
{
    function index()
    {        
    	$this->load->view('admin/v_admin_side_navbar' );        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/input/v_input_data');
        
    }
}