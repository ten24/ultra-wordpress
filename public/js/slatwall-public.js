// (function( $ ) {
// 	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

// })( jQuery );
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
var site_url = localStorage.getItem("SITEURL");
var PRODUCT_SINGLE_SLUG = localStorage.getItem("PRODUCT_SINGLE_SLUG");
var DOMAIN = localStorage.getItem("DOMAIN");
var CART = localStorage.getItem("CART");
var ajax_url = site_url + '/wp-admin/admin-ajax.php';

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    }
    return result;
}

jQuery(document).ready(function() {
   jQuery('.specific-products').parents('.post-inner').css('padding','0');
    

	jQuery(".show-more").click(function(){
		 jQuery(this).toggleClass("Show");
		 jQuery(this).siblings(".inner").toggleClass("more");
 });
});


function header_append_data(){
    var data = {
        'action' : 'header_append_data'
    };

    jQuery.post(ajax_url, data, function( result ) {
      jQuery('nav').parent().append(result);


    } );
    
}


function update_cart_items(orderItems){
        jQuery('.card-body.cart-items').html('');
        orderItems.forEach(function(item) {
            var site_url = site_url;
            var product_single_slug = PRODUCT_SINGLE_SLUG;
            var domain = DOMAIN;
             var product_single_url = site_url + '/'.product_single_slug + '/' + item.sku.product.urlTitle;
             if(typeof(item.sku.imagePath) != "undefined" && item.sku.imagePath !== null ){
                 var image_url = domain + '/' +item.sku.imagePath;
            } else {
                var image_url = 'http://placehold.it/100x100';
            }
             
            jQuery('.card-body.cart-items').append('<div class="row border-bottom mb-5 pb-5 cart-row" data-skuid="'+ item.sku.skuID + '" data-orderItemID="'+ item.orderItemID +'"><div class="col-sm-2 col-3"><a href="'+ product_single_url +'"><img class="img-fluid rounded-sm" src="'+image_url+'"></a></div><div class="col-sm-4 col-9"><a href="'+product_single_url+'"><h5 style="color:#000;">'+ item.sku.product.productName +'</h5></a><small class="text-muted">'+item.sku.skuDefinition+'</small></div><div class="col-sm-12 col-md-6 d-none d-sm-block"><div class="row"><div class="col-sm-4"><h6><span class="text-muted">$</span>'+ item.extendedUnitPrice.toFixed(2) +'</h6></div><div class="col-sm-3 item-quantity"><input type="number" class="form-control form-control-sm text-center" min="1" value="'+ item.quantity +'"><button class="btn btn-secondary btn-sm cart-update"><small>Update</small></button></div><div class="col-sm-4"><h6><span class="text-muted">$</span><strong>'+ item.extendedPrice.toFixed(2) +' </strong></h6></div><div class="col-sm-1 p-0"><span class="btn badge badge-danger item-remove">×</span></div></div></div></div>');
                               
                                    });
                                    
    }
    
    function update_cart_payment(cart_data){
       
        jQuery('.order-summary').html('<li class="list-group-item m-0">Item Total <span class="float-right"><strong>$'+cart_data.cart.subtotal+'</strong></span></li><li class="list-group-item m-0">Shipping & Delivery <span class="float-right"><strong>$'+cart_data.cart.fulfillmentTotal+'</strong></span></li><li class="list-group-item m-0">Tax <span class="float-right"><strong>$'+cart_data.cart.taxTotal+'</strong></span></li>');
        if(cart_data.cart.orderAndItemDiscountAmountTotal > 0){
         jQuery('.order-summary').append('<li class="list-group-item m-0">Discount <span class="float-right"><span class="badge badge-success">- $'+ cart_data.cart.orderAndItemDiscountAmountTotal+'</span></li>');
        }
        jQuery('.order-summary').append('<li class="list-group-item m-0">Total <span class="float-right"><strong>$'+ cart_data.cart.total +'</strong></span></li>');
    }

