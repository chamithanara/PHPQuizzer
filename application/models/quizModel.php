<?php

/*
 * quiz model 
 */
class QuizModel extends CI_Model 
{
    /*
     * constant to hold the table name of quiz
     */
    const QUIZ_DB_TABLE = 'quiz';
    
    /*
     * get all the quizzes
     */
    function get_quizzes() {
        $data = $this->db->get($this::QUIZ_DB_TABLE)->result_array();
        return $data;
    }
    
    /*
     * get data for quiz ID
     */
    public function get_quiz($quizID)
    {   
        $this->db->select('quiz.*');
        $this->db->from('quiz');
        $this->db->where('quiz.quiz_id', $quizID);
        return $this->db->get()->result_array();
    }
}

