
<script type="text/javascript" charset="utf-8">
    var point=3;
          $(document).ready( function () {
              
        	 refresh_items_table();
                 $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('delivery_note') ?>');
                     $('#add_new_order').hide();
                              posnic_table();
                                
                                parsley_reg.onsubmit=function()
                                { 
                                  return false;
                                } 
                         
                        } );
                function refresh_items_table(){
                    $('#selected_item_table').dataTable().fnClearTable();
                     if($('#selected_item_table').length) {
                   
                $('#selected_item_table').dataTable({
                     "bProcessing": true,
                                      "bDestroy": true ,
				    
                    "sPaginationType": "bootstrap_full",
                    "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
                $("#index", nRow).val(iDisplayIndex +1);
               return nRow;
            },
                });
            }
              $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('sales_order')." ".$this->lang->line('for')." ".$this->lang->line('delivery_note') ?>');
                }        
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/delivery_note/data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                    if(oObj.aData[10]==1){
                                                                        return "<input type=checkbox disabled='disabled' value='"+oObj.aData[0]+"' ><input type='hidden' id='order__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'>";
                                                                         }else{
                   							return "<input type=checkbox value='"+oObj.aData[0]+"' ><input type='hidden' id='order__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'><input type='hidden' id='sales_order__number_"+oObj.aData[0]+"' value='"+oObj.aData[11]+"'>";
                                                                    }
                                                                },
								
								
							},
        
        null, null, null, null, {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							//if(oObj.aData[8]==0)
                                                                      return   oObj.aData[6];
								},
								
								
							}

, null,  null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[10]==1){
                                                                           return '<span data-toggle="tooltip" class="text-success" ><?php echo $this->lang->line('approved') ?></span>'
                                                                        }else{
                                                                            return '<span data-toggle="tooltip"  class=" text-warning" ><?php echo $this->lang->line('waiting') ?></span>';
                                                                        }
								},
								
								
							},
 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                if(oObj.aData[10]==1){
                                                                        //return '<a ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('approved') ?>"><i class="icon-play"></i></span></a>&nbsp<a   ><span data-toggle="tooltip" class="label label-info hint--top hint--success" data-hint="<?php echo $this->lang->line('approved') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a  ><span data-toggle='tooltip' class='label label-danger hint--top hint--success' data-hint='<?php echo $this->lang->line('approved') ?>'><i class='icon-trash'></i></span> </a>";
                                                                       return '<a  ><span data-toggle="tooltip" class="label label-success hint--top hint--success"  ><i class="icon-play"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" ><i class="icon-edit"></i></span></a>'+"&nbsp;<a><span data-toggle='tooltip' class='label label-danger hint--top hint--error' ><i class='icon-trash'></i></span> </a>"
								}else{
                                                                        return '<a href=javascript:good_receiving_note_approve("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('approve') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'")  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
                                                                }
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}

           function posnic_item_table(guid){
           var supplier=$('#edit_brand_form #supplier_guid').val();
           if($('#edit_brand_form #supplier_guid').val()==""){
               supplier=guid;
           }
           
         		 if($('#selected_item_table').length) {
                $('#selected_item_table').dataTable({
                    "sPaginationType": "bootstrap_full"
                });
            }	
                                   
			}
 function user_function(guid){
    <?php if($this->session->userdata['delivery_note_per']['delete']==1){ ?>
             bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')." ".$this->lang->line('delivery_note') ?> "+$('#order__number_'+guid).val(), function(result) {
             if(result){
            $.ajax({
                url: '<?php echo base_url() ?>/index.php/delivery_note/delete',
                type: "POST",
                data: {
                    guid: guid
                    
                },
               complete: function(response) {
                    if(response['responseText']=='TRUE'){
                           $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('delivery_note') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else if(response['responseText']=='Approved'){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>  <?php echo $this->lang->line('is');?> <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                    }else{
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('delivery_note');?>', { type: "error" });                       
                    }
                    }
            });
        

                        }
    }); <?php }else{?>
           $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('delivery_note');?>', { type: "error" });                       
   <?php }
