<?php
class set_purchase_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		
		$this->table = 'purchaseorder';       
		$this->column_order = array(
            '0'=>'purchaseorderid',
            '1'=>'purchaseordernum',
            '2'=>'quoteno',
			'3'=>'issuedate',
			'4'=>'deliverydate',
			'5'=>'supplier',
			'6'=>'totalamount',
			'7'=>'terms',
			
        );
		$this->column_search = array(
            '0'=>'purchaseordernum',
            '1'=>'quoteno',
			'2'=>'issuedate',
			'3'=>'deliverydate',
			'4'=>'supplier',
			'5'=>'totalamount',
			'6'=>'terms',
		
        );
        $this->order = array('purchaseordernum' => 'ASC');
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