//header_append_data();
function update_mini_cart(cart_data){
    var orderItems = cart_data.orderItems;
    var html_data = '<a href="#" class="btn btn-link text-body font-weight-bold" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cart <i class="fa fa-angle-down"></i></a>';
    html_data += '<a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="badge badge-pill badge-secondary">' +cart_data.orderItems.length+ '</span></a>';
    html_data += '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">';
            if(cart_data.orderID){
    html_data += '<ul class="list-unstyled p-3">';
                                   orderItems.forEach(function(item) {
                    html_data += '<li class="media mb-3">';
                                   if(item.sku.imagePath){
                        html_data += '<img class="align-self-start img-fluid mr-2" src="' + DOMAIN + '/' +item.sku.imagePath + '">';
                                    } else {
                        html_data += '<img class="align-self-start img-fluid mr-2" src="https://via.placeholder.com/45x45">';
                                     }
                        html_data += '<div class="media-body">';
                        html_data += '<a class="text-body font-weight-bold small" href="' + PRODUCT_SINGLE_SLUG + '/' + item.sku.product.urlTitle + '">' + item.sku.product.productName + '</a>';
                        html_data += '<a href="javascript:void(0);" data-orderItemID="'+item.orderItemID+'" class="float-right text-secondary mini-remove-item"><i class="fa fa-times-circle"></i></a>';
                        html_data += '<br>';
                        html_data += '<span class="text-muted small">$'+item.extendedUnitPrice+'</span>';
                        html_data += '<small>Qty: ' + item.quantity + '</small>';
                        html_data += '</div>';
                        html_data += '</li>';
                                 });
                        html_data += '</ul>';
                           } else {
                        html_data += '<div class="alert alert-secondary m-2 small">There are no items in your cart.</div>';
                             }

                        html_data += '<div class="alert alert-info m-2 small cart-item-removed" style="display:none;">Item removed from your cart.</div>';
                        html_data += '<a href="'+ site_url + '/' + CART + '" class="btn btn-link btn-block text-center mini-cart-view"><small>View Shopping Cart</small></a>';
                        html_data += '</div>';
                        jQuery('#mini-cart').html(html_data);
}
function remove_mini_cart_item(id){
         var data = {
        'action' : 'remove_cart_item',
        'id': id
    };

    jQuery.post(ajax_url, data, function( result ) {
        var response = jQuery.parseJSON(result);
            if(result){
              if(response.successfulActions && response.successfulActions.includes("public:cart.removeOrderItem")){
           update_mini_cart(response.cart);
            update_cart_items(response.cart.orderItems);
               update_cart_payment(response);
           jQuery('.cart-item-removed').show();
                }
            }


    } );

    }
    jQuery(document).on('click','.mini-remove-item',function(){
       var item_id = jQuery(this).attr('data-orderItemID');
       remove_mini_cart_item(item_id);
    });
    
    function reopen_cart(orderID){
         var data = {
        'action' : 'reopen_cart',
        'orderID': orderID
    };

    jQuery.post(ajax_url, data, function( result ) {
        var response = jQuery.parseJSON(result);
            if(result){
              if(response.successfulActions && response.successfulActions.includes("public:cart.change")){
           window.location = site_url + '/' + CART;
                }
            }


    } );

    }
    
    jQuery(document).on('click','.cart_reopen',function(){
       var orderID = jQuery(this).attr('id');
      
       reopen_cart(orderID);
    });


		// Product detail gallery slider -nitish
		// JavaScript Document
		function isDevice() {
		    return ((/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase())))
		}

		function initZoom(width, height) {
		    jQuery.removeData('#zoom_10', 'elevateZoom');
		    jQuery('.zoomContainer').remove();
		    jQuery('.zoomWindowContainer').remove();
		    jQuery("#zoom_10").elevateZoom({
		        responsive: true,
		        tint: true,
		        tintColour: '#E84C3C',
		        tintOpacity: 0.5,
		        easing: true,
		        borderSize: 0,
		        lensSize: 100,
		        constrainType: "height",
		        loadingIcon: site_url + "/wp-content/plugins/slatwall/public/images/Rolling-1.gif",
		        containLensZoom: false,
		        zoomWindowPosition: 1,
		        zoomWindowOffetx: 20,
		        zoomWindowWidth: width,
		        zoomWindowHeight: height,
		        gallery: 'gallery_pdp',
		        galleryActiveClass: "active",
		        zoomWindowFadeIn: 500,
		        zoomWindowFadeOut: 500,
		        lensFadeIn: 500,
		        lensFadeOut: 500,
		        cursor: "https://icodefy.com/Tools/iZoom/images/zoom-out.png",
		    });
		}

		jQuery(document).ready(function() {
		    /* init vertical carousel if thumb image length greater that 4 */
		    if (jQuery("#gallery_pdp a").length > 4) {
		        jQuery("#gallery_pdp a").css("margin", "0");
		        jQuery("#gallery_pdp").rcarousel({
		            orientation: "horizontal",
		            // orientation: "vertical",
		            visible: 5,
		            width: 105,
		            height: 70,
		            margin: 0,
		            step: 1,
		            speed: 500,
		        });
		        jQuery("#ui-carousel-prev").show();
		        jQuery("#ui-carousel-next").show();
		    }
		    /* Init Product zoom */
		    initZoom(500, 475);

		    jQuery("#ui-carousel-prev").click(function() {
		        initZoom(500, 475);
		    });

		    jQuery("#ui-carousel-next").click(function() {
		        initZoom(500, 475);
		    });


		    // $(".zoomContainer").width($("#zoom_10").width());

		    // $("body").delegate(".fancybox-inner .mega_enl", "click", function() {
		    //     $(this).html("");
		    //     $(this).hide();
		    // });
					// $('#gallery_pdp img').click((e) => {
					// 	console.log(e)
					// })

		});

		jQuery(window).resize(function() {
		    var docWidth = jQuery(document).width();
		    if (docWidth > 769) {
		        initZoom(500, 475);
		    } else {
		        jQuery.removeData('#zoom_10', 'elevateZoom');
		        jQuery('.zoomContainer').remove();
		        jQuery('.zoomWindowContainer').remove();
		        jQuery("#zoom_10").elevateZoom({
		            responsive: true,
		            tint: false,
		            tintColour: '#3c3c3c',
		            tintOpacity: 0.5,
		            easing: true,
		            borderSize: 0,
		            loadingIcon: site_url + "/wp-content/plugins/slatwall/public/images/Rolling-1.gif",
		            zoomWindowPosition: "productInfoContainer",
		            zoomWindowWidth: 330,
		            gallery: 'gallery_pdp',
		            galleryActiveClass: "active",
		            zoomWindowFadeIn: 500,
		            zoomWindowFadeOut: 500,
		            lensFadeIn: 500,
		            lensFadeOut: 500,
		            cursor: "https://icodefy.com/Tools/iZoom/images/zoom-out.png",
		        });

		    }
		});

		   function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
    jQuery(document).ajaxStart(function() {
  jQuery("#qloader").show();
}).ajaxStop(function() {
  jQuery("#qloader").hide('slow');
});
function add_to_cart(sku_id,qty){
         var data = {
        'action' : 'add_to_cart',
        'id': sku_id,
        'qty' : qty
    };
    jQuery.post(ajax_url, data, function( result ) {
      //  var response = jQuery.parseJSON(result);
            if(result){
                if(IsJsonString(result)){
            var result_json = JSON.parse(result);
            if(result_json.successfulActions && result_json.successfulActions[0] === 'public:cart.addOrderItem'){
                  jQuery('.added-cart').show();
                  update_mini_cart(result_json.cart);
            }  else {
               jQuery('.failed-add-cart').show();
            }
                } else {
                    jQuery('.failed-add-cart').show(); 
                }
            }


    } );

    }
    

    jQuery(document).on('submit','.listing-add-to-cart',function(e){
    e.preventDefault();
    var form_data = jQuery(this).serializeArray();
    sku_id = form_data[0].value;
    add_to_cart(sku_id,1);
    return false;
    });
    function check_variation_selection(){
        var variation_flag = 0;
        console.log(1);
        jQuery('.select-variation').parents('.col-md-8').each(function(){
            console.log(jQuery(this).find('select').children("option:selected").val() != '');
            console.log(jQuery(this).find('select').children("option:selected").text());
     if(jQuery(this).find('select').children("option:selected").val() != ''){
        variation_flag = 1;
     } else {
          variation_flag = 0;
          return variation_flag;
     }  
     
    });
    return variation_flag;
    }
    jQuery(document).on('change','.select-variation',function(){
        
        if(jQuery(this).val() != ''){
        jQuery(this).parents('.col-md-8').next().find('select').prop("disabled", false);
    } else {
        jQuery(this).parents('.col-md-8').next().find('select').prop("disabled", true);
    }
     var variation_flag = 0;
       
        jQuery('.select-variation').parents('.col-md-8').each(function(){
            console.log(jQuery(this).find('select').children("option:selected").val() != '');
            console.log(jQuery(this).find('select').children("option:selected").text());
     if(jQuery(this).find('select').children("option:selected").val() != ''){
        variation_flag = 1;
     } else {
          variation_flag = 0;
          return false;
     }  
    });
     console.log(variation_flag);
    if(variation_flag == 1){
        jQuery('.sku-quantity').html('<input type="number" class="form-control" name="quantity" id="quantity" aria-describedby="quantity" value="1" min="0" required>');
    } else {
        jQuery('.sku-quantity').html('<small>Out of Stock</small>');
    }
    });

    function filter_ajax(form_data,id = 1,sorting = '',specific_products = ''){
         var data = {
        'action' : 'product_filter_data',
        'form_data': form_data,
        'sorting': sorting,
        'specific_products' : specific_products,
        'id': id
    };

    jQuery.post(ajax_url, data, function( result ) {
      //  var response = jQuery.parseJSON(result);
            if(result){
                jQuery('.applied_filters').html('');
                var applied_filt = '';
                var applied_filter_count = 0;
                jQuery('#sidebar_form input[type=checkbox]:checked').each(function(){
                    if(jQuery(this).hasClass('hide_applied_filter') == false){
                    var id = jQuery(this).val();
                     var text = jQuery(this).parent().find('label').text();
                     applied_filt += '<a href="javacript:void(0);" id="'+ id +'" class="badge badge-secondary d-inline-block mr-2">'+ text +' &times;</a>';
                applied_filter_count++; 
                    }
                });

                    setTimeout(function(){

                         var records_count = jQuery('#records_count').attr('data-records');
                    var product_text = records_count<2?'Product':'Products';
                    if(typeof records_count !== "undefined"){
                        jQuery('.available_product').html('<strong>'+ records_count +'</strong> Available '+product_text+'');
                    } else {
                      jQuery('.available_product').html('<strong>0</strong> Available Product');
                    }
                    },10);


                if(applied_filter_count > 0){

               jQuery('.applied_filters').append(applied_filt);
           }
                jQuery('.product-listing-area').html(result);
            }


    } );

    }

    jQuery(document).ready(function(){
        jQuery(document).on( 'click','.pagination li a', function(event) {

            var sorting = jQuery('.sorting a.active').attr('data-value');
            var id = jQuery(this).attr('id');
            var form_data = jQuery("#sidebar_form").serializeArray();
            // set ajax data
            var specific_products = jQuery('#specific_products').attr('data-products');
         if(typeof specific_products !== 'undefined'){
             filter_ajax(form_data,id,sorting,specific_products);
         } else {
             filter_ajax(form_data,id,sorting);
         }
      
        return false;
        } );

         jQuery(document).on( 'click','#sidebar_form .form-check input[type="checkbox"],#search,#range', function() {
             if(jQuery(this).attr('id') === 'search' && jQuery('#search_value').val() === ''){
                 jQuery('#search_value').addClass('is-invalid');
                 return false;
             } else {
                 jQuery('#search_value').removeClass('is-invalid');
             }
             if(jQuery(this).attr('id') === 'range' && !jQuery('input[name="fix_range"]').is(":checked") && jQuery('#min').val() === '' && jQuery('#max').val() === ''){
                 jQuery('input[name="fix_range"]').addClass('is-invalid');
                 jQuery('#min').addClass('is-invalid');
                 jQuery('#max').addClass('is-invalid');
                 jQuery('.price-range-error').show();
                 return false;
             } else {
                 jQuery('input[name="fix_range"]').removeClass('is-invalid');
                 jQuery('#min').removeClass('is-invalid');
                 jQuery('#max').removeClass('is-invalid');
                  jQuery('.price-range-error').hide();
             }
                if(jQuery('#min').val() !== '' || jQuery('#max').val() !== ''){
                    jQuery('input[name="fix_range"]').attr("checked", false);
                }

                var sorting = jQuery('.sorting a.active').attr('data-value');
            var form_data = jQuery("#sidebar_form").serializeArray();
            // set ajax data
           filter_ajax(form_data,1,sorting);

        } );

         jQuery(document).on( 'click','#clear_price', function() {
                jQuery('#min').val('');
                jQuery('#max').val('');
                jQuery('input[name="fix_range"]').attr("checked", false);
                var sorting = jQuery('.sorting a.active').attr('data-value');
            var form_data = jQuery("#sidebar_form").serializeArray();
            // set ajax data
           filter_ajax(form_data,1,sorting);

        } );

       jQuery(document).on( 'click','.sorting a', function() {
       jQuery('.sorting a').removeClass('active');
        jQuery(this).addClass('active');
         jQuery('#sort_active_text').text(jQuery(this).text());
            var sorting = jQuery(this).attr('data-value');
            var form_data = jQuery("#sidebar_form").serializeArray();
            // set ajax data
         var specific_products = jQuery('#specific_products').attr('data-products');
         if(typeof specific_products !== 'undefined'){
             filter_ajax(form_data,1,sorting,specific_products);
         } else {
             filter_ajax(form_data,1,sorting);
         }
           
        } );

        jQuery(document).on('click','.applied_filters a',function(e){
            e.preventDefault();
            var filter_id = jQuery(this).attr('id');
             jQuery('input:checkbox[value="' + filter_id + '"]').attr('checked', false);
           // jQuery('input[value='+ filter_id +']').get(0).click();
           var sorting = jQuery('.sorting a.active').attr('data-value');
            var form_data = jQuery("#sidebar_form").serializeArray();
            // set ajax data
             var specific_products = jQuery('#specific_products').attr('data-products');
         if(typeof specific_products !== 'undefined'){
             filter_ajax(form_data,1,sorting,specific_products);
         } else {
             filter_ajax(form_data,1,sorting);
         }

        });
        jQuery(document).on('click','.product_type_on_list',function(){
          var type_id = jQuery(this).attr('id');
          var type_text = jQuery(this).text();
          var specific_products = jQuery('#specific_products').attr('data-products');
          jQuery('input:checkbox[value="' + type_id + '"]').attr('checked', true);
           var sorting = jQuery('.sorting a.active').attr('data-value');
            if(typeof specific_products !== 'undefined'){
             jQuery('#product_type').html('<form id="sidebar_form" action="index.php"><input type="checkbox" value="' + type_id + '" checked><label class="form-check-label" for="books">'+ type_text +'</label></form>');
             var form_data = [{name:"types", value:type_id}];
            } else {
                var form_data = jQuery("#sidebar_form").serializeArray();
            }
            
           
            // set ajax data
           
         if(typeof specific_products !== 'undefined'){
             jQuery('input:checkbox[value="' + type_id + '"]').attr('checked', true);
             filter_ajax(form_data,1,sorting,specific_products);
         } else {
             filter_ajax(form_data,1,sorting);
         }
        });
         jQuery('#sidebar_form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});
    });
    
    
    
    //product detail page
    
    function get_sku_ajax(sku_id){
         var data = {
        'action' : 'get_sku_data',
        'id': sku_id
    };

    jQuery.post(ajax_url, data, function( result ) {
        var response = jQuery.parseJSON(result);
            if(response){
                if(response.calculatedQATS > 0 ){
                jQuery('.sku-quantity').html('<input type="number" name="quantity" class="form-control" id="quantity" aria-describedby="quantity" value="'+ response.skuOrderMinimumQuantity +'" min="'+ response.skuOrderMinimumQuantity +'" max="'+ response.skuOrderMaximumQuantity +'" required>');
                jQuery('.cart_btn').html('<button type="submit" name="add_to_cart" value="submit" class="add-to-cart btn btn-primary btn-lg btn-block">Add to cart</button>');
                jQuery('#defaultSku_price').html(response.price);
            } else {
                jQuery('.sku-quantity').html('<small>Out of Stock</small>');
                jQuery('.cart_btn').html('');
            }
            }


    } );

    }

    

    jQuery(document).ready(function(){
       jQuery('#option').on('change',function(){
        var sku_id =  jQuery(this).val();
        get_sku_ajax(sku_id);
       });

//       jQuery(document).on('click','.add-to-cart',function(){
//           var sku_id = jQuery('#option').val();
//           var qty = jQuery('#quantity').val();
//           if(qty > 0){
//           add_to_cart(sku_id,qty);
//       } else {
//           jQuery('#quantity').val(1).focus();
//        }
//    });
    });
    
    
    /******************************** Start Checkout Page ******************************* */
    
    /******************************** Start Number validation with hyphen ******************************* */
    function phonenumber(n) {
var phoneNumberPattern = /^\d+(-\d+)*$/;
return phoneNumberPattern.test(n);
}

/******************************** Common Error show after ajax complete (parameter : error object , append class name)  ******************************* */
function error_msg(error_obje,append_class){
    jQuery('.' + append_class).html('');
        for( var first_key in error_obje ) {
        var first_value = error_obje[first_key];
            for( var key in first_value ) {
        var value = first_value[key];
            jQuery('.' + append_class).append('<div class="alert alert-danger small">'+ first_key + ': ' + value +'</div>');
      }
      }
}

    

/******************************** Checkout sidebar cart data update after ajax complete ******************************* */
    function checkout_sidebar_update(cart_data){
        if(cart_data.orderItems.length > 0){
            jQuery('.order_items_checkout').html('');
                jQuery('.order_items_checkout').append('<h3 class="mb-3 pt-3 pb-3 border-bottom">Order Items</h3><ul class="list-unstyled ml-0 mb-5"></ul>');
                       cart_data.orderItems.forEach(function(item) {
                           var product_page_single_url = site_url + '/' + PRODUCT_SINGLE_SLUG + '/' + item.sku.product.urlTitle;
                           jQuery('.order_items_checkout ul').append('<li class="media mb-4 pb-4 ml-0 border-bottom" id="' + item.orderItemID +'">');
                            if(item.sku.imagePath !== ''){
                             jQuery('.order_items_checkout ul li#' + item.orderItemID).append('<a href="' + product_page_single_url +'"><img src="' + DOMAIN + '/' + item.sku.imagePath + '" alt="' + item.sku.product.productName + '" class="img-fluid mr-3"></a>');
                             } else {
                               jQuery('.order_items_checkout ul li#' + item.orderItemID).append('<a href="' + product_page_single_url +'"><img src="https://via.placeholder.com/90x90" alt="'+ item.sku.product.productName +'" class="img-fluid mr-3"></a>');
                             }
                            jQuery('.order_items_checkout ul li#' + item.orderItemID).append('<div class="media-body"></div>');
                                 jQuery('.order_items_checkout ul li#' + item.orderItemID + ' .media-body').append('<a class="text-body font-weight-bold" href="' + product_page_single_url +'">' + item.sku.product.productName +'</a><br>');
                                jQuery('.order_items_checkout ul li#' + item.orderItemID + ' .media-body').append(' <span class="text-muted">$' + item.extendedPrice + '</span><br>');
                                 jQuery('.order_items_checkout ul li#' + item.orderItemID + ' .media-body').append('<small>Qty: ' + item.quantity + '</small><br>');
                                 jQuery('.order_items_checkout ul li#' + item.orderItemID + ' .media-body').append('<small>' + item.sku.skuDefinition+ '</small>');
                           jQuery('.order_items_checkout ul').append('</li>');
                            });

                            jQuery('.checkout_summary_area .subtotal').text('$' + cart_data.subtotal.toFixed(2));
                            jQuery('.checkout_summary_area .taxTotal').text('$' + cart_data.taxTotal.toFixed(2));
                            if(cart_data.orderAndItemDiscountAmountTotal > 0){
                            jQuery('.checkout_summary_area .discount_value').text('- $' + cart_data.orderAndItemDiscountAmountTotal.toFixed(2));
                            } 
                            jQuery('.checkout_summary_area .shipping_value').text('$' + cart_data.fulfillmentTotal.toFixed(2));
                            jQuery('.checkout_summary_area .grand_total').text('$' + cart_data.total.toFixed(2));
                            }
                            if(cart_data.orderRequirementsList.length > 0){
                                jQuery('.sidebar-place-order').prop("disabled", true);
                            } else {
                                 jQuery('.sidebar-place-order').prop("disabled", false);
                            }


    }

   

/******************************** Start Add Order Payment ******************************* */
function add_order_payment(form_data,same_shipping,account_address_id){
         var data = {
        'action' : 'add_order_payment',
        'form_data': form_data,
        'same_shipping' : same_shipping,
        'account_address_id' : account_address_id
    };

    jQuery.post(ajax_url, data, function( result ) {
				var response = jQuery.parseJSON(result);
        
        var response = jQuery.parseJSON(result);
	
             if(response.successfulActions && response.successfulActions.includes("public:cart.addOrderPayment")){
        var cart_data = response.cart;
        
        
        jQuery('.order_review_area').html('');
        if(typeof cart_data.orderFulfillments[0].shippingMethod !== 'undefined'){
        var shippingMethod = cart_data.orderFulfillments[0].shippingMethod;
    } else {
        var shippingMethod = false;
    }
    
    if(typeof cart_data.orderFulfillments[0].shippingAddress !== 'undefined'){
        var shipping_address = cart_data.orderFulfillments[0].shippingAddress;
    } else {
        var shipping_address = false;
    }
    
    if(typeof cart_data.orderPayments[0] !== 'undefined'){
        var billing_address = cart_data.orderPayments[0].billingAddress;
    } else {
         var billing_address = false;
    }
    if(typeof cart_data.orderPayments[0].paymentMethod.paymentMethodName !== 'undefined'){
        var payment_method_name = cart_data.orderPayments[0].paymentMethod.paymentMethodName;
    } else {
         var payment_method_name = false;
    }
   // console.log(cart_data.orderPayments[0]);
    if(typeof cart_data.orderPayments[0].creditCardLastFour !== 'undefined'){
        var credit_card_last_four = cart_data.orderPayments[0].creditCardLastFour;
    } else {
         var credit_card_last_four = false;
    }
    
      if(shipping_address && shipping_address.streetAddress){
          jQuery('.order_review_area').append('<div class="col-md-6 mb-4 col-print-6"><div class="bg-light p-4 h-100"><a href="javascript:void(0);" data-section="shippinginfo" class="small float-right edit_review">Edit</a><h6 class="card-title text-muted">Shipping Address</h6><address class="small mb-0">' + shipping_address.name + '<br>' + shipping_address.streetAddress + '<br>' + shipping_address.city + ', ' + shipping_address.stateCode + ' ' + shipping_address.postalCode + '<br>' + shipping_address.countrycode + '</address></div></div>');
      }
      if(shippingMethod){
      jQuery('.order_review_area').append('<div class="col-md-6 mb-4 col-print-6"><div class="bg-light p-4 h-100"><a href="javascript:void(0);" data-section="shippinginfo" class="small float-right edit_review">Edit</a><h6 class="card-title text-muted">Shipping Fulfillment</h6><ul class="list-unstyled small m-0"><li class="m-0">'+ shippingMethod.shippingMethodName +'</li></ul></div></div>');
  }
        
       if(billing_address){
           jQuery('.order_review_area').append('<div class="col-md-6 mb-4 col-print-6"><div class="bg-light p-4 h-100"><a href="javascript:void(0);" data-section="billinginfo" class="small float-right edit_review">Edit</a><h6 class="card-title text-muted">Billing Address</h6><address class="small mb-0">' + billing_address.name + '<br>' + billing_address.streetAddress + '<br>' + billing_address.city + ', ' + billing_address.stateCode + ' ' + billing_address.postalCode + '<br>' + billing_address.countrycode + '</address></div></div>');
       }
       if(credit_card_last_four){
           jQuery('.order_review_area').append('<div class="col-md-6 mb-4 col-print-6"><div class="bg-light p-4 h-100"><a href="javascript:void(0);" data-section="billinginfo" class="small float-right edit_review">Edit</a><h6 class="card-title text-muted">Payment Information</h6><p class="small">Credit Card ending in ' + credit_card_last_four + '</p></div></div>');
       } else {
           jQuery('.order_review_area').append('<div class="col-md-6 mb-4 col-print-6"><div class="bg-light p-4 h-100"><a href="javascript:void(0);" data-section="billinginfo" class="small float-right edit_review">Edit</a><h6 class="card-title text-muted">Payment Information</h6><p class="small">' + payment_method_name + '</p></div></div>');
       }
       checkout_sidebar_update(cart_data);
        jQuery('.add_order_payment').hide();
        jQuery('.billinginfo').hide();
        jQuery('.revieworder').show();
        jQuery('#place-order,.sidebar-place-order').prop("disabled", false);
      } else {
      jQuery('.add_order_payment').show();
       error_msg(response.errors,'add_order_payment');
      }
    } );
        return false;
    }

    jQuery(document).on('submit','.add-order-payment',function(e){
        e.preventDefault();
        // var form_data = jQuery(this).serializeArray();
        // add_order_payment(form_data);
        var same_shipping;
        var account_address_id = jQuery('.billing_account_address a.active').attr('id');
				
        var form_data = jQuery(this).serializeArray();
        var error_require = 0;
        jQuery(this).find('.required').each(function(){
				 var inputval = jQuery(this).val();
				 if(inputval == '') {
					 error_require = 1;
					 jQuery(this).addClass('is-invalid');
				 } else{
					 jQuery(this).removeClass('is-invalid');
				 }
                                 var has_number = jQuery(this).hasClass('number');
                                 if(has_number === true && inputval !== ''){
                    
                 var number_check = phonenumber(inputval);
                 
                 if(number_check === false){
                       error_require = 1;
                        jQuery(this).addClass('is-invalid-phone is-invalid');
                        jQuery(this).parent().find('.invalid-feedback').hide();
                        jQuery(this).parent().find('.invalid-feedback.invalid-feedback-phone').show();
                    } else {
                        jQuery(this).removeClass('is-invalid-phone is-invalid');
                         jQuery(this).parent().find('.invalid-feedback.invalid-feedback-phone').hide();
                    }                        
                }
			 });
       if(jQuery('#billingAddress').prop("checked") === true){
          same_shipping = 1;
       } else{
            same_shipping = 0;
       }
         if((jQuery('#billingAddress').prop("checked") === true  || typeof account_address_id !== 'undefined') && error_require === 0){
           jQuery('.billingnotadded').hide(); 
           add_order_payment(form_data,same_shipping,account_address_id);
       } else {
         jQuery('.billingnotadded').show();  
        }

    });
    /******************************** End Add Order Payment ******************************* */

    /******************************** Start Add Shipping Address and method Section on checkout page ******************************* */
    
    function pickup(){
         var data = {
        'action' : 'pickup'
    };
    
    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
		if(response.successfulActions && response.successfulActions.includes("public:cart.addPickupFulfillmentLocation")){
               //     console.log(response);
                     var cart_data = response.cart;
                         checkout_sidebar_update(cart_data);
                         jQuery('input[name="billing_same_as_shipping"]').attr('disabled','disabled').prop("checked", false);
                         jQuery('.billing_account_address,.create_new_billing_address').show();
          setTimeout(function(){
                jQuery('.shippinginfo').hide();
                jQuery('.billinginfo').show();
         }, 30);
                }
    
    } );
    }
    
    function pickup_shipping(sku_ids,fulfillment_ids,add_pickup_location){
         var data = {
        'action' : 'pickup_shipping',
        'sku_ids' : sku_ids,
        'fulfillment_ids' : fulfillment_ids,
        'add_pickup_location' : add_pickup_location
    };
    
    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
   //console.log(result);
		if(response.cart_data.successfulActions && response.cart_data.successfulActions.includes("public:cart.changeOrderFulfillment")){
                  //  console.log(response.shipping_methods.availableShippingMethods);
                   if(typeof response.shipping_methods.availableShippingMethods !== 'undefined'){
                if(typeof response.shipping_methods.availableShippingMethods[0].value !== 'undefined' && response.shipping_methods.availableShippingMethods.length > 0){
                var shipping_methods = response.shipping_methods.availableShippingMethods;
                jQuery('.select_shipping_area').html('');
                jQuery('.select_shipping_area').append('<h5 class="text-secondary my-4">Select Shipping Fulfillment</h5>');
           shipping_methods.forEach(function(shipping_method) {
               var checked = '';
               if(typeof response.cart_data.cart.orderFulfillments[0].shippingMethodOptions.VALUE !== 'undefined' && response.cart_data.cart.orderFulfillments[0].shippingMethodOptions.VALUE == shipping_method.value){
                   var checked = 'checked';
               }
                jQuery('.select_shipping_area').append('<div class="form-check mb-3"><input class="form-check-input" type="radio" name="shipping_method" id="' + shipping_method.shippingMethodCode + '" value="' + shipping_method.value +'" '+ checked +'><label class="ml-2 form-check-label" for="' + shipping_method.shippingMethodCode + '">' + shipping_method.name +'</label></div>');
            });
                } else {
                 jQuery('.select_shipping_area').html('<p>No Shipping Method Added in the Product, Please choose another Product to checkout</p>');

                } } else {
                jQuery('.select_shipping_area').html('<p>No Shipping Method Added in the Product, Please choose another Product to checkout</p>');
                }
                 checkout_sidebar_update(response.cart_data.cart);
                if(typeof response.cart_data.cart.orderFulfillments[0] !== 'undefined'){
                    var orderFulfillmentID = '';
                    response.cart_data.cart.orderFulfillments.forEach(function(orderFulfillments) {
if(typeof orderFulfillments.fulfillmentMethod.fulfillmentMethodType !== 'undefined' && orderFulfillments.fulfillmentMethod.fulfillmentMethodType == 'shipping'){
           orderFulfillmentID = orderFulfillments.orderFulfillmentID;
        }

                    });
                jQuery('#order_fulfillment_id').attr('data-fulfillment',orderFulfillmentID);
            }
          setTimeout(function(){
                jQuery('#shipping_step_one').hide();
                jQuery('#shipping_step_two').show();
         }, 30);
                }
    
    } );
    }
    
    jQuery(document).on('click','.shipping_pickup',function(){
       var items=jQuery(".fulfillment_select.active").map(function() {
        return jQuery(this).data("type");
      }).get();
     // console.log(items.every( v => v === 'pickup' ));
       
      var shipping_pickup_type = (items.every( v => v === 'pickup' )==true)?'pickup':'shipping_pickup';
      //alert(shipping_pickup_type);
      //var sku_fulfilment_ids = [];
      var fulfillment_type = [];
      var sku_id = '';
      var fulfillment_id = '';
      if(shipping_pickup_type === 'pickup'){
          pickup();         
      } else if(shipping_pickup_type === 'shipping_pickup'){
          
       //  console.log(jQuery('.shipping_pickup_items li').length);
         var item_count = 1;
          jQuery('.shipping_pickup_items li').each(function(){
//              var sku_id = jQuery(this).find('a.product-name').attr('data-skuid');
//              var fulfillment_id = jQuery(this).find('.fulfillment_select.active').attr('id');
//             sku_fulfilment_ids.push({ sku_id : sku_id,fulfillment_id : fulfillment_id}); 
            fulfillment_type.push(jQuery(this).find('.fulfillment_select.active').attr('data-type'));
            if(jQuery(this).find('button.fulfillment_select').attr('data-type') === 'shipping'){
             sku_id = jQuery(this).find('a.product-name').attr('data-skuid');
             
             fulfillment_id = jQuery(this).find('.fulfillment_select.active').attr('id');
             
         }
         item_count++; });
          //console.log(sku_ids);
         //  console.log(fulfillment_ids);
           if(fulfillment_type.includes("shipping")){
             
               if(fulfillment_type.includes("pickup")){
                   var add_pickup_location = true;
               } else {
                var add_pickup_location = false;   
               }
             
          pickup_shipping(sku_id,fulfillment_id,add_pickup_location);
           } else {
               pickup(); 
           }
      }
       
    });


    function add_shipping(form_data,account_address_id,shipping_id,order_fulfillment_id){
         var data = {
        'action' : 'add_shipping_address',
        'form_data': form_data,
        'account_address_id': account_address_id,
        'shipping_id':shipping_id,
        'order_fulfillment_id': order_fulfillment_id
    };
    
    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
		if(response.successfulActions && (response.successfulActions.includes("public:cart.addShippingAddressUsingAccountAddress") || response.successfulActions.includes("public:cart.addShippingAddress"))){
			jQuery('.shippingadded').show();
			jQuery('.shipmentnotadded').html('');
                        var cart_data = response.cart;
                         checkout_sidebar_update(cart_data);
			setTimeout(function(){
				jQuery('.shippinginfo').hide();
				jQuery('.billinginfo').show();
			 }, 30);
		} else if (response.errors){
			error_msg(response.errors,'shipmentnotadded');
		}
    
    } );

    }
    
    jQuery(document).on('click','#shipping_countinue',function(e){
       e.preventDefault();
       
			 var error_require = 0;
       var form_data = jQuery('#account-shipping').serializeArray();
       var account_address_id = jQuery('.account_address_for_shipping .account-address.active').attr('id');
			 jQuery('#account-shipping .required').each(function(){
				 var inputval = jQuery(this).val();
                                 if(typeof account_address_id === 'undefined'){
				 if(inputval == '') {
					 error_require = 1;
					 jQuery(this).addClass('is-invalid');
				 } else{
					 jQuery(this).removeClass('is-invalid');
				 }
                                 
                                 var has_number = jQuery(this).hasClass('number');
              
                                if(has_number === true && inputval !== ''){
                                   
                                  var number_check = phonenumber(inputval);
                                  
                                  if(number_check === false){
                                        error_require = 1;
                                         jQuery(this).addClass('is-invalid-phone is-invalid');
                                         jQuery(this).parent().find('.invalid-feedback').hide();
                                         jQuery(this).parent().find('.invalid-feedback.invalid-feedback-phone').show();
                                     } else {
                                         jQuery(this).removeClass('is-invalid-phone is-invalid');
                                          jQuery(this).parent().find('.invalid-feedback.invalid-feedback-phone').hide();
                                     }                        
                                 }
                             }
			 });
			 
	     
	     var shipping_id = jQuery('input[name=shipping_method]:checked').val();
             
             var order_fulfillment_id = jQuery('#order_fulfillment_id').attr('data-fulfillment');
             
			 if(error_require == 0 || typeof account_address_id !== 'undefined') {
                              jQuery('.account_address_for_shipping').removeClass('address_error');
				 add_shipping(form_data,account_address_id,shipping_id,order_fulfillment_id);
			 } else {
                           jQuery('.account_address_for_shipping').addClass('address_error');
    }
       return false;

    });
    
    
    jQuery(document).on('click','.fulfillment_select',function(){
       var fulfillment_type = jQuery(this).attr('id');
        jQuery('.fulfillment_select').siblings().removeClass('disabled').removeClass('active').removeClass('btn-primary').addClass('btn-secondary');
        jQuery('.fulfillment_select').siblings().find('.fa-check').remove();
        jQuery('#'+ fulfillment_type +'.fulfillment_select').addClass('disabled').addClass('active').addClass('btn-primary').removeClass('btn-secondary');;
        var current_text = jQuery(this).text();
        jQuery('#'+ fulfillment_type +'.fulfillment_select').html('<i class="fa fa-check"></i>' + current_text);
    });
    
    /******************************** End Add Shipping Address and method Section on checkout page ******************************* */
    

    jQuery(document).on('click','.account-address',function(){
        jQuery('.account-address').find('i').removeClass('fa-check-circle');
        jQuery(this).find('i').addClass('fa-check-circle');

				if(jQuery(this).hasClass('active')) {
					jQuery(this).removeClass('active');
					jQuery('.account-address').find('i').removeClass('fa-check-circle');
				} else{
					jQuery('.account-address').removeClass('active');
					jQuery(this).addClass('active');
					jQuery(this).find('i').addClass('fa-check-circle');
				}
    });

    /******************************** Start Place Order Section on checkout ******************************* */
    
    function place_order(){
         var data = {
        'action' : 'place_order'
    };
    jQuery.post(ajax_url, data, function( result ) {
       var response = jQuery.parseJSON(result);
       if(response.order_placed.successfulActions && response.order_placed.successfulActions.includes("public:cart.placeOrder")){
         
           jQuery('.order-placed,.reviewconfirm').show();
           jQuery('.order-placed').html('<strong>Order #' + response.order_id + '</strong> has been placed');
           jQuery('.revieworder,.reviewconfirm a,#place-order').hide();
           jQuery('.checkout_heading_section').html('<h1>Order Confirmation</h1><a href="javascript:void(0);"  class="print btn btn-light text-secondary"><i class="fa fa-print"></i> Print Order</a>');
           jQuery('#mini-cart .badge.badge-pill').text('0');
           jQuery('#mini-cart .list-unstyled').html('');
           jQuery('#mini-cart .alert.alert-info').html('There are no items in your cart.').show();
            } else {
           
             jQuery.each(response.order_placed.errors, function(key, value) {
                 
                 jQuery('.revieworder').prepend('<div class="alert alert-danger small">'+value[0]+'</div>');
    });
             jQuery('#order-placed,.reviewconfirm').hide();
            }

    } );
        return false;
    }
    jQuery(document).on('click','#place-order',function(){
       place_order();
    });


    /******************************** End Place Order Section on checkout ******************************* */
    
    
    /******************************** Start Login and Registration Section on checkout ******************************* */
    function checkout_user_login_register(form_data,action){
         var data = {
        'action' : action,
        'form_data': form_data
    };
    jQuery.post(ajax_url, data, function( result ) {
		var response = jQuery.parseJSON(result);
                
    var account_address = response.account_address;
    if(action === 'user_login'){
        if(response.token){
           
            if(account_address.length > 0){
                jQuery('#shippingCreateAddress').removeClass('show');
                jQuery('.show-address-book').show();
                jQuery('.account_address_for_shipping').append('<h5 class="text-secondary my-4">Select Shipping Address</h5><div class="row"></div>');
                account_address.forEach(function(address) {
                
                jQuery('.account_address_for_shipping .row,.billing_account_address').append('<div class="col-md-6 mb-4 col-print-6"><a href="javascript:void(0);" class="btn btn-block p-0 text-left account-address" id="'+ address.accountAddressID+'"><div class="bg-light p-4 h-100 border"><i class="far float-right"></i><h6 class="card-title text-muted">' + address.address.name + '</h6><address class="small mb-0 text-body"><br>' + address.address.streetAddress + '<br>'+ address.address.city+', '+ address.address.stateCode +' ' + address.address.postalCode  + '<br>' + address.address.countryCode  + '</address></div></a></div>');
            });
            jQuery('.account_address_for_shipping .row,.billing_account_address').append('<div class="col-md-12 mb-2"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="shippingAddressBook shippingCreateAddress"><i class="fa fa-plus"></i> Add New Address</button></div>');
                } else {
                 jQuery('.account_address_for_shipping').html('');
                 jQuery('#shippingCreateAddress').addClass('show');
                jQuery('.show-address-book').hide();
                 
                }
                 jQuery('.select_shipping_area').html('');
                 if(typeof response.shipping_methods.availableShippingMethods !== 'undefined'){
                if(typeof response.shipping_methods.availableShippingMethods[0].value !== 'undefined' && response.shipping_methods.availableShippingMethods.length > 0){
                var shipping_methods = response.shipping_methods.availableShippingMethods;
                jQuery('.select_shipping_area').append('<h5 class="text-secondary my-4">Select Shipping Fulfillment</h5>');
           shipping_methods.forEach(function(shipping_method) {
               var checked = '';
               if(typeof response.cart_data.cart.orderFulfillments[0].shippingMethod !== 'undefined' && response.cart_data.cart.orderFulfillments[0].shippingMethod.shippingMethodID == shipping_method.value){
                   var checked = 'checked';
               }
                jQuery('.select_shipping_area').append('<div class="form-check mb-3"><input class="form-check-input" type="radio" name="shipping_method" id="' + shipping_method.shippingMethodCode + '" value="' + shipping_method.value +'" '+ checked +'><label class="ml-2 form-check-label" for="' + shipping_method.shippingMethodCode + '">' + shipping_method.name +'</label></div>');
            });
                } else {
                 jQuery('.select_shipping_area').html('<p>No Shipping Method Added in the Product, Please choose another Product to checkout</p>');

                } } else {
                jQuery('.select_shipping_area').html('<p>No Shipping Method Added in the Product, Please choose another Product to checkout</p>');
                }
                checkout_sidebar_update(response.cart_data);
                 if(typeof response.cart_data.cart.orderFulfillments[0] !== 'undefined'){
                    var orderFulfillmentID = '';
                    response.cart_data.cart.orderFulfillments.forEach(function(orderFulfillments) {
if(typeof orderFulfillments.fulfillmentMethod.fulfillmentMethodType !== 'undefined' && orderFulfillments.fulfillmentMethod.fulfillmentMethodType == 'shipping'){
           orderFulfillmentID = orderFulfillments.orderFulfillmentID;
        }

                    });
                jQuery('#order_fulfillment_id').attr('data-fulfillment',orderFulfillmentID);
            }
                jQuery('.checkoutforms,.alert').hide();
                jQuery('.shippinginfo').show();
        } else {
                jQuery('#pills-login .accounterror').text(response.errors.emailAddress[0]).show();
        }
        } else if(action === 'user_register') {
        if(response.successfulActions.includes("public:account.create")){
        jQuery('.account_create_errors').html('');
        jQuery('.account_create').show();
         if(response.token){
           
            if(account_address.length > 0){
                jQuery('.account_address_for_shipping').append('<h5 class="text-secondary my-4">Select Shipping Address</h5><div class="row"></div>');
                account_address.forEach(function(address) {
                
                jQuery('.account_address_for_shipping .row,.billing_account_address').append('<div class="col-md-6 mb-4 col-print-6"><a href="javascript:void(0);" class="btn btn-block p-0 text-left account-address" id="'+ address.accountAddressID+'"><div class="bg-light p-4 h-100 border"><i class="far float-right"></i><h6 class="card-title text-muted">' + address.address.name + '</h6><address class="small mb-0 text-body"><br>' + address.address.streetAddress + '<br>'+ address.address.city+', '+ address.address.stateCode +' ' + address.address.postalCode  + '<br>' + address.address.countryCode  + '</address></div></a></div>');
            });
            jQuery('.account_address_for_shipping .row,.billing_account_address').append('<div class="col-md-12 mb-2"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="shippingAddressBook shippingCreateAddress"><i class="fa fa-plus"></i> Add New Address</button></div>');
                } else {
                 jQuery('.account_address_for_shipping').html('');
                }
                 jQuery('.select_shipping_area').html('');
                 if(typeof response.shipping_methods.availableShippingMethods !== 'undefined'){
                if(typeof response.shipping_methods.availableShippingMethods[0].value !== 'undefined' && response.shipping_methods.availableShippingMethods.length > 0){
                var shipping_methods = response.shipping_methods.availableShippingMethods;
                jQuery('.select_shipping_area').append('<h5 class="text-secondary my-4">Select Shipping Fulfillment</h5>');
           shipping_methods.forEach(function(shipping_method) {
               var checked = '';
               if(typeof response.cart_data.cart.orderFulfillments[0].shippingMethod.shippingMethodID !== 'undefined' && response.cart_data.cart.orderFulfillments[0].shippingMethod.shippingMethodID == shipping_method.value){
                   var checked = 'checked';
               }
                jQuery('.select_shipping_area').append('<div class="form-check mb-3"><input class="form-check-input" type="radio" name="shipping_method" id="' + shipping_method.shippingMethodCode + '" value="' + shipping_method.value +'" '+ checked +'><label class="ml-2 form-check-label" for="' + shipping_method.shippingMethodCode + '">' + shipping_method.name +'</label></div>');
            });
                } else {
                 jQuery('.select_shipping_area').html('<p>No Shipping Method Added in the Product, Please choose another Product to checkout</p>');

                } } else {
                jQuery('.select_shipping_area').html('<p>No Shipping Method Added in the Product, Please choose another Product to checkout</p>');
                }
                checkout_sidebar_update(response.cart_data);
                if(typeof response.cart_data.cart.orderFulfillments[0] !== 'undefined'){
                    var orderFulfillmentID = '';
                    response.cart_data.cart.orderFulfillments.forEach(function(orderFulfillments) {
if(typeof orderFulfillments.fulfillmentMethod.fulfillmentMethodType !== 'undefined' && orderFulfillments.fulfillmentMethod.fulfillmentMethodType == 'shipping'){
           orderFulfillmentID = orderFulfillments.orderFulfillmentID;
        }

                    });
                jQuery('#order_fulfillment_id').attr('data-fulfillment',orderFulfillmentID);
            }
                jQuery('.checkoutforms,.alert').hide();
                jQuery('.shippinginfo').show();
        } else {
                jQuery('#pills-login .accounterror').text(response.errors.emailAddress[0]).show();
        }
        }else {
      jQuery('.account_create').hide();
      error_msg(response.errors,'account_create_errors');

        }
        } else if(action === 'forget_password_account')  {
            if(response.successfulActions.includes("public:account.forgotPassword")){
        jQuery('.account_forget_errors').html('');
        jQuery('.account_forget').show();
        }else {
      jQuery('.account_forget').hide();
      error_msg(response.errors,'account_forget_errors');

        }
        }
    } );

    }

    jQuery(document).on('submit','.checkout_login_register',function(e){
       e.preventDefault();
       var form_data = jQuery(this).serializeArray();
      
       var action = jQuery(this).attr('action');
       var error_require = 0;
       jQuery('.checkout_login_register input').removeClass('is-invalid');
       jQuery(this).find('.required').each(function(){
                var inputval = jQuery(this).val();
                if(typeof account_address_id === 'undefined'){
                if(inputval === '') {
                        error_require = 1;
                        jQuery(this).addClass('is-invalid');
                } else{
                        jQuery(this).removeClass('is-invalid');
                }
                
               var has_number = jQuery(this).hasClass('number');
              
               if(has_number === true && inputval !== ''){
                    
                 var number_check = phonenumber(inputval);
                 
                 if(number_check === false){
                       error_require = 1;
                        jQuery(this).addClass('is-invalid-phone is-invalid');
                        jQuery(this).parent().find('.invalid-feedback').hide();
                        jQuery(this).parent().find('.invalid-feedback.invalid-feedback-phone').show();
                    } else {
                        jQuery(this).removeClass('is-invalid-phone is-invalid');
                         jQuery(this).parent().find('.invalid-feedback.invalid-feedback-phone').hide();
                    }                        
                }
            }
	});
                     if(error_require === 0){    
         checkout_user_login_register(form_data,action);
     }

       return false;
    });
    
    /******************************** End Login and Registration section on Checkout Page ******************************* */
    
    /******************************** Start Set State list on Checkout Page ******************************* */
