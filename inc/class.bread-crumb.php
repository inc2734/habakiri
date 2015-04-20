<?php
/**
 * Name       : Habakiri Bread Crumb
 * Version    : 1.0.0
 * Author     : Takashi Kitajima
 * Author URI : http://2inc.org
 * Created    : April 20, 2015
 * Modified   : 
 * License    : GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class Habakiri_Bread_Crumb {

	/**
	 * $bread_crumb
	 */
	protected $bread_crumb = array();

	/**
	 * __construct
	 */
	public function __construct() {
	}

	/**
	 * display
	 */
	public function display() {
		if ( Habakiri::get( 'is_displaying_bread_crumb' ) === 'false' ) {
			return;
		}

		global $wp_query;

		$page_on_front = get_option( 'page_on_front' );
		$home_label    = esc_html__( 'Home', 'habakiri' );
		if ( $page_on_front ) {
			$home_label = get_the_title( $page_on_front );
		}

		if ( is_404() ) {
			$this->set_for_404();
		}
		elseif ( is_search() ) {
			$this->set_for_search();
		}
		elseif ( is_tax() ) {
			$this->set_for_tax();
		}
		elseif ( is_attachment() ) {
			$this->set_for_attachment();
		}
		elseif ( is_page() && !is_front_page() ) {
			$this->set_for_page();
		}
		elseif ( is_single() ) {
			$this->set_for_single();
		}
		elseif ( is_category() ) {
			$this->set_for_category();
		}
		elseif ( is_tag() ) {
			$this->set_for_tag();
		}
		elseif ( is_author() ) {
			$this->set_for_author();
		}
		elseif ( is_day() ) {
			$this->set_for_day();
		}
		elseif ( is_month() ) {
			$this->set_for_month();
		}
		elseif ( is_year() ) {
			$this->set_for_year();
		}
		else {
			if ( !is_front_page() ) {
				$this->set( wp_title( '', false, '' ) );
			}
		}

		$bread_crumb   = array();
		$bread_crumb[] = sprintf( '<a href="%s">%s</a>',
			esc_url( home_url() ),
			esc_html( $home_label )
		);
		$post_type = $this->get_post_type();
		if ( ( is_category() || is_tag() || is_date() || is_author() ) ||
			 ( is_single() && $post_type === 'post' ) ) {
			if ( $page_for_posts = get_option( 'page_for_posts' ) ) {
				$bread_crumb[] = sprintf( '<a href="%s">%s</a>',
					esc_url( get_permalink( $page_for_posts ) ),
					esc_html( get_the_title( $page_for_posts ) )
				);
			}
		}
		foreach ( $this->bread_crumb as $_bread_crumb ) {
			if ( !empty( $_bread_crumb['link'] ) ) {
				$bread_crumb[] = sprintf(
					'<a href="%s">%s</a>',
					esc_url( $_bread_crumb['link'] ),
					esc_html( $_bread_crumb['title'] )
				);
			} else {
				$bread_crumb[] = esc_html( $_bread_crumb['title'] );
			}
		}
		printf(
			'<div class="bread-crumb">%s</div>',
			implode(
				' &gt; ',
				apply_filters( 'habakiri_bread_crumb', $bread_crumb )
			)
		);
	}

	/**
	 * set_for_404
	 */
	protected function set_for_404() {
		$this->set( esc_html__( 'Page not found', 'habakiri' ) );
	}

	/**
	 * set_for_search
	 */
	protected function set_for_search() {
		$this->set(
			sprintf(
				esc_html__( 'Search Results for: %s', 'habakiri' ),
				get_search_query()
			)
		);
	}

	/**
	 * set_for_tax
	 */
	protected function set_for_tax() {
		$taxonomy = get_query_var( 'taxonomy' );
		$term = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );

		$taxonomy_objects = get_taxonomy( $taxonomy );
		$post_types = $taxonomy_objects->object_type;
		$post_type = array_shift( $post_types );
		if ( $post_type ) {
			$template_page = $this->get_template_used_page( $post_type );
			if ( !empty( $template_page->ID ) ) {
				$this->set_ancestors( $template_page->ID, 'page' );
				$label = get_the_title( $template_page->ID );
			} else {
				$post_type_object = get_post_type_object( $post_type );
				$label = $post_type_object->labels->singular_name;
			}
			$this->set( $label, $this->get_post_type_archive_link( $post_type ) );
		}

		if ( is_taxonomy_hierarchical( $taxonomy ) && $term->parent ) {
			$this->set_ancestors( $term->term_id, $taxonomy );
		}
		$this->set( $term->name );
	}

	/**
	 * set_for_attachment
	 */
	protected function set_for_attachment() {
		$this->set( get_the_title() );
	}

	/**
	 * set_for_page
	 */
	protected function set_for_page() {
		$this->set_ancestors( get_the_ID(), 'page' );
		$this->set( get_the_title() );
	}

	/**
	 * set_for_single
	 */
	protected function set_for_single() {
		$post_type = $this->get_post_type();
		if ( $post_type && $post_type !== 'post' ) {
			$post_type_object = get_post_type_object( $post_type );
			$template_page    = $this->get_template_used_page( $post_type );
			if ( !empty( $template_page->ID ) ) {
				$this->set_ancestors( $template_page->ID, 'page' );
				$label = get_the_title( $template_page->ID );
			} else {
				$label = $post_type_object->labels->singular_name;
			}
			$this->set( $label, $this->get_post_type_archive_link( $post_type ) );

			$taxonomies = $post_type_object->taxonomies;
			if ( $taxonomies ) {
				$taxonomy = array_shift( $taxonomies );
				$terms    = get_the_terms( get_the_ID(), $taxonomy );
				if ( $terms ) {
					$term = array_shift( $terms );
					$this->set_ancestors( $term->term_id, $taxonomy );
					$this->set( $ancestor->name );
				}
			}
		}
		else {
			$categories = get_the_category( get_the_ID() );
			if ( $categories ) {
				$category = array_shift( $categories );
				$this->set_ancestors( $category->term_id, 'category' );
				$this->set( $category->name );
			}
		}
		$this->set( get_the_title() );
	}

	/**
	 * set_for_category
	 */
	protected function set_for_category() {
		$category_name = single_cat_title( '', false );
		$category_id   = get_cat_ID( $category_name );
		$this->set_ancestors( $category_id, 'category' );
		$this->set( $category_name );
	}

	/**
	 * set_for_tag
	 */
	protected function set_for_tag() {
		$this->set( single_tag_title( '', false ) );
	}

	/**
	 * set_for_author
	 */
	protected function set_for_author() {
		$author_id = get_query_var( 'author' );
		$this->set( get_the_author_meta( 'display_name', $author_id ) );
	}

	/**
	 * set_for_day
	 */
	protected function set_for_day() {
		$year = get_query_var( 'year' );
		if ( $year ) {
			$month = get_query_var( 'monthnum' );
			$day   = get_query_var( 'day' );
		} else {
			$m     = get_query_var( 'm' );
			$year  = substr( $m, 0, 4 );
			$month = substr( $m, 4, 2 );
			$day   = substr( $m, -2 );
		}
		$this->set( $this->year( $year ), get_year_link( $year ) );
		$this->set( $this->month( $month ), get_month_link( $year, $month ) );
		$this->set( $this->day( $day ) );
	}

	/**
	 * set_for_month
	 */
	protected function set_for_month() {
		$year = get_query_var( 'year' );
		if ( $year ) {
			$month = get_query_var( 'monthnum' );
		} else {
			$m     = get_query_var( 'm' );
			$year  = substr( $m, 0, 4 );
			$month = substr( $m, -2 );
		}
		$this->set( $this->year( $year ), get_year_link( $year ) );
		$this->set( $this->month( $month ) );
	}

	/**
	 * set_for_year
	 */
	protected function set_for_year() {
		$year = get_query_var( 'year' );
		if ( !$year ) {
			$m    = get_query_var( 'm' );
			$year = $m;
		}
		$this->set( $this->year( $year ) );
	}

	/**
	 * set
	 * @param string $title リンクタイトル
	 * @param string $link リンクURL
	 */
	protected function set( $title, $link = '' ) {
		$this->bread_crumb[] = array(
			'title' => $title,
			'link'  => $link,
		);
	}

	/**
	 * set_ancestors
	 * 自分の先祖をセット
	 * @param int $object_id
	 * @param string $object_type
	 */
	protected function set_ancestors( $object_id, $object_type ) {
		$ancestors = get_ancestors( $object_id, $object_type );
		krsort( $ancestors );
		if ( $object_type === 'page' ) {
			foreach ( $ancestors as $ancestor_id ) {
				$this->set( get_the_title( $ancestor_id ), get_permalink( $ancestor_id ) );
			}
		} else {
			foreach ( $ancestors as $ancestor_id ) {
				$ancestor = get_term( $ancestor_id, $object_type );
				$this->set( $ancestor->name, get_term_link( $ancestor ) );
			}
		}
	}

	/**
	 * get_post_type_archive_link
	 * @param string $post_type カスタム投稿タイプ名
	 * @return string カスタム投稿アーカイブURL
	 */
	protected function get_post_type_archive_link( $post_type ) {
		$post_type_archive_link = get_post_type_archive_link( $post_type );
		if ( !$post_type_archive_link ) {
			$template_page = $this->get_template_used_page( $post_type );
			if ( !empty( $template_page->ID ) ) {
				$post_type_archive_link = get_permalink( $template_page->ID );
			}
		}
		return $post_type_archive_link;
	}

	/**
	 * get_template_used_page
	 * これに一致するテンプレートを使っている固定ページはカスタム投稿アーカイブ用とみなす
	 * @param string $post_type
	 * @return int Post ID
	 */
	protected function get_template_used_page( $post_type ) {
		$template = apply_filters(
			MW_WP_Hacks_Config::NAME . '-bread-crumb-template-filename',
			'template-archive-' . $post_type . '.php',
			$post_type
		);
		$template_pages = get_posts( array(
			'post_type'  => 'page',
			'meta_query' => array(
				array(
					'key'   => '_wp_page_template',
					'value' => $template,
				),
			),
		) );
		if ( !empty( $template_pages[0] ) ) {
			return $template_pages[0];
		}
	}

	/**
	 * year
	 * @param string $year
	 * @return string $year
	 */
	protected function year( $year ) {
		if ( get_locale() === 'ja' ) {
			$year .= '年';
		}
		return $year;
	}

	/**
	 * month
	 * @param string $month
	 * @return string $month
	 */
	protected function month( $month ) {
		if ( get_locale() === 'ja' ) {
			$month .= '月';
		} else {
			$monthes = array(
				1  => 'January',
				2  => 'February',
				3  => 'March',
				4  => 'April',
				5  => 'May',
				6  => 'June',
				7  => 'July',
				8  => 'August',
				9  => 'September',
				10 => 'October',
				11 => 'November',
				12 => 'December',
			);
			$month = $monthes[$month];
		}
		return $month;
	}

	/**
	 * day
	 * @param string $day
	 * @return string $day
	 */
	protected function day( $day ) {
		if ( get_locale() === 'ja' ) {
			$day .= '日';
		}
		return $day;
	}

	/**
	 * get_post_type
	 */
	private function get_post_type() {
		global $wp_query;
		$post_type = get_post_type();
		if ( !$post_type ) {
			if ( isset( $wp_query->query['post_type'] ) ) {
				$post_type = $wp_query->query['post_type'];
			}
		}
		return $post_type;
	}
}
