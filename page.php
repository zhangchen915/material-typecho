<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('common/header.php'); ?>

<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9" id="main" role="main">
    <article class="post type-post">
        <h1 class="post-title page-h1" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
    </article>
    <?php $this->need('common/comments.php'); ?>
</div>

<?php $this->need('common/sidebar.php'); ?>
<?php $this->need('common/footer.php'); ?>
