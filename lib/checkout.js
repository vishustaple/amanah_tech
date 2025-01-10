jQuery(document).ready(function(){
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
		console.log('click');
		$(this).siblings('ul').children('.gt').toggleClass('disp-none');
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

    /* Summary functionality */
    $('.view-server-details').click(function(){
        $('.hidden-detail').toggleClass('show-details');
        $(this).toggleClass('toggle-reverse');
    });


    /* Summary functionality */
    $('.checkout-view-server-details').click(function(){
        $('.hidden-detail').toggleClass('show-details');
        $(this).toggleClass('toggle-reverse');
    });


    /* Period switching*/
    var periodIDs = {
        0:{"prev":0,"next":0,"title":"Undefined"},
        1:{"prev":0,"next":3,"title":"Monthly"},
        3:{"prev":1,"next":6,"title":"Quarterly"},
        6:{"prev":3,"next":12,"title":"Semi-Annually"},
        12:{"prev":6,"next":0,"title":"Annually"}
    };

    //Format the period indicators
    $(".format-period").each(function(){
        $(this).html(periodIDs[parseInt($(this).html())]["title"]);
    });

    //Format all the currency fields
    $(".format-price").each(function(){
        var curVal = $(this).html();
        $(this).html(numeral(curVal).format('$0,0.00')).show();
    });

    $(".paypal-button").click(function(){
        $(".cc_field").removeAttr("required");
        $("#pm").val("pp");
        return true;
    });

    $(".sub-order-button").click(function(){
        $(".cc_field").attr("required",true);
        $("#pm").val("cc");
        return true;
    });



    $(".payswitch").click(function(){
        if(!$(this).hasClass("pay-icon-selected")){
            $("#pplink").toggleClass("pay-icon-selected");
            $("#cclink").toggleClass("pay-icon-selected");
            $(".ccspan").toggleClass("disp-none");
            $(".ppspan").toggleClass("disp-none");
            $("#pp-submit").toggleClass("disp-none");
            $("#sub-order-button").toggleClass("disp-none");
        }
    });

    $(".tax-form-data").change(function(){
        //Hide all tax fields
        $(".tax-item").removeClass("disp-block");
        $(".tax-item").removeClass("disp-inline");
        $(".tax-item").addClass("disp-none");

        if($("#country").val()=="CA"){
            //A tax will be applied, show universal tax fields
            $(".tax-item-ANY").addClass("disp-inline");
            $(".tax-item-ANY").removeClass("disp-none");

            //Show select tax fields
            if($("#statedropdown").val()=="ON"){
                $(".tax-item-ON").addClass("disp-inline");
                $(".tax-item-ON").removeClass("disp-none");
            } else {
                $(".tax-item-CA").addClass("disp-inline");
                $(".tax-item-CA").removeClass("disp-none");
            }
        } else {
            //Show no tax items
            $(".tax-item-NONE").addClass("disp-inline");
            $(".tax-item-NONE").removeClass("disp-none");
        }

        //Update the textbox value
        if($("#country").val()=="CA" || $("#country").val()=="US"){

            //Populate the text box with the selected state
            $("#state").val($("#statedropdown").val());

            //Switch visisble inputs
            $("#statedropdown").removeClass("disp-none");
            $("#statedropdown").addClass("disp-inline");
            $("#state").addClass("disp-none");
            $("#state").removeClass("disp-inline");
        } else {
            //Clear the state text box
            $("#state").val("");

            //Switch visisble inputs
            $("#state").removeClass("disp-none");
            $("#state").addClass("disp-inline");
            $("#statedropdown").addClass("disp-none");
            $("#statedropdown").removeClass("disp-inline");
        }
    });

    //Auto select the country
    var $select = $('#country');
    $select.val(defCountry).change();

    if(defCountry=="CA" || defCountry=="US")
    {
        var $selectState = $('#statedropdown');
        $selectState.val(defState).change();
    }

/*
    //On back button add forder to addplan
    $(window).on("navigate", function (event, data) {
      var direction = data.state.direction;
      if (direction == 'back') {
        window.location.href = 'addplan.php?forder=' + forder;
      }
    });
*/
});