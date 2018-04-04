<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Configuration
 *
 * @author 60044723
 */
class Configuration extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        // Load the DB utility class
        $this->load->dbutil();

// Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

//// Load the file helper and write the file to your server
//        $this->load->helper('file');
//        write_file('/path/to/mybackup.gz', $backup);

// Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('mybackup.gz', $backup);
    }

}
