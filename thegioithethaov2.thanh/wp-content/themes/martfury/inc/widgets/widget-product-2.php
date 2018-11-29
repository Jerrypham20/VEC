<?php
/**
 *
 * Kuteshop products
 *
 */
if ( !class_exists( 'Products_Widget' ) ) {
	class Products_Widget extends WP_Widget
	{
		function __construct()
		{
			parent::__construct (
		        'products_widget', // id
		        'Products Widget', // tên của widget
		        array(
		            'description' => 'Đây là Widget ví dụ' // mô tả cho widget
		        )
		    );
		}

		function widget( $args, $instance )
		{}

		function update( $new_instance, $old_instance )
		{
			$instance             = $old_instance;
			$instance['title']    = $new_instance['title'];
			$instance['per_page'] = $new_instance['per_page'];
			$instance['order']    = $new_instance['order'];
			$instance['orderby']  = $new_instance['orderby'];
			$instance['target']   = $new_instance['target'];

			return $instance;
		}

		function form( $instance )
		{
			//
			// set defaults
			// -------------------------------------------------
			$instance = wp_parse_args(
				$instance,
				array(
					'title'    => '',
					'per_page' => '4',
					'order'    => 'DESC',
					'orderby'  => 'date',
					'target'   => 'recent-product',
				)
			);
			$title_value = $instance['title'];
			$title_field = array(
				'id'    => $this->get_field_name( 'title' ),
				'name'  => $this->get_field_name( 'title' ),
				'type'  => 'text',
				'title' => esc_html__( 'Title', 'martfury' ),
			);
			echo cs_add_element( $title_field, $title_value );
			$target_value = $instance['target'];
			$target_field = array(
				'id'         => $this->get_field_name( 'target' ),
				'name'       => $this->get_field_name( 'target' ),
				'type'       => 'select',
				'options'    => array(
					'best-selling'      => esc_html__( 'Best Selling Products', 'martfury' ),
					'top-rated'         => esc_html__( 'Top Rated Products', 'martfury' ),
					'recent-product'    => esc_html__( 'Recent Products', 'martfury' ),
					'featured_products' => esc_html__( 'Featured Products', 'martfury' ),
					'on_sale'           => esc_html__( 'On Sale', 'martfury' ),
					'on_new'            => esc_html__( 'On New', 'martfury' ),
				),
				'attributes' => array(
					'data-depend-id' => 'target',
					'style'          => 'width: 100%;',
				),
				'title'      => esc_html__( 'Choose Target', 'martfury' ),
			);
			echo cs_add_element( $target_field, $target_value );
			$orderby_value = $instance['orderby'];
			$orderby_field = array(
				'id'         => $this->get_field_name( 'orderby' ),
				'name'       => $this->get_field_name( 'orderby' ),
				'type'       => 'select',
				'options'    => array(
					'date'          => esc_html__( 'Date', 'martfury' ),
					'ID'            => esc_html__( 'ID', 'martfury' ),
					'author'        => esc_html__( 'Author', 'martfury' ),
					'title'         => esc_html__( 'Title', 'martfury' ),
					'modified'      => esc_html__( 'Modified', 'martfury' ),
					'rand'          => esc_html__( 'Random', 'martfury' ),
					'comment_count' => esc_html__( 'Comment count', 'martfury' ),
					'menu_order'    => esc_html__( 'Menu order', 'martfury' ),
					'_sale_price'   => esc_html__( 'Sale price', 'martfury' ),
				),
				'attributes' => array(
					'style' => 'width: 100%;',
				),
				'title'      => esc_html__( 'Order By', 'martfury' ),
			);
			echo cs_add_element( $orderby_field, $orderby_value );
			$order_value = $instance['order'];
			$order_field = array(
				'id'         => $this->get_field_name( 'order' ),
				'name'       => $this->get_field_name( 'order' ),
				'type'       => 'select',
				'options'    => array(
					'ASC'  => esc_html__( 'ASC', 'martfury' ),
					'DESC' => esc_html__( 'DESC', 'martfury' ),
				),
				'attributes' => array(
					'style' => 'width: 100%;',
				),
				'title'      => esc_html__( 'Order', 'martfury' ),
			);
			echo cs_add_element( $order_field, $order_value );
			$per_page_value = $instance['per_page'];
			$per_page_field = array(
				'id'    => $this->get_field_name( 'per_page' ),
				'name'  => $this->get_field_name( 'per_page' ),
				'type'  => 'number',
				'title' => esc_html__( 'Product per page', 'martfury' ),
			);
			echo cs_add_element( $per_page_field, $per_page_value );
		}
	}
}
if ( !function_exists( 'Products_Widget_init' ) ) {
	function Products_Widget_init()
	{
		register_widget( 'Products_Widget' );
	}

	add_action( 'widgets_init', 'Products_Widget_init', 2 );
}