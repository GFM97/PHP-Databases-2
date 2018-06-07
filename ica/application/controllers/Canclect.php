<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Canclect extends CI_Controller {

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
	 # The constructor class
     function __construct()
     {
         parent::__construct();

         $this->load->library(array('form_validation' => 'fv'));
     }

	public function canclect()
	{
		$this->load->view('templates/top');
		$this->load->view('canclect');
		$this->load->view('templates/bottom');
	}

	public function addcanclect()
	{
		$data = array(
            'page_title'    => 'Cancelled Lectures',
            'form_action'   => 'Enter/submit',
            'form'          => array(
                'staff_name'         => array(
                    'type'          => 'staff_name',
                    'placeholder'   => 'staff_name',
                    'name'          => 'staff_name',
                    'id'            => 'input-staff_name'
                ),
                'staff_surname'         => array(
                    'type'          => 'staff_surname',
                    'placeholder'   => 'staff_surname',
                    'name'          => 'staff_surname',
                    'id'            => 'input-staff_surname'
                ),
                'course_name'      => array(
                    'type'          => 'course_name',
                    'placeholder'   => 'course_name',
                    'name'          => 'course_name',
                    'id'            => 'input-course_name'
                ),
				'course_level'      => array(
                    'type'          => 'course_level',
                    'placeholder'   => 'course_level',
                    'name'          => 'course_level',
                    'id'            => 'input-course_level'
                ),
				'course_group'      => array(
                    'type'          => 'course_group',
                    'placeholder'   => 'course_group',
                    'name'          => 'course_group',
                    'id'            => 'input-course_group'
                ),
				'course_subname'      => array(
                    'type'          => 'course_subname',
                    'placeholder'   => 'course_subname',
                    'name'          => 'course_subname',
                    'id'            => 'input-course_subname'
                ),
				'les_time'      => array(
                    'type'          => 'les_time',
                    'placeholder'   => 'les_time',
                    'name'          => 'les_time',
                    'id'            => 'input-les_time'
                ),
				'les_date'      => array(
                    'type'          => 'les_date',
                    'placeholder'   => 'les_date',
                    'name'          => 'les_date',
                    'id'            => 'input-les_date'
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
		public function canclect_submit()
	    {
	        # 1. Check the form for validation errors
	        if ($this->fv->run('canclect') === FALSE)
	        {
	            echo validation_errors();
	            return;
	        }

	        # 2. Retrieve the data for checking
	        $staff_name      = $this->input->post('staff_name');
	        $staff_surname      = $this->input->post('staff_surname');
	        $course_name   = $this->input->post('course_name');
#
			$id = $this->system->add_canclect($staff_name, $staff_surname, $course_name, $course_level, $course_group, $course_subname, $les_time, $les_date);

        $check = $this->system->canclect($staff_name, $staff_surname, $course_name, $course_level, $course_group, $course_subname, $les_time, $les_date);

		if ($check === FALSE)
        {
            $this->system->delete_canclect($id);
            echo "We couldn't register the cancelled lesson because of a database error.";
            return;
        }


		redirect('/');
	}
}
