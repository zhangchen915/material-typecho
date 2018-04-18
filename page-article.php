
<?php
/**
* 文章存档页
*
* @package custom
*/
 if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="grid-3-4" id="main" role="main">
    <article class="post type-post">
        <h1 class="post-title page-h1" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
       <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);   
    $year=0; $mon=0; $i=0; $j=0;   
    $output = '<div id="archives">';   
    while($archives->next()):   
        $year_tmp = date('Y',$archives->created);   
        $mon_tmp = date('m',$archives->created);   
        $y=$year; $m=$mon;   
        if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';   
        if ($year != $year_tmp && $year > 0) $output .= '</ul>';   
        if ($year != $year_tmp) {   
            $year = $year_tmp;   
            $output .= '<h3 class="al_year">'. $year .' 年</h3><ul class="al_mon_list">'; //输出年份   
        }   
        if ($mon != $mon_tmp) {   
            $mon = $mon_tmp;   
            $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份   
        }   
        $output .= '<li>'.date('d日：',$archives->created).'<a href="'.$archives->permalink .'">'. $archives->title .'</a>  </li>'; //输出文章日期和标题   
        // <em>('. $archives->commentsNum.')</em>
      
    endwhile;   
    $output .= '</ul></li></ul></div>';   
    echo $output;   
?>  
    </article>
</div><!-- end #main-->

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php $this->need('sidebar.php'); ?>

<?php $this->need('footer.php'); ?>
