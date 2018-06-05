<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studentp_Model extends CI_Model {

    public function add_studentp($sname, $ssurname, $coursename, $courselvl, $studlink) {

        $data = array(
            'name'      => $sname,
            'surname'   => $ssurname,
            'coursename' => $coursename,
            'courselvl' => $courselvl,
            'studlink' => $studlink
        );

        // An INSERT query:
        // INSERT INTO tbl_admin (cols) VALUES (cols)
        $this->db->insert('tbl_admin', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }

	public function all_studentp() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*')
				 ->order_by('name', 'asc');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_studentp');

	}

    public function get_studentp($id) {

        // run a query and return the row immediately
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get('tbl_studentp')
                        ->row_array();

    }

    public function update_user($sname, $ssurname, $coursename, $courselvl, $studlink) {

        if ($this->check_user($sname, $ssurname, $coursename, $courselvl, $studlink)) {
            return TRUE;
        }

        // this is the data that needs to change
        $data = array();
        if (!empty($sname)) $data['name'] = $sname;
        if (!empty($ssurname)) $data['surname'] = $ssurname;
        if (!empty($coursename)) $data['coursename'] = $coursename;
        if (!empty($courselvl)) $data['courselvl'] = $courselvl;
        if (!empty($studlink)) $data['studlink'] = $studlink;

        // this is the entire update query
        $this->db->where('id', $id)
                 ->update('tbl_studentp', $data);

        // TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_user($id, $email, $name, $surname, $mobile_no) {

        // this is the data that needs to change
        $data = array('id'  => $id);
        if (!empty($sname)) $data['name'] = $sname;
        if (!empty($ssurname)) $data['surname'] = $ssurname;
        if (!empty($coursename)) $data['coursename'] = $coursename;
        if (!empty($courselvl)) $data['courselvl'] = $courselvl;
        if (!empty($studlink)) $data['studlink'] = $studlink;
        // TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_studentp', $data)->num_rows() == 1;

    }
    public function unique_email($id, $studlink) {

        $data = array(
            'id !='     => $id,
            'studlink'     => $studlink
        );

        // will give me a true or false depending
        // on what comes up from the query
        return $this->db->get_where('tbl_studentp', $data)->num_rows() == 0;

    }

}
