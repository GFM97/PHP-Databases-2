<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studentport extends CI_Controller {

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
		$this->load->view('studentport');
		$this->load->view('templates/bottom');

		public function addstudentp()
		{
			$data = array(
				'page_title'    => 'Student Portfolio',
				'form_action'   => 'Enter/submit',
				'form'          => array(
					'sname'         => array(
						'type'          => 'sname',
						'placeholder'   => 'sname',
						'name'          => 'sname',
						'id'            => 'input-sname'
					),
					'ssurname'         => array(
						'type'          => 'ssurname',
						'placeholder'   => 'ssurname',
						'name'          => 'ssurname',
						'id'            => 'input-ssurname'
					),
					'coursename'      => array(
						'type'          => 'coursename',
						'placeholder'   => 'coursename',
						'name'          => 'coursename',
						'id'            => 'input-coursename'
					),
					'courselvl'      => array(
						'type'          => 'courselvl',
						'placeholder'   => 'courselvl',
						'name'          => 'courselvl',
						'id'            => 'input-courselvl'
					),
					'studlink'      => array(
						'type'          => 'studlink',
						'placeholder'   => 'studlink',
						'name'          => 'studlink',
						'id'            => 'input-studlink'
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
			public function studentp_submit()
			{
				# 1. Check the form for validation errors
				if ($this->fv->run('studentp') === FALSE)
				{
					echo validation_errors();
					return;
				}

				# 2. Retrieve the data for checking
				$sname      = $this->input->post('sname');
				$ssurname      = $this->input->post('ssurname');
				$coursename   = $this->input->post('coursename');
		#
				$id = $this->system->add_studentp($vacimage, $vacname, $vacsubject,$vactype);

			$check = $this->system->studentp($vacimage, $vacname, $vacsubject,$vactype);

			if ($check === FALSE)
			{
				$this->system->delete_studentp($id);
				echo "We couldn't register the  Student Portfolio because of a database error.";
				return;
			}


			redirect('/');
		}
		}
	}
}
