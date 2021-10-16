<?php

class Category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_Category','MC');
    }
    public function Index()
    {
        $data = [
            'title'         => 'OK Smart | Category',
            'navbar'        => 'Category',
            'breadcrumb1'   => 'Category',
            'breadcrumb2'   => 'Index'
        ];
        $this->load->view('templateadmin/header', $data);
        $this->load->view('templateadmin/menu');
        $this->load->view('Admin/Category/Index');
        $this->load->view('templateadmin/footer');
    }
    public function Listdatakategori()
    {
        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();
        $list = $this->MC->get_datatables();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $x) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $x->kategoriid;
            $row[] = $x->kategoriname;
            $row[] = $x->statuskategori;
            $data[] = $row;
        }
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->MC->count_all(),
            "recordsFiltered" => $this->MC->count_filtered(),
            "data"            => $data,
        );
        $output[$csrf_name] = $csrf_hash;
        echo json_encode($output);
    }
}
