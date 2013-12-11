    <section id="wizard" class="container clearfix main_section ">
                            <?php   $form =array('id'=>'wizard-demo-2',
                                                 'runat'=>'server',
                                                  'class'=>'form-horizontal');
                                     echo form_open_multipart('users/add_pos_users_details/',$form);?>
                             <div   class="row ">
                                 <div class="col col-lg-12">
                                     <fieldset class="wizard-step ">
                                          <legend class="wizard-label "><i class="icon-user"></i> <?php echo $this->lang->line('personal_details') ?></legend>
                                              <div class="row my_wizard">
                                                    <div class="col-sm-3">
                                                        <div class="step_info">
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                 <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;"><img src="img/no_img_180.png" alt=""></div>
                                                                      <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                                                                       <div>
                                                                        <span class="btn btn-default btn-file"><span class="fileupload-new"><?php echo $this->lang->line('select_image') ?></span><span class="fileupload-exists"><?php echo $this->lang->line('change') ?></span>
                                                                        <input type="file" name="userfile" /></span>
                                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $this->lang->line('remove') ?></a>
                                                                   </div>
                                                               </div>
                                                         </div> 
                                                       </div>
                                                        <div class="col-sm-3">
                                                             <div class="form_sep">
                                                                  <label for="firstname" class="req"><?php echo $this->lang->line('first_name') ?></label>                                                                                                       
                                                                    <?php $first_name=array('name'=>'first_name',
                                                                                             'class'=>'required form-control',
                                                                                             'id'=>'first_name',
                                                                                             'value'=>set_value('first_name'));
                                                                    echo form_input($first_name)?> 
                                                             </div>
                                                                        <div class="form_sep">
                                                                                <label for="last_name" class="req"><?php echo $this->lang->line('last_name') ?></label>                                                                                                       
                                                                                      <?php $last_name=array('name'=>'last_name',
                                                                                                            'class'=>'required form-control',
                                                                                                            'id'=>'last_name',
                                                                                                            'value'=>set_value('last_name'));
                                                                                       echo form_input($last_name)?> 
                                                                        </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                        <div class="form_sep">
                                                                                <label for="age" class="req"><?php echo $this->lang->line('age') ?></label>
                                                                                           <?php $age=array('name'=>'age',
                                                                                                            'class'=>'required number form-control',
                                                                                                            'id'=>'age',
                                                                                                            'maxlength'=>"2",
                                                                                                            'value'=>set_value('age'));
                                                                                             echo form_input($age)?> 
                                                                        </div>
                                                                        <div class="form_sep">
                                                                                <label for="address"><?php echo $this->lang->line('sex') ?></label>
                                                                                <select id="sex" name="sex" class="form-control required">
                                                                                    <option value="<?php echo $this->lang->line('male') ?>"><?php echo $this->lang->line('male') ?></option>
                                                                                    <option value="<?php echo $this->lang->line('female') ?>"><?php echo $this->lang->line('female') ?></option>
                                                                                    <option value="<?php echo $this->lang->line('other') ?>"><?php echo $this->lang->line('other') ?></option>                                                                                                       
                                                                                </select>
                                                                        </div>  
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form_sep">
                                                                                <label for="dob" class="req"><?php echo $this->lang->line('date_of') ?></label>
                                                                                <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                                           <?php $dob=array('name'=>'dob',
                                                                                                            'class'=>'required form-control',
                                                                                                            'id'=>'dob',
                                                                                                            'value'=>set_value('dob'));
                                                                                             echo form_input($dob)?>
                                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                                </div>

                                                                        </div>  
                                                                    </div>
                                                      </div>
				       </fieldset>
                                        <fieldset class="wizard-step">     
                                            <legend class="wizard-label "><i class="icon-book"></i><?php echo $this->lang->line('contact_details') ?></legend>                                                                                                        
                                                <div class="row my_wizard" style="margin-top: -20px;">
                                                        <div class="col-sm-3">
                                                                <div class="step_info">
                                                                         <label for="address" class="req"><?php echo $this->lang->line('address') ?></label>													
                                                                        <?php 
                                                                        $address = array(
                                                                                        'name'        => 'address',
                                                                                        'id'          => 'address',
                                                                                        'value'       =>  set_value('address'),
                                                                                        'rows'        => '3',
                                                                                        'cols'        => '10',
                                                                                        'class'       =>'form-control required'

                                                                                      );

                                                                                    echo form_textarea($address);
                                                                        ?>
                                                                </div> 
                                                        </div>
                                                        <div class="col-sm-3">
                                                                <div class="form_sep">
                                                                        <label for="city" class="req"><?php echo $this->lang->line('city') ?></label>													
                                                                                  <?php $city=array('name'=>'city',
                                                                                                    'class'=>'required  form-control',
                                                                                                    'id'=>'city',
                                                                                                    'value'=>set_value('city'));
                                                                                     echo form_input($city)?>
                                                                </div>
                                                                <div class="form_sep">
                                                                        <label for="state" class="req"><?php echo $this->lang->line('state') ?></label>													
                                                                                 <?php $state=array('name'=>'state',
                                                                                                    'class'=>'required  form-control',
                                                                                                    'id'=>'state',
                                                                                                    'value'=>set_value('state'));
                                                                                     echo form_input($state)?>
                                                                </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                <div class="form_sep">
                                                                        <label for="zip" class="req"><?php echo $this->lang->line('zip') ?></label>

                                                                                   <?php $zip=array('name'=>'zip',
                                                                                                    'class'=>'required  form-control',
                                                                                                    'id'=>'zip',
                                                                                                    'value'=>set_value('zip'));
                                                                                     echo form_input($zip)?>
                                                                </div>
                                                                <div class="form_sep">
                                                                        <label for="country" class="req"><?php echo $this->lang->line('country') ?></label>													
                                                                               <?php $country=array('name'=>'country',
                                                                                                    'class'=>'required  form-control',
                                                                                                    'id'=>'country',
                                                                                                    'value'=>set_value('country'));
                                                                                     echo form_input($country)?>
                                                                </div>  
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form_sep">
                                                                        <label for="email"><?php echo $this->lang->line('email') ?></label>													
                                                                                 <?php $email=array('name'=>'email',
                                                                                                    'class'=>'required  form-control email',
                                                                                                    'id'=>'email',
                                                                                                    'value'=>set_value('email'));
                                                                                     echo form_input($email)?>
                                                                </div>
                                                                <div class="form_sep">
                                                                    <input type="text" name="first_name1">
                                                                        <label for="phone"><?php echo $this->lang->line('phone') ?></label>

                                                                         <?php $phone=array('name'=>'phone',
                                                                                                    'class'=>'required  form-control number',
                                                                                                    'id'=>'phone',
                                                                                                    'value'=>set_value('phone'));
                                                                                     echo form_input($phone)?>
                                                                </div>
                                                            </div>
                                                </div>
                                        </fieldset>
					<fieldset class="wizard-step">
                                                        <legend class="wizard-label"><i class="icon-group icon-2x"></i><?php echo $this->lang->line('user_group') ?> </legend>
                                                          <div class="row my_wizard" style="margin-top: -20px;">
                                        <div class="col-sm-3">
                                                <div class="step_info">
                                                    <label for="phone"><?php echo $this->lang->line('branch') ?></label>                                                                                                    
                                                    <select multiple id="branch" name="FromLJ"  class="form-control" style="width:150;height:128px;">
                                                <?php if($_SESSION['admin']==2){ 
                                                    foreach ($branch as $brow) {

                                             ?> <option name="<?php echo $brow->guid ?>" value="<?php echo $brow->guid ?>" onClick="select_branch(this.form.lang)" > <?php echo $brow->store_name ?></option><?php 
                                                    }}else{ foreach ($branch as $brow) {

                                                    ?> <option name="<?php echo $brow->branch_id ?>" value="<?php echo $brow->branch_id ?>" onClick="select_branch(this.form.lang)" > <?php echo $brow->branch_name ?></option>
                                            <?php }}?>

                                            </select>



                                            <input type="hidden" name="depa" id="depa">
                                                </div> 
                                        </div>
                                        <div class="col-sm-3">
                                                <div class="form_sep">
                                                    <label for="phone"><?php echo $this->lang->line('department') ?></label>  
                                                 <select multiple id="myDiv" class="form-control" name="ToLJ" style="width: 150;height:128px;">
                                            </select>
                                                </div>
                                                </div>
                                                <div class="col-sm-1">
                                                <div class="form_sep">
                                            <input type="button" class="btn btn-danger icon-align-left" onClick="move(this.form.ToLJ,this.form.lang),get_selected(this.form.lang)" 
                                                   value=">"  >
                                            </div>
                                                    <div class="form_sep">
                                            <input type="button" class="btn btn-danger icon-align-right" onClick="backmove(this.form.lang,this.form.ToLJ),get_selected(this.form.lang)" 
                                            value="<">
                                                </div>  
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form_sep">
                                                    <label for="phone"><?php echo $this->lang->line('selected_department') ?></label>  
                                            <select multiple  name="lang" size="7" class="form-control"  style="width: 250">

                                            </select>
                                                </div>  
                                            </div>
                                </div>
                                                </fieldset>
                                                <fieldset class="wizard-step">
                                                        <legend class="wizard-label"><i class="icon-key"></i><?php echo $this->lang->line('login_details') ?></legend>
                                                                                  <div class="row my_wizard" style="margin-top: -20px;">
                                                <div class="col-sm-3">
                                                        <div class="step_info">
                                                                <label for="pos_users_id" class="req"><?php echo $this->lang->line('username') ?></label>
                                                                      <?php $username=array('name'=>'pos_users_id',
                                                                                            'class'=>'required  form-control ',
                                                                                            'id'=>'pos_users_id',
                                                                                            'value'=>set_value('pos_users_id'));
                                                                             echo form_input($username)?>
                                                        </div> 
                                                </div>
                                                    <div class="col-sm-3">
                                                        <div class="form_sep">
                                                        <label for="password" class="req"><?php echo $this->lang->line('password') ?></label>												
                                                                      <?php $password=array('name'=>'password',
                                                                                            'class'=>'required  form-control ',
                                                                                            'id'=>'password',
                                                                                            'value'=>set_value('password'));
                                                                             echo form_input($password)?>
                                                    </div>
                                                    <div class="form_sep">

                                                        <label for="reg_password_repeat" class="req"><?php echo $this->lang->line('confirm_password') ?></label>                                                                                               
                                                         <?php $confirm_password=array('name'=>'confirm_password',
                                                                                            'class'=>'required  form-control ',
                                                                                            'id'=>'confirm_password',
                                                                                            'equalto'=>"#password",
                                                                                            'value'=>set_value('confirm_password'));
                                                                             echo form_input($confirm_password)?>
                                                    </div>
                                                    </div>
                                                                                               <div class="col-sm-3">
                                                                                                   <div class="form_sep">&nbsp;</div>
                                                                                                   <div class="form_sep">
                                                                                                       <?php 
                                                                                                       $submit=array(
                                                                                                           'name'=>'submit',
                                                                                                           'value'=>$this->lang->line('save'),
                                                                                                           'class'=>'btn btn-success');
                                                                                                       echo form_button($submit);
                                                                                                       ?>

                                                                                       </div>
                                                                                       </div>
                                                             </div>
                                                </fieldset>
                                 </div>
                             </div>
                            
                  </form>
										
	</section>