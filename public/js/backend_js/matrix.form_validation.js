$(document).ready(function(){

	//add-admin+sub-admin
	$('#access').hide();
	$('#type').change(function(){
		var type = $('#type').val();
		if(type == 'Admin'){
			$('#access').hide();
		}
		else
		{
			$('#access').show();
		}
	});
	//asmin/subAdmin form validations
	$("#add_admin").validate({
		rules:{
			type:{
				required:true,
				type: true
			},
			username:{
				required:true,
				username: true
			},
			password:{
				required:true,
				password: true
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

	//Password Reset Related Code
	$('#current_pwd').keyup(function(){
		var current_pwd = $('#current_pwd').val();
		
		$.ajax({
			type:'get',
			url:'/admin/check-pwd',
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

	//Sweet Alert Code for Delting Proiduct/Category
	$(document).on('click', '.deleteRecord', function(e){
		var id = $(this).attr('rel');
		var deleteFunction = $(this).attr('rel1');
		swal({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!',
			  cancelButtonText:  'Cancel',
			  confirmButtonClass: 'btn btn-danger',
			  cancelButtonClass:  'btn btn-danger',
			  buttonsStyling: false,
			  reverseButtons:true

		},
		function(){
			window.location.href= "/admin/"+deleteFunction+"/"+id;
		});
	});

	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
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

	// Add Category Validation
    $("#add_category").validate({
		rules:{
			name:{
				required:true
			},
			description:{
				required:true,
			},
			url:{
				required:true,
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

	// edit Category Validation
    $("#edit_category").validate({
		rules:{
			name:{
				required:true
			},
			description:{
				required:true,
			},
			url:{
				required:true,
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

	// Add Product Validation
    $("#add_product").validate({
		rules:{
			category_id:{
				required:true,
			},
			product_name:{
				required:true,
			},
			product_code:{
				required:true,
			},
			product_color:{
				required:true,
			},
			price:{
				required:true,
				number:true
			},
			weight:{
				required:true,
				number:true
			},
			image:{
				required:true,
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

	// Edit Product Validation
    $("#edit_product").validate({
		rules:{
			category_id:{
				required:true,
			},
			product_name:{
				required:true,
			},
			product_code:{
				required:true,
			},
			product_color:{
				required:true,
			},
			price:{
				required:true,
				number:true
			},
			weight:{
				required:true,
				number:true
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
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
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
	
	$("#password_validate").validate({
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

	$(document).ready(function(){
	    var maxField = 10; //Input fields increment limitation
	    var addButton = $('.add_button'); //Add button selector
	    var wrapper = $('.field_wrapper'); //Input field wrapper
	    var fieldHTML = '<div style="margin-left:180px;"><input type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px;margin-top:5px;"/><input type="text" name="size[]" id="size" placeholder="Size" style="width: 120px; margin-left:3px;margin-top:5px;"/><input type="text" name="price[]" id="price" placeholder="Price" style="width: 120px; margin-left:3px;margin-top:5px;"/><input type="text" name="stock[]" id="stock" placeholder="Stock" style="width: 120px;margin-left:3px;margin-top:5px;"/><a href="javascript:void(0);" class="remove_button"> Remove</a></div>'; //New input field html 
	    var x = 1; //Initial field counter is 1
    
	    //Once add button is clicked
	    $(addButton).click(function(){
	        //Check maximum number of input fields
	        if(x < maxField){ 
	            x++; //Increment field counter
	            $(wrapper).append(fieldHTML); //Add field html
	        }
	    });
    
	    //Once remove button is clicked
	    $(wrapper).on('click', '.remove_button', function(e){
	        e.preventDefault();
	        $(this).parent('div').remove(); //Remove field html
	        x--; //Decrement field counter
	    });
	});
});


var year_months      = new Array();
var users            = new Array();
var orders           = new Array();
var orders_delivered = new Array();
var orders_cancelled = new Array();



//for charts
$(document).ready(function(){

	var url = "/charts";

	$.get(url, function(resp){
		
		$.each( resp.users, function( key, value ) { 

		       users.push(value);
		       orders.push(resp.orders[key]);
		       orders_delivered.push(resp.orders_delivered[key]);
		       orders_cancelled.push(resp.orders_cancelled[key]);
		       year_months.push(resp.month_year[key]);

            });

		//drawing charts for users
        var user_chart = document.getElementById("user_chart").getContext('2d');
        var orders_chart = document.getElementById("orders_chart").getContext('2d');

        //tooltip settings
        tooltipsettings = {
                  position:'nearest',
                  mode: 'index',
                  intersect: true,
                  backgroundColor:'#000',
                }

        //users chart
        var myChart = new Chart(user_chart, {
              type: 'bar',
              data: {
                      labels:year_months,
                      datasets:[{
                                  label: 'New Users',
                                  data:[110,150,140,220,180,290,110,90,210,390,221,190] /*users*/,
                                  type:'line',
                                  backgroundColor:"rgba(255,99,71)",
                                  borderColor: "rgba(255,99,71)",
                                  borderWidth: 2,
                                  fill:false,
                                }]
                    },
                    options:{
                      scales: {
                        yAxes: [{
                          ticks:{
                            beginAtZero:true,
                            steps: 10,
                            stepValue: 5,
                            max: 800

                          }
                        }],
                        xAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 0,
                            minRotation: 0
                          }
                        }]
                      },
                      legend: {
                        display:false
                      }
                    }
        });

        //orders chart
        var myChart = new Chart(orders_chart, {
              type: 'bar',
              data: {
                      labels:year_months,
                      datasets:[{
                                  label: 'New Orders',
                                  data: [90,130,230,190,270,200,250,190,220,290,299,310]/*orders*/,
                                  type:'line',
                                  backgroundColor:"rgb(63, 127, 191)",
                                  borderColor: "rgb(63, 127, 191)",
                                  borderWidth: 2,
                                  fill:false,
                                },
                                {
                                  label: 'Delivered',
                                  data: [90,110,205,190,260,190,240,180,220,280,290,300] /*orders_delivered*/,
                                  type:'bar',
                                  backgroundColor:"rgb(103, 191, 103)",
                                  borderColor: "rgb(103, 191, 103)",
                                  borderWidth: 2,
                                  fill:false,
                                },
                                {
                                  label: 'Cancelled',
                                  data: [0,20,25,0,10,10,10,10,0,10,9,10] /*orders_cancelled*/,
                                  type:'bar',
                                  backgroundColor:"rgb(218, 144, 144)",
                                  borderColor: "rgb(218, 144, 144)",
                                  borderWidth: 2,
                                  fill:false,
                                }]
                    },
                    options:{
                      tooltips:tooltipsettings,	
                      scales: {
                        yAxes: [{
                          ticks:{
                            beginAtZero:true,
                            steps: 10,
                            stepValue: 5,
                            max: 800

                          }
                        }],
                        xAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 0,
                            minRotation: 0
                          }
                        }]
                      },
                      legend: {
                        display:false
                      }
                    }
        });



	});//end $.get
});