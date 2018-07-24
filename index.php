<?php
/**
 * Typecho Material 风格主题。
 * 
 * - pjax
 * - custome theam color
 * - image zooming
 * - code hightlight
 * - Google analyze
 * - CC listens
 * 
 * Issue https://github.com/zhangchen915/material-typecho/issues
 * 
 * @package Material-typecho 
 * @author zhangchen915
 * @version 1.0
 * @link https://zhangchen915.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('common/header.php'); ?>

<main class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9 pjax-content">
	<?php while($this->next()): ?>
        <article class="post type-post" >
			<h2 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
			<ul class="post-meta">
				<li itemprop="author">作者：<a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
				<li>时间：<time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time></li>
				<li>分类：<?php $this->category(','); ?></li>
			</ul>
			<a href="<?php $this->permalink() ?>" class="entry-summary mdc-layout-grid__inner">
				<?php if($this->options->thumbnail == 'open' && get_thumbnail($this)): ?>
				<div class="thumbnail mdc-layout-grid__cell--span-4" style="background-image: url('<?php echo get_thumbnail($this) ?>')"></div>
				<p class="mdc-layout-grid__cell--span-8"><?php $this->excerpt(250, '...'); ?></p>
				<?php else : ?>
				<p class="mdc-layout-grid__cell--span-12"><?php $this->excerpt(250, '...'); ?></p>
				<?php endif; ?>
			</a>
        </article>
	<?php endwhile; ?>

    <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
</main>

<?php $this->need('common/sidebar.php'); ?>
<?php $this->need('common/footer.php'); ?>