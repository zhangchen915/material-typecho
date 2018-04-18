<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <div class="grid-3-4" id="main" role="main">
        <div class="archive-title type-post">
            <strong><?php echo $this->category(); ?></strong>
             <div class="descrip"><?php echo $this->getDescription(); ?></div>
        </div> 
        <?php if ($this->have()): ?>
    	<?php while($this->next()): ?>
            <article class="post type-post">
    			<h2 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
    			<ul class="post-meta">
    				<li><?php _e('时间: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time></li>
    				<li><?php _e('分类: '); ?><?php $this->category(','); ?></li>
                     <li><span>阅读：<?php $this->views(); ?>次</span></li>
    			</ul>
                <div class="post-content" itemprop="articleBody">
        			<?php $this->content('阅读全文&raquo;'); ?>
                </div>
    		</article>
    	<?php endwhile; ?>
        <?php else: ?>
            <article class="post type-post">
                <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
            </article>
        <?php endif; ?>

        <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    </div><!-- end #main -->

	<?php $this->need('sidebar.php'); ?>
	<?php $this->need('footer.php'); ?>
