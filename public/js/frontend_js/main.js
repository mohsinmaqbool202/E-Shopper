/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

$(document).ready(function(){
   //  Display product price and Stock according to product size in product detail page
	$('#selSize').change(function(){
		var idSize = $(this).val();
		if(idSize == ''){
			return false;
		}

		$.ajax({
			type:'get',
			url:'/get-product-price',
			data:{idSize:idSize},
			success:function(resp){
				var arr = resp.split('#');
				$('#getPrice').html("PKR" +arr[0]);
				$('#product_price').val(arr[0]);
				
				if(arr[1] == 0){
					$('#cartButton').hide();
					$('#Availability').text('Out Of Stock');
				}else{
					$('#cartButton').show();
					$('#Availability').text('In Stock '+arr[1]+ ' 	Items');
				}
			},
			error:function(){
				alert("Error Occured");
			}
		});

	});


	//Replace main img with alternate img
	$('.changeImage').click(function(){
		
		var image = $(this).attr('src');
		$('.mainImage').attr('src', image);
	});



	// Easy Zoom Jquery code
	var $easyzoom = $('.easyzoom').easyZoom();
	// Setup thumbnails example
	var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');
	$('.thumbnails').on('click', 'a', function(e) {
		var $this = $(this);
		e.preventDefault();
		// Use EasyZoom's `swap` method
		api1.swap($this.data('standard'), $this.attr('href'));
	});
	// Setup toggles example
	var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');
	$('.toggle').on('click', function() {
		var $this = $(this);
		if ($this.data("active") === true) {
			$this.text("Switch on").data("active", false);
			api2.teardown();
		} else {
			$this.text("Switch off").data("active", true);
			api2._init();
		}
	});

});


$(document).ready(function(){
	//validate register form on key up and submit
	$("#registerForm").validate({
		rules:{
			name:{
			    required:true,
			    minlength:2,
			    accept:"[a-zA-Z]+"
			},
			password:{
				required:true,
				minlength:6
			},
			email:{
				required:true,
				email:true,
				remote:"/check-email"
			}
		},
		messages:{
			name: {
				required:"Please enter your name.",
				minlength:"Your name must be atleast 2 character long.",
			    accept:"Your name must contain lettesrs only"
		    },		
			password:{
				required:"Please provide your password",
				minlength:"Your password must be atleast 6 character long."
			},
			email:{
				required:"Please provide your email",
				email:"Please enter valid email",
				remote: "Email already exists" 
			}
		}, 
		highlight: function (element) {
                $(element).parent().addClass('error')
            },
        unhighlight: function (element) {
            $(element).parent().removeClass('error')
        }
	});

	//password strength indicator script
	$('#password').passtrength({
          minChars: 6,
          passwordToggle: true,
          tooltip: true,
          eyeImg :"/images/frontend_images/eye.svg"
        });

	//validate login form
	$("#loginForm").validate({
		rules:{
			email:{
				required:true,
				email:true,
			},
			password:{
				required:true,
			}
		},
		messages:{
			email:{
				required:"Please provide your email",
				email:"Please enter valid email",
			},		
			password:{
				required:"Please provide your password",
			}
		}, 
		highlight: function (element) {
                $(element).parent().addClass('error')
            },
        unhighlight: function (element) {
            $(element).parent().removeClass('error')
        }
	});


	//validate update  account info form
	$("#accountForm").validate({
		rules:{
			name:{
			    required:true,
			    minlength:2,
			    accept:"[a-zA-Z]+"
			},
			address:{
				required:true,
			},
			city:{
				required:true,
			},
			state:{
				required:true,
			},
			country_id:{
				required:true,
			},
			pincode:{
				required:true,
			},
			mobile:{
				required:true,
			}
		},
		messages:{
			name: {
				required:"Please enter your name.",
				minlength:"Your name must be atleast 2 character long.",
			    accept:"Your name must contain lettesrs only"
		    },		
			address:{
				required:"Please provide your address",
			},
			city:{
				required:"Please provide your city name",
			},
			state:{
				required:"Please provide your state name",
			},
			country_id:{
				required:"Please select country",
			},
			pincode:{
				required:"Please provide pincode",
			},
			mobile:{
				required:"Please provide your mobile#",
			},
		}, 
		highlight: function (element) {
                $(element).parent().addClass('error')
            },
        unhighlight: function (element) {
            $(element).parent().removeClass('error')
        }
	});

	//check user current pwd
	$('#current_pwd').keyup(function(){
		var current_pwd = $('#current_pwd').val();
		$.ajax({
			type:'get',
			url:'/check-user-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				if(resp == "false"){
					$('#chkPwd').html("<font color='red'>Current Password is Incorrect.</font>");
				}else if(resp == "true"){
					$('#chkPwd').html("<font color='green'>Current Password is Correct.</font>");
				}
			},error:function()
			{
				alert("error");
			}
		});
	});


});

$(function(){
//password validations for updatinf
	$("#account_Form").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
            new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});


	//copy billing address to shipping address
	$('#copyAddress').click(function(){
		if(this.checked){
		    $('#shipping_country_id').val($("#country_id").val());
			$('#shipping_name').val($('#billing_name').val());
			$('#shipping_address').val($('#billing_address').val());
			$('#shipping_city').val($('#billing_city').val());
			$('#shipping_state').val($('#billing_state').val());
			$('#shipping_pincode').val($('#billing_pincode').val());
			$('#shipping_mobile').val($('#billing_mobile').val());
		}
		else
		{
			$('#shipping_country_id').val('');
			$('#shipping_name').val('');
			$('#shipping_address').val('');
			$('#shipping_city').val('');
			$('#shipping_state').val('');
			$('#shipping_pincode').val('');
			$('#shipping_mobile').val('');
		}
	});
});

function selectPaymentMethod()
{
	if($('#Paypal').is(':checked') || $('#COD').is(':checked'))
	{
		// alert('checked');
	}
	else
	{
		alert('Please select payment method.');
		return false;
	}	
}

function checkPincode()
{
	var pincode = $('#chkPincode').val();
	alert(pincode);
	return false;
}