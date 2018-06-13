<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_Model extends CI_Model {

    # Register a user into the first table
    public function add_users($name, $email, $password, $salt)
    {

        $data = array(
            'u_name'       => $name,
            'u_email'       => $email,
            'u_password'    => password_hash($salt.$password, CRYPT_BLOWFISH),
            'u_salt'        => strrev($salt)
        );

        $this->db->insert('tbl_users', $data);

        return $this->db->insert_id();

    }


    # Checks the user details table for unchanged/existing data
    public function check_user_details($id, $name)
    {

        $data = array(
            'id'       => $id,
            'u_name'   => $name
        );

        return $this->db->get_where('tbl_users', $data)->num_rows() == 1;
    }


    # Deletes a user from the database
    public function delete_user($id)
    {
        $this->db->delete('tbl_users', array('id' => $id));
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
            'u_name'        => $name,
            'u_creation'    => time()
        );

        $this->db->insert('tbl_user_details', $data);

        return $this->db->affected_rows() == 1;
    }


    # Checks the password provided by the user
    public function check_password($email, $password)
    {
        $info = $this->db->select('id, u_password, u_salt')
                        ->where('u_email', $email)
                        ->get('tbl_users')
                        ->row_array();

        $checkstr = strrev($info['u_salt']).$password;

        return password_verify($checkstr, $info['u_password']) ? $info['id'] : FALSE;
    }


    # Writes the login data and retrieve the user's information
    public function set_login_data($id, $code)
    {
        # 1. write the login information or stop the code here
        if (!$this->persist($id, $code))
        {
            return FALSE;
        }

        return $this->db->select('tbl_users.id,
                            tbl_roles.name AS role,
                            tbl_users.u_email AS email,
                            tbl_user_details.u_name AS name,
                            tbl_login_info.u_persistence AS session_code')
                        ->join('tbl_user_details', 'tbl_user_details.user_id = tbl_users.id', 'left')
                        ->join('tbl_login_info', 'tbl_login_info.user_id = tbl_users.id', 'left')
                        ->join('tbl_roles', 'tbl_roles.id = tbl_users.role_id', 'left')
                        ->where('tbl_users.id', $id)
                        ->get('tbl_users')
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
            'tbl_users.id'                  => $id,
            'tbl_users.u_email'             => $email,
        );

        return $this->db->select('tbl_users.id')
                        ->join('tbl_login_info', 'tbl_login_info.user_id = tbl_users.id', 'left')
                        ->get_where('tbl_users', $data)
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

    // Function to select all from table name students.
    function show_staff(){
    $query = $this->db->get('staff');
    $query_result = $query->result();
    return $query_result;
    }
    // Function to select particular record from table name students.
    function show_staff_id($data){
    $this->db->select('*');
    $this->db->from('staff');
    $this->db->where('staff_id', $data);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    }
    // Function to Delete selected record from table name students.
    function delete_staff_id($id){
    $this->db->where('staff_id', $id);
    $this->db->delete('staff');
    }

    public function show_all_data() {
        $this->db->select('*');
        $this->db->from('tbl_staff');
        $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

    public function show_data_by_id($id) {
    $condition = "staff id =" . "'" . $id . "'";
    $this->db->select('*');
    $this->db->from('tbl_staff');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function show_data_by_subject($subject) {
    $condition = "subject =" . "'" . $subject . "'";
    $this->db->select('*');
    $this->db->from('tbl_staff');
    $this->db->where($condition);
    $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
