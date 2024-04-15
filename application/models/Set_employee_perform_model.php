<?php
class Set_employee_perform_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table = "tbl_employee_performance";
        $this->column_order = [
            "0" => "id",
            "1" => "tbl_employee_performance.employee_id",
			"2" => "tbl_desigantion_category.designation_name",
			"3" => "tbl_department_category.department_name",
            "4" => "tbl_employee_performance.date_of_review",
            "5" => "tbl_employee_performance.review_period",
            "6" => "tbl_employee_performance.line_manager",
            "7" => "tbl_employee_performance.job_knowledge_rating",
            "8" => "tbl_employee_performance.job_knowledge_comments",
            "9" => "tbl_employee_performance.quality_rating",
            "10" => "tbl_employee_performance.quality_rating_comments",
            "11" => "tbl_employee_performance.attendance_punctuality_rating",
            "12" => "tbl_employee_performance.attendance_punctuality_comments",
            "13" => "tbl_employee_performance.takes_initiative_rating",
            "14" => "tbl_employee_performance.takes_initiative_comments",
            "15" => "tbl_employee_performance.communication_listening_rating",
            "16" => "tbl_employee_performance.communication_listening_comments",
            "17" => "tbl_employee_performance.dependability_rating",
            "18" => "tbl_employee_performance.dependability_comments",
        ];
        $this->column_search = [
		    
            "0" => "employee_id",
			"1" => "designation_name",
			"2" => "department_name",
            "3" => "date_of_review",
            "4" => "review_period",
            "5" => "line_manager",
            "6" => "job_knowledge_rating",
            "7" => "job_knowledge_comments",
            "8" => "quality_rating",
            "9" => "quality_rating_comments",
            "10" => "attendance_punctuality_rating",
            "11" => "attendance_punctuality_comments",
            "12" => "takes_initiative_rating",
            "13" => "takes_initiative_comments",
            "14" => "communication_listening_rating",
            "15" => "communication_listening_comments",
            "16" => "dependability_rating",
            "17" => "dependability_comments",
        ];
        $this->order = ["employeename" => "ASC"];
    }

    public function getRows($postData)
    {
        $this->_get_datatables_query($postData);
        if ($postData["length"] != -1) {
            $this->db->limit($postData["length"], $postData["start"]);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function countAll($postData)
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData)
    {
        $this->db->select("*, tbl_employee_performance.id as perform_id");
        $this->db->from($this->table);
		$this->db->join('employee','employee.employee_id = tbl_employee_performance.employee_id');
		$this->db->join('tbl_desigantion_category','employee.designation = tbl_desigantion_category.id');
        $this->db->join('tbl_department_category','employee.department = tbl_department_category.id');
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($postData["search"]["value"]) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $postData["search"]["value"]);
                } else {
                    $this->db->or_like($item, $postData["search"]["value"]);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData["order"])) {
            $this->db->order_by(
                $this->column_order[$postData["order"]["0"]["column"]],
                $postData["order"]["0"]["dir"]
            );
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}
?>
