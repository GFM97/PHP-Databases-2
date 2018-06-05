<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CancLect_Model extends CI_Model {

    public function add_canclect($staff_name, $staff_surname, $course_name, $course_level, $course_group, $course_subname, $les_time, $les_date) {

        $data = array(
            'staff_name'       => $staff_name,
            'staff_surname'    => $staff_surname,
            'course_name'      => $course_name,
            'course_level'     => $course_level,
            'course_group'     => $course_group,
            'course_subname'   => $course_subname,
            'les_time'         => $les_time,
            'les_date'         => $les_date
        );

        // An INSERT query:
        // INSERT INTO tbl_admin (cols) VALUES (cols)
        $this->db->insert('tbl_canclect', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }

	public function all_canclect() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*')
				 ->order_by('staff_name', 'asc');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_canclect');

	}

    public function get_canclect($id) {

        // run a query and return the row immediately
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get('tbl_canclect')
                        ->row_array();

    }

    public function update_canclect($staff_name, $staff_surname, $course_name, $course_level, $course_group, $course_subname, $les_time, $les_date) {

        if ($this->check_canclect($staff_name, $staff_surname, $course_name, $course_level, $course_group, $course_subname, $les_time, $les_date)) {
            return TRUE;
        }

        // this is the data that needs to change
        $data = array();
        if (!empty($staff_name)) $data['staff_name'] = $staff_name;
        if (!empty($staff_surname)) $data['staff_surname'] = $staff_surname;
        if (!empty($course_name)) $data['course_name'] = $course_name;
        if (!empty($course_level)) $data['course_level'] = $course_level;
        if (!empty($course_group)) $data['course_group'] = $course_group;
        if (!empty($course_subname)) $data['course_subname'] = $course_subname;
        if (!empty($les_time)) $data['les_time'] = $les_time;
        if (!empty($les_date)) $data['les_date'] = $les_date;

        // this is the entire update query
        $this->db->where('id', $id)
                 ->update('tbl_canclect', $data);

        // TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_canclect($staff_name, $staff_surname, $course_name, $course_level, $course_group, $course_subname, $les_time, $les_date) {

        // this is the data that needs to change
        $data = array('id'  => $id);
        if (!empty($staff_name)) $data['staff_name'] = $staff_name;
        if (!empty($staff_surname)) $data['staff_surname'] = $staff_surname;
        if (!empty($course_name)) $data['course_name'] = $course_name;
        if (!empty($course_level)) $data['course_level'] = $course_level;
        if (!empty($course_group)) $data['course_group'] = $course_group;
        if (!empty($course_subname)) $data['course_subname'] = $course_subname;
        if (!empty($les_time)) $data['les_time'] = $les_time;
        if (!empty($les_date)) $data['les_date'] = $les_date;

        // TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_canclect', $data)->num_rows() == 1;

    }

    public function unique_email($id, $course_subname) {

        $data = array(
            'id !='     => $id,
            'course_subname'     => $course_subname
        );

        // will give me a true or false depending
        // on what comes up from the query
        return $this->db->get_where('tbl_canclect', $data)->num_rows() == 0;

    }

}