function get_state_code(country_code,state_id)
    {
        var data = {
        'action' : 'address_state_code',
        'form_data': country_code
    };
    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
   
   jQuery('#'+state_id).html('<option value="">Choose State</option>');
   
    jQuery.each(response.stateCodeOptions, function(key, value) { 
         
       
     jQuery('#'+state_id).append('<option value="'+value.value+'">'+value.name+'</option>'); 
});
    } );
    }
    jQuery(document).on('change','.county_value',function(){
        var country_code = jQuery(this).val();
        var state_id = jQuery(this).attr('data-state');
        if(country_code !== ""){
        get_state_code(country_code,state_id);
    }
    });   
    /******************************** Start Set State list on Checkout Page ******************************* */
    
    jQuery(document).on('click','.edit_review',function(){
       var edit_section = jQuery(this).attr('data-section');
       jQuery('.revieworder').hide();
       jQuery('.' + edit_section).show();
    });
    
    
    jQuery(document).on('submit','#add-account-billing',function(e){
        e.preventDefault();
        var form_data = jQuery(this).serializeArray();
       var error_require = 0;
       jQuery(this).find('.required').each(function(){
                var inputval = jQuery(this).val();
                if(typeof account_address_id === 'undefined'){
                if(inputval === '') {
                        error_require = 1;
                        jQuery(this).addClass('is-invalid');
                } else{
                        jQuery(this).removeClass('is-invalid');
                }
                
            }
	});
        if(error_require === 0){
        add_billing_address(form_data);
    }
    });
    
     function add_billing_address(form_data){
         var data = {
        'action' : 'add_account_address',
        'form_data' : form_data
    };
    jQuery.post(ajax_url, data, function( result ) {
       var response = jQuery.parseJSON(result);
      
       if(response.successfulActions.includes("public:account.addNewAccountAddress")){
         
            var account_address = response.account.accountAddresses;
            var newAccountAddressID = response.newAccountAddressID;
            
            if(account_address.length > 0){
                var shipping_active_id = jQuery('.account_address_for_shipping .account-address.active').attr('id');
                jQuery('.account_address_for_shipping,.billing_account_address').html('');
                jQuery('.account_address_for_shipping').append('<h5 class="text-secondary my-4">Select Shipping Address</h5><div class="row"></div>');
                account_address.forEach(function(address) {
                    var active_class = "";
            var circle_check_class = "";
                    if(address.accountAddressID == newAccountAddressID){
                      active_class = "active";  
                      circle_check_class = "fa-check-circle";
                      } 
                     
                jQuery('.account_address_for_shipping .row,.billing_account_address').append('<div class="col-md-6 mb-4 col-print-6"><a href="javascript:void(0);" class="btn btn-block p-0 text-left account-address '+ active_class +'" id="'+ address.accountAddressID+'"><div class="bg-light p-4 h-100 border"><i class="far float-right '+ circle_check_class +'"></i><h6 class="card-title text-muted">' + address.address.name + '</h6><address class="small mb-0 text-body"><br>' + address.address.streetAddress + '<br>'+ address.address.city+', '+ address.address.stateCode +' ' + address.address.postalCode  + '<br>' + address.address.countryCode  + '</address></div></a></div>');
            });
            jQuery('.account_address_for_shipping #'+shipping_active_id).addClass('active').find('i').addClass('fa-check-circle');
                } 
           jQuery('.account_billing_address_added').show();
           jQuery('.account_billing_address_add_error').hide();
           jQuery('#billingAddressBook').addClass('show');
           jQuery('#billingCreateAddress').removeClass('show');
            } else {
      jQuery('.account_billing_address_added').hide();
      jQuery('.account_billing_address_add_error').html('');
      error_msg(response.errors,'account_billing_address_add_error');
      jQuery('.account_billing_address_add_error').show();
            }

    } );
        return false;
    }
    
    jQuery(document).on('change','#billingAddress',function(){
    if(jQuery(this).prop("checked") !== true){
        jQuery(".create_new_billing_address,.billing_account_address").show();
    } else {
    jQuery(".create_new_billing_address,.billing_account_address").hide();
    }
    });
    
    /******************************** End Checkout Page ******************************* */
    
    /******************************** Start Address Book on My Account ******************************* */
    jQuery(document).ready(function(){
    //get it if Status key found
    if(localStorage.getItem("Status")=='delete-address'||localStorage.getItem("Status")=='add-address')
    {
        jQuery('.added_deleted_address').show().delay(8000).fadeOut();
        localStorage.clear();
    }
    if(localStorage.getItem("Status")=='edit-address')
    {
        jQuery('.edit_address').show().delay(8000).fadeOut();
        localStorage.clear();
    }

    if(localStorage.getItem("Status")=='set-primary-address')
    {
        jQuery('.primary_address').show().delay(8000).fadeOut();
        localStorage.clear();
    }
});
    
    /******************************** get  and set state code******************************* */
    jQuery(document).on('change','#countryCode',function(e)
    {
       e.preventDefault();
       jQuery('.state_code_address').empty().append(jQuery("<option></option>").attr("value",'').text('Choose State'));
       get_state_code1(jQuery(this).val(),'address_state_code');

    });
    function get_state_code1(data,action,val='')
    {
        var data = {
        'action' : action,
        'form_data': data
    };

     
    jQuery.post(ajax_url, data, function( result ) {
        if(IsJsonString(result)){
    var response = jQuery.parseJSON(result);
    jQuery.each(response.stateCodeOptions, function(key, value) {
     jQuery('.state_code_address')
         .append(jQuery("<option></option>")
                    .attr("value",value.value)
                    .text(value.name));
});

set_state_code(val);
        }
    } );
    }

