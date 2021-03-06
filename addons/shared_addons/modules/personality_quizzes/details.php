<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_Personality_quizzes extends Module {

    public $version = '2.1';

    public function info() {
        return array(
            'name' => array(
                'en' => 'Personality Quizzes'
            ),
            'description' => array(
                'en' => 'List and manage personality quizzes.'
            ),
            'frontend' => TRUE,
            'backend'  => TRUE,
            'menu'     => 'content', // You can also place modules in their top level menu. For example try: 'menu' => 'Sample',
            'sections' => array(
                'items' => array(
                    'name' => 'personality_quizzes:items', // These are translated from your language file
                    'uri' => 'admin/personality_quizzes',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'personality_quizzes:create',
                            'uri' => 'admin/personality_quizzes/create'
                        )
                    )
                )
            )
        );
    }

    public function install() {
        return true;
    }

    public function uninstall() {
        return true;
    }

    public function upgrade($old_version) {
        // Your Upgrade Logic
        return TRUE;
    }

    public function help() {
        // Return a string containing help info
        // You could include a file and return it here.
        return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
    }

}

/* End of file details.php */
