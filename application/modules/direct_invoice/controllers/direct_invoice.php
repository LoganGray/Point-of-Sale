<?php
class Direct_invoice extends CI_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        //   $this->get_list();
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='direct_invoice';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    // Direct G R N Data table
    function data_table(){
        $aColumns = array( 'guid','invoice_no','invoice_no','c_name','s_name','invoice_date','total_items','total_amt','active_status','order_status' );	
	$start = "";
			$end="";
		
		if ( $this->input->get_post('iDisplayLength') != '-1' )	{
			$start = $this->input->get_post('iDisplayStart');
			$end=	 $this->input->get_post('iDisplayLength');              
		}	
		$order="";
		if ( isset( $_GET['iSortCol_0'] ) )
		{	
			for ( $i=0 ; $i<intval($this->input->get_post('iSortingCols') ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($this->input->get_post('iSortCol_'.$i)) ] == "true" )
				{
					$order.= $aColumns[ intval( $this->input->get_post('iSortCol_'.$i) ) ]." ".$this->input->get_post('sSortDir_'.$i ) .",";
				}
			}
			
					$order = substr_replace( $order, "", -1 );
					
		}
		
		$like = array();
		
			if ( $_GET['sSearch'] != "" )
		{
		$like =array(
                    'po_no'=>  $this->input->get_post('sSearch'),
                        );
				
			}
					   
			$this->load->model('purchase')	   ;
                        
			 $rResult1 = $this->purchase->get($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->purchase->count($this->session->userdata['branch_id']);
		
		$iTotal =$iFilteredTotal;
		
		$output1 = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		foreach ($rResult1 as $aRow )
		{
			$row = array();
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( $aColumns[$i] == "id" )
				{
					$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
				}
				else if ( $aColumns[$i]== 'invoice_date' )
				{
					/* General output */
					$row[] = date('d-m-Y',$aRow[$aColumns[$i]]);
				}
				else if ( $aColumns[$i] != ' ' )
				{
					/* General output */
					$row[] = $aRow[$aColumns[$i]];
				}
				
			}
				
		$output1['aaData'][] = $row;
		}
                
		
		   echo json_encode($output1);
    }
  
    function  set_seleted_item_suppier($suid){
        $this->session->userdata['supplier_guid']=$suid;
    }
    
   
   function get_item_details(){
       $q= addslashes($_REQUEST['term']);
                $like=array('code'=>$q);    
               
                $where='suppliers_x_items.item_id=items.guid AND suppliers_x_items.active = 0  AND suppliers_x_items.item_active  = 0 AND suppliers_x_items.supplier_id ="'.$this->session->userdata['supplier_guid'].'" AND items.active_status=0  AND items.active=0  ';
                $data=$this->posnic-> posnic_join_like('suppliers_x_items','items',$like,$where);
        echo json_encode($data);
    }   
    
 
 
    
  
