<?php
class Set_grn_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		
		$this->table = 'tbl_grn';       
		$this->column_order = array(
            '0'=>'id',
            '1'=>'purchase_order_number',
            '2'=>'purchase_order_date',
			'3'=>'appt_no',
			'4'=>'supplier_code',
			'5'=>'supplier_name',
			'6'=>'gst_no',
			'7'=>'tin_no',
			'8'=>'mode',
			'9'=>'lr_rr_no',
			'10'=>'invoice_no',
			'11'=>'invoice_date',
			'12'=>'status',
			
        );
		$this->column_search = array(
            '0'=>'purchase_order_number',
            '1'=>'purchase_order_date',
			'2'=>'appt_no',
			'3'=>'supplier_code',
			'4'=>'supplier_name',
			'5'=>'gst_no',
			'6'=>'tin_no',
			'7'=>'mode',
			'8'=>'lr_rr_no',
			'9'=>'invoice_no',
			'10'=>'invoice_date',
			'11'=>'status',
        );
        $this->order = array('purchase_order_number' => 'ASC');
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