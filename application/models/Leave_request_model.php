<?php
class Leave_request_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		
		$this->table = 'tbl_leave_request_master';       
		$this->column_order = array(
            '0'=>'tbl_leave_request_master.id',
            '1'=>'employee.employeename',
            '2'=>'tbl_attendance_leave_category.category_name',
            '3'=>'tbl_leave_request_master.request_leave_type',
            '4'=>'tbl_leave_request_master.request_start_date',
            '5'=>'tbl_leave_request_master.request_end_date'
        );
		$this->column_search = array(
            '0'=>'employee.employeename',
            '1'=>'tbl_attendance_leave_category.category_name',
            '2'=>'tbl_leave_request_master.request_start_date',
            '3'=>'tbl_leave_request_master.request_end_date',
        );
        $this->order = array('tbl_leave_request_master.request_end_date' => 'DESC');
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
		
		if($this->session->userdata('user_emp')==1){
			$user_id = $this->session->userdata('user_id');
			$this->db->where('request_emp_id',$user_id);
		}else{
			$this->db->where('request_status','0');
		}
		
        return $this->db->count_all_results();
    }
    
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){
		$this->db->select('employee.employeename,tbl_attendance_leave_category.category_name,tbl_leave_request_master.*');
        $this->db->from($this->table);
        $this->db->join('employee','employee.employee_id=tbl_leave_request_master.request_emp_id');
        $this->db->join('tbl_attendance_leave_category','tbl_attendance_leave_category.id=tbl_leave_request_master.request_leave_category');
		
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
		
		if($this->session->userdata('user_emp')==1){
			$user_id = $this->session->userdata('user_id');
			$this->db->where('tbl_leave_request_master.request_emp_id',$user_id);
		}else{
			$this->db->where('tbl_leave_request_master.request_status','0');
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