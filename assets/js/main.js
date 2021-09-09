( function( $, elementorFrontend ) {

	"use strict";

	let JetWooBuilderCQS = {
		init: function () {
			let widgets = {
				'jet-woo-products.default' : JetWooBuilderCQS.quantitySelector,
				'jet-single-add-to-cart.default' : JetWooBuilderCQS.quantitySelector,
				'jet-woo-products-list.default' : JetWooBuilderCQS.quantitySelector,
				'jet-woo-builder-archive-add-to-cart.default' : JetWooBuilderCQS.quantitySelector
			};

			$.each( widgets, function( widget, callback ) {
				elementorFrontend.hooks.addAction( 'frontend/element_ready/' + widget, callback );
			});
		},

		quantitySelector: function ( $scope ) {
			let settings = $scope.data( 'settings' );

			if ( settings && settings.enable_custom_quantity_selector ) {
				let $quantityWrap = $scope.find( '.quantity:not(.buttons_added)' ),
					increaseControl = settings.selected_quantity_increase_button_icon.value,
					decreaseControl = settings.selected_quantity_decrease_button_icon.value,
					increaseHtml = '',
					decreaseHtml = '';

				if ( 'object' === typeof increaseControl ) {
					increaseHtml = '<img src="' + increaseControl.url + '" alt="increase icon">';
				} else {
					increaseHtml = '<i class="' + increaseControl + '"></i>';
				}

				if ( 'object' === typeof decreaseControl ) {
					decreaseHtml = '<img src="' + decreaseControl.url + '" alt="decrease icon">';
				} else {
					decreaseHtml = '<i class="' + decreaseControl + '"></i>';
				}

				$quantityWrap.each( function () {
					let $quantityBox = $( this ).find( '.qty' );

					if ( $quantityBox && 'date' !== $quantityBox.attr( 'type' ) && 'hidden' !== $quantityBox.attr( 'type' ) ) {
						let $quantityParent = $quantityBox.parent();

						$quantityParent.addClass( 'jet-woo-quantity-button-added direction-' + settings.quantity_buttons_position );

						switch ( settings.quantity_buttons_position ) {
							case 'horizontal':
							case 'vertical':
								$quantityParent.prepend( '<a href="javascript:void(0)" class="jet-woo-qty-control decrease">' + decreaseHtml + '</a>' );
								$quantityParent.append( '<a href="javascript:void(0)" class="jet-woo-qty-control increase">' + increaseHtml + '</a>' );

								break;
							case 'start':
							case 'top':
								$quantityParent.prepend( '<div class="jet-woo-qty-controls-holder"><a href="javascript:void(0)" class="jet-woo-qty-control increase">' + increaseHtml + '</a><a href="javascript:void(0)" class="jet-woo-qty-control decrease">' + decreaseHtml + '</a></div>');
								break;
							case 'end':
							case 'bottom':
								$quantityParent.append( '<div class="jet-woo-qty-controls-holder"><a href="javascript:void(0)" class="jet-woo-qty-control increase">' + increaseHtml + '</a><a href="javascript:void(0)" class="jet-woo-qty-control decrease">' + decreaseHtml + '</a></div>');
								break;
						}

						let $min = $quantityBox.attr( 'min' );

						if ( $min && $min > 0 && parseFloat( $quantityBox.val() ) < $min ) {
							$quantityBox.val( $min );
						}

						let increaseDecreaseObject = $( this ).find( '.jet-woo-qty-control' );

						increaseDecreaseObject.each( function () {
							$( this ).on( 'click', function( e ) {
								e.preventDefault();

								let $currentQuantityValue = $quantityBox.val(),
									$maxQuantity = $quantityBox.attr( 'max' ),
									$minQuantity = $quantityBox.attr( 'min' ),
									$step = $quantityBox.attr( 'step ');

								if ( ! $currentQuantityValue || '' === $currentQuantityValue || 'NaN' === $currentQuantityValue ) {
									$currentQuantityValue = 0;
								}

								if ( '' === $maxQuantity || 'NaN' === $maxQuantity ) {
									$maxQuantity = '';
								}

								if ( '' === $minQuantity || 'NaN' === $minQuantity ) {
									$minQuantity = 0;
								}

								if ( 'any' === $step || '' === $step || undefined === $step || 'NaN' === $step ) {
									$step = 1;
								}

								let dataQuantity = $( e.target ).parents( 'form.cart' ).find( 'button[ data-quantity ]' );

								if ( $( e.target ).parent().hasClass( 'increase' ) || $( e.target ).hasClass( 'increase' ) ) {
									if ( $maxQuantity && ( $maxQuantity === $currentQuantityValue || $currentQuantityValue > $maxQuantity ) ) {
										$quantityBox.val( $maxQuantity );
									} else {
										let increaseValue = parseFloat( $currentQuantityValue ) + parseFloat( $step );

										$quantityBox.val( increaseValue );
										dataQuantity.attr( 'data-quantity', increaseValue );
									}
								} else {
									if ( $minQuantity && ( $minQuantity === $currentQuantityValue || $currentQuantityValue < $minQuantity ) ) {
										$quantityBox.val( $minQuantity );
									} else if ( $currentQuantityValue > 0 ) {
										let decreaseValue = parseFloat( $currentQuantityValue ) - parseFloat( $step );

										$quantityBox.val( decreaseValue );
										dataQuantity.attr( 'data-quantity', decreaseValue );
									}
								}
							} );
						} );
					}
				} );
			}
		}
	};

	$( window ).on( 'elementor/frontend/init', JetWooBuilderCQS.init );

}( jQuery, window.elementorFrontend ) );