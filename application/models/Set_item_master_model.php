<?php
class Set_item_master_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		
		$this->table = 'itemmaster';       
		$this->column_order = array(
            '0'=>'itemid',
            '1'=>'itemcode',
            '2'=>'itemname',
			'3'=>'category',
			'4'=>'subcategory',
			'5'=>'brand',
			'6'=>'costprice',
			'7'=>'price',
			'8'=>'quantity',
			'9'=>'product_origin',
			'10'=>'location',
			'11'=>'tax',
			'12'=>'min_reorder',
			'13'=>'accountname',
			'14'=>'status',
			'15'=>'item_type',
			
        );
		$this->column_search = array(
            '0'=>'itemcode',
            '1'=>'itemname',
			'2'=>'category',
			'3'=>'subcategory',
			'4'=>'brand',
			'5'=>'costprice',
			'6'=>'price',
			'7'=>'quantity',
			'8'=>'product_origin',
			'9'=>'location',
			'10'=>'tax',
			'11'=>'min_reorder',
			'12'=>'accountname',
			'13'=>'status',
			'14'=>'item_type',
        );
        $this->order = array('itemcode' => 'ASC');
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