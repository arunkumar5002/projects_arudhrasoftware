<?php
class Set_bank_entries_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		
		$this->table = 'tbl_bank_entries';       
		$this->column_order = array(
            '0'=>'id',
            '1'=>'bank_account',
            '2'=>'openingbalance'
			'3'=>'date',
			'4'=>'withdraw',
			'5'=>'deposit',
			'6'=>'reference',
			'7'=>'balance',
        );
		$this->column_search = array(
            '0'=>'bank_account',
            '1'=>'openingbalance'
			'2'=>'date',
			''=>'withdraw',
			'4'=>'deposit',
			'5'=>'reference',
			'6'=>'balance',
        );
        $this->order = array('bank_account' => 'ASC');
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
        return $this->db->count_all_results();
    }
    
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){
		$this->db->select('*');
        $this->db->from($this->table);
		
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
		
        if(isset($postData['order'])){
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}
?>