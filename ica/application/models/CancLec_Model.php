<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CancLec_Model extends CI_Model {

    public function add_canclec($lecname, $lecsurname, $cname, $clevel, $cgroup, $subname, $ltime, $ldate) {

        $data = array(
            'lecname'     => $lecname,
            'lecsurname'      => $lecsurname,
            'cname'   => $cname,
            'clevel' => $clevel,
            'cgroup' => $cgroup,
            'subname' => $subname,
            'ltime' => $ltime,
            'ldate' => $ldate
        );

        // An INSERT query:
        // INSERT INTO tbl_users (cols) VALUES (cols)
        $this->db->insert('tbl_canclec', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }

	public function all_canclec() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*')
				 ->order_by('lecname', 'asc');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_canclec');

	}

    public function get_canclec($id) {

        // run a query and return the row immediately
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get('tbl_canclec')
                        ->row_array();

    }

    public function update_canclec($lecname, $lecsurname, $cname, $clevel, $cgroup, $subname, $ltime, $ldate) {

        if ($this->check_canclec($lecname, $lecsurname, $cname, $clevel, $cgroup, $subname, $ltime, $ldate)) {
            return TRUE;
        }

        // this is the data that needs to change
        $data = array();
        if (!empty($lecname)) $data['lecname'] = $lecname;
        if (!empty($lecsurname)) $data['lecsurname'] = $lecsurname;
        if (!empty($cname)) $data['cname'] = $cname;
        if (!empty($clevel)) $data['clevel'] = $clevel;
        if (!empty($cgroup)) $data['cgroup'] = $cgroup;
        if (!empty($subname)) $data['subname'] = $subname;
        if (!empty($ltime)) $data['ltime'] = $ltime;
        if (!empty($ldate)) $data['ldate'] = $ldate;

        // this is the entire update query
        $this->db->where('id', $id)
                 ->update('tbl_users', $data);

        // TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_canclec($lecname, $lecsurname, $cname, $clevel, $cgroup, $subname, $ltime, $ldate) {

        // this is the data that needs to change
        $data = array('id'  => $id);
        if (!empty($lecname)) $data['lecname'] = $lecname;
        if (!empty($lecsurname)) $data['lecsurname'] = $lecsurname;
        if (!empty($cname)) $data['cname'] = $cname;
        if (!empty($clevel)) $data['clevel'] = $clevel;
        if (!empty($cgroup)) $data['cgroup'] = $cgroup;
        if (!empty($subname)) $data['subname'] = $subname;
        if (!empty($ltime)) $data['ltime'] = $ltime;
        if (!empty($ldate)) $data['ldate'] = $ldate;

        // TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_canclec', $data)->num_rows() == 1;

    }

    public function unique_email($id, $subname) {

        $data = array(
            'id !='     => $id,
            'subname'     => $subname
        );

        // will give me a true or false depending
        // on what comes up from the query
        return $this->db->get_where('tbl_canclec', $data)->num_rows() == 0;

    }

}
