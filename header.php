<!--[if lte IE 11]><script>(function(){var e="abbr,article,aside,audio,canvas,datalist,details,figure,footer,header,hgroup,mark,menu,meter,nav,output,progress,section,time,video".split(','),i=e.length;while(i--){document.createElement(e[i]);}}());</script><![endif]-->
<!DOCTYPE html>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php if($this->options->recordNUM): ?>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create',<?php echo $this->options->recordNUM ?>, 'auto');
    ga('send', 'pageview');
    </script>
    <?php endif;?>

    <title>
        <?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' | '); ?>
        <?php $this->options->title(); ?>
        <?php if($this->is('index')){echo " | "; $this->options->description(); }?>
    </title>

    <!-- 使用url函数转换相关路径 $this->options->css -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('dist/' . 'index' . '.css'); ?>">

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header('generator=&template=&pingback=&xmlrpc=&wlw=&rss1=&rss2=&atom=&commentReply='); ?>
</head>

<body<?php if(is_mobile()) {echo ' class="mobile-body"';}?>>

<!--[if lt IE 11]>
    <div class="browsehappy" role="dialog">当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请<a href="http://browsehappy.com/">升级你的浏览器</a></div>
<![endif]-->

<div>
<canvas class='connecting-dots'></canvas>
<header id="header">
    <div id="menu-bar" class="container">
        <h1 class="logo"><a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a></h1>
        
        <nav id="nav-menu" class="clearfix" role="navigation">
            <a<?php if($this->is('index')): ?> class="current mdc-button mdc-button--unelevated color-filled-button"<?php endif; ?> class="mdc-button mdc-button--unelevated color-filled-button" href="<?php $this->options->siteUrl(); ?>" id="home">首页</a>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
            <a<?php if($this->is('page', $pages->slug)): ?> class="current mdc-button mdc-button--unelevated color-filled-button"<?php endif; ?> class="mdc-button mdc-button--unelevated color-filled-button" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
            <?php endwhile; ?>
                <?php if(is_mobile()) : ?>
                <a href="javascript:;" class="searchicon"><img src="<?php $this->options->themeUrl('dist/img/search.png'); ?>" alt=""></a>
            <?php endif;?>
                <?php if(is_mobile()) : ?>
                <input type="checkbox" id="button">
                <label for="button" onclick=""></label>
                <ul>
                    <li><a class="mdc-button mdc-button--unelevated color-filled-button" href="<?php $this->options->siteUrl(); ?>" id="home">首页</a></li>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <li><a href="<?php $pages->permalink(); ?>" class="mdc-button mdc-button--unelevated color-filled-button"><?php $pages->title(); ?></a></li>
                    <?php endwhile; ?> 
                </ul>
            <?php endif;?>
        </nav>
    </div>

    <?php if(is_mobile()) : ?>
    <div class="mb-search">
        <form id="bmsearchform" method="post" action="./" role="search">
            <input type="text" name="s" class="bmtext" autocomplete="on" placeholder="输入关键字搜索" />
        </form>
    </div>
    <?php endif;?>
</header><!-- end #header -->
<div id="body">
    <div class="container mdc-layout-grid">
        <div class="mdc-layout-grid__inner">