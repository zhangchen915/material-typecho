<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('common/header.php'); ?>

<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9" id="main" role="main">
    <h3 class="archive-title"><?php $this->author();_e('文章列表 ') ?></h3> 
    <?php $this->need('common/search-content.php'); ?>
</div>

<?php $this->need('common/sidebar.php'); ?>
<?php $this->need('common/footer.php'); ?>