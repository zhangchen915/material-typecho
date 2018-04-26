<?php if ($this->have()): ?>
    <?php while($this->next()): ?>
        <article class="post type-post">
            <h2 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
            <ul class="post-meta">
                <li>时间：<time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time></li>
                <li>分类：<?php $this->category(','); ?></li>
                <li>阅读：<?php $this->views(); ?>次</li>
            </ul>
            <div class="post-content" itemprop="articleBody">
                <?php $this->content('阅读全文&raquo;'); ?>
            </div>
        </article>
    <?php endwhile; ?>
    <?php else: ?>
    <article class="post type-post">
        <h2 class="post-title">没有找到内容</h2>
    </article>
<?php endif; ?>

<?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>