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
	let globalQuantity = 1; 
	function formatCurrencyCustom(value) {
		// Ensure the value is a number and handle invalid input
		if (isNaN(value)) {
			console.error('Invalid number');
			return '$0.00';  // Return a default value in case of an invalid number
		}
		// Format the number with commas for thousands
		const formattedValue = value.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		// Add the dollar sign at the start
		return '$' + formattedValue;
	}
// Order Total count and price data appendations 
	function orderSummeryData(value){
		const textQuantityTotal = 'Quantity';
		const setUpcostText= "Setup Cost";
		const OrderTotaltext = "Order Total";
		const PackegeCostText='Packege Cost';
		const packegesCost = $(".package-setup-price:first").text();
		const setupcost = $('.package-price:first').text();
		// Get the text content from .total-price and .order-subtotal-price
		const setUpcost = $(".total-price:first").text();
		const totalPriceText = $(".order-subtotal-price:first").text();
		// Clean the strings to remove any non-numeric characters (like '$' or ',')
		const cleanSetUpCost = parseFloat(setUpcost.replace(/[^\d.-]/g, ''));
		const cleanTotalPriceText = parseFloat(totalPriceText.replace(/[^\d.-]/g, ''));
		const finalPackegesCost = parseFloat(packegesCost.replace(/[^\d.-]/g, ''));
		const finalpackegdataCost = parseFloat(setupcost.replace(/[^\d.-]/g, ''));
		const setupPrice = cleanSetUpCost;
		const orderTotal = cleanTotalPriceText;
		const  newOrderCountData = `
		<div class="items_list">
				<div class="items_name">
					<h5>${setUpcostText}</h5>
				</div>
				<div class="items_config">
					<h5 class="items_config_title "></h5>
					<h5 class="items_config_title" data-OrderCount="">${formatCurrencyCustom(finalPackegesCost)} </h5>
				</div>
			</div>
			<div class="items_list">
				<div class="items_name">
					<h5>${PackegeCostText}</h5>
				</div>
				<div class="items_config">
					<h5 class="items_config_title "></h5>
					<h5 class="items_config_title" data-OrderCount="">${formatCurrencyCustom(finalpackegdataCost)} </h5>
				</div>
			</div>
			<div class="items_list">
				<div class="items_name">
					<h5>${textQuantityTotal}</h5>
				</div>
				<div class="items_config">
					<h5 class="items_config_title "></h5>
					<h5 class="items_config_title" data-OrderCount="">${value} </h5>
				</div>
			</div>
			
			<div class="items_list" style="background-color: #bce8f1;">
				<div class="items_name" style="background-color: #bce8f1;">
					<h5>${OrderTotaltext}</h5>
				</div>
				<div class="items_config">
					<h5 class="items_config_title"></h5>
					<h5 class="items_config_title" data-OrderCount="">
						${formatCurrencyCustom(orderTotal)} 
					</h5>
				</div>
			</div>
		`;
		$('.order_summary_data').html(newOrderCountData);
		
	}
    
    $(document).ready(function () {
        // Initially show the login form
        $(".login-box").addClass("active");
    
        // Toggle to signup form
        $(".create-account").click(function (e) {
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

		  // Toggle to forgot form
		  $(".forgot-password").click(function (e) {
			e.preventDefault();
			$(".login-box").removeClass("active");
			$(".forgot-sec").addClass("active");
		  });

		   // Toggle to login form
		   $(".login-link").click(function (e) {
			e.preventDefault();
			$(".forgot-sec").removeClass("active");
			$(".login-box").addClass("active");
		  });
      });
	 
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
console.log(priceObject.upgrades);
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
			targetDiv.addClass('changed_div');
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
			
			const setupcost = $('.package-price:first').text();
			$('.get_all_prd_info').each(function(index) {
				// Stop select first product
				const firstPrdName = $(this).find('.set_prd_name').hasClass('first_prd_name'),
				
				// Get text content of 'get_prd_name' and 'get_price_html'
				getPrdText = $(this).find('.set_prd_name').text(), // e.g., "Memory: 128 GB RAM"
				getPriceText = $(this).find('.set_price_html').text(), // e.g., "$64.00"
				getNameText = $(this).closest('.items_list').find('.items_name h5').text(), // e.g., "Some Product Name"
				optId = $(this).find('.set_val_selected_prd').attr('id'); // e.g., "ID" 
				if (!firstPrdName) {
					// // Create the new modification HTML
					// const newModification = `
					// 	<div class="mod-item">
					// 		<span>${getPrdText}</span>
					// 		<span  data-optIdLeftBar="${optId}">${numeral(getPriceText).format('0,0.00')}</span>
					// 	</div>
					// `;
			
					// // Append the new modification to the modifications section
					// $('.first-modifications-section, .all-modifications-section').append(newModification);
				}
				const packegesCost = $(".package-setup-price:first").text();
				console.log("debuggg here", packegesCost);

				// Create the new modification HTML
				const newModification1 = `
					<div class="items_list">
						<div class="items_name">
							<h5>${index === 0 ? 'Base Configuration' : getNameText}</h5>
						</div>
						<div class="items_config">
							<h5 class="items_config_title ">${getPrdText}</h5>
							<h5 class="items_config_title"  >${index==0 ? numeral(setupcost).format('0,0.00'):numeral(getPriceText).format('0,0.00')}
							</h5>
						</div>
					</div>

				`;

				// Append the new Order summary to the Order summary section
				$('.order_summary_title').append(newModification1)
			});

			$('.changed_div').each(function() {
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
				// const newModification1 = `
				// 	<div class="items_list">
				// 		<div class="items_name">
				// 			<h5>${getNameText}</h5>
				// 		</div>
				// 		<div class="items_config">
				// 			<h5 class="items_config_title ">${getPrdText}</h5>
				// 			<h5 class="items_config_title"  data-optIdOrderSummary="${optId}">${numeral(getPriceText).format('0,0.00')} <i class="fa fa-caret-down" aria-hidden="true"></i></h5>
				// 		</div>
				// 	</div>
					

				// `;

				// // Append the new Order summary to the Order summary section
				// $('.order_summary_title').append(newModification1)
			});


// Get the updated quantity and append it to the order summary
			updatePrices();
			
			orderSummeryData(globalQuantity);

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

		const packegesCost = $(".package-price").text();
		console.log("debuggg here", packegesCost);
		
		$('.get_all_prd_info').each(function(index) {
			// Stop select first product
			const firstPrdName = $(this).find('.set_prd_name').hasClass('first_prd_name'),
			
			// Get text content of 'get_prd_name' and 'get_price_html'
			getPrdText = $(this).find('.set_prd_name').text(), // e.g., "Memory: 128 GB RAM"
			getPriceText = $(this).find('.set_price_html').text(), // e.g., "$64.00"
			getNameText = $(this).closest('.items_list').find('.items_name h5').text(), // e.g., "Some Product Name"
			optId = $(this).find('.set_val_selected_prd').attr('id'); // e.g., "ID" 

			if (!firstPrdName) {
				// Create the new modification HTML
				// const newModification = `
				// 	<div class="mod-item">
				// 		<span>${getPrdText}</span>
				// 		<span  data-optIdLeftBar="${optId}">${numeral(getPriceText).format('0,0.00')}</span>
				// 	</div>
				// `;
		
				// // Append the new modification to the modifications section
				// $('.first-modifications-section, .all-modifications-section').append(newModification);
			}

			// Create the new modification HTML
			
			const newModification1 = `
				<div class="items_list">
					<div class="items_name">
						<h5>${index === 0 ? "Base Configuration" : getNameText}</h5>
					</div>
					<div class="items_config">
						<h5 class="items_config_title ">${getPrdText}</h5>
						<h5 class="items_config_title"  >${index==0 ?  formatCurrencyCustom(100): numeral(getPriceText).format('0,0.00')} </h5>
					</div>
				</div>
			`;

			// Append the new Order summary to the Order summary section
			$('.order_summary_title').append(newModification1)
			updatePrices();
			orderSummeryData(globalQuantity);
		});

		// Setting initial value of quantity
		$('.qty_val').text($('#quantity_value').val());

		// Handle increase and decrease button clicks
		$(document).on('click', '.btn-increase', function (event) {
			event.preventDefault()
			let $quantityInput = $('#quantity_value');
			let currentValue = parseInt($quantityInput.val()) || 1;
			$quantityInput.val(currentValue + 1).trigger('input');
			globalQuantity = currentValue + 1;
			// Setting value of quantity for all pages
			   // Update .qty_val element with the new quantity
			   $('.qty_val').text(globalQuantity);
			   orderSummeryData(globalQuantity);
		});

		$(document).on('click', '.btn-decrease', function (event) {
			event.preventDefault()
			let $quantityInput = $('#quantity_value');
			let currentValue = parseInt($quantityInput.val()) || 1;
			if (currentValue > 1) {
				$quantityInput.val(currentValue - 1).trigger('input');
				globalQuantity = currentValue - 1;
				// Setting value of quantity for all pages
				$('.qty_val').text(globalQuantity);
				orderSummeryData(globalQuantity);
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
			$('.perioud_cost').text('')
			$('.perioud_cost').text($('#billing-period option:selected').text()+' Cost')

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
					data : $("#orderForms").serialize(),
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
    		// Check if the canvas is blank
			const isCanvasBlank = !ctx.getImageData(0, 0, canvas.width, canvas.height)
			.data.some(channel => channel !== 0);

			if (isCanvasBlank) {
				alert('Please provide a signature before proceeding.');
				return; // Stop further execution
			}

			// Existing code for saving the canvas and generating the PDF
			const clickedButton = event.target,
			dataId = clickedButton.getAttribute('data-id'),
			element = document.getElementById('policy_contant' + dataId + ''),
			dataURL = canvas.toDataURL('image/png'),
			options = {
				margin: [10, 10, 10, 10],
				filename: 'terms-policy.pdf',
				image: { type: 'jpeg', quality: 0.98 },
				html2canvas: { dpi: 192, letterRendering: true },
				jsPDF: { unit: 'pt', format: 'letter', orientation: 'portrait' }
			};

			$('.signature' + dataId + '').html('');
			$('.signature' + dataId + '').html(`<img src="${dataURL}" alt="Signature" style="width: 200px; height: auto;" />`);

			html2pdf().from(element).set(options).output('blob').then(function (pdfBlob) {
				const formData = new FormData();
				formData.append('pdf', pdfBlob, 'terms-policy.pdf');

				$.ajax({
					url: 'createPdf.php',
					type: 'POST',
					data: formData, 
					processData: false,
					contentType: false,
					success: function (response) {
						if (typeof response === 'string') {
							try {
								response = JSON.parse(response);
							} catch (e) {
								console.error('Failed to parse response:', e);
								return;
							}
						}

						if (response.success) {
							if (dataId == 1) {
								const newWrapId = parseInt(dataId) + 1;
								$('#policy_contant' + dataId + '').hide();
								$('#policy_contant' + newWrapId + '').show();
								clearCanvas();
								$('.pdf_signed_count').text('');
								$('.pdf_signed_count').text('' + dataId + ' / 2');
								$('.pdf_signed_count_two').text('');
								$('.pdf_signed_count_two').text('Signed Documents: ' + dataId + ' / 2');
								
								$('#saveButton').attr('data-id', newWrapId);
							} else {
								clearCanvas();
								$('.pdf_signed_count').text('');
								$("#checkout_next").prop("disabled", false);
								$('.pdf_signed_count').text('' + dataId + ' / 2');
								$('.pdf_signed_count_two').text('');
								$('.pdf_signed_count_two').text('Signed Documents: ' + dataId + ' / 2');
							}

							$('.progress_bar').append('<div class="progress' + dataId + '"></div>');
						}
					},
					error: function (error) {
						console.error('Error saving signature:', error);
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

		$('#checkout_pre_one').click(function(){
			$('#click_checkout_pre_one').click();
		});

		$('#checkout_next').click(function(){
			$('#loader').show();
			$("#ajax").val("no");
			$.ajax({
				url : 'changePeriod.php',
				type : 'POST',
				data : $("#orderForms").serialize(),
				dataType:'json',
				cache:false,
				success : function(response) {
					// Hide page loader
					$('#loader').hide();
		
					// Access the specific data, e.g., forder
					$('.login_forder').val(response.forder);

					// console.log("Order ID: " + orderID);
					$('#click_checkout_next').click();
				},
				error : function(request,error)
				{
					alert("Request: "+JSON.stringify(request));
				}
			});
		});

		// Define states for each country
		const states = {
			CA: [
			{ value: 'AB', text: 'Alberta' },
			{ value: 'BC', text: 'British Columbia' },
			{ value: 'MB', text: 'Manitoba' },
			{ value: 'NB', text: 'New Brunswick' },
			{ value: 'NF', text: 'Newfoundland' },
			{ value: 'NT', text: 'Northwest Territories' },
			{ value: 'NS', text: 'Nova Scotia' },
			{ value: 'NU', text: 'Nunavut' },
			{ value: 'ON', text: 'Ontario' },
			{ value: 'PE', text: 'Prince Edward Island' },
			{ value: 'QC', text: 'Quebec' },
			{ value: 'SK', text: 'Saskatchewan' },
			{ value: 'YT', text: 'Yukon Territory' }
			],
			US: [
			{ value: 'AK', text: 'Alaska' },
			{ value: 'AL', text: 'Alabama' },
			{ value: 'AR', text: 'Arkansas' },
			{ value: 'AZ', text: 'Arizona' },
			{ value: 'CA', text: 'California' },
			{ value: 'CO', text: 'Colorado' },
			{ value: 'CT', text: 'Connecticut' },
			{ value: 'DC', text: 'District of Columbia' },
			{ value: 'DE', text: 'Delaware' },
			{ value: 'FL', text: 'Florida' },
			{ value: 'GA', text: 'Georgia' },
			{ value: 'HI', text: 'Hawaii' },
			{ value: 'IA', text: 'Iowa' },
			{ value: 'ID', text: 'Idaho' },
			{ value: 'IL', text: 'Illinois' },
			{ value: 'IN', text: 'Indiana' },
			{ value: 'KS', text: 'Kansas' },
			{ value: 'KY', text: 'Kentucky' },
			{ value: 'LA', text: 'Louisiana' },
			{ value: 'MA', text: 'Massachusetts' },
			{ value: 'MD', text: 'Maryland' },
			{ value: 'ME', text: 'Maine' },
			{ value: 'MI', text: 'Michigan' },
			{ value: 'MN', text: 'Minnesota' },
			{ value: 'MO', text: 'Missouri' },
			{ value: 'MS', text: 'Mississippi' },
			{ value: 'MT', text: 'Montana' },
			{ value: 'NC', text: 'North Carolina' },
			{ value: 'ND', text: 'North Dakota' },
			{ value: 'NE', text: 'Nebraska' },
			{ value: 'NH', text: 'New Hampshire' },
			{ value: 'NJ', text: 'New Jersey' },
			{ value: 'NM', text: 'New Mexico' },
			{ value: 'NV', text: 'Nevada' },
			{ value: 'NY', text: 'New York' },
			{ value: 'OH', text: 'Ohio' },
			{ value: 'OK', text: 'Oklahoma' },
			{ value: 'OR', text: 'Oregon' },
			{ value: 'PA', text: 'Pennsylvania' },
			{ value: 'PR', text: 'Puerto Rico' },
			{ value: 'RI', text: 'Rhode Island' },
			{ value: 'SC', text: 'South Carolina' },
			{ value: 'SD', text: 'South Dakota' },
			{ value: 'TN', text: 'Tennessee' },
			{ value: 'TX', text: 'Texas' },
			{ value: 'UT', text: 'Utah' },
			{ value: 'VA', text: 'Virginia' },
			{ value: 'VT', text: 'Vermont' },
			{ value: 'WA', text: 'Washington' },
			{ value: 'WI', text: 'Wisconsin' },
			{ value: 'WV', text: 'West Virginia' },
			{ value: 'WY', text: 'Wyoming' }
			]
		};

		// On country change
		$('#regCountry').change(function () {
			const selectedCountry = $(this).val(),
			$stateSelect = $('#regState');

			// Clear previous options
			$stateSelect.empty().append('<option value="">Select a State/Province</option>');

			if (selectedCountry && states[selectedCountry]) {
				// Enable and populate the state dropdown
				$stateSelect.prop('disabled', false);

				states[selectedCountry].forEach(function (state) {
					$stateSelect.append(`<option value="${state.value}">${state.text}</option>`);
				});
			} else {
				// Disable the state dropdown if no country is selected
				$stateSelect.prop('disabled', true);
				// $stateSelect.delete();
				// $('.regStateClass').empty()
			}
		});

		/*Tabs JS*/
		//Form validation
		$("#regPasswordCnf").on('input',function(){
			if ($("#regPasswordCnf").val() != $("#regPassword").val()) {
				$(this)[0].setCustomValidity('Passwords must match.');
			} else {
				// input is valid -- reset the error message
				$(this)[0].setCustomValidity('');
			}
		});

		// Handle form validation on 'Sign In' form
		// Get the form and input elements using jQuery
		const $form1 = $('#loginform'),
		$inputs1 = $form1.find('input, select');

		// Optional: Add validation on input change for instant feedback
		$inputs1.each(function() {
			const $input = $(this);

			// Bind input event to validate the field as the user types
			$input.on('input', function() {
				if ($input[0].checkValidity()) {
					$input.removeClass('is-invalid').addClass('is-valid');
				} else {
					$input.removeClass('is-valid').addClass('is-invalid');
				}
			});
		});

		$('#loginform').submit(function (event) {
			event.preventDefault(); // Prevent form submission to handle validation

			var email,
			method,
			password,
			passwordCnf,
			zip = '',
			city = '',
			state = '',
			phone = '',
			address = '',
			country = '',
			company = '',
			lastName = '',
			firstName = '';

			// Find all input elements within the form
			const form = $(this),
			inputs = form.find('input');
			
			let isValid = true; // Flag to track if the form is valid
			
			// Loop through each input element to check its validity
			inputs.each(function () {
				const input = $(this);
				const invalidFeedback = input.siblings('.invalid-feedback');
	
				if (input[0].checkValidity()) {
					input.removeClass('is-invalid').addClass('is-valid');
					invalidFeedback.hide();
				} else {
					input.removeClass('is-valid').addClass('is-invalid');
					invalidFeedback.show();
					isValid = false; // Set to false if any field is invalid
				}
			});
	
			if (isValid) {
				// Proceed with form submission or further action (e.g., AJAX request)
				console.log("Form is valid!");

				email = $("#logemail").val();
				passwordCnf = password = $("#logpassword").val();
				method="login";

				//Show page loader
				$('#loader').show();
				$.ajax({
					url : 'login.php',
					type : 'POST',
					data : {
						email: email,
						password: password,
						passwordCnf: passwordCnf,
						firstName: firstName,
						lastName: lastName,
						company: company,
						city: city,
						address: address,
						state: state,
						country: country,
						zip: zip,
						phone: phone,
						method: method,
						forder: $('.login_forder').val(),
					},
					dataType:'json',
					cache:false,
					success : function(data) {
						$("#invalidInputErr").addClass("disp-none");
						$("#takenEmailError,#regOtherError").addClass("disp-none");
						$("#authError").addClass("disp-none");

						if (data.error=="none") {
							$.ajax({
								url : 'checkout.php',
								type : 'GET',
								data : {forder: $('.login_forder').val()},
								dataType:'json',
								cache:false,
								success : function(checkoutResponse) {
									console.log(checkoutResponse);
									$('#loader').hide();
									$('#chforder').val(checkoutResponse.forder);
									$('#fname').val(checkoutResponse.fname);
									$('#lname').val(checkoutResponse.lname);
									$('#chemail').val(checkoutResponse.email);
									$('#chphone').val(checkoutResponse.phone);
									$('#chaddress').val(checkoutResponse.address);
									$('#chcity').val(checkoutResponse.city);
									$('#chzip').val(checkoutResponse.postal);
									$('#chstate').val(checkoutResponse.state); // If 'state' is a predefined list of options, make sure the correct option has the same value as the state
									$('#chcountry').val(checkoutResponse.country);
									$('#chcompany').val(checkoutResponse.company); // If there's no company, it will remain empty
									$('#go_to_checkout').click();
								},
								error : function(request,error) {
									$('#loader').hide();
									alert("Request: "+JSON.stringify(request));
								}
							});
							// window.location.replace("checkout.php?forder=<?= $this->forder ?>");
						} else if(method=="register" && data.error=="validation") {
							$('#loader').hide();
							$("#regValidError").removeClass("disp-none");
						} else if(method=="register" && data.error=="taken"){
							$('#loader').hide();
							$("#regTakenError").removeClass("disp-none");
						} else if(data.error=="auth"){
							$('#loader').hide();
							$("#loginAuthError").removeClass("disp-none");
						} else {
							// $("#regOtherError").removeClass("disp-none");
							// $("#regOtherError").html(data.error)
						}
					},
					error : function(request,error) {
						$('#loader').hide();
						alert("Request: "+JSON.stringify(request));
					}
				});
				return false;
			}
		});
	
		// Handle form validation on 'Forgot Password' form
		// Get the form and input elements using jQuery
		const $form11 = $('#forgotpassword'),
		$inputs11 = $form11.find('input, select');

		// Optional: Add validation on input change for instant feedback
		$inputs11.each(function() {
			const $input = $(this);

			// Bind input event to validate the field as the user types
			$input.on('input', function() {
				if ($input[0].checkValidity()) {
					$input.removeClass('is-invalid').addClass('is-valid');
				} else {
					$input.removeClass('is-valid').addClass('is-invalid');
				}
			});
		});

		$('#forgotpassword').submit(function (event) {
			event.preventDefault(); // Prevent form submission to handle validation

			const form = $(this),
			emailInput = form.find('input'), // Get the email input
			invalidFeedback = emailInput.siblings('.invalid-feedback');
			
			if (emailInput[0].checkValidity()) {
				emailInput.removeClass('is-invalid').addClass('is-valid');
				invalidFeedback.hide();
				console.log('Form is valid!');
				var nonEmptyEmail = "";

				$( "input[name='forgot-email']" ).each(function(){
					if($(this).val()!=""){
						nonEmptyEmail=$(this).val();
					}
				});

				$.ajax({
					url : 'forgotPass.php',
					type : 'POST',
					data : {email: nonEmptyEmail},
					dataType:'json',
					cache:false,
					success : function(data) {
						$(".send-forgot-success").css("display","block");
					},
					error : function(request,error)
					{
						alert("Request: "+JSON.stringify(request));
					}
				});
			} else {
				emailInput.removeClass('is-valid').addClass('is-invalid');
				invalidFeedback.show();
			}
		});
	
		// Handle form validation on 'Create Account' form (Sign-up)
		// Get the form and input elements using jQuery
		const $form = $('#regForm');
		const $inputs = $form.find('input, select');

		// Optional: Add validation on input change for instant feedback
		$inputs.each(function() {
			const $input = $(this);

			// Bind input event to validate the field as the user types
			$input.on('input', function() {
				if ($input[0].checkValidity()) {
					$input.removeClass('is-invalid').addClass('is-valid');
				} else {
					$input.removeClass('is-valid').addClass('is-invalid');
				}
			});
		});

		$('#regForm').submit(function (event) {
			event.preventDefault(); // Prevent form submission to handle validation
			var email,
			method,
			password,
			passwordCnf,
			zip = '',
			city = '',
			state = '',
			phone = '',
			address = '',
			country = '',
			company = '',
			lastName = '',
			firstName = '';

			const form = $(this);
			const inputs = form.find('input'); // Get all inputs in the form
			
			let isValid = true; // Flag to track if the form is valid
			
			// Loop through each input element to check its validity
			inputs.each(function () {
				const input = $(this);
				const invalidFeedback = input.siblings('.invalid-feedback');
	
				if (input[0].checkValidity()) {
					input.removeClass('is-invalid').addClass('is-valid');
					invalidFeedback.hide();
				} else {
					input.removeClass('is-valid').addClass('is-invalid');
					invalidFeedback.show();
					isValid = false; // Set to false if any field is invalid
				}
			});
	
			if (isValid) {
				// Proceed with form submission or further action (e.g., AJAX request)
				// console.log("Form is valid!");
				email = $("#regEmail").val();
				password = $("#regPassword").val();
				passwordCnf = $("#regPasswordCnf").val();
				firstName = $("#regFirst").val();
				lastName = $("#regLast").val();
				company = $("#regCompany").val();
				city = $("#regCity").val();
				address = $("#regAddress").val();
				state = $("#regState").val();
				country = $("#regCountry").val();
				zip = $("#regZip").val();
				phone = $("#regPhone").val();
				method="register";

				//Show page loader
				$('#loader').show();
				$.ajax({
					url : 'login.php',
					type : 'POST',
					data : {
						email: email,
						password: password,
						passwordCnf: passwordCnf,
						firstName: firstName,
						lastName: lastName,
						company: company,
						city: city,
						address: address,
						state: state,
						country: country,
						zip: zip,
						phone: phone,
						method: method,
						forder: $('.login_forder').val(),
					},
					dataType:'json',
					cache:false,
					success : function(data) {
						$("#invalidInputErr").addClass("disp-none");
						$("#takenEmailError,#regOtherError").addClass("disp-none");
						$("#authError").addClass("disp-none");

						if (data.error=="none") {
							$.ajax({
								url : 'checkout.php',
								type : 'GET',
								data : {forder: $('.login_forder').val()},
								dataType:'json',
								cache:false,
								success : function(checkoutResponse) {
									console.log(checkoutResponse);
									$('#loader').hide();
									// Set values using jQuery
									$('#chforder').val(checkoutResponse.forder);
									$('#fname').val(checkoutResponse.fname);
									$('#lname').val(checkoutResponse.lname);
									$('#chemail').val(checkoutResponse.email);
									$('#chphone').val(checkoutResponse.phone);
									$('#chaddress').val(checkoutResponse.address);
									$('#chcity').val(checkoutResponse.city);
									$('#chzip').val(checkoutResponse.postal);
									$('#chstate').val(checkoutResponse.state); // If 'state' is a predefined list of options, make sure the correct option has the same value as the state
									$('#chcountry').val(checkoutResponse.country);
									$('#chcompany').val(checkoutResponse.company); // If there's no company, it will remain empty
									$('#go_to_checkout').click();
								},
								error : function(request,error) {
									$('#loader').hide();
									alert("Request: "+JSON.stringify(request));
								}
							});

							// window.location.replace("checkout.php?forder=<?= $this->forder ?>");
						} else if(method=="register" && data.error=="validation") {
							$('#loader').hide();
							$("#regValidError").removeClass("disp-none");
						} else if(method=="register" && data.error=="taken"){
							$('#loader').hide();
							$("#regTakenError").removeClass("disp-none");
						} else if(method=="register" && data.error=="multi"){
							$('#loader').hide();
							$("#multiAcctError").removeClass("disp-none");
						} else {
							$("#regOtherError").removeClass("disp-none");
							$("#regOtherError").html(data.error)
						}
					},
					error : function(request,error)
					{
						$('#loader').hide();
						alert("Request: "+JSON.stringify(request));
					}
				});
				return false;
			}
		});

		$('.submitButton').on('click', function(e) {
			e.preventDefault(); // Prevent form from submitting normally
			
			if($(this).attr("id")=="pp-submit"){
				$(".cc_field").removeAttr("required");
				var pm = "pp";
			} else if($(this).attr("id")=="sub-order-button"){
				$(".cc_field").attr("required",true);
				var pm = "cc";
			} else {

			}
			// Collect all form data into an object
			var formData = {
				s:1,
				pm: pm,
				forder: $('#chforder').val(),
				fname: $('#fname').val(),
				lname: $('#lname').val(),
				email: $('#chemail').val(),
				phone: $('#chphone').val(),
				address: $('#chaddress').val(),
				city: $('#chcity').val(),
				zip: $('#chzip').val(),
				state: $('#chstate').val(),
				country: $('#chcountry').val(),
				company: $('#chcompany').val(),
				ccNum: $('#ccNum').val(),
				ccm: $('#ccm').val(),
				ccy: $('#ccy').val(),
				cccvv2: $('#cccvv2').val(),
				// total: response.total // If the total is part of the data from the response
			};
			//Show page loader
			$('#loader').show();

			// Perform the AJAX POST request
			$.ajax({
				url: 'checkout.php', // Your server-side script
				type: 'POST',
				data: formData,
				dataType: 'json',
				success: function(response) {
					// Response contains the order details like orderID, email, total, paypal, and button
				
					var orderID = response.orderID,
					email = response.email,
					total = response.total,
					paypal = response.paypal,
					button = response.button;
	
					// Build the HTML string for the order summary
					// var orderSummaryHTML = `
					// 	<div class="success-img"><img src="img/success-icon.png"></div>
					// 	<p class="succes-line">Your order has been submitted. We will contact you shortly with details.</p>
					// 	<strong id="submit_order_id">Order ID: ${orderID}</strong> <br />
					// 	<strong id="Submit_order_email">Email: ${email}</strong> <br />
					// 	Total Billed: $${total} <br />
					// `;
					var orderSummaryHTML = `
					<div class="success-img">
						<img src="img/success-icon.png" alt="Success Icon">
					</div>
					<strong id="">ORDER #${orderID} HAS BEEN PLACED!</strong><br />
					<p style="font-size: 12px; color: grey;">
						Our team is currently reviewing your order. <br />Your Account Manager will be in touch with you shortly via email or phone. <br />
						You may receive a phone call from us to verify your contact information, so have your phone ready.<br />
						Have any questions during this process? Reach out to our team by emailing 
						<a href="mailto:sales@amanah.com">sales@amanah.com</a>.
					</p>
					`;
					
					// If PayPal is true, append the PayPal button HTML
					if (paypal === true) {
						orderSummaryHTML += `
							<br />
							${button}
						`;
					}
					// Append the "Back" link at the end
					orderSummaryHTML += `
						<a href="https://www.amanah.com/" class="next-btn tab-btn back-btn">Back</a>
					`;
	
					//Hide page loader
					$('#loader').hide();

					$('#go_to_final_submit').click();

					// Append the constructed HTML to the order-summary-box
					$('#final_order_submition').html(orderSummaryHTML);

					
				},
				error: function(xhr, status, error) {
					// Handle any errors that occurred during the AJAX request
					console.log('Error:', error);
					
					//Hide page loader
					$('#loader').hide();
				}
			});
		});

		// $(".paypal-button").click(function(){
		// 	$(".cc_field").removeAttr("required");
		// 	$("#pm").val("pp");
		// 	return true;
		// });
	
		// $(".sub-order-button").click(function(){
		// 	$(".cc_field").attr("required",true);
		// 	$("#pm").val("cc");
		// 	return true;
		// });
	
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
    });