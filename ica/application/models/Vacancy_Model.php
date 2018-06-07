<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacancy_Model extends CI_Model {

    public function add_vacancy($vacimage, $vacname, $vacsubject,$vactype) {

        $data = array(
            'vacimage'     => $vacimage,
            'vacname'  => $vacname,
            'vacsubject'    => $vacsubject,
            'vactype'     => $vactype


        );

        // An INSERT query:
        // INSERT INTO tbl_admin (cols) VALUES (cols)
        $this->db->insert('tbl_vacancy', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }

	public function all_vacancy() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*')
				 ->order_by('vacname', 'asc');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_vacancy');

	}

    public function get_vacancy($id) {

        // run a query and return the row immediately
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get('tbl_vacancy')
                        ->row_array();

    }

    public function update_vacancy($vacimage, $vacname, $vacsubject,$vactype) {

        if ($this->check_vacancy($vacimage, $vacname, $vacsubject,$vactype)) {
            return TRUE;
        }

        // this is the data that needs to change
        $data = array();
        if (!empty($vacimage)) $data['vacimage'] = $vacimage;
        if (!empty($vacname)) $data['vacname'] = $vacname;
        if (!empty($vacsubject)) $data['vacsubject'] = $vacsubject;
        if (!empty($vactype)) $data['vactype'] = $vactype;

        // this is the entire update query
        $this->db->where('id', $id)
                 ->update('tbl_vacancy', $data);

        // TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_vacancy($vacimage, $vacname, $vacsubject,$vactype) {

        // this is the data that needs to change
        $data = array('id'  => $id);
        if (!empty($vacimage)) $data['vacimage'] = $vacimage;
        if (!empty($vacname)) $data['vacname'] = $vacname;
        if (!empty($vacsubject)) $data['vacsubject'] = $vacsubject;
        if (!empty($vactype)) $data['vactype'] = $vactype;

        // TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_vacancy', $data)->num_rows() == 1;

    }

}
