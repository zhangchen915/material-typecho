<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('common/header.php'); ?>

<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9 pjax-content" id="main" role="main">
    <article class="post">
        <h1 class="post-title" itemprop="name headline"><?php $this->title() ?></h1>
        <ul class="post-meta">
            <li itemprop="author">作者：<a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
            <li>时间：<time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time></li>
            <li>分类：<?php $this->category(','); ?></li>
            <li>阅读：<?php get_post_view($this) ?>次</li>
        </ul>

        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>

        <div class="creative-commons <?php echo $this->options->CC ?>"></div>
        <div itemprop="keywords" class="tags">标签：<?php $this->tags(', ', true, '无'); ?></div>

        <?php $this->related(4)->to($relatedPosts); ?>
        <?php if ($relatedPosts->have()): ?>
        <div class="related">
            <h3>相关文章推荐</h3>
            <ul class="clearfix">
                <?php while ($relatedPosts->next()): ?>
                <li><a href="<?php $relatedPosts->permalink(); ?>"><?php $relatedPosts->title(); ?></a></li>
                <?php endwhile; ?>
            </ul>
        </div>
        <?php endif; ?>

        <ul class="post-near">
            <li>上一篇：<?php $this->thePrev('%s','没有了'); ?></li>
            <li>下一篇：<?php $this->theNext('%s','没有了'); ?></li>
        </ul>
    </article>

    <?php $this->need('common/comments.php'); ?>
</div><!-- end #main-->

<?php $this->need('common/sidebar.php'); ?>
<?php $this->need('common/footer.php'); ?>