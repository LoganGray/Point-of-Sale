
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/data_table/css/bootstrap.min.css">
        <link  rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/dataTables/media/DT_bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/dataTables/extras/TableTools/media/css/TableTools.css">     

        <script src="<?php echo base_url() ?>template/app/js/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>template/data_table/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/data_table/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/data_table/js/jquery.dataTables.js"></script>
			<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/users/users_data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							return "<input type=checkbox >";
								},
								
								
							},
        
        null, null, null, null, null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[9]==0){
                                                                            return '<select  class="select  my_select"><option onclick="" >Active</option><option onclick="" >Inactive</option></select>';
                                                                        }else{
                                                                            return '<a href="#" class="btn my_active btn-success glyphicon glyphicon-thumbs-up glyphicon-left ">Active</a>';
                                                                        }
								},
								
								
							},
 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							return "<a href='edit/" + oObj.aData[0] + "'><i class='icon-edit'></i></a><a href='edit/" + oObj.aData[0] + "'><i class=' icon-remove-circle'></i> </a>";
								},
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
			} );
                       
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

<script type="text/javascript">
   
         $(function() {
               <?php if($msg!==""){ ?>
                var jibi=$.bootstrapGrowl("<?php echo $this->lang->line($msg) ?>jibi", { type: "<?php echo $type ?>" });
               
               <?php }  ?>
               
            });


    </script>