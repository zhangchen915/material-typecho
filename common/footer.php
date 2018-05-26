    </div>

    <div id="goTop" class="mdc-fab fab-hidden">
        <div class="arrow"></div>
        <div class="stick"></div>
    </div>
</div>
<footer id="footer">
    <?php echo $this->options->recordNUM ?>  Copyright&copy;<?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    <?php if(!is_mobile()) : ?>由 <a href="http://www.typecho.org" target="_blank">Typecho</a> 强力驱动 Theme by 字节猫
    <?php endif;?>
</footer>
</div>

<script src="<?php $this->options->themeUrl('dist/index.js'); ?>"></script>
</body>
</html>