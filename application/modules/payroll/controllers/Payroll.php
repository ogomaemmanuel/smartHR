<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payroll extends MX_Controller {
    function __construct()
    {
        parent::__construct();
		$this->load->library(array('tank_auth'));	
        $this->load->model(array( 'App'));     
        $salary_setting = App::salary_setting();
			  $settingsalray = array();
                        if(!empty($salary_setting)){
                            foreach ($salary_setting as  $value) {
                                $settingsalray[$value->config_key] = $value->value;
                            }
                        }
			 $this->da_percentage = (!empty($settingsalray['salary_da']))?$settingsalray['salary_da']:'1';
			 $this->hra_percentage = (!empty($settingsalray['salary_hra']))?$settingsalray['salary_hra']:'1';  
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
		$data['da_percentage'] = $this->da_percentage;
		$data['hra_percentage'] = $this->hra_percentage;
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
			$det['date_created']  = date('Y-m-d H:i:s');
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
 			$det['date_created'] = date('Y-m-d H:i:s');
			$id              = $this->input->post('type');
 			$this->db->update('fx_salary',$det,array('id'=>$id));  
			echo 1;
			//$this->session->set_flashdata('alert_message', 'error');
			//redirect('payroll');
 		    exit;
	}


	function view_salary_slip(){

		if($this->input->post()){
			
			
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Payroll');
			$data['datepicker'] = TRUE;
			$data['form']       = TRUE; 
			$data['page']       = 'payroll';
			$data['role']       = $this->tank_auth->get_role_id();
			$data['pay_slip_details'] = $this->input->post();
			
			$this->template->set_layout('users')
			 ->build('salary_detail',isset($data) ? $data : NULL);
		}
	}
	
	function employee(){

			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Payroll');
			$data['datepicker'] = TRUE;
			$data['form']       = TRUE; 
			$data['page']       = 'payroll';
			$data['role']       = $this->tank_auth->get_role_id();
			
			
			$this->template->set_layout('users')
			 ->build('employee_salary_detail',isset($data) ? $data : NULL);
	}

	function salary_detail()
	{ 
  			$user_id   = $this->input->post('user_id');  
 			$year      = $this->input->post('year');
			$month     = $this->input->post('month');
			$this->db->where('user_id', $user_id);
			$this->db->where('p_year', $year);
			$this->db->where('p_month', $month);
			$details = $this->db->get('payslip')->row();

			if(!empty($details)){

				$details = json_decode($details->payslip_details,TRUE);
				$bs = $details['payslip_basic'];
				$da = $details['payslip_da'];
				$hra = $details['payslip_hra'];
			echo json_encode(array('basic'=>$bs,'da'=>$da,'hra'=>$hra,'payment_details'=>$details));
			exit;	
			}else{

			$date      = $year."-".$month."-31";
  			$qry       = "select * from fx_salary where user_id = ".$user_id."";
			$s_qry     = '';
			if($year != ''){
				$s_qry = " and date_created <= '".$date." 23:59:59' order by date_created desc";
			}
			if($year == date('Y') && $month > date('m')){
 				$s_qry = " order by date_created desc ";
			} 
			$qry .= $s_qry. " limit 1";
			  // echo $qry; exit;
 			$res      = $this->db->query($qry)->result_array();
			$bs       = $da = $hra = '';
			if(!empty($res)){
			    $bs  = $res[0]['amount'];
			    $da  = ($this->da_percentage*$res[0]['amount']/100);
				$hra = ($this->hra_percentage*$res[0]['amount']/100);
				$bs  = ($bs-($da+$hra));
 			echo json_encode(array('basic'=>$bs,'da'=>$da,'hra'=>$hra,'payment_details'=>array()));
 			exit;
			}
			}
 	} 
	
	
	
}
