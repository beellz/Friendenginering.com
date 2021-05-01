<?php
/**
 * Dashboard home tab template
 */

defined( 'ABSPATH' ) || die();

$widgets          = Flexi_Addons_Widgets_Manager::get_widgets_map();
$inactive_widgets = Flexi_Addons_Widgets_Manager::get_inactive_widgets();
$active_widgets   = flexiaddons_get_active_widgets();

?>

<div class="wrapper">
    <div class="flexi-dashboard-panel">

        <div class="flexi-dashboard-tabs">
            <div class="flexi-dashboard-tabs__nav">
                <a href="#" class="flexi-dashboard-tabs__nav-item active"
                   data-target="all"><?php _e( 'All Widgets', 'flexiaddons' ); ?></a>
                <a href="#" class="flexi-dashboard-tabs__nav-item"
                   data-target="inactive"><?php printf( __( 'Inactive ( %1$s )', 'flexiaddons' ), '<span class="inactive-count">' . count( $inactive_widgets ) . '</span>' ); ?></a>

                <a href="#" class="flexi-dashboard-tabs__nav-item"
                   data-target="active"><?php printf( __( 'Activated ( %1$s )', 'flexiaddons' ), '<span class="active-count">' . ( count( $active_widgets ) - count( $inactive_widgets ) ) . '</span>' ); ?></a>

                <a href="#" class="flexi-dashboard-tabs__nav-item"
                        data-target="extensions"><?php printf( __( 'Extensions', 'flexiaddons' ) ); ?></a>
                <a href="#" class="flexi-dashboard-tabs__nav-item"></a>

            </div>
        </div>

        <form class="flexi-dashboard-form" name="flexi-dashboard-form" id="flexi-dashboard-form">

            <div class="widgets-tab">
                <div class="flexi-dashboard-header">
                    <h1 class="flexi-dashboard__heading"><?php _e( 'Flexi Addons Widgets For Elementor', 'flexiaddons' ); ?></h1>
                </div>
                <div class="flexi-dashboard-widgets">
			        <?php

			        foreach ( $widgets as $widget_key => $item ) {

				        $is_pro = $item['is_pro'];

				        if ( flexiaddons()->is_pro_active() ) {
					        $is_active = ! in_array( $widget_key, $inactive_widgets );
				        } else {
					        $is_active = ! in_array( $widget_key, $inactive_widgets ) && ! $is_pro;
				        }

				        $item['class'] = 'flexi-dashboard-widgets__item';
				        $item['class'] .= $item['is_pro'] ? ' item--is-pro ' : '';
				        $item['class'] .= flexiaddons()->is_pro_active() ? ' pro-is-active ' : '';
				        $item['class'] .= $is_active ? ' item--is-active ' : '';

				        $badge = $is_pro ? __( 'PRO', 'flexiaddons' ) : __( 'FREE', 'flexiaddons' );

				        ?>

                        <div class="<?php echo $item['class']; ?>" data-key="<?php echo $widget_key; ?>">

					        <?php

					        if ( $item['is_pro'] ) {
						        printf( '<span class="flexi-dashboard-widgets__item-badge">%1$s</span>', $badge );
					        }

					        ?>

                            <span class="flexi-dashboard-widgets__item-icon">
                            <i class="flexi-icon <?php echo $item['icon']; ?>"></i>
                        </span>

                            <span class="flexi-dashboard-widgets__item-title"><?php echo $item['title']; ?></span>


                            <div class="checkbox">
						        <?php
						        printf( '<input type="checkbox" name="widgets[]" id="%3$s" value="%3$s" %1$s %2$s />',
							        $is_active ? 'checked' : '', $is_pro && ! flexiaddons()->is_pro_active() ? 'disabled' : '',
							        $widget_key );
						        ?>

                                <div>
                                    <label for="<?php echo $widget_key; ?>"></label>
                                </div>
                            </div>

                        </div>

				        <?php

			        }

			        ?>
                </div>
            </div>

            <div class="extensions-tab hidden">
                <div class="flexi-dashboard-header">
                    <h1 class="flexi-dashboard__heading"><?php _e( 'Flexi Addons Extensions For Elementor', 'flexiaddons' ); ?></h1>
                </div>

            <div class="flexi-dashboard-widgets">
		        <?php

		        $extensions          = Flexi_Addons_Widgets_Manager::get_extensions_map();
		        $inactive_extensions = Flexi_Addons_Widgets_Manager::get_inactive_extensions();


		        foreach ( $extensions as $ext_key => $ext ) {
			        $ext['class'] = 'flexi-dashboard-extensions__item';
			        $ext['class'] .= $ext['is_pro'] ? ' item--is-pro ' : '';
			        $ext['class'] .= flexiaddons()->is_pro_active() ? ' pro-is-active ' : '';
			        $ext['class'] .= $is_active ? ' item--is-active ' : '';

			        $is_pro = $ext['is_pro'];

			        if ( flexiaddons()->is_pro_active() ) {
				        $is_active = ! in_array( $ext_key, $inactive_extensions );
			        } else {
				        $is_active = ! in_array( $ext_key, $inactive_extensions ) && ! $is_pro;
			        }

			        $badge = $is_pro ? __( 'PRO', 'flexiaddons' ) : __( 'FREE', 'flexiaddons' );

			        ?>

                    <div class="<?php echo $ext['class']; ?>" data-key="<?php echo $ext_key; ?>">

				        <?php

				        if ( $ext['is_pro'] ) {
					        printf( '<span class="flexi-dashboard-widgets__item-badge">%1$s</span>', $badge );
				        }

				        ?>

                        <span class="flexi-dashboard-widgets__item-icon">
                            <i class="flexi-icon <?php echo $ext['icon']; ?>"></i>
                        </span>

                        <span class="flexi-dashboard-widgets__item-title"><?php echo $ext['title']; ?></span>


                        <div class="checkbox">
					        <?php
					        printf( '<input type="checkbox" name="extensions[]" id="%3$s" value="%3$s" %1$s %2$s />',
						        $is_active ? 'checked' : '', $is_pro && ! flexiaddons()->is_pro_active() ? 'disabled' : '', $ext_key );
					        ?>

                            <div>
                                <label for="<?php echo $ext_key; ?>"></label>
                            </div>
                        </div>

                    </div>

			        <?php
		        }

		        ?>


            </div>
            </div>

            <!-- save settings -->
            <div class="flexi-dashboard-actions">

                <button type="button" class="flexi-dashboard-actions__save">
                    <img src="<?php echo admin_url( 'images/wpspin_light.gif' ); ?>" alt="">
                    <span><?php _e( 'Save Settings', 'flexiaddons' ); ?></span>
                </button>
            </div>

        </form>

    </div>
</div>
