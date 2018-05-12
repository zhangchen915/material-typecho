<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $form->addInput($logoUrl);

    $recordNUM =  new Typecho_Widget_Helper_Form_Element_Text('recordNUM', NULL, NULL, _t('备案号'), _t(''));
    $form->addInput($recordNUM);

    $GA =  new Typecho_Widget_Helper_Form_Element_Text('GA', NULL, NULL, _t('GA号'), _t(''));
    $form->addInput($GA);

    $color =  new Typecho_Widget_Helper_Form_Element_Text('color', NULL, '#429E46', _t('主题颜色'), _t(''));
    $form->addInput($color);

    $CC = new Typecho_Widget_Helper_Form_Element_Radio('CC',
    array(
    'CC-BY' => _t('署名'),
    'CC-BY-SA' => _t('署名--禁止演绎'),
    'CC-BY-NC' => _t('署名--非商业性使用'),
    'CC-BY-NC-SA' => _t('署名--非商业性使用--禁止演绎'),
    'CC-BY-NC-ND' => _t('署名--非商业性使用--相同方式共享'),
    'CC-BY-ND' => _t('署名--相同方式共享')),
    'CC-BY-NC-SA',_t('知识共享协议'));
    $form->addInput($CC->multiMode());

    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowSearch' => _t('显示搜索框'),'ShowCategory' => _t('显示分类'),'ShowRecentPosts' => _t('显示最新文章'),'ShowArchive' => _t('显示归档'),'ShowTags' => _t('显示标签')),
    array('ShowSearch', 'ShowCategory', 'ShowRecentPosts', 'ShowTags'), _t('侧边栏显示'));
    $form->addInput($sidebarBlock->multiMode());
}

function is_mobile() {
    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        '/blackberry/i' => 'BlackBerry', 
        '/webos/i' => 'Mobile'
    );
    
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            return true;
        }
    }

    return false;
}

//获取评论的锚点链接
function get_comment_at($coid){
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')->from('table.comments')
                                 ->where('coid = ? AND status = ?', $coid, 'approved'));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')
                                     ->where('coid = ? AND status = ?', $parent, 'approved'));
        $author = $arow['author'];
        $href   = '<span class="comment-reply-author" href="#comment-' . $parent . '">@' . $author . '</span>';
        echo $href;
    } else {
        echo '';
    }
}

function get_post_view($archive){
	$cid    = $archive->cid;
	$db     = Typecho_Db::get();
	$prefix = $db->getPrefix();
	if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
		$db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
		echo 0;
		return;
	}
	$row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
	if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
		if(empty($views)){
			$views = array();
		}else{
			$views = explode(',', $views);
	}
    if(!in_array($cid,$views)){
	   $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
        array_push($views, $cid);
			$views = implode(',', $views);
			Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
		}
	}
	echo $row['views'];
}