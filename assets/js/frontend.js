jQuery(document).ready(function(e) {
    jQuery("#mailflatrate-form-submit").submit(function(e) {
        e.preventDefault();
	jQuery('html, body').animate({ scrollTop: jQuery(".mailflatrate-form").offset().top-jQuery(".mailflatrate-form").height() }, 'slow', function () {
    });
	jQuery("#overlay").css("display","block");
		jQuery.ajax({
			url:ajax_object.ajax_url,
			data:jQuery(this).serialize()+"&action=mailflatrate-subscribe-form",
			type:"POST",
			success: function(data)
			{
			jQuery("#overlay").css("display","none");
				data=jQuery.parseJSON(data);
				if(data.status==='success')
				{
					jQuery("form#mailflatrate-form-submit").css("display","none");
					jQuery(".messagebox").addClass("success");
					jQuery(".messagebox").css("color",data.color);
					jQuery(".messagebox").html(data.message); 
				}
				else if(data.status==='error')
				{
					 
					jQuery(".messagebox").addClass("error");
					jQuery(".messagebox").css("color",data.color);
					jQuery(".messagebox").html(data.message);
				}
			}
		});
    });
});