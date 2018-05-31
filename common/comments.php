<?php function threadedComments($comments, $options) {
    $host = 'https://cdn.v2ex.com';
    $url = '/gravatar/';
    $size = '100';
    $rating = Helper::options()->commentsAvatarRating;
    $hash = md5(strtolower($comments->mail));
    $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=';

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

<li id="li-<?php $comments->theId(); ?>" class="comment depth-<?php echo $depth ?>">
    <article id="<?php $comments->theId(); ?>" class="comment-body">
        <div class="comment-avatar" style="background-image: url('<?php echo $avatar ?>')"></div>

        <div class="comment-content">
            <div>
                <span class="comment-author <?php echo $commentClass; ?>"><?php echo $author; ?></span>
                <span class="comment-metadata"><time><?php $comments->date('M j, Y'); ?></time></span>
                <span class="comment-actions"><?php $comments->reply('回复'); ?></span>
            </div>
            <?php $comments->content(); ?>
        </div>
    </article>

    <?php if ($comments->children) { ?>
        <div class="comment-child">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
</li>
<?php } ?>


<div id="<?php $this->respondId(); ?>" class="comment-respond">
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
    <h3>
        <span>发表评论</span>
        <?php if($this->user->hasLogin()): ?><span><a href="<?php $this->options->logoutUrl(); ?>">登出</a></span><?php endif; ?>
        <?php $comments->cancelReply('取消回复'); ?>
    </h3>
    
    <form data-url="<?php $this->commentUrl() ?>"
          data-login="<?php echo $this->user->hasLogin() ?>"
          data-urlPrefix="<?php echo md5($this->request->getUrlPrefix()); ?>"
          class="comment-form <?php $commentClass ?>">
        <div class="comment-form-main">
            <div class="mdc-text-field mdc-text-field--textarea mdc-text-field--fullwidth">
                <textarea id="textarea" name="text" class="mdc-text-field__input" rows="8" cols="40" required><?php $this->remember('text',false); ?></textarea>
                <label for="textarea" class="mdc-floating-label">输入评论</label>
            </div>
                        
            <div class="comment-form-fields">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-text-field mdc-layout-grid__cell--span-3 mdc-layout-grid__cell--span-12-phone">
                        <input type="text" id="author" class="mdc-text-field__input" name="author" maxlength="12" required>
                        <label class="mdc-floating-label" for="author">昵称</label>
                        <div class="mdc-line-ripple"></div>
                    </div>

                    <div class="mdc-text-field mdc-layout-grid__cell--span-3 mdc-layout-grid__cell--span-12-phone">
                        <input type="email" name="mail" id="mail" class="mdc-text-field__input" <?php if ($this->options->commentsRequireMail): ?>required<?php endif; ?>>
                        <label class="mdc-floating-label" for="mail">邮箱</label>
                        <div class="mdc-line-ripple"></div>
                    </div>

                    <div class="mdc-text-field mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-12-phone">
                        <input type="url" name="url" id="url" class="mdc-text-field__input" <?php if ($this->options->commentsRequireURL): ?>required<?php endif; ?>>
                        <label class="mdc-floating-label" for="url">网站</label>
                        <div class="mdc-line-ripple"></div>
                    </div>

                    <button id="comment-submit" type="submit" class="mdc-button mdc-button--outlined
                                                                     mdc-ripple-upgraded mdc-layout-grid__cell--span-2
                                                                     mdc-layout-grid__cell--span-12-phone
                                                                     mdc-layout-grid__cell--align-middle">提交</button>
                </div>
            </div>
        </div>
    </form>

    <?php else : ?>
        <!-- <span class="response">Comments are closed.</span> -->
    <?php endif; ?>

    <?php if ($comments->have()): ?>
    <div class="comment-separator"><div class="comment-tab-current"><span class="comment-num"><?php $this->commentsNum(_t('暂无评论'), _t('已有 1 条评论'), _t('已有 %d 条评论')); ?></span></div></div>
    <?php $comments->listComments(); ?>

    <div class="lists-navigator">
        <?php $comments->pageNav('←','→','3','...'); ?>
    </div>
    <?php endif; ?>
</div>