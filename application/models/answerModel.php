<?php

/*
 * answer model 
 */
class AnswerModel extends CI_Model 
{
    /*
     * constant to hold the answer table name
     */
    const ANSWER_DB_TABLE = 'answer';
    
    /*
     * get all the answers for question IDs
     */
    public function get_answers_questions($questions)
    {   
        $questionsData = array();
        foreach ($questions as $value) {
            $this->db->select('answer.*');
            $this->db->from($this::ANSWER_DB_TABLE);
            $this->db->where('answer.question_id', $value['question_id']);
            $results = $this->db->get()->result_array();
            //print_r($results);
            array_push($questionsData, array('question_id' => $value['question_id'], 
                                       'question_text' => $value['question_text'], 
                                       'answer_number' => $value['answer_number'],
                                       'answers' => $results)); 
        }
        
        return $questionsData; 
    }
}