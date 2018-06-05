<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Model extends CI_Model {

    public function add_user($info_name, $info_email, $info_password) {

        $data = array(
            'info_name'      => $info_name,
            'info_email'     => $info_email,
            'info_password'  => $info_password
        );

        // An INSERT query:
        // INSERT INTO tbl_admin (cols) VALUES (cols)
        $this->db->insert('tbl_admin', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }

	public function all_users() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*')
				 ->order_by('info_email', 'asc');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_admin');

	}

    public function get_user($email) {

        // run a query and return the row immediately
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get('tbl_admin')
                        ->row_array();

    }

    public function update_user($info_name, $info_email, $info_password) {

        if ($this->check_user($info_name, $info_email, $info_password)) {
            return TRUE;
        }

        // this is the data that needs to change
        $data = array();
        if (!empty($info_email)) $data['info_email'] = $info_email;
        if (!empty($info_name)) $data['info_name'] = $info_name;
        if (!empty($info_password)) $data['info_password'] = $info_password;

        // this is the entire update query
        $this->db->where('id', $id)
                 ->update('tbl_admin', $data);

        // TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_user($info_name, $info_email, $info_password) {

        // this is the data that needs to change
        $data = array('id'  => $id);
        if (!empty($info_email)) $data['info_email'] = $info_email;
        if (!empty($info_name)) $data['info_name'] = $info_name;
        if (!empty($info_password)) $data['info_password'] = $info_password;

        // TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_admin', $data)->num_rows() == 1;

    }

    public function unique_email($info_email) {

        $data = array(
            'id !='     => $id,
            'info_email'     => $info_email
        );

        // will give me a true or false depending
        // on what comes up from the query
        return $this->db->get_where('tbl_admin', $data)->num_rows() == 0;

    }

}
