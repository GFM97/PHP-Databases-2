<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecturer_Model extends CI_Model {

    public function add_lecturer($lecname, $lecsurname, $lecemail,$cname, $lecimage) {

        $data = array(
            'staff_name'     => $lecname,
            'staff_surname'  => $lecsurname,
            'staff_email'    => $lecemail,
            'staff_subject'  => $cname,
            'staff_image'    => $lecimage


        );

        // An INSERT query:
        // INSERT INTO tbl_admin (cols) VALUES (cols)
        $this->db->insert('tbl_staff', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }

	public function all_lecturer() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*')
				 ->order_by('staff_name', 'asc');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_staff');

	}

    public function get_lecturer($id) {

        // run a query and return the row immediately
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get('tbl_staff')
                        ->row_array();

    }

    public function update_lecturer($lecname, $lecsurname, $lecemail,$cname, $lecimage) {

        if ($this->check_lecturer($lecname, $lecsurname, $lecemail,$cname, $lecimage)) {
            return TRUE;
        }

        // this is the data that needs to change
        $data = array();
        if (!empty($lecname)) $data['lecname'] = $lecname;
        if (!empty($lecsurname)) $data['lecsurname'] = $lecsurname;
        if (!empty($lecemail)) $data['lecemail'] = $lecemail;
        if (!empty($cname)) $data['cname'] = $cname;
        if (!empty($lecimage)) $data['lecimage'] = $lecimage;

        // this is the entire update query
        $this->db->where('id', $id)
                 ->update('tbl_staff', $data);

        // TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_lecturer($lecname, $lecsurname, $lecemail,$cname, $lecimage) {

        // this is the data that needs to change
        $data = array('id'  => $id);
        if (!empty($lecname)) $data['lecname'] = $lecname;
        if (!empty($lecsurname)) $data['lecsurname'] = $lecsurname;
        if (!empty($lecemail)) $data['lecemail'] = $lecemail;
        if (!empty($cname)) $data['cname'] = $cname;
        if (!empty($lecimage)) $data['lecimage'] = $lecimage;

        // TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_staff', $data)->num_rows() == 1;

    }

    public function unique_email($id, $lecemail) {

        $data = array(
            'id !='     => $id,
            'lecemail'     => $lecemail
        );

        // will give me a true or false depending
        // on what comes up from the query
        return $this->db->get_where('tbl_staff', $data)->num_rows() == 0;

    }

}
