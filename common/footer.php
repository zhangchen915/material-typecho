    </div>

    <div id="goTop" class="mdc-fab fab-hidden">
        <div class="arrow"></div>
        <div class="stick"></div>
    </div>
</div>
<footer id="footer">
    <div class="icons">
        <?php
            $icons = explode("\n",$this->options->icons);
            foreach($icons as $icon){
                $keys = explode(' ', $icon);
                echo "<a id='$keys[0]' href='$keys[1]'></a>";
            }
        ?>
    </div>

    <?php echo $this->options->recordNUM ?>  Copyright&copy;<?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    <?php if(!is_mobile()) : ?>由 <a href="http://www.typecho.org" target="_blank">Typecho</a> 强力驱动 Theme by 字节猫
    <?php endif;?>
</footer>
</div>

<div class="mdc-snackbar">
  <div class="mdc-snackbar__surface">
    <div class="mdc-snackbar__label"></div>
    <div class="mdc-snackbar__actions">
      <button type="button" class="mdc-button mdc-snackbar__action"></button>
    </div>
  </div>
</div>

<script src="<?php $this->options->themeUrl('dist/index.js'); ?>"></script>
</body>
</html>