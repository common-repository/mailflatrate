// JavaScript Document
jQuery(document).ready(function(e) {
	var ajaxurl=ajax_object.ajax_url;
   jQuery(".nav-tab-wrapper a.nav-tab").click(function(e) {
    e.preventDefault();
	jQuery(".nav-tab-wrapper a.nav-tab").removeClass('nav-tab-active');
	jQuery(this).addClass('nav-tab-active');
	var href=jQuery(this).attr('href');
	
	jQuery(".mailflatrate-tabs .tab").removeClass("tab-active");
	jQuery(href).addClass("tab-active");
	});
	if(jQuery("#mailflatrate_form_code").length > 0)
	{
	var delay;
      // Initialize CodeMirror editor with a nice html5 canvas demo.
      var editor = CodeMirror.fromTextArea(document.getElementById('mailflatrate_form_code'), {
        mode: 'text/html',
		lineNumbers: true,
      });
      editor.on("change", function() {
        clearTimeout(delay);
        delay = setTimeout(updatePreview, 300);
      });
      
      function updatePreview() {
        var previewFrame = document.getElementById('preview');
        var preview =  previewFrame.contentDocument ||  previewFrame.contentWindow.document;
        preview.open();
        preview.write('<style> \
		button, input[type="button"], input[type="submit"] {\
    background-color: #222;\
    border: 0;\
    -webkit-border-radius: 2px;\
    border-radius: 2px;\
    -webkit-box-shadow: none;\
    box-shadow: none;\
    color: #fff;\
    cursor: pointer;\
    display: inline-block;\
    font-size: 14px;\
    font-size: 0.875rem;\
    font-weight: 800;\
    line-height: 1;\
    padding: 1em 2em;\
    text-shadow: none;\
    -webkit-transition: background 0.2s;\
    transition: background 0.2s;\ input[type="text"],\
 input[type="email"],\
 input[type="url"],\
 input[type="password"],\
 input[type="search"],\
 input[type="number"],\
 input[type="tel"],\
 input[type="range"],\
 input[type="date"],\
 input[type="month"],\
 input[type="week"],\
 input[type="time"],\
 input[type="datetime"],\
 input[type="datetime-local"],\
 input[type="color"],\
 textarea {\
    color: #666;\
    background: #fff;\
    background-image: -webkit-linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 0));\
    border: 1px solid #bbb;\
    -webkit-border-radius: 3px;\
    border-radius: 3px;\
    display: block;\
    padding: 0.7em;\
    width: 100%;\
}\
 input[type="text"], \
 input[type="email"], \
 input[type="url"], \
 input[type="password"],\
 input[type="search"], \
 input[type="number"], \
 input[type="tel"],  \
 input[type="range"],\
 input[type="date"],\
 input[type="month"],\
 input[type="week"],\
 input[type="time"],\
 input[type="datetime"],\
 input[type="datetime-local"],\
 input[type="color"],\
 textarea { \
    color: #666;\
    background: #fff;\
    background-image: -webkit-linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 0));\
    border: 1px solid #bbb;\
    -webkit-border-radius: 3px;\
    border-radius: 3px;\
    display: block;\
    padding: 0.7em;\
    width: 100%; \
}\
 button,\
 input,\
 select,\
 textarea {\
    color: #333;\
    font-family: "Libre Franklin", "Helvetica Neue", helvetica, arial, sans-serif;\
    font-size: 15px;\
    font-size: 0.9375rem;\
    font-weight: 400;\
    line-height: 1.66;\
}</style>'+editor.getValue());
        preview.close();
      }
      setTimeout(updatePreview, 300);
	 jQuery(".agreetoterms").click(function(e) {
                    jQuery(this).addClass("in-form").removeClass("not-in-form");
					var editor = jQuery(".CodeMirror")[0].CodeMirror; 
					editor.replaceRange('\n<p> <input type="checkbox" class="mailflatrate-label-checkbox agreeterms" id="agreeterms" name="agreeterms"> <label for="agreeterms">'+jQuery("#doyouagreetext").val()+': </label> \n</p>',CodeMirror.Pos(editor.lastLine()));
                });
	jQuery(".submitbuttonadd").click(function(e) {
                     jQuery(this).addClass("in-form").removeClass("not-in-form");
					var editor = jQuery(".CodeMirror")[0].CodeMirror; 
					editor.replaceRange('\n<p>\n <input type="submit" name="submit" id="submit" value="'+jQuery("#signuptext").val()+'">\n </p>',CodeMirror.Pos(editor.lastLine()));
                });
	jQuery(".mailflatrate-label-insert-text").click(function(e) {
					 jQuery(this).addClass("in-form").removeClass("not-in-form");
 					var editor = jQuery('.CodeMirror')[0].CodeMirror;
					editor.replaceRange('\n<p>\n <label for="'+jQuery(this).attr('htname')+'">'+jQuery(this).val()+': </label> \n<input type="text" id="'+jQuery(this).attr('htname')+'" name="'+jQuery(this).attr('htname')+'" class="mailflatrate-label-text" placeholder="Please enter '+jQuery(this).val()+'">\n</p>\n', CodeMirror.Pos(editor.lastLine()));
				 });
	jQuery(".mailflatrate-label-insert-date").click(function(e) {
					 jQuery(this).addClass("in-form").removeClass("not-in-form");
 					var editor = jQuery('.CodeMirror')[0].CodeMirror;
					editor.replaceRange('\n<p>\n <label for="'+jQuery(this).attr('htname')+'">'+jQuery(this).val()+': </label> \n<input type="text" id="'+jQuery(this).attr('htname')+'" name="'+jQuery(this).attr('htname')+'" class="mailflatrate-label-date" placeholder="Please enter '+jQuery(this).val()+'">\n</p>\n', CodeMirror.Pos(editor.lastLine()));
				 });
				 jQuery(".mailflatrate-label-insert-datetime").click(function(e) {
					 jQuery(this).addClass("in-form").removeClass("not-in-form");
 					var editor = jQuery('.CodeMirror')[0].CodeMirror;
					editor.replaceRange('\n<p>\n <label for="'+jQuery(this).attr('htname')+'">'+jQuery(this).val()+': </label> \n<input type="text" id="'+jQuery(this).attr('htname')+'" name="'+jQuery(this).attr('htname')+'" class="mailflatrate-label-datetime" placeholder="Please enter '+jQuery(this).val()+'">\n</p>\n', CodeMirror.Pos(editor.lastLine()));
				 });
				 jQuery(".mailflatrate-label-insert-textarea").click(function(e) {
					 jQuery(this).addClass("in-form").removeClass("not-in-form");
 					var editor = jQuery('.CodeMirror')[0].CodeMirror;
					editor.replaceRange('\n<p> \n <label for="'+jQuery(this).attr('htname')+'">'+jQuery(this).val()+': </label> \n  	<textarea required value="" placeholder="Please Enter '+jQuery(this).val()+'" id="'+jQuery(this).attr('htname')+'" class="mailflatrate-label-textarea" name="'+jQuery(this).attr('htname')+'" ></textarea> \n </p>', CodeMirror.Pos(editor.lastLine()));
				 });
				 jQuery(".mailflatrate-label-insert-checkbox").click(function(e) {
                    jQuery(this).addClass("in-form").removeClass("not-in-form");
					var editor = jQuery(".CodeMirror")[0].CodeMirror;
					editor.replaceRange('\n<p> <label for="'+jQuery(this).attr('htname')+'"><input type="checkbox" class="mailflatrate-label-checkbox" id="'+jQuery(this).attr('htname')+'" name="'+jQuery(this).attr('htname')+'">'+jQuery(this).attr('htHelpText')+' </label> \n</p>',CodeMirror.Pos(editor.lastLine()));
                });
				jQuery(".mailflatrate-label-insert-country").click(function(e) {
                    	jQuery(this).addClass("in-form").removeClass("not-in-form");
						var editor = jQuery('.CodeMirror')[0].CodeMirror;
						var htmlStringCountry='';
						htmlStringCountry+='<div class="mailflatrate-countryhidden">\n<p>\n \
 									<label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n \
  									<select id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-country">';
 						for(var j=0;j<country.length;j++)
						{
							htmlStringCountry+='<option value="'+country[j]+'">'+country[j]+'</option>';
						}
  						htmlStringCountry+='</select>\n</p></div>';
						editor.replaceRange(htmlStringCountry, CodeMirror.Pos(editor.lastLine()));
                	});
				jQuery(".mailflatrate-label-insert-state").click(function(e) {
                    	jQuery(this).addClass("in-form").removeClass("not-in-form");
						var editor = jQuery('.CodeMirror')[0].CodeMirror;
						var htmlStringCountry='';
						htmlStringCountry+='<div class="mailflatrate-statehidden">\n<p>\n \
 							<label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n<select id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-state">';
  							for(var j=0;j<states.length;j++)
							{
								htmlStringCountry+='<option value="'+states[j]+'">'+states[j]+'</option>';	
							}
  						htmlStringCountry+='</select>\n</p></div>';
						editor.replaceRange(htmlStringCountry, CodeMirror.Pos(editor.lastLine()));
                	});
	jQuery("#mailflatrate-list").change(function(e) {
        jQuery.ajax({
			url:ajaxurl,
			type:"POST",
			data:{
					action:'getListData',
					list_uid:jQuery(this).val(),
			},
			dataType:"json",
			success: function(records)
			{
				var htmlString='';
				var htmlStringNotRequired='';
				var requiredyes='';
				var requiredyesno='';
				for(i=0;i<records.data.length;i++)
				{
					if(records.data[i].tag!=''  && (records.data[i].type.identifier=='text' ||  records.data[i].type.identifier=='geocountry' || records.data[i].type.identifier=='geostate'))
					{
						if(records.data[i].required=='yes')
						{
							requiredyesno='data-required="yes"';
							requiredyes='in-form';
							htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-text button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else
						{
							requiredyesno='data-required="no"';
							requiredyes='not-in-form';
							htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-text button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						
					}
					else if(records.data[i].tag!='' && records.data[i].type.identifier=='dropdown')
					{
						if(records.data[i].required=='yes')
						{
							requiredyesno='data-required="yes"';
							requiredyes='in-form';
							var required_class='required-class';
							htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-dropdown button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						
						htmlString+='<div class="mailflatrate-dropdownhidden">\n<p> \n <label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n  <select id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-dropdown '+required_class+'">';
						 var recordsOptions=Object.keys(records.data[i].options);
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							 htmlString+='<option value="'+recordsOptions[j]+'">'+records.data[i].options[key]+'</option>';
						 }
						htmlString+='</select>\n </p></div>';
						}
						else
						{
							requiredyesno='data-required="no"';
							requiredyes='not-in-form';
							var required_class='required-class';
							htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-dropdown button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						
						htmlStringNotRequired+='<div class="mailflatrate-dropdownhidden">\n<p> \n <label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n  <select id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-dropdown '+required_class+'">';
						 var recordsOptions=Object.keys(records.data[i].options);
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							 htmlStringNotRequired+='<option value="'+recordsOptions[j]+'">'+records.data[i].options[key]+'</option>';
						 }
						htmlStringNotRequired+='</select>\n </p></div>';
						}
						
					}
					else if(records.data[i].tag!='' && records.data[i].type.identifier=='checkbox')
					{
						if(records.data[i].help_text!=null)
						{
							var htHelpText=records.data[i].help_text.trim();
							htHelpText=htHelpText.replace(/"/g,"'");
						}
						else 
						{
							var htHelpText=records.data[i].tag.trim();
							htHelpText=htHelpText.replace(/"/g,"'");
						}
						if(records.data[i].label!='')
						{
							if(records.data[i].required=='yes')
							{
								requiredyesno='data-required="yes"';
								requiredyes='in-form';
								htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htHelpText="'+htHelpText+'"  htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-checkbox button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}
							else
							{
								requiredyesno='data-required="no"';
								requiredyes='not-in-form';
								htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htHelpText="'+htHelpText+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-checkbox button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}
						}
						else
						{
							if(records.data[i].required=='yes')
							{
								requiredyesno='data-required="yes"';
								requiredyes='in-form';
								htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].tag.trim()+'" htHelpText="'+htHelpText+'"  htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-checkbox button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}
							else
							{
								requiredyesno='data-required="no"';
								requiredyes='not-in-form';
								htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].tag.trim()+'" htHelpText="'+htHelpText+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-checkbox button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}
							
						}
					}
					else if(records.data[i].tag!='' && records.data[i].type.identifier=='consentcheckbox')
					{
						if(records.data[i].help_text!=null)
						{
							var htHelpText=records.data[i].help_text.trim();
							htHelpText=htHelpText.replace(/"/g,"'");
						}
						else 
						{
							var htHelpText=records.data[i].tag.trim();
							htHelpText=htHelpText.replace(/"/g,"'");
						}
						if(records.data[i].label!='')
						{
							if(records.data[i].required=='yes')
							{
								requiredyesno='data-required="yes"';
								requiredyes='in-form';
								htmlString+='<input '+requiredyesno+' type="button" htHelpText="'+htHelpText+'" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-checkbox button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}
							else
							{
								requiredyesno='data-required="no"';
								requiredyes='not-in-form';
								htmlStringNotRequired+='<input '+requiredyesno+' htHelpText="'+htHelpText+'" type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-checkbox button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}
						}
						else
						{
							if(records.data[i].required=='yes')
							{
								requiredyesno='data-required="yes"';
								requiredyes='in-form';
								htmlString+='<input '+requiredyesno+' type="button" htHelpText="'+htHelpText+'" value="'+records.data[i].tag.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-checkbox button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}
							else
							{
								requiredyesno='data-required="no"';
								requiredyes='not-in-form';
								htmlStringNotRequired+='<input '+requiredyesno+' htHelpText="'+htHelpText+'" type="button" value="'+records.data[i].tag.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-checkbox button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}
						}
						
					}
					else if(records.data[i].tag!='' && records.data[i].type.identifier=='multiselect')
					{
						if(records.data[i].required=='yes')
						{
							requiredyesno='data-required="yes"';
							requiredyes='in-form';
							var required_class='required-class';
							htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-multiselect button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						htmlString+='<div class="mailflatrate-multiselecthidden">\n<p> \n <label for="'+records.data[i].label.trim()+'">'+records.data[i].label.trim()+': </label> \n  <select multiple="multiple" id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-multiselect '+required_class+'">';
						 var recordsOptions=Object.keys(records.data[i].options);
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							 htmlString+='<option value="'+recordsOptions[j]+'">'+records.data[i].options[key]+'</option>';
						 }
						htmlString+='</select>\n </p></div>';
						}
						else
						{
							requiredyesno='data-required="no"';
							requiredyes='not-in-form';
							var required_class='required-class';
							htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-multiselect button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						htmlStringNotRequired+='<div class="mailflatrate-multiselecthidden">\n<p> \n <label for="'+records.data[i].label.trim()+'">'+records.data[i].label.trim()+': </label> \n  <select multiple="multiple" id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-multiselect '+required_class+'">';
						 var recordsOptions=Object.keys(records.data[i].options);
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							 htmlStringNotRequired+='<option value="'+recordsOptions[j]+'">'+records.data[i].options[key]+'</option>';
						 }
						htmlStringNotRequired+='</select>\n </p></div>';
						}
						
					}
					else if(records.data[i].tag!='' && records.data[i].type.identifier=='date')
					{
						if(records.data[i].required=='yes')
						{
							requiredyesno='data-required="yes"';
							requiredyes='in-form';
							htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-date button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else
						{
							requiredyesno='data-required="no"';
							requiredyes='not-in-form';
							htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-date button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						
					}	
					else if(records.data[i].tag!='' && records.data[i].type.identifier=='datetime')
					{
						if(records.data[i].required=='yes')
						{
							requiredyesno='data-required="yes"';
							requiredyes='in-form';
							htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-datetime button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else
						{
							requiredyesno='data-required="no"';
							requiredyes='not-in-form';
							htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-datetime button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						
					}
					else if(records.data[i].tag!='' && records.data[i].type.identifier=='textarea')
					{
						if(records.data[i].required=='yes')
						{
							requiredyesno='data-required="yes"';
							requiredyes='in-form';
							htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-textarea button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else
						{
							requiredyesno='data-required="no"';
							requiredyes='not-in-form';
							htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-textarea button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						
					}
					else if(records.data[i].tag!='' && records.data[i].type.identifier=='country')
					{
						if(records.data[i].required=='yes')
						{
							requiredyesno='data-required="yes"';
							requiredyes='in-form';
							var required_class='required-class';
							htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-country button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';						
						htmlString+='<div class="mailflatrate-countryhidden">\n<p>\n \
 									<label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n \
  									<select id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-country '+required_class+'">';
 						for(var j=0;j<country.length;j++)
						{
							htmlString+='<option value="'+country[j]+'">'+country[j]+'</option>';
						}
  						htmlString+='</select>\n</p></div>';
						}
						else
						{
							requiredyesno='data-required="no"';
							requiredyes='not-in-form';
							var required_class='required-class';
							htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-country button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';						
						htmlStringNotRequired+='<div class="mailflatrate-countryhidden">\n<p>\n \
 									<label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n \
  									<select id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-country '+required_class+'">';
 						for(var j=0;j<country.length;j++)
						{
							htmlStringNotRequired+='<option value="'+country[j]+'">'+country[j]+'</option>';
						}
  						htmlStringNotRequired+='</select>\n</p></div>';
						}
						
					}
					else if(records.data[i].tag!='' && records.data[i].type.identifier=='state')
					{
						if(records.data[i].required=='yes')
						{
							requiredyesno='data-required="yes"';
							requiredyes='in-form';
							var required_class='required-class';
							htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-state button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						htmlString+='<div class="mailflatrate-statehidden">\n<p>\n \
 							<label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n<select id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-state '+required_class+'">';
  							for(var j=0;j<states.length;j++)
							{
								htmlString+='<option value="'+states[j]+'">'+states[j]+'</option>';	
							}
  						htmlString+='</select>\n</p></div>';
						}
						else
						{
							requiredyesno='data-required="no"';
							requiredyes='not-in-form';
							var required_class='required-class';
							htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-state button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						htmlStringNotRequired+='<div class="mailflatrate-statehidden">\n<p>\n \
 							<label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n<select id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-state '+required_class+'">';
  							for(var j=0;j<states.length;j++)
							{
								htmlStringNotRequired+='<option value="'+states[j]+'">'+states[j]+'</option>';	
							}
  						htmlStringNotRequired+='</select>\n</p></div>';
						}
						
					}
					else if(records.data[i].tag!='' && records.data[i].type.identifier=='checkboxlist')
					{
						if(records.data[i].required=='yes')
						{
							requiredyesno='data-required="yes"';
							requiredyes='in-form';
							var required_class='required-class';
							htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-checkboxlist button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						var recordsOptions=Object.keys(records.data[i].options);
						
						htmlString+='<div class="mailflatrate-checkboxlisthidden">\n<p> \n <label>'+records.data[i].label.trim()+': </label> \n';
						 
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							 htmlString+='<input type="checkbox" class="mailflatrate-label-checkboxlist '+required_class+' tag_'+records.data[i].tag.trim()+'" id="'+records.data[i].tag.trim()+'_'+recordsOptions[j]+'" data-checkboxlist="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" value="'+records.data[i].options[key]+'"> <label for="'+records.data[i].tag.trim()+'_'+recordsOptions[j]+'">'+records.data[i].options[key]+'</label>\n';
						 }
						 htmlString+="</div>";
						}
						else
						{
							requiredyesno='data-required="no"';
							requiredyes='not-in-form';
							var required_class='required-class';
							htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-checkboxlist button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						var recordsOptions=Object.keys(records.data[i].options);
						
						htmlStringNotRequired+='<div class="mailflatrate-checkboxlisthidden">\n<p> \n <label>'+records.data[i].label.trim()+': </label> \n';
						 
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							 htmlStringNotRequired+='<input type="checkbox" class="mailflatrate-label-checkboxlist '+required_class+' tag_'+records.data[i].tag.trim()+'" id="'+records.data[i].tag.trim()+'_'+recordsOptions[j]+'" data-checkboxlist="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" value="'+records.data[i].options[key]+'"> <label for="'+records.data[i].tag.trim()+'_'+recordsOptions[j]+'">'+records.data[i].options[key]+'</label>\n';
						 }
						 htmlStringNotRequired+="</div>";
						}
						
					}
					else if(records.data[i].tag!='' && records.data[i].type.identifier=='radiolist')
					{
						if(records.data[i].required=='yes')
						{
							requiredyesno='data-required="yes"';
							requiredyes='in-form';
							var required_class='required-class';
							htmlString+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-radiolist button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						var recordsOptions=Object.keys(records.data[i].options);
						
						htmlString+='<div class="mailflatrate-radiolisthidden">\n<p> \n <label>'+records.data[i].label.trim()+': </label> \n';
						 
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							  htmlString+='<input type="radio" class="mailflatrate-radio required-class tag_'+records.data[i].tag.trim()+'" data-radiolist="'+records.data[i].tag.trim()+'" id="'+recordsOptions[j]+'" name="'+records.data[i].tag.trim()+'" value="'+records.data[i].options[key]+'"> <label for="'+recordsOptions[j]+'">'+records.data[i].options[key]+'</label>\n';
						 }
						 htmlString+="</div>";
						}
						else
						{
							requiredyesno='data-required="no"';
							requiredyes='not-in-form';
							var required_class='required-class';
							htmlStringNotRequired+='<input '+requiredyesno+' type="button" value="'+records.data[i].label.trim()+'" htname="'+records.data[i].tag.trim()+'" id="id_'+records.data[i].tag.trim()+'" class="mailflatrate-label-insert-radiolist button '+requiredyes+'" name="name_'+records.data[i].tag.trim()+'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						var recordsOptions=Object.keys(records.data[i].options);
						
						htmlStringNotRequired+='<div class="mailflatrate-radiolisthidden">\n<p> \n <label>'+records.data[i].label.trim()+': </label> \n';
						 
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							  htmlStringNotRequired+='<input type="radio" class="mailflatrate-radio required-class tag_'+records.data[i].tag.trim()+'" data-radiolist="'+records.data[i].tag.trim()+'" id="'+recordsOptions[j]+'" name="'+records.data[i].tag.trim()+'" value="'+records.data[i].options[key]+'"> <label for="'+recordsOptions[j]+'">'+records.data[i].options[key]+'</label>\n';
						 }
						 htmlStringNotRequired+="</div>";
						}
						
					}
				}
					//htmlString+='<button class="button in-form" type="button" value="0">'+jQuery("#submitbuttonhidden").val()+'</button>\
					//	<button class="button in-form agreetoterms" type="button"  value="3">'+jQuery("#agreetotermhidden").val()+'</button>';
					htmlString+='<button class="button in-form" type="button" value="0">'+jQuery("#submitbuttonhidden").val()+'</button>';
				jQuery(".available-fields.small-margin.required .buttons-fields-mailflatrate").html(htmlString);
				jQuery(".available-fields.small-margin.not-required .buttons-fields-mailflatrate").html(htmlStringNotRequired);
				jQuery(".submitbuttonadd").click(function(e) {
                     jQuery(this).addClass("in-form").removeClass("not-in-form");
					var editor = jQuery(".CodeMirror")[0].CodeMirror; 
					editor.replaceRange('\n<p>\n <input type="submit" name="submit" id="submit" value="'+jQuery("#signuptext").val()+'">\n </p>',CodeMirror.Pos(editor.lastLine()));
                });
				jQuery(".agreetoterms").click(function(e) {
                     jQuery(this).addClass("in-form").removeClass("not-in-form");
					var editor = jQuery(".CodeMirror")[0].CodeMirror; 
					editor.replaceRange('\n<p> <input type="checkbox" class="mailflatrate-label-checkbox agreeterms required-class" id="agreeterms" name="agreeterms"> <label for="agreeterms">'+jQuery("#doyouagreetext").val()+': </label> \n</p>',CodeMirror.Pos(editor.lastLine()));
                });
				 jQuery(".mailflatrate-label-insert-text").click(function(e) {
					 jQuery(this).addClass("in-form").removeClass("not-in-form");
 					var editor = jQuery('.CodeMirror')[0].CodeMirror;
					var datarequired=jQuery(this).data('required');
					var requiredData1='';
					var datarequireclass='';
					if(datarequired=='yes') { datarequireclass='required-class';requiredData1='required';}
					editor.replaceRange('\n<p>\n <label for="'+jQuery(this).attr('htname')+'">'+jQuery(this).val()+': </label> \n<input type="text" id="'+jQuery(this).attr('htname')+'" name="'+jQuery(this).attr('htname')+'" class="mailflatrate-label-text '+datarequireclass+'" '+requiredData1+' placeholder="Please enter '+jQuery(this).val()+'">\n</p>\n', CodeMirror.Pos(editor.lastLine()));
				 });
				 jQuery(".mailflatrate-label-insert-dropdown").click(function(e) {
                    	jQuery(this).addClass("in-form").removeClass("not-in-form");
						var editor = jQuery('.CodeMirror')[0].CodeMirror;
						var datarequired=jQuery(this).data('required');
						editor.replaceRange(jQuery(".mailflatrate-dropdownhidden").html(), CodeMirror.Pos(editor.lastLine()));
                	});
					
					jQuery(".mailflatrate-label-insert-checkboxlist").click(function(e) {
                    	jQuery(this).addClass("in-form").removeClass("not-in-form");
						var editor = jQuery('.CodeMirror')[0].CodeMirror;
						
						editor.replaceRange(jQuery(".mailflatrate-checkboxlisthidden").html(), CodeMirror.Pos(editor.lastLine()));
                	});
					jQuery(".mailflatrate-label-insert-country").click(function(e) {
                    	jQuery(this).addClass("in-form").removeClass("not-in-form");
						var editor = jQuery('.CodeMirror')[0].CodeMirror;
						editor.replaceRange(jQuery(".mailflatrate-countryhidden").html(), CodeMirror.Pos(editor.lastLine()));
                	});
					jQuery(".mailflatrate-label-insert-state").click(function(e) {
                    	jQuery(this).addClass("in-form").removeClass("not-in-form");
						var editor = jQuery('.CodeMirror')[0].CodeMirror;
						editor.replaceRange(jQuery(".mailflatrate-statehidden").html(), CodeMirror.Pos(editor.lastLine()));
                	});
				jQuery(".mailflatrate-label-insert-checkbox").click(function(e) {
                    jQuery(this).addClass("in-form").removeClass("not-in-form");
					var editor = jQuery(".CodeMirror")[0].CodeMirror;
					editor.replaceRange('\n<p> <input type="checkbox" class="mailflatrate-label-checkbox" id="'+jQuery(this).attr('htname')+'" name="'+jQuery(this).attr('htname')+'"> <label for="'+jQuery(this).attr('htname')+'">'+jQuery(this).attr('htHelpText')+' </label> \n</p>',CodeMirror.Pos(editor.lastLine()));
                });
				jQuery(".mailflatrate-label-insert-multiselect").click(function(e) {
                    jQuery(this).addClass("in-form").removeClass("not-in-form");
						var editor = jQuery('.CodeMirror')[0].CodeMirror;
						editor.replaceRange(jQuery(".mailflatrate-multiselecthidden").html(), CodeMirror.Pos(editor.lastLine()));
                });
				jQuery(".mailflatrate-label-insert-radiolist").click(function(e) {
                    jQuery(this).addClass("in-form").removeClass("not-in-form");
						var editor = jQuery('.CodeMirror')[0].CodeMirror;
						editor.replaceRange(jQuery(".mailflatrate-radiolisthidden").html(), CodeMirror.Pos(editor.lastLine()));
                });
				jQuery(".mailflatrate-label-insert-date").click(function(e) {
					 jQuery(this).addClass("in-form").removeClass("not-in-form");
 					var editor = jQuery('.CodeMirror')[0].CodeMirror;
					editor.replaceRange('\n<p>\n <label for="'+jQuery(this).attr('htname')+'">'+jQuery(this).val()+': </label> \n<input type="text" id="'+jQuery(this).attr('htname')+'" name="'+jQuery(this).attr('htname')+'" class="mailflatrate-label-date" placeholder="Please enter '+jQuery(this).val()+'">\n</p>\n', CodeMirror.Pos(editor.lastLine()));
				 });
				 jQuery(".mailflatrate-label-insert-datetime").click(function(e) {
					 jQuery(this).addClass("in-form").removeClass("not-in-form");
 					var editor = jQuery('.CodeMirror')[0].CodeMirror;
					editor.replaceRange('\n<p>\n <label for="'+jQuery(this).attr('htname')+'">'+jQuery(this).val()+': </label> \n<input type="text" id="'+jQuery(this).attr('htname')+'" name="'+jQuery(this).attr('htname')+'" class="mailflatrate-label-datetime" placeholder="Please enter '+jQuery(this).val()+'">\n</p>\n', CodeMirror.Pos(editor.lastLine()));
				 });
				 jQuery(".mailflatrate-label-insert-textarea").click(function(e) {
					 jQuery(this).addClass("in-form").removeClass("not-in-form");
 					var editor = jQuery('.CodeMirror')[0].CodeMirror;
					editor.replaceRange('\n<p> \n <label for="'+jQuery(this).attr('htname')+'">'+jQuery(this).val()+': </label> \n  	<textarea required value="" placeholder="Please Enter '+jQuery(this).val()+'" id="'+jQuery(this).attr('htname')+'" class="mailflatrate-label-textarea" name="'+jQuery(this).attr('htname')+'" ></textarea> \n </p>', CodeMirror.Pos(editor.lastLine()));
				 });
				 if(jQuery("#add_auto_to_editor").is(":checked"))
				 {
				htmlStringTextarea='';
				for(i=0;i<records.data.length;i++)
				{
					if((records.data[i].tag!='' && records.data[i].required=='yes' && records.data[i].type.identifier=='text'))
					{
						
						htmlStringTextarea+='\n<p> \n <label for="'+records.data[i].label.trim()+'">'+records.data[i].label.trim()+': </label> \n  	<input type="text" required value="" placeholder="Please Enter '+records.data[i].label.trim()+'" id="'+records.data[i].tag.trim()+'" class="mailflatrate-label-input required-class" name="'+records.data[i].tag.trim()+'" /> \n </p>';
					}
					else if(records.data[i].tag!='' && records.data[i].required=='yes' && records.data[i].type.identifier=='dropdown')
					{
						htmlStringTextarea+='\n<p> \n <label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n  <select id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-dropdown required-class">';
						 var recordsOptions=Object.keys(records.data[i].options);
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							 htmlStringTextarea+='<option value="'+recordsOptions[j]+'">'+records.data[i].options[key]+'</option>';
						 }
						htmlStringTextarea+='</select>\n </p>';
					}
					else if(records.data[i].tag!='' && records.data[i].required=='yes'&& records.data[i].type.identifier=='checkbox')
					{
						if(records.data[i].help_text!=null)
						{
							var htHelpText=records.data[i].help_text.trim();
							htHelpText=htHelpText.replace(/"/g,"'");
						}
						else 
						{
							var htHelpText=records.data[i].tag.trim();
							htHelpText=htHelpText.replace(/"/g,"'");
						}
						htmlStringTextarea+='\n<p> <label for="'+records.data[i].tag.trim()+'"> <input type="checkbox" class="mailflatrate-label-checkbox required-class" id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'"> '+htHelpText+' </label> \n</p>';
					}
					else if(records.data[i].tag!='' && records.data[i].required=='yes'&& records.data[i].type.identifier=='consentcheckbox')
					{
						if(records.data[i].help_text!=null)
						{
							var htHelpText=records.data[i].help_text.trim();
							htHelpText=htHelpText.replace(/"/g,"'");
						}
						else 
						{
							var htHelpText=records.data[i].tag.trim();
							htHelpText=htHelpText.replace(/"/g,"'");
						}
						htmlStringTextarea+='\n<p>  <label for="'+records.data[i].tag.trim()+'"> <input type="checkbox" class="mailflatrate-label-checkbox required-class" id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'">'+htHelpText+' </label> \n</p>';
					}
					else if(records.data[i].tag!='' && records.data[i].required=='yes' && records.data[i].type.identifier=='multiselect')
					{
						htmlStringTextarea+='\n<p> \n <label for="'+records.data[i].label.trim()+'">'+records.data[i].label.trim()+': </label> \n  <select multiple="multiple" id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-multiselect required-class">';
						 var recordsOptions=Object.keys(records.data[i].options);
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							 htmlStringTextarea+='<option value="'+recordsOptions[j]+'">'+records.data[i].options[key]+'</option>';
						 }
						htmlStringTextarea+='</select>\n </p>';
					}
					else if(records.data[i].tag!='' && records.data[i].required=='yes' && records.data[i].type.identifier=='date')
					{
						htmlStringTextarea+='\n<p> \n <label for="'+records.data[i].label.trim()+'">'+records.data[i].label.trim()+': </label> \n  	<input type="text" required value="" placeholder="Please Enter '+records.data[i].label.trim()+'" id="'+records.data[i].tag.trim()+'" class="mailflatrate-label-date required-class" name="'+records.data[i].tag.trim()+'" /> \n </p>';
						
					}
					else if(records.data[i].tag!='' && records.data[i].required=='yes' && records.data[i].type.identifier=='datetime')
					{
						htmlStringTextarea+='\n<p> \n <label for="'+records.data[i].label.trim()+'">'+records.data[i].label.trim()+': </label> \n  	<input type="text" required value="" placeholder="Please Enter '+records.data[i].label.trim()+'" id="'+records.data[i].tag.trim()+'" class="mailflatrate-label-datetime required-class" name="'+records.data[i].tag.trim()+'" /> \n </p>';
					}
					else if(records.data[i].tag!='' && records.data[i].required=='yes' && records.data[i].type.identifier=='textarea')
					{
						htmlStringTextarea+='\n<p> \n <label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n  	<textarea required value="" placeholder="Please Enter '+records.data[i].label.trim()+'" id="'+records.data[i].tag.trim()+'" class="mailflatrate-label-textarea required-class" name="'+records.data[i].tag.trim()+'" ></textarea> \n </p>';
					}
					else if(records.data[i].tag!='' && records.data[i].required=='yes' && records.data[i].type.identifier=='country')
					{
						htmlStringTextarea+='\n<p>\n \
 											<label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n \
  											<select id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-country required-class">';
 						for(var j=0;j<country.length;j++)
						{
							htmlStringTextarea+='<option value="'+country[j]+'">'+country[j]+'</option>';
						}
  						htmlStringTextarea+='</select>\n</p>';
					}
					else if(records.data[i].tag!='' && records.data[i].required=='yes' && records.data[i].type.identifier=='state')
					{
							htmlStringTextarea+='\n<p>\n \
 							<label for="'+records.data[i].tag.trim()+'">'+records.data[i].label.trim()+': </label> \n<select id="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" class="mailflatrate-label-state required-class">';
  							for(var j=0;j<states.length;j++)
							{
								htmlStringTextarea+='<option value="'+states[j]+'">'+states[j]+'</option>';	
							}
  							htmlStringTextarea+='</select>\n</p>';
					}
					else if(records.data[i].tag!='' && records.data[i].required=='yes' && records.data[i].type.identifier=='checkboxlist')
					{
						var recordsOptions=Object.keys(records.data[i].options);
						
						htmlStringTextarea+='\n<p> \n <label>'+records.data[i].label.trim()+': </label> \n ';
						 
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							  htmlString+='<input type="checkbox" class="mailflatrate-label-checkboxlist '+required_class+' tag_'+records.data[i].tag.trim()+'" id="'+records.data[i].tag.trim()+'_'+recordsOptions[j]+'" data-checkboxlist="'+records.data[i].tag.trim()+'" name="'+records.data[i].tag.trim()+'" value="'+records.data[i].options[key]+'"> <label for="'+records.data[i].tag.trim()+'_'+recordsOptions[j]+'">'+records.data[i].options[key]+'</label>\n';
						 }
					}
					else if(records.data[i].tag!='' && records.data[i].required=='yes' && records.data[i].type.identifier=='radiolist')
					{
						var recordsOptions=Object.keys(records.data[i].options);
						
						htmlStringTextarea+='\n<p> \n <label>'+records.data[i].label.trim()+': </label> \n';
						 
						 for(j=0;j<recordsOptions.length;j++)
						 {
							 var key=recordsOptions[j];
							 htmlStringTextarea+='<input type="radio" class="mailflatrate-radio required-class tag_'+records.data[i].tag.trim()+'" data-radiolist="'+records.data[i].tag.trim()+'" id="'+recordsOptions[j]+'" name="'+records.data[i].tag.trim()+'" value="'+records.data[i].options[key]+'"> <label for="'+recordsOptions[j]+'">'+records.data[i].options[key]+'</label>\n';
						 }
					}
				}
				//htmlsubmitbuttonagree='\n<p>\n<input type="checkbox" class="mailflatrate-label-checkbox agreeterms required-class" id="agreeterms" name="agreeterms"> \n<label for="agreeterms">'+jQuery("#doyouagreetext").val()+':</label>\n</p>\n';
				htmlsubmitbuttonagree='';
				htmlsubmitbutton='<p><input type="submit" name="submit" id="submit" value="'+jQuery("#signuptext").val()+'"></p>';
				jQuery("#mailflatrate_form_code").html(htmlStringTextarea+htmlsubmitbuttonagree+htmlsubmitbutton);
				jQuery(".CodeMirror").remove();
				var delay;
      // Initialize CodeMirror editor with a nice html5 canvas demo.
      var editor = CodeMirror.fromTextArea(document.getElementById('mailflatrate_form_code'), {
        mode: 'text/html',
		lineNumbers: true,
      });
      editor.on("change", function() {
        clearTimeout(delay);
        delay = setTimeout(updatePreview, 300);
      });
     
      function updatePreview() {
        var previewFrame = document.getElementById('preview');
        var preview =  previewFrame.contentDocument ||  previewFrame.contentWindow.document;
        preview.open();
        preview.write('<style> \
		button, input[type="button"], input[type="submit"] {\
    background-color: #222;\
    border: 0;\
    -webkit-border-radius: 2px;\
    border-radius: 2px;\
    -webkit-box-shadow: none;\
    box-shadow: none;\
    color: #fff;\
    cursor: pointer;\
    display: inline-block;\
    font-size: 14px;\
    font-size: 0.875rem;\
    font-weight: 800;\
    line-height: 1;\
    padding: 1em 2em;\
    text-shadow: none;\
    -webkit-transition: background 0.2s;\
    transition: background 0.2s;\
		input[type="text"],\
 input[type="email"],\
 input[type="url"],\
 input[type="password"],\
 input[type="search"],\
 input[type="number"],\
 input[type="tel"],\
 input[type="range"],\
 input[type="date"],\
 input[type="month"],\
 input[type="week"],\
 input[type="time"],\
 input[type="datetime"],\
 input[type="datetime-local"],\
 input[type="color"],\
 textarea {\
    color: #666;\
    background: #fff;\
    background-image: -webkit-linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 0));\
    border: 1px solid #bbb;\
    -webkit-border-radius: 3px;\
    border-radius: 3px;\
    display: block;\
    padding: 0.7em;\
    width: 100%;\
}\
 input[type="text"], \
 input[type="email"], \
 input[type="url"], \
 input[type="password"],\
 input[type="search"], \
 input[type="number"], \
 input[type="tel"],  \
 input[type="range"],\
 input[type="date"],\
 input[type="month"],\
 input[type="week"],\
 input[type="time"],\
 input[type="datetime"],\
 input[type="datetime-local"],\
 input[type="color"],\
 textarea { \
    color: #666;\
    background: #fff;\
    background-image: -webkit-linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 0));\
    border: 1px solid #bbb;\
    -webkit-border-radius: 3px;\
    border-radius: 3px;\
    display: block;\
    padding: 0.7em;\
    width: 100%; \
}\
 button,\
 input,\
 select,\
 textarea {\
    color: #333;\
    font-family: "Libre Franklin", "Helvetica Neue", helvetica, arial, sans-serif;\
    font-size: 15px;\
    font-size: 0.9375rem;\
    font-weight: 400;\
    line-height: 1.66;\
}</style>'+editor.getValue());
        preview.close();
		
      }
      setTimeout(updatePreview, 300);
	  }
			} 
		});
    });
	}
	var $pageNo = 1;
	jQuery("#fieldEmail").change(function(e) {
        if(jQuery(this).val().trim() ==='')
		{
			jQuery("#fieldEmail").css("border","1px solid red");
			jQuery(".emailError").html('Email field is required');
		}
		else
		{
			jQuery("#fieldEmail").removeAttr("style");
			jQuery(".emailError").html('');
		}
    });
	jQuery("#fieldfirstname").change(function(e) {
        if(jQuery(this).val().trim() ==='')
		{
			jQuery("#fieldfirstname").css("border","1px solid red");
			jQuery(".firstnameError").html('Firstname field is required');
		}
		else
		{
			jQuery("#fieldfirstname").removeAttr("style");
			jQuery(".firstnameError").html('');
		}
    });
	jQuery("#fieldlastname").change(function(e) {
        if(jQuery(this).val().trim() ==='')
		{
			jQuery("#fieldlastname").css("border","1px solid red");
			jQuery(".lastnameError").html('Lastname field is required');
		}
		else 
		{
			jQuery("#fieldlastname").removeAttr("style");
			jQuery(".lastnameError").html('');
		}
    });
	jQuery("#mailflatrate-list-import").change(function(e) {
		jQuery.ajax({
			url:ajaxurl,
			type:"POST",
			data:{
					action:'getListData',
					list_uid:jQuery(this).val(),
			},
			dataType:"json",
			success: function(records)
			{
				var selectHtml = '<option value="">Select mailflatrate field</option>';
				for(var i=0;i<records.data.length;i++)
				{
					if(records.data[i].tag !== "DATENSCHUTZ")
					{
						selectHtml+='<option value="'+records.data[i].tag+'">'+records.data[i].label+'</option>';
					}
				}
				jQuery(".mailflatrate-fields").html(selectHtml);
				jQuery(".customerFieldSelect").css("display","block");
			},
			error:function(error)
			{
				console.log('error',error);
			},
			complete: function(data)
			{
				console.log('completeData',data);
			}
		});
	});
	jQuery("#btn_import").click(function(e) {
		var emailField = jQuery("#fieldEmail").val();
		var firstNameField = jQuery("#fieldfirstname").val();
		var lastNameField = jQuery("#fieldlastname").val();
		var check = 0;
		if(emailField.trim() ==='')
		{
			check = 1;
			jQuery("#fieldEmail").css("border","1px solid red");
			jQuery(".emailError").html('Email field is required');
		}
		else
		{
			jQuery("#fieldEmail").removeAttr("style");
			jQuery(".emailError").html('');
		}
		if(firstNameField.trim() ==='')
		{
			check = 1;
			jQuery("#fieldfirstname").css("border","1px solid red");
			jQuery(".firstnameError").html('Firstname field is required');
		}
		else
		{
			jQuery("#fieldfirstname").removeAttr("style");
			jQuery(".firstnameError").html('');
		}
		if(lastNameField.trim() ==='')
		{
			check = 1;
			jQuery("#fieldlastname").css("border","1px solid red");
			jQuery(".lastnameError").html('Lastname field is required');
		}
		else
		{
			jQuery("#fieldlastname").removeAttr("style");
			jQuery(".lastnameError").html('');
		}
		if(check === 0)
		{
			jQuery(".progressMsg").html('Importing started...');
			jQuery.ajax({
				url:ajaxurl,
				type:"POST",
				data:{
					'action':'importMailflatrateListRecords',
					'list_uid':jQuery("#mailflatrate-list-import").val(),
					'pageno':$pageNo,
					'importInto':jQuery("#sel_import_into").val(),
					'emailField':emailField,
					'firstNameField':firstNameField,
					'lastNameField':lastNameField
				},
				dataType:"json",
				success: function(data)
				{
					console.log(data);
					jQuery(".mailflatrate-import-container").css("display","none");
					jQuery(".progressBarData").css("display","block");
					jQuery(".progressBarData .progressbar .progress").animate({width:data.percentages+'%'},500);
					if(data.percentages < 100)
					{
						console.log('data.percentages',data.percentages);
						$pageNo++;
						callImportfunction();
					}
					
				},
				complete: function(data)
				{
					//jQuery('body').trigger('processStop');
				}
			});
		}
		else
		{
			var scrollPosition = jQuery("#mailflatrate-list-import").offset().top;
			jQuery("html, body").animate({ scrollTop: scrollPosition+"px" });
		}
	});
	function callImportfunction()
	{
		jQuery(".progressMsg").html(($pageNo*10)+' records import completed. Starting import more');
		var emailField = jQuery("#fieldEmail").val();
		var firstNameField = jQuery("#fieldfirstname").val();
		var lastNameField = jQuery("#fieldlastname").val();
		var importInto=jQuery("#sel_import_into").val();
			jQuery.ajax({
				url:ajaxurl,
				type:"POST",
				data:{
					'action':'importMailflatrateListRecords',
					'list_uid':jQuery("#mailflatrate-list-import").val(),
					'pageno':$pageNo,
					'importInto':importInto,
					'emailField':emailField,
					'firstNameField':firstNameField,
					'lastNameField':lastNameField
				},
			dataType:"json",
			success: function(data)
			{
				$pageNo++;
				if(data.percentages < 100)
				{
					console.log('data.percentages',data.percentages);
					jQuery(".progressBarData .progressbar .progress").animate({width:data.percentages+'%'},500);
					jQuery(".progressMsg").html(($pageNo*10)+' records import completed. Starting import more');
					callImportfunction();
				}
				else
				{
					jQuery(".progressMsg").html('Importing process is compeleted');
					jQuery(".progressBarData .progressbar .progress").animate({width:'100%'},500);
				}
			},
			complete: function(data)
			{
				
			}
		});
	}
	jQuery("#mailflatrate-list-export").change(function(e) {
		jQuery.ajax({
			url:ajaxurl,
			type:"POST",
			data:{
					action:'getListData',
					list_uid:jQuery(this).val(),
			},
			dataType:"json",
			success: function(records)
			{
				var selectHtml = '<option value="">Select mailflatrate field</option>';
				for(var i=0;i<records.data.length;i++)
				{
					if(records.data[i].tag !== "DATENSCHUTZ")
					{
						selectHtml+='<option value="'+records.data[i].tag+'">'+records.data[i].label+'</option>';
					}
				}
				jQuery(".mailflatrate-fields").html(selectHtml);
				jQuery(".customerFieldSelect").css("display","block");
			},
			error:function(error)
			{
				console.log('error',error);
			},
			complete: function(data)
			{
				console.log('completeData',data);
			}
		});
	});
	
	jQuery("#btn_export").click(function(e) {
		var emailField = jQuery("#fieldEmail").val();
		var firstNameField = jQuery("#fieldfirstname").val();
		var lastNameField = jQuery("#fieldlastname").val();
		var check = 0;
		if(emailField.trim() ==='')
		{
			check = 1;
			jQuery("#fieldEmail").css("border","1px solid red");
			jQuery(".emailError").html('Email field is required');
		}
		else
		{
			jQuery("#fieldEmail").removeAttr("style");
			jQuery(".emailError").html('');
		}
		if(firstNameField.trim() ==='')
		{
			check = 1;
			jQuery("#fieldfirstname").css("border","1px solid red");
			jQuery(".firstnameError").html('Firstname field is required');
		}
		else
		{
			jQuery("#fieldfirstname").removeAttr("style");
			jQuery(".firstnameError").html('');
		}
		if(lastNameField.trim() ==='')
		{
			check = 1;
			jQuery("#fieldlastname").css("border","1px solid red");
			jQuery(".lastnameError").html('Lastname field is required');
		}
		else
		{
			jQuery("#fieldlastname").removeAttr("style");
			jQuery(".lastnameError").html('');
		}
		if(check === 0)
		{
			jQuery(".progressMsg").html('Exporting started...');
			jQuery.ajax({
				url:ajaxurl,
				type:"POST",
				data:{
					'action':'exportMailflatrateListRecords',
					'list_uid':jQuery("#mailflatrate-list-export").val(),
					'pageno':$pageNo,
					'importInto':jQuery("#sel_import_into").val(),
					'emailField':emailField,
					'firstNameField':firstNameField,
					'lastNameField':lastNameField
				},
				dataType:"json",
				success: function(data)
				{
					console.log(data);
					jQuery(".mailflatrate-import-container").css("display","none");
					jQuery(".progressBarData").css("display","block");
					jQuery(".progressBarData .progressbar .progress").animate({width:data.percentages+'%'},500);
					if(data.percentages < 100)
					{
						console.log('data.percentages',data.percentages);
						$pageNo++;
						callExportfunction(data.total_pages);
					}
					
				},
				complete: function(data)
				{
					//jQuery('body').trigger('processStop');
				}
			});
		}
		else
		{
			var scrollPosition = jQuery("#mailflatrate-list-export").offset().top;
			jQuery("html, body").animate({ scrollTop: scrollPosition+"px" });
		}
	});
	jQuery("#sync_status").click(function(e) {
		
       	if(jQuery(this).is(":checked"))
		{
			console.log('checked');
			jQuery("#btn_import_called_sync").css("display","none");
			jQuery("#sync_status_text").val('on');
			jQuery(".actionFormSync").css("display","block");
		}
		else
		{
			jQuery("#btn_import_called_sync").css("display","block");
			jQuery("#sync_status_text").val('off');
			jQuery(".actionFormSync").css("display","none");
		}
    });
	function callExportfunction(totalPages)
	{
		jQuery(".progressMsg").html(($pageNo*1)+' records export completed. Starting export more');
		var emailField = jQuery("#fieldEmail").val();
		var firstNameField = jQuery("#fieldfirstname").val();
		var lastNameField = jQuery("#fieldlastname").val();
		var importInto=jQuery("#sel_import_into").val();
			jQuery.ajax({
				url:ajaxurl,
				type:"POST",
				data:{
					'action':'exportMailflatrateListRecords',
					'list_uid':jQuery("#mailflatrate-list-export").val(),
					'pageno':$pageNo,
					'importInto':jQuery("#sel_import_into").val(),
					'emailField':emailField,
					'firstNameField':firstNameField,
					'lastNameField':lastNameField,
					'totalPages':totalPages
				},
			dataType:"json",
			success: function(data)
			{
				$pageNo++;
				if(data.percentages < 100)
				{
					console.log('data.percentages',data.percentages);
					jQuery(".progressBarData .progressbar .progress").animate({width:data.percentages+'%'},500);
					jQuery(".progressMsg").html(($pageNo*1)+' records export completed. Starting export');
					callExportfunction(data.totalPages);
				}
				else
				{
					jQuery(".progressMsg").html('Exporting process is compeleted');
					jQuery(".progressBarData .progressbar .progress").animate({width:'100%'},500);
				}
			},
			complete: function(data)
			{
				
			}
		});
	}
	jQuery("#btn_import_called_sync").click(function(e) {
        e.preventDefault();
		jQuery("#btn_sync").click();
    });
 });