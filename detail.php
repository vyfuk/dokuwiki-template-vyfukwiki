<?php
/**
 * DokuWiki Default Template 2012
 *
 * @link     http://dokuwiki.org/template
 * @author   Anika Henke <anika@selfthinker.org>
 * @author   Clarence Lee <clarencedglee@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */

?><!DOCTYPE html>
<html lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="utf-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php
    if(get_doku_pref("darkmode", 0)==1)echo '<link rel="stylesheet" type="text/css" href="/lib/tpl/vyfukwiki/css/dark.css"/>';
    else echo '<link rel="stylesheet" type="text/css" href="/lib/tpl/vyfukwiki/css/dark_not.css"/>';
    tpl_metaheaders()
    ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="shortcut icon" href="/lib/tpl/vyfukwiki/images/vyfuk.ico" />
</head>

<body>
<div id="dokuwiki__top" class="site dokuwiki <?php echo('mode_'.$ACT); ?>">
    <div id="dokuwiki__header" class="pad group">
        <div class="headings group">
            <h1><a href="<?php wl() ?>/start"><img src="/lib/tpl/vyfukwiki/images/logo.png" width="103" height="60" alt="" /> <span>DokuWiki</span></a></h1>
            <?php if ($conf['tagline']){echo('<p class="claim">'.$conf['tagline'].'</p>');} ?>
        </div>
        <div id="dokuwiki__sitetools">
            <?php tpl_searchform(); //TODO: má problemi(ctverecek uprostred)?>
            <ul class="toptools">
                <?php echo (new \dokuwiki\Menu\SiteMenu())->getListItems('action ', false); ?>
            </ul>
        </div>
        <div class="breadcrumbs">
            <div><?php
                if($conf['youarehere'])tpl_youarehere();
                if($conf['youarehere'] && $conf['breadcrumbs']) echo("</div><div>");
                if($conf['breadcrumbs'])tpl_breadcrumbs();?>
            </div>
        </div>
        <div id="dokuwiki__usertools" class="group">
            <ul>
                <li class="user">
                <?php tpl_userinfo();
                    echo '</li>';
                    if(get_doku_pref("darkmode", 0)==1)echo '<li class="action"><a href="javascript:DokuCookie.setValue(\'darkmode\', 0);javascript:location.reload();" title="světlý motiv" rel="nofollow"><span>světlý motiv</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 20a8 8 0 0 1-8-8 8 8 0 0 1 8-8 8 8 0 0 1 8 8 8 8 0 0 1-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10 10 10 0 0 0 10-10A10 10 0 0 0 12 2z"/></svg></a></li>';
                    else echo '<li class="action"><a href="javascript:DokuCookie.setValue(\'darkmode\', 1);javascript:location.reload();" title="tmavý motiv" rel="nofollow"><span>tmavý motiv</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 20a8 8 0 0 1-8-8 8 8 0 0 1 8-8 8 8 0 0 1 8 8 8 8 0 0 1-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10 10 10 0 0 0 10-10A10 10 0 0 0 12 2z"/></svg></a></li>';
                    echo (new \dokuwiki\Menu\PageMenu())->getListItems();
                    echo (new \dokuwiki\Menu\UserMenu())->getListItems();
                ?>
            </ul>
        </div>
    </div>
    <div id="dokuwiki__content" class="wrapper group">
        <div class="pad group">
            <?php html_msgarea() ?>
            <div class="page group">
                <?php tpl_flush() ?>
                <!-- detail start -->
                <?php
                if($ERROR):
                    echo '<h1>'.$ERROR.'</h1>';
                else: ?>
                    <?php if($REV) echo p_locale_xhtml('showrev');?>
                    <h1><?php echo nl2br(hsc(tpl_img_getTag('simple.title'))); ?></h1>

                    <?php tpl_img(900,700);?>

                    <div class="img_detail">
                        <?php tpl_img_meta(); ?>
                        <dl>
                        <?php
                        echo '<dt>'.$lang['reference'].':</dt>';
                        $media_usage = ft_mediause($IMG,true);
                        if(count($media_usage) > 0){
                            foreach($media_usage as $path){
                                echo '<dd>'.html_wikilink($path).'</dd>';
                            }
                        }else{
                            echo '<dd>'.$lang['nothingfound'].'</dd>';
                        }
                        ?>
                        </dl>
                        <p><?php echo $lang['media_acl_warning']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
                <!-- detail stop -->
                <?php tpl_flush() ?>
        </div>
    </div>
</div>
<div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
<div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
</body>
</html>
