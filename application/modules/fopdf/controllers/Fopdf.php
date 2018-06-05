<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fopdf extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		User::logged_in();
		
		$this->load->model(array('Client','Estimate','Invoice','App'));
		$this->load->helper('invoicer');		
	
		$this->applib->set_locale();
		
	}

	function invoice($invoice_id = NULL){			
			$data['id'] = $invoice_id;
			$this->load->view('invoice_pdf',isset($data) ? $data : NULL);				
	}
	function estimate($estimate = NULL){
			$data['id'] = $estimate;
			$this->load->view('estimate_pdf',isset($data) ? $data : NULL);	
	}

	function attach_invoice($invoice){			
			$data['id'] = $invoice['inv_id'];
			$data['attach'] = TRUE;
			$invoice = $this->load->view('invoice_pdf',isset($data) ? $data : NULL,TRUE);	
			return $invoice;			
	}
	function attach_estimate($estimate){
			$data['attach'] = TRUE;			
			$data['id'] = $estimate['est_id'];
			$est = $this->load->view('estimate_pdf',isset($data) ? $data : NULL,TRUE);	
			return $est;			
	}

	function payslip_pdf(){

		$data['attach'] = TRUE;			 

		$form_data = array();

		if ($this->input->post('payslip_user_id')) {

			$form_data['user_id']           = $this->input->post('payslip_user_id');

			$form_data['year']              = $this->input->post('payslip_year');

			$form_data['month']             = $this->input->post('payslip_month');

			$form_data['basic']             = $this->input->post('payslip_basic');

			$form_data['da']                = $this->input->post('payslip_da');

			$form_data['hra']               = $this->input->post('payslip_hra');

			$form_data['conveyance']        = $this->input->post('payslip_conveyance');

			$form_data['allowance']         = $this->input->post('payslip_allowance');

			$form_data['medical_allowance'] = $this->input->post('payslip_medical_allowance');

			$form_data['others']            = $this->input->post('payslip_others');

			$form_data['deduction_tds']     = $this->input->post('payslip_ded_tds');

			$form_data['deduction_esi']     = $this->input->post('payslip_ded_esi');

			$form_data['deduction_pf']      = $this->input->post('payslip_ded_pf');

			$form_data['deduction_leave']   = $this->input->post('payslip_ded_leave');

			$form_data['deduction_prof']    = $this->input->post('payslip_ded_prof');

			$form_data['deduction_welfare'] = $this->input->post('payslip_ded_welfare');

			$form_data['deduction_fund']    = $this->input->post('payslip_ded_fund');

			$form_data['deduction_others']  = $this->input->post('payslip_ded_others');

		 } 

		$data['form_data'] = $form_data;	  

	$array = array();
	
	$array['user_id'] = $form_data['user_id'];
	$array['p_year'] = $form_data['year'];
	$array['p_month'] = $form_data['month'];

	$this->db->where($array);
	$payslip_count = $this->db->count_all_results('payslip');
	if($payslip_count == 0){
		$array['payslip_details'] = json_encode($form_data);
		$this->db->insert('payslip', $array);
	}else{
	
		$array1['payslip_details'] = json_encode($form_data);
		$this->db->where($array);
		$this->db->update('payslip', $array1);
	}

	 $est = $this->load->view('payslip',isset($data) ? $data : NULL,TRUE);	

		return $est;			

	}

}

/* End of file fopdf.php */