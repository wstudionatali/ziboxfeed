2021-01-08 16:40:37 - lang
2021-01-08 16:40:37 - ar
2021-01-08 16:40:37 - query 
2021-01-08 16:40:37 - WP_Query Object
(
    [query] => Array
        (
            [post_type] => Array
                (
                    [0] => product
                )

            [tax_query] => Array
                (
                    [0] => Array
                        (
                            [taxonomy] => product_cat
                            [field] => id
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [include_children] => 
                        )

                )

        )

    [query_vars] => Array
        (
            [post_type] => Array
                (
                    [0] => product
                )

            [tax_query] => Array
                (
                    [0] => Array
                        (
                            [taxonomy] => product_cat
                            [field] => id
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [include_children] => 
                        )

                )

            [error] => 
            [m] => 
            [p] => 0
            [post_parent] => 
            [subpost] => 
            [subpost_id] => 
            [attachment] => 
            [attachment_id] => 0
            [name] => 
            [pagename] => 
            [page_id] => 0
            [second] => 
            [minute] => 
            [hour] => 
            [day] => 0
            [monthnum] => 0
            [year] => 0
            [w] => 0
            [category_name] => 
            [tag] => 
            [cat] => 
            [tag_id] => 
            [author] => 
            [author_name] => 
            [feed] => 
            [tb] => 
            [paged] => 0
            [meta_key] => 
            [meta_value] => 
            [preview] => 
            [s] => 
            [sentence] => 
            [title] => 
            [fields] => 
            [menu_order] => 
            [embed] => 
            [category__in] => Array
                (
                )

            [category__not_in] => Array
                (
                )

            [category__and] => Array
                (
                )

            [post__in] => Array
                (
                )

            [post__not_in] => Array
                (
                )

            [post_name__in] => Array
                (
                )

            [tag__in] => Array
                (
                )

            [tag__not_in] => Array
                (
                )

            [tag__and] => Array
                (
                )

            [tag_slug__in] => Array
                (
                )

            [tag_slug__and] => Array
                (
                )

            [post_parent__in] => Array
                (
                )

            [post_parent__not_in] => Array
                (
                )

            [author__in] => Array
                (
                )

            [author__not_in] => Array
                (
                )

            [ignore_sticky_posts] => 
            [suppress_filters] => 
            [cache_results] => 1
            [update_post_term_cache] => 1
            [lazy_load_term_meta] => 1
            [update_post_meta_cache] => 1
            [posts_per_page] => 10
            [nopaging] => 
            [comments_per_page] => 50
            [no_found_rows] => 
            [taxonomy] => product_cat
            [term_id] => 240
            [order] => DESC
        )

    [tax_query] => WP_Tax_Query Object
        (
            [queries] => Array
                (
                    [0] => Array
                        (
                            [taxonomy] => product_cat
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [field] => id
                            [operator] => IN
                            [include_children] => 
                        )

                )

            [relation] => AND
            [table_aliases:protected] => Array
                (
                    [0] => wp_term_relationships
                )

            [queried_terms] => Array
                (
                    [product_cat] => Array
                        (
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [field] => id
                        )

                )

            [primary_table] => wp_posts
            [primary_id_column] => ID
        )

    [meta_query] => WP_Meta_Query Object
        (
            [queries] => Array
                (
                )

            [relation] => 
            [meta_table] => 
            [meta_id_column] => 
            [primary_table] => 
            [primary_id_column] => 
            [table_aliases:protected] => Array
                (
                )

            [clauses:protected] => Array
                (
                )

            [has_or_relation:protected] => 
        )

    [date_query] => 
    [request] => SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT  JOIN wp_icl_translations wpml_translations
							ON wp_posts.ID = wpml_translations.element_id
								AND wpml_translations.element_type = CONCAT('post_', wp_posts.post_type)  WHERE 1=1  AND ( 
  wp_term_relationships.term_taxonomy_id IN (240,257,258,263,5642,5645)
) AND wp_posts.post_type = 'product' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') AND ( ( ( wpml_translations.language_code = 'en' OR (
					wpml_translations.language_code = 'en'
					AND wp_posts.post_type IN ( 'product' )
					AND ( ( 
			( SELECT COUNT(element_id)
			  FROM wp_icl_translations
			  WHERE trid = wpml_translations.trid
			  AND language_code = 'en'
			) = 0
			 ) OR ( 
			( SELECT COUNT(element_id)
				FROM wp_icl_translations t2
				JOIN wp_posts p ON p.id = t2.element_id
				WHERE t2.trid = wpml_translations.trid
				AND t2.language_code = 'en'
				AND (
					p.post_status = 'publish' OR 
					p.post_type='attachment' AND p.post_status = 'inherit'
				)
			) = 0 ) ) 
				) ) AND wp_posts.post_type  IN ('post','page','attachment','wp_block','product','product_variation','block','faq','member' )  ) OR wp_posts.post_type  NOT  IN ('post','page','attachment','wp_block','product','product_variation','block','faq','member' )  ) GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC LIMIT 0, 10
    [posts] => Array
        (
            [0] => WP_Post Object
                (
                    [ID] => 581
                    [post_author] => 1
                    [post_date] => 2019-03-18 03:50:23
                    [post_date_gmt] => 2019-03-18 03:50:23
                    [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1511248807031{padding-left: 40px !important;}"][vc_column][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.[/vc_column_text][/vc_column][/vc_row]
                    [post_title] => Lucky Emmie Ballet Flat
                    [post_excerpt] => Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                    [post_status] => publish
                    [comment_status] => closed
                    [ping_status] => closed
                    [post_password] => 
                    [post_name] => lucky-emmie-ballet-flat
                    [to_ping] => 
                    [pinged] => 
                    [post_modified] => 2021-01-06 12:47:29
                    [post_modified_gmt] => 2021-01-06 12:47:29
                    [post_content_filtered] => 
                    [post_parent] => 0
                    [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-602/
                    [menu_order] => 0
                    [post_type] => product
                    [post_mime_type] => 
                    [comment_count] => 0
                    [filter] => raw
                )

            [1] => WP_Post Object
                (
                    [ID] => 1367
                    [post_author] => 1
                    [post_date] => 2018-04-09 03:51:07
                    [post_date_gmt] => 2018-04-09 03:51:07
                    [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="2/3" offset="vc_col-lg-6 vc_col-md-7"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.[/vc_column_text][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][vc_column width="1/3" offset="vc_col-lg-6 vc_col-md-5"][vc_single_image image="1413" img_size="full" alignment="center"][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1519368676441{margin-top: 20px !important;margin-bottom: 50px !important;}"][vc_column width="1/3"][porto_info_box icon="fa fa-star" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="DEDICATED SERVICE" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][vc_column width="1/3"][porto_info_box icon="fa fa-reply" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="FREE RETURNS" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][vc_column width="1/3"][porto_info_box icon="fa fa-paper-plane" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="INTERNATIONAL SHIPPING" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.[/vc_column_text][/vc_column][/vc_row]
                    [post_title] => Silver Porto Headset
                    [post_excerpt] => Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.
                    [post_status] => publish
                    [comment_status] => closed
                    [ping_status] => closed
                    [post_password] => 
                    [post_name] => silver-porto-headset
                    [to_ping] => 
                    [pinged] => 
                    [post_modified] => 2020-12-27 11:37:03
                    [post_modified_gmt] => 2020-12-27 11:37:03
                    [post_content_filtered] => 
                    [post_parent] => 0
                    [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-1336/
                    [menu_order] => 0
                    [post_type] => product
                    [post_mime_type] => 
                    [comment_count] => 0
                    [filter] => raw
                )

            [2] => WP_Post Object
                (
                    [ID] => 1358
                    [post_author] => 1
                    [post_date] => 2018-04-09 03:50:55
                    [post_date_gmt] => 2018-04-09 03:50:55
                    [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1511248807031{padding-left: 40px !important;}"][vc_column][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.[/vc_column_text][/vc_column][/vc_row]
                    [post_title] => Black Watch
                    [post_excerpt] => Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.
                    [post_status] => publish
                    [comment_status] => closed
                    [ping_status] => closed
                    [post_password] => 
                    [post_name] => black-watch
                    [to_ping] => 
                    [pinged] => 
                    [post_modified] => 2020-12-22 20:57:15
                    [post_modified_gmt] => 2020-12-22 20:57:15
                    [post_content_filtered] => 
                    [post_parent] => 0
                    [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-1328/
                    [menu_order] => 0
                    [post_type] => product
                    [post_mime_type] => 
                    [comment_count] => 0
                    [filter] => raw
                )

        )

    [post_count] => 3
    [current_post] => 0
    [in_the_loop] => 1
    [post] => WP_Post Object
        (
            [ID] => 581
            [post_author] => 1
            [post_date] => 2019-03-18 03:50:23
            [post_date_gmt] => 2019-03-18 03:50:23
            [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1511248807031{padding-left: 40px !important;}"][vc_column][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.[/vc_column_text][/vc_column][/vc_row]
            [post_title] => Lucky Emmie Ballet Flat
            [post_excerpt] => Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
            [post_status] => publish
            [comment_status] => closed
            [ping_status] => closed
            [post_password] => 
            [post_name] => lucky-emmie-ballet-flat
            [to_ping] => 
            [pinged] => 
            [post_modified] => 2021-01-06 12:47:29
            [post_modified_gmt] => 2021-01-06 12:47:29
            [post_content_filtered] => 
            [post_parent] => 0
            [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-602/
            [menu_order] => 0
            [post_type] => product
            [post_mime_type] => 
            [comment_count] => 0
            [filter] => raw
        )

    [comment_count] => 0
    [current_comment] => -1
    [found_posts] => 3
    [max_num_pages] => 1
    [max_num_comment_pages] => 0
    [is_single] => 
    [is_preview] => 
    [is_page] => 
    [is_archive] => 1
    [is_date] => 
    [is_year] => 
    [is_month] => 
    [is_day] => 
    [is_time] => 
    [is_author] => 
    [is_category] => 
    [is_tag] => 
    [is_tax] => 1
    [is_search] => 
    [is_feed] => 
    [is_comment_feed] => 
    [is_trackback] => 
    [is_home] => 
    [is_privacy_policy] => 
    [is_404] => 
    [is_embed] => 
    [is_paged] => 
    [is_admin] => 
    [is_attachment] => 
    [is_singular] => 
    [is_robots] => 
    [is_favicon] => 
    [is_posts_page] => 
    [is_post_type_archive] => 
    [query_vars_hash:WP_Query:private] => a19940cd6351a6684d21f044bc5c363d
    [query_vars_changed:WP_Query:private] => 
    [thumbnails_cached] => 
    [stopwords:WP_Query:private] => 
    [compat_fields:WP_Query:private] => Array
        (
            [0] => query_vars_hash
            [1] => query_vars_changed
        )

    [compat_methods:WP_Query:private] => Array
        (
            [0] => init_query_flags
            [1] => parse_tax_query
        )

)

2021-01-08 16:40:37 - En prod id 
2021-01-08 16:40:37 - 581
2021-01-08 16:40:37 - Arabic prod id 
2021-01-08 16:40:37 - 2214
2021-01-08 16:40:37 - Product transl 
2021-01-08 16:40:37 - [vc_row el_class="m-b-md"][vc_column][vc_column_text]

- بسبب وجود نوع خاص من البكتيريا المضيئة .


<strong>1 – بي</strong><strong>ّن سبب قدرة األسماك المضيئة على اإلضاءة .</strong>

- بسبب وجود خاليا الغدد الفسفورية في أجسامها . أو[/vc_column_text][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1511248807031{padding-left: 40px !important;}"][vc_column]ورية في أجسامها . أو[/vc_column][/vc_row][vc_row][vc_column][vc_column_text]&nbsp;

- بسبب وجود نوع خاص من البكتيريا المضيئة .


<strong>1 – بي</strong><strong>ّن سبب قدرة األسماك المضيئة على اإلضاءة .</strong>

- بسبب وجود خاليا الغدد الفسفورية في أجسامها . أو[/vc_column_text][/vc_column][/vc_row]
2021-01-08 16:40:37 - get_attributes 
2021-01-08 16:40:37 - Array
(
    [pa_size_70] => WC_Product_Attribute Object
        (
            [data:protected] => Array
                (
                    [id] => 215
                    [name] => pa_size_70
                    [options] => Array
                        (
                            [0] => 3435
                            [1] => 3448
                        )

                    [position] => 2
                    [visible] => 1
                    [variation] => 1
                )

        )

)

2021-01-08 16:40:37 - query 
2021-01-08 16:40:37 - WP_Query Object
(
    [query] => Array
        (
            [post_type] => Array
                (
                    [0] => product
                )

            [tax_query] => Array
                (
                    [0] => Array
                        (
                            [taxonomy] => product_cat
                            [field] => id
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [include_children] => 
                        )

                )

        )

    [query_vars] => Array
        (
            [post_type] => Array
                (
                    [0] => product
                )

            [tax_query] => Array
                (
                    [0] => Array
                        (
                            [taxonomy] => product_cat
                            [field] => id
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [include_children] => 
                        )

                )

            [error] => 
            [m] => 
            [p] => 0
            [post_parent] => 
            [subpost] => 
            [subpost_id] => 
            [attachment] => 
            [attachment_id] => 0
            [name] => 
            [pagename] => 
            [page_id] => 0
            [second] => 
            [minute] => 
            [hour] => 
            [day] => 0
            [monthnum] => 0
            [year] => 0
            [w] => 0
            [category_name] => 
            [tag] => 
            [cat] => 
            [tag_id] => 
            [author] => 
            [author_name] => 
            [feed] => 
            [tb] => 
            [paged] => 0
            [meta_key] => 
            [meta_value] => 
            [preview] => 
            [s] => 
            [sentence] => 
            [title] => 
            [fields] => 
            [menu_order] => 
            [embed] => 
            [category__in] => Array
                (
                )

            [category__not_in] => Array
                (
                )

            [category__and] => Array
                (
                )

            [post__in] => Array
                (
                )

            [post__not_in] => Array
                (
                )

            [post_name__in] => Array
                (
                )

            [tag__in] => Array
                (
                )

            [tag__not_in] => Array
                (
                )

            [tag__and] => Array
                (
                )

            [tag_slug__in] => Array
                (
                )

            [tag_slug__and] => Array
                (
                )

            [post_parent__in] => Array
                (
                )

            [post_parent__not_in] => Array
                (
                )

            [author__in] => Array
                (
                )

            [author__not_in] => Array
                (
                )

            [ignore_sticky_posts] => 
            [suppress_filters] => 
            [cache_results] => 1
            [update_post_term_cache] => 1
            [lazy_load_term_meta] => 1
            [update_post_meta_cache] => 1
            [posts_per_page] => 10
            [nopaging] => 
            [comments_per_page] => 50
            [no_found_rows] => 
            [taxonomy] => product_cat
            [term_id] => 240
            [order] => DESC
        )

    [tax_query] => WP_Tax_Query Object
        (
            [queries] => Array
                (
                    [0] => Array
                        (
                            [taxonomy] => product_cat
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [field] => id
                            [operator] => IN
                            [include_children] => 
                        )

                )

            [relation] => AND
            [table_aliases:protected] => Array
                (
                    [0] => wp_term_relationships
                )

            [queried_terms] => Array
                (
                    [product_cat] => Array
                        (
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [field] => id
                        )

                )

            [primary_table] => wp_posts
            [primary_id_column] => ID
        )

    [meta_query] => WP_Meta_Query Object
        (
            [queries] => Array
                (
                )

            [relation] => 
            [meta_table] => 
            [meta_id_column] => 
            [primary_table] => 
            [primary_id_column] => 
            [table_aliases:protected] => Array
                (
                )

            [clauses:protected] => Array
                (
                )

            [has_or_relation:protected] => 
        )

    [date_query] => 
    [request] => SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT  JOIN wp_icl_translations wpml_translations
							ON wp_posts.ID = wpml_translations.element_id
								AND wpml_translations.element_type = CONCAT('post_', wp_posts.post_type)  WHERE 1=1  AND ( 
  wp_term_relationships.term_taxonomy_id IN (240,257,258,263,5642,5645)
) AND wp_posts.post_type = 'product' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') AND ( ( ( wpml_translations.language_code = 'en' OR (
					wpml_translations.language_code = 'en'
					AND wp_posts.post_type IN ( 'product' )
					AND ( ( 
			( SELECT COUNT(element_id)
			  FROM wp_icl_translations
			  WHERE trid = wpml_translations.trid
			  AND language_code = 'en'
			) = 0
			 ) OR ( 
			( SELECT COUNT(element_id)
				FROM wp_icl_translations t2
				JOIN wp_posts p ON p.id = t2.element_id
				WHERE t2.trid = wpml_translations.trid
				AND t2.language_code = 'en'
				AND (
					p.post_status = 'publish' OR 
					p.post_type='attachment' AND p.post_status = 'inherit'
				)
			) = 0 ) ) 
				) ) AND wp_posts.post_type  IN ('post','page','attachment','wp_block','product','product_variation','block','faq','member' )  ) OR wp_posts.post_type  NOT  IN ('post','page','attachment','wp_block','product','product_variation','block','faq','member' )  ) GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC LIMIT 0, 10
    [posts] => Array
        (
            [0] => WP_Post Object
                (
                    [ID] => 581
                    [post_author] => 1
                    [post_date] => 2019-03-18 03:50:23
                    [post_date_gmt] => 2019-03-18 03:50:23
                    [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1511248807031{padding-left: 40px !important;}"][vc_column][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.[/vc_column_text][/vc_column][/vc_row]
                    [post_title] => Lucky Emmie Ballet Flat
                    [post_excerpt] => Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                    [post_status] => publish
                    [comment_status] => closed
                    [ping_status] => closed
                    [post_password] => 
                    [post_name] => lucky-emmie-ballet-flat
                    [to_ping] => 
                    [pinged] => 
                    [post_modified] => 2021-01-06 12:47:29
                    [post_modified_gmt] => 2021-01-06 12:47:29
                    [post_content_filtered] => 
                    [post_parent] => 0
                    [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-602/
                    [menu_order] => 0
                    [post_type] => product
                    [post_mime_type] => 
                    [comment_count] => 0
                    [filter] => raw
                )

            [1] => WP_Post Object
                (
                    [ID] => 1367
                    [post_author] => 1
                    [post_date] => 2018-04-09 03:51:07
                    [post_date_gmt] => 2018-04-09 03:51:07
                    [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="2/3" offset="vc_col-lg-6 vc_col-md-7"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.[/vc_column_text][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][vc_column width="1/3" offset="vc_col-lg-6 vc_col-md-5"][vc_single_image image="1413" img_size="full" alignment="center"][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1519368676441{margin-top: 20px !important;margin-bottom: 50px !important;}"][vc_column width="1/3"][porto_info_box icon="fa fa-star" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="DEDICATED SERVICE" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][vc_column width="1/3"][porto_info_box icon="fa fa-reply" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="FREE RETURNS" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][vc_column width="1/3"][porto_info_box icon="fa fa-paper-plane" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="INTERNATIONAL SHIPPING" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.[/vc_column_text][/vc_column][/vc_row]
                    [post_title] => Silver Porto Headset
                    [post_excerpt] => Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.
                    [post_status] => publish
                    [comment_status] => closed
                    [ping_status] => closed
                    [post_password] => 
                    [post_name] => silver-porto-headset
                    [to_ping] => 
                    [pinged] => 
                    [post_modified] => 2020-12-27 11:37:03
                    [post_modified_gmt] => 2020-12-27 11:37:03
                    [post_content_filtered] => 
                    [post_parent] => 0
                    [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-1336/
                    [menu_order] => 0
                    [post_type] => product
                    [post_mime_type] => 
                    [comment_count] => 0
                    [filter] => raw
                )

            [2] => WP_Post Object
                (
                    [ID] => 1358
                    [post_author] => 1
                    [post_date] => 2018-04-09 03:50:55
                    [post_date_gmt] => 2018-04-09 03:50:55
                    [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1511248807031{padding-left: 40px !important;}"][vc_column][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.[/vc_column_text][/vc_column][/vc_row]
                    [post_title] => Black Watch
                    [post_excerpt] => Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.
                    [post_status] => publish
                    [comment_status] => closed
                    [ping_status] => closed
                    [post_password] => 
                    [post_name] => black-watch
                    [to_ping] => 
                    [pinged] => 
                    [post_modified] => 2020-12-22 20:57:15
                    [post_modified_gmt] => 2020-12-22 20:57:15
                    [post_content_filtered] => 
                    [post_parent] => 0
                    [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-1328/
                    [menu_order] => 0
                    [post_type] => product
                    [post_mime_type] => 
                    [comment_count] => 0
                    [filter] => raw
                )

        )

    [post_count] => 3
    [current_post] => 1
    [in_the_loop] => 1
    [post] => WP_Post Object
        (
            [ID] => 1367
            [post_author] => 1
            [post_date] => 2018-04-09 03:51:07
            [post_date_gmt] => 2018-04-09 03:51:07
            [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="2/3" offset="vc_col-lg-6 vc_col-md-7"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.[/vc_column_text][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][vc_column width="1/3" offset="vc_col-lg-6 vc_col-md-5"][vc_single_image image="1413" img_size="full" alignment="center"][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1519368676441{margin-top: 20px !important;margin-bottom: 50px !important;}"][vc_column width="1/3"][porto_info_box icon="fa fa-star" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="DEDICATED SERVICE" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][vc_column width="1/3"][porto_info_box icon="fa fa-reply" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="FREE RETURNS" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][vc_column width="1/3"][porto_info_box icon="fa fa-paper-plane" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="INTERNATIONAL SHIPPING" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.[/vc_column_text][/vc_column][/vc_row]
            [post_title] => Silver Porto Headset
            [post_excerpt] => Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.
            [post_status] => publish
            [comment_status] => closed
            [ping_status] => closed
            [post_password] => 
            [post_name] => silver-porto-headset
            [to_ping] => 
            [pinged] => 
            [post_modified] => 2020-12-27 11:37:03
            [post_modified_gmt] => 2020-12-27 11:37:03
            [post_content_filtered] => 
            [post_parent] => 0
            [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-1336/
            [menu_order] => 0
            [post_type] => product
            [post_mime_type] => 
            [comment_count] => 0
            [filter] => raw
        )

    [comment_count] => 0
    [current_comment] => -1
    [found_posts] => 3
    [max_num_pages] => 1
    [max_num_comment_pages] => 0
    [is_single] => 
    [is_preview] => 
    [is_page] => 
    [is_archive] => 1
    [is_date] => 
    [is_year] => 
    [is_month] => 
    [is_day] => 
    [is_time] => 
    [is_author] => 
    [is_category] => 
    [is_tag] => 
    [is_tax] => 1
    [is_search] => 
    [is_feed] => 
    [is_comment_feed] => 
    [is_trackback] => 
    [is_home] => 
    [is_privacy_policy] => 
    [is_404] => 
    [is_embed] => 
    [is_paged] => 
    [is_admin] => 
    [is_attachment] => 
    [is_singular] => 
    [is_robots] => 
    [is_favicon] => 
    [is_posts_page] => 
    [is_post_type_archive] => 
    [query_vars_hash:WP_Query:private] => a19940cd6351a6684d21f044bc5c363d
    [query_vars_changed:WP_Query:private] => 
    [thumbnails_cached] => 
    [stopwords:WP_Query:private] => 
    [compat_fields:WP_Query:private] => Array
        (
            [0] => query_vars_hash
            [1] => query_vars_changed
        )

    [compat_methods:WP_Query:private] => Array
        (
            [0] => init_query_flags
            [1] => parse_tax_query
        )

)

2021-01-08 16:40:37 - En prod id 
2021-01-08 16:40:37 - 1367
2021-01-08 16:40:37 - Arabic prod id 
2021-01-08 16:40:37 - 1367
2021-01-08 16:40:37 - Product transl 
2021-01-08 16:40:37 - [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="2/3" offset="vc_col-lg-6 vc_col-md-7"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.[/vc_column_text][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][vc_column width="1/3" offset="vc_col-lg-6 vc_col-md-5"][vc_single_image image="1413" img_size="full" alignment="center"][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1519368676441{margin-top: 20px !important;margin-bottom: 50px !important;}"][vc_column width="1/3"][porto_info_box icon="fa fa-star" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="DEDICATED SERVICE" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][vc_column width="1/3"][porto_info_box icon="fa fa-reply" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="FREE RETURNS" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][vc_column width="1/3"][porto_info_box icon="fa fa-paper-plane" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="INTERNATIONAL SHIPPING" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.[/vc_column_text][/vc_column][/vc_row]
2021-01-08 16:40:37 - get_attributes 
2021-01-08 16:40:37 - Array
(
    [pa_brand_63] => WC_Product_Attribute Object
        (
            [data:protected] => Array
                (
                    [id] => 208
                    [name] => pa_brand_63
                    [options] => Array
                        (
                            [0] => 3352
                            [1] => 3354
                            [2] => 3355
                            [3] => 3357
                            [4] => 3358
                            [5] => 3359
                            [6] => 3360
                            [7] => 3361
                            [8] => 3369
                            [9] => 3362
                            [10] => 3363
                            [11] => 3364
                            [12] => 3365
                            [13] => 3366
                        )

                    [position] => 0
                    [visible] => 1
                    [variation] => 1
                )

        )

    [pa_material_66] => WC_Product_Attribute Object
        (
            [data:protected] => Array
                (
                    [id] => 211
                    [name] => pa_material_66
                    [options] => Array
                        (
                            [0] => 3382
                            [1] => 3383
                        )

                    [position] => 1
                    [visible] => 1
                    [variation] => 1
                )

        )

)

2021-01-08 16:40:37 - query 
2021-01-08 16:40:37 - WP_Query Object
(
    [query] => Array
        (
            [post_type] => Array
                (
                    [0] => product
                )

            [tax_query] => Array
                (
                    [0] => Array
                        (
                            [taxonomy] => product_cat
                            [field] => id
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [include_children] => 
                        )

                )

        )

    [query_vars] => Array
        (
            [post_type] => Array
                (
                    [0] => product
                )

            [tax_query] => Array
                (
                    [0] => Array
                        (
                            [taxonomy] => product_cat
                            [field] => id
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [include_children] => 
                        )

                )

            [error] => 
            [m] => 
            [p] => 0
            [post_parent] => 
            [subpost] => 
            [subpost_id] => 
            [attachment] => 
            [attachment_id] => 0
            [name] => 
            [pagename] => 
            [page_id] => 0
            [second] => 
            [minute] => 
            [hour] => 
            [day] => 0
            [monthnum] => 0
            [year] => 0
            [w] => 0
            [category_name] => 
            [tag] => 
            [cat] => 
            [tag_id] => 
            [author] => 
            [author_name] => 
            [feed] => 
            [tb] => 
            [paged] => 0
            [meta_key] => 
            [meta_value] => 
            [preview] => 
            [s] => 
            [sentence] => 
            [title] => 
            [fields] => 
            [menu_order] => 
            [embed] => 
            [category__in] => Array
                (
                )

            [category__not_in] => Array
                (
                )

            [category__and] => Array
                (
                )

            [post__in] => Array
                (
                )

            [post__not_in] => Array
                (
                )

            [post_name__in] => Array
                (
                )

            [tag__in] => Array
                (
                )

            [tag__not_in] => Array
                (
                )

            [tag__and] => Array
                (
                )

            [tag_slug__in] => Array
                (
                )

            [tag_slug__and] => Array
                (
                )

            [post_parent__in] => Array
                (
                )

            [post_parent__not_in] => Array
                (
                )

            [author__in] => Array
                (
                )

            [author__not_in] => Array
                (
                )

            [ignore_sticky_posts] => 
            [suppress_filters] => 
            [cache_results] => 1
            [update_post_term_cache] => 1
            [lazy_load_term_meta] => 1
            [update_post_meta_cache] => 1
            [posts_per_page] => 10
            [nopaging] => 
            [comments_per_page] => 50
            [no_found_rows] => 
            [taxonomy] => product_cat
            [term_id] => 240
            [order] => DESC
        )

    [tax_query] => WP_Tax_Query Object
        (
            [queries] => Array
                (
                    [0] => Array
                        (
                            [taxonomy] => product_cat
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [field] => id
                            [operator] => IN
                            [include_children] => 
                        )

                )

            [relation] => AND
            [table_aliases:protected] => Array
                (
                    [0] => wp_term_relationships
                )

            [queried_terms] => Array
                (
                    [product_cat] => Array
                        (
                            [terms] => Array
                                (
                                    [0] => 240
                                    [1] => 257
                                    [2] => 258
                                    [3] => 263
                                    [4] => 5642
                                    [5] => 5645
                                )

                            [field] => id
                        )

                )

            [primary_table] => wp_posts
            [primary_id_column] => ID
        )

    [meta_query] => WP_Meta_Query Object
        (
            [queries] => Array
                (
                )

            [relation] => 
            [meta_table] => 
            [meta_id_column] => 
            [primary_table] => 
            [primary_id_column] => 
            [table_aliases:protected] => Array
                (
                )

            [clauses:protected] => Array
                (
                )

            [has_or_relation:protected] => 
        )

    [date_query] => 
    [request] => SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT  JOIN wp_icl_translations wpml_translations
							ON wp_posts.ID = wpml_translations.element_id
								AND wpml_translations.element_type = CONCAT('post_', wp_posts.post_type)  WHERE 1=1  AND ( 
  wp_term_relationships.term_taxonomy_id IN (240,257,258,263,5642,5645)
) AND wp_posts.post_type = 'product' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') AND ( ( ( wpml_translations.language_code = 'en' OR (
					wpml_translations.language_code = 'en'
					AND wp_posts.post_type IN ( 'product' )
					AND ( ( 
			( SELECT COUNT(element_id)
			  FROM wp_icl_translations
			  WHERE trid = wpml_translations.trid
			  AND language_code = 'en'
			) = 0
			 ) OR ( 
			( SELECT COUNT(element_id)
				FROM wp_icl_translations t2
				JOIN wp_posts p ON p.id = t2.element_id
				WHERE t2.trid = wpml_translations.trid
				AND t2.language_code = 'en'
				AND (
					p.post_status = 'publish' OR 
					p.post_type='attachment' AND p.post_status = 'inherit'
				)
			) = 0 ) ) 
				) ) AND wp_posts.post_type  IN ('post','page','attachment','wp_block','product','product_variation','block','faq','member' )  ) OR wp_posts.post_type  NOT  IN ('post','page','attachment','wp_block','product','product_variation','block','faq','member' )  ) GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC LIMIT 0, 10
    [posts] => Array
        (
            [0] => WP_Post Object
                (
                    [ID] => 581
                    [post_author] => 1
                    [post_date] => 2019-03-18 03:50:23
                    [post_date_gmt] => 2019-03-18 03:50:23
                    [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1511248807031{padding-left: 40px !important;}"][vc_column][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.[/vc_column_text][/vc_column][/vc_row]
                    [post_title] => Lucky Emmie Ballet Flat
                    [post_excerpt] => Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                    [post_status] => publish
                    [comment_status] => closed
                    [ping_status] => closed
                    [post_password] => 
                    [post_name] => lucky-emmie-ballet-flat
                    [to_ping] => 
                    [pinged] => 
                    [post_modified] => 2021-01-06 12:47:29
                    [post_modified_gmt] => 2021-01-06 12:47:29
                    [post_content_filtered] => 
                    [post_parent] => 0
                    [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-602/
                    [menu_order] => 0
                    [post_type] => product
                    [post_mime_type] => 
                    [comment_count] => 0
                    [filter] => raw
                )

            [1] => WP_Post Object
                (
                    [ID] => 1367
                    [post_author] => 1
                    [post_date] => 2018-04-09 03:51:07
                    [post_date_gmt] => 2018-04-09 03:51:07
                    [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="2/3" offset="vc_col-lg-6 vc_col-md-7"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.[/vc_column_text][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][vc_column width="1/3" offset="vc_col-lg-6 vc_col-md-5"][vc_single_image image="1413" img_size="full" alignment="center"][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1519368676441{margin-top: 20px !important;margin-bottom: 50px !important;}"][vc_column width="1/3"][porto_info_box icon="fa fa-star" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="DEDICATED SERVICE" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][vc_column width="1/3"][porto_info_box icon="fa fa-reply" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="FREE RETURNS" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][vc_column width="1/3"][porto_info_box icon="fa fa-paper-plane" icon_size="28" icon_color="#161616" icon_style="advanced" icon_border_style="solid" icon_color_border="#161616" icon_border_size="2" icon_border_radius="60" icon_border_spacing="60" title="INTERNATIONAL SHIPPING" pos="top" title_font_style="700" title_font_size="14" title_font_line_height="22" title_font_color="#2b2b2d" desc_font_size="14" desc_font_line_height="27" desc_font_color="#4a505e"]Consult our specialists for help with an order, customization, or design advice[/porto_info_box][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.[/vc_column_text][/vc_column][/vc_row]
                    [post_title] => Silver Porto Headset
                    [post_excerpt] => Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.
                    [post_status] => publish
                    [comment_status] => closed
                    [ping_status] => closed
                    [post_password] => 
                    [post_name] => silver-porto-headset
                    [to_ping] => 
                    [pinged] => 
                    [post_modified] => 2020-12-27 11:37:03
                    [post_modified_gmt] => 2020-12-27 11:37:03
                    [post_content_filtered] => 
                    [post_parent] => 0
                    [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-1336/
                    [menu_order] => 0
                    [post_type] => product
                    [post_mime_type] => 
                    [comment_count] => 0
                    [filter] => raw
                )

            [2] => WP_Post Object
                (
                    [ID] => 1358
                    [post_author] => 1
                    [post_date] => 2018-04-09 03:50:55
                    [post_date_gmt] => 2018-04-09 03:50:55
                    [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1511248807031{padding-left: 40px !important;}"][vc_column][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.[/vc_column_text][/vc_column][/vc_row]
                    [post_title] => Black Watch
                    [post_excerpt] => Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.
                    [post_status] => publish
                    [comment_status] => closed
                    [ping_status] => closed
                    [post_password] => 
                    [post_name] => black-watch
                    [to_ping] => 
                    [pinged] => 
                    [post_modified] => 2020-12-22 20:57:15
                    [post_modified_gmt] => 2020-12-22 20:57:15
                    [post_content_filtered] => 
                    [post_parent] => 0
                    [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-1328/
                    [menu_order] => 0
                    [post_type] => product
                    [post_mime_type] => 
                    [comment_count] => 0
                    [filter] => raw
                )

        )

    [post_count] => 3
    [current_post] => 2
    [in_the_loop] => 1
    [post] => WP_Post Object
        (
            [ID] => 1358
            [post_author] => 1
            [post_date] => 2018-04-09 03:50:55
            [post_date_gmt] => 2018-04-09 03:50:55
            [post_content] => [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1511248807031{padding-left: 40px !important;}"][vc_column][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.[/vc_column_text][/vc_column][/vc_row]
            [post_title] => Black Watch
            [post_excerpt] => Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.
            [post_status] => publish
            [comment_status] => closed
            [ping_status] => closed
            [post_password] => 
            [post_name] => black-watch
            [to_ping] => 
            [pinged] => 
            [post_modified] => 2020-12-22 20:57:15
            [post_modified_gmt] => 2020-12-22 20:57:15
            [post_content_filtered] => 
            [post_parent] => 0
            [guid] => http://sw-themes.com/porto_dummy/product/import-placeholder-for-1328/
            [menu_order] => 0
            [post_type] => product
            [post_mime_type] => 
            [comment_count] => 0
            [filter] => raw
        )

    [comment_count] => 0
    [current_comment] => -1
    [found_posts] => 3
    [max_num_pages] => 1
    [max_num_comment_pages] => 0
    [is_single] => 
    [is_preview] => 
    [is_page] => 
    [is_archive] => 1
    [is_date] => 
    [is_year] => 
    [is_month] => 
    [is_day] => 
    [is_time] => 
    [is_author] => 
    [is_category] => 
    [is_tag] => 
    [is_tax] => 1
    [is_search] => 
    [is_feed] => 
    [is_comment_feed] => 
    [is_trackback] => 
    [is_home] => 
    [is_privacy_policy] => 
    [is_404] => 
    [is_embed] => 
    [is_paged] => 
    [is_admin] => 
    [is_attachment] => 
    [is_singular] => 
    [is_robots] => 
    [is_favicon] => 
    [is_posts_page] => 
    [is_post_type_archive] => 
    [query_vars_hash:WP_Query:private] => a19940cd6351a6684d21f044bc5c363d
    [query_vars_changed:WP_Query:private] => 
    [thumbnails_cached] => 
    [stopwords:WP_Query:private] => 
    [compat_fields:WP_Query:private] => Array
        (
            [0] => query_vars_hash
            [1] => query_vars_changed
        )

    [compat_methods:WP_Query:private] => Array
        (
            [0] => init_query_flags
            [1] => parse_tax_query
        )

)

2021-01-08 16:40:37 - En prod id 
2021-01-08 16:40:37 - 1358
2021-01-08 16:40:37 - Arabic prod id 
2021-01-08 16:40:37 - 1358
2021-01-08 16:40:37 - Product transl 
2021-01-08 16:40:37 - [vc_row el_class="m-b-md"][vc_column][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.[/vc_column_text][/vc_column][/vc_row][vc_row el_class="m-b-md" css=".vc_custom_1511248807031{padding-left: 40px !important;}"][vc_column][porto_info_list icon_color="#21293c" font_size_icon="16"][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Any Product types that You want - Simple, Configurable[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Downloadable/Digital Products, Virtual Products[/porto_info_list_item][porto_info_list_item list_icon="fa fa-check-circle" desc_font_size="14"]Inventory Management with Backordered items[/porto_info_list_item][/porto_info_list][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.[/vc_column_text][/vc_column][/vc_row]
2021-01-08 16:40:37 - get_attributes 
