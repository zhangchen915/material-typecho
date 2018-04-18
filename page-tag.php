
<?php
/**
* 云标签
*
* @package custom
*/
 if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="grid-3-4" id="main" role="main">
    <article class="post type-post">
        <h1 class="post-title page-h1" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="tag-cloud">
        <?php if($this->slug=="tags"): ?>
<?php Typecho_Widget::widget('Widget_Metas_Tag_Cloud')->to($tags); ?>
<?php if($tags->have()): ?>
    <?php while ($tags->next()): ?>
    <a style="background:rgb(<?php echo(rand(0,255)); ?>,<?php echo(rand(0,255)); ?>,
           <?php echo(rand(0,255)); ?>);color:#fff" href="<?php $tags->permalink();?>">
         <?php $tags->name(); ?>(<?php $tags->count() ?>)</a>
    <?php endwhile; ?>
<?php endif; ?>
<?php else: ?>
<?php $this->content(); ?>
<?php endif; ?>
</div>
    </article>
</div><!-- end #main-->

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php $this->need('sidebar.php'); ?>

<?php $this->need('footer.php'); ?>
