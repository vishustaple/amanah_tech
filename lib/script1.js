$(document).ready(function () {
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;
  var current = 1;
  var steps = $("fieldset").length;

  setProgressBar(current);

  $(".next").click(function () {
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    orderSummeryData(priceObject.quantity);
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          next_fs.css({ opacity: opacity });
        },
        duration: 500,
      }
    );
    setProgressBar(++current);
  });

  $(".previous").click(function () {
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //Remove class active
    $("#progressbar li")
      .eq($("fieldset").index(current_fs))
      .removeClass("active");

    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          previous_fs.css({ opacity: opacity });
        },
        duration: 500,
      }
    );
    setProgressBar(--current);
  });

  function setProgressBar(curStep) {
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar").css("width", percent + "%");
  }

  $(".submit").click(function () {
    return false;
  });
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
  if (isNaN(value)) {
    return "$0.00"; // Return a default value in case of an invalid number
  }

  const formattedValue = value.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  // Add the dollar sign at the start
  return "$" + formattedValue;
}

// Order Total count and price data appendations
function orderSummeryData(value) {
  const textQuantityTotal = "Quantity";
  const setUpcostText = "Setup Cost";
  const OrderTotaltext = "ORDER TOTAL";
  const PackegeCostText = "Package Cost";
  const packegesCost = $(".package-setup-price:first").text();
  const setupcost = $(".package-price:first").text();
  // Get the text content from .total-price and .order-subtotal-price
  const setUpcost = $(".total-price:first").text();
  const totalPriceText = $(".order-subtotal-price:first").text();
  // Clean the strings to remove any non-numeric characters (like '$' or ',')
  const cleanSetUpCost = parseFloat(setUpcost.replace(/[^\d.-]/g, ""));
  const cleanTotalPriceText = parseFloat(
    totalPriceText.replace(/[^\d.-]/g, "")
  );
  const finalPackegesCost = parseFloat(packegesCost.replace(/[^\d.-]/g, ""));
  const finalpackegdataCost = parseFloat(setupcost.replace(/[^\d.-]/g, ""));
  const setupPrice = cleanSetUpCost;
  const orderTotal = cleanTotalPriceText;
  const newOrderCountData = `
			<div class="items_list">
				<div class="items_name">
					<h5>${PackegeCostText}</h5>
				</div>
				<div class="items_config">
					<h5 class="items_config_title "></h5>
					<h5 class="items_config_title" data-OrderCount="">${formatCurrencyCustom(
            finalpackegdataCost
          )} </h5>
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
			
			<div class="items_list" style="background-color: #1b416f;">
				<div class="items_name" style="background-color: #1b416f;">
					<h5 style="color:#fff;">${OrderTotaltext}</h5>
				</div>
				<div class="items_config">
					<h5 class="items_config_title"></h5>
					<h5 class="items_config_title" data-OrderCount="" style="color: white;">
						${formatCurrencyCustom(cleanTotalPriceText)} 
					</h5>
				</div>
			</div>
		`;
  $(".order_summary_data").html(newOrderCountData);
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

function updatePrices() {
  console.log("price", priceObject);
  var subTotal = 0;
  subTotal += parseFloat(priceObject.packRec);

  //Go through each radio, see if its an option, if so add it to the subtotal
  $(".get_all_prd_info").each(function () {
    const selectedOptId = $(this).find(".set_val_selected_prd").attr("id"); // e.g., "Id"
    if (selectedOptId != null) {
      subTotal += parseFloat(priceObject.upgrades[selectedOptId].price);
    }
  });
  $.each(priceObject.upgrades, function (upgradeId, upgrade) {
    var elementOptId = $('[data-optId="' + upgradeId + '"]'),
      elementOptIdLeftBar = $('[data-optIdLeftBar="' + upgradeId + '"]'),
      elementOptIdOrderSummary = $(
        '[data-optIdOrderSummary="' + upgradeId + '"]'
      );

    elementOptId.each(function () {
      // Log each element with the specified data-optId
      $(this).html(
        "$" +
          numeral(upgrade.price).format("0,0.00") +
          '<i class="fa fa-caret-down" aria-hidden="true"></i>'
      );
    });

    elementOptIdLeftBar.each(function () {
      // Log each element with the specified data-optIdLeftBar
      $(this).text("$" + numeral(upgrade.price).format("0,0.00"));
    });

    elementOptIdOrderSummary.each(function () {
      // Log each element with the specified data-optIdOrderSummary
      $(this).html(
        "$" +
          numeral(upgrade.price).format("0,0.00") +
          '<i class="fa fa-caret-down" aria-hidden="true"></i>'
      );
    });

    orderSummeryData(globalQuantity);
  });
  //Overall order prices
  var quantity = parseInt(priceObject.quantity),
    total =
      parseFloat(subTotal) * quantity +
      parseFloat(priceObject.packSetup) * quantity,
    packTotal = parseFloat(priceObject.packRec) * quantity,
    packSetupTotal = parseFloat(priceObject.packSetup),
    orderSetupTotal = packSetupTotal * quantity,
    orderSubtotal = subTotal * quantity;
  $(".subtotal-price").html(subTotal.toString());
  $(".total-price").html(total.toString());
  $(".package-setup-price").html(packSetupTotal.toString());
  $(".order-setup-price").html(orderSetupTotal.toString());
  $(".order-subtotal-price").html(orderSubtotal.toString());
  $(".package-price").html(priceObject.packRec);
  $(".package-total-price").html(packTotal.toString());
  const getPrdText = $(".first_prd_name").text(),
    // Get text content of 'get_price_html' class
    getPriceText = $(".first_prd_price").text(),
    // Get OptId of 'first_prd_price' class
    dataOptId = $(".first_prd_price").data("optId");

  var newPrice = getPriceText.replace("$", ""); // Removes only the first occurrence
  var addedPrice =
    (parseFloat(priceObject.packRec) || 0) + (parseFloat(newPrice) || 0);

  // Handle NaN case
  if (isNaN(addedPrice)) {
    addedPrice = parseFloat(priceObject.packRec) || 0;
  }

  const setTitle = $(".summary-item"),
    titleHtml = `
  <span>${getPrdText}</span>
  <span data-optIdLeftBar="${dataOptId}">
    $${numeral(addedPrice).format("0,0.00")}
  </span>
    `;
  setTitle.empty(); // Clear any existing content
  setTitle.html(titleHtml);

  if (priceObject.coupon) {
    if (priceObject.coupon.coupon.recurring == 1) {
      var subTotalprice = priceObject.subTotal;
      var orderSetupTotalPrice = subTotalprice * quantity;
      var totalPrice =
        parseFloat(subTotalprice) * quantity +
        parseFloat(priceObject.packSetup) * quantity;
      $(".total-price").html(totalPrice.toString());
      $(".order-subtotal-price").html(orderSetupTotalPrice.toString());
    } else {
      var subTotalprice = priceObject.subTotal;
      var totalPrice =
        parseFloat(subTotalprice) * quantity +
        parseFloat(priceObject.packSetup) * quantity;
      $(".total-price").html(totalPrice.toString());
    }
    orderSummeryData(globalQuantity);
  }

  // Object.entries(priceObject.upgrades).forEach(function(data, index) {
  // $("#sumopt"+data[0]).children(":nth-child(4)").html(data[1].price + data[1].setup);
  // $("#sumopt"+data[0]).children(":nth-child(5)").html((data[1].price + data[1].setup) * quantity);
  // });

  //Format all prices
  $(".format-price").each(function () {
    var curVal = $(this).html();
    $(this).html(numeral(curVal).format("$0,0.00")).show();
  });
}

$(document).ready(function () {
  localStorage.removeItem("filePaths");
  const newPackegesPrice = priceObject.packRec;
  // Target the list item with the class 'get_hard'
  $(".get_hard").click(function () {
    // Get data attributes
    const dataId = $(this).data("id"), // Get data-id
      dataName = $(this).data("name"), // Get data-name
      dataValue = $(this).data("value"), // Get data-value
      dataClassId = $(this).data("class_id"), // Get data-class_id
      getPrdHtml = $(this).find(".get_prd_name").html(), // Get HTML content of 'get_prd_name' class
      getPriceHtml = $(this).find(".get_price_html").html(), // Get HTML content of 'get_price_html' class
      targetDiv = $(".items_config.set_hard_" + dataClassId + ""), // Find the target div and set the values
      inputField = targetDiv.find(".set_val_selected_prd"); // Set input field attributes
    targetDiv.addClass("changed_div");
    inputField.attr("name", dataName);
    inputField.attr("id", dataId);
    inputField.val(dataValue);
    // Set the product name HTML
    targetDiv.find(".set_prd_name").html(getPrdHtml);
    targetDiv.find(".set_price_html").html(getPriceHtml); // Set the price HTML
    targetDiv.find(".set_price_html").attr("data-optId", dataValue);
    // const optIds = targetDiv.find('.set_val_selected_prd').val();
    const newPackegesPrice = priceObject.subTotal;
    if (targetDiv.find(".set_prd_name").hasClass("first_prd_name")) {
      // Get text content of 'get_prd_name' class
      const getPrdText = $(".first_prd_name").text(),
        // Get text content of 'get_price_html' class
        getPriceText = $(".first_prd_price").text();
      // Set the set_title span content
      const setTitle = $(".summary-item"),
        titleHtml = `<span>${getPrdText}</span><span  data-optIdLeftBar="${dataId}">${numeral(
          newPackegesPrice
        ).format("0,0.00")}</span>`;

      setTitle.empty(); // Clear any existing content
      setTitle.html(titleHtml);
    }
    // Unset the all summary and modification sections
    $(".all-modifications-section, .first-modifications-section").empty(); // Clear any existing content
    $(".order_summary_title").empty();
    $(".order_summary_title").append(
      '<h5 class="card_title ">Order Summary</h5>'
    );
    // Append heading into the first modification section
    $(".first-modifications-section").append("<h4>Custom Modifications</h4>");
    const setupcost = $(".package-price:first").text();
    $(".get_all_prd_info").each(function (index) {
      // Stop select first product
      const firstPrdName = $(this)
          .find(".set_prd_name")
          .hasClass("first_prd_name"),
        // Get text content of 'get_prd_name' and 'get_price_html'
        getPrdText = $(this).find(".set_prd_name").text(), // e.g., "Memory: 128 GB RAM"
        getPriceText = $(this).find(".set_price_html").text(), // e.g., "$64.00"
        getNameText = $(this)
          .closest(".items_list")
          .find(".items_name h5")
          .text(), // e.g., "Some Product Name"
        optId = $(this).find(".set_val_selected_prd").attr("id"); // e.g., "ID"
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
      // Create the new modification HTML
      const newModification1 = `
					<div class="items_list">
						<div class="items_name">
							<h5>${index === 0 ? "Base Configuration" : getNameText}</h5>
						</div>
						<div class="items_config">
							<h5 class="items_config_title ">${getPrdText}</h5>
							<h5 class="items_config_title"  >${
                index == 0
                  ? numeral(newPackegesPrice).format("$0,0.00")
                  : numeral(getPriceText).format("$0,0.00")
              }
							</h5>
						</div>
					</div>
				`;

      // Append the new Order summary to the Order summary section
      $(".order_summary_title").append(newModification1);
    });
    $(".changed_div").each(function () {
      // Stop select first product
      const firstPrdName = $(this)
          .find(".set_prd_name")
          .hasClass("first_prd_name"),
        // Get text content of 'get_prd_name' and 'get_price_html'
        getPrdText = $(this).find(".set_prd_name").text(), // e.g., "Memory: 128 GB RAM"
        getPriceText = $(this).find(".set_price_html").text(), // e.g., "$64.00"
        getNameText = $(this)
          .closest(".items_list")
          .find(".items_name h5")
          .text(), // e.g., "Some Product Name"
        optId = $(this).find(".set_val_selected_prd").attr("id"); // e.g., "ID"
      if (!firstPrdName) {
        // Create the new modification HTML
        const newModification = `
						<div class="mod-item">
							<span>${getPrdText}</span>
							<span  data-optIdLeftBar="${optId}">${numeral(getPriceText).format(
          "0,0.00"
        )}</span>
						</div>
					`;

        // Append the new modification to the modifications section
        $(".first-modifications-section, .all-modifications-section").append(
          newModification
        );
      }
    });

    // Get the updated quantity and append it to the order summary
    updatePrices();
    orderSummeryData(globalQuantity);
  });
  $(".all-modifications-section, .first-modifications-section").empty(); // Clear any existing content
  $(".order_summary_title").empty();

  $(".order_summary_title").append(
    '<h5 class="card_title ">Order Summary</h5>'
  );
  // Append heading into the first modification section
  $(".first-modifications-section").append("<h4>Custom Modifications</h4>");

  // Get text content of 'get_prd_name' class
  const getPrdText = $(".first_prd_name").text(),
    // Get text content of 'get_price_html' class
    getPriceText = $(".first_prd_price").text(),
    // Get OptId of 'first_prd_price' class
    dataOptId = $(".first_prd_price").data("optId");

  // Set the set_title span content
  const setTitle = $(".summary-item"),
    titleHtml = `<span>${getPrdText}</span><span  data-optIdLeftBar="${dataOptId}">$${numeral(
      newPackegesPrice
    ).format("0,0.00")}</span>`;
  setTitle.empty(); // Clear any existing content
  setTitle.html(titleHtml);

  $(".get_all_prd_info").each(function (index) {
    // Stop select first product
    const firstPrdName = $(this)
        .find(".set_prd_name")
        .hasClass("first_prd_name"),
      // Get text content of 'get_prd_name' and 'get_price_html'
      getPrdText = $(this).find(".set_prd_name").text(), // e.g., "Memory: 128 GB RAM"
      getPriceText = $(this).find(".set_price_html").text(), // e.g., "$64.00"
      getNameText = $(this)
        .closest(".items_list")
        .find(".items_name h5")
        .text(), // e.g., "Some Product Name"
      optId = $(this).find(".set_val_selected_prd").attr("id"); // e.g., "ID"

    if (firstPrdName) {
      //   // Create the new modification HTML
      //   const newModification = `
      //  	<div class="mod-item">
      //  		<span>${getPrdText}</span>
      //  		<span  data-optIdLeftBar="${optId}">${numeral(getPriceText).format(
      //     "0,0.00"
      //   )}</span>
      //  	</div>
      //  `;
      //   // Append the new modification to the modifications section
      //   $(".first-modifications-section, .all-modifications-section").append(
      //     newModification
      //   );
    }

    // Create the new modification HTML

    const newModification1 = `
				<div class="items_list">
					<div class="items_name">
						<h5>${index === 0 ? "Base Configuration" : getNameText}</h5>
					</div>
					<div class="items_config">
						<h5 class="items_config_title ">${getPrdText}</h5>
						<h5 class="items_config_title"  >${
              index == 0
                ? numeral(newPackegesPrice).format("$0,0.00")
                : numeral(getPriceText).format("$0,0.00")
            } </h5>
					</div>
				</div>
			`;
    // Append the new Order summary to the Order summary section
    $(".order_summary_title").append(newModification1);
    updatePrices();
    orderSummeryData(globalQuantity);
  });
  $("#refresh_product_options").click(function () {
    // Remove all 'changed_div' classes
    $("div.changed_div").removeClass("changed_div");
    const newPackegesPrice = priceObject.packRec;
    $(".order_summary_title").empty();
    // Reset all product options
    $(".get_all_prd_info").each(function (index) {
      const targetDiv = $(this);
      const firstOption = targetDiv
        .closest(".items_list")
        .find(".dropdown_data li:first-child");
      const getNameText = $(this)
        .closest(".items_list")
        .find(".items_name h5")
        .text();

      if (firstOption.length > 0) {
        // Extract default values
        const defaultId = firstOption.data("id");
        const defaultName = firstOption.data("name");
        const defaultValue = firstOption.data("value");
        const defaultPrdName = firstOption.find(".get_prd_name").html();
        const defaultPrice = firstOption.find(".get_price_html").html();

        // Clean and format price
        const cleanedPrice = numeral(
          defaultPrice.replace(/[^\d.-]/g, "")
        ).format("$0,0.00");

        // Update input field
        const inputField = targetDiv.find(".set_val_selected_prd");
        inputField.attr("name", defaultName || "");
        inputField.attr("id", defaultId || "");
        inputField.val(defaultValue || "");

        // Update displayed product name and price
        targetDiv.find(".set_prd_name").html(defaultPrdName || "");
        targetDiv.find(".set_price_html").replaceWith(`
						<h5 class="items_config_title new_price_data price_data set_price_html" data-optId="${defaultId}">
							${defaultPrice} <i class="fa fa-caret-down" aria-hidden="true"></i>
						</h5>
					`);

        // Add to Order Summary
        $(".order_summary_title").append(`
						<div class="items_list">
							<div class="items_name">
								<h5>${index === 0 ? "Base Configuration" : getNameText}</h5>
							</div>
							<div class="items_config">
								<h5 class="items_config_title ">${defaultPrdName}</h5>
								<span class="items_config_title" style="font-size:12px">${
                  index === 0
                    ? numeral(newPackegesPrice).format("$0,0.00")
                    : cleanedPrice
                }</span>
							</div>
						</div>
					`);
      } else {
        console.warn("No first option found for resetting fields.");
      }
    });

    // Clear custom modifications
    $(".all-modifications-section, .first-modifications-section").empty();
    $(".first-modifications-section").append("<h4>Custom Modifications</h4>");

    // Reset billing period and quantity
    // $('#billing-period').val('1');
    // $('#quantity_value').val('1');
    // Trigger price updates
    updatePrices();
    orderSummeryData(globalQuantity);
    // ajaxUpdateOrderFunc();
  });

  function SummeryTwo() {
    const newPackegesPrice = priceObject.packRec;
    $(".all-modifications-section, .first-modifications-section").empty(); // Clear any existing content
    $(".order_summary_title").empty();
    $(".order_summary_title").append(
      '<h5 class="card_title ">Order Summary</h5>'
    ); // Append heading into the first modification section
    $(".first-modifications-section").append("<h4>Custom Modifications</h4>");
    const getPrdText = $(".first_prd_name").text(),
      getPriceText = $(".first_prd_price").text(),
      dataOptId = $(".first_prd_price").data("optId");

    // Set the set_title span content
    const setTitle = $(".summary-item"),
      titleHtml = `<span>${getPrdText}</span><span  data-optIdLeftBar="${dataOptId}">$${numeral(
        newPackegesPrice
      ).format("0,0.00")}</span>`;
    setTitle.empty(); // Clear any existing content
    setTitle.html(titleHtml);

    $(".get_all_prd_info").each(function (index) {
      // Stop select first product
      const firstPrdName = $(this)
          .find(".set_prd_name")
          .hasClass("first_prd_name"),
        // Get text content of 'get_prd_name' and 'get_price_html'
        getPrdText = $(this).find(".set_prd_name").text(), // e.g., "Memory: 128 GB RAM"
        getPriceText = $(this).find(".set_price_html").text(), // e.g., "$64.00"
        getNameText = $(this)
          .closest(".items_list")
          .find(".items_name h5")
          .text(), // e.g., "Some Product Name"
        optId = $(this).find(".set_val_selected_prd").attr("id"); // e.g., "ID"
      const newModification1 = `
					<div class="items_list">
						<div class="items_name">
							<h5>${index === 0 ? "Base Configuration" : getNameText}</h5>
						</div>
						<div class="items_config">
							<h5 class="items_config_title ">${getPrdText}</h5>
							<h5 class="items_config_title"  >${
                index == 0
                  ? numeral(newPackegesPrice).format("$0,0.00")
                  : numeral(getPriceText).format("$0,0.00")
              } </h5>
						</div>
					</div>
				`;
      // Append the new Order summary to the Order summary section
      $(".order_summary_title").append(newModification1);
      updatePrices();
      orderSummeryData(globalQuantity);
    });
  }

  // 	// Clear custom modifications and reset order summary
  // 	$('.all-modifications-section, .first-modifications-section').empty();
  // 	// $('.order_summary_title').empty().append('<h5 class="card_title">Order Summary</h5>');
  // 	$('.first-modifications-section').append('<h4>Custom Modifications</h4>');

  // 	// Optionally reset other UI elements
  // 	$('#billing-period').val('1'); // Reset to Monthly (value = 1)
  // 	$('#quantity_value').val('1'); // Reset quantity to 1

  // 	// Trigger price updates and summary updates
  // 	updatePrices();
  // 	orderSummeryData(globalQuantity);

  // 	console.log('Fields have been successfully reset to default values.');
  // });

  // Setting initial value of quantity
  $(".qty_val").text($("#quantity_value").val());
  // Handle increase and decrease button clicks
  $(document).on("click", ".btn-increase", function (event) {
    event.preventDefault();
    let $quantityInput = $("#quantity_value");
    let currentValue = parseInt($quantityInput.val()) || 1;
    $quantityInput.val(currentValue + 1).trigger("input");
    globalQuantity = currentValue + 1;
    // Setting value of quantity for all pages
    // Update .qty_val element with the new quantity
    $(".qty_val").text(globalQuantity);
    orderSummeryData(globalQuantity);
  });

  $(document).on("click", ".btn-decrease", function (event) {
    event.preventDefault();
    let $quantityInput = $("#quantity_value");
    let currentValue = parseInt($quantityInput.val()) || 1;
    if (currentValue > 1) {
      $quantityInput.val(currentValue - 1).trigger("input");
      globalQuantity = currentValue - 1;
      // Setting value of quantity for all pages
      $(".qty_val").text(globalQuantity);
      orderSummeryData(globalQuantity);
    }
  });

  // Setting the billing period initial value for all pages
  $(".prd_val").text($("#billing-period option:selected").text());

  //In case of period
  $(document).on("change", "#billing-period", function () {
    ajaxUpdateOrderFunc();
  });

  //In case of quantity
  $(document).on("input", ".ajaxUpdateOrder", function () {
    ajaxUpdateOrderFunc();
  });

  //In case of coupon
  $(document).on("click", ".ajaxUpdateOrder1", function () {
    ajaxUpdateOrderFunc(this);
  });

  function ajaxUpdateOrderFunc(object = "") {
    //Show page loader
    $("#loader").show();
    var currentPeriod = $("#period-id").val(),
      newPeriod = $("#billing-period").val(), //currentPeriod
      currentQuantity = parseInt(priceObject.quantity),
      newQuantity = $("#quantity_value").val(), // currentQuantity;
      senderEnum = Object.freeze({
        none: 0,
        period: 1,
        quantity: 2,
        coupon: 3,
      }),
      sender = senderEnum.none;

    // Setting the billing period value for all pages
    $(".prd_val").text($("#billing-period option:selected").text());
    $(".perioud_cost").text("");
    $(".perioud_cost").text(
      $("#billing-period option:selected").text() + " Cost"
    );

    //If we are switching periods
    if (!isNaN(newPeriod) && newPeriod != 0) {
      sender = senderEnum.period;
    } else {
      newPeriod = currentPeriod; //Gracefully degrade if we don't want to do anything this request
    }

    //If we are switching quantity
    if (currentQuantity != newQuantity) {
      sender = senderEnum.quantity;
    }

    $("#quantity").val(newQuantity.toString());

    // If we are applying a coupon
    if ($(object).hasClass("coupon-button")) {
      $("#coupon").val($("#summaryCoupon").val());
      sender = senderEnum.coupon;
    }

    //If any of the above modules wants to send
    if (sender != senderEnum.none) {
      $("#period-id").val(newPeriod.toString());
      $.ajax({
        url: "changePeriod.php",
        type: "POST",
        data: $("#orderForms").serialize(),
        dataType: "json",
        cache: false,
        success: function (data) {
          // Hide page loader
          $("#loader").hide();
          console.log(data);

          priceObject = data;
          // if(sender == senderEnum.period){
          // 	// updatePeriod(newPeriod,periodIDs);
          // 	// updateQuantity(priceObject.quantity);

          // } else if(sender == senderEnum.quantity) {
          // 	// updateQuantity(newQuantity);

          // } else
          if (sender == senderEnum.coupon) {
            // $(".coupon-button").removeClass("disp-none");
            // $(".coupon-spinner").addClass("disp-none");

            //See if the coupon worked
            if (priceObject.coupon != null) {
              $(".coupon-msg-code").html(
                priceObject.coupon["coupon"].coupon_code
              );
              $(".coupon-msg-desc").html(
                priceObject.coupon["coupon"].description
              );
              $(".coupon-msg").removeClass("disp-none");
              $(".coupon-error").addClass("disp-none");
            } else {
              $(".coupon-msg").addClass("disp-none");
              $(".coupon-error").removeClass("disp-none");
            }
          }
          if (priceObject.period == newPeriod) {
            SummeryTwo();
          }

          //Update all products price
          updatePrices();

          //Assign the forder
          $("#forder").val(priceObject.forder);
        },
        error: function (request, error) {
          alert("Request: " + JSON.stringify(request));
        },
      });
    }
  }

  updatePrices();

  const canvas = document.getElementById("signaturePad");
  const ctx = canvas.getContext("2d", { willReadFrequently: true });
  const clearButton = document.getElementById("clearButton");
  const saveButton = document.getElementById("saveButton");
  const signatureInput = document.getElementById("signatureInput");

  let isDrawing = false,
    lastX = 0,
    lastY = 0;

  signatureInput.addEventListener("input", () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.font = "24px Arial";
    ctx.fillStyle = "#000";
    ctx.fillText(signatureInput.value, 20, 50);
  });

  function getCoordinates(e) {
    const rect = canvas.getBoundingClientRect();
    let x = 0,
      y = 0;
    if (e.touches) {
      x = e.touches[0].clientX;
      y = e.touches[0].clientY;
    } else {
      x = e.clientX;
      y = e.clientY;
    }
    return { x: x - rect.left, y: y - rect.top };
  }

  function startDrawing(e) {
    isDrawing = true;
    const { x, y } = getCoordinates(e);
    [lastX, lastY] = [x, y];
  }

  function draw(e) {
    if (!isDrawing) return;
    const { x, y } = getCoordinates(e);
    ctx.beginPath();
    ctx.moveTo(lastX, lastY);
    ctx.lineTo(x, y);
    ctx.strokeStyle = "#000";
    ctx.lineWidth = 2;
    ctx.stroke();
    [lastX, lastY] = [x, y];
  }

  function stopDrawing() {
    $("#signature_error").text("");
    isDrawing = false;
    ctx.beginPath();
  }

  function clearCanvas() {
    if (signatureInput.value) {
      signatureInput.value = "";
    }
    ctx.clearRect(0, 0, canvas.width, canvas.height);
  }

  function saveCanvas(event) {
    $("#signature_error").text("");
    $("#loader").show();
    saveButton.disabled = true;

    var isCanvasBlank = !ctx
      .getImageData(0, 0, canvas.width, canvas.height)
      .data.some((channel) => channel !== 0);

    if (isCanvasBlank) {
      $("#loader").hide();
      saveButton.disabled = false;
      $("#signature_error").text(
        "Please provide a signature before proceeding."
      );
      return;
    }

    var clickedButton = event.target,
      dataId = clickedButton.getAttribute("data-id"),
      element = document.getElementById("policy_contant" + dataId);

    if (element.offsetParent === null) {
      $("#loader").hide();
      saveButton.disabled = false;
      alert("Please wait, document is not ready.");
      return;
    }

    alert(dataId);
    const dataURL = canvas.toDataURL("image/png");
    var options = {
      margin: [10, 10, 10, 10],
      filename: "terms-policy" + dataId + ".pdf",
      image: { type: "jpeg", quality: 0.98 },
      html2canvas: { dpi: 192, letterRendering: true },
      jsPDF: { unit: "pt", format: "letter", orientation: "portrait" },
    };

    $(".signature" + dataId).html(
      `<img src="${dataURL}" alt="Signature" style="width: 200px; height: auto;" />`
    );
    // console.log(dataId, "dataId");
    // console.log(element, options, "dkkd");
    html2pdf()
      .from(element)
      .set(options)
      .output("blob")
      .then(function (pdfBlob) {
        if (pdfBlob.size > 10 * 1024 * 1024) {
          // limit 10MB
          $("#loader").hide();
          saveButton.disabled = false;
          alert("PDF is too large. Please reduce signature or content.");
          return;
        }

        var formData = new FormData();
        formData.append("pdf", pdfBlob, "terms-policy.pdf");

        $.ajax({
          url: "createPdf.php",
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            $("#loader").hide();
            saveButton.disabled = false;

            if (typeof response === "string") {
              try {
                response = JSON.parse(response);
              } catch (e) {
                console.error("Failed to parse response:", e);
                return;
              }
            }

            if (response.success) {
              var filePath = response.filePaths;
              let storedFiles =
                JSON.parse(localStorage.getItem("filePaths")) || [];
              storedFiles.push(filePath);
              localStorage.setItem("filePaths", JSON.stringify(storedFiles));

              if (dataId == 1) {
                const newWrapId = parseInt(dataId) + 1;
                $("#policy_contant" + dataId).hide();
                $("#policy_contant" + newWrapId).show();
                $(".pdf_signed_count").text(`${dataId} / 2`);
                $(".pdf_signed_count_two").text(
                  `Signed Documents: ${dataId} / 2`
                );
                $("#saveButton").attr("data-id", newWrapId);
              } else {
                $(".pdf_signed_count").text(`${dataId} / 2`);
                $(".pdf_signed_count_two").text(
                  `Signed Documents: ${dataId} / 2`
                );
                $("#checkout_next").prop("disabled", false);
                $("#saveButton").hide();
              }
              $(".progress_bar").append(
                `<div class="progress${dataId}"></div>`
              );
              clearCanvas();
            } else {
              console.error(response.message);
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            $("#loader").hide();
            saveButton.disabled = false;
            console.error("Upload error: ", textStatus, jqXHR.responseText);
          },
        });
      })
      .catch(function (error) {
        $("#loader").hide();
        saveButton.disabled = false;
        console.error("html2pdf error:", error);
      });
  }

  // Event bindings
  canvas.addEventListener("mousedown", startDrawing);
  canvas.addEventListener("mousemove", draw);
  canvas.addEventListener("mouseup", stopDrawing);
  canvas.addEventListener("mouseout", stopDrawing);

  canvas.addEventListener(
    "touchstart",
    function (e) {
      e.preventDefault();
      startDrawing(e);
    },
    { passive: false }
  );
  canvas.addEventListener("touchmove", draw);
  canvas.addEventListener("touchend", stopDrawing);
  canvas.addEventListener("touchcancel", stopDrawing);

  clearButton.addEventListener("click", clearCanvas);
  saveButton.addEventListener("click", saveCanvas);

  $("#checkout_pre").click(function () {
    $("#click_checkout_pre").click();
    clearCanvas();
  });
  $("#checkout_pre_one").click(function () {
    $("#click_checkout_pre_one").click();
  });

  $("#checkout_next").click(function () {
    $("#loader").show();
    $("#ajax").val("no");
    $.ajax({
      url: "changePeriod.php",
      type: "POST",
      data: $("#orderForms").serialize(),
      dataType: "json",
      cache: false,
      success: function (response) {
        // Hide page loader
        $("#loader").hide();

        // Access the specific data, e.g., forder
        $(".login_forder").val(response.forder);

        // console.log("Order ID: " + orderID);
        $("#click_checkout_next").click();
      },
      error: function (request, error) {
        alert("Request: " + JSON.stringify(request));
      },
    });
  });

  // Define states for each country
  const states = {
    CA: [
      { value: "AB", text: "Alberta" },
      { value: "BC", text: "British Columbia" },
      { value: "MB", text: "Manitoba" },
      { value: "NB", text: "New Brunswick" },
      { value: "NF", text: "Newfoundland" },
      { value: "NT", text: "Northwest Territories" },
      { value: "NS", text: "Nova Scotia" },
      { value: "NU", text: "Nunavut" },
      { value: "ON", text: "Ontario" },
      { value: "PE", text: "Prince Edward Island" },
      { value: "QC", text: "Quebec" },
      { value: "SK", text: "Saskatchewan" },
      { value: "YT", text: "Yukon Territory" },
    ],
    US: [
      { value: "AK", text: "Alaska" },
      { value: "AL", text: "Alabama" },
      { value: "AR", text: "Arkansas" },
      { value: "AZ", text: "Arizona" },
      { value: "CA", text: "California" },
      { value: "CO", text: "Colorado" },
      { value: "CT", text: "Connecticut" },
      { value: "DC", text: "District of Columbia" },
      { value: "DE", text: "Delaware" },
      { value: "FL", text: "Florida" },
      { value: "GA", text: "Georgia" },
      { value: "HI", text: "Hawaii" },
      { value: "IA", text: "Iowa" },
      { value: "ID", text: "Idaho" },
      { value: "IL", text: "Illinois" },
      { value: "IN", text: "Indiana" },
      { value: "KS", text: "Kansas" },
      { value: "KY", text: "Kentucky" },
      { value: "LA", text: "Louisiana" },
      { value: "MA", text: "Massachusetts" },
      { value: "MD", text: "Maryland" },
      { value: "ME", text: "Maine" },
      { value: "MI", text: "Michigan" },
      { value: "MN", text: "Minnesota" },
      { value: "MO", text: "Missouri" },
      { value: "MS", text: "Mississippi" },
      { value: "MT", text: "Montana" },
      { value: "NC", text: "North Carolina" },
      { value: "ND", text: "North Dakota" },
      { value: "NE", text: "Nebraska" },
      { value: "NH", text: "New Hampshire" },
      { value: "NJ", text: "New Jersey" },
      { value: "NM", text: "New Mexico" },
      { value: "NV", text: "Nevada" },
      { value: "NY", text: "New York" },
      { value: "OH", text: "Ohio" },
      { value: "OK", text: "Oklahoma" },
      { value: "OR", text: "Oregon" },
      { value: "PA", text: "Pennsylvania" },
      { value: "PR", text: "Puerto Rico" },
      { value: "RI", text: "Rhode Island" },
      { value: "SC", text: "South Carolina" },
      { value: "SD", text: "South Dakota" },
      { value: "TN", text: "Tennessee" },
      { value: "TX", text: "Texas" },
      { value: "UT", text: "Utah" },
      { value: "VA", text: "Virginia" },
      { value: "VT", text: "Vermont" },
      { value: "WA", text: "Washington" },
      { value: "WI", text: "Wisconsin" },
      { value: "WV", text: "West Virginia" },
      { value: "WY", text: "Wyoming" },
    ],
  };

  // On country change
  $("#regCountry").change(function () {
    const selectedCountry = $(this).val(),
      $stateSelect = $("#regState");

    // Clear previous options
    $stateSelect
      .empty()
      .append('<option value="">Select a State/Province</option>');

    if (selectedCountry && states[selectedCountry]) {
      // Enable and populate the state dropdown
      $stateSelect.prop("disabled", false);

      states[selectedCountry].forEach(function (state) {
        $stateSelect.append(
          `<option value="${state.value}">${state.text}</option>`
        );
      });
    } else {
      // Disable the state dropdown if no country is selected
      $stateSelect.prop("disabled", true);
      // $stateSelect.delete();
      // $('.regStateClass').empty()
    }
  });

  /*Tabs JS*/
  //Form validation
  $("#regPasswordCnf").on("input", function () {
    if ($("#regPasswordCnf").val() != $("#regPassword").val()) {
      $(this)[0].setCustomValidity("Passwords must match.");
    } else {
      // input is valid -- reset the error message
      $(this)[0].setCustomValidity("");
    }
  });

  // Handle form validation on 'Sign In' form
  // Get the form and input elements using jQuery
  const $form1 = $("#loginform"),
    $inputs1 = $form1.find("input, select");

  // Optional: Add validation on input change for instant feedback
  $inputs1.each(function () {
    const $input = $(this);

    // Bind input event to validate the field as the user types
    $input.on("input", function () {
      if ($input[0].checkValidity()) {
        $input.removeClass("is-invalid").addClass("is-valid");
      } else {
        $input.removeClass("is-valid").addClass("is-invalid");
      }
    });
  });

  $("#loginform").submit(function (event) {
    event.preventDefault(); // Prevent form submission to handle validation

    var email,
      method,
      password,
      passwordCnf,
      zip = "",
      city = "",
      state = "",
      phone = "",
      address = "",
      country = "",
      company = "",
      lastName = "",
      firstName = "";

    // Find all input elements within the form
    const form = $(this),
      inputs = form.find("input");

    let isValid = true; // Flag to track if the form is valid

    // Loop through each input element to check its validity
    inputs.each(function () {
      const input = $(this);
      const invalidFeedback = input.siblings(".invalid-feedback");

      if (input[0].checkValidity()) {
        input.removeClass("is-invalid").addClass("is-valid");
        invalidFeedback.hide();
      } else {
        input.removeClass("is-valid").addClass("is-invalid");
        invalidFeedback.show();
        isValid = false; // Set to false if any field is invalid
      }
    });

    if (isValid) {
      // Proceed with form submission or further action (e.g., AJAX request)
      console.log("Form is valid!");

      email = $("#logemail").val();
      passwordCnf = password = $("#logpassword").val();
      method = "login";

      //Show page loader
      $("#loader").show();
      $.ajax({
        url: "login.php",
        type: "POST",
        data: {
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
          forder: $(".login_forder").val(),
        },
        dataType: "json",
        cache: false,
        success: function (data) {
          $("#invalidInputErr").addClass("disp-none");
          $("#takenEmailError,#regOtherError").addClass("disp-none");
          $("#authError").addClass("disp-none");

          if (data.error == "none") {
            $.ajax({
              url: "checkout.php",
              type: "GET",
              data: { forder: $(".login_forder").val() },
              dataType: "json",
              cache: false,
              success: function (checkoutResponse) {
                $("#loader").hide();
                $("#chforder").val(checkoutResponse.forder);
                $("#fname").val(checkoutResponse.fname);
                $("#lname").val(checkoutResponse.lname);
                $("#chemail").val(checkoutResponse.email);
                $("#chphone").val(checkoutResponse.phone);
                $("#chaddress").val(checkoutResponse.address);
                $("#chcity").val(checkoutResponse.city);
                $("#chzip").val(checkoutResponse.postal);
                $("#chstate").val(checkoutResponse.state); // If 'state' is a predefined list of options, make sure the correct option has the same value as the state
                $("#chcountry").val(checkoutResponse.country);
                $("#chcompany").val(checkoutResponse.company); // If there's no company, it will remain empty
                $("#go_to_checkout").click();
              },
              error: function (request, error) {
                $("#loader").hide();
                alert("Request: " + JSON.stringify(request));
              },
            });
            // window.location.replace("checkout.php?forder=<?= $this->forder ?>");
          } else if (method == "register" && data.error == "validation") {
            $("#loader").hide();
            $("#regValidError").removeClass("disp-none");
          } else if (method == "register" && data.error == "taken") {
            $("#loader").hide();
            $("#regTakenError").removeClass("disp-none");
          } else if (data.error == "auth") {
            $("#loader").hide();
            $("#loginAuthError").removeClass("disp-none");
          } else {
            // $("#regOtherError").removeClass("disp-none");
            // $("#regOtherError").html(data.error)
          }
        },
        error: function (request, error) {
          $("#loader").hide();
          alert("Request: " + JSON.stringify(request));
        },
      });
      return false;
    }
  });

  // Handle form validation on 'Forgot Password' form
  // Get the form and input elements using jQuery
  const $form11 = $("#forgotpassword"),
    $inputs11 = $form11.find("input, select");

  // Optional: Add validation on input change for instant feedback
  $inputs11.each(function () {
    const $input = $(this);

    // Bind input event to validate the field as the user types
    $input.on("input", function () {
      if ($input[0].checkValidity()) {
        $input.removeClass("is-invalid").addClass("is-valid");
      } else {
        $input.removeClass("is-valid").addClass("is-invalid");
      }
    });
  });

  $("#forgotpassword").submit(function (event) {
    event.preventDefault(); // Prevent form submission to handle validation

    const form = $(this),
      emailInput = form.find("input"), // Get the email input
      invalidFeedback = emailInput.siblings(".invalid-feedback");

    if (emailInput[0].checkValidity()) {
      emailInput.removeClass("is-invalid").addClass("is-valid");
      invalidFeedback.hide();
      console.log("Form is valid!");
      var nonEmptyEmail = "";
      $("input[name='forgot-email']").each(function () {
        if ($(this).val() != "") {
          nonEmptyEmail = $(this).val();
        }
      });

      $.ajax({
        url: "forgotPass.php",
        type: "POST",
        data: { email: nonEmptyEmail },
        dataType: "json",
        cache: false,
        success: function (data) {
          $(".send-forgot-success").css("display", "block");
        },
        error: function (request, error) {
          alert("Request: " + JSON.stringify(request));
        },
      });
    } else {
      emailInput.removeClass("is-valid").addClass("is-invalid");
      invalidFeedback.show();
    }
  });

  // Handle form validation on 'Create Account' form (Sign-up)
  // Get the form and input elements using jQuery
  const $form = $("#regForm");
  const $inputs = $form.find("input, select");

  // Optional: Add validation on input change for instant feedback
  $inputs.each(function () {
    const $input = $(this);

    // Bind input event to validate the field as the user types
    $input.on("input", function () {
      if ($input[0].checkValidity()) {
        $input.removeClass("is-invalid").addClass("is-valid");
      } else {
        $input.removeClass("is-valid").addClass("is-invalid");
      }
    });
  });

  $("#regForm").submit(function (event) {
    event.preventDefault(); // Prevent form submission to handle validation
    var email,
      method,
      password,
      passwordCnf,
      zip = "",
      city = "",
      state = "",
      phone = "",
      address = "",
      country = "",
      company = "",
      lastName = "",
      firstName = "";

    const form = $(this);
    const inputs = form.find("input"); // Get all inputs in the form

    let isValid = true; // Flag to track if the form is valid

    // Loop through each input element to check its validity
    inputs.each(function () {
      const input = $(this);
      const invalidFeedback = input.siblings(".invalid-feedback");

      if (input[0].checkValidity()) {
        input.removeClass("is-invalid").addClass("is-valid");
        invalidFeedback.hide();
      } else {
        input.removeClass("is-valid").addClass("is-invalid");
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
      method = "register";

      //Show page loader
      $("#loader").show();
      $.ajax({
        url: "login.php",
        type: "POST",
        data: {
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
          forder: $(".login_forder").val(),
        },
        dataType: "json",
        cache: false,
        success: function (data) {
          $("#invalidInputErr").addClass("disp-none");
          $("#takenEmailError,#regOtherError").addClass("disp-none");
          $("#authError").addClass("disp-none");

          if (data.error == "none") {
            $.ajax({
              url: "checkout.php",
              type: "GET",
              data: { forder: $(".login_forder").val() },
              dataType: "json",
              cache: false,
              success: function (checkoutResponse) {
                $("#loader").hide();
                // Set values using jQuery
                $("#chforder").val(checkoutResponse.forder);
                $("#fname").val(checkoutResponse.fname);
                $("#lname").val(checkoutResponse.lname);
                $("#chemail").val(checkoutResponse.email);
                $("#chphone").val(checkoutResponse.phone);
                $("#chaddress").val(checkoutResponse.address);
                $("#chcity").val(checkoutResponse.city);
                $("#chzip").val(checkoutResponse.postal);
                $("#chstate").val(checkoutResponse.state); // If 'state' is a predefined list of options, make sure the correct option has the same value as the state
                $("#chcountry").val(checkoutResponse.country);
                $("#chcompany").val(checkoutResponse.company); // If there's no company, it will remain empty
                $("#go_to_checkout").click();
              },
              error: function (request, error) {
                $("#loader").hide();
                alert("Request: " + JSON.stringify(request));
              },
            });

            // window.location.replace("checkout.php?forder=<?= $this->forder ?>");
          } else if (method == "register" && data.error == "validation") {
            $("#loader").hide();
            $("#regValidError").removeClass("disp-none");
          } else if (method == "register" && data.error == "taken") {
            $("#loader").hide();
            $("#regTakenError").removeClass("disp-none");
          } else if (method == "register" && data.error == "multi") {
            $("#loader").hide();
            $("#multiAcctError").removeClass("disp-none");
          } else {
            $("#regOtherError").removeClass("disp-none");
            $("#regOtherError").html(data.error);
          }
        },
        error: function (request, error) {
          $("#loader").hide();
          alert("Request: " + JSON.stringify(request));
        },
      });
      return false;
    }
  });
  //  refresh

  $(".submitButton").on("click", function (e) {
    e.preventDefault(); // Prevent form from submitting normally

    let filePaths = JSON.parse(localStorage.getItem("filePaths")) || [];

    const paypalRestrictionChecking = $(this).attr("id");

    if (paypalRestrictionChecking !== "pp-submit") {
      // Validate card number before proceeding
      const cardNumberValid = validateCardNumber($("#ccNum")[0]);
      const cvvValid = validateCVV($("#cccvv2")[0]);
      const monthValid = validateMonth($("#ccm")[0]);
      const yearValid = validateYear($("#ccy")[0]);
      // Check if any validation failed for card payment
      if (!cardNumberValid || !cvvValid || !monthValid || !yearValid) {
        e.preventDefault(); // Prevent form submission if validation fails
        return;
      }
    } else {
      $("#expiryMonth").hide();
      $("#ccNumError").hide();
      $("#expiryYear").hide();
      $("#cvvError").hide();
    }

    var termConditionChecked = $("#term_condition").is(":checked");
    if (!termConditionChecked) {
      $("#term_condition_error")
        .text("You must agree to the terms and conditions.")
        .show();
      e.preventDefault(); // Prevent form submission if checkbox is not checked
      return;
    } else {
      $("#term_condition_error").hide(); // Hide error message if checked
    }
    if ($(this).attr("id") == "pp-submit") {
      $(".cc_field").removeAttr("required");
      var pm = "pp";
    } else if ($(this).attr("id") == "sub-order-button") {
      $(".cc_field").attr("required", true);
      var pm = "cc";
    } else {
    }
    // Collect all form data into an object
    var formData = {
      s: 1,
      pm: pm,
      forder: $("#chforder").val(),
      fname: $("#fname").val(),
      lname: $("#lname").val(),
      email: $("#chemail").val(),
      phone: $("#chphone").val(),
      address: $("#chaddress").val(),
      city: $("#chcity").val(),
      zip: $("#chzip").val(),
      state: $("#chstate").val(),
      country: $("#chcountry").val(),
      company: $("#chcompany").val(),
      ccNum: $("#ccNum").val(),
      ccm: $("#ccm").val(),
      ccy: $("#ccy").val(),
      cccvv2: $("#cccvv2").val(),
      term_policy: filePaths,
      // total: response.total // If the total is part of the data from the response
    };
    //Show page loader
    $("#loader").show();
    // Perform the AJAX POST request
    $.ajax({
      url: "checkout.php", // Your server-side script
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        console.log(response);
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
          // orderSummaryHTML += `

          // 	<br />
          // 	${button}
          // `;
          let customDetails = JSON.stringify({
            orderID: orderID,
            email: email,
          });

          orderSummaryHTML = `
						 <div style="border: 1px solid #ccc; padding: 20px; max-width: 400px; margin: 0 auto; text-align: center;">
							<h1 style="font-size: 18px; margin-bottom: 20px;">Your order has been submitted. We will contact you shortly with details.</h1>
							<div style="text-align: left; margin-bottom: 20px;">
								<strong style="display: block; margin-bottom: 5px;">Order ID: #${orderID}</strong>
								<strong style="display: block; margin-bottom: 5px;">Email: ${email}</strong>
								<strong style="display: block; margin-bottom: 5px;">Total Billed: ${total}</strong>
							</div>
							<a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_xclick&business=sb-b0u43v14671303@business.example.com&amount=${total}&currency_code=USD&return=http://50.18.25.49/html/addplan.php&cancel_return=http://50.18.25.49/html/addplan.php&custom=${orderID}&email=${email}" style="display: inline-block; background-color: #ffc439; color: #000; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold; height: 50px; line-height: 30px;">
							Check out with <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_74x46.jpg" alt="PayPal" style="vertical-align: middle; margin-left: 10px; height: 30px;">
						</a>
						</div>
							<br />
							
						`;
        }
        // Append the "Back" link at the end
        orderSummaryHTML += `
						<a href="https://www.amanah.com/" class="next-btn tab-btn back-btn">Back</a>
					`;

        //Hide page loader
        $("#loader").hide();

        $("#go_to_final_submit").click();

        // Append the constructed HTML to the order-summary-box
        $("#final_order_submition").html(orderSummaryHTML);
        // remove file from local storage
        localStorage.removeItem("filePaths");
      },
      error: function (xhr, status, error) {
        // Handle any errors that occurred during the AJAX request
        console.log("Error:", error);

        //Hide page loader
        $("#loader").hide();
      },
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

  $(".payswitch").click(function () {
    $("#expiryMonth").hide();
    $("#ccNumError").hide();
    $("#expiryYear").hide();
    $("#cvvError").hide();
    if (!$(this).hasClass("pay-icon-selected")) {
      $("#pplink").toggleClass("pay-icon-selected");
      $("#cclink").toggleClass("pay-icon-selected");
      $(".ccspan").toggleClass("disp-none");
      $(".ppspan").toggleClass("disp-none");
      $("#pp-submit").toggleClass("disp-none");
      $("#sub-order-button").toggleClass("disp-none");
      $(".payswitch").each(function () {
        if ($(this).hasClass("pay-icon-selected")) {
          $(this).css("background-color", "#ba9559"); // Example color for selected
        } else {
          $(this).css("background-color", ""); // Reset to default
        }
      });
    }
  });
});

function validateCardNumber(input) {
  const value = input.value.trim(); // Get the input value
  const errorElement = document.getElementById("ccNumError"); // Error message element
  // Regular expression for validating card number (13-19 digits)
  const cardNumberRegex = /^\d{13,19}$/;

  // Check if the input is empty
  if (value === "") {
    errorElement.textContent = "Card number is required."; // Show required error message
    errorElement.style.display = "block"; // Show error message
    return false;
  }
  // Validate card number format
  if (!cardNumberRegex.test(value)) {
    errorElement.textContent = "Enter a valid card number (13-19 digits).";
    errorElement.style.display = "block"; // Show error message

    return false;
  } else {
    errorElement.textContent = ""; // Clear error message
    errorElement.style.display = "none"; // Hide error message

    // You can add card type detection logic here
    return true;
  }
}

// validation of expiry Month of card
function validateMonth() {
  const monthValue = document.getElementById("ccm").value.trim();
  const errorElement = document.getElementById("expiryMonth");

  // Check if month field is empty
  if (monthValue === "") {
    errorElement.textContent = "Month is required."; // Show required error message
    errorElement.style.display = "block"; // Show error message
    return false;
  }

  // Validate month (MM)
  if (!/^(0[1-9]|1[0-2])$/.test(monthValue)) {
    errorElement.textContent = "Enter a valid month (01-12).";
    errorElement.style.display = "block"; // Show error message
    return false;
  } else {
    errorElement.textContent = ""; // Clear error message
    errorElement.style.display = "none"; // Hide error message
    return true;
  }
}
// validation of expiry Years of card

function validateYear() {
  const yearValue = document.getElementById("ccy").value.trim();
  const errorElement = document.getElementById("expiryYear");
  const currentYear = new Date().getFullYear(); // Get the current year
  const currentMonth = new Date().getMonth() + 1; // Get the current month (1-based)

  // Check if year field is empty
  if (yearValue === "") {
    errorElement.textContent = "Year is required."; // Show required error message
    errorElement.style.display = "block"; // Show error message
    return false;
  }

  // Validate year (YY)
  if (!/^\d{2}$/.test(yearValue)) {
    errorElement.textContent = "Enter a valid year (2 digits).";
    errorElement.style.display = "block"; // Show error message
    return false;
  }

  // Check if expiry year is greater than or equal to the current year
  const expiryYear = parseInt("20" + yearValue); // Convert YY to full year (e.g., 22 -> 2022)
  if (
    expiryYear < currentYear ||
    (expiryYear === currentYear &&
      parseInt(document.getElementById("ccm").value.trim()) < currentMonth)
  ) {
    errorElement.textContent = "Your card has expired or the date is invalid.";
    errorElement.style.display = "block"; // Show error message
    return false;
  } else {
    errorElement.textContent = ""; // Clear error message
    errorElement.style.display = "none"; // Hide error message
    return true;
  }
}

// validation of CVV of card

function validateCVV(input) {
  const cvvValue = input.value.trim(); // Get the value from the input field
  const errorElement = document.getElementById("cvvError"); // Error message element

  // Regular expression for validating CVV (3 or 4 digits)
  const cvvRegex = /^\d{3,4}$/;

  // Check if the CVV value is empty
  if (cvvValue === "") {
    errorElement.textContent = "CVV is required."; // Show required error message
    errorElement.style.display = "block"; // Show error message
    return false;
  }

  // Validate CVV format (3 or 4 digits)
  if (!cvvRegex.test(cvvValue)) {
    errorElement.textContent = "Enter a valid CVV (3 or 4 digits)."; // Error message if invalid
    errorElement.style.display = "block"; // Show error message
    return false;
  } else {
    errorElement.textContent = ""; // Clear the error message if valid
    errorElement.style.display = "none"; // Hide error message
    return true;
  }
}
