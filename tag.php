<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9" id="main" role="main">
        <h3 class="archive-title">
            <?php $this->archiveTitle(array('tag'   =>  _t('标签“ %s ”下的所有文章')), '', ''); ?>
        </h3> 
        <?php $this->need('search-content.php'); ?>
    </div><!-- end #main -->

	<?php $this->need('sidebar.php'); ?>
	<?php $this->need('footer.php'); ?>
