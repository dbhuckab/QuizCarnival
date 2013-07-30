<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Personality_quizzes_m extends MY_Model {
    private $quiz_type = "personality_quiz";
            
    public function __construct()
    {		
        parent::__construct();
        $this->set_dbprefix('');
        $this->primary_key = "idQuiz";
        $this->_table = 'qc_quiz';
    }

    //create a new item
    public function create($input)
    {
        // Lots of input for a quiz.... basics (qc_quiz table)
        // See other models for questions, answers, etc...

        $to_insert = array(
            "User_idUser" => $input['qc_idUser'],
            "slug"        => $input['slug'],
            "title"       => $input['title'],
            "description" => $input['description'],
            "image"       => $input['image'],
            "is_hidden"   => $input['is_hidden'],
            "type"        => $this->quiz_type,
            "category"    => $input['category']
        );


        return $this->db->insert('qc_quiz', $to_insert);
    }



}
