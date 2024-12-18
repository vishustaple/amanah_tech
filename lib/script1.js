$(document).ready(function(){

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;
    
    setProgressBar(current);
    
    $(".next").click(function(){
    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 500
    });
    setProgressBar(++current);
    });
    
    $(".previous").click(function(){
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show();
    
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    previous_fs.css({'opacity': opacity});
    },
    duration: 500
    });
    setProgressBar(--current);
    });
    
    function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
    .css("width",percent+"%")
    }
    
    $(".submit").click(function(){
    return false;
    })
    
    });
    
    
    
    // $(document).ready(function () {
    //     // Event listener for toggling dropdown visibility
    //     $(".items_config").on("click", function () {
    //         const dropdown = $(this).siblings(".dropdown_data");
            
    //         // Toggle 'hidden' class to show/hide the dropdown
    //         dropdown.toggleClass("hidden");
    //     });
    
    //     // Optional: Close the dropdown when clicking outside
    //     $(document).on("click", function (e) {
    //         if (!$(e.target).closest(".items_list").length) {
    //             $(".dropdown_data").addClass("hidden");
    //         }
    //     });
    // });
    
    $(document).ready(function () {
        // Event listener for toggling dropdown visibility
        $(".items_config").on("click", function () {
            const dropdown = $(this).siblings(".dropdown_data");
            
            // Close all other dropdowns
            $(".dropdown_data").not(dropdown).addClass("hidden");
            
            // Toggle 'hidden' class to show/hide the clicked dropdown
            dropdown.toggleClass("hidden");
        });
    
        // Close the dropdown when clicking outside
        $(document).on("click", function (e) {
            if (!$(e.target).closest(".items_list").length) {
                $(".dropdown_data").addClass("hidden");
            }
        });
    });
    
    $(document).ready(function () {
        // Initially show the login form
        $(".login-box").addClass("active");
    
        // Toggle to signup form
        $(".login-box a").click(function (e) {
          e.preventDefault();
          $(".login-box").removeClass("active");
          $(".signup-container").addClass("active");
        });
    
        // Toggle to login form
        $(".signup-container a").click(function (e) {
          e.preventDefault();
          $(".signup-container").removeClass("active");
          $(".login-box").addClass("active");
        });
      });

	$(document).ready(function() {
        // Target the list item with the class 'get_hard'
        $('.get_hard').click(function() {
            // Get data attributes
            const dataId = $(this).data('id'), // Get data-id
            dataName = $(this).data('name'), // Get data-name
            dataValue = $(this).data('value'), // Get data-value
			dataClassId = $(this).data('class_id'), // Get data-class_id
			getPrdHtml = $(this).find('.get_prd_name').html(), // Get HTML content of 'get_prd_name' class
            getPriceHtml = $(this).find('.get_price_html').html(), // Get HTML content of 'get_price_html' class
			targetDiv = $('.items_config.set_hard_'+dataClassId+''), // Find the target div and set the values
			inputField = targetDiv.find('.set_val_selected_prd'); // Set input field attributes
			inputField.attr('name', dataName);
			inputField.attr('id', dataId);
			inputField.val(dataValue);
	
			// Log the values to the console
            // console.log('Data ID:', dataId);
            // console.log('Data Name:', dataName);
            // console.log('Data Value:', dataValue);
            // console.log('Product HTML:', getPrdHtml);
            // console.log('Price HTML:', getPriceHtml);

			// Set the product name HTML
			targetDiv.find('.set_prd_name').html(getPrdHtml);
			
			targetDiv.find('.set_price_html').html(getPriceHtml); // Set the price HTML
			
			targetDiv.find('.set_price_html').attr('data-optId', dataValue);
			// const optIds = targetDiv.find('.set_val_selected_prd').val();

			if (targetDiv.find('.set_prd_name').hasClass('first_prd_name')) {
				// Get text content of 'get_prd_name' class
				const getPrdText = $('.first_prd_name').text(),
    
				// Get text content of 'get_price_html' class
				getPriceText = $('.first_prd_price').text();

				// Set the set_title span content
				const setTitle = $('.summary-item'),
				titleHtml = `<span>${getPrdText}</span><span  data-optIdLeftBar="${dataId}">${numeral(getPriceText).format('0,0.00')}</span>`;
				setTitle.empty(); // Clear any existing content
				setTitle.html(titleHtml);
			}

			// Unset the all summary and modification sections
			$('.all-modifications-section, .first-modifications-section').empty(); // Clear any existing content
			$('.order_summary_title').empty();


			$('.order_summary_title').append('<h5 class="card_title ">Order Summary</h5>');

			// Append heading into the first modification section
			$('.first-modifications-section').append('<h4>Custom Modifications</h4>');

			$('.get_all_prd_info').each(function() {
				// Stop select first product
				const firstPrdName = $(this).find('.set_prd_name').hasClass('first_prd_name'),
				
				// Get text content of 'get_prd_name' and 'get_price_html'
				getPrdText = $(this).find('.set_prd_name').text(), // e.g., "Memory: 128 GB RAM"
				getPriceText = $(this).find('.set_price_html').text(), // e.g., "$64.00"
				getNameText = $(this).closest('.items_list').find('.items_name h5').text(), // e.g., "Some Product Name"
				optId = $(this).find('.set_val_selected_prd').attr('id'); // e.g., "ID" 

				if (!firstPrdName) {
					// Create the new modification HTML
					const newModification = `
						<div class="mod-item">
							<span>${getPrdText}</span>
							<span  data-optIdLeftBar="${optId}">${numeral(getPriceText).format('0,0.00')}</span>
						</div>
					`;
			
					// Append the new modification to the modifications section
					$('.first-modifications-section, .all-modifications-section').append(newModification);
				}

				// Create the new modification HTML
				const newModification1 = `
					<div class="items_list">
						<div class="items_name">
							<h5>${getNameText}</h5>
						</div>
						<div class="items_config">
							<h5 class="items_config_title ">${getPrdText}</h5>
							<h5 class="items_config_title"  data-optIdOrderSummary="${optId}">${numeral(getPriceText).format('0,0.00')} <i class="fa fa-caret-down" aria-hidden="true"></i></h5>
						</div>
					</div>
				`;

				// Append the new Order summary to the Order summary section
				$('.order_summary_title').append(newModification1)
			});

			updatePrices();
        });

		$('.all-modifications-section, .first-modifications-section').empty(); // Clear any existing content
		$('.order_summary_title').empty();


			$('.order_summary_title').append('<h5 class="card_title ">Order Summary</h5>');
		// Append heading into the first modification section
		$('.first-modifications-section').append('<h4>Custom Modifications</h4>');

		// Get text content of 'get_prd_name' class
		const getPrdText = $('.first_prd_name').text(),

		// Get text content of 'get_price_html' class
		getPriceText = $('.first_prd_price').text(),

		// Get OptId of 'first_prd_price' class
		dataOptId = $('.first_prd_price').data('optId');

		// Set the set_title span content
		const setTitle = $('.summary-item'),
		titleHtml = `<span>${getPrdText}</span><span  data-optIdLeftBar="${dataOptId}">$${numeral(getPriceText).format('0,0.00')}</span>`;
		setTitle.empty(); // Clear any existing content
		setTitle.html(titleHtml);

		$('.get_all_prd_info').each(function() {
			// Stop select first product
			const firstPrdName = $(this).find('.set_prd_name').hasClass('first_prd_name'),
			
			// Get text content of 'get_prd_name' and 'get_price_html'
			getPrdText = $(this).find('.set_prd_name').text(), // e.g., "Memory: 128 GB RAM"
			getPriceText = $(this).find('.set_price_html').text(), // e.g., "$64.00"
			getNameText = $(this).closest('.items_list').find('.items_name h5').text(), // e.g., "Some Product Name"
			optId = $(this).find('.set_val_selected_prd').attr('id'); // e.g., "ID" 

			if (!firstPrdName) {
				// Create the new modification HTML
				const newModification = `
					<div class="mod-item">
						<span>${getPrdText}</span>
						<span  data-optIdLeftBar="${optId}">${numeral(getPriceText).format('0,0.00')}</span>
					</div>
				`;
		
				// Append the new modification to the modifications section
				$('.first-modifications-section, .all-modifications-section').append(newModification);
			}

			// Create the new modification HTML
			const newModification1 = `
				<div class="items_list">
					<div class="items_name">
						<h5>${getNameText}</h5>
					</div>
					<div class="items_config">
						<h5 class="items_config_title ">${getPrdText}</h5>
						<h5 class="items_config_title"  data-optIdOrderSummary="${optId}">${numeral(getPriceText).format('0,0.00')} <i class="fa fa-caret-down" aria-hidden="true"></i></h5>
					</div>
				</div>
			`;

			// Append the new Order summary to the Order summary section
			$('.order_summary_title').append(newModification1)
		});

		// Setting initial value of quantity
		$('.qty_val').text($('#quantity_value').val());

		// Handle increase and decrease button clicks
		$(document).on('click', '.btn-increase', function () {
			let $quantityInput = $('#quantity_value');
			let currentValue = parseInt($quantityInput.val()) || 1;
			$quantityInput.val(currentValue + 1).trigger('input');

			// Setting value of quantity for all pages
			$('.qty_val').text(currentValue + 1);
		});

		$(document).on('click', '.btn-decrease', function () {
			let $quantityInput = $('#quantity_value');
			let currentValue = parseInt($quantityInput.val()) || 1;
			if (currentValue > 1) {
				$quantityInput.val(currentValue - 1).trigger('input');

				// Setting value of quantity for all pages
				$('.qty_val').text(currentValue - 1);
			}
		});

		// Setting the billing period initial value for all pages
		$('.prd_val').text($('#billing-period option:selected').text());
		
		//In case of period
		$(document).on('change', '#billing-period', function () {
			ajaxUpdateOrderFunc();
		});

		//In case of quantity
		$(document).on('input', '.ajaxUpdateOrder', function () {
			ajaxUpdateOrderFunc();
		});

		//In case of coupon
		$(document).on('click', '.ajaxUpdateOrder1', function () {
			ajaxUpdateOrderFunc(this);
		});

		function ajaxUpdateOrderFunc(object='') {
			//Show page loader
			$('#loader').show();

			var currentPeriod = $('#period-id').val(),
			newPeriod = $('#billing-period').val(), //currentPeriod
			currentQuantity = parseInt(priceObject.quantity),
			newQuantity =  $('#quantity_value').val(),  // currentQuantity;
			senderEnum = Object.freeze({"none":0,"period":1, "quantity":2, "coupon":3}),
			sender = senderEnum.none;

			// Setting the billing period value for all pages
			$('.prd_val').text($('#billing-period option:selected').text());
			
			//If we are switching periods
			if(!isNaN(newPeriod) && newPeriod!=0){
				sender = senderEnum.period;
			} else {
				newPeriod=currentPeriod; //Gracefully degrade if we don't want to do anything this request
			}
	
			//If we are switching quantity
			if(currentQuantity != newQuantity){
				sender = senderEnum.quantity;
			}

			$("#quantity").val(newQuantity .toString());
	
			// If we are applying a coupon 
			if($(object).hasClass('coupon-button')){
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
					success : function(data) {
						// Hide page loader
						$('#loader').hide();

						priceObject=data;
						// if(sender == senderEnum.period){
						// 	// updatePeriod(newPeriod,periodIDs);
						// 	// updateQuantity(priceObject.quantity);
	
						// } else if(sender == senderEnum.quantity) {
						// 	// updateQuantity(newQuantity);
							
						// } else

						if (sender == senderEnum.coupon){
							// $(".coupon-button").removeClass("disp-none");
							// $(".coupon-spinner").addClass("disp-none");
	
							//See if the coupon worked
							if(priceObject.coupon != null){
								$(".coupon-msg-code").html(priceObject.coupon["coupon"].coupon_code);
								$(".coupon-msg-desc").html(priceObject.coupon["coupon"].description);
								$(".coupon-msg").removeClass("disp-none");
								$(".coupon-error").addClass("disp-none");
							} else {
								$(".coupon-msg").addClass("disp-none");
								$(".coupon-error").removeClass("disp-none");
							}
						}

						//Update all products price
						updatePrices();
	
						//Assign the forder
						$("#forder").val(priceObject.forder);
					},
					error : function(request,error)
					{
						alert("Request: "+JSON.stringify(request));
					}
				});
			}
		}

		updatePrices();

		function updatePrices(){
			var subTotal = 0;
			subTotal += parseFloat(priceObject.packRec);
	
			//Go through each radio, see if its an option, if so add it to the subtotal
			$('.get_all_prd_info').each(function() {
				const selectedOptId = $(this).find('.set_val_selected_prd').attr('id'); // e.g., "Id"
				if(selectedOptId != null) {	
					subTotal+=parseFloat(priceObject.upgrades[selectedOptId].price);
				}
			});

			$.each(priceObject.upgrades, function(upgradeId, upgrade) {
				var elementOptId = $('[data-optId="'+upgradeId+'"]'),
				elementOptIdLeftBar = $('[data-optIdLeftBar="'+upgradeId+'"]'),
				elementOptIdOrderSummary = $('[data-optIdOrderSummary="'+upgradeId+'"]');

				elementOptId.each(function() {
					// Log each element with the specified data-optId
					$(this).html('$'+numeral(upgrade.price).format('0,0.00')+'<i class="fa fa-caret-down" aria-hidden="true"></i>');
				});

				elementOptIdLeftBar.each(function() {
					// Log each element with the specified data-optIdLeftBar
					$(this).text('$'+numeral(upgrade.price).format('0,0.00'));
				});

				elementOptIdOrderSummary.each(function() {
					// Log each element with the specified data-optIdOrderSummary
					$(this).html('$'+numeral(upgrade.price).format('0,0.00')+'<i class="fa fa-caret-down" aria-hidden="true"></i>');
				});
				
				// console.log('Upgrade ID:', upgradeId);  // Logs the ID of the upgrade (1, 2, 3, 4)
				// console.log('Price:', upgrade.price);   // Logs the price for the upgrade
				// console.log('Setup:', upgrade.setup);   // Logs the setup for the upgrade
			});

			//Overall order prices
			var quantity = parseInt(priceObject.quantity),
	
			total = (parseFloat(subTotal)*quantity + parseFloat(priceObject.packSetup)*quantity),
			packTotal = parseFloat(priceObject.packRec)*quantity,
			packSetupTotal = parseFloat(priceObject.packSetup),
			orderSetupTotal = packSetupTotal*quantity,
			orderSubtotal = subTotal*quantity;
	
			// console.log(quantity);
			// console.log(total);
			// console.log(packTotal);
			// console.log(packSetupTotal);
			// console.log(orderSetupTotal);
			// console.log(orderSubtotal);

			$(".subtotal-price").html(subTotal.toString());
			$(".total-price").html(total.toString());
			$(".package-setup-price").html(packSetupTotal.toString());
			$(".order-setup-price").html(orderSetupTotal.toString());
			$(".order-subtotal-price").html(orderSubtotal.toString());
			$(".package-price").html(priceObject.packRec);
			$(".package-total-price").html(packTotal.toString());
			
			// Object.entries(priceObject.upgrades).forEach(function(data, index) {
				// $("#sumopt"+data[0]).children(":nth-child(4)").html(data[1].price + data[1].setup);
				// $("#sumopt"+data[0]).children(":nth-child(5)").html((data[1].price + data[1].setup) * quantity);
			// });
	
			//Format all prices
			$(".format-price").each(function(){
				var curVal = $(this).html();
				$(this).html(numeral(curVal).format('$0,0.00')).show();
			});
		}

		const canvas = document.getElementById('signaturePad');
		const ctx = canvas.getContext('2d', { willReadFrequently: true });
		const clearButton = document.getElementById('clearButton');
		const saveButton = document.getElementById('saveButton');
		const signatureInput = document.getElementById('signatureInput');

		let isDrawing = false, lastX = 0, lastY = 0;

		// Draw the text from input onto the canvas
		signatureInput.addEventListener('input', () => {
		ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
		ctx.font = '24px Arial';
		ctx.fillStyle = '#000';
		ctx.fillText(signatureInput.value, 20, 50); // Draw text at a specific position
		});

		// Function to get mouse or touch coordinates relative to the canvas
		function getCoordinates(e) {
		const rect = canvas.getBoundingClientRect();
		let x = 0;
		let y = 0;

		// If it's a touch event (mobile devices)
		if (e.touches) {
			x = e.touches[0].clientX;
			y = e.touches[0].clientY;
		} else {
			// If it's a mouse event (desktop)
			x = e.clientX;
			y = e.clientY;
		}

		// Adjust the coordinates relative to the canvas position
		return {
			x: x - rect.left,
			y: y - rect.top
		};
		}

		// Start drawing on the canvas
		function startDrawing(e) {
		isDrawing = true;
		const { x, y } = getCoordinates(e);
		[lastX, lastY] = [x, y];
		}

		// Draw on the canvas as the user moves the pointer
		function draw(e) {
		if (!isDrawing) return;
		const { x, y } = getCoordinates(e);
		ctx.beginPath();
		ctx.moveTo(lastX, lastY);
		ctx.lineTo(x, y);
		ctx.strokeStyle = '#000';
		ctx.lineWidth = 2;
		ctx.stroke();
		[lastX, lastY] = [x, y];
		}

		// Stop drawing
		function stopDrawing() {
		isDrawing = false;
		ctx.beginPath();
		}

		// Clear the canvas
		function clearCanvas() {
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		}

		// Save the signature as an image and generate PDF
		function saveCanvas(event) {
			// Get the button that triggered the function
			const clickedButton = event.target,

			// Get the data-id attribute
			dataId = clickedButton.getAttribute('data-id'),

			element = document.getElementById('policy_contant'+dataId+''),

			dataURL = canvas.toDataURL('image/png'),
			options = {
				margin: [10, 10, 10, 10],
				filename: 'terms-policy.pdf',
				image: { type: 'jpeg', quality: 0.98 },
				html2canvas: { dpi: 192, letterRendering: true },
				jsPDF: { unit: 'pt', format: 'letter', orientation: 'portrait' }
			};

			$('.signature'+dataId+'').html('');
			$('.signature'+dataId+'').html(`<img src="${dataURL}" alt="Signature" style="width: 200px; height: auto;" />`);
	
			html2pdf().from(element).set(options).output('blob').then(function (pdfBlob) {
				const formData = new FormData();
				formData.append('pdf', pdfBlob, 'terms-policy.pdf');
	
				$.ajax({
				url: '/html/createPdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					// Check if the response is already parsed or needs parsing
					if (typeof response === 'string') {
						try {
							response = JSON.parse(response); // Parse JSON string to object
						} catch (e) {
							console.error('Failed to parse response:', e);
							return;
						}
					}

					if (response.success) {
						
						if (dataId == 1) {
							const newWrapId = parseInt(dataId) + 1;
							$('#policy_contant'+dataId+'').hide();
							$('#policy_contant'+newWrapId+'').show();
							clearCanvas();
							$('.pdf_signed_count').text('');
							$('.pdf_signed_count').text(''+dataId+' / 2');
							$('#saveButton').attr('data-id', newWrapId)
						} else {
							clearCanvas();
							$('.pdf_signed_count').text('');
							$('.pdf_signed_count').text(''+dataId+' / 2');
						}

						$('.progress_bar').append('<div class="progress'+dataId+'"></div>');
					}
					// Handle successful server response
				},
				error: function (error) {
					// Handle error if the AJAX request fails
				}
				});
			});
		}

		// Event listeners for mouse events (desktop)
		canvas.addEventListener('mousedown', startDrawing);  // Mouse down for desktop
		canvas.addEventListener('mousemove', draw);  // Mouse move for desktop
		canvas.addEventListener('mouseup', stopDrawing);  // Mouse up for desktop
		canvas.addEventListener('mouseout', stopDrawing);  // Mouse out for desktop

		// Event listeners for touch events (mobile)
		canvas.addEventListener('touchstart', startDrawing);  // Touch start for mobile
		canvas.addEventListener('touchmove', draw);  // Touch move for mobile
		canvas.addEventListener('touchend', stopDrawing);  // Touch end for mobile
		canvas.addEventListener('touchcancel', stopDrawing);  // Touch cancel for mobile

		// Event listener for clear and save buttons
		clearButton.addEventListener('click', clearCanvas);
		saveButton.addEventListener('click', saveCanvas);

		$('#checkout_pre').click(function(){
			$('#click_checkout_pre').click();
		});

		$('#checkout_next').click(function(){
			$('#click_checkout_next').click();
		});
    });













	// jQuery(document).ready(function(){
	// 		/*Tabs JS*/
	// 	/*
	// 	/Add ID #page-x to all tabs, like #page-1, #page-2, etc...
	// 	/Associate HTML elements with tabs by adding a class version to them, like: .page-1, .page-2, etc...
	// 	/For example: When #page-1 is clicked, all elements with .page-1 on it will show up, 
	// 	/and elements with any other .page-x will disappear. And so forth for #page-2 with .page-2, etc...
	// 	*/
	// 	var pagePrefix = "page-";
	// 	function getCurrentTabNum(){
	// 		return $('.js-tab.active').first().attr('id').substring(5);
	// 	}
	// 	function getTabCount(){
	// 		return $('.pages .js-tab').length;
	// 	}
	// 	function handleTabClick(clickedPageNum) {
	// 		if(clickedPageNum != parseInt(getCurrentTabNum())){
	// 			var tabsAmt = getTabCount();
	// 			var clickedPageId = pagePrefix + clickedPageNum;
	// 			var currentPageId = pagePrefix + getCurrentTabNum();
	// 			//Make all pages inactive
	// 			$('.js-tab').each(function(){$(this).removeClass('active');});
	// 			//Make the clicked page active
	// 			$('#' + clickedPageId).addClass('active');

	// 			//Hide all page content
	// 			for (j = 1; j <= tabsAmt; j++) {
	// 				$('.' + pagePrefix + j).addClass('disp-none');
	// 			}

	// 			//Show the selected page
	// 			$('.' + clickedPageId).removeClass('disp-none');
	// 			$('.' + clickedPageId).addClass('disp-block');
	// 		}
	// 	}

	// 	var tabsAmt = getTabCount();
	// 	//Hide all tabs
	// 	for (i = 1; i <= tabsAmt; i++) {
	// 		$('.' + pagePrefix + i).addClass('disp-none');
	// 	}

	// 	//Always display the first tab on load
	// 	if(tabsAmt>0){
	// 		$('.' + pagePrefix + '1').addClass('disp-block');
	// 		$('.' + pagePrefix + '1').removeClass('disp-none');
	// 		$('#' + pagePrefix + '1').addClass('active');
	// 	}
	// 	//Handle click events for all tabs
	// 	$('.js-tab').click(function(){
	// 		var clickedPage = this.id.substring(5);
	// 		var clickedPageNum = parseInt(clickedPage);
	// 		handleTabClick(clickedPageNum);
	// 	});

	// 	//Form validation
	// 	$("#regPasswordCnf").on('input',function(){
	// 		if ($("#regPasswordCnf").val() != $("#regPassword").val()) {
	// 			$(this)[0].setCustomValidity('Passwords must match.');
	// 		} else {
	// 			// input is valid -- reset the error message
	// 			$(this)[0].setCustomValidity('');
	// 		}
	// 	});

	// 	$(".login-button").click(function(){
	// 		var email;
	// 		var password;
	// 		var passwordCnf;
	// 		var method;
	// 		var formId;
	// 		var firstName = '';
	// 		var lastName = '';
	// 		var company = '';
	// 		var city = '';
	// 		var address = '';
	// 		var state = '';
	// 		var country = '';
	// 		var zip = '';
	// 		var phone = '';

	// 		console.log($("#regFirst").val());
	// 		//Set the data based on the form being submitted
	// 		if($(this).attr("id")=="login-button"){
	// 			email = $("#email").val();
	// 			password = $("#password").val();
	// 			passwordCnf = $("#password").val();
	// 			method="login";
	// 			formId = "#loginForm";

	// 		} else if($(this).attr("id")=="register-button"){
	// 			email = $("#regEmail").val();
	// 			password = $("#regPassword").val();
	// 			passwordCnf = $("#regPasswordCnf").val();
	// 			firstName = $("#regFirst").val();
	// 			lastName = $("#regLast").val();
	// 			company = $("#regCompany").val();
	// 			city = $("#regCity").val();
	// 			address = $("#regAddress").val();
	// 			state = $("#regState").val();
	// 			country = $("#regCountry").val();
	// 			zip = $("#regZip").val();
	// 			phone = $("#regPhone").val();

	// 			method="register";
	// 			formId = "#regForm";
	// 		} 
	// 		if (!$(formId)[0].checkValidity || $(formId)[0].checkValidity()) {
	// 			$(".spinme").html("<i class='fa fa-spinner fa-spin'></i>");
	// 			$.ajax({
	// 				url : 'login.php',
	// 				type : 'POST',
	// 				data : {
	// 					email: email,
	// 					password: password,
	// 					passwordCnf: passwordCnf,
	// 					firstName: firstName,
	// 					lastName: lastName,
	// 					company: company,
	// 					city: city,
	// 					address: address,
	// 					state: state,
	// 					country: country,
	// 					zip: zip,
	// 					phone: phone,
	// 					method: method,
	// 					forder: "<?= $this->forder ?>",
	// 				},
	// 				dataType:'json',
	// 				cache:false,
	// 				success : function(data) {
	// 					$(".spinme").html("");
	// 					$("#invalidInputErr").addClass("disp-none");
	// 					$("#takenEmailError,#regOtherError").addClass("disp-none");
	// 					$("#authError").addClass("disp-none");

	// 					if(data.error=="none"){
	// 						window.location.replace("checkout.php?forder=<?= $this->forder ?>");
	// 					} else if(data.error=="validation") {
	// 						$("#regValidError").removeClass("disp-none");
	// 					} else if(data.error=="taken"){
	// 						$("#regTakenError").removeClass("disp-none");
	// 					} else if(data.error=="auth"){
	// 						$("#loginAuthError").removeClass("disp-none");
	// 					} else if(data.error=="multi"){
	// 						$("#multiAcctError").removeClass("disp-none");
	// 					} else {
	// 						$("#regOtherError").removeClass("disp-none");
	// 						$("#regOtherError").html(data.error)
	// 					}
	// 				},
	// 				error : function(request,error)
	// 				{
	// 					alert("Request: "+JSON.stringify(request));
	// 				}
	// 			});
	// 			return false;
	// 		} else {
	// 			return true;
	// 		}
	// 	});
	// 	$('.send-forgot-button').click(function(){
	// 		$(".forgot-spinme").html("<i class='fa fa-spinner fa-spin'></i>");
	// 		$(".send-forgot-button").css("display","none");
	// 		$(".forgot-spinme").html("<i class='fa fa-spinner fa-spin'></i>");
	// 		var nonEmptyEmail = "";
	// 		$( "input[name='forgot-email']" ).each(function(){
	// 			if($(this).val()!=""){
	// 				nonEmptyEmail=$(this).val();
	// 			}
	// 		});
	// 		$.ajax({
	// 			url : 'forgotPass.php',
	// 			type : 'POST',
	// 			data : {
	// 				email: nonEmptyEmail,
	// 			},
	// 			dataType:'json',
	// 			cache:false,
	// 			success : function(data) {
	// 				$(".forgot-spinme").html("");
	// 				$(".send-forgot-success").css("display","block");
	// 				$(".forgot-spinme").html("");
	// 				$(".send-forgot-cancel").html("Close");
	// 			},
	// 			error : function(request,error)
	// 			{
	// 				alert("Request: "+JSON.stringify(request));
	// 			}
	// 		});
	// 	});

	// 	var urlParams = new URLSearchParams(window.location.search);
	// 	if(urlParams.has('reg')){
	// 		handleTabClick(2);
	// 	}

	// 	$('#forgot-id').featherlight({
	// 		targetAttr:'href',
	// 		persist : true
	// 	});
   	// });