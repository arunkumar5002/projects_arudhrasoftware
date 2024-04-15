<?php
class set_purchasequote_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		
		$this->table = 'purchasequote';       
		$this->column_order = array(
            '0'=>'purchasequoteid ',
            '1'=>'quotenumber',
            '2'=>'quotedate',
			'3'=>'customerid',
			'4'=>'initiatedby',
			'5'=>'totalamount',
			'6'=>'preparedby',
			'7'=>'authorizedby',
			
        );
		$this->column_search = array(
            '0'=>'quotenumber',
            '1'=>'quotedate',
			'2'=>'customerid',
			'3'=>'initiatedby',
			'4'=>'totalamount',
			'5'=>'preparedby',
			'6'=>'authorizedby',
		
        );
        $this->order = array('quotenumber' => 'ASC');
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