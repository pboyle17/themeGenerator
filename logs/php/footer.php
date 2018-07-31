<!-- --------------- Maserati Auto Gallery Footer --------------- -->

<!--------------- FOOTER ---------------->
<div id="footer-container" class='toyota'>
    <div id="footer" class="footer-inner inner_content">
        <div class="footer-nav-col">
            <div class="social_links_wrap">
                <a href="http://www.facebook.com/pages/The-Auto-Gallery/7722371563" target="_blank"><img src="<?php echo $page->assets_local; ?>img/facebook_link.png" alt="<?php echo $site->title; ?> Facebook"></a>
                <a href="http://twitter.com/theautogallery" target="_blank"><img src="<?php echo $page->assets_local; ?>img/twitter_link.png" alt="<?php echo $site->title; ?> Twitter"></a>
                <a href="https://plus.google.com/114106495562172956819/posts" target="_blank"><img src="<?php echo $page->assets_local; ?>img/google_link.png" alt="<?php echo $site->title; ?> Google+"></a>
                <a href="http://www.youtube.com/user/TheAutoGalleryPage" target="_blank"><img src="<?php echo $page->assets_local; ?>img/youtube_link.png" alt="<?php echo $site->title; ?> Youtube"></a>
                <br class="fl_c" />
            </div>
            <h1 class="nav-title">Menu</h1>
            <div class="footer-nav-inner">
                <?php $shell->footer_navigation(); ?>
                <br class="fl_c" />
            </div>
        </div>

        <div class="footer-address-main-col mobile">
            <h3 class="footer-site-title"><?php echo $site->title; ?></h3>
            <div class="footer-address-col">
                <span class="footer-address">
                    701 Warrenville Rd. <br>
                    Lisle, IL 60532
                </span>
                <span class="footer-phones">Sales: (888) 866-1234 </span>
            </div>
        </div>

        <div class="footer-hours-col sales-hours toyota">
            <?php $shell->footer_hours('sales'); ?>
            <br class="fl_c"/>
        </div>

        <div class="footer-hours-col service-hours toyota">
            <?php $shell->footer_hours('service'); ?>
            <br class="fl_c" />
        </div>

        <div class="footer-address-main-col desktop">
            <h3 class="footer-site-title"><?php echo $site->title; ?></h3>
            <div class="footer-address-col">
                <span class="footer-address">
                    701 Warrenville Rd. <br>
                    Lisle, IL 60532
                </span>
                <span class="footer-phones">Sales: (888) 866-1234 </span>
            </div>
        </div>
        <br class="fl_c" />
    </div>
</div>

<div class="seo-container">
    <div class="inner_content">
        <?php if (isset($page->seo_footer_text)) { ?>
			<div class="seo-inner-wrapper">
			  <?php echo $page->seo_footer_text; ?>
			</div>
		<?php } ?>
    </div>
</div>

<div id="footer-bottom-container">
    <div id="footer-bottom-wrap" class="inner_content">
        <div id="footer-bottom">
            <div class="footer-bototm-col first">
                <a href="<?php echo $site->url; ?>sitemap/"><span>Sitemap</span></a> &nbsp;&nbsp;&nbsp; <a href="<?php echo $site->url; ?>privacy-policy/"><span>Privacy Policy</span></a>
            </div><div class="footer-bototm-col">
                <a href="http://www.dealereprocess.com" target="_blank"><img src="<?php echo $site->url_cdn; ?>img/DealerEProcess_logo-white.png" alt="Auto Car Dealer Web Site Provider"></a>
            </div><div class="footer-bototm-col all-rights">
                &#169; <?php echo date("Y"); ?> <?php echo $site->title; ?>. All Rights Reserved.
            </div>
        </div>
        <br class="fl_c" />
    </div>
    <br class="fl_c" />
</div>
