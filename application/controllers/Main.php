<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Main
 *
 * @author 60044723
 */
class Main extends CI_Controller{
   
    public function index() {
        
        
        $data = array('accion' => 'main');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
          
        } else {
          
           $user = $this->input->post('username');
           $psw  = $this->input->post('password');
           $encpassdb = "8302302f643bd38450d8df45b9506e18dfda291d2b38b3ff4593ed537ca3cb6a2dc52664920a6bd943b59308f0d94cde10f27e13551dbab617f64dd1982b4d65WXRav8iOVthGCWKlifqSDlTrItf0OuXo6TjM711gV+c=";
           $encpass = $this->encryption->decrypt($encpassdb);
           
           if ($encpass === $psw){
//               echo 'login auth';
                redirect('main/main_page', 'refresh');
           }
           
        }

        $this->load->view('index/login', $data);
    }

    private function login(){
        
      echo  $this->encryption->encrypt('batmanyrobin.batichica,booxiaraña');
           
//           $key = bin2hex($this->encryption->create_key(32));
//        echo $key;
    }
    
    
    public function main_page(){
        $data = array(
            'accionDaily'       => 'index.php?/Reportes/getLastResultsDaily',
            'accionPerformance' => 'index.php?/Reportes/getLastResultsByPortafolios',
        );
        $this->call_views('index/main_page',$data);
        
    }


    private function call_views($p_view, $p_data = null) {
        $this->load->view('header');
        if ($p_data == null) {
            $this->load->view($p_view);
        } else {
            $this->load->view($p_view, $p_data);
        }

        $this->load->view('footer');
    }
}
