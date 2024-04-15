
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sys_model extends CI_Model
{
    
    public function get_subsubcategory($cid){
		$query = $this->db->query("select s2.subsubcategoryid,s2.subsubcategoryname,s1.subcategoryid,s1.subcategoryname,c.categoryid,c.categoryname from subsubcategory s2, subcategory s1, category c where s2.subcategoryid = s1.subcategoryid and s1.categoryid = c.categoryid");			
		return $query->result();
	}
	
	public function get_voucher_details($company_id,$id){
		$query = $this->db->query("SELECT * from voucher a,voucherrecords b where a.voucherid = b.voucherid and a.voucherid = $id and a.company_id = $company_id and a.status = 0");		
		return $query->result();
	}
	
	public function get_creditnote_details($company_id,$id){
		$query = $this->db->query("SELECT * from creditnotes a,creditnotes_records b where a.credit_id = b.credit_id and a.credit_id = $id and a.company_id = $company_id and a.status = 0");		
		return $query->result();
	}
	
	public function get_subsubcategory_record($sid){
		$query = $this->db->query("select s2.subsubcategoryid,s2.subsubcategoryname,s1.subcategoryid,s1.subcategoryname,c.categoryid,c.categoryname from subsubcategory s2, subcategory s1, category c where s2.subcategoryid = s1.subcategoryid and s1.categoryid = c.categoryid and s2.subsubcategoryid = $sid");			
		return $query->row();
	}
	
	public function get_accountname_ajax($key){
		
		$company_id = get_customercompanyid();
		
		$query = $this->db->query("select * from accountnames where status = 0 and company_id in (0,$company_id) and accountname like '%$key%' order by accountname asc");
		
		return $query->result();		
	}
	
	
	
	public function get_purchase_quote_list(){
	
		
	$query = $this->db->query("select quotenumber,purchasequoteid from purchasequote where purchasequoteid not in(select quoteno from purchaseorder)");
				
		return $query->result();
	}
	
	public function get_purchase_order_list(){
		
		
		$query = $this->db->query("select purchaseorderid,purchaseordernum from purchaseorder where purchaseorderid not in(select purchaseordernum from grn)  ");
				
		return $query->result();
	}
	
	public function get_towhom_ajax($key,$type){
		
		$company_id = get_customercompanyid();
		
		$query = $this->db->query("select distinct towhom from voucher where status = 0 and company_id = $company_id and towhom like '%$key%' and vouchertype = $type");
		
		return $query->result();		
	}
	
	
	public function get_purchaseorderrecords($id){
		
		$query = $this->db->query("select b.itemid,b.itemcode as item,a.* from purchaseorderrecords a, itemmaster b,purchaseorder c where b.itemid = a.itemcode and a.purchaseorderid = c.purchaseorderid and c.purchaseorderid = '$id'");
		
		return $query->result();
	}
	
	public function get_purchasequoterecord($id){
		
		
		$query = $this->db->query("select b.itemcode as item,a.* from purchasequoterecords a, itemmaster b,purchasequote c where b.itemid = a.itemcode and a.quoteid = c.purchasequoteid and c.purchasequoteid = '$id'");
		
		return $query->result();
	}
	
	public function get_sales_invoice_list($cid){
		$query = $this->db->query("select salesinvoiceid,invoicenumber from salesinvoice where company_id = $cid");
		return $query->result();
	}
	
	
	
	public function get_salesinvoice_records_gdn($invoiceid){
	  $query = $this->db->query("select b.itemname,b.itemcode as item,a.* from salesinvoicerecords a, itemmaster b,salesinvoice c where b.itemid = a.itemcode and a.invoiceid = c.salesinvoiceid and c.salesinvoiceid = '$invoiceid'");
		
		return $query->result();
	}
		
	
	public function get_order_quote_list(){

		
		$query = $this->db->query("select quotenumber,salesquoteid from salesquote where salesquoteid not in(select quoteno from salesorder)");
				
		return $query->result();
	}
	
	public function get_sales_order_list_for_invoice(){
	
		
     $query = $this->db->query("select salesorderid,salesordernum from salesorder where salesorderid not in(select ordernum from salesinvoice)");
	
	
				
		return $query->result();
	}
	
	
	public function get_salesquoterecords($id){
		
		$query = $this->db->query("select b.itemname,b.itemcode as item,a.* from salesquoterecords a, itemmaster b,salesquote c where b.itemid = a.itemcode and a.quoteid = c.salesquoteid and c.salesquoteid = '$id'");
		
		return $query->result();
	}
	
	public function get_salesorder_records_invoice($id){
		$query = $this->db->query("select b.itemname, b.itemcode as item,a.* from salesorderrecords a, itemmaster b,salesorder c where b.itemid = a.itemcode and a.salesorderid = c.salesorderid and c.salesorderid = '$id'");
		
		return $query->result();
	}
	
	public function get_purchase_vouchers($cid){
		$query = $this->db->query("SELECT v2.voucherid FROM voucher v1, voucher v2 where v1.vouchertype = 5 and v1.status = 0 and v1.voucherid = v2.voucherlink and v1.totaldebit <> v2.totaldebit and v1.companyid = v2.companyid and v1.companyid = $cid");			
		return $query->row();
	}
	public function get_sales_vouchers($cid){
		$query = $this->db->query("SELECT v2.voucherid FROM voucher v1, voucher v2 where v1.vouchertype = 6 and v1.status = 0 and v1.voucherid = v2.voucherlink and v1.totaldebit <> v2.totaldebit and v1.companyid = v2.companyid and v1.companyid = $cid");
		return $query->row();
	}
	
	
	public function get_standard_rated_supplies($cid){
		$query = $this->db->query("select sum(totaldebit) as total from voucher where status = 0 and supplies_type = 1 and company_id = $cid");
		return $query->row();
	}
	
	public function get_zero_rated_supplies($cid){
		$query = $this->db->query("select sum(totaldebit) as total from voucher where status = 0 and supplies_type = 2 and company_id = $cid");
		return $query->row();
	}
	
	public function get_exempt_supplies($cid){
		$query = $this->db->query("select sum(totaldebit) as total from voucher where status = 0 and supplies_type = 3 and companyid = $cid");
		return $query->row();
	}
	
	public function get_gst_purchase_total($cid){
		$query = $this->db->query("select sum(v.totaldebit) as total from voucher v,voucherrecords vr where vr.accountname = 305 and vr.voucherid = v.voucherid and v.status = 0 and v.companyid = $cid");
		return $query->row();
	}
	
	public function get_purchase_invoice_reports($str){
		$query = $this->db->query("select * from purchaseinvoice where $str");
		return $query->result();
	}
	
	public function get_sales_invoice_reports($str){
		$query = $this->db->query("select * from salesinvoice where $str");
		return $query->result();
	}
	
	
	
	public function get_invoice_total_quantity($invoiceid){
		$query = $this->db->query("select sum(quantity) as quantity from salesinvoicerecords where invoiceid = $invoiceid");
		return $query->row();
	}
	
	
	public function get_dispatched_item($invoice,$item){
		$query = $this->db->query("SELECT sum(gr.dispatched) as dispatched FROM gdn g, gdnrecords gr where g.salesinvoiceid = $invoice and g.gdnid = gr.gdnid and gr.itemid = $item");
		
		return $query->row();
	}
	
	public function get_purchase_quote_list_for_invoice(){
		
		
		$query = $this->db->query("select purchaseorderid,purchaseordernum from purchaseorder where purchaseorderid not in(select ordernum from purchaseinvoice)");
				
		return $query->result();
	}
	
	public function get_grn_list(){
	
		
		$query = $this->db->query("select grnid,grnnumber from grn where grnid not in(select grnnumber from purchaseinvoice)");
				
		return $query->result();
	}
	
	public function get_grn_records_invoice($id){
		
		$query = $this->db->query("select b.itemname,b.itemcode as item,a.itemid,a.received,e.unitprice from grnrecords a, itemmaster b, grn d,purchaseorderrecords e where b.itemid = a.itemid and a.grnid = d.grnid and d.grnid = '$id' and e.purchaseorderid = d.purchaseordernum and e.itemcode = a.itemid");
		
		return $query->result();
	}
	
	public function get_purchaseorder_records_invoice($id){
		$query = $this->db->query("select b.itemid,b.itemname, b.itemcode as item,a.*,a.quantity as received from purchaseorderrecords a, itemmaster b,purchaseorder c where b.itemid = a.itemcode and a.purchaseorderid = c.purchaseorderid and c.purchaseordernum = '$id'");
		
		return $query->result();
	}
	
	public function get_latest_voucher_authorized(){
		$company_id = get_customercompanyid();
		
		$query = $this->db->query("select authorizedby from voucher order by voucherid desc limit 0,1");
				
		return $query->row();
	}
	
	
	public function get_customerdetails($uid){		
		
		$query = $this->db->query("select * from customers a,customerdetails b,company c where a.customerid = $uid and b.customerid = $uid and c.customerid = $uid");
		
		return $query->row();
	}
	
	public function get_accountnames(){		
		$company_id = get_customercompanyid();
		
		$query = $this->db->query("select * from accountnames where status != 2 and company_id =$company_id order by accountname asc");
		
		return $query->result();
	}
	
	
	public function get_purchasequoterecords($id){
		$query = $this->db->query("select b.itemname as item,a.* from purchasequoterecords a, itemmaster b,purchasequote c where b.itemid = a.itemname and a.quoteid = c.purchasequoteid and c.purchasequoteid = '$id'");
		
		return $query->result();
	}
	
	public function get_grn_records_invoice_total_amount($id){
				
		$query = $this->db->query("select sum(a.received * e.unitprice) as totalamount from grnrecords a, itemmaster b, grn d,purchaseorderrecords e where b.itemid = a.itemid and a.grnid = d.grnid and d.grnid = '$id' and e.purchaseorderid = d.purchaseordernum and e.itemname = a.itemid");	
			
		return $query->row();
	}
	
	public function get_vouchers_balance_sheet($cid,$sid,$companyid,$fromDate = '',$toDate = ''){
		$year = get_defaultyeardata();
		if($fromDate && $toDate){
			$fromDate = date("Y-m-d",strtotime($fromDate));
			$toDate = date("Y-m-d",strtotime($toDate));
			
			$query = $this->db->query("select sum(a.debit) as debit,sum(a.credit) as credit,a.accountname,(sum(a.debit)-sum(a.credit)) as diff from voucherrecords a,voucher b where a.accountname in(select accountid from accountnames where categoryid = $cid and subcategoryid = $sid) and a.voucherid = b.voucherid and b.companyid = $companyid and b.status = 0 and b.voucherdate between '$fromDate' and '$toDate' group by a.accountname");			
		}else if(!empty($year)){
			$query = $this->db->query("select sum(a.debit) as debit,sum(a.credit) as credit,a.accountname,(sum(a.debit)-sum(a.credit)) as diff from voucherrecords a,voucher b where a.accountname in(select accountid from accountnames where categoryid = $cid and subcategoryid = $sid) and a.voucherid = b.voucherid and b.companyid = $companyid and b.status = 0 and b.voucherdate between '$year->startdate' and '$year->enddate'  group by a.accountname");					
		}else{
			$query = $this->db->query("select sum(a.debit) as debit,sum(a.credit) as credit,a.accountname,(sum(a.debit)-sum(a.credit)) as diff from voucherrecords a,voucher b where a.accountname in(select accountid from accountnames where categoryid = $cid and subcategoryid = $sid) and a.voucherid = b.voucherid and b.companyid = $companyid and b.status = 0 group by a.accountname");		
		}
		return $query->result();
	}
	
	
	public function get_vouchers_balance_sheet_new($company_id,$fromDate = '',$toDate = ''){
		$year = get_defaultyeardata();
		if($fromDate && $toDate){
			$fromDate = date("Y-m-d",strtotime($fromDate));
			$toDate = date("Y-m-d",strtotime($toDate));
			
			$query = $this->db->query("select c.subsubcategoryid,c.categoryid,c.subcategoryid,sum(a.debit) as debit,sum(a.credit) as credit,a.accountname,(sum(a.credit)-sum(a.debit)) as diff from voucherrecords a,voucher b,accountnames c where c.groupid = 1 and a.accountname = c.accountid and a.voucherid = b.voucherid and b.company_id = $company_id and b.status = 0 and b.voucherdate between '$fromDate' and '$toDate' group by c.categoryid,c.subcategoryid,c.accountid order by c.accountname");			
		}else{
			$query = $this->db->query("select c.subsubcategoryid,c.categoryid,c.subcategoryid,sum(a.debit) as debit,sum(a.credit) as credit,a.accountname,(sum(a.credit)-sum(a.debit)) as diff from voucherrecords a,voucher b,accountnames c where c.groupid = 1 and a.accountname = c.accountid and a.voucherid = b.voucherid and b.company_id = $company_id and b.status = 0 and b.voucherdate between '$year->startdate' and '$year->enddate' group by c.categoryid,c.subcategoryid,c.accountid order by c.categoryid,c.accountname");	
			
		}
		return $query->result();
	}
	
	public function get_balance_sheet_equity($companyid,$fromDate = '',$toDate = ''){
		$year = get_defaultyeardata();
		if($fromDate && $toDate){
			$fromDate = date("Y-m-d",strtotime($fromDate));
			$toDate = date("Y-m-d",strtotime($toDate));
			
			$query = $this->db->query("select (sum(a.debit)-sum(a.credit)) as diff from voucherrecords a,voucher b,accountnames c where c.groupid = 2 and a.accountname = c.accountid and a.voucherid = b.voucherid and b.companyid = $companyid and b.status = 0 and b.voucherdate between '$fromDate' and '$toDate'");			
		}else{
			$query = $this->db->query("select (sum(a.debit)-sum(a.credit)) as diff from voucherrecords a,voucher b,accountnames c where c.groupid = 2 and a.accountname = c.accountid and a.voucherid = b.voucherid and b.companyid = $companyid and b.status = 0 and b.voucherdate between '$year->startdate' and '$year->enddate'");					
		}
		return $query->row();
	}
	
	public function get_general_ledger($company_id){ 
		$year = get_defaultyeardata();
		//$query = $this->db->query("select a.accountname from voucherrecords a, voucher b,accountnames c where b.voucherid = a.voucherid and b.company_id = $company_id and c.groupid = 2 and c.accountid = a.accountname group by a.accountname");		
		//$query = $this->db->query("select o.accountname,a.groupid from openingbalance o,accountnames a where o.companyid = $companyid and o.accountname = a.accountid UNION select vr.accountname,a.groupid from voucherrecords vr,accountnames a,voucher v where v.voucherid = vr.voucherid and v.companyid = $companyid  and  v.voucherdate between '$year->startdate' and '$year->enddate' and a.accountid = vr.accountname group by vr.accountname");	
		$query = $this->db->query("select * from(select o.accountname,a.groupid,a.accountname as name from openingbalance o,accountnames a where o.company_id = $company_id and o.accountname = a.accountid UNION select vr.accountname,a.groupid,a.accountname as name from voucherrecords vr,accountnames a,voucher v where v.voucherid = vr.voucherid and v.company_id = $company_id  and  v.voucherdate between '$year->startdate' and '$year->enddate' and a.accountid = vr.accountname group by vr.accountname) s order by name");
        	
		return $query->result();
	}
	
	public function get_general_ledger_subcategory($companyid,$subsubcategory){ 
		$year = get_defaultyeardata();
		
		echo "select * from(select o.accountname,a.groupid,a.accountname as name from openingbalance o,accountnames a where o.companyid = $companyid and o.accountname = a.accountid and a.subsubcategoryid = $subsubcategory UNION select vr.accountname,a.groupid,a.accountname as name from voucherrecords vr,accountnames a,voucher v where v.voucherid = vr.voucherid and v.companyid = $companyid and  v.voucherdate between '$year->startdate' and '$year->enddate' and a.accountid = vr.accountname and a.subsubcategoryid = $subsubcategory group by vr.accountname) s order by name";
		
		$query = $this->db->query("select * from(select o.accountname,a.groupid,a.accountname as name from openingbalance o,accountnames a where o.companyid = $companyid and o.accountname = a.accountid and a.subsubcategoryid = $subsubcategory UNION select vr.accountname,a.groupid,a.accountname as name from voucherrecords vr,accountnames a,voucher v where v.voucherid = vr.voucherid and v.companyid = $companyid and  v.voucherdate between '$year->startdate' and '$year->enddate' and a.accountid = vr.accountname and a.subsubcategoryid = $subsubcategory group by vr.accountname) s order by name");	
		return $query->result();
	}
	
	public function get_general_ledger_pdf($company_id,$accountname,$start,$end){ 
		$year = get_defaultyeardata();
		
		$query = $this->db->query("select * from(select o.accountname,a.groupid,a.accountname as name from openingbalance o,accountnames a where o.company_id = $company_id and o.accountname = a.accountid UNION select vr.accountname,a.groupid,a.accountname as name from voucherrecords vr,accountnames a,voucher v where v.voucherid = vr.voucherid and v.company_id = $company_id  and  v.voucherdate between '$year->startdate' and '$year->enddate' and a.accountid = vr.accountname group by vr.accountname) s order by name");	
		return $query->result();
	}
		
	public function get_general_ledger_list($company_id,$start,$end){
					
		$query = $this->db->query("select accountname from openingbalance where company_id = $company_id UNION select vr.accountname from voucherrecords vr,accountnames a,voucher v where v.voucherid = vr.voucherid and v.voucherdate between '$start' and '$end' and a.groupid = 1 and a.accountid = vr.accountname group by vr.accountname");		
		return $query->result();
	}
	public function get_ledger_opening_balance_head($company_id){
				
		$query = $this->db->query("select distinct o.accountname from openingbalance o, voucherrecords vr,accountnames a where vr.accountname <> o.accountname and a.accountid = o.accountname and a.groupid = 1 and o.company_id = $company_id");		
		return $query->result();
	}
	
	public function get_general_ledger_equity($companyid){
		$year = get_defaultyeardata();
		if(!empty($year)){
			$query = $this->db->query("select a.accountname from voucherrecords a, voucher b,accountnames c where b.voucherid = a.voucherid and b.companyid = $companyid and c.groupid = 2 and c.accountid = a.accountname and b.status = 0  and b.voucherdate between '$year->startdate' and '$year->enddate'  group by a.accountname");	
		}else{
			$query = $this->db->query("select a.accountname from voucherrecords a, voucher b,accountnames c where b.voucherid = a.voucherid and b.companyid = $companyid and c.groupid = 2 and c.accountid = a.accountname and b.status = 0  group by a.accountname");	
		}
		return $query->result();
	}
	
	public function get_ledger_particulars($aid,$company_id,$accountname,$start,$end){
		$query = $this->db->query("select e.*,f.voucherdate,f.voucherno,f.vouchertype from voucherrecords e,voucher f where e.voucherid in (SELECT b.voucherid FROM `voucherrecords` a,voucher b where  f.voucherdate between '$start' and '$end' and a.accountname = $aid and a.voucherid = b.voucherid and b.company_id = $company_id) and e.accountname <> $aid and e.voucherid = f.voucherid and f.status = 0 order by f.voucherdate");
		
		/*$query = $this->db->query("select distinct v2.*, v.voucherdate,v.voucherno,v.vouchertype from voucherrecords v1, voucherrecords v2, voucher v where v1.accountname = $aid and v1.voucherid = v2.voucherid and v1.voucherid = v.voucherid and v.status = 0 and v.voucherdate between '$start' and '$end' and v.companyid = $companyid having v2.accountname <> $aid order by v.voucherdate");*/
		
		//$query = $this->db->query("select vr.*,v.voucherdate,v.voucherno,v.vouchertype from voucherrecords vr, voucher v where vr.accountname <> $aid and v.voucherid = vr.voucherid and v.voucherdate between '$start' and '$end' and v.companyid = $companyid and v.status = 0 order by v.voucherdate, v.voucherid");
		
		return $query->result();		
	}
	
	public function get_ledger_particulars_helper($aid,$companyid){
		$year = get_defaultyeardata();
		if(!empty($year)){
			$query = $this->db->query("select e.*,f.voucherdate,f.voucherno from voucherrecords e,voucher f where e.voucherid in (SELECT b.voucherid FROM `voucherrecords` a,voucher b where  a.accountname = $aid and a.voucherid = b.voucherid and b.companyid = $companyid) and e.accountname <> $aid and e.voucherid = f.voucherid and f.status = 0  and f.voucherdate between '$year->startdate' and '$year->enddate'");		
		}else{
			$query = $this->db->query("select e.*,f.voucherdate,f.voucherno from voucherrecords e,voucher f where e.voucherid in (SELECT b.voucherid FROM `voucherrecords` a,voucher b where  a.accountname = $aid and a.voucherid = b.voucherid and b.companyid = $companyid) and e.accountname <> $aid and e.voucherid = f.voucherid and f.status = 0");		
		}
		return $query->result();		
	}
	
	public function get_trial_balance($company_id,$fromDate = '',$toDate = ''){		
		$year = get_defaultyeardata();
		if($fromDate && $toDate){
			$fromDate = date("Y-m-d",strtotime($fromDate));
			$toDate = date("Y-m-d",strtotime($toDate));
			
			$query = $this->db->query("SELECT sum(a.debit) as debit,sum(a.credit) as credit,a.accountname FROM voucherrecords a,voucher b where b.voucherid = a.voucherid and b.company_id = $company_id and b.status = 0 and b.voucherdate between '$fromDate' and '$toDate' GROUP BY a.accountname");	
		}else if(!empty($year)){	

			$query = $this->db->query("SELECT sum(a.debit) as debit,sum(a.credit) as credit,a.accountname FROM voucherrecords a,voucher b,accountnames c where b.voucherid = a.voucherid and b.company_id = $company_id and b.status = 0 and b.voucherdate between '$year->startdate' and '$year->enddate' and a.accountname = c.accountid GROUP BY a.accountname order by c.accountname");		
		}else{
			$query = $this->db->query("SELECT sum(a.debit) as debit,sum(a.credit) as credit,a.accountname FROM voucherrecords a,voucher b where b.voucherid = a.voucherid and b.companyid = $companyid and b.status = 0 GROUP BY a.accountname");		
		}
		return $query->result();
	}
	
	public function get_purchaseorder_details($companyid,$id){
		$query = $this->db->query("SELECT * from purchaseorder a,purchaseorderrecords b where a.purchaseorderid = b.purchaseorderid and a.companyid = $companyid and a.purchaseorderid = $id");		
		return $query->result();
	}
	
	public function get_profit_loss($cid,$company_id,$fromDate = '',$toDate = ''){
		$year = get_defaultyeardata();
		
		if($fromDate && $toDate){
			$fromDate = date("Y-m-d",strtotime($fromDate));
			$toDate = date("Y-m-d",strtotime($toDate));
			
			$query = $this->db->query("select a.* from voucherrecords a,voucher b where a.accountname in(select accountid from accountnames where categoryid = $cid order by accountname asc) and a.voucherid = b.voucherid and b.company_id = $company_id and b.status = 0  and b.voucherdate between '$fromDate' and '$toDate'");	
		}else if(!empty($year)){
			$query = $this->db->query("select a.* from voucherrecords a,voucher b, accountnames c where a.accountname in(select accountid from accountnames where categoryid = $cid order by accountname asc) and a.voucherid = b.voucherid and b.company_id = $company_id and b.status = 0  and b.voucherdate between '$year->startdate' and '$year->enddate' and c.accountid = a.accountname order by c.accountname asc");
		}else{
			$query = $this->db->query("select a.* from voucherrecords a,voucher b where a.accountname in(select accountid from accountnames where categoryid = $cid order by accountname asc) and a.voucherid = b.voucherid and b.companyid = $companyid and b.status = 0");		
		}
		return $query->result();
	}
	
	
	
	public function get_voucher_limit($start,$end){
		$company_id = get_customercompanyid();
		
		$year = get_defaultyeardata();
		if(!empty($year)){		
			$query = $this->db->query("select * from voucher where company_id = $company_id and system = 0 and status = 0 and voucherdate between '$year->startdate' and '$year->enddate' order by voucherdate asc limit $start,$end");
		}else{
			$query = $this->db->query("select * from voucher where company_id = $company_id and system = 0 and status = 0 order by voucherdate asc limit $start,$end");
		}
				
		return $query->result();
	}
	
	public function get_voucher_limit_with_condition($start,$end,$tabelname,$where){
		$company_id = get_customercompanyid();
		$query = $this->db->query("select * from $tabelname where v.company_id = $company_id and v.system = 0 and v.status = 0 and $where order by v.voucherdate asc limit $start,$end");
						
		return $query->result();
	}
	
	public function get_voucher_limit_search($start,$end,$key){
		$company_id = get_customercompanyid();
		
		$year = get_defaultyeardata();
		if(!empty($year)){		
			$query = $this->db->query("select * from voucher where company_id = $company_id and 'system' = 0 and status = 0 and voucherdate between '$year->startdate' and '$year->enddate' and (voucherno LIKE '%$key%' OR voucherdate LIKE '%$key%' OR towhom LIKE '%$key%' OR preparedby LIKE '%$key%' OR totaldebit LIKE '%$key%' OR totalcredit LIKE '%$key%' ) order by voucherdate asc  limit $start,$end");
		}else{
			$query = $this->db->query("select * from voucher where company_id = $company_id and 'system' = 0 and status = 0 and (voucherno LIKE '%$key%' OR voucherdate LIKE '%$key%' OR towhom LIKE '%$key%' OR preparedby LIKE '%$key%' OR totaldebit LIKE '%$key%' OR totalcredit LIKE '%$key%' ) order by voucherdate asc limit $start,$end");
		}
				
		return $query->result();
	}
	
	public function get_voucher_limit_search_count($key){
		$company_id = get_customercompanyid();
		
		$year = get_defaultyeardata();
		if(!empty($year)){
			$query = $this->db->query("select * from voucher where company_id = $company_id and 'system' = 0 and status = 0 and voucherdate between '$year->startdate' and '$year->enddate' and (voucherno LIKE '%$key%' OR voucherdate LIKE '%$key%' OR towhom LIKE '%$key%' OR preparedby LIKE '%$key%' OR totaldebit LIKE '%$key%' OR totalcredit LIKE '%$key%' )");
		}else{
			$query = $this->db->query("select * from voucher where company_id = $company_id and 'system' = 0 and status = 0 and (voucherno LIKE '%$key%' OR voucherdate LIKE '%$key%' OR towhom LIKE '%$key%' OR preparedby LIKE '%$key%' OR totaldebit LIKE '%$key%' OR totalcredit LIKE '%$key%' )");
		}
				
		return $query->result();
	}
	
	
	
	public function get_voucher_for_year($company_id,$year){
		$query = $this->db->query("select * from voucher where company_id = $company_id and 'system' = 0 and status = 0 and voucherdate between '$year->startdate' and '$year->enddate'");
			
		return $query->result();
	}
	
	public function get_ledger_opening_balance($cid,$startdate,$Tmpstart,$aid){
		//$query = $this->db->query("select sum(e.debit) as debit,sum(e.credit) as credit from voucherrecords e,voucher f where e.voucherid in (SELECT b.voucherid FROM `voucherrecords` a,voucher b where  f.voucherdate between '$startdate' and '$Tmpstart' and a.accountname = $aid and a.voucherid = b.voucherid and b.companyid = $cid) and e.accountname <> $aid and e.voucherid = f.voucherid and f.status = 0 order by f.voucherdate");
		
		$query = $this->db->query("select sum(vr.debit) - sum(vr.credit) as diff from voucherrecords vr, voucher v where vr.accountname = $aid and v.voucherid = vr.voucherid and v.voucherdate between '$startdate' and '$Tmpstart' and v.company_id = $cid and v.status = 0");
		
					
		return $query->row();
	}
	
	public function get_voucher_for_year_salesinvoice($company_id,$year){
		
	    $query = $this->db->query("select * from voucher where vouchertype = 2 and invoiceno != 0 and company_id = $company_id and 'system' = 0 and status = 0 and voucherdate between '$year->startdate' and '$year->enddate'");
			
		return $query->result();
	}
	
	public function get_voucher_limit_with_condition_salesinvoice($start,$end,$where){
		$company_id = get_customercompanyid();
		$query = $this->db->query("select * from voucher where vouchertype = 2 and invoiceno != 0 and company_id = $company_id and 'system' = 0 and status = 0 and $where order by voucherdate asc limit $start,$end");
						
		return $query->result();
	}
	
	public function get_voucher_limit_with_condition_purchaseinvoice($start,$end,$where){
		$company_id = get_customercompanyid();
		$query = $this->db->query("select * from voucher where vouchertype = 1 and invoiceno != 0 and company_id = $company_id and 'system' = 0 and status = 0 and $where order by voucherdate asc limit $start,$end");
						
		return $query->result();
	}
	
	public function get_voucher_limit_salesinvoice($start,$end){
		$company_id = get_customercompanyid();
		
		$year = get_defaultyeardata();
		if(!empty($year)){		
			$query = $this->db->query("select * from voucher where vouchertype = 2 and invoiceno != 0 and company_id = $company_id and 'system' = 0 and status = 0 and voucherdate between '$year->startdate' and '$year->enddate' order by voucherdate asc limit $start,$end");
		}else{
			$query = $this->db->query("select * from voucher where vouchertype = 2 and invoiceno != 0 and company_id = $company_id and 'system' = 0 and status = 0 order by voucherdate asc limit $start,$end");
		}
				
		return $query->result();
	}
	
	public function get_voucher_limit_purchaseinvoice($start,$end){
		$company_id = get_customercompanyid();
		
		$year = get_defaultyeardata();
		if(!empty($year)){		
			$query = $this->db->query("select * from voucher where vouchertype = 1 and invoiceno != 0 and company_id = $company_id and 'system' = 0 and status = 0 and voucherdate between '$year->startdate' and '$year->enddate' order by voucherdate asc limit $start,$end");
		}else{
			$query = $this->db->query("select * from voucher where vouchertype = 1 and invoiceno != 0 and company_id = $company_id and 'system' = 0 and status = 0 order by voucherdate asc limit $start,$end");
		}
				
		return $query->result();
	}
	
		
		public function get_voucher_limit_salesinvoiceamtdetails($start,$end){
		$company_id = get_customercompanyid();
		
		$year = get_defaultyeardata();
		if(!empty($year)){		
			$query = $this->db->query("SELECT 
    si.*, 
    (SELECT SUM(totaldebit) 
     FROM voucher 
     WHERE invoiceno = si.invoicenumber 
       AND vouchertype = 2 
       AND invoiceno != 0 
       AND company_id = $company_id 
       AND 'system' = 0 
       AND status = 0) AS totaldebit 
FROM 
    salesinvoice si 
JOIN 
    voucher v ON si.invoicenumber = v.invoiceno 
WHERE 
    v.vouchertype = 2 
    AND v.invoiceno != 0 
    AND v.company_id = $company_id 
    AND si.company_id = $company_id  
    AND v.system = 0 
    AND v.status = 0 
    AND v.voucherdate BETWEEN '$year->startdate' AND '$year->enddate' 
GROUP BY 
    si.invoicenumber 
ORDER BY 
    v.voucherdate DESC 
LIMIT 
    $start, $end;
");
		}else{
			$query = $this->db->query("select si.* ,(select sum(totaldebit) from  voucher where invoiceno in (si.invoicenumber) and vouchertype = 2 and invoiceno != 0 and company_id = $company_id and 'system' = 0 and status = 0 ) as totaldebit  from voucher v,salesinvoice si where si.invoicenumber = v.invoiceno and v.vouchertype = 2 and v.invoiceno != 0 and v.company_id = $company_id and si.company_id = $company_id  and  'v.system' = 0 and v.status = 0 group by si.invoicenumber order by v.voucherdate desc limit $start,$end");
		}
				
		return $query->result();
	}
	
	
	public function get_voucher_for_year_salesinvoiceamtdetails($company_id,$year){
		$query = $this->db->query("select si.* ,(select sum(totaldebit) from  voucher where invoiceno in (si.invoicenumber) and vouchertype = 2 and invoiceno != 0 and company_id = $company_id and 'system' = 0 and status = 0 ) as totaldebit  from voucher v,salesinvoice si where si.invoicenumber = v.invoiceno and v.vouchertype = 2 and v.invoiceno != 0 and v.company_id = $company_id and si.company_id = $company_id  and  v.system = 0 and v.status = 0 and v.voucherdate between '$year->startdate' and '$year->enddate' group by si.invoicenumber");			
		return $query->result();
	}
	
	public function get_voucher_for_year_purchaseinvoiceamtdetails($company_id,$year){
		$query = $this->db->query("select si.* ,(select sum(totaldebit) from  voucher where invoiceno in (si.invoicenumber) and vouchertype = 1 and invoiceno != 0 and company_id = $company_id and 'system' = 0 and status = 0 ) as totaldebit  from voucher v,salesinvoice si where si.invoicenumber = v.invoiceno and v.vouchertype = 2 and v.invoiceno != 0 and v.company_id = $company_id and si.company_id = $company_id  and  v.system = 0 and v.status = 0 and v.voucherdate between '$year->startdate' and '$year->enddate' group by si.invoicenumber");			
		return $query->result();
	}
	
	public function get_voucher_for_year_salesinvoiceamtdetailsonly($company_id){
		$query = $this->db->query("select si.* ,(select sum(totaldebit) from  voucher where invoiceno in (si.invoicenumber) and vouchertype = 2 and invoiceno != 0 and company_id = $company_id and 'system' = 0 and status = 0 ) as totaldebit  from voucher v,salesinvoice si where si.invoicenumber = v.invoiceno and v.vouchertype = 2 and v.invoiceno != 0 and v.company_id = $company_id and si.company_id = $company_id  and  v.system = 0 and v.status = 0 group by si.invoicenumber");			
		return $query->result();
	}
	
	
	public function get_monthly_purchase($cid,$year){
		$query = $this->db->query("select sum(totalamount) as amount,Month(`invoicedate`) as month from purchaseinvoice where company_id = $cid and invoicedate between '$year->startdate' and '$year->enddate' group by Year(`invoicedate`), Month(`invoicedate`)");			
		return $query->result();
	}
	
	public function get_monthly_sales($cid,$year){
		$query = $this->db->query("select sum(totalamount) as amount,Month(`invoicedate`) as month from salesinvoice where company_id = $cid and invoicedate between '$year->startdate' and '$year->enddate' group by Month(`invoicedate`),Year(`invoicedate`)");			
		return $query->result();
	}
	
	public function total_receivables($cid){
		$query = $this->db->query("select sum(totalamount) as amount from salesinvoice where company_id = $cid");			
		return $query->row();
	}
	
	public function total_payables($cid){
		$query = $this->db->query("select sum(totalamount) as amount from purchaseinvoice where company_id = $cid");			
		return $query->row();
	}
	
	public function get_voucher_details_text($vid){
		$query = $this->db->query("select v.*,a.accountname from voucherrecords v,accountnames a where v.voucherid = $vid and v.accountname = a.accountid");			
		return $query->result();
	}
	
	public function get_opening_balance_list($company_id){
		$query = $this->db->query("SELECT a.subsubcategoryid,a.categoryid,a.subcategoryid,a.accountid,o.debit,o.credit FROM `openingbalance` o, accountnames a where a.accountid = o.accountname and a.groupid = 1 and o.company_id = $company_id");			
		return $query->result();
	}
	
	public function get_profit_loss_result($cid){
		
		$year = get_defaultyeardata();
		
		$query = $this->db->query("select sum(r.credit)-sum(r.debit) as result from voucherrecords r, accountnames a, voucher v where a.groupid = 2 and (a.categoryid = 6 or a.categoryid = 5 or a.categoryid = 4 or a.categoryid = 3) and a.accountid = r.accountname and v.voucherid = r.voucherid and v.status = 0 and v.company_id = $cid and v.voucherdate between '$year->startdate' and '$year->enddate'");			
		return $query->row();
	}
		
}