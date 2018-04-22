<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9" id="main" role="main">
        <div class="archive-title">
            <strong><?php echo $this->category(); ?></strong>
            <?php if ($this->getDescription()): ?>
            <div class="descrip"><?php echo $this->getDescription(); ?></div>
            <?php endif; ?>
        </div> 
        <?php $this->need('search-content.php'); ?>
    </div><!-- end #main -->

	<?php $this->need('sidebar.php'); ?>
	<?php $this->need('footer.php'); ?>