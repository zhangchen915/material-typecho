        </div>
</div><!-- end #body -->
<div id="goTop">
	<div class="arrow"></div>
	<div class="stick"></div>
</div>

</div><!-- content -->
<footer id="footer" class="<?php if(is_mobile()) {echo 'mbfoot';}?>" role="contentinfo">
    <?php echo $this->options->recordNUM ?>  Copyright&copy;<?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    <?php if(!is_mobile()) : ?>由 <a href="http://www.typecho.org" target="_blank">Typecho</a> 强力驱动 Theme by 字节猫
        <!-- <a href="https://www.upyun.com/"><img src="https://zhangchen915.com/usr/uploads/2017/12/2040246397.png"  alt="" style="width: 75px;vertical-align: middle;"></a> -->
    <?php endif;?>
</footer>
<?php $this->footer(); ?>

<script src="<?php $this->options->themeUrl('dist/index.js'); ?>"></script>
</body>
</html>