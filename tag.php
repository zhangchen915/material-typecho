<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('common/header.php'); ?>

<main class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9 pjax-content">
    <h3 class="archive-title">
        <?php $this->archiveTitle(array('tag'   =>  _t('标签“ %s ”下的所有文章')), '', ''); ?>
    </h3> 
    <?php $this->need('search-content.php'); ?>
</main>

<?php $this->need('common/sidebar.php'); ?>
<?php $this->need('common/footer.php'); ?>