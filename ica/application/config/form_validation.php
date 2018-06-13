<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(

    # The login form rules
    'login'         => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    ),

    # The register form rules
    'register'      => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[tbl_users.u_email]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[8]|password_strength'
        )
    ),

    'staff'      => array(
        array(
            'field' => 'staff_name',
            'label' => 'Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'staff_surname',
            'label' => 'Surname',
            'rules' => 'required'
        ),
        array(
            'field' => 'staff_subject',
            'label' => 'Subject',
            'rules' => 'required'
        ),
        array(
            'field' => 'staff_email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[tbl_users.u_email]'
        )
    )
);
