<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('common/header.php'); ?>

<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9 pjax-content" id="main" role="main">
    <div class="archive-title">
        <strong><?php echo $this->category(); ?></strong>
        <?php if ($this->getDescription()): ?>
        <div class="descrip"><?php echo $this->getDescription(); ?></div>
        <?php endif; ?>
    </div> 
    <?php $this->need('common/search-content.php'); ?>
</div>

<?php $this->need('common/sidebar.php'); ?>
<?php $this->need('common/footer.php'); ?>