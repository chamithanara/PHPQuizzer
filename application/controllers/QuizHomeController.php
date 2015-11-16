<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * quiz home controller
 */
class QuizHomeController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->load->model('QuestionModel');
            $data['questions'] = $this->QuestionModel->get_questions_for_quiz('1');
            
            $this->load->model('AnswerModel');
            $data['questionsAnswers'] = $this->AnswerModel->get_answers_questions($data['questions']);          
            
            $this->load->view('quizHomePageView', $data);
	}
}