function set_state_code(val)
{
    console.log(jQuery(".state_code_address > [value='"+ val +"']").attr("selected", "true"));
}
/*************************************end state code******************************************************* */
    /*************************Adding Account Address ************************************** */
    jQuery(document).on('submit','#add_modal_address',function(e){
        e.preventDefault();
		var error_require = 0;
       var form_data = jQuery('#add_modal_address').serializeArray();
			 jQuery('#add_modal_address .required').each(function(){
				 var inputval = jQuery(this).val();
				 if(inputval == '') {
					 error_require = 1;
					 jQuery(this).addClass('is-invalid');
				 } else{
					 jQuery(this).removeClass('is-invalid');
				 }
			 });
       var form_data = jQuery('#add_modal_address').serializeArray();
       var action = jQuery('#add_modal_address').attr('action');
	   if(error_require == 0) {
		      add_address(form_data,action);
			 }

       return false;
    });

    function add_address(form_data,action){
         var data = {
        'action' : action,
        'form_data': form_data
    };
    jQuery.post(ajax_url, data, function( result ) {
    
     if(IsJsonString(result)){
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0)
    {
    localStorage.setItem("Status",'add-address')
    window.location.reload();
    } else if(response.errors.length>0)
    {
        window.location.reload();
    }
     } else {
         window.location.reload();
     }
	//window.location.reload();
    } );

    }
 /*********************end add address********************************** */

 /*************************delete address*********************************** */
	jQuery(document).on('click','.delete-address',function(e){
        e.preventDefault();
		var addressId=jQuery(this).attr("data-id");
       delete_address(addressId,'delete_account_address');
       return false;
    });
	function delete_address(accountAddressID,action){
         var data = {
        'action' : action,
        'form_data': {'accountAddressID':accountAddressID}
    };

    jQuery.post(ajax_url, data, function( result ) {
   
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0)
    {
        localStorage.setItem("Status",'delete-address')
    window.location.reload();
    //jQuery('added_deleted_address').show()
//     jQuery('.added_deleted_address').show();
//     jQuery('html, body').animate({
//     scrollTop: jQuery(".added_deleted_address").offset().top
// }, 1000);
// 					setTimeout(function(){
// 						window.location.reload();
// 			 }, 3000);
//      jQuery('.added_deleted_address').show();
    } else if(response.errors.length>0)
    {
        jQuery('.added_deleted_address').addClass('alert-danger');
					jQuery('.added_deleted_address').removeClass('alert-success');
					jQuery('.added_deleted_address').text('Someting Went Wrong').show();
                    jQuery('html, body').animate({
    scrollTop: jQuery(".added_deleted_address").offset().top
}, 1000);
    }


    } );

    }
