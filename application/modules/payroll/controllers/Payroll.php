<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payroll extends MX_Controller {
    function __construct()
    {
        parent::__construct();
		$this->load->library(array('tank_auth'));	
        $this->load->model(array( 'App'));       
    }
    function index()
    {
		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Payroll');
		 
		$data['datepicker'] = TRUE;
		$data['form']       = TRUE; 
		$data['page']       = 'payroll';
		$data['role']       = $this->tank_auth->get_role_id();
		$this->template
			 ->set_layout('users')
			 ->build('create_payroll',isset($data) ? $data : NULL);
    }
	function create()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/pay_slip',$data);
	}
	function edit_salary()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/edit_salary',$data);
	}
	function save_salary()
	{
		if ($this->input->post()) {
  			$det['user_id']       = $this->input->post('salary_user_id');  
 			$det['amount']        = $this->input->post('user_salary_amount');
			$det['date_created']  = date('Y-m-01');
			$this->db->insert('fx_salary',$det);  
			//$this->session->set_flashdata('alert_message', 'error');
			redirect('payroll');
 		}else{
			$data['user_id'] = $this->uri->segment(3);
		    $this->load->view('modal/edit_salary',$data);
		}
		
	}
	function update_salary()
	{ 
  			$user_id         = $this->input->post('user_id');  
 			$det['amount']   = $this->input->post('amount');
			$id              = $this->input->post('type');
 			$this->db->update('fx_salary',$det,array('id'=>$id));  
			echo 1;
			//$this->session->set_flashdata('alert_message', 'error');
			//redirect('payroll');
 		    exit;
	}
	function salary_detail()
	{ 
  			$user_id   = $this->input->post('user_id');  
 			$year      = $this->input->post('year');
			$month     = $this->input->post('month');
			$date      = $year."-".$month."-31";
  			$qry       = "select * from fx_salary where user_id = ".$user_id."";
			$s_qry     = '';
			if($year != ''){
				$s_qry = " and date_created <= '".$date."' order by id desc";
			}
			if($year == date('Y') && $month > date('m')){
 				$s_qry = " order by id desc ";
			} 
			$qry .= $s_qry. " limit 1";
			//echo $qry; exit;
 			$res      = $this->db->query($qry)->result_array();
			$bs       = $da = $hra = '';
			if(!empty($res)){
			    $bs  = $res[0]['amount'];
				$da  = (40*$res[0]['amount']/100);
				$hra = (15*$res[0]['amount']/100);
			}
 			echo json_encode(array('basic'=>$bs,'da'=>$da,'hra'=>$hra));
 			exit;
 	} 
	
	
	
}
