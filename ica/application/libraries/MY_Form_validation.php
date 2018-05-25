<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    # Load the configuration from the original class
    function __construct($config = array())
    {
        parent::__construct($config);
    }

    # Checks for the password strength
    function password_strength($str) {
        return (preg_match('#[0-9]#', $str) && preg_match("#[a-zA-Z]+#", $str));
    }

}
