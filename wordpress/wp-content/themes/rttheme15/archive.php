<?php
/* 
* rt-theme archive 
*/
get_header();
$category = get_category_by_slug(get_query_var("category_name"));  
?>

<?php get_template_part( 'sub_page_header', 'sub_page_header_file' );?>

<?php get_template_part( 'loop', 'archive' );?>
  
<?php get_footer();?>