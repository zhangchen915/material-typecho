<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('common/header.php'); ?>

<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9" id="main" role="main">
	<?php while($this->next()): ?>
        <article class="post type-post" >
			<h2 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
			<ul class="post-meta">
				<li itemprop="author">作者：<a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
				<li>时间：<time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time></li>
				<li>分类：<?php $this->category(','); ?></li>
			</ul>
            <div class="post-content" itemprop="articleBody">
                <?php $this->content('阅读全文&raquo;'); ?>
            </div>
        </article>
	<?php endwhile; ?>

    <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
</div><!-- end #main-->

<?php $this->need('common/sidebar.php'); ?>
<?php $this->need('common/footer.php'); ?>