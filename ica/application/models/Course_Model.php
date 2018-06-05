<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_Model extends CI_Model {

    public function add_course($ccode, $clevel, $cduration, $cfees, $centryreq, $otherreqs, $cdescrip, $cdelivery, $assessment, $outcomes, $cstudyunit, $specunit, $suppunit, $optunit, $progaftcomp, $careeropp) {

        $data = array(
            '$ccode'     => $ccode,
            '$clevel'  => $clevel,
            '$cfees'    => $cfees,
            '$cduration'     => $cduration,
            '$centryreq'  => $centryreq,
            '$otherreqs'     => $otherreqs,
            '$cdescrip'  => $cdescrip,
            '$cdelivery'  => $cdelivery,
            '$assessment'  => $assessment,
            '$cstudyunit'  => $cstudyunit,
            '$specunit'    => $specunit,
            '$suppunit'     => $suppunit,
            '$optunit'     => $optunit,
            '$progaftcomp' => $progaftcomp,
            '$careeropp'  => $careeropp,


        );

        // An INSERT query:
        // INSERT INTO tbl_admin (cols) VALUES (cols)
        $this->db->insert('tbl_course', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }

	public function all_course() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*')
				 ->order_by('course', 'asc');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_course');

	}

    public function get_course($id) {

        // run a query and return the row immediately
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get('tbl_course')
                        ->row_array();

    }

    public function update_course($ccode, $clevel, $cduration, $cfees, $centryreq, $otherreqs, $cdescrip, $cdelivery, $assessment, $outcomes, $cstudyunit, $specunit, $suppunit, $optunit, $progaftcomp, $careeropp) {

        if ($this->check_course($ccode, $clevel, $cduration, $cfees, $centryreq, $otherreqs, $cdescrip, $cdelivery, $assessment, $outcomes, $cstudyunit, $specunit, $suppunit, $optunit, $progaftcomp, $careeropp)) {
            return TRUE;
        }

        // this is the data that needs to change
        $data = array();
        if (!empty($ccode)) $data['ccode'] = $ccode;
        if (!empty($clevel)) $data['clevel'] = $clevel;
        if (!empty($cduration)) $data['cduration'] = $cduration;
        if (!empty($cfees)) $data['cfees'] = $cfees;
        if (!empty($centryreq)) $data['centryreq'] = $centryreq;
        if (!empty($otherreqs)) $data['otherreqs'] = $otherreqs;
        if (!empty($cdescrip)) $data['cdescrip'] = $cdescrip;
        if (!empty($cdelivery)) $data['cdelivery'] = $cdelivery;
        if (!empty($assessment)) $data['assessment'] = $assessment;
        if (!empty($outcomes)) $data['outcomes'] = $outcomes;
        if (!empty($cstudyunit)) $data['cstudyunit'] = $cstudyunit;
        if (!empty($specunit)) $data['specunit'] = $specunit;
        if (!empty($suppunit)) $data['suppunit'] = $suppunit;
        if (!empty($progaftcomp)) $data['progaftcomp'] = $progaftcomp;
        if (!empty($optunit)) $data['optunit'] = $optunit;
        if (!empty($careeropp)) $data['careeropp'] = $careeropp;

        // this is the entire update query
        $this->db->where('id', $id)
                 ->update('tbl_course', $data);

        // TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_lecturer($ccode, $clevel, $cduration, $cfees, $centryreq, $otherreqs, $cdescrip, $cdelivery, $assessment, $outcomes, $cstudyunit, $specunit, $suppunit, $optunit, $progaftcomp, $careeropp) {

        // this is the data that needs to change
        $data = array('id'  => $id);
        if (!empty($ccode)) $data['$ccode'] = $ccode;
        if (!empty($clevel)) $data['$clevel'] = $clevel;
        if (!empty($cduration)) $data['$cduration'] = $cduration;
        if (!empty($cfees)) $data['$cfees'] = $cfees;
        if (!empty($centryreq)) $data['$centryreq'] = $centryreq;
        if (!empty($otherreqs)) $data['$otherreqs'] = $otherreqs;
        if (!empty($cdescrip)) $data['$cdescrip'] = $cdescrip;
        if (!empty($cdelivery)) $data['$cdelivery'] = $cdelivery;
        if (!empty($assessment)) $data['$assessment'] = $assessment;
        if (!empty($outcomes)) $data['$outcomes'] = $outcomes;
        if (!empty($cstudyunit)) $data['$cstudyunit'] = $cstudyunit;
        if (!empty($specunit)) $data['$specunit'] = $specunit;
        if (!empty($suppunit)) $data['$suppunit'] = $suppunit;
        if (!empty($progaftcomp)) $data['$progaftcomp'] = $progaftcomp;
        if (!empty($optunit)) $data['$optunit'] = $optunit;
        if (!empty($careeropp)) $data['$careeropp'] = $careeropp;

        // TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_course', $data)->num_rows() == 1;

    }

    public function unique_email($id, $ccode) {

        $data = array(
            'id !='     => $id,
            'ccode'     => $ccode
        );

        // will give me a true or false depending
        // on what comes up from the query
        return $this->db->get_where('tbl_course', $data)->num_rows() == 0;

    }
}
