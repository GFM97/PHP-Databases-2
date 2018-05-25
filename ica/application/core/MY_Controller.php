<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    # The class constructor
    function __construct()
    {
        parent::__construct();
        $this->can_access();
        $this->config->load('permissions');
    }

    // We can use this to replace $this->load->view
	function build($pages = NULL, $data = NULL) {

		$start = array(
		);

		$this->load->view('templates/top', $start);
		$this->load->view($pages, $data);
		$this->load->view('templates/bottom');

	}

    # Can the user access this page?
    private function can_access()
    {

        # Use CodeIgniter's router to get the controller/page
        $cont = $this->router->class;
        $page = $this->router->method;

        $check = $this->check_login();

        # Check for every page I have to be logged in/out
        if ($check && $cont == 'system' && $page != 'logout')
        {
            redirect('home/success');
        }
        else if ($check && $cont == 'home' && $page == 'index')
        {
            redirect('home/success');
        }
        else if (!$check && $cont != 'system' && ($cont == 'home' && $page != 'index'))
        {
            redirect('/');
        }

    }


    # Check if the user is logged in
    protected function check_login()
    {
        # 1. Get the current session data into a variable.
        $data = $this->session->userdata;

        # 2. Stop here if there is no session data
        if (!array_key_exists('session_code', $data))
        {
            return FALSE;
        }

        # 3. If there is no refresh data or an hour has passed
        # check the login data.
        if (!array_key_exists('refresh', $data) || $data['refresh'] < time())
        {
            if ($this->system->check_data($data['id'], $data['email'], $data['session_code']))
            {
                $data['refresh'] = time() + 60 * 60;
                return TRUE;
            }

            return FALSE;
        }

        # We don't have to check the data
        return TRUE;
    }

    # Manually check that the user has access to this page
    protected function has_permission($p_name)
    {

        # 1. Stop here if $p_name is a number
        if (is_int($p_name)) return FALSE;

        # 2. Retrieve the information we need
        $p_name = strtoupper($p_name);
        $role = strtolower($this->session->userdata('role'));
        $permissions = $this->config->item('permissions')[$role];

        # 3. check that the permission item actually exists
        if (!array_key_exists($p_name, $permissions)) return FALSE;
        return $permissions[$p_name];

    }

}
