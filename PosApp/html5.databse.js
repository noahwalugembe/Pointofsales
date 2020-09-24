  
    showSavedUserDetails(); // It will show saved records.

    // Create table
   
    // Insert user details.
   // Insert user details.
   
    function saveUserDetails()
    {
        var order_date_val = $.trim($("#order_date").val());
        var order_priority_val = $.trim($("#order_priority").val());
        var units_sold_val = $.trim($("#units_sold").val());
        var unit_price_val = $.trim($("#unit_price").val());
        var total_cost_val = $.trim($("#total_cost").val());
		var total_revenue_val = $.trim($("#total_revenue").val());
        var item_type_val = $.trim($("#item_type").val());

        if(order_date_val == '')
        {
          alert("Please enter order_date."); 
          $("#order_date").focus(); return false; 
        }

        if(order_priority_val == '')
        {
          alert("Please enter order_priority."); 
          $("#order_priority").focus(); return false; 
        }
		
        if(units_sold_val == '')
        {
          alert("Please enter units_sold"); 
          $("#units_sold").focus(); return false; 
        }
		
		if(unit_price_val == '')
        {
          alert("Please enter unit_price."); 
          $("#unit_price").focus(); return false; 
        }

        if(total_cost_val == '')
        {
          alert("Please enter total_cost"); 
          $("#total_cost").focus(); return false; 
        }
		
		 if(total_revenue_val == '')
        {
          alert("Please enter total_revenue"); 
          $("#total_revenue").focus(); return false; 
        }
		
		 if(item_type_val == '')
        {
          alert("Please enter item_type"); 
          $("#item_type").focus(); return false; 
        }
	
		
		if(order_date_val !=''&& order_priority_val !=''&& units_sold_val !=''&& unit_price_val !=''&& total_cost_val !=''&& total_revenue_val !=''&& item_type_val !='')
        {
                           
			  //var file = this.files[0];
                 var fd = new FormData();
				     fd.append("order_date", order_date_val);
                     fd.append("order_priority", order_priority_val);
                     fd.append("units_sold", units_sold_val);
					 fd.append('unit_price', unit_price_val);
                     fd.append('total_cost', total_cost_val);
					 fd.append('total_revenue', total_revenue_val);
                     fd.append('item_type', item_type_val);
                     
  
  
                 var xhr = new XMLHttpRequest();
                     xhr.onabort = function onAbort() { console.log('abort'); };
                     xhr.onerror = function onError() { console.log('error'); };
                     xhr.open('POST','http://localhost/Pointofsales/PosApi/v1/Api.php?apicall=createsale', true);
                      
					 xhr.onload = function () {
                        //do something to response
                        //console.log(this.responseText);
                        showSavedUserDetails();
			           
		 
		                 };
		 
                     xhr.send(fd);
	
        }

       
    }
	
	
	
	
	

    // Select user details.
   	function showSavedUserDetails(){ 
         
		var data = new FormData();
            //data.append('skip',0);

		const url='http://localhost/Pointofsales/PosApi/v1/Api.php?apicall=getsale';
		
		var xmlhttp;
            xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        
		  
		 var  dictionary = JSON.parse(xmlhttp.responseText);
		
		  //console.log(dictionary);
          if (dictionary){
			 
           var show_data_append = '';
                  var header_ui = '<thead>'   	 
                                 +'<tr style="border: 1px solid black;">'     
                                 +'<th style="padding:8px;border: 1px solid black;width:30%;" >Order date</th>'
                                 +'<th style="padding:8px;border: 1px solid black;width:30%;" >Order priority</th>'
                                 +'<th style="padding:8px;border: 1px solid black;width:30%;"  >Units sold</th>'
                                 +'<th style="padding:8px;border: 1px solid black;width:30%;"  >Unit price</th>'
                                 +'<th style="padding:8px;border: 1px solid black;width:30%;"  >Total cost</th>'
								 +'<th style="padding:8px;border: 1px solid black;width:30%;"  >Total revenue</th>'
                                 +'<th style="padding:8px;border: 1px solid black;width:30%;"  >Item type</th>'
                                 +'<th style="padding:8px;border: 1px solid black;width:40%;" >Action&nbsp;&nbsp;<button type="button" class="btn btn-danger" onclick="dropTables();" style="cursor:pointer;"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;</button></th>'
                                 +'</tr></thead>';     
                                 
								 
		  
		  //console.log(dictionary);
	  for (item in dictionary) {
           for (subItem in dictionary[item]) {
      
			  
			  var id_var=dictionary[item][subItem].id;
			  var order_date_var=dictionary[item][subItem].order_date;
			  var order_priority_var=dictionary[item][subItem].order_priority;
			  var units_sold_var=dictionary[item][subItem].units_sold;
			  var unit_price_var=dictionary[item][subItem].unit_price;
			  var total_cost_var=dictionary[item][subItem].total_cost;
			  var total_revenue_var=dictionary[item][subItem].total_revenue;
			  var item_type_var=dictionary[item][subItem].item_type;
			  

			 if(typeof dictionary[item][subItem].id !== "undefined"){
				 
			
				//$.parseJSON();
            show_data_append += '<tr style="border: 1px solid black;" >' 
                            + '<td style="padding:8px;border: 1px solid black;" >' +order_date_var+'</td>' 
                            + '<td style="padding:8px;border: 1px solid black;" >' +order_priority_var+'</td>' 
                            + '<td style="padding:8px;border: 1px solid black;" >' +units_sold_var+'</td>' 
                            + '<td style="padding:8px;border: 1px solid black;" >' +unit_price_var+'</td>'
                            + '<td style="padding:8px;border: 1px solid black;" >' +total_cost_var+'</td>'
							+ '<td style="padding:8px;border: 1px solid black;" >' +total_revenue_var+'</td>'
                            + '<td style="padding:8px;border: 1px solid black;" >' +item_type_var+'</td>'
                            
							+ '<td style="padding:8px;border: 1px solid black;" >'

                            + '<button type="button" class="btn btn-danger" onclick="deleteUserRecord('+id_var+');"  id="save_record_div" style="cursor:pointer;"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete</button>'
                            + '&nbsp;&nbsp;<button type="button" class="btn btn-info" onclick="editUserRecord('+id_var+ ');"  id="edit_record_div" style="cursor:pointer;"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</button>'
                            + '</tr>';
							
			 }

	        }
			
		 }
          
		          var footer_ui = '</table>';
                   var complete_ui = header_ui+show_data_append+footer_ui;
                   $("#save_record_div").show();
                   $("#update_record_div").hide();
                   $("#show_edit_part").html(complete_ui);

		   }else{
                //showError
               }
		  
        }
      }
      xmlhttp.open("POST", url, true);
      xmlhttp.send();

    }

    // Edit user details.
    function editUserRecord(id){
    
	 modal.style.display = "block";
	 console.log(id);
     //Select records acording to id
	 
	 var data = new FormData();
         data.append('id', id);
             
        
        var xhr = new XMLHttpRequest();
	    const urlX='http://localhost/Pointofsales/PosApi/v1/Api.php?apicall=getsalebyid';
        xhr.open('POST', urlX, true);
    
	    xhr.onload = function () {
    
            //console.log(this.responseText);
            var  dictionary  = JSON.parse(xhr.responseText);
			
			for (item in dictionary) {
              for (subItem in dictionary[item]) {
				  
				
			   	
			      var id_var=id;
			      var order_date_var=dictionary[item][subItem].order_date;
			      var order_priority_var=dictionary[item][subItem].order_priority;
			      var units_sold_var=dictionary[item][subItem].units_sold;
			      var unit_price_var=dictionary[item][subItem].unit_price;
			      var total_cost_var=dictionary[item][subItem].total_cost;
			      var total_revenue_var=dictionary[item][subItem].total_revenue;
			      var item_type_var=dictionary[item][subItem].item_type;
			  
			  	      $("#save_record_div").hide();
                      $("#update_record_div").show();
                      
					  $("#edit_user_id").val(id_var);
                      $("#order_date").val(order_date_var);
                      $("#order_priority").val(order_priority_var);
                      $("#units_sold").val(units_sold_var);
                      $("#unit_price").val(unit_price_var);
                      $("#total_cost").val(total_cost_var);
					  $("#total_revenue").val(total_revenue_var);
                      $("#item_type").val(item_type_var);

	        }
		 }
			
 
		 };
        xhr.send(data); 


    }


    // Update user details.
    function updateUserDetails() 
    {

        var order_date_val = $.trim($("#order_date").val());
        var order_priority_val = $.trim($("#order_priority").val());
        var units_sold_val = $.trim($("#units_sold").val());
        var unit_price_val = $.trim($("#unit_price").val());
        var total_cost_val = $.trim($("#total_cost").val());
		var total_revenue_val = $.trim($("#total_revenue").val());
        var item_type_val = $.trim($("#item_type").val());
        var update_p_id = $.trim($("#edit_user_id").val());
		
		console.log(update_p_id);

        if(order_date_val == '')
        {
          alert("Please enter order_date."); 
          $("#order_date").focus(); return false; 
        }

        if(order_priority_val == '')
        {
          alert("Please enter order_priority."); 
          $("#order_priority").focus(); return false; 
        }
		
        if(units_sold_val == '')
        {
          alert("Please enter units_sold"); 
          $("#units_sold").focus(); return false; 
        }
		
		if(unit_price_val == '')
        {
          alert("Please enter unit_price."); 
          $("#unit_price").focus(); return false; 
        }

        if(total_cost_val == '')
        {
          alert("Please enter total_cost"); 
          $("#total_cost").focus(); return false; 
        }
		
		 if(total_revenue_val == '')
        {
          alert("Please enter total_revenue"); 
          $("#total_revenue").focus(); return false; 
        }
		
		 if(item_type_val == '')
        {
          alert("Please enter item_type"); 
          $("#item_type").focus(); return false; 
        }
	
		
		if(order_date_val !=''&& order_priority_val !=''&& units_sold_val !=''&& unit_price_val !=''&& total_cost_val !=''&& total_revenue_val !=''&& item_type_val !='')
        {
           
		         var fd = new FormData();
				     
					 fd.append("id", update_p_id);
				     fd.append("order_date", order_date_val);
                     fd.append("order_priority", order_priority_val);
                     fd.append("units_sold", units_sold_val);
					 fd.append('unit_price', unit_price_val);
                     fd.append('total_cost', total_cost_val);
					 fd.append('total_revenue', total_revenue_val);
                     fd.append('item_type', item_type_val);
                     
  
  
                 var xhr = new XMLHttpRequest();
                     xhr.onabort = function onAbort() { console.log('abort'); };
                     xhr.onerror = function onError() { console.log('error'); };
                     xhr.open('POST','http://localhost/Pointofsales/PosApi/v1/Api.php?apicall=updatesale', true);
                      
					 xhr.onload = function () {
                        //do something to response
                        console.log(this.responseText);
                        showSavedUserDetails();
			           
		 
		                 };
		 
                     xhr.send(fd); 
        }
    }


    // Delete user details.
     // Delete user details.
    function deleteUserRecord(delete_p_id) 
    { 
        var do_it = confirm("Do you really want to delete this record ? ");
        if (do_it) 
        {
               
          var update_p_id = delete_p_id;

       

          if(update_p_id !=''){

		         var fd = new FormData();
				     fd.append("id", update_p_id);
	
                 var xhr = new XMLHttpRequest();
                     xhr.onabort = function onAbort() { console.log('abort'); };
                     xhr.onerror = function onError() { console.log('error'); };
                     xhr.open('POST','http://localhost/Pointofsales/PosApi/v1/Api.php?apicall=deletesale', true);
                      
					 xhr.onload = function () {
                        //do something to response
                        console.log(this.responseText);
                        showSavedUserDetails();
			           
		 
		                 };
		 
                     xhr.send(fd); 
        }
	
        }
    }








