<?php

class Dashboard extends CI_Controller
{
    public function Index()
    {
        $data=[
            'title'         =>'OK Smart | Dashboard Admin',
            'navbar'        => 'Dashboard',
            'breadcrumb1'   => 'Dashboard',
            'breadcrumb2'   => 'Dashboard'
        ];
        $this->load->view('templateadmin/header',$data);
        $this->load->view('templateadmin/menu');
        // $this->load->view('templateadmin/master');
        $this->load->view('templateadmin/footer');
    }
}
