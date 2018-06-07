<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

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

		//the variables are being called from an associative array which can be called by name from the pages
		$data = array(
			'name'  => 'Admin',
			'message'  => 'Success!!!!!'
		);
		//this command loads a view from the views folder
		$this->build('Login', $data);
	}

	public function contact($submit = FALSE) {

        // if the user submits the form, ignore the
        // rest of the function
        if ($submit == 'submit') {
            $this->contact_submit();
            return;
        }

		// load the form helper to get the function isndie the file otherwise known as a plugin
		$this->load->helper('form');
		// this array will contain all the inputs we will need
		$data = array(
			'properties'	=> array(
				'action'	=> 'welcome/contact/submit',
				'hidden'	=> NULL
			),
			'form' => $this->user_form()
		);
		//the page itself
		$this->build('form', $data);

	}

	// a directory page for the registered users
	public function directory() {

		// load the database and model
		$this->load->model('users_model');

		// set the page data
		$data = array(
			'users'		=> $this->users_model->all_users()
		);

		// build the page
		$this->build('directory', $data);

	}

	// the user edit page
	// we need the = NULL part to avoid PHP errors
	public function edit($id = NULL) {

		// $id can be the word 'submit'. If so, we can just use the
		// edit_submit function.
		if ($id == 'submit') {
			$this->edit_submit();
			return;
		}

		$this->load->model('users_model');
		$user = $this->users_model->get_user($id);

		if ($user == NULL) {
			show_404();
			return;
		}

		// load the form helper to get the function isndie the file otherwise known as a plugin
		$this->load->helper('form');

		// this array will contain all the inputs we will need
		$data = array(
			'properties'	=> array(
				'action'	=> 'welcome/edit/submit',
				'hidden'	=> array('user_id' => $user['id'])
			),
			'form' => $this->user_form($user)
		);

		//the page itself
		$this->build('form', $data);

	}

    // the user can't access this page from the URL
	private function contact_submit(){
		//this will show a 404 error if there is no data in the form
		if ($this->input->method() != "post") {
			show_404();
			return;
		}
		//the form validation library makes it easier to check the form data
		$this->load->library('form_validation');

		//set the rules for each input
		$rules = array(
            array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required|valid_email|is_unique[tbl_admin.email]'
			),
            array(
				'field' => 'name',
				'label' => 'First Name',
				'rules' => 'required|min_length[3]'
			)
		);
		// prepare the rules for the validation of the form
		$this->form_validation->set_rules($rules);
		//check the form for validation issues
		if ($this->form_validation->run() === FALSE) {
			//echo validation_errors();
			$this->contact();
			return;
		}

        $email          = $this->input->post('email');
        $name           = $this->input->post('name');

        // loads the users_model file to use its functions
        $this->load->model('users_model');

        $this->users_model->add_user($email, $name);

        echo "Good Job you submitted a form correctly";
	}


	// the edit process function (form submission)
	private function edit_submit() {

		// load the form_validation library
		$this->load->library('form_validation');

		// load the users_model
		$this->load->model('users_model');

		//set the rules for each input - for edit
		// it will depend on the inputs being filled in
		$rules = array();

		$email = $this->input->post('email');
		if (!empty($email)) {
            $rules[] = array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required|valid_email'
			);
		}

		$name = $this->input->post('name');
		if (!empty($name)) {
            $rules[] = array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required|min_length[3]'
			);
		}

		$id = $this->input->post('user_id');

		// set the rules
		$this->form_validation->set_rules($rules);

		// check the form for validation errors
		if ($this->form_validation->run() === FALSE) {
			$this->edit($id);
			return;
		}

		// check that the email inputted is taken by someone else
		if (!$this->users_model->unique_email($id, $email)) {
			$this->form_validation->set_error('email', 'This email has been taken by another user.');
			$this->edit($id);
			return;
		}

		// update the user
		if (!$this->users_model->update_user($id, $email, $name)) {
			$this->form_validation->set_error('form', 'The user could not be updated.');
			$this->edit($id);
			return;
		}

		// reload the page
		$this->edit($id);

	}

	private function user_form($user = NULL) {

		// if no information was provided, TO BE SAFe
		// create an empty reference
		if ($user == NULL) {
			$user = array(
				'email'		=> NULL,
				'name'		=> NULL
			);
		}

		return array(
			'email' => array(
				'type' 				=> 'email',
				'name' 				=> 'email',
				'placeholder' 		=> 'email',
				'id' 				=> 'input-email',
				'required' 			=> TRUE,
				'value'				=> set_value('email', $user['email'])
			),
			'name' => array(
				'type' 				=> 'text',
				'name' 				=> 'name',
				'placeholder' 		=> 'name',
				'id' 				=> 'input-name',
				'required' 			=> TRUE,
				'value'				=> set_value('name', $user['name'])
			)
		);
	}
}
