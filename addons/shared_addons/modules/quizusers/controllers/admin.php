<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Admin extends Admin_Controller {

    protected $section = 'items';

    public function __construct() {
        parent::__construct();

        // Load all the required classes
        $this->load->model('quizusers_m');
        $this->load->library('form_validation');
        $this->lang->load('quizusers');

        // Set the validation rules
        $this->item_validation_rules = array(
            "new" => array(
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|max_length[100]|callback_email_check'
                ),
                array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'trim|max_length[100]|callback_username_check'
                ),
                array(
                    'field' => 'firstName',
                    'label' => 'First Name',
                    'rules' => 'trim|max_length[100]'
                ),
                array(
                    'field' => 'lastName',
                    'label' => 'Last Name',
                    'rules' => 'trim|max_length[100]'
                ),
                array(
                    'field' => 'facebookId',
                    'label' => 'Facebook ID',
                    'rules' => 'trim|callback_facebook_id_check'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim'
                )
            ),
            "edit" => array(
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|max_length[100]'
                ),
                array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'trim|max_length[100]'
                ),
                array(
                    'field' => 'firstName',
                    'label' => 'First Name',
                    'rules' => 'trim|max_length[100]'
                ),
                array(
                    'field' => 'lastName',
                    'label' => 'Last Name',
                    'rules' => 'trim|max_length[100]'
                ),
                array(
                    'field' => 'facebookId',
                    'label' => 'Facebook ID',
                    'rules' => 'trim'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim'
                )
            )
        );

        // We'll set the partials and metadata here since they're used everywhere
        $this->template->append_js('module::admin.js')->append_css('module::admin.css');
    }

    /**
     * List all items
     */
    public function index() {
        // here we use MY_Model's get_all() method to fetch everything
        $items = $this->quizusers_m->get_all();

        // Build the view with sample/views/admin/items.php
        $this->template
            ->title($this->module_details['name'])
            ->set('items', $items)
            ->build('admin/items');
    }

    public function create() {
        // Set the validation rules from the array above
        $this->form_validation->set_rules($this->item_validation_rules['new']);
        
        // check if the form validation passed
        if ($this->form_validation->run())
        {
            // See if the model can create the record
            if ($this->quizusers_m->create($this->input->post()))
            {
                // All good...
                $this->session->set_flashdata('success', lang('quizusers.success'));
                redirect('admin/quizusers');
            }
            // Something went wrong. Show them an error
            else
            {
                $this->session->set_flashdata('error', lang('quizusers.error'));
                redirect('admin/quizusers/create');
            }
        }
        

        $quizuser = new stdClass;
        foreach ($this->item_validation_rules['new'] as $rule)
        {
            $quizuser->{$rule['field']} = $this->input->post($rule['field']);
        }

        // Build the view using sample/views/admin/form.php
        $this->template
            ->title($this->module_details['name'], lang('quizusers.new_item'))
            ->set('quizuser', $quizuser)
            ->build('admin/form');
    }

    public function edit($id = 0) {
        $quizuser = $this->quizusers_m->get_by("idUser",$id);

        // Set the validation rules from the array above
        $this->form_validation->set_rules($this->item_validation_rules['edit']);

        // check if the form validation passed
        if ($this->form_validation->run())
        {
            // get rid of the btnAction item that tells us which button was clicked.
            // If we don't unset it MY_Model will try to insert it
            unset($_POST['btnAction']);

            // See if the model can create the record
            if ($this->quizusers_m->update($id, $this->input->post()))
            {
                // All good...
                $this->session->set_flashdata('success', lang('quizusers.success'));
                redirect('admin/quizusers');
            }
            // Something went wrong. Show them an error
            else
            {
                $this->session->set_flashdata('error', lang('quizusers.error'));
                redirect('admin/quizusers/create');
            }
        }

        // Build the view using sample/views/admin/form.php
        $this->template
            ->title($this->module_details['name'], lang('quizusers.edit'))
            ->set('quizuser', $quizuser)
            ->build('admin/form');
    }

    public function delete($id = 0) {
        // make sure the button was clicked and that there is an array of ids
        if (isset($_POST['btnAction']) AND is_array($_POST['action_to']))
        {
            // pass the ids and let MY_Model delete the items
            $this->quizusers_m->delete_many($this->input->post('action_to'));
        }
        elseif (is_numeric($id))
        {
            // they just clicked the link so we'll delete that one
            $this->quizusers_m->delete($id);
        }
        redirect('admin/quizusers');
    }
    
    // The following checks are to make sure we are not inserting duplicate data...

    public function email_check($str) {
        //if(!empty($str) && $this->get_by("email", $str))
        //    return FALSE;
        return TRUE;
    }
    
    public function username_check($str) {
        //if(!empty($str) && $this->get_by("username", $str))
        //    return FALSE;
        return TRUE;
    }
    
    public function facebook_id_check($str) {
        //if(!empty($str) && $this->get_by("facebookId", $str))
        //    return FALSE;
        return TRUE;
    }
}