function save(){      
     if($this->session->userdata['direct_invoice_per']['add']==1){
        $this->form_validation->set_rules('supplier_guid',$this->lang->line('supplier_guid'), 'required');
        $this->form_validation->set_rules('order_number', $this->lang->line('order_number'), 'required');
        $this->form_validation->set_rules('order_date', $this->lang->line('order_date'), 'required');                      
        $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'numeric');                      
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric'); 
        $this->form_validation->set_rules('round_off_amount', $this->lang->line('round_off_amount'), 'numeric');                      
        $this->form_validation->set_rules('discount', $this->lang->line('discount'), 'numeric');                      
        $this->form_validation->set_rules('freight', $this->lang->line('freight'), 'numeric');                      
        $this->form_validation->set_rules('new_item_id[]', $this->lang->line('new_item_id'), 'required');                      
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_cost[]', $this->lang->line('new_item_cost'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_free[]', $this->lang->line('new_item_free'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_cost[]', $this->lang->line('new_item_cost'), 'required|is_money_multi');                      
        $this->form_validation->set_rules('new_item_mrp[]', $this->lang->line('new_item_mrp'), 'required|is_money_multi');                      
        $this->form_validation->set_rules('new_item_price[]', $this->lang->line('new_item_price'), 'required|is_money_multi');                      
        $this->form_validation->set_rules('new_item_discount_per[]', $this->lang->line('new_item_discount_per'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_discount[]', $this->lang->line('new_item_discount'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_total[]', $this->lang->line('new_item_total'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_tax[]', $this->lang->line('new_item_tax'), 'required|is_money_multi');                      
           
            if ( $this->form_validation->run() !== false ) {    
                $supplier=  $this->input->post('supplier_guid');
                $pono= $this->input->post('order_number');
                $podate= strtotime($this->input->post('order_date'));
                $discount=  $this->input->post('discount');
                $discount_amount=  $this->input->post('discount_amount');
                $freight=  $this->input->post('freight');
                $round_amt=  $this->input->post('round_off_amount');
                $total_items=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
  
     
                $value=array('supplier_id'=>$supplier,'invoice_no'=>$pono,'invoice_date'=>$podate,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'order_status'=>0,'total_item_amt'=>$total_amount,'branch_id'=>  $this->session->userdata['branch_id'],'added_by'=>  $this->session->userdata['guid']);
                $guid=   $this->posnic->posnic_add_record($value,'direct_invoice');
          
                $item=  $this->input->post('new_item_id');
                $quty=  $this->input->post('new_item_quty');
                $cost=  $this->input->post('new_item_cost');
                $free=  $this->input->post('new_item_free');
                $sell=  $this->input->post('new_item_price');
                $mrp=  $this->input->post('new_item_mrp');
                $net=  $this->input->post('new_item_total');
                $per=  $this->input->post('new_item_discount_per');
                $dis=  $this->input->post('new_item_discount');
                $tax=  $this->input->post('new_item_tax');
           
                for($i=0;$i<count($item);$i++){
              
                        $item_value=array('order_id'=>$guid,'discount_per'=>$per[$i],'discount_amount'=>$dis[$i],'tax'=>$tax[$i],'item'=>$item[$i],'quty'=>$quty[$i],'free'=>$free[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i]);
                        $this->load->model('purchase');
                        $this->purchase->add_items($item_value);
                
                        
                }
                $this->posnic->posnic_master_increment_max('direct_invoice')  ;
                 echo 1;
    
                }else{
                   echo 0;
                }
        }else{
                   echo 'noop';
                }
           
    }
    function update(){
            if(isset($_POST['direct_invoice_guid'])){
      if($this->session->userdata['direct_invoice_per']['edit']==1){
        $this->form_validation->set_rules('supplier_guid',$this->lang->line('supplier_guid'), 'required');
        $this->form_validation->set_rules('order_number', $this->lang->line('order_number'), 'required');
        $this->form_validation->set_rules('order_date', $this->lang->line('order_date'), 'required');                     
        $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'numeric');                      
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric'); 
        
        
        $this->form_validation->set_rules('round_off_amount', $this->lang->line('round_off_amount'), 'numeric');                      
        $this->form_validation->set_rules('discount', $this->lang->line('discount'), 'numeric');                      
        $this->form_validation->set_rules('freight', $this->lang->line('freight'), 'numeric');    
        
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'numeric');                      
        $this->form_validation->set_rules('new_item_cost[]', $this->lang->line('new_item_cost'), 'numeric');                      
        $this->form_validation->set_rules('new_item_free[]', $this->lang->line('new_item_free'), 'numeric');                      
        $this->form_validation->set_rules('new_item_mrp[]', $this->lang->line('new_item_mrp'), 'numeric');                      
      
        $this->form_validation->set_rules('new_item_price[]', $this->lang->line('new_item_price'), 'numeric');                      
        $this->form_validation->set_rules('new_item_discount_per[]', $this->lang->line('new_item_discount_per'), 'numeric');                      
        $this->form_validation->set_rules('new_item_discount[]', $this->lang->line('new_item_discount'), 'numeric');                      
        $this->form_validation->set_rules('new_item_total[]', $this->lang->line('new_item_total'), 'numeric');                      
        $this->form_validation->set_rules('new_item_tax[]', $this->lang->line('new_item_tax'), 'numeric');
        
        
        $this->form_validation->set_rules('items_quty[]', $this->lang->line('items_quty'), 'numeric');                      
        $this->form_validation->set_rules('items_cost[]', $this->lang->line('items_cost'), 'numeric');                      
        $this->form_validation->set_rules('items_free[]', $this->lang->line('items_free'), 'numeric');                      
        $this->form_validation->set_rules('items_mrp[]', $this->lang->line('items_mrp'), 'numeric');                      
        $this->form_validation->set_rules('items_price[]', $this->lang->line('items_price'), 'numeric');                      
        $this->form_validation->set_rules('items_discount_per[]', $this->lang->line('items_discount_per'), 'numeric');                      
        $this->form_validation->set_rules('items_discount[]', $this->lang->line('items_discount'), 'numeric');                      
        $this->form_validation->set_rules('items_total[]', $this->lang->line('items_total'), 'numeric');                      
        $this->form_validation->set_rules('items_tax[]', $this->lang->line('items_tax'), 'numeric');                      
           
            if ( $this->form_validation->run() !== false ) {    
                $supplier=  $this->input->post('supplier_guid');
             
                $pono= $this->input->post('order_number');
                $podate= strtotime($this->input->post('order_date'));
                $discount=  $this->input->post('discount');
                $discount_amount=  $this->input->post('discount_amount');
                $freight=  $this->input->post('freight');
                $round_amt=  $this->input->post('round_off_amount');
                $total_items=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
  
     
              $value=array('supplier_id'=>$supplier,'invoice_date'=>$podate,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'total_item_amt'=>$total_amount);
              $guid=  $this->input->post('direct_invoice_guid');
              $update_where=array('guid'=>$guid);
              $this->posnic->posnic_update_record($value,$update_where,'direct_invoice');
          
                $item=  $this->input->post('items_id');
                $quty=  $this->input->post('items_quty');
                $cost=  $this->input->post('items_cost');
                $free=  $this->input->post('items_free');
                $sell=  $this->input->post('items_price');
                $mrp=  $this->input->post('items_mrp');
                $net=  $this->input->post('items_total');
                $per=  $this->input->post('items_discount_per');
                $dis=  $this->input->post('items_discount');
                $tax=  $this->input->post('items_tax');
                for($i=0;$i<count($item);$i++){
               
                       $where=array('order_id'=>$guid,'item'=>$item[$i]);
                       $item_value=array('order_id'=>$guid,'discount_per'=>$per[$i],'discount_amount'=>$dis[$i],'tax'=>$tax[$i],'item'=>$item[$i],'quty'=>$quty[$i],'free'=>$free[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i]);
                       $this->posnic->posnic_update_record($item_value,$where,'direct_invoice_items');
                
                        
                }
                $delete=  $this->input->post('r_items');
                    for($j=0;$j<count($delete);$j++){
                        $this->load->model('purchase');
                        
                         $this->purchase->delete_order_item($delete[$j]);
                    }
                    
                $new_item=  $this->input->post('new_item_id');
                $new_quty=  $this->input->post('new_item_quty');
                $new_cost=  $this->input->post('new_item_cost');
                $new_free=  $this->input->post('new_item_free');
                $new_sell=  $this->input->post('new_item_price');
                $new_mrp=  $this->input->post('new_item_mrp');
                $new_net=  $this->input->post('new_item_total');
                $new_per=  $this->input->post('new_item_discount_per');
                $new_dis=  $this->input->post('new_item_discount');
                $new_tax=  $this->input->post('new_item_tax');
                for($i=0;$i<count($new_quty);$i++){
                    if($new_quty[$i]!=""){

                                  $new_item_value=array('order_id'=>$guid,'discount_per'=>$new_per[$i],'discount_amount'=>$new_dis[$i],'tax'=>$new_tax[$i],'item'=>$new_item[$i],'quty'=>$new_quty[$i],'free'=>$new_free[$i],'cost'=>$new_cost[$i],'sell'=>$new_sell[$i],'mrp'=>$new_mrp[$i],'amount'=>$new_net[$i]);
                                  $this->load->model('purchase');
                                  $this->purchase->add_items($item_value);
                    }
                        
                }
                    
                    
                    
                 echo 1;
    
                }else{
                   echo 0;
                }
        }else{
                   echo 'Noop';
                }
        }
        
        
    }
        
        
function convert_date($date){
   $new=array();
   $new[]= date('n.j.Y', strtotime('+0 year, +0 days',$date));
   echo json_encode($new);
}
function search_supplier(){
    $search= $this->input->post('term');
    $like=array('first_name'=>$search,'last_name'=>$search,'company_name'=>$search,'phone'=>$search,'email'=>$search);       
    $data= $this->posnic->posnic_select2('suppliers',$like)    ;
    echo json_encode($data);
        
}
function delete(){
   if($this->session->userdata['brands_per']['delete']==1){
            if($this->input->post('guid')){
                $this->load->model('purchase');
                $guid=$this->input->post('guid');
                $status=$this->purchase->check_approve($guid);
                    if($status!=FALSE){
                         $this->posnic->posnic_delete($guid,'direct_invoice');
                            
                        echo 1;
                    }else{
                        echo 'Approved';
                    }
            
            }
           }else{
            echo 0;
        }
    
}
function  get_direct_invoice($guid){
    if($this->session->userdata['direct_invoice_per']['edit']==1){
    $this->load->model('purchase');
    $data=  $this->purchase->get_direct_invoice($guid);
    echo json_encode($data);
    }
}

function direct_invoice_approve(){
     if($this->session->userdata['direct_invoice_per']['approve']==1){
            $id=  $this->input->post('guid');
            $this->load->model('purchase');
            $this->purchase->approve_invoice($id);
            $this->purchase->direct_invoice_stock($id,$this->session->userdata['branch_id']);
            echo 1;
     }else{
         echo 0;
     }
    }
function order_number(){
       $data[]= $this->posnic->posnic_master_max('direct_invoice')    ;
       echo json_encode($data);
}
function search_items(){
        $search= $this->input->post('term');
        $guid= $this->input->post('suppler');
        $this->load->model('purchase');
        $data= $this->purchase->search_items($search,$this->session->userdata['branch_id'],$guid);      
        echo json_encode($data);
       
       
        
}
}
?>
