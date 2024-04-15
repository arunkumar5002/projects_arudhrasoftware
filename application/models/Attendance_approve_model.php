<?php
class Attendance_approve_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		
		$this->table = 'tbl_attendance_master';
		$this->column_order = array(
            '0'=>'tbl_attendance_master.id',
            '1'=>'tbl_attendance_master.attend_date',
            '2'=>'tbl_attendance_master.attend_emp_id',
            '3'=>'tbl_attendance_master.attend_shift',
            '4'=>'tbl_attendance_master.attend_in_time',
            '5'=>'tbl_attendance_master.attend_work_hours',
            '6'=>'tbl_attendance_master.attend_over_time',
            '7'=>'tbl_attendance_master.attend_total_hours',
            '8'=>'tbl_attendance_master.attend_status',
        );
		$this->column_search = array(
			'0'=>'tbl_attendance_master.attend_shift',
            '1'=>'tbl_attendance_master.attend_date',
            '2'=>'tbl_attendance_master.attend_emp_id',
            '3'=>'employee.employeename',
            '4'=>'employee.designation',
        );
        $this->order = array('tbl_attendance_master.attend_date' => 'DESC');
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
		$this->db->join('employee','employee.emp_id=tbl_attendance_master.attend_emp_id');
		$this->db->where('tbl_attendance_master.attend_status!=','Present');
		$this->db->where('tbl_attendance_master.attend_action_status','0');
        return $this->db->count_all_results();
    }
    
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){
		$this->db->select('employee.employeename,tbl_desigantion_category.designation_name,tbl_attendance_master.*');
        $this->db->from($this->table);
        $this->db->join('employee','employee.emp_id=tbl_attendance_master.attend_emp_id');
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
		
		$this->db->where('tbl_attendance_master.attend_status!=','Present');
		$this->db->where('tbl_attendance_master.attend_action_status','0');
		
        if(isset($postData['order'])){
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}
?>