<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacancies extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('templates/top');
		$this->load->view('vacancies');
		$this->load->view('templates/bottom');

		public function add_vacancy()
		{
			$data = array(
				'page_title'    => 'Vancancy',
				'form_action'   => 'Enter/submit',
				'form'          => array(
					'vacimage'         => array(
						'type'          => 'vacimage',
						'placeholder'   => 'vacimage',
						'name'          => 'vacimage',
						'id'            => 'input-vacimage'
					),
					'vacname'         => array(
						'type'          => 'vacname',
						'placeholder'   => 'vacname',
						'name'          => 'vacname',
						'id'            => 'input-vacname'
					),
					'vacsubject'      => array(
						'type'          => 'vacsubject',
						'placeholder'   => 'vacsubject',
						'name'          => 'vacsubject',
						'id'            => 'input-vacsubject'
					),
					'vactype'      => array(
						'type'          => 'vactype',
						'placeholder'   => 'vactype',
						'name'          => 'vactype',
						'id'            => 'input-vactype'
					)

				),
				'buttons'       => array(
					'submit'        => array(
						'type'          => 'submit',
						'content'       => 'Enter'
					)
				)
			);

			$this->load->view('system/form', $data);

		# canc lect submit
			public function Vacancy_submit()
			{
				# 1. Check the form for validation errors
				if ($this->fv->run('Vacancy') === FALSE)
				{
					echo validation_errors();
					return;
				}

				# 2. Retrieve the data for checking
				$vacimage      = $this->input->post('vacimage');
				$vacname      = $this->input->post('vacname');
				$vacsubject   = $this->input->post('vacsubject');
		#
				$id = $this->system->add_vacancy($vacimage, $vacname, $vacsubject,$vactype);

			$check = $this->system->Vacancy($vacimage, $vacname, $vacsubject,$vactype);

			if ($check === FALSE)
			{
				$this->system->delete_Vacancy($id);
				echo "We couldn't register the  Vacancy because of a database error.";
				return;
			}


			redirect('/');
		}
		}
	}
}
