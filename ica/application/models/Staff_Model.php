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
    function edit_staff(){
    $query = $this->db->get('tbl_staff');
    $query_result = $query->result();
    return $query_result;
    }
    // Function To Fetch Selected Student Record
    function show_staff_id($data){
    $this->db->select('*');
    $this->db->from('tbl_staff');
    $this->db->where('id', $data);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    }
    // Update Query For Selected Student
    function update_staff_id($id,$data){
    $this->db->where('id', $id);
    $this->db->update('tbl_staff', $data);
    }
}
?>
