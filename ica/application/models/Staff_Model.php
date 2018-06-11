<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_Model extends CI_Model {

    public function add_staff($staff_name, $staff_surname, $staff_subject, $staff_email) {

        $data = array(
            'staff_name'      => $staff_name,
            'staff_surname'     => $staff_surname,
            'staff_subject'  => $staff_subject,
            'staff_email'  => $staff_email
        );

        // An INSERT query:
        // INSERT INTO tbl_users (cols) VALUES (cols)
        $this->db->insert('tbl_staff', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }
}
