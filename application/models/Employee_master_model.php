<?php
class Employee_master_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		
		$this->table = 'employee';       
		$this->column_order = array(
            '0'=>'id',
            '1'=>'employee.emp_id',
            '2'=>'employee.employeename',
            '3'=>'employee.email',
            '4'=>'employee.mobile',
            '5'=>'tbl_department_category.department_name',
            '6'=>'tbl_desigantion_category.designation_name',
        );
		$this->column_search = array(
            '0'=>'employee.emp_id',
            '1'=>'employee.employeename',
            '2'=>'employee.email',
            '3'=>'employee.mobile',
            '4'=>'tbl_department_category.department_name',
            '5'=>'tbl_desigantion_category.designation_name',
        );
        $this->order = array('employee.employeename' => 'ASC');
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
		$this->db->select('tbl_department_category.department_name,tbl_desigantion_category.designation_name,employee.*');
        $this->db->from($this->table);
		$this->db->join('tbl_department_category','tbl_department_category.id=employee.department');
        $this->db->join('tbl_desigantion_category','tbl_desigantion_category.id=employee.designation');
		
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