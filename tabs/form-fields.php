<h2><?php _e( "Form Fields", 'mailflatrate-for-wp' ); ?></h2>

<!-- Placeholder for the field wizard -->

<?php 
echo '<form method="post" action="options.php">'; 
	settings_fields( 'mailflatrate-plugin-setting-form-code' );
    do_settings_sections( 'mailflatrate-plugin-setting-form-code' ); 
	$mailflatratePublicKey=get_option('mailflatrate_public_key');
	$mailflatratePrivateKey=get_option('mailflatrate_private_key');
	$config = new MailWizzApi_Config(array(
    		'apiUrl'        => 'https://app.mailflatrate.com/api/',
    		'publicKey'     => $mailflatratePublicKey,
    		'privateKey'    => $mailflatratePrivateKey,
    		'components' => array(
    	),
		));
		$checkConfig=MailWizzApi_Base::setConfig($config);
		$endpoint = new MailWizzApi_Endpoint_Lists();
		$response=$endpoint->getLists($pageNumber = -1, $perPage = 20000);
		if(isset($response->body['data']['records']))
		{
		if(count($response->body['data']['records']) > 0)
		{?>
        <div class="mailflatrate-list">
        <h4 style="margin: 0"><label><?php _e( 'Select Mailflatrate List', 'mailflatrate-for-wp' ); ?></label></h4>
		<select id="mailflatrate-list" name="mailflatrate-list">
        <option value="0">Please select list</option>
		<?php 
		foreach($response->body['data']['records'] as $list)
		{?>
			<option <?=(strcmp(get_option('mailflatrate-list'),$list['general']['list_uid'])==0)?"selected='selected'":""; ?> value="<?php echo $list['general']['list_uid']; ?>"><?php echo $list['general']['name']; ?></option>
		<?php }?>
    	</select>
        <div class="small-margin available-fields"> 
        <input type="checkbox" id="add_auto_to_editor" name="add_auto_to_editor" checked="checked" /><label for="add_auto_to_editor"><?php echo __('Add required fields to editor automatically', 'mailflatrate-for-wp'); ?></label>
        	
        </div>
        	<div class="available-fields small-margin not-required">
           
            <h4><?php echo __('Choose a field to add to the form', 'mailflatrate-for-wp'); ?></h4>
           		<div class="tiny-margin">
                <strong><?php echo __('Form fields', 'mailflatrate-for-wp'); ?></strong>
               
                <input type="hidden" id="agreetotermhidden" name="agreetotermhidden" value="<?php echo _e( 'Agree to terms', 'mailflatrate-for-wp' ); ?>">
                <input type="hidden" id="submitbuttonhidden" name="submitbuttonhidden" value="<?php echo _e( 'Submit button', 'mailflatrate-for-wp' ); ?>">
                <input type="hidden" id="doyouagreetext" name="doyouagreetext" value="<?php echo _e('do you agree with terms and conditions','mailflatrate-for-wp'); ?>">
                <input type="hidden" id="signuptext" name="signuptext" value="<?php echo _e('Sign up','mailflatrate-for-wp'); ?>">
        			<div class="buttons-fields-mailflatrate">
                    	<?php 
						if(strcmp(get_option('mailflatrate-list'),'')!=0)
							{
								$listfieldsObject = new MailWizzApi_Endpoint_ListFields();
								$responseObject=$listfieldsObject->getFields(get_option('mailflatrate-list'));
								if(isset($responseObject->body['data']['records']))
								{
									$records=$responseObject->body['data']['records'];
									$requiredyes='yes';
									$requiredyesno='no';
									foreach($records as $record)
									{
										if(strcmp($record['required'],'yes')!=0)
										{
										$requiredyesno=(strcmp($record['required'],'yes')==0)?'data-required="yes"':'data-required="no"';
									if((strcmp($record['type']['identifier'],'text')==0 || strcmp($record['type']['identifier'],'geocountry')==0 || strcmp($record['type']['identifier'],'geostate')==0) && strcmp($record['label'],'')!=0)
										{
										?>
										<input type="button" <?=$requiredyesno; ?> value="<?=__($record['label'], 'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" class="mailflatrate-label-insert-text button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
								  <?php }
								  		else if(strcmp($record['type']['identifier'],'dropdown')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input type="button" <?=$requiredyesno; ?> value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" class="mailflatrate-label-insert-dropdown button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="mailflatrate-dropdownhidden">\n<p> \n <label for="<?=$record['tag']; ?>"><?=__($record['label'],'mailflatrate-for-wp'); ?> : </label> \n  										<select id="<?=$record['tag']; ?>" name="<?=$record['tag']; ?>" class="mailflatrate-label-dropdown <?=(strcmp($record['required'],'yes')==0)?'required-class':''; ?>">
                                        	<?php foreach($record['options'] as $key => $option)
											{?>
												<option value="<?=$key; ?>"><?=$option; ?></option>
											<?php }?>
                                        </select>
                                        </p>
                                        </div>
										<?php }
										else if(strcmp($record['type']['identifier'],'checkbox')==0)
										{
											if(strcmp($record['label'],'')!=0)
											{
											?>
										<input type="button" <?=$requiredyesno; ?> value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-checkbox button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else
										{?>
										<input type="button" <?=$requiredyesno; ?> value="<?=__($record['tag'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-checkbox button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;	
										<?php }
										}
										else if(strcmp($record['type']['identifier'],'consentcheckbox')==0)
										{
											if(strcmp($record['label'],'')!=0)
											{?>
										<input type="button" <?=$requiredyesno; ?> value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-checkbox button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else
										{?>
											<input type="button" <?=$requiredyesno; ?> value="<?=__($record['tag'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-checkbox button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										}
										else if(strcmp($record['type']['identifier'],'multiselect')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input type="button" <?=$requiredyesno; ?> value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-multiselect button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
									<div class="mailflatrate-multiselecthidden">\n<p> \n <label for="<?=$record['tag']; ?>"><?=__($record['label'],'mailflatrate-for-wp'); ?> : </label> \n  
                        			<select multiple="multiple" id="<?=$record['tag']; ?>" name="<?=$record['tag']; ?>" class="mailflatrate-label-multiselect <?=(strcmp($record['required'],'yes')==0)?'required-class':''; ?>">
											<?php foreach($record['options'] as $key => $option)
											{?>
												<option value="<?=$key; ?>"><?=$option; ?></option>
											<?php }?>
						 			</select>
                                        </p>
                                        </div>
										<?php }
										else if(strcmp($record['type']['identifier'],'date')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-date button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else if(strcmp($record['type']['identifier'],'datetime')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-datetime button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else if(strcmp($record['type']['identifier'],'textarea')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-textarea button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else if(strcmp($record['type']['identifier'],'country')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-country button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else if(strcmp($record['type']['identifier'],'state')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-state button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else if(strcmp($record['type']['identifier'],'checkboxlist')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-checkboxlist button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="mailflatrate-checkboxlisthidden">\n<p> \n <label><?=__($record['label'],'mailflatrate-for-wp'); ?>: </label> \n';
						 
						 <?php foreach($record['options'] as $key => $option)
											{?>	 
							 <input type="checkbox" class="<?=(strcmp($record['required'],'yes')==0)?'required-class':''; ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" id="<?=$record['tag']; ?>_<?=$key;?>" name="<?=$record['tag']; ?>" value="<?=$option; ?>"> <label for="<?=$record['tag']; ?>_<?=$key;?>"><?=$option; ?></label>\n
						 <?php }
						  ?></div>
										<?php }
										else if(strcmp($record['type']['identifier'],'radiolist')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-radiolist button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="mailflatrate-radiolisthidden">\n<p> \n <label><?=__($record['label'],'mailflatrate-for-wp') ?>: </label> \n';
						 
						<?php foreach($record['options'] as $key => $option)
											{?>
							  <input type="radio" <?=(strcmp($record['required'],'yes')==0)?'required-class':''; ?> id="<?=$record['tag']; ?>_<?=$key;?>" name="<?=$record['tag']; ?>" value="<?=$option; ?>"> <label for="<?=$record['tag']; ?>_<?=$key;?>"><?=$option; ?></label>\n
						
                        <?php } ?></div>
										<?php }
									}
									}
								}
								
							} ?>
            		</div>
                </div>
            </div>
            
            
            
            <!-- required fields -->
            <div class="available-fields small-margin required">
           
            <h4><?php echo __('Choose a field to add to the form', 'mailflatrate-for-wp'); ?></h4>
           		<div class="tiny-margin">
                <strong><?php echo __('Required Form fields', 'mailflatrate-for-wp'); ?></strong>
        			<div class="buttons-fields-mailflatrate">
                    	<?php 
						if(strcmp(get_option('mailflatrate-list'),'')!=0)
							{
								$listfieldsObject = new MailWizzApi_Endpoint_ListFields();
								$responseObject=$listfieldsObject->getFields(get_option('mailflatrate-list'));
								if(isset($responseObject->body['data']['records']))
								{
									$records=$responseObject->body['data']['records'];
									$requiredyes='yes';
									$requiredyesno='no';
									foreach($records as $record)
									{
										if(strcmp($record['required'],'yes')==0)
										{
									$requiredyesno=(strcmp($record['required'],'yes')==0)?'data-required="yes"':'data-required="no"';
									if((strcmp($record['type']['identifier'],'text')==0 || strcmp($record['type']['identifier'],'geocountry')==0 || strcmp($record['type']['identifier'],'geostate')==0) && strcmp($record['label'],'')!=0)
										{
										?>
										<input type="button" <?=$requiredyesno; ?> value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-text button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
								  <?php }
								  		else if(strcmp($record['type']['identifier'],'dropdown')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input type="button" <?=$requiredyesno; ?> value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-dropdown button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="mailflatrate-dropdownhidden">\n<p> \n <label for="<?=$record['tag']; ?>"><?=__($record['label'],'mailflatrate-for-wp'); ?> : </label> \n  										<select id="<?=$record['tag']; ?>" name="<?=$record['tag']; ?>" class="mailflatrate-label-dropdown <?=(strcmp($record['required'],'yes')==0)?'required-class':''; ?>">
                                        	<?php foreach($record['options'] as $key => $option)
											{?>
												<option value="<?=$key; ?>"><?=$option; ?></option>
											<?php }?>
                                        </select>
                                        </p>
                                        </div>
										<?php }
										else if(strcmp($record['type']['identifier'],'checkbox')==0)
										{
											if(strcmp($record['label'],'')!=0)
											{?>
											<input type="button" <?=$requiredyesno; ?> value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-checkbox button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else
										{?>
											<input type="button" <?=$requiredyesno; ?> value="<?=__($record['tag'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-checkbox button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
                                         }
										else if(strcmp($record['type']['identifier'],'consentcheckbox')==0)
										{
											if(strcmp($record['label'],'')!=0)
											{
											?>
										<input type="button" <?=$requiredyesno; ?> value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-checkbox button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php 
											}
											else
											{?>
										<input type="button" <?=$requiredyesno; ?> value="<?=__($record['tag'],'mailflatrate-for-wp'); ?>" htHelpText="<?=str_replace('"',"'",$record['help_text']); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-checkbox button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php 
												
											}
											}
										else if(strcmp($record['type']['identifier'],'multiselect')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input type="button" <?=$requiredyesno; ?> value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-multiselect button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
									<div class="mailflatrate-multiselecthidden">\n<p> \n <label for="<?=$record['tag']; ?>"><?=__($record['label'],'mailflatrate-for-wp'); ?> : </label> \n  
                        			<select multiple="multiple" id="<?=$record['tag']; ?>" name="<?=$record['tag']; ?>" class="mailflatrate-label-multiselect <?=(strcmp($record['required'],'yes')==0)?'required-class':''; ?>">
											<?php foreach($record['options'] as $key => $option)
											{?>
												<option value="<?=$key; ?>"><?=$option; ?></option>
											<?php }?>
						 			</select>
                                        </p>
                                        </div>
										<?php }
										else if(strcmp($record['type']['identifier'],'date')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-date button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else if(strcmp($record['type']['identifier'],'datetime')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-datetime button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else if(strcmp($record['type']['identifier'],'textarea')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-textarea button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else if(strcmp($record['type']['identifier'],'country')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-country button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else if(strcmp($record['type']['identifier'],'state')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-state button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }
										else if(strcmp($record['type']['identifier'],'checkboxlist')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-checkboxlist button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="mailflatrate-checkboxlisthidden">\n<p> \n <label><?=$record['label']; ?>: </label> \n';
						 
						 <?php foreach($record['options'] as $key => $option)
											{?>	 
							 <input type="checkbox" class="<?=(strcmp($record['required'],'yes')==0)?'required-class':''; ?>" id="<?=$record['tag']; ?>_<?=$key;?>" name="<?=$record['tag']; ?>" value="<?=$option; ?>"> <label for="<?=$record['tag']; ?>_<?=$key;?>"><?=$option; ?></label>\n
						 <?php }
						  ?></div>
										<?php }
										else if(strcmp($record['type']['identifier'],'radiolist')==0 && strcmp($record['label'],'')!=0)
										{?>
										<input <?=$requiredyesno; ?> type="button" value="<?=__($record['label'],'mailflatrate-for-wp'); ?>" htname="<?=$record['tag']; ?>" id="id_<?=$record['tag']; ?>" class="mailflatrate-label-insert-radiolist button not-in-form" name="name_<?=$record['tag']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="mailflatrate-radiolisthidden">\n<p> \n <label><?=__($record['label'],'mailflatrate-for-wp'); ?>: </label> \n';
						 
						<?php foreach($record['options'] as $key => $option)
											{?>
							  <input type="radio" <?=(strcmp($record['required'],'yes')==0)?'required-class':''; ?> id="<?=$record['tag']; ?>_<?=$key;?>" name="<?=$record['tag']; ?>" value="<?=$option; ?>"> <label for="<?=$record['tag']; ?>_<?=$key;?>"><?=$option; ?></label>\n
						
                        <?php } ?></div>
										<?php }
										}
									}
								}
								?>
								<button class="button not-in-form submitbuttonadd" required="yes" type="button" value="0"><?php _e( 'Submit button', 'mailflatrate-for-wp' ); ?></button>&nbsp;&nbsp;&nbsp;&nbsp;
								<?php
							} ?>
            		</div>
                </div>
            </div>
            
            <!-- required field ends -->
            
            
            </div>
            <div id="mailflatrate-field-wizard">
<div class="mailflatrate-row">
	<div class="mailflatrate-col mailflatrate-col-3 mailflatrate-form-editor-wrap">
		<h4 style="margin: 0"><label><?php _e( 'Form code', 'mailflatrate-for-wp' ); ?></label></h4>
		<!-- Textarea for the actual form content HTML -->
		<textarea class="widefat" cols="160" rows="20" id="mailflatrate_form_code" name="mailflatrate_form_code" placeholder="<?php _e( 'Enter the HTML code for your form fields..', 'mailflatrate-for-wp' ); ?>" autocomplete="false" autocorrect="false" autocapitalize="false" spellcheck="false"><?php echo esc_attr( get_option('mailflatrate_form_code') ); ?></textarea>
	</div>
</div>

<div class="mailflatrate-row">
	<h4 style="margin: 0"><label><?php _e( 'Preview', 'mailflatrate-for-wp' ); ?></label></h4>
    <iframe class="subscribe" id="preview"></iframe>
</div>
</div>

        <?php
		submit_button(); 
		 }
		else
		{
			echo __("You don't have list on mailflatrate. Please login and create list on https://www.app.mailflatrate.com/api/ in your account.", 'mailflatrate-for-wp');
		}
		}
		else
		{
			echo __("Plugin is not connected to mailflatrate server. Please create your private and public key on mailflatrate and put", 'mailflatrate-for-wp');
			echo "<a href='".admin_url('admin.php?page=mailflatrateOptions')."'>".__("here",'mailflatrate-for-wp	')."</a>";
		}
		 ?>
<!-- This field is updated by JavaScript as the form content changes -->
<?php 
echo '</form>';
?>
<?php // Content for Thickboxes ?>