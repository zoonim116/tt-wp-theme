<?php extract( $template_args ); ?>

<nav class="navbar main-navbar" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
		<a class="navbar-item" href="<?php echo home_url(); ?>">
			<img src="<?php echo get_template_directory_uri(); ?>/images/TechTop_logo.svg">
		</a>

		<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
		</a>
	</div>

	<div id="navbarBasicExample" class="navbar-menu">
		<div class="navbar-start-menu navbar-megamenu">
			<ul>
				<?php foreach ($top_categories as $tc): ?>
					<li>
						<a href="<?php echo get_term_link($tc, 'product_cat'); ?>"><?php echo $tc->name?></a>
						<ul style="display: none">
							<?php foreach ($child_categories[$tc->term_id][0] as $index => $cc): ?>
								<li>
									<a href="<?php echo get_term_link($cc, 'product_cat'); ?>">
										<div>
											<img src="<?php echo carbon_get_term_meta($cc->term_id, 'crb_additional_thumb')?>" alt="<?php echo $cc->name; ?>" title="<?php echo $cc->name; ?>">
										</div>
										<span><?php echo $cc->name; ?></span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="navbar-end-menu">
			<div class="navbar-item">
                <?php if (is_user_logged_in()): ?>
                    <div class="balance">
                        <p>יתרת כרטיס</p>
                        <p style="direction: ltr;">...</p>
                    </div>
                <?php endif; ?>
				<ul>
					<li>
                        <?php if (is_user_logged_in()): ?>
                            <a href="<?php echo home_url('my-account/') ?>">
                                <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.9375 2.37179C14.4648 2.37179 16.5208 4.37297 16.5208 6.83364C16.5208 9.29252 14.4648 11.2946 11.9375 11.2946C9.41025 11.2946 7.35417 9.29252 7.35417 6.83364C7.35417 4.37297 9.41025 2.37179 11.9375 2.37179ZM11.9375 0.587402C8.39367 0.587402 5.52083 3.38353 5.52083 6.83364C5.52083 10.282 8.39367 13.079 11.9375 13.079C15.4813 13.079 18.3542 10.282 18.3542 6.83364C18.3542 3.38353 15.4813 0.587402 11.9375 0.587402V0.587402ZM17.7757 12.5008C17.3202 12.9452 16.8068 13.3315 16.2559 13.6625C18.8886 15.3344 20.2691 18.1975 20.8136 20.2165H3.04217C3.5665 18.1734 4.92867 15.3068 7.60075 13.6518C7.048 13.3181 6.53558 12.9282 6.08092 12.4812C2.17775 15.222 0.9375 20.0702 0.9375 22H22.9375C22.9375 20.0889 21.6175 15.2577 17.7757 12.5008Z" fill="#767676"/>
                                </svg>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo home_url('login/') ?>">
                                <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.9375 2.37179C14.4648 2.37179 16.5208 4.37297 16.5208 6.83364C16.5208 9.29252 14.4648 11.2946 11.9375 11.2946C9.41025 11.2946 7.35417 9.29252 7.35417 6.83364C7.35417 4.37297 9.41025 2.37179 11.9375 2.37179ZM11.9375 0.587402C8.39367 0.587402 5.52083 3.38353 5.52083 6.83364C5.52083 10.282 8.39367 13.079 11.9375 13.079C15.4813 13.079 18.3542 10.282 18.3542 6.83364C18.3542 3.38353 15.4813 0.587402 11.9375 0.587402V0.587402ZM17.7757 12.5008C17.3202 12.9452 16.8068 13.3315 16.2559 13.6625C18.8886 15.3344 20.2691 18.1975 20.8136 20.2165H3.04217C3.5665 18.1734 4.92867 15.3068 7.60075 13.6518C7.048 13.3181 6.53558 12.9282 6.08092 12.4812C2.17775 15.222 0.9375 20.0702 0.9375 22H22.9375C22.9375 20.0889 21.6175 15.2577 17.7757 12.5008Z" fill="#767676"/>
                                </svg>
                            </a>
                        <?php endif; ?>
					</li>
					<li class="mini-wishlist">
						<?php 
							unset($_SESSION['wishlist']);
							if (is_null($_SESSION['wishlist'])) {
						        $wishlist_data = User::get_wishlist('ASC');
						        $_SESSION['wishlist'] = $wishlist_data;
						    } else {
						        $wishlist_data = $_SESSION['wishlist'];
						    }
						    // $wishlist_data = User::get_wishlist('ASC');
						?>
						<span class="counter">
							<?php if (count($wishlist_data->OutTab) > 0): ?>
								<span><?php echo count($wishlist_data->OutTab); ?></span>
							<?php endif; ?>
						</span>
						<?php if (is_user_logged_in()): ?>
							<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'wishlist' ) ); ?>">
								<svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.89757 2.33031C8.83939 2.33119 10.4185 5.41921 11.0976 6.78183C11.7794 5.41301 13.3421 2.33915 16.303 2.33915C18.1739 2.33915 20.1885 3.49738 20.1885 6.03947C20.1885 9.08501 15.8758 12.9862 11.0976 17.5421C6.31757 12.9844 2.00666 9.08413 2.00666 6.03947C2.00666 3.67169 3.79302 2.32942 5.89757 2.33031ZM5.89848 0.560669C3.00484 0.560669 0.188477 2.49577 0.188477 6.03947C0.188477 10.1636 5.25211 14.3807 11.0976 20.0267C16.943 14.3807 22.0067 10.1636 22.0067 6.03947C22.0067 2.49046 19.1912 0.569517 16.303 0.569517C14.2994 0.569517 12.2612 1.4915 11.0976 3.43456C9.92939 1.48265 7.89575 0.560669 5.89848 0.560669Z" fill="#767676"/>
								</svg>
							</a>
						<?php else: ?>
							<a href="<?php echo home_url('login/') ?>">
								<svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.89757 2.33031C8.83939 2.33119 10.4185 5.41921 11.0976 6.78183C11.7794 5.41301 13.3421 2.33915 16.303 2.33915C18.1739 2.33915 20.1885 3.49738 20.1885 6.03947C20.1885 9.08501 15.8758 12.9862 11.0976 17.5421C6.31757 12.9844 2.00666 9.08413 2.00666 6.03947C2.00666 3.67169 3.79302 2.32942 5.89757 2.33031ZM5.89848 0.560669C3.00484 0.560669 0.188477 2.49577 0.188477 6.03947C0.188477 10.1636 5.25211 14.3807 11.0976 20.0267C16.943 14.3807 22.0067 10.1636 22.0067 6.03947C22.0067 2.49046 19.1912 0.569517 16.303 0.569517C14.2994 0.569517 12.2612 1.4915 11.0976 3.43456C9.92939 1.48265 7.89575 0.560669 5.89848 0.560669Z" fill="#767676"/>
								</svg>
							</a>
						<?php endif; ?>
                        <div class="navbar-end-menu__sub-cart">
                            <?php get_template_part( 'template-parts/mini-wishlist' ); ?>
                        </div>
					</li>
					<li class="cart">
						<span class="counter">
	                        <?php if ( WC()->cart->get_cart_contents_count() > 0 ): ?>
	                            <span><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	                        <?php endif; ?>
                        </span>
						<a href="<?php echo esc_url(wc_get_cart_url()); ?>">
							<svg width="25" height="19" viewBox="0 0 25 19" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M24.9375 0.534058L24.1945 2.48066H22.2655L18.7915 14.1603H5.5525L0.9375 3.45396H17.7495L17.1855 5.40056H3.9455L6.8825 12.2137H17.3105L20.7425 0.534058H24.9375ZM9.4375 15.1336C8.6095 15.1336 7.9375 15.7876 7.9375 16.5935C7.9375 17.4004 8.6095 18.0535 9.4375 18.0535C10.2655 18.0535 10.9375 17.4004 10.9375 16.5935C10.9375 15.7876 10.2655 15.1336 9.4375 15.1336ZM16.3375 8.32046L14.4375 15.1336C13.6095 15.1336 12.9375 15.7867 12.9375 16.5935C12.9375 17.4004 13.6095 18.0535 14.4375 18.0535C15.2655 18.0535 15.9375 17.4004 15.9375 16.5935C15.9375 15.7876 15.2655 15.1336 14.4375 15.1336L16.3375 8.32046Z" fill="#767676"/>
							</svg>
						</a>
						<div class="navbar-end-menu__sub-cart">
							<?php woocommerce_mini_cart(); ?>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
