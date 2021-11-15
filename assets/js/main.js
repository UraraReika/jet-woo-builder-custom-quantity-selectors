( function( $, elementorFrontend ) {

	"use strict";

	let JetWooBuilderCQS = {
		init: function () {
			let widgets = {
				'jet-woo-products.default' : JetWooBuilderCQS.quantitySelector,
				'jet-single-add-to-cart.default' : JetWooBuilderCQS.quantitySelector,
				'jet-woo-products-list.default' : JetWooBuilderCQS.quantitySelector,
				'jet-woo-builder-archive-add-to-cart.default' : JetWooBuilderCQS.quantitySelector,
				'jet-cart-table.default' : JetWooBuilderCQS.quantitySelector
			};

			$.each( widgets, function( widget, callback ) {
				elementorFrontend.hooks.addAction( 'frontend/element_ready/' + widget, callback );
			});

			( function() {
				let send = XMLHttpRequest.prototype.send
				XMLHttpRequest.prototype.send = function() {
					this.addEventListener( 'load', function() {
						JetWooBuilderCQS.reInitQuantitySelector( '.quantity:not(.jet-woo-quantity-button-added)' );
					} )

					return send.apply(this, arguments)
				}
			} )();

		},

		quantitySelector: function ( $scope ) {
			let settings = JetWooBuilderCQS.getElementorElementSettings( $scope );

			if ( settings && settings.enable_custom_quantity_selector ) {
				let $quantityWrap = $scope.find( '.quantity:not(.jet-woo-quantity-button-added)' ),
					increaseControl = settings.selected_quantity_increase_button_icon.value,
					decreaseControl = settings.selected_quantity_decrease_button_icon.value,
					controlsPosition = settings.quantity_buttons_position,
					increaseHtml = '',
					decreaseHtml = '';

				if ( 'object' === typeof increaseControl ) {
					increaseHtml = '<img class="icon-svg" src="' + increaseControl.url + '" alt="increase icon">';
				} else {
					increaseHtml = '<i class="' + increaseControl + '"></i>';
				}

				if ( 'object' === typeof decreaseControl ) {
					decreaseHtml = '<img class="icon-svg" src="' + decreaseControl.url + '" alt="decrease icon">';
				} else {
					decreaseHtml = '<i class="' + decreaseControl + '"></i>';
				}

				$quantityWrap.each( function () {
					let $quantityBox = $( this ).find( '.qty' );

					if ( $quantityBox && 'date' !== $quantityBox.attr( 'type' ) && 'hidden' !== $quantityBox.attr( 'type' ) ) {
						let $quantityParent = $quantityBox.parent();

						$quantityParent.addClass( 'jet-woo-quantity-button-added position-' + controlsPosition );

						switch ( controlsPosition ) {
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

						$( this ).find( '.icon-svg' ).each( function() {
							let img = $( this ),
								image_uri   = img.attr( 'src' );

							$.get( image_uri, function( data ) {
								let svg = $( data ).find( 'svg' );

								svg.removeAttr( 'xmlns:a' );
								img.replaceWith( svg );
							}, 'xml' );
						} );

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
									$step = $quantityBox.attr( 'step' );

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

								if ( $( e.target ).parent().hasClass( 'increase' ) || $( e.target ).hasClass( 'increase' ) ) {
									if ( +$maxQuantity && ( +$maxQuantity === +$currentQuantityValue || +$currentQuantityValue > +$maxQuantity ) ) {
										$quantityBox.val( $maxQuantity );
									} else {
										$quantityBox.val( parseFloat( $currentQuantityValue ) + parseFloat( $step ) );
									}
								} else {
									if ( +$minQuantity && ( +$minQuantity === +$currentQuantityValue || +$currentQuantityValue < +$minQuantity ) ) {
										$quantityBox.val( $minQuantity );
									} else if ( $currentQuantityValue > 0 ) {
										$quantityBox.val( parseFloat( $currentQuantityValue ) - parseFloat( $step ) );
									}
								}

								// Trigger change event.
								$quantityBox.trigger( 'change' );
							} );
						} );
					}
				} );
			}
		},

		getElementorElementSettings: function( $scope ) {

			if ( window.elementorFrontend && window.elementorFrontend.isEditMode() ) {
				return JetWooBuilderCQS.getEditorElementSettings( $scope );
			}

			return $scope.data( 'settings' ) || {};

		},

		getEditorElementSettings: function( $scope ) {

			var modelCID = $scope.data( 'model-cid' ),
				elementData;

			if ( ! modelCID ) {
				return {};
			}

			if ( ! window.elementorFrontend.hasOwnProperty( 'config' ) ) {
				return {};
			}

			if ( ! window.elementorFrontend.config.hasOwnProperty( 'elements' ) ) {
				return {};
			}

			if ( ! window.elementorFrontend.config.elements.hasOwnProperty( 'data' ) ) {
				return {};
			}

			elementData = window.elementorFrontend.config.elements.data[ modelCID ];

			if ( ! elementData ) {
				return {};
			}

			return elementData.toJSON();

		},

		reInitQuantitySelector: function ( element ) {
			JetWooBuilderCQS.quantitySelector( $( element ).closest( '.elementor-element' ) );
		}
	};

	$( window ).on( 'elementor/frontend/init', JetWooBuilderCQS.init );

}( jQuery, window.elementorFrontend ) );