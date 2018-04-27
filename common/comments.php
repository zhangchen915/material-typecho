<?php
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    $depth = $comments->levels +1;
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '"target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
?>

<li id="li-<?php $comments->theId(); ?>" class="comment even thread-even depth-<?php echo $depth ?> <?php $comments->alt(' comment-odd', 'comment-even');?>">
    <article id="<?php $comments->theId(); ?>" class="comment-body">
        <div class="comment-meta">
            <div class="comment-author vcard">
                <?php
                    $host = 'https://cdn.v2ex.com'; //自定义头像CDN服务器
                    $url = '/gravatar/'; //自定义头像目录,一般保持默认即可
                    $size = '100'; //自定义头像大小
                    $rating = Helper::options()->commentsAvatarRating;
                    $hash = md5(strtolower($comments->mail));
                    $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=';
                ?>
                <img class="avatar" src="<?php echo $avatar ?>">
                <b class="fn <?php echo $commentClass; ?>" itemprop="author"><?php echo $author; ?></b>
            </div>

            <span class="comment-metadata">
                <time datetime="2017-05-14T17:25:49+08:00" itemprop="datePublished"><?php $comments->date('M j, Y'); ?></time>
            </span>

            <span class="comment-actions"><?php $comments->reply('回复'); ?></span>
        </div>
        <!-- .comment-meta -->

        <div class="comment-content" itemprop="text">
            <p>           
            <?php 
            get_comment_at($comments->coid);
            $cos = preg_replace('#\@\((.*?)\)#','<img src="/usr/themes/Casper-For-Typecho/newpaopao/$1.png" class="biaoqing">',$comments->content);
            $cos1 = preg_replace('#<p>#','',$cos);
            $cos2 = preg_replace('#</p>#','',$cos1);
            echo $cos2;
            ?>
            </p>
        </div>
    </article>

    <?php if ($comments->children) { ?>
        <div class="children">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
</li>
<?php } ?>


<div id="<?php $this->respondId(); ?>" class="comment-respond">
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>

    <h3 id="reply-title" class="comment-reply-title">
        <span>发表评论</span>
        <?php $comments->cancelReply('取消回复'); ?>
    </h3>
    
    <form action="<?php $this->commentUrl() ?>" method="post" id="commentform" class="comment-form<?php $commentClass ?>">
        <div class="comment-form-main">
            <div class="mdc-text-field mdc-text-field--textarea mdc-text-field--fullwidth">
                <textarea id="textarea" name="text" class="mdc-text-field__input" rows="8" cols="40" required><?php $this->remember('text',false); ?></textarea>
                <label for="textarea" class="mdc-floating-label">输入评论</label>
            </div>
                        
            <div class="comment-form-fields">
                <div class="mdc-text-field">
                    <input type="text" id="author" class="mdc-text-field__input" name="author" maxlength="12" required>
                    <label class="mdc-floating-label" for="author">昵称</label>
                    <div class="mdc-line-ripple"></div>
                </div>

                <div class="mdc-text-field">
                    <input type="email" name="mail" id="mail" class="mdc-text-field__input" <?php if ($this->options->commentsRequireMail): ?>required<?php endif; ?>>
                    <label class="mdc-floating-label" for="mail">邮箱</label>
                    <div class="mdc-line-ripple"></div>
                </div>

                <div class="mdc-text-field">
                    <input type="url" name="url" id="url" class="mdc-text-field__input" <?php if ($this->options->commentsRequireURL): ?>required<?php endif; ?>>
                    <label class="mdc-floating-label" for="url">网站</label>
                    <div class="mdc-line-ripple"></div>
                </div>
            </div>
         
            <button name="submit" type="submit" class="mdc-button mdc-button--stroked">提交</button> 
            <?php $security = $this->widget('Widget_Security'); ?>
            <input type="hidden" name="_" value="<?php echo $security->getToken($this->request->getReferer())?>">
     
        </div>
        <!-- <div class="comment-form-extra">
            <span class="response"><?php if($this->user->hasLogin()): ?> You are <a href="<?php $this->options->profileUrl(); ?>" data-no-instant><?php $this->user->screenName(); ?></a> here, do you want to <a href="<?php $this->options->logoutUrl(); ?>" data-no-instant>logout</a> ?<?php endif; ?></span>
            
        </div> -->
    </form>

    <?php else : ?>
        <!-- <span class="response">Comments are closed.</span> -->
    <?php endif; ?>

    <?php if ($comments->have()): ?>
    <div class="comment-separator"><div class="comment-tab-current"><span class="comment-num"><?php $this->commentsNum(_t('暂无评论'), _t('已有 1 条评论'), _t('已有 %d 条评论')); ?></span></div></div>
    <?php $comments->listComments(); ?>

    <div class="lists-navigator clearfix">
        <?php $comments->pageNav('←','→','2','...'); ?>
    </div>

    <?php endif; ?>
</div>

<?php if(!$this->user->hasLogin()){ ?>
<script type="text/javascript">
    function getCookie(name) {
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        if (arr = document.cookie.match(reg))
            return unescape(decodeURI(arr[2]));
        else
            return null;
    }

    function adduser() {
        document.getElementById('author').value = getCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_author');
        document.getElementById('mail').value = getCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_mail');
        document.getElementById('url').value = getCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_url');
    }
    adduser();
</script>
<?php } ?>