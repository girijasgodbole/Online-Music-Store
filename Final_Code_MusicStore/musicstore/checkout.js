$(document).ready(function() {

	// Get the modal
	var billingMdl = document.getElementById('mdlBilling');

	var paymentMdl = document.getElementById('mdlPayment');

	// Get the button that opens the modal
	var btnGetBillAddr = document.getElementById("btnGetBillAddr");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	var span1 = document.getElementsByClassName("close1")[0];

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		billingMdl.style.display = "none";
	}
	span1.onclick = function() {
		paymentMdl.style.display = "none";
	}
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == billingMdl) {
	    	billingMdl.style.display = "block";
	    	
	    }else if(event.target == paymentMdl){
	    	paymentMdl.style.display = "block";
	    }
	}

	$('.table tbody tr').click(function(event) {
		if (event.target.type !== 'radio') {
			$(':radio', this).trigger('click');
		}
	});
	//btnNewAddr
	$('#divNewAddr').hide();
	$(document).on('click','#btnNewAddr', function(e){
	   e.preventDefault();
	   //$(this).next('#divNewAddr').toggle();
	    $(this).text(function(i, text){
          return text === "Create New Address" ? "Select Exsisting Address" : "Create New Address";
      })
	   $('#divNewAddr').toggle();
	});
	//btnNewAddr
	$('#divNewPay').hide();
	$(document).on('click','#btnNewPayment', function(e){
	   //e.preventDefault();
	   //$(this).next('#divNewAddr').toggle();
	    $(this).text(function(i, text){
          return text === "Create New Payment" ? "Select Exsisting Payment Method" : "Create New Payment";
      })
	   $('#divNewPay').toggle();
	});
	$('#btnAddPayment').bind('click', function() {
		paymentMdl.style.display = "block";
		var id = $(this).attr("id");
		// var poststr="request="+num+"&moreinfo="+id;
		var poststr = "request=" + id;
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				$("#divPayment2").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});
	});

	$(document).on('click','#btnSavePayment2', function(e){
		paymentMdl.style.display = "none";
		var id = $(this).attr("id");
		// var poststr="request="+num+"&moreinfo="+id;
		var val = $('input[name=radiosPay]:checked').val();
		//var poststr = "request=" + id+"&addrId="+val;
		//var poststr = "request=" + id;
		var poststr="request="+id+"&param="+val;
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				$("#divSelectedPayment").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});
	});

	$('#btnGetBillAddr').bind('click', function() {
		billingMdl.style.display = "block";
		var id = $(this).attr("id");
		// var poststr="request="+num+"&moreinfo="+id;
		var poststr = "request=" + id;
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				$("#divBilling").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});
	});
	$('#btnSaveAddrShip').hide();


	$('#btnSaveAddr').bind('click', function() {
		billingMdl.style.display = "none";
		var id = $(this).attr("id");
		// var poststr="request="+num+"&moreinfo="+id;
		var val = $('input[name=radios]:checked').val();
		//var poststr = "request=" + id+"&addrId="+val;
		//var poststr = "request=" + id;
		var poststr="request="+id+"&param="+val;
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				$("#divSelectedBillAddr").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});
	});

	$('#btnSaveAddrShip').bind('click', function() {
		billingMdl.style.display = "none";
		var id = $(this).attr("id");
		// var poststr="request="+num+"&moreinfo="+id;
		var val = $('input[name=radios]:checked').val();
		//var poststr = "request=" + id+"&addrId="+val;
		//var poststr = "request=" + id;
		var poststr="request="+id+"&param="+val;
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				$("#divSelectedShipAddr").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});
	});

	$('#btnGetShipAddr').bind('click', function() {
		billingMdl.style.display = "block";
		var id = $(this).attr("id");
		$('#btnSaveAddrShip').show();
		$('#btnSaveAddr').hide();
		//var poststr="request="+num+"&param="+id;
		var poststr = "request=" + id;
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				$("#divBilling").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});
	});

	$('#btnAddPayment').bind('click', function() {
		paymentMdl.style.display = "block";
		var id = $(this).attr("id");
		// var poststr="request="+num+"&moreinfo="+id;
		var poststr = "request=" + id;
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				$("#divBilling").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});
	});


	$(".use-address").click(function() {
		 var id = $(this).attr("id");
    	 var $row = $(this).closest("tr");    // Find the row
   		 var $purid = $row.find(".nr").data("id"); // Find the text
    	 var poststr="request="+id+"&param1="+$purid;
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				$("#divPur").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});

    // Let's test it out
});

	$(".use-quant").click(function() {
    var $row = $(this).closest("tr");    // Find the row
    var $quant = $row.find(".inp").val(); // Find the text
    var $purid = $row.find(".nr").data("id");
    var price = $row.find(".pr").data("orig");
	$row.find(".pr").text(price*$quant);
	var sum = 0;
// iterate through each td based on class and add the values
$(".pr").each(function() {

    var value = $(this).text();
    // add only if the value is number
    if(!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
    }
});
$(".tt").text(sum);
    //TODO: Update list to bind to divPurchase
    var id = $(this).attr("id");
		var poststr="request="+id+"&param1="+$purid+"&param2="+$quant;
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				$("#divPur2").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});
    // Let's test it out
});
	$("#btnCheckout").click(function() {
		var id = $(this).attr("id");
	    var purid = $(".nr").data("id");
	    var total = $(".tt").text();
	    var poststr = "request=" + id+"&param="+purid+"&param1="+total;
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				//$("#divBilling").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});
	});


	$("#btnAddCart").click(function() {
		var id = $(this).attr("id");
		var itemid =  $(this).data("id");
		//TODO: get the select item id
	    var itemid = 2;
	    var poststr = "request=" + id+"&param="+itemid;
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				$("#divPur").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});
	});
	$("#btnSubPay").click(function() {
		var id = $(this).attr("id");
		paymentMdl.style.display = "block";
		$.ajax({
			url : "checkoutservice.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				$("#divPayment2").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});
	});

});