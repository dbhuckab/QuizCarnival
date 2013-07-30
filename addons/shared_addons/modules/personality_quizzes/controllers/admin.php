<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Admin extends Admin_Controller {

    protected $section = 'items';

    public function __construct() {
        parent::__construct();

        // Load all the required classes
        $this->load->model('personality_quizzes_m');
        $this->load->library('form_validation');
        
        // Files
        $this->config->load('files');
        $this->lang->load('files');
        $this->load->library('files/files');
        
        $this->template->append_metadata(
            "<script>
                    pyro.lang.fetching = '".lang('files:fetching')."';
                    pyro.lang.fetch_completed = '".lang('files:fetch_completed')."';
                    pyro.lang.start = '".lang('files:start')."';
                    pyro.lang.width = '".lang('files:width')."';
                    pyro.lang.height = '".lang('files:height')."';
                    pyro.lang.ratio = '".lang('files:ratio')."';
                    pyro.lang.full_size = '".lang('files:full_size')."';
                    pyro.lang.cancel = '".lang('buttons:cancel')."';
                    pyro.lang.synchronization_started = '".lang('files:synchronization_started')."';
                    pyro.lang.untitled_folder = '".lang('files:untitled_folder')."';
                    pyro.lang.exceeds_server_setting = '".lang('files:exceeds_server_setting')."';
                    pyro.lang.exceeds_allowed = '".lang('files:exceeds_allowed')."';
                    pyro.files = { permissions : ".json_encode(Files::allowed_actions())." };
                    pyro.files.max_size_possible = '".Files::$max_size_possible."';
                    pyro.files.max_size_allowed = '".Files::$max_size_allowed."';
                    pyro.files.valid_extensions = '".implode('|', $allowed_extensions)."';
                    pyro.lang.file_type_not_allowed = '".addslashes(lang('files:file_type_not_allowed'))."';
                    pyro.lang.new_folder_name = '".addslashes(lang('files:new_folder_name'))."';
                    pyro.lang.alt_attribute = '".addslashes(lang('files:alt_attribute'))."';

                    // deprecated
                    pyro.files.initial_folder_contents = ".(int)$this->session->flashdata('initial_folder_contents').";
            </script>");
        
        
        $this->lang->load('personality_quizzes');

        // Set the validation rules
        $this->item_validation_rules = array(
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
        );

        // We'll set the partials and metadata here since they're used everywhere
        $this->template->append_js('module::admin.js')->append_css('module::admin.css');
    }

    /**
     * List all items
     */
    public function index() {
        // here we use MY_Model's get_all() method to fetch everything
        $items = $this->personality_quizzes_m->get_all();

        // Build the view with sample/views/admin/items.php
        $this->template
            ->title($this->module_details['name'])
            ->set('items', $items)
            ->build('admin/items');
    }

    public function create() {
        // Set the validation rules from the array above
        $this->form_validation->set_rules($this->item_validation_rules);
        
        // check if the form validation passed
        if ($this->form_validation->run())
        {
            // See if the model can create the record
            if ($this->personality_quizzes_m->create($this->input->post()))
            {
                // All good...
                $this->session->set_flashdata('success', lang('personality_quizzes.success'));
                redirect('admin/personality_quizzes');
            }
            // Something went wrong. Show them an error
            else
            {
                $this->session->set_flashdata('error', lang('personality_quizzes.error'));
                redirect('admin/personality_quizzes/create');
            }
        }
        

        $quiz = new stdClass;
        foreach ($this->item_validation_rules['new'] as $rule)
        {
            $quiz->{$rule['field']} = $this->input->post($rule['field']);
        }
        // Build the view using sample/views/admin/form.php
        $this->template
            ->title($this->module_details['name'], lang('personality_quizzes.new_item'))
            ->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
            ->set('quiz', $quiz)
            ->append_css('jquery/jquery.tagsinput.css')
            ->append_css('module::jquery.fileupload-ui.css')
            ->append_css('module::files.css')
            ->append_js('jquery/jquery.tagsinput.js')
            ->append_js('module::jquery.fileupload.js')
            ->append_js('module::jquery.fileupload-ui.js')
            ->append_js('module::functions.js')
            ->build('admin/form');
    }

    public function edit($id = 0) {
        $quiz = $this->personality_quizzes_m->get_by("idQuiz",$id);

        // Set the validation rules from the array above
        $this->form_validation->set_rules($this->item_validation_rules);

        // check if the form validation passed
        if ($this->form_validation->run())
        {
            // get rid of the btnAction item that tells us which button was clicked.
            // If we don't unset it MY_Model will try to insert it
            unset($_POST['btnAction']);

            // See if the model can create the record
            if ($this->personality_quizzes_m->update($id, $this->input->post()))
            {
                // All good...
                $this->session->set_flashdata('success', lang('personality_quizzes.success'));
                redirect('admin/personality_quizzes');
            }
            // Something went wrong. Show them an error
            else
            {
                $this->session->set_flashdata('error', lang('personality_quizzes.error'));
                redirect('admin/personality_quizzes/create');
            }
        }

        // Build the view using sample/views/admin/form.php
        $this->template
            ->title($this->module_details['name'], lang('personality_quizzes.edit'))
            ->set('quiz', $quiz)
            ->build('admin/form');
    }

    public function delete($id = 0) {
        // make sure the button was clicked and that there is an array of ids
        if (isset($_POST['btnAction']) AND is_array($_POST['action_to']))
        {
            // pass the ids and let MY_Model delete the items
            $this->personality_quizzes_m->delete_many($this->input->post('action_to'));
        }
        elseif (is_numeric($id))
        {
            // they just clicked the link so we'll delete that one
            $this->personality_quizzes_m->delete($id);
        }
        redirect('admin/personality_quizzes');
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
