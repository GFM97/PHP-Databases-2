<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

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
		$this->load->view('staff');
		$this->load->view('templates/bottom');
	}


	public function addStaff()
	{
		$data = array(
			'page_title'    => 'Staff',
			'form_action'   => 'Enter/submit',
			'form'          => array(
				'staff_profile'         => array(
					'type'          => 'staff_profile',
					'placeholder'   => 'staff_profile',
					'name'          => 'staff_profile',
					'id'            => 'input-staff_profile'
				),
				'staff_name'         => array(
					'type'          => 'staff_name',
					'placeholder'   => 'staff_name',
					'name'          => 'staff_name',
					'id'            => 'input-staff_name'
				),
				'staff_email'      => array(
					'type'          => 'staff_email',
					'placeholder'   => 'staff_email',
					'name'          => 'staff_email',
					'id'            => 'input-staff_email'
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
		public function Staff_submit()
		{
			# 1. Check the form for validation errors
			if ($this->fv->run('Staff') === FALSE)
			{
				echo validation_errors();
				return;
			}

			# 2. Retrieve the data for checking
			$lecname      = $this->input->post('staff_name');
			$lecsurname      = $this->input->post('staff_surname');
			$lecemail   = $this->input->post('staff_email');
	#
			$id = $this->system->add_Staff($lecname, $lecsurname, $lecemail,$cname, $lecimage);

		$check = $this->system->Staff($lecname, $lecsurname, $lecemail,$cname, $lecimage);

		if ($check === FALSE)
		{
			$this->system->delete_Staff($id);
			echo "We couldn't register the  lecturer because of a database error.";
			return;
		}


		redirect('/');

}
}
