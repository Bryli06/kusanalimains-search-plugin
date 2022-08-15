<?php
/**
 * Plugin Name: Search Guides 
 * Version: 0.1
 * Author: Bryan Li 
 */

add_action('init', 'register_script');
function register_script() {
	wp_register_style('list_all_posts', plugins_url('style.css',__FILE__),  array(), rand(111,9999), 'all');
}

add_action('wp_enqueue_scripts', 'enqueue_style');

function enqueue_style(){
	wp_enqueue_style('list_all_posts');
}

function search_bar(){
	
	$string = '
		<div class="primary-search">
			<div class="primary-search-inner">
				<form class="primary-search-form" autocomplete="off" onsubmit="event.preventDefault();"> 
					<label class="primary-search-label"> 
						<span class="screen-reader-text"> 
							Search for: 
						</span> 
						<input type="search" id="mySearch" onkeyup="searchDeezNuts();" class="primary-search-field" placeholder="Type guide name here..." value="" name="s" title="Search for:"> 
					</label> 
				</form>
			</div>
		</div>';
	return $string;
}

function list_all_posts(){
	wp_register_style('list_all_posts', plugins_url('style.css',__FILE__));
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'orderby' => 'title',
		'order' => 'ASC',
    	);

	$the_query = new WP_Query($args);
	$layer_element = mt_rand();
	$string .= '
		<div id = "myGrid-Guides" class="myGrid grid"> 
			<div id="myUL" class="grid-items">'; 
	if ($the_query->have_posts() ){
		while($the_query->have_posts()) {
			$the_query->the_post();
			$post_id = get_the_id();
			$layout_name = get_the_title();
			$product_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
			$product_thumb_url = isset($product_thumb['0']) ? esc_url($product_thumb['0']) : '';

			$layout_preview_img = '';

			$product_thumb_url = !empty($product_thumb_url) ? $product_thumb_url : $layout_preview_img;
			$string .= 	'<div class="item item-'.$post_id.' your-mother"> 
						<div class="layer-wrapper layout-1155"> 
							<div class="layer-media element_1587187627902" id=""> 
								<div class="element element_1587190790308  element-media ">
									<a target="_self" href="'.get_permalink().'">
										<img src="'.$product_thumb_url.'" class="attachment-large size-large wp-post-image" alt="" width="'.$product_thumb['1'].'" height="'.$product_thumb['2'].'">
									</a> 
								</div>
							</div>
							<div class="layer-content element_1587187714568" id="">
								<div class="element element_1587187895341  title " style="text-align: center">
									<a id="amongus" target="_blank" href="'.get_permalink($post_id).'">
										'.$layout_name.'
									</a>
								</div>
							</div>

						</div>
					</div>';
		}
	}

	$string .=    	'</div>
			<style type="text/css">
				.layout-1155 .element_1587187627902{
				}
			</style>
			<style type="text/css">
			.layout-1155 .element_1587190790308{
    				overflow: hidden;
			}
			@media only screen and (min-width: 1024px ){
    				.layout-1155 .element_1587190790308{
                			height: auto;
        			}
			}
			@media only screen and ( min-width: 768px ) and ( max-width: 1023px ) {
    				.layout-1155 .element_1587190790308{
            				height: auto;
        			}
			}
			@media only screen and ( min-width: 0px ) and ( max-width: 767px ){
    				.layout-1155 .element_1587190790308{
            				height: auto;
        			}
			}
			</style>
			<style type="text/css">
				.layout-1155 .element_1587187714568{
    					margin: 10px;
				}
			</style>
			<style type="text/css">
				.layout-1155 .element_1587187895341{
    					font-size: 18px;
    					margin: 5px 0px;
    					text-align: left;
				}
				.layout-1155 .element_1587187895341 a{
    					font-size: 18px;
				}
			</style>
			<style type="text/css">
				.layout-1155 a{text-decoration:none}.layout-1155{vertical-align:top}.layout-1155 .layer-content{padding:10px}\
			</style>
			<style type="text/css">
        			#myGrid-Guides {
                    			padding:10px;
                        	}
        			#myGrid-Guides .grid-items{
                    			text-align: center;
                		}
       			 	#myGrid-Guides .item{
                    			margin:10px;
                            		padding:0px;
                            		background:#3a3a3a;
                		}
        			#myGrid-Guides  .item .layer-media{
					height:auto;
				}
        			@media only screen and ( min-width: 0px ) and ( max-width: 767px ) {

            				#myGrid-Guides .grid-items{
                           	 		grid-template-columns: 1fr;
                        		}


            				#myGrid-Guides .item{
                        			height:auto;
					}
        			}
        			@media only screen and ( min-width: 768px ) and ( max-width: 1023px ) {
            				#myGrid-Guides .grid-items{
						grid-template-columns: 1fr 1fr;
                        		}

           	 			#myGrid-Guides .item{
						max-height:auto;            
					}
        			}
        			@media only screen and (min-width: 1024px ){

            				#myGrid-Guides .grid-items{
                            			grid-template-columns: 1fr 1fr 1fr;
                        		}


            				#myGrid-Guides .item{
						height:auto;            
					}
        			}

        

    			</style>
			<script type="text/javascript">

				function searchDeezNuts() {
    					var input, filter, ul, li, a, i, txtValue;
    					input = document.getElementById("mySearch");
    					filter = input.value.toUpperCase();
   		 			myUL = document.getElementById("myUL");
    					list = myUL.getElementsByClassName("your-mother");
					console.log(list)
					for (let i of list) {
						console.log(i);
        					if (i.textContent.replace(/[^\x00-\x7F]/g, "").toUpperCase().indexOf(filter) > -1) {
            						i.style.display = "";
        					} else {
            						i.style.display = "none";
        					}
    					}
				}
			</script>
    		</div>';
	return $string;
}

