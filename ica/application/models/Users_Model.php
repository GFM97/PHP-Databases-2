<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Model extends CI_Model {

    public function add_user($u_name, $u_email, $u_password) {

        $data = array(
            'u_name'      => $u_name,
            'u_email'     => $u_email,
            'u_password'  => $u_password
        );

        // An INSERT query:
        // INSERT INTO tbl_users (cols) VALUES (cols)
        $this->db->insert('tbl_users', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }

	public function all_users() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*')
				 ->order_by('u_email', 'asc');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_users');

	}

    public function get_user($email) {

        // run a query and return the row immediately
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get('tbl_users')
                        ->row_array();

    }

    public function update_user($u_name, $u_email, $u_password) {

        if ($this->check_user($u_name, $u_email, $u_password)) {
            return TRUE;
        }

        // this is the data that needs to change
        $data = array();
        if (!empty($u_email)) $data['u_email'] = $u_email;
        if (!empty($u_name)) $data['u_name'] = $u_name;
        if (!empty($u_password)) $data['u_password'] = $u_password;

        // this is the entire update query
        $this->db->where('id', $id)
                 ->update('tbl_users', $data);

        // TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_user($u_name, $u_email, $u_password) {

        // this is the data that needs to change
        $data = array('id'  => $id);
        if (!empty($u_email)) $data['u_email'] = $u_email;
        if (!empty($u_name)) $data['u_name'] = $u_name;
        if (!empty($u_password)) $data['u_password'] = $u_password;

        // TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_users', $data)->num_rows() == 1;

    }

    public function unique_email($u_email) {

        $data = array(
            'id !='     => $id,
            'u_email'     => $u_email
        );

        // will give me a true or false depending
        // on what comes up from the query
        return $this->db->get_where('tbl_users', $data)->num_rows() == 0;

    }

    public function delete_user($id) {
        $this->db->where_in('id', $id)->delete('tbl_users');
    }

}
