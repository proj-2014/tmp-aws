<?php get_header(); ?>


<div class="pages">
    <div class="shadow2"> </div>
    <div class="page-a">
        
      <div class="page_chao"></div>   
     <div class="page_fl"><h1>标签分类</h1>
      <div class="tagit"> <?php wp_tag_cloud('unit=px&smallest=12&largest=12&order=ASC&format=flat'); ?></div>
     <div class="page_fenge"> </div>
     
     
     <div class="fenleinav">
      <?php wp_nav_menu(array( 'theme_location' => 'blog-menu' ) ); ?>
     
     </div>
     
     
     </div>
     



<div class="recommend2">
           <div class="single_enter" >
           
           <div class="single_tit">
           <?php if (have_posts()) : while (have_posts()) : the_post(); ?>    
          <?php if ( has_post_thumbnail()):?>
		 <div class="single_img">
         
         <div class="bigpiccc">
          <?php the_post_thumbnail('full'); ?>
         </div>
         
		 <?php the_post_thumbnail('medium'); ?>
         
         </div>
         <?php else : ?>
        <div class="single_img ddmc"> 
  <img src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" />
  </div>
  <?php  endif; ?>
         
         <div class="single_title">
         <h1><?php the_title(); ?></h1>
           <?php if(get_post_meta($post->ID, "价格",true)):   ?> 
           <p>售价：<a class="jjjg"><?php echo get_post_meta($post->ID, "价格",true);?></a></p>
           <?php else : ?>
           <?php  endif; ?>
         <p class="timesc">发表时间： <?php echo my_entry_published_link(); ?></p>
         <p>商品属性：</p><?php echo the_category(); ?>
         <p class="tagesss"><?php the_tags( '标签: ', ', ', ''); ?></p>
         
         <div class="btnbb">
         <?php if(get_post_meta($post->ID, "购买地址",true)):   ?> 
           <a class="buyit" title="前往购买<?php the_title(); ?>" target="_blank" href=" <?php echo get_post_meta($post->ID, "购买地址",true);?>"></a>
             <?php else : ?>
              <a class="buyit" title="暂无购买地址" ></a>
               <?php  endif; ?>
           <a class="shoucang" title="点击收藏" onclick="AddFavorite(window.location,document.title)" href="javascript:void(0)"></a>
         
         </div>
         
         </div>
        
     
        
          
           </div>
      <div class="entrt">
        
          <?php the_content(); ?>
            <br />
                 <br />
                 <p>本文链接地址：<a href="<?php the_permalink() ?>"><?php the_permalink() ?></a> 转载请保留此地址</p>
                 <br />
            
        <!-- JiaThis Button BEGIN -->
<div id="ckepop">
	<span class="jiathis_txt">分享到：</span>
	<a class="jiathis_button_tools_1"></a>
	<a class="jiathis_button_tools_2"></a>
	<a class="jiathis_button_tools_3"></a>
	<a class="jiathis_button_tools_4"></a>
	<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
	<a class="jiathis_counter_style"></a>
</div>
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1344266415981850" charset="utf-8"></script>
<!-- JiaThis Button END -->
        </div>
      
         <div class="praenav">    
<div class="alignleft"><p><?php if (get_next_post()) { next_post_link('上一篇: %link','%title',true);} else { echo "没有了，已经是最新文章";} ?></p>  </div>
<div class="alignright"><p><?php if (get_previous_post()) { previous_post_link('下一篇: %link','%title',true);} else { echo "没有了，已经是最后文章";} ?> </p>  </div>
</div>    
            <?php endwhile; ?>     
	        <?php else : ?>
            <?php  endif; ?>  
            
     <div class="liuyan">
     
<?php comments_template(); ?>
     </div>       
            
   </div>
   
   <div class="rightmain">
    <?php include_once("sidebar.php"); ?>
     <div title="下一页" class="sideba_next widget ">
     <?php next_posts_link(__('LOAD MORE')); ?>
     </div>
      <div class="sigokg hh1"><p>点击关闭</p></div>
    </div>
   <div class="sigokg hh2"> <p>点击打开小工具</p></div>
</div>

 

 <div id="pager">   <?php par_pagenavi(); ?>  </div>

</div>	
      
    </div>

<?php get_footer(); ?>
