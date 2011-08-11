<?php
//---------------------------------------------------------------------
// DEFINE THE WIDGET
//---------------------------------------------------------------------
if( !class_exists("Widget_Easy_Nivo_Slider_NextGen")){
	
	class Widget_Easy_Nivo_Slider_NextGen extends WP_Widget {

		function Widget_Easy_Nivo_Slider_NextGen() {
		
			$widget_ops = array(
				'classname' => 'widget_easy_nivo_slider_nextgen', 
				'description' => __( "Nivo Slider for NextGen") 
				);
			
			parent::WP_Widget('easy-nivo-slider-widget-nextgen', __('Nivo Slider for NextGen'), $widget_ops);
			$this->alt_option_name = 'widget_easy_nivo_slider_nextgen';

			add_action( 'save_post', array(&$this, 'flush_widget_cache') );
			add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
			add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
		}

		function widget($args, $instance) {

			$cache = wp_cache_get('widget_easy_nivo_slider_nextgen', 'widget');

			if ( !is_array($cache) )
				$cache = array();
	
			if ( isset($cache[$args['widget_id']]) ) {
				echo $cache[$args['widget_id']];
				return;
			}

			ob_start();
			extract($args);		

			echo $before_widget;
			
			if ($instance['title']) echo $before_title . $instance['title'] . $after_title;
				
			echo get_easy_nivo_slider_for_nextgen($instance);
			
			echo $after_widget;	
					    
			$cache[$args['widget_id']] = ob_get_flush();
			wp_cache_set('widget_easy_nivo_slider_nextgen', $cache, 'widget');
		}
	
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
				
			$instance['nivo_slider_index'] = $new_instance['nivo_slider_index'];
			$instance['number'] = $new_instance['number'];
			$instance['title'] = $new_instance['title'];
			$instance['gallery'] = $new_instance['gallery'];
			$instance['size'] = $new_instance['size'];
			$instance['effect'] = $new_instance['effect'];
			$instance['speed'] = $new_instance['speed'];
			$instance['pause'] = $new_instance['pause'];
			$instance['pause_on_hover'] = $new_instance['pause_on_hover'];
			$instance['arrows'] = $new_instance['arrows'];
			$instance['hide_arrows'] = $new_instance['hide_arrows'];
			$instance['controls'] = $new_instance['controls'];
			$this->flush_widget_cache();
	
			$alloptions = wp_cache_get( 'alloptions', 'options' );
			if ( isset($alloptions['widget_easy_nivo_slider_nextgen']) )
				delete_option('widget_easy_nivo_slider_nextgen');
	
			return $instance;
		}


		function flush_widget_cache() {
			wp_cache_delete('widget_easy_nivo_slider_nextgen', 'widget');
		}
	
		function form( $instance ) {
			$id_base = 'widget-'.$this->id_base.'-'.$this->number.'-';
			$name_base = 'widget-'.$this->id_base.'['.$this->number.']';
			
			$instance ['size'] = 'widget';
			$instance ['hide-size'] = true;
			
			$nextgen = sns_get_nextgen_galleries();
			sns_form_widget_title ( $id_base, $name_base, $instance );
			sns_print_nextgen_gallery_form ( $id_base, $name_base, $instance, $nextgen );
           	sns_form_slider_settings ( $id_base, $name_base, $instance );
		}
	}

	add_action('widgets_init', create_function("","register_widget('Widget_Easy_Nivo_Slider_NextGen');"));

}
