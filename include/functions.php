<?php
// add sub menu page to the woocommerce menu
add_action( 'admin_menu', 'woo_change_add_to_cart_text_settings_page_func' );
function woo_change_add_to_cart_text_settings_page_func() {
    add_submenu_page( 'woocommerce', __( 'Change Add to Cart Text', 'woocatct' ), __( 'Add to Cart Text Change', 'woocatct' ), 'manage_options', 'woo-change-add-to-cart-text', 'woo_change_add_to_cart_text_settings_page_callback' );
}

add_action('admin_enqueue_scripts', 'woocatct_admin_enqueue_scripts');
function woocatct_admin_enqueue_scripts(){
  if ( isset( $_GET["page"] ) &&  $_GET["page"] == "woo-change-add-to-cart-text" ){     
    wp_enqueue_style('woocatct_admin_style', plugins_url('admin/css/style.css', dirname(__FILE__) ) );
	wp_enqueue_script( "woocatct-admin-script", plugins_url('admin/js/main.js', dirname(__FILE__) ), array("jquery"), '1.0.0', true );
  }
}

// Add settings page HTML
function woo_change_add_to_cart_text_settings_page_callback() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
			<?php wp_nonce_field( 'update-options' ); ?>
			<div class="woocatct_dashboardWrapper">
				<div class="woocatct_form_group">
					<div class="woocatct_global_txt_outer_wrap">
						<div class="woocatct_field">
							<label for="woocatct_global_txt"><?php print _e( 'Global' ); ?></label>
							<input type="text" id="woocatct_global_txt" name="woocatct_global_txt" value="<?php print get_option( 'woocatct_global_txt' ); ?>" placeholder="<?php print _e( 'Add to Cart' ); ?>">
							<small>Archive and Single both places are replace from here.</small>
						</div>
					</div>
					<div class="woocatct_field">
						<label for="woocatct_global_txt_diff">
							<input type="checkbox" name="woocatct_global_txt_diff" id="woocatct_global_txt_diff" value="1" <?php checked( get_option( 'woocatct_global_txt_diff' ), 1 ); ?>>
							<span>Different text for Archive and Single page</span>
						</label>
					</div>
				</div>
				<div class="woocatct_diff_txt_archive_single">
					<div class="woocatct_row">
						<div class="woocatct_col-6">
							<div class="woocatct_archive_options">
								<div class="woocatct_archive_option_main">
									<div class="woocatct_field">
										<label for="woocatct_archive_txt"><?php print _e( 'Archive' ); ?></label>
										<input type="text" id="woocatct_archive_txt" name="woocatct_archive_txt" value="<?php print get_option( 'woocatct_archive_txt' ); ?>" placeholder="<?php print _e( 'Add to Cart' ); ?>">
										<small>All Archive products</small>
									</div>
								</div>
								<div class="woocatct_field">
									<label for="woocatct_product_type_txt_diff_archive">
										<input type="checkbox" name="woocatct_product_type_txt_diff_archive" id="woocatct_product_type_txt_diff_archive" value="1" <?php checked( get_option( 'woocatct_product_type_txt_diff_archive' ), 1 ); ?>>
										<span>Different Text for Different product types Archive</span>
									</label>
								</div>
								<?php 
								$product_types = wc_get_product_types();
								$page_options = '';
								if($product_types){?>
								<div class="woocatct_product_type_items_archive">
									<div class="woocatct_row">
										<?php 
										foreach( $product_types as $key => $value ){
											$keyOption = 'woocatct_archive_'.$key.'_txt';
											$page_options .= $keyOption.', ';
											if($key == 'external'){ ?>
												<div class="woocatct_col-6">
													<div class="woocatct_field">
														<label for="<?php echo $keyOption; ?>"><?php print _e( $value ); ?></label>
														<input type="text" id="<?php echo $keyOption; ?>" name="<?php echo $keyOption; ?>" value="<?php print get_option( $keyOption ); ?>">
														<small>if keep Empty, Text come form "Button text" Field</small>
													</div>
												</div>
												<?php 
												}else{?>
												<div class="woocatct_col-6">
													<div class="woocatct_field">
														<label for="<?php echo $keyOption; ?>"><?php print _e( $value ); ?></label>
														<input type="text" id="<?php echo $keyOption; ?>" name="<?php echo $keyOption; ?>" value="<?php print get_option( $keyOption ); ?>" placeholder="<?php print _e( 'Add to Cart' ); ?>">
													</div>
												</div>
											<?php
											}
										}?>
									</div>
								</div>
								<?php }?>
							</div>
						</div>
						<div class="woocatct_col-6">
							<div class="woocatct_single_options">
								<div class="woocatct_single_options_main">
									<div class="woocatct_field">
										<label for="woocatct_single_txt"><?php print _e( 'Single' ); ?></label>
										<input type="hidden" name="page_options" value="woocatct_single_txt">
										<input type="text" id="woocatct_single_txt" name="woocatct_single_txt" value="<?php print get_option( 'woocatct_single_txt' ); ?>" placeholder="<?php print _e( 'Add to Cart' ); ?>">
										<small>All Single products</small>
									</div>
								</div>								
								<div class="woocatct_field">
									<label for="woocatct_product_type_txt_diff_single">
										<input type="checkbox" name="woocatct_product_type_txt_diff_single" id="woocatct_product_type_txt_diff_single" value="1" <?php checked( get_option( 'woocatct_product_type_txt_diff_single' ), 1 ); ?>>
										<span>Different Text for Different product types Single Page</span>
									</label>
								</div>
								<?php
								if($product_types){?>
								<div class="woocatct_product_type_items_single">
									<div class="woocatct_row">
										<?php foreach( $product_types as $key => $value ){
											$keyOption = 'woocatct_single_'.$key.'_txt';
											$page_options .= $keyOption.', ';
											if($key == 'external'){ ?>
											<div class="woocatct_col-6">
												<div class="woocatct_field">
													<label for="<?php echo $keyOption; ?>"><?php print _e( $value ); ?></label>
													<input type="hidden" name="page_options" value="<?php echo $keyOption; ?>">
													<input type="text" id="<?php echo $keyOption; ?>" name="<?php echo $keyOption; ?>" value="<?php print get_option( $keyOption ); ?>">
													<small>if keep Empty, Text come form "Button text" Field</small>
												</div>
											</div>
											<?php
											}else{?>
											<div class="woocatct_col-6">
												<div class="woocatct_field">
													<label for="<?php echo $keyOption; ?>"><?php print _e( $value ); ?></label>
													<input type="hidden" name="page_options" value="<?php echo $keyOption; ?>">
													<input type="text" id="<?php echo $keyOption; ?>" name="<?php echo $keyOption; ?>" value="<?php print get_option( $keyOption ); ?>" placeholder="<?php print _e( 'Add to Cart' ); ?>">
												</div>
											</div>
											<?php 
											}
										}?>
									</div>
								</div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
				<div class="woocatct_submit_btn">
					<input type="hidden" name="action" value="update">
					<input type="hidden" name="page_options" value="<?php echo $page_options; ?> woocatct_global_txt, woocatct_archive_txt, woocatct_single_txt, woocatct_global_txt_diff, woocatct_product_type_txt_diff_archive, woocatct_product_type_txt_diff_single">
					<input type="submit" value="Save Settings">
				</div>
			</div>
        </form>
    </div>
    <?php
}

 
function woocatct_add_to_cart_button_text_archives_func( $add_to_cart_text, $product ) {
	if( get_option( 'woocatct_global_txt_diff' ) ){
		if( get_option( 'woocatct_product_type_txt_diff_archive' ) ){
			$product_type = $product->get_type();
			if( 1 || $product_type != 'external' ){
				$keyOption = 'woocatct_archive_'.$product_type.'_txt';
				$cartText = get_option( $keyOption );
				if ( !$cartText ){
					$cartText = $add_to_cart_text;
				}
				return __( $cartText, 'woocatct' );
			}
		}else{
			$cartText = get_option( 'woocatct_archive_txt' );
			if( !$cartText ){
				$cartText = $add_to_cart_text;
			}
			return __( $cartText, 'woocatct' );
		}
	}else{
		$cartText = get_option( 'woocatct_global_txt' );
		if( !$cartText ){
			$cartText = $add_to_cart_text;
		}
		return __( $cartText, 'woocatct' );
	}
}
add_filter( 'woocommerce_product_add_to_cart_text', 'woocatct_add_to_cart_button_text_archives_func', 10, 2); 


function woocatct_add_to_cart_button_text_single_func( $add_to_cart_text, $product ) {
	if( get_option( 'woocatct_global_txt_diff' ) ){
		if( get_option( 'woocatct_product_type_txt_diff_single' ) ){
			$product_type = $product->get_type();
			if( 1 || $product_type != 'external' ){
				$keyOption = 'woocatct_single_'.$product_type.'_txt';
				$cartText = get_option( $keyOption );
				if ( !$cartText ){
					$cartText = $add_to_cart_text;
				}
				return __( $cartText, 'woocatct' );
			}
		}else{
			$cartText = get_option( 'woocatct_single_txt' );
			if( !$cartText ){
				$cartText = $add_to_cart_text;
			}
			return __( $cartText, 'woocatct' );
		}
	}else{
		$cartText = get_option( 'woocatct_global_txt' );
		if( !$cartText ){
			$cartText = $add_to_cart_text;
		}
		return __( $cartText, 'woocatct' );
	}
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocatct_add_to_cart_button_text_single_func', 10, 2); 