?>
                        }
        function good_receiving_note_approve(guid){
            var po=$('#sales_order__number_'+guid).val();
            <?php if($this->session->userdata['delivery_note_per']['approve']==1){ ?>
                $.ajax({
                url: '<?php echo base_url() ?>index.php/delivery_note/good_receiving_note_approve',
                type: "POST",
                data: {
                    guid: guid,
                    po:po
                    
                },
                  complete: function(response) {
                     if(response['responseText']=='TRUE'){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('approved');?>', { type: "success" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else if(response['responseText']=='approve'){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is')." ".$this->lang->line('already')." ".$this->lang->line('approved');?>', { type: "warning" });
                    }else if(response['responseText']=='Noop'){
                           $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('delivery_note');?>', { type: "error" });                       
                    }
                }
            });
             <?php }else{?>
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('delivery_note');?>', { type: "error" });                       
                <?php }?>
               }
        
          
        
        function posnic_active(guid){
                           $.ajax({
                url: '<?php echo base_url() ?>index.php/delivery_note/active',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('isactivated');?>', { type: "success" });
                         $("#dt_table_tools").dataTable().fnDraw();
                    }
                }
            });
        }
          
        function edit_function(guid){
                        <?php if($this->session->userdata['delivery_note_per']['edit']==1){ ?>
                                
                            $('#deleted').remove();
                            $('#parent_items').append('<div id="deleted"></div>');
                            $('#newly_added').remove();
                            $('#parent_items').append('<div id="newly_added"></div>');
                            refresh_items_table();
                            $('#update_button').show();
                            $('#save_button').hide();
                            $('#update_clear').show();
                            $('#save_clear').hide();
                            $('#loading').modal('show');
                            $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/delivery_note/get_delivery_note/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             { 
                                $("#user_list").hide();
                                $('#add_new_order').show('slow');
                                $('#delete').attr("disabled", "disabled");
                                $('#posnic_add_delivery_note').attr("disabled", "disabled");
                                $('#active').attr("disabled", "disabled");
                                $('#deactive').attr("disabled", "disabled");
                                $('#delivery_note_lists').removeAttr("disabled");
                               
                             
                                $("#parsley_reg #first_name").val(data[0]['s_name']);
                                $("#parsley_reg #company").val(data[0]['c_name']);
                                $("#parsley_reg #address").val(data[0]['address']);
                                $("#parsley_reg #delivery_note_guid").val(guid);
                                $("#parsley_reg #demo_order_number").val(data[0]['po_no']);
                                $("#parsley_reg #order_number").val(data[0]['po_no']);
                                $("#parsley_reg #order_date").val(data[0]['po_date']);
                                $("#parsley_reg #expiry_date").val(data[0]['exp_date']);
                                $("#parsley_reg #demo_delivery_note_no").val(data[0]['delivery_note_no']);
                                $("#parsley_reg #delivery_note_date").val(data[0]['delivery_note_date']);
                                $("#parsley_reg #note").val(data[0]['delivery_note_note']);
                                $("#parsley_reg #remark").val(data[0]['delivery_note_remark']);
                              
                               // $("#parsley_reg #demo_order_number").select2('data', {id:'',text: data[0]['po_no']});
                                $(".supplier_select_2").hide();
                                $(".porchase_order_for_delivery_note").show();
                                $("#edit_delivery_note_node").val(data[0]['po_no']);
                                
                                $("#parsley_reg #id_discount").val(data[0]['discount']);
                              
                                $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                                $("#parsley_reg #freight").val(data[0]['freight']);
                                $("#parsley_reg #round_off_amount").val(data[0]['round_amt']);
//                                $("#parsley_reg #demo_grand_total").val(data[0]['total_amt']);
//                                $("#parsley_reg #grand_total").val(data[0]['total_amt']);
//                                
//                                $("#parsley_reg #demo_total_amount").val(data[0]['total_item_amt']);
//                                $("#parsley_reg #total_amount").val(data[0]['total_item_amt']);
//                                
//                                  var num = parseFloat($('#demo_total_amount').val());
//                                  $('#demo_total_amount').val(num.toFixed(point));
//                                  
//                                  var num = parseFloat($('#total_amount').val());
//                                  $('#total_amount').val(num.toFixed(point));
//                                  
//                                  var num = parseFloat($('#grand_total').val());
//                                  $('#grand_total').val(num.toFixed(point));
//                                  
//                                  var num = parseFloat($('#demo_grand_total').val());
//                                  $('#demo_grand_total').val(num.toFixed(point));
                                  
                                $("#parsley_reg #supplier_guid").val(data[0]['s_guid']);
                                $("#parsley_reg #delivery_note_guid").val(guid);
                                var tax;
                                var receive=0;
                                for(i=0;i<data.length;i++){
                               
                                      receive=1;
                                    var  name=data[i]['items_name'];
                                    var  rece_quty=data[i]['rece_quty'];
                                    var  rece_free=data[i]['rece_free'];
                                    var  sku=data[i]['i_code'];
                                    var  quty=parseFloat(data[i]['quty']);
                                    var  limit=data[i]['item_limit'];
                                    var  tax_type=data[i]['tax_type_name'];
                                    var  tax_value=data[i]['tax_value'];
                                    var  tax_Inclusive=data[i]['tax_Inclusive'];
                                  
                                    var  free=parseFloat(data[i]['free']);
                                    var  received_quty=data[i]['received_quty'];
                                    var  received_free=data[i]['received_free'];
                                   
                                    var  cost=data[i]['cost'];
                                    var  price=data[i]['sell'];
                                    var  mrp=data[i]['mrp'];
                                    var  o_i_guid=data[i]['o_i_guid'];
                                    var  date=data[i]['date'];
                                    var  items_id=data[i]['item'];
                                    if(data[i]['dis_per']!=0){
                                    var discount=(parseFloat(quty)*parseFloat(cost))*(data[i]['dis_per']/100);
                                    var per=data[i]['dis_per'];
                                     var num = parseFloat(discount);
                                      discount=num.toFixed(point);
                                    }else{
                                    var discount=data[i]['item_dis_amt'];
                                     var num = parseFloat(discount);
                                      discount=num.toFixed(point);
                                    var per="";
                                  
                                    }
                                    
                                    if(data[i]['tax_Inclusive']==1){
                                        var tax=parseFloat(data[i]['tax_value']);                                    
                                        var tax_amount=(parseFloat(rece_quty)*parseFloat(cost)*tax)/100;
                                        var type='Exc';
                                         var total=((parseFloat(rece_quty)*parseFloat(cost)))-parseFloat(discount)+parseFloat(tax_amount);
                                        var num = parseFloat(total);
                                        total=num.toFixed(point);
                                    }else{
                                        var type="Inc";
                                        var tax=parseFloat(data[i]['tax_value']);
                                        var tax_amount=(parseFloat(rece_quty)*parseFloat(cost)*tax)/100;
                                        var total=(parseFloat(rece_quty)*parseFloat(cost))-discount;
                                        var num = parseFloat(total);
                                        total=num.toFixed(point);
                                  }
                                 var delivery_note_received_quty=parseFloat(received_quty)-parseFloat(rece_quty);
                             
                                 var delivery_note_received_free=parseFloat(received_free)-parseFloat(rece_free);
                                    var addId = $('#selected_item_table').dataTable().fnAddData( [
                                    null,
                                    name,
                                    sku,
                                    cost,
                                    quty,
                                    received_quty,
                                    free,
                                    received_free,
                                    "<input type='hidden' id='total_id_"+i+"' value='"+total+"'><input type='hidden' id='tax_inclusive_"+i+"' value='"+data[i]['tax_Inclusive']+"' ><input type='hidden' id='discount_amt_"+i+"' value='"+discount+"' ><input type='hidden' id='cost_id_"+i+"' value='"+cost+"' ><input type='hidden' name='delivery_note_items_guid[]' value='"+data[i]['delivery_note_items_guid']+"' ><input type='hidden' id='delivery_note_old_quantity_"+i+"' value='"+rece_quty+"' ><input type='hidden' name='items[]' value='"+data[i]['item']+"' ><input type='hidden' id='o_quty_id_"+i+"' value='"+parseFloat(quty-delivery_note_received_quty)+"' ><input type='text' id='r_quty_id_"+i+"' name='receive_quty[]' value='"+rece_quty+"' onkeyup='receive_quty_items("+i+")' onKeyPress='receive_quty(event,"+i+");return numbersonly(event)' class='form-control' style='width:100px'>",
                                    "<input type='hidden' id='tax_value_"+i+"' value='"+data[i]['tax_value']+"' ><input type='hidden' id='discount_per_"+i+"' value='"+per+"' ><input type='hidden' id='delivery_note_old_free_"+i+"' value='"+rece_free+"' ><input type='hidden' name='order_items[]' value='"+data[i]['o_i_guid']+"' ><input type='hidden' id='o_free_id_"+i+"' value='"+parseFloat(free-delivery_note_received_free)+"' ><input type='text' id='r_free_id_"+i+"' name='receive_free[]' value='"+rece_free+"' onkeyup='receive_free_items_update("+i+")' onKeyPress='receive_free(event,"+i+","+data.length+");return numbersonly(event)' class='form-control' style='width:90px'>",

                                type+':'+tax_amount,
                                  discount,
                                  total
                                 
                                 ] );

                              var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                              theNode.setAttribute('id','new_item_row_id_'+i)
                                
                                }
                                    total_amount();
                             } 
                           });
                  
                          window.setTimeout(function ()
                    {
                       //$('#parsley_reg #delivery_date').focus();
                       document.getElementById('order_date').focus();
                       $('#loading').modal('hide');
                    }, 0);
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('delivery_note');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  