/************************end delete address******************************** */


/***************************change title of modal on the basis of button click******************************************** */
jQuery(document).ready(function(){
    jQuery('#exampleModal').on('show.bs.modal', function (event) {
	var button	= jQuery(event.relatedTarget); // Button that triggered the modal
	var modal		= jQuery(this);
	var title = button.data('title');
	modal.find('.modal-title').text(title);
	if(title=='Add Address')
	{
        modal.find('input').removeClass('is-invalid');
		modal.find('form').attr('action','add_account_address');
		modal.find('form').attr('id','add_modal_address');
        modal.find('form')[0].reset();
        modal.find('form').find('.state_code_address').empty().append(jQuery("<option></option>").attr("value",'').text('Choose State'));
	get_state_code1('US','address_state_code');
        }
	else if(title=='Edit Address'){
        modal.find('input').removeClass('is-invalid');
		modal.find('form').attr('action','edit_account_address');
		modal.find('form').attr('id','edit_modal_address');
	}

});
});
	
/**************************end ******************************** */



/********************edit address *************************** */


jQuery(document).on('click','.edit-address',function(e){
        e.preventDefault();
		var addressId=jQuery(this).attr("data-id");
		jQuery('#save_data').attr('data-id', addressId);
		var value=jQuery(this).data("value");
        var get_val=jQuery.parseJSON(JSON.stringify(value));
        jQuery('.state_code_address').empty().append(jQuery("<option></option>").attr("value",'').text('Choose State'));
         get_state_code1(get_val.address.countryCode,'address_state_code',get_val.address.stateCode);
		jQuery( "input[name*='postalCode']" ).val(get_val.address.postalCode);
		jQuery( "input[name*='accountAddressName']" ).val(get_val.accountAddressName);
		jQuery( "input[name*='name']" ).val(get_val.address.name);
		jQuery( "input[name*='company']" ).val(get_val.address.company);
		jQuery( "input[name*='streetAddress']" ).val(get_val.address.streetAddress);
		jQuery( "input[name*='street2Address']" ).val(get_val.address.street2Address);
		jQuery( "input[name*='city']" ).val(get_val.address.city);
        jQuery(".state_code_address").val(get_val.address.stateCode);
		jQuery( "#countryCode" ).val(get_val.address.countryCode).find("option[value='"+ get_val.address.countryCode +"']").attr("selected", "true");;
    });

	jQuery(document).on('submit','#edit_modal_address',function(e){
        e.preventDefault();
		var error_require = 0;
       var form_data = jQuery(this).serializeArray();
			 jQuery('#edit_modal_address .required').each(function(){
				 var inputval = jQuery(this).val();
				 if(inputval == '') {
					 error_require = 1;
					 jQuery(this).addClass('is-invalid');
				 } else{
					 jQuery(this).removeClass('is-invalid');
				 }
			 });
			 var action = jQuery('#edit_modal_address').attr('action');
	     var addressId=jQuery('#save_data').attr("data-id");
			 if(error_require == 0) {
				edit_address(addressId,form_data,action);
			 }


       return false;
    });

	function edit_address(addressID,form_data,action){
         var data = {
        'action' : action,
        'form_data': form_data,
		'addressID':addressID
    };
	console.log(addressID);
    jQuery.post(ajax_url, data, function( result ) {
        var response = jQuery.parseJSON(result);
        if(IsJsonString(result)){
    if(response.successfulActions.length>0)
    {
    localStorage.setItem("Status",'edit-address')
    window.location.reload();
    } else
    {
        window.location.reload();
    }
    } else {
         window.location.reload();  
    }
    } );

    }
    /*********************end edit address*********************** */


    /*************************set primary address*********************************** */
	jQuery(document).on('click','.set-primary-address',function(e){
        e.preventDefault();
		var addressId=jQuery(this).attr("data-id");
        set_primary_address(addressId,'set_primary_address');
       return false;
    });
	function set_primary_address(accountAddressID,action){
         var data = {
        'action' : action,
        'form_data': {'accountAddressID':accountAddressID}
    };
    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0)
    {
        localStorage.setItem("Status",'set-primary-address')
    window.location.reload();
    } else if(response.errors.length>0)
    {
        jQuery('.added_deleted_address').addClass('alert-danger');
					jQuery('.added_deleted_address').removeClass('alert-success');
					jQuery('.added_deleted_address').text('Someting Went Wrong').show();
                    jQuery('html, body').animate({
                    scrollTop: jQuery(".added_deleted_address").offset().top }, 1000);
    }   } );

    }
