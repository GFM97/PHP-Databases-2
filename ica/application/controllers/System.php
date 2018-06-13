backend<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends MY_Controller {

    # The constructor class
    function __construct()
    {
        parent::__construct();

        $this->load->library(array('form_validation' => 'fv'));
    }

	# The Login Page
	public function login()
	{
        $data = array(
            'page_title'    => 'Login',
            'form_action'   => 'login/submit',
            'form'          => array(
                'Email'         => array(
                    'type'          => 'email',
                    'placeholder'   => 'me@example.com',
                    'name'          => 'email',
                    'id'            => 'input-email'
                ),
                'Password'      => array(
                    'type'          => 'password',
                    'placeholder'   => 'password',
                    'name'          => 'password',
                    'id'            => 'input-password'
                )
            ),
            'buttons'       => array(
                'submit'        => array(
                    'type'          => 'submit',
                    'content'       => 'Log In'
                )
            )
        );

        $this->load->view('system/form', $data);
	}


    # The Login Submission page
    public function login_submit()
    {
        # 1. Check the form for validation errors
        if ($this->fv->run('login') === FALSE)
        {
            echo validation_errors();
            return;
        }

        # 2. Retrieve the data for checking
        $name      = $this->input->post('name');
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        # 3. Use the System model to verify the password
        # This avoids exposing information (sry h4xx0rs lol)
        $check = $this->system->check_password($email, $password);

        # 4. If check came back as FALSE, the password is wrong
        if ($check === FALSE)
        {
            echo "The email and password don't match.";
            return;
        }

        # 5. Retrieve the information from the database
        # bin2hex converts binary data to hex (0-9, a-f)
        $code = bin2hex($this->encryption->create_key(16));

        # 6. Try to log in.
        $data = $this->system->set_login_data($check, $code);

        # 7. If there's an error, stop here
        if ($data === FALSE)
        {
            echo "We could not log you in :D";
            return;
        }

        # 8. We'll check back in an hour
        $data['refresh'] = time() + 60 * 60;

        # 9. Write everything to CodeIgniter's cookies
        $this->session->set_userdata($data);

        # 10. Redirect home
        redirect('backend');

    }


    # The logout page
    public function logout()
    {
        # 1. Remove the login data from the database
        $data = $this->session->userdata;
        $this->system->delete_session($data['id'], $data['session_code']);

        # 2. Remove the information from the session.
        $this->session->unset_userdata(array(
            'id', 'email', 'name', 'session_code'
        ));

        # 3. Take the user home
        redirect('/');

    }


    # The Register Page
	public function register()
	{
        $this ->load->model('System_Model');
        /*
        $data = array(
            'page_title'    => 'Register',
            'form_action'   => 'register/submit',
            'form'          => array(
                'Name'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Joseph',
                    'name'          => 'name',
                    'id'            => 'input-name'
                ),
                'Email'         => array(
                    'type'          => 'email',
                    'placeholder'   => 'me@example.com',
                    'name'          => 'email',
                    'id'            => 'input-email'
                ),
                'Password'      => array(
                    'type'          => 'password',
                    'placeholder'   => 'password',
                    'name'          => 'password',
                    'id'            => 'input-password'
                ),
            ),
            'buttons'       => array(
                'submit'        => array(
                    'type'          => 'submit',
                    'content'       => 'Register'
                )
            )
        );
        */
        $this->build('register');
	}


    # The Register Submission page
    public function register_submit()
    {
        # 1. Check the form for validation errors
        if ($this->fv->run('register') === FALSE)
        {
            echo validation_errors();
            return;
        }

        # 2. Retrieve the first set of data
        $name       = $this->input->post('name');
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        # 3. Generate a random keyword for added protection
        # Since the encrypted key is in binary, we should change it to a hex string (0-9, a-f)
        $salt       = bin2hex($this->encryption->create_key(8));

        # 3. Add them to the database, and retrieve the ID
        $id = $this->system->add_users($name, $email, $password, $salt);

        # 4. If the ID didn't register, we can't continue.
        if ($id === FALSE)
        {
            echo "We couldn't register the user because of a database error.";
            return;
        }

        # 5. Retrieve the next data
        $name       = $this->input->post('name');

        # 6. Add the details to the next table
        $check = $this->system->user_details($id, $name);

        # 7. If the query failed, delete the user to avoid partial data.
        if ($check === FALSE)
        {
            $this->system->delete_user($id);
            echo "We couldn't register the user because of a database error.";
            return;
        }

        # 8. Everything is fine, return to the home page.
        redirect('/');
    }

    # The Register Page
	public function staff()
	{
        $this->load->model('staff_model');
        $this->build('staffbackend');
	}


    # The Register Submission page
    public function staff_submit()
    {
        $this->load->model('staff_model');

        # 1. Check the form for validation errors
        if ($this->fv->run('staff') === FALSE)
        {
            echo validation_errors();
            return;
        }

        # 2. Retrieve the first set of data
        $staff_name       = $this->input->post('staff_name');
        $staff_surname       = $this->input->post('staff_surname');
        $staff_subject       = $this->input->post('staff_subject');
        $staff_email      = $this->input->post('staff_email');

        # 3. Generate a random keyword for added protection
        # Since the encrypted key is in binary, we should change it to a hex string (0-9, a-f)
        $salt       = bin2hex($this->encryption->create_key(8));

        # 3. Add them to the database, and retrieve the ID
        $id = $this->staff_model->add_staff($staff_name, $staff_surname, $staff_subject, $staff_email);

        # 4. If the ID didn't register, we can't continue.
        if ($id === FALSE)
        {
            echo "We couldn't register the user because of a database error.";
            return;
        }

        # 5. Retrieve the next data
        $staff_name       = $this->input->post('staff_name');

        # 6. Add the details to the next table
        //$check = $this->staff_model->staff_details($id, $staff_name);

        # 7. If the query failed, delete the user to avoid partial data.
        if ($check === FALSE)
        {
            $this->system->delete_staff($id);
            echo "We couldn't register the user because of a database error.";
            return;
        }

        # 8. Everything is fine, return to the home page.
        redirect('backend');
    }

    // parent::__construct();
    // $this->load->model('update_model');

    function show_staff_id() {
        $id = $this->uri->segment(3);
        $data['tbl_staff'] = $this->update_model->show_staff();
        $data['single_staff'] = $this->update_model->show_staff_id($id);
        $this->load->view('update_view', $data);
    }
    function update_staff_id() {
        $id= $this->input->post('did');
        $data = array(
            'staff_name' => $this->input->post('staff_name'),
            'staff_surname' => $this->input->post('staff_surname'),
            'staff_subject' => $this->input->post('staff_subject'),
            'staff_email' => $this->input->post('staff_email')
        );
        $this->update_model->update_staff_id($id,$data);
        $this->show_staff_id();
    }

//     <?php
// class delete_ctrl extends CI_Controller{
// function __construct(){
// parent::__construct();
// $this->load->model('system_model');
// }
// // Function to Fetch selected record from database.
// function show_staff_id() {
// $id = $this->uri->segment(3);
// $data['staff'] = $this->system_model->show_staff();
// $data['single_staff'] = $this->system_model->show_staff_id($id);
// $this->load->view('delete_view', $data);
// }
// // Function to Delete selected record from database.
// function delete_staff_id() {
// $id = $this->uri->segment(3);
// $this->system_model->delete_staff_id($id);
// $this->show_staff_id();
// }
// }
// ? ->

    public function index() {
        $data['show_table'] = $this->view_table();
        $this->load->view('select_form', $data);
    }
    public function view_table(){
        $result = $this->tbl_staff->show_all_data();
        if ($result != false) {
            return $result;
        } else {
        return 'Database is empty !';
        }
    }

    public function select_by_id() {
        $id = $this->input->post('id');
        if ($id != "") {
            $result = $this->tbl_staff->show_data_by_id($id);
            if ($result != false) {
                $data['result_display'] = $result;
        } else {
            $data['result_display'] = "No record found !";
        }
        } else {
        $data = array(
            'id_error_message' => "Id field is required"
        );
        }
        $data['show_table'] = $this->view_table();
        $this->load->view('select_form', $data);
    }

    public function select_by_subject() {
        $subject = $this->input->post('$staff_subject');
        if ($subject != "") {
        $result = $this->tbl_staff->show_data_by_subject($date);

        if ($result != false) {
        $data['result_display'] = $result;
        } else {
        $data['result_display'] = "No record found !";
        }
        } else {
        $data['date_error_message'] = "Date field is required";
        }
        $data['show_table'] = $this->view_table();
        $this->load->view('select_form', $data);
    }
}
