<?php
class User_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		
		$this->table = 'user';
		$this->column_order = array(
            '0'=>'user.id',
            '1'=>'user.firstname',
            '2'=>'user.lastname',
            '3'=>'user.email',
            '4'=>'user.mobile',
            '5'=>'tbl_user_account_type.account_name',
            '6'=>'user.status',
        );
		$this->column_search = array(
			'0'=>'user.status',
            '1'=>'user.firstname',
            '2'=>'user.lastname',
            '3'=>'user.email',
            '4'=>'user.mobile',
            '5'=>'tbl_user_account_type.account_name',
        );
        $this->order = array('user.firstname' => 'ASC');
	}
	
	public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    public function countAll($postData){
        $this->db->from($this->table);
		$this->db->join('tbl_user_account_type','tbl_user_account_type.id=user.user_role','LEFT');
		$this->db->where('user.user_admin','0');
        return $this->db->count_all_results();
    }
    
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){
		$this->db->select('tbl_user_account_type.account_name,user.*');
        $this->db->from($this->table);
        $this->db->join('tbl_user_account_type','tbl_user_account_type.id=user.user_role','LEFT');
		
        $i = 0;
        foreach($this->column_search as $item){
            if($postData['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                if(count($this->column_search) - 1 == $i){
                    $this->db->group_end();
                }
            }
            $i++;
        }
		
		$this->db->where('user.user_admin','0');
		
        if(isset($postData['order'])){
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}
?>