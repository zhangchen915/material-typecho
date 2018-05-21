<?php 
/**
* 友链页
*
* @package custom
*/

$this->need('common/header.php'); ?>

<main class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9 pjax-content">
    <article class="post type-post">
        <h1 class="post-title page-h1" itemprop="name headline">友情链接</h1>
        <ul>
        <?php 
            $lines = explode("\n",$this->options->links);
            foreach($lines as $line){
                $keys = explode(' ', $line);
                echo "<li><a href='//$keys[1]'>$keys[0]</a></li>";
            }
        ?>
        </ul>
    </article>
</main>

<?php $this->need('common/sidebar.php'); ?>
<?php $this->need('common/footer.php'); ?>