/************************end set primary address******************************** */

/******************************** End Address Book on My Account ******************************* */

/******************************** Start Email Address Section on My Account ******************************* */

jQuery(document).ready(function(){
    //get it if Status key found
    if(localStorage.getItem("Status")=='delete-email')
    {
        jQuery('.account-email-address').show().delay(8000).fadeOut();
        localStorage.clear();
    }


    if(localStorage.getItem("Status")=='set-primary-email')
    {
        jQuery('.primary-email').show().delay(8000).fadeOut();
        localStorage.clear();
    }
    
    if(localStorage.getItem("Status")=='add-email')
    {
        jQuery('.add-email').show().delay(8000).fadeOut();
        localStorage.clear();
    }
    
});




 /*************************delete email*********************************** */
	jQuery(document).on('click','.delete-emailAddress',function(e){
        e.preventDefault();
		var emailAccountId=jQuery(this).attr("data-id");
       delete_email(emailAccountId,'delete_account_email');
       return false;
    });
	function delete_email(emailAccountId,action){
         var data = {
        'action' : action,
        'form_data': {'accountEmailAddressID':emailAccountId}
    };

    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0)
    {
        localStorage.setItem("Status",'delete-email');
    window.location.reload();
    } else if(response.errors.length>0)
    {
        jQuery('.account-email-address').addClass('alert-danger');
					jQuery('.account-email-address').removeClass('alert-success');
					jQuery('.account-email-address').text('Someting Went Wrong').show();
                    jQuery('html, body').animate({
    scrollTop: jQuery(".account-email-address").offset().top
}, 1000);
    }


    } );

    }
    
    /********************** Add Email Address ********************/
    
    jQuery(document).on('submit','#add_modal_email_address',function(e){
        e.preventDefault();
        var form_data = jQuery(this).serializeArray();
        add_email(form_data);
        return false;
    });
    
    function add_email(form_data){
         var data = {
        'action' : 'add_email_address',
        'form_data': form_data
    };

    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0){
        localStorage.setItem("Status",'add-email');
    window.location.reload();
    } else
    {
        jQuery('.add-email-errors').html('');
        error_msg(response.errors,'add-email-errors');
        jQuery('.add-email-errors').show();
        jQuery('#exampleModal').modal('toggle');
    }

    } );

    }
    
    
    
    /********************** End Email Address ********************/
    
/************************end delete email******************************** */

    /*************************set primary address*********************************** */
	jQuery(document).on('click','.set-primary-emailAddress',function(e){
        e.preventDefault();
		var emailAccountId=jQuery(this).attr("data-id");
        set_primary_email(emailAccountId,'set_primary_email');
       return false;
    });
	function set_primary_email(emailAccountId,action){
         var data = {
        'action' : action,
        'form_data': {'accountEmailAddressID':emailAccountId}
    };

    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0)
    {
        localStorage.setItem("Status",'set-primary-email')
    window.location.reload();
    
    } else if(response.failureActions || response.errors.length>0)
    {
        jQuery('.account-email-address').addClass('alert-danger');
					jQuery('.account-email-address').removeClass('alert-success');
					jQuery('.account-email-address').text('Someting Went Wrong').show();
                    jQuery('html, body').animate({
                    scrollTop: jQuery(".account-email-address").offset().top }, 1000);
    }   } );

    }
/************************end set primary address******************************** */


/******************************** End Email Address Section on My Account ******************************* */






jQuery(document).ready(function(){
    //get it if Status key found
    if(localStorage.getItem("Status")=='succes')
    {
        jQuery('.show-password-msg').show();
        localStorage.clear();
    }
    if(localStorage.getItem("Status")=='error')
    {
        jQuery('.show-error-msg').show();
        localStorage.clear();
    }



    jQuery("#confirm-password").keyup(function(){
             if (jQuery("#reg-password").val() != jQuery("#confirm-password").val()) {
				jQuery("#msg").html("Password do not match").css("color","red");
             }else{
				jQuery("#msg").html("Password matched").css("color","green");
            }
	  });
	function change_password(form_data,action){
         var data = {
        'action' : action,
        'form_data': form_data
    };
    //console.log(ajax_url);
    jQuery.post(ajax_url, data, function( result ) {
       // alert(result);
   // console.log(result);
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0)
    { 
        // setTimeout(function(){
        //     jQuery('.show-password-msg').show();
        //  }, 3000);
         localStorage.setItem("Status",'succes')
    window.location.reload();
    
       // window.location.reload();
    } else if(response.failureActions.length>0)
    {localStorage.setItem("Status",'error')
    window.location.reload();
        // setTimeout(function(){
        //     jQuery('.show-error-msg').show();
        //  }, 3000);
        
        // window.location.reload();
    }
	//window.location.reload();
    } );
        
    }
    jQuery(document).on('submit','#change_password',function(e){
        e.preventDefault();
		var error_require = 0;
       var form_data = jQuery('#change_password').serializeArray();
			 jQuery('#change_password .required').each(function(){
				 var inputval = jQuery(this).val();
				 if(inputval == '') {
					 error_require = 1;
					 jQuery(this).addClass('is-invalid');
				 } else{
					 jQuery(this).removeClass('is-invalid');
				 }
			 });
       var form_data = jQuery('#change_password').serializeArray(); 
       var action = jQuery('#change_password').attr('action');
	   if(error_require == 0) {
        change_password(form_data,action);
			 }
       
       return false;
    });
    });
    
    
 /******************************** Start Login and registration on My Account ******************************* */
    jQuery(document).on('keypress','.numfieldvalidate',function(evt){
               var iKeyCode = (evt.which) ? evt.which : evt.keyCode;
               
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    });
 
   
    
    jQuery(document).ready(function(){        
        jQuery("#confirm-password").keyup(function(){
             if (jQuery("#reg-password").val() != jQuery("#confirm-password").val()) {
				jQuery("#msg").html("Password do not match").css("color","red");
             }else{
				//jQuery("#msg").html("Password matched").css("color","green");
                                jQuery("#msg").html(" ");
            }
	  });

	  jQuery("#register-email-confirm").keyup(function(){
             if (jQuery("#register-email").val() != jQuery("#register-email-confirm").val()) {
				jQuery("#email-msg").html("Email do not match").css("color","red");
             }else{
				//jQuery("#email-msg").html("Email matched").css("color","green");
                                jQuery("#email-msg").html(" ");
            }
	  });
    });


		jQuery(document).on('submit','.login_register',function(e){
	   e.preventDefault();
	   var error_require = 0;
       var form_data = jQuery(this).serializeArray();
       var action = jQuery(this).attr('action');
	   jQuery('.accounterror').hide();
	   jQuery('#login_form .required').each(function(){
				 var inputval = jQuery(this).val();
				 if(inputval == '') {
					 error_require = 1;
					 jQuery(this).addClass('is-invalid');
				 } else{
					 jQuery(this).removeClass('is-invalid');
				 }
			 });
			 if(error_require == 0) {
                 
				user_login_register(form_data,action);
			 }

       return false;
	});

	function user_login_register(form_data,action){
         var data = {
        'action' : action,
        'form_data': form_data
    };
    jQuery.post(ajax_url, data, function( result ) {
        var response = jQuery.parseJSON(result);
       
		if(action=='user_login')
			{
		if(response.token){
					window.location.reload();
		} else {
			jQuery('.accountregerror').hide();
			jQuery('.accounterror').text(response.errors.emailAddress[0]).show();
			}
		}
			else if(action=='user_register')
			{
				if(response.successfulActions.length>0){
					jQuery('.accountregerror').removeClass('alert-danger');
					jQuery('.accountregerror').addClass('alert-success');
					jQuery('.accountregerror').text('Account created succesfully').show();
					setTimeout(function(){
						window.location.reload();
			 }, 3000);

			}
		 else {
				jQuery('.accountregerror').text(response.errors.emailAddress[0]).show();
			}
		}
    } );

	}


	jQuery(document).on('submit','.account_register',function(e){
	   e.preventDefault();
	   var error_require = 0;
       var form_data = jQuery(this).serializeArray();
       var action = jQuery(this).attr('action');
	   jQuery('.accountregerror').hide();
	   jQuery('#create-account .required').each(function(){
				 var inputval = jQuery(this).val();
				 if(inputval == '') {
					 error_require = 1;
					 jQuery(this).addClass('is-invalid');
				 } else{
					 jQuery(this).removeClass('is-invalid');
				 }
			 });
			 if(error_require == 0) {
                // console.log(form_data);
				user_login_register(form_data,action);
			 }

       return false;
	});
 /******************************** End Login and registration on My Account ******************************* */


 /******************************** Start Profile Update on My Account ******************************* */
function profile_update(form_data,action){
         var data = {
        'action' : action,
        'form_data': form_data
    };
    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0)
    {
    localStorage.setItem("Status",'profile-update')
    window.location.reload(); 
    } else if(response.errors.length>0)
    {
		localStorage.setItem("Status",'profile-error')
    window.location.reload(); 
    }
	//window.location.reload();
    } );

    }
    /*************************Adding Account Address ************************************** */
    jQuery(document).on('submit','#update_profile_account',function(e){
        e.preventDefault();
		var error_require = 0;
       var form_data = jQuery('#update_profile_account').serializeArray();
			 jQuery('#update_profile_account .required').each(function(){
				 var inputval = jQuery(this).val();
				 if(inputval == '') {
					 error_require = 1;
					 jQuery(this).addClass('is-invalid');
				 } else{
					 jQuery(this).removeClass('is-invalid');
				 }
			 });
       var action = jQuery('#update_profile_account').attr('action');
	   if(error_require == 0) {
		      profile_update(form_data,action);
			 }

       return false;
    });
    
    /******************************** End Profile Update on My Account ******************************* */
      
    
    /******************************** Start Manage Phone Number on My Account ******************************* */
    jQuery(document).ready(function(){
    //get it if Status key found
    if(localStorage.getItem("Status")=='delete-phone')
    {
        jQuery('.account-phone-number').show().delay(8000).fadeOut();
        localStorage.clear();
    }


    if(localStorage.getItem("Status")=='set-primary-phone')
    {
        jQuery('.primary-phone').show().delay(8000).fadeOut();
        localStorage.clear();
    }
    if(localStorage.getItem("Status")=='add-phone')
    {
        jQuery('.add-phone').show().delay(8000).fadeOut();
        localStorage.clear();
    }
});





 /*************************delete phone*********************************** */
	jQuery(document).on('click','.delete-phoneNumber',function(e){
        e.preventDefault();
		var phoneAccountId=jQuery(this).attr("data-id");
       delete_phone(phoneAccountId,'delete_account_phone');
       return false;
    });
	function delete_phone(phoneAccountId,action){
         var data = {
        'action' : action,
        'form_data': {'accountPhoneNumberID':phoneAccountId}
    };

    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0)
    {
        localStorage.setItem("Status",'delete-phone');
    window.location.reload();
    } else if(response.errors.length>0)
    {
        jQuery('.account-phone-number').addClass('alert-danger');
					jQuery('.account-phone-number').removeClass('alert-success');
					jQuery('.account-phone-number').text('Someting Went Wrong').show();
                    jQuery('html, body').animate({
    scrollTop: jQuery(".account-phone-number").offset().top
}, 1000);
    }


    } );

    }
