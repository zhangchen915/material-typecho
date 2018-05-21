<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('common/header.php'); ?>

<main class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9 pjax-content">
    <h3 class="archive-title"><?php $this->archiveTitle(array(
        'search'    =>  _t('包含关键字 %s 的文章'),
        'tag'       =>  _t('标签 %s 下的文章'),
        'author'    =>  _t('%s 发布的文章')
    ), '', ''); ?></h3>
    <?php $this->need('common/search-content.php'); ?>
</main>

<?php $this->need('common/sidebar.php'); ?>
<?php $this->need('common/footer.php'); ?>