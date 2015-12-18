<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function generate_setup_pagination($p_baseurl,$p_totalrows,$p_perpage){
    
    
        /*Preparando configuración para paginacion*/
        $config['base_url']      = $p_baseurl;
        $config['total_rows']    = $p_totalrows;
        $config['per_page']      = $p_perpage;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['first_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li >';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li >';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li >';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li >';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
       
        return $config;
    
}