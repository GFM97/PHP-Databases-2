<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_Model extends CI_Model {

    # Register a user into the first table
    public function add_user($name, $email, $password, $salt)
    {

        $data = array(
            'info_name'       => $name,
            'info_email'       => $email,
            'info_password'    => password_hash($salt.$password, CRYPT_BLOWFISH),
            'u_salt'        => strrev($salt)
        );

        $this->db->insert('tbl_admin', $data);

        return $this->db->insert_id();

    }


    # Checks the user details table for unchanged/existing data
    public function check_user_details($id, $name)
    {

        $data = array(
            'id'       => $id,
            'info_name'        => $name
        );

        return $this->db->get_where('tbl_admin', $data)->num_rows() == 1;
    }


    # Deletes a user from the database
    public function delete_user($id)
    {
        $this->db->delete('tbl_admin', array('id' => $id));
    }


    # Associate user details with the login data
    public function user_details($id, $name)
    {
        if ($this->check_user_details($id, $name))
        {
            return TRUE;
        }

        $data = array(
            'user_id'       => $id,
            'info_name'        => $name,
            'u_creation'    => time()
        );

        $this->db->insert('tbl_user_details', $data);

        return $this->db->affected_rows() == 1;
    }


    # Checks the password provided by the user
    public function check_password($email, $password)
    {
        $info = $this->db->select('id, info_password, u_salt')
                        ->where('info_email', $email)
                        ->get('tbl_admin')
                        ->row_array();

        $checkstr = strrev($info['u_salt']).$password;

        return password_verify($checkstr, $info['info_password']) ? $info['id'] : FALSE;
    }


    # Writes the login data and retrieve the user's information
    public function set_login_data($id, $code)
    {
        # 1. write the login information or stop the code here
        if (!$this->persist($id, $code))
        {
            return FALSE;
        }

        return $this->db->select('tbl_admin.id,
                            tbl_roles.name AS role,
                            tbl_admin.info_email AS email,
                            tbl_user_details.info_name AS name,
                            tbl_login_info.u_persistence AS session_code')
                        ->join('tbl_user_details', 'tbl_user_details.user_id = tbl_admin.id', 'left')
                        ->join('tbl_login_info', 'tbl_login_info.user_id = tbl_admin.id', 'left')
                        ->join('tbl_roles', 'tbl_roles.id = tbl_admin.role_id', 'left')
                        ->where('tbl_admin.id', $id)
                        ->get('tbl_admin')
                        ->row_array();
    }

    # Writes the login information to the database
    public function persist($id, $code)
    {
        $data = array(
            'user_id'       => $id,
            'u_login_time'  => time(),
            'u_persistence' => $code
        );

        $this->db->insert('tbl_login_info', $data);

        return $this->db->affected_rows() == 1;
    }

    # Check the user's credentials: the more info the better but slower
    public function check_data($id, $email, $code)
    {
        $data = array(
            'tbl_admin.id'                  => $id,
            'tbl_admin.info_email'             => $email,
        );

        return $this->db->select('tbl_admin.id')
                        ->join('tbl_login_info', 'tbl_login_info.user_id = tbl_admin.id', 'left')
                        ->get_where('tbl_admin', $data)
                        ->num_rows() == 1;
    }

    # Removes the login data from the table (force the user to log out)
    public function delete_session($id, $code)
    {
        $data = array(
            'user_id'       => $id,
            'u_persistence' => $code
        );

        $this->db->delete('tbl_login_info', $data);
    }

}
