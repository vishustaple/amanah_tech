jQuery(document).ready(function(){
	var activeTabId = 0;

	function changeActiveTab(newTabId){
		//Change active tab to newTabId

		$('#page-next').click(function(){
			
		});
	}
	function getActiveTab(){
		return activeTabId;
	}

    //if .item-list-single has more than 5 .item-list-single-input's,
    //put the class .hidden on on the rest,
    //add a button to remove the class .hidden that says "View More..."
	$('.item-list-single ul').each(function() {
		var $this = $(this);
		if ($this.find('li').length > 6) { //only work when there are more than 6 list items (starts at 1)
			$this.find('li:gt(5)').addClass('disp-none gt'); //add class to items past the 6th one (starts at 0)
			$this.parent().find('.view-more').removeClass('disp-none'); //show view more btn
		}
	});
	$('.view-more').click(function(){
		$(this).siblings('ul').children('.gt').toggleClass('disp-none');
	});


	/*Sticky summary box on scroll.*/
	$(window).scroll(function() {
        var distanceFromTop = $(this).scrollTop();
        if (distanceFromTop >= $('.pages').offset().top ) {
            $('.summary-box').addClass('fixed1');
        } else {
            $('.summary-box').removeClass('fixed1');
        }
    });


    function showSummaryItems(){
        if($("#showOrderSummary").hasClass("ordersummary-active")){
            $('.hidden-detail').each(function(index,value){
                if(index==0){
                    sideColorToggle=true;
                }
                //Get the option ID
                var sumOptPrefix = "sumopt";
                var radioPrefix = "opt";
                var sumOptId = parseInt(this.id.substring(sumOptPrefix.length));

                //Check if the option is checked
                if($('#' + radioPrefix + sumOptId.toString()).prop("checked")){
                    $(this).addClass('show-details');
                    if(sideColorToggle){
                        sideColorToggle=false;
                        $(this).addClass('active_summary_list');
                    } else {
                        sideColorToggle=true;
                        $(this).removeClass('active_summary_list');
                    }
                } else {
                    $(this).removeClass('show-details');
                }
            });
        }
    }

    /*Tabs JS*/
    /*
    /Add ID #page-x to all tabs, like #page-1, #page-2, etc...
    /Associate HTML elements with tabs by adding a class version to them, like: .page-1, .page-2, etc...
    /For example: When #page-1 is clicked, all elements with .page-1 on it will show up, 
    /and elements with any other .page-x will disappear. And so forth for #page-2 with .page-2, etc...
    */
	var pagePrefix = "page-";
    function getCurrentTabNum(){
    	return $('.js-tab.active').first().attr('id').substring(5);
    }
    function getTabCount(){
    	return $('.pages .js-tab').length;
    }
    function handlePageClickActions(pageNum){
        if(pageNum == 3) {
            showSummaryItems();
        }
    }
    function handleTabClick(clickedPageNum) {
    	if(clickedPageNum != parseInt(getCurrentTabNum())){
	    	var tabsAmt = getTabCount();
	    	var clickedPageId = pagePrefix + clickedPageNum;
	    	var currentPageId = pagePrefix + getCurrentTabNum();
	    	//Make all pages inactive
	        $('.js-tab').each(function(){$(this).removeClass('active');});
	        //Make the clicked page active
	        $('#' + clickedPageId).addClass('active');

	        //Hide all page content
	        for (j = 1; j <= tabsAmt; j++) {
	            $('.' + pagePrefix + j).addClass('disp-none');
	        }

	        //Show the selected page
	        $('.' + clickedPageId).removeClass('disp-none');
	        $('.' + clickedPageId).addClass('disp-block');

            handlePageClickActions(clickedPageNum);
    	}
    }

    var tabsAmt = getTabCount();
    //Hide all tabs
    for (i = 1; i <= tabsAmt; i++) {
	    $('.' + pagePrefix + i).addClass('disp-none');
	}

	//Always display the first tab on load
	if(tabsAmt>0){
	    $('.' + pagePrefix + '1').addClass('disp-block');
	    $('.' + pagePrefix + '1').removeClass('disp-none');
	    $('#' + pagePrefix + '1').addClass('active');
	}
	//Handle click events for all tabs
	$('.js-tab').click(function(){
    	var clickedPage = this.id.substring(5);
    	var clickedPageNum = parseInt(clickedPage);
    	handleTabClick(clickedPageNum);
	});

    /*Order Review - Show Details js*/
    var sideColorToggle=true;
    $('.view-server-details').click(function(){
        if($(this).hasClass("toggle-reverse")){
            $('.hidden-detail').removeClass('show-details');
            $("#showOrderSummary").removeClass("ordersummary-active");
        } else {
            $("#showOrderSummary").addClass("ordersummary-active");
            showSummaryItems();
        }
    	$(this).toggleClass('toggle-reverse');
    });

    /*Checkout page - order review toggle differences*/
    $('.form-order-summary .view-server-details').click(function(){
    	$('.fos-hide').toggleClass('disp-none');
    	$('.fos-view').toggleClass('disp-none');

    	$('.fos-arrow').toggleClass('toggle-reverse');
    });


    /*Index view more toggle*/
    $('.view-more').click(function(){
    	$('.view-more i').toggleClass('toggle-reverse');
    });

    $("input:radio").each(function(){
    	$('#side' + this.id).addClass('disp-none');
    });


    var optionColorToggle=true;
    function populateOptions(index,value){
    	//If we are just starting then set the color toggle to true
    	if(index==0){
    		optionColorToggle=true;
            sideColorToggle=true;
    	}

    	//If the option is both checked and not a default then add it to the side
//    	if (value.checked/* && !$(value).hasClass('default')*/) {
        if (value.checked && !$(value).hasClass('default')) {
    		$('#side' + value.id).removeClass('disp-none');
    		$('#side' + value.id).addClass('disp-inline');

    		//Set the color based on toggle and change the handler
    		if(optionColorToggle){
    			optionColorToggle=false;
    			$('#side' + value.id).addClass('active_summary_list');
    		} else {
    			optionColorToggle = true;
    			$('#side' + value.id).removeClass('active_summary_list');
    		}
    	} else { //Otherwise hide the element
    		$('#side' + value.id).removeClass('disp-inline');
    		$('#side' + value.id).addClass('disp-none');
    	}
    }

    $('input[type=radio]').each(function(index,value){
        populateOptions(index,value);
    });

    function updatePrices(){

    	var subTotal = 0;
    	subTotal += parseFloat(priceObject.packRec);
    	var optRegex = /opt([0-9]+)/;

    	//Go through each radio, see if its an option, if so add it to the subtotal

        $("input:radio").each(function(){
            var match = optRegex.exec(this.id);
            if(match != null) {
                var selectedOptId = match[1];
        		if ($(this).prop('checked')/* && !$(this).hasClass('default')*/) {
                        //if ($(this).prop('checked') && !$(this).hasClass('default')) {
        			subTotal+=parseFloat(priceObject.upgrades[selectedOptId].price);
    	    	}
                //Update the listings
                $(".optPrice" + selectedOptId).each(function(){
                    $(this).html(priceObject.upgrades[selectedOptId].price);
                });
            }
    	});

    	//Overall order prices
        var quantity = parseInt(priceObject.quantity);

    	var total = (parseFloat(subTotal)*quantity + parseFloat(priceObject.packSetup)*quantity);
        var packTotal = parseFloat(priceObject.packRec)*quantity;
        var packSetupTotal = parseFloat(priceObject.packSetup);
        var orderSetupTotal = packSetupTotal*quantity;
        var orderSubtotal = subTotal*quantity;

    	$(".subtotal-price").html(subTotal.toString());
    	$(".total-price").html(total.toString());
    	$(".package-setup-price").html(packSetupTotal.toString());
        $(".order-setup-price").html(orderSetupTotal.toString());
        $(".order-subtotal-price").html(orderSubtotal.toString());
    	$(".package-price").html(priceObject.packRec);
        $(".package-total-price").html(packTotal.toString());
        
        Object.entries(priceObject.upgrades).forEach(function(data, index) {
            $("#sumopt"+data[0]).children(":nth-child(4)").html(data[1].price + data[1].setup);
            $("#sumopt"+data[0]).children(":nth-child(5)").html((data[1].price + data[1].setup) * quantity);
        });

    	//Format all prices
    	$(".format-price").each(function(){
    		var curVal = $(this).html();
    		$(this).html(numeral(curVal).format('$0,0.00')).show();
    	});
    }

    //Set the options on page load and radio change (page load does not imply all default options)
    updatePrices();

	$('input[type=radio]').change(function(){
        //Uncheck all radio options of this name and check the one we clicked.
        //For some reason this isnt happening automatically. 
        $("[name='" + $(this).attr("name") + "']").prop("checked",false);
        $(this).prop("checked",true);

        updatePrices();
		$('input[type=radio]').each(function(index,value){
			populateOptions(index,value);
		});
	});

	$('.tab-btn').click(function(){
		var currentTabNum = parseInt(getCurrentTabNum());

		//Increment or decrement tab number if no overflow
		if($(this).hasClass("next-btn") && currentTabNum<getTabCount()){
			currentTabNum++;
		} else if($(this).hasClass("prev-btn") && currentTabNum>1) {
			currentTabNum--;
		}

		//Process the tab change
		handleTabClick(currentTabNum);
	});

    /* Period switching*/
    var periodIDs = {
        0:{"prev":0,"next":0,"title":"Undefined"},
        1:{"prev":0,"next":3,"title":"Monthly"},
        3:{"prev":1,"next":6,"title":"Quarterly"},
        6:{"prev":3,"next":12,"title":"Semi-Annually"},
        12:{"prev":6,"next":0,"title":"Annually"}
    };
    function updatePeriod(period,pds){
        $('.period-text').html(pds[period]["title"]);
        $(".period-spinner").addClass("disp-none");

        updatePrices();
    }
    function updateQuantity(quantity){
        priceObject.quantity=quantity.toString();
        $(".quantity-text").html(priceObject.quantity);
        $(".quantity-spinner").addClass("disp-none");
        $("#quantity").val(quantity.toString());
        updatePrices();
    }

    $('#quote-send').click(function(){
        var nonEmptyEmail = "";
        $( "input[name='quoteemail']" ).each(function(){
            if($(this).val()!=""){
                nonEmptyEmail=$(this).val();
            }
        });

        //Update or make the order real
        $.ajax({
            url : 'changePeriod.php',
            type : 'POST',
            data : $("#orderForm").serialize(),
            dataType:'json',
            cache:false,
            beforeSend: function(){
                $(".send-quote-button").css("display","none");
                $(".send-quote-spinner").css("display","inline");
                $(".send-quote-success").css("display","none");
                $(".spinme").html("<i class='fa fa-spinner fa-spin'></i>");

            },
            success : function(data) {
                priceObject=data;
                //Assign the forder
                $("#forder").val(priceObject.forder);

                //Send the quote
                $.ajax({
                    url : 'sendQuote.php',
                    type : 'POST',
                    data : {
                        forder:  $("#forder").val(),
                        email: nonEmptyEmail,
                    },
                    dataType:'json',
                    cache:false,
                    success : function(data) {
                        $(".send-quote-button").css("display","inline");
                        $(".send-quote-spinner").css("display","none");
                        $(".send-quote-success").css("display","inline");
                        $(".spinme").html("");
                    },
                    error : function(request,error)
                    {
                        alert("Request: "+JSON.stringify(request));
                    }
                });
            },
            error : function(request,error)
            {
                alert("Request: "+JSON.stringify(request));
            }
        });

    });

    $('.ajaxUpdateOrder').click(function(){
        var currentPeriod = $('#period-id').val();
        var newPeriod = currentPeriod;
        var currentQuantity = parseInt(priceObject.quantity);
        var newQuantity = currentQuantity;

        var senderEnum = Object.freeze({"none":0,"period":1, "quantity":2, "coupon":3});
        var sender = senderEnum.none;

        //If we are switching periods
        if($(this).hasClass('term-select-button')){
            if($(this).hasClass("forwards")){
                newPeriod = periodIDs[currentPeriod]["next"];
            } else if($(this).hasClass("backwards")){
                newPeriod = periodIDs[currentPeriod]["prev"];
            }
            if(!isNaN(newPeriod) && newPeriod!=0){
                sender = senderEnum.period;
            } else {
                //Gracefully degrade if we don't want to do anything this request
                newPeriod=currentPeriod;
            }
        }

        //If we are switching quantity
        if($(this).hasClass('quantity-button')){
            if($(this).hasClass("quantity-minus") && currentQuantity>1){
                newQuantity = currentQuantity-1;
            } else if ($(this).hasClass("quantity-plus")) {
                newQuantity = currentQuantity+1;
            }

            if(currentQuantity != newQuantity){
                sender = senderEnum.quantity;
            }
            $("#quantity").val(newQuantity .toString());
        }

        //If we are applying a coupon 
        if($(this).hasClass('coupon-button')){
            $("#coupon").val($("#summaryCoupon").val());
            sender = senderEnum.coupon;
        }

        //If any of the above modules wants to send
        if(sender != senderEnum.none){
            $('#period-id').val(newPeriod.toString());
            $.ajax({
                url : 'changePeriod.php',
                type : 'POST',
                data : $("#orderForm").serialize(),
                dataType:'json',
                cache:false,
                beforeSend: function(){
                    if(sender == senderEnum.period){
                        $(".period-text").html("");
                        $(".period-spinner").removeClass("disp-none");
                    } else if(sender == senderEnum.quantity) {
                        $(".quantity-text").html("");
                        $(".quantity-spinner").removeClass("disp-none");
                    } else if (sender == senderEnum.coupon){
                        $(".coupon-button").addClass("disp-none");
                        $(".coupon-spinner").removeClass("disp-none");
                    }
                },
                success : function(data) {

                    priceObject=data;
                    
                    if(sender == senderEnum.period){
                        updatePeriod(newPeriod,periodIDs);
                        updateQuantity(priceObject.quantity);

                    } else if(sender == senderEnum.quantity) {
                        updateQuantity(newQuantity);
                        
                    } else if (sender == senderEnum.coupon){

                        $(".coupon-button").removeClass("disp-none");
                        $(".coupon-spinner").addClass("disp-none");

                        //See if the coupon worked
                        if(priceObject.coupon != null){
                            $(".coupon-msg-code").html(priceObject.coupon["coupon"].coupon_code);
                            $(".coupon-msg-desc").html(priceObject.coupon["coupon"].description);
                            $(".coupon-msg").removeClass("disp-none");
                            $(".coupon-error").addClass("disp-none");
                        }
                        else {
                            $(".coupon-msg").addClass("disp-none");
                            $(".coupon-error").removeClass("disp-none");
                        }
                        updatePrices();
                    }

                    //Assign the forder
                    $("#forder").val(priceObject.forder);
                },
                error : function(request,error)
                {
                    alert("Request: "+JSON.stringify(request));
                }
            });
        }
    });


    $("#loginButton").click(function(){
        $("#regMethod").val("login");
        $("#ajax").val("no");
        $("#orderForm").submit();
    });

    $("#registerButton").click(function(){
        $("#regMethod").val("register");
        $("#ajax").val("no");
        $("#orderForm").submit();
    });

    $('#save-quote-button').featherlight({
        targetAttr: 'href',
        variant:'fl-opened-box',
        beforeOpen: function(event){
        },
        afterOpen: function(event){
            var createdTarget =  $(".fl-opened-box:first").children(1);
            createdTarget.hide();
            createdTarget.slideDown();
        }
    });
});