function list_new_posts(){
	wp_register_style('list_all_posts', plugins_url('style.css',__FILE__));
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'orderby' => 'modified',
		'order' => 'DESC',
    	);

	$the_query = new WP_Query($args);
	$layer_element = mt_rand();
	$string .= '
		<div id = "myGrid-Guides" class="myGrid grid"> 
			<div id="myUL" class="grid-items">'; 
	if ($the_query->have_posts() ){
		$i = 0;
		while($the_query->have_posts() && $i<3) {
			$i++;
			$the_query->the_post();
			$post_id = get_the_id();
			$layout_name = get_the_title();
			$product_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
			$product_thumb_url = isset($product_thumb['0']) ? esc_url($product_thumb['0']) : '';

			$layout_preview_img = '';

			$product_thumb_url = !empty($product_thumb_url) ? $product_thumb_url : $layout_preview_img;
			$string .= 	'<div class="item item-'.$post_id.' your-mother"> 
						<div class="layer-wrapper layout-1155"> 
							<div class="layer-media element_1587187627902" id=""> 
								<div class="element element_1587190790308  element-media ">
									<a target="_self" href="'.get_permalink().'">
										<img src="'.$product_thumb_url.'" class="attachment-large size-large wp-post-image" alt="" width="'.$product_thumb['1'].'" height="'.$product_thumb['2'].'">
									</a> 
								</div>
							</div>
							<div class="layer-content element_1587187714568" id="">
								<div class="element element_1587187895341  title " style="text-align: center">
									<a target="_blank" href="'.get_permalink($post_id).'">
										'.$layout_name.'
									</a>
								</div>
							</div>

						</div>
					</div>';

		}
	}

	$string .=    	'</div>
			<style type="text/css">
				.layout-1155 .element_1587187627902{
				}
			</style>
			<style type="text/css">
			.layout-1155 .element_1587190790308{
    				overflow: hidden;
			}
			@media only screen and (min-width: 1024px ){
    				.layout-1155 .element_1587190790308{
                			height: auto;
        			}
			}
			@media only screen and ( min-width: 768px ) and ( max-width: 1023px ) {
    				.layout-1155 .element_1587190790308{
            				height: auto;
        			}
			}
			@media only screen and ( min-width: 0px ) and ( max-width: 767px ){
    				.layout-1155 .element_1587190790308{
            				height: auto;
        			}
			}
			</style>
			<style type="text/css">
				.layout-1155 .element_1587187714568{
    					margin: 10px;
				}
			</style>
			<style type="text/css">
				.layout-1155 .element_1587187895341{
    					font-size: 18px;
    					margin: 5px 0px;
    					text-align: left;
				}
				.layout-1155 .element_1587187895341 a{
    					font-size: 18px;
				}
			</style>
			<style type="text/css">
				.layout-1155 a{text-decoration:none}.layout-1155{vertical-align:top}.layout-1155 .layer-content{padding:10px}\
			</style>
			<style type="text/css">
        			#myGrid-Guides {
                    			padding:10px;
                        	}
        			#myGrid-Guides .grid-items{
                    			text-align: center;
                		}
       			 	#myGrid-Guides .item{
                    			margin:10px;
                            		padding:0px;
                            		background:#3a3a3a;
                		}
        			#myGrid-Guides  .item .layer-media{
					height:auto;
				}
        			@media only screen and ( min-width: 0px ) and ( max-width: 767px ) {

            				#myGrid-Guides .grid-items{
                           	 		grid-template-columns: 1fr;
                        		}


            				#myGrid-Guides .item{
                        			height:auto;
					}
        			}
        			@media only screen and ( min-width: 768px ) and ( max-width: 1023px ) {
            				#myGrid-Guides .grid-items{
						grid-template-columns: 1fr 1fr;
                        		}

           	 			#myGrid-Guides .item{
						max-height:auto;            
					}
        			}
        			@media only screen and (min-width: 1024px ){

            				#myGrid-Guides .grid-items{
                            			grid-template-columns: 1fr 1fr 1fr;
                        		}


            				#myGrid-Guides .item{
						height:auto;            
					}
        			}

        

			</style>
    		</div>';
	return $string;
}

add_shortcode('search','search_bar');
add_shortcode('posts','list_all_posts');
add_shortcode('new_posts','list_new_posts');




