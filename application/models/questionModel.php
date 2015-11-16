<?php

/*
 * question model 
 */
class QuestionModel extends CI_Model 
{
    /*
     * contant to hold the table name of the question
     */
    const QUESTION_DB_TABLE = 'question';
    
    /*
     * get all the questions
     */
    function get_questions() {
        $this->db->select('question.*,answer.*');
        $this->db->from($this::QUESTION_DB_TABLE);
        $this->db->join('answer', 'question.question_id = answer.question_id', 'right'); 
        $query = $this->db->get();

        return $query->result_array();
    }
    
    /*
     * get questions for a quiz
     */
    public function get_questions_for_quiz($quizID)
    {   
        $this->db->select('question.question_id, question.question_text, question.answer_number');
        $this->db->from('question');
        $this->db->where('question.quiz_id', $quizID);
        return $this->db->get()->result_array();
    }
    
    /*
     * get question by question ID
     */
    public function get_question($questionID)
    {   
        $this->db->select('question.*');
        $this->db->from('question');
        $this->db->where('question.question_id', $questionID);
        return $this->db->get()->result_array();
    }
}