/************************end delete phone******************************** */

    /*************************set primary phone*********************************** */
	jQuery(document).on('click','.set-primary-phoneNumber',function(e){
        e.preventDefault();
		var phoneAccountId=jQuery(this).attr("data-id");
        set_primary_phone(phoneAccountId,'set_primary_phone');
       return false;
    });
	function set_primary_phone(phoneAccountId,action){
         var data = {
        'action' : action,
        'form_data': {'accountPhoneNumberID':phoneAccountId}
    };


    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0)
    {
        localStorage.setItem("Status",'set-primary-phone');
    window.location.reload();
    } else if(response.errors.length>0)
    {
        jQuery('.account-phone-number').addClass('alert-danger');
					jQuery('.account-phone-number').removeClass('alert-success');
					jQuery('.account-phone-number').text('Someting Went Wrong').show();
                    jQuery('html, body').animate({
                    scrollTop: jQuery(".account-phone-number").offset().top }, 1000);
    }   } );

    }
/************************end set primary phone******************************** */

/************************add phone******************************** */
jQuery(document).on('submit','#add_account_phone_number',function(e){
        e.preventDefault();
		var phoneNumber=jQuery(this).find('input[name=phoneNumber]').val();
        add_phone(phoneNumber);
       return false;
    });

    function add_phone(phoneNumber){
         var data = {
        'action' : 'add_account_phone_number',
        'phoneNumber': phoneNumber
    };


    jQuery.post(ajax_url, data, function( result ) {
    var response = jQuery.parseJSON(result);
    if(response.successfulActions.length>0)
    {
        localStorage.setItem("Status",'add-phone');
    window.location.reload();
    } else
    {
        jQuery('.phone-number-errors').html('');
        error_msg(response.errors,'phone-number-errors');
        jQuery('.phone-number-errors').show();
        jQuery('#exampleModal').modal('toggle');
    }
    });

    }
/************************end add phone******************************** */

/******************************** Start Manage Phone Number on My Account ******************************* */

/************************Start Filter as per url parameters ******************************** */
jQuery(document).ready(function(){
    if(findGetParameter('typeID') || findGetParameter('brand_brandID') || findGetParameter('categoryID')){
    var sorting = jQuery('.sorting a.active').attr('data-value');
            var form_data = jQuery("#sidebar_form").serializeArray();
            // set ajax data
           filter_ajax(form_data,1,sorting);
}
});
/************************End Filter as per url parameters ******************************** */
jQuery(document).ready(function(){

    jQuery(document).on('click', '.print' , function(e) {
  
    jQuery('.printarea').printThis({
      importStyle: jQuery(this).hasClass('importStyle')
    });
  });
     });

(function($) {

    function appendContent($el, content) {
        if (!content) return;

        // Simple test for a jQuery element
        $el.append(content.jquery ? content.clone() : content);
    }

    function appendBody($body, $element, opt) {
        // Clone for safety and convenience
        // Calls clone(withDataAndEvents = true) to copy form values.
        var $content = $element.clone(opt.formValues);

        if (opt.formValues) {
            // Copy original select and textarea values to their cloned counterpart
            // Makes up for inability to clone select and textarea values with clone(true)
            copyValues($element, $content, 'select, textarea');
        }

        if (opt.removeScripts) {
            $content.find('script').remove();
        }

        if (opt.printContainer) {
            // grab $.selector as container
            $content.appendTo($body);
        } else {
            // otherwise just print interior elements of container
            $content.each(function() {
                $(this).children().appendTo($body)
            });
        }
    }

    // Copies values from origin to clone for passed in elementSelector
    function copyValues(origin, clone, elementSelector) {
        var $originalElements = origin.find(elementSelector);

        clone.find(elementSelector).each(function(index, item) {
            $(item).val($originalElements.eq(index).val());
        });
    }

    var opt;
    $.fn.printThis = function(options) {
        opt = $.extend({}, $.fn.printThis.defaults, options);
        var $element = this instanceof jQuery ? this : $(this);

        var strFrameName = "printThis-" + (new Date()).getTime();

        if (window.location.hostname !== document.domain && navigator.userAgent.match(/msie/i)) {
            // Ugly IE hacks due to IE not inheriting document.domain from parent
            // checks if document.domain is set by comparing the host name against document.domain
            var iframeSrc = "javascript:document.write(\"<head><script>document.domain=\\\"" + document.domain + "\\\";</s" + "cript></head><body></body>\")";
            var printI = document.createElement('iframe');
            printI.name = "printIframe";
            printI.id = strFrameName;
            printI.className = "MSIE";
            document.body.appendChild(printI);
            printI.src = iframeSrc;

        } else {
            // other browsers inherit document.domain, and IE works if document.domain is not explicitly set
            var $frame = $("<iframe id='" + strFrameName + "' name='printIframe' />");
            $frame.appendTo("body");
        }

        var $iframe = $("#" + strFrameName);

        // show frame if in debug mode
        if (!opt.debug) $iframe.css({
            position: "absolute",
            width: "0px",
            height: "0px",
            left: "-600px",
            top: "-600px"
        });

        // $iframe.ready() and $iframe.load were inconsistent between browsers
        setTimeout(function() {

            // Add doctype to fix the style difference between printing and render
            function setDocType($iframe, doctype){
                var win, doc;
                win = $iframe.get(0);
                win = win.contentWindow || win.contentDocument || win;
                doc = win.document || win.contentDocument || win;
                doc.open();
                doc.write(doctype);
                doc.close();
            }

            if (opt.doctypeString){
                setDocType($iframe, opt.doctypeString);
            }

            var $doc = $iframe.contents(),
                $head = $doc.find("head"),
                $body = $doc.find("body"),
                $base = $('base'),
                baseURL;

            // add base tag to ensure elements use the parent domain
            if (opt.base === true && $base.length > 0) {
                // take the base tag from the original page
                baseURL = $base.attr('href');
            } else if (typeof opt.base === 'string') {
                // An exact base string is provided
                baseURL = opt.base;
            } else {
                // Use the page URL as the base
                baseURL = document.location.protocol + '//' + document.location.host;
            }

            $head.append('<base href="' + baseURL + '">');

            // import page stylesheets
            if (opt.importCSS) $("link[rel=stylesheet]").each(function() {
                var href = $(this).attr("href");
                if (href) {
                    var media = $(this).attr("media") || "all";
                    $head.append("<link type='text/css' rel='stylesheet' href='" + href + "' media='" + media + "'>");
                }
            });

            // import style tags
            if (opt.importStyle) $("style").each(function() {
                $head.append(this.outerHTML);
            });

            // add title of the page
            if (opt.pageTitle) $head.append("<title>" + opt.pageTitle + "</title>");

            // import additional stylesheet(s)
            if (opt.loadCSS) {
                if ($.isArray(opt.loadCSS)) {
                    jQuery.each(opt.loadCSS, function(index, value) {
                        $head.append("<link type='text/css' rel='stylesheet' href='" + this + "'>");
                    });
                } else {
                    $head.append("<link type='text/css' rel='stylesheet' href='" + opt.loadCSS + "'>");
                }
            }

            // copy 'root' tag classes
            var tag = opt.copyTagClasses;
            if (tag) {
                tag = tag === true ? 'bh' : tag;
                if (tag.indexOf('b') !== -1) {
                    $body.addClass($('body')[0].className);
                }
                if (tag.indexOf('h') !== -1) {
                    $doc.find('html').addClass($('html')[0].className);
                }
            }

            // print header
            appendContent($body, opt.header);

            if (opt.canvas) {
                // add canvas data-ids for easy access after cloning.
                var canvasId = 0;
                // .addBack('canvas') adds the top-level element if it is a canvas.
                $element.find('canvas').addBack('canvas').each(function(){
                    $(this).attr('data-printthis', canvasId++);
                });
            }

            appendBody($body, $element, opt);

            if (opt.canvas) {
                // Re-draw new canvases by referencing the originals
                $body.find('canvas').each(function(){
                    var cid = $(this).data('printthis'),
                        $src = $('[data-printthis="' + cid + '"]');

                    this.getContext('2d').drawImage($src[0], 0, 0);

                    // Remove the markup from the original
                    $src.removeData('printthis');
                });
            }

            // remove inline styles
            if (opt.removeInline) {
                // $.removeAttr available jQuery 1.7+
                if ($.isFunction($.removeAttr)) {
                    $doc.find("body *").removeAttr("style");
                } else {
                    $doc.find("body *").attr("style", "");
                }
            }

            // print "footer"
            appendContent($body, opt.footer);

            setTimeout(function() {
                if ($iframe.hasClass("MSIE")) {
                    // check if the iframe was created with the ugly hack
                    // and perform another ugly hack out of neccessity
                    window.frames["printIframe"].focus();
                    $head.append("<script>  window.print(); </s" + "cript>");
                } else {
                    // proper method
                    if (document.queryCommandSupported("print")) {
                        $iframe[0].contentWindow.document.execCommand("print", false, null);
                    } else {
                        $iframe[0].contentWindow.focus();
                        $iframe[0].contentWindow.print();
                    }
                }

                // remove iframe after print
                if (!opt.debug) {
                    setTimeout(function() {
                        $iframe.remove();
                    }, 1000);
                }

            }, opt.printDelay);

        }, 333);

    };

    // defaults
    $.fn.printThis.defaults = {
        debug: false,           // show the iframe for debugging
        importCSS: true,        // import parent page css
        importStyle: false,     // import style tags
        printContainer: true,   // print outer container/$.selector
        loadCSS: "",            // load an additional css file - load multiple stylesheets with an array []
        pageTitle: "",          // add title to print page
        removeInline: false,    // remove all inline styles
        printDelay: 333,        // variable print delay
        header: null,           // prefix to html
        footer: null,           // postfix to html
        formValues: true,       // preserve input/form values
        canvas: false,          // copy canvas content (experimental)
        base: false,            // preserve the BASE tag, or accept a string for the URL
        doctypeString: '<!DOCTYPE html>', // html doctype
        removeScripts: false,   // remove script tags before appending
        copyTagClasses: false   // copy classes from the html & body tag
    };
})(jQuery);

