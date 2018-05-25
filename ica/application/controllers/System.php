<?php
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
        redirect('home/success');

    }


    # The logout page
    public function logout()
    {
        # 1. Remove the login data from the database
        $data = $this->session->userdata;
        $this->system->delete_session($data['id'], $data['session_code']);

        # 2. Remove the information from the session.
        $this->session->unset_userdata(array(
            'id', 'email', 'name', 'surname', 'session_code'
        ));

        # 3. Take the user home
        redirect('/');

    }


    # The Register Page
	public function register()
	{
        $data = array(
            'page_title'    => 'Register',
            'form_action'   => 'register/submit',
            'form'          => array(
                'Name'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'name',
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
                    'content'       => 'Log In'
                )
            )
        );

        $this->load->view('system/form', $data);
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
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        # 3. Generate a random keyword for added protection
        # Since the encrypted key is in binary, we should change it to a hex string (0-9, a-f)
        $salt       = bin2hex($this->encryption->create_key(8));

        # 3. Add them to the database, and retrieve the ID
        $id = $this->system->add_user($email, $password, $salt);

        # 4. If the ID didn't register, we can't continue.
        if ($id === FALSE)
        {
            echo "We couldn't register the user because of a database error.";
            return;
        }

        # 5. Retrieve the next data
        $name       = $this->input->post('name');

        # 6. Add the details to the next table
        $check = $this->system->user_details($id, $name, $surname);

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
}
