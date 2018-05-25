<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Model extends CI_Model {

    public function add_user($email, $name, $surname, $mobile_no) {

        $data = array(
            'name'      => $name,
            'email'     => $email,
            'password'  => $password
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
				 ->order_by('name', 'asc');

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

    public function update_user($id, $email, $name, $surname, $mobile_no) {

        if ($this->check_user($id, $email, $name, $surname, $mobile_no)) {
            return TRUE;
        }

        // this is the data that needs to change
        $data = array();
        if (!empty($email)) $data['email'] = $email;
        if (!empty($name)) $data['name'] = $name;
        if (!empty($surname)) $data['surname'] = $surname;
        if (!empty($mobile_no)) $data['mobile_no'] = $mobile_no;

        // this is the entire update query
        $this->db->where('id', $id)
                 ->update('tbl_users', $data);

        // TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_user($id, $email, $name, $surname, $mobile_no) {

        // this is the data that needs to change
        $data = array('id'  => $id);
        if (!empty($email)) $data['email'] = $email;
        if (!empty($name)) $data['name'] = $name;
        if (!empty($surname)) $data['surname'] = $surname;
        if (!empty($mobile_no)) $data['mobile_no'] = $mobile_no;

        // TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_users', $data)->num_rows() == 1;

    }

    public function unique_email($id, $email) {

        $data = array(
            'id !='     => $id,
            'email'     => $email
        );

        // will give me a true or false depending
        // on what comes up from the query
        return $this->db->get_where('tbl_users', $data)->num_rows() == 0;

    }

}
