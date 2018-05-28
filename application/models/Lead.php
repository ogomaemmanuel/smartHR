<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lead extends CI_Model
{

	private static $db;


	function __construct(){
		parent::__construct();
		self::$db = &get_instance()->db;
	}

	/**
	* Insert records to leads table and return INSERT ID
	*/
	static function save($data = array()) {
		self::$db->insert('companies',$data);
		return self::$db->insert_id();
	}

	/**
	* Update leads information
	*/
	static function update($company_id, $data = array()) {
		self::$db->where('co_id',$company_id)->update('companies',$data);
		return self::$db->affected_rows();
	}



	// Get all leads
	static function all()
	{
		return self::$db->where(array('co_id >' => 0, 'is_lead' => 1))->order_by('company_name','ASC')->get('companies')->result();
	}


	// Get lead files
    static function files($id)
    {
        return self::$db->where('client_id',$id)->get('files')->result();
    }

	static function contacts($company)
	{
		self::$db->join('companies','companies.co_id = account_details.company');
		self::$db->join('users','users.id = account_details.user_id');
		return self::$db->where('company',$company)->get('account_details')->result();
	}

	static function find($company)
	{
		return self::$db->where('co_id',$company)->get('companies')->row();
	}

	static function custom_fields($company){
		return self::$db->where(array('module'=>'leads','client_id'=>$company))->get('formmeta')->result();
	}

	static function tasks($lead_id, $status = NULL)
	{
		if($status != NULL){
			self::$db->where('status',$status);
		}
		return self::$db->order_by('id','desc')->where(array('module' => 'leads','lead_id'=>$lead_id))->get('todo')->result();
	}

	// Get leads currency
	static function currency($company = FALSE)
	{
		if (!$company) { return FALSE; }
		$dcurrency = self::$db->where('code', config_item('default_currency'))->get('currencies')->result();
		$client = self::$db->where('co_id', $company)->get('companies')->result();
		if (count($client) == 0) { return $dcurrency[0]; }
		$currency = self::$db->where('code',$client[0]->currency)->get('currencies')->result();
		if (count($currency) > 0) { return $currency[0]; }
		$dcurrency = self::$db->where('code', config_item('default_currency'))->get('currencies')->result();
		if (count($dcurrency) > 0) { return $dcurrency[0]; }

	}
	// Get leads language
	static function language($id = FALSE)
	{
		if (!$id) { return FALSE; }
		$language = self::$db->where('name',self::find($id)->language)->get('languages')->result();
		return $language[0];
	}
		// Get all leads comments
	    static function comments($id)
	    {
	        return self::$db->where(array('client_id'=>$id))->order_by('date_posted','desc')->get('comments')->result();
	    }

	// Deletes lead from the database
	static function delete($id)
	{

	$contacts 	= self::contacts($id);

			// clear leads activities
			self::$db->where(array('module'=>'leads', 'module_field_id' => $id))->delete('activities');
			//delete company
			self::$db->where('co_id',$id)->delete('companies');

			// clear leads custom form data
			self::$db->where(array('module'=>'leads', 'client_id' => $id))->delete('formmeta');

			if (count($contacts)) {
				foreach ($contacts as $contact) {
					//set contacts to blank
					self::$db->set('company','-')->where('company',$id)->update('account_details');
				}
			}

	}

}

/* End of file model.php */
