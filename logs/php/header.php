<!-- --------------- Maserati Auto Gallery Header --------------- -->

<?php
$shell->injectMegamenuViews();
if ($this->PageModel->page_id != 373) {
	$shell->mobilemenu();
}

if ($this->PageModel->page_id == 373) {
	$loc = reset($shell->locations);
	
	// load global/local content
	$header_global_content_ids = array(
		'close_cnt'=>361
	);
	
	$header_content = $this->ContentModel->content_fetch_all_global($header_global_content_ids);
	
	foreach ($header_global_content_ids as $content_name => $cnt) {
		$header_view_content[$content_name] = $this->ContentModel->content_fetch($cnt, TRUE);
	}
	
	//$v_phone = $shell->departments->default_site_phone_by_type('sales');
	$phone_number_data_array_sales = modules::run('utilities/calltracking/getAllVariants', $shell->departments->default_site_phone_by_type('sales'));
	
	//$v_phone = $shell->departments->default_site_phone_by_type('service');
	$phone_number_data_array_service = modules::run('utilities/calltracking/getAllVariants', $shell->departments->default_site_phone_by_type('service'));
	
	//$v_phone = $shell->departments->default_site_phone_by_type('parts');
	$phone_number_data_array_parts = modules::run('utilities/calltracking/getAllVariants', $shell->departments->default_site_phone_by_type('parts'));
	
	$header_1_data = array(
		"header_megamenu_mobile" => modules::run('public/navigation/megamenu/loadMobileMenu'),
		"header_megamenu" => modules::run('public/navigation/megamenu/index'),
		"header_dealer_logo" => '<img src="/assets/d1/img/logo-site.png" />',
		"header_dealer_logo_url" => $site->url,
		
		"header_middle_linked_image" => '<img src="' . $site->url_cdn . 'img/alt_content/toyota/rent-car/logo-trac.png" />',
		"header_middle_linked_image_href" => "/toyota-rent-a-car/",
		
		"header_social_media" => array(
			"/facebook/" => '<img src="' . $page->assets_local . 'img/social_facebook.png" />',
			"/twitter/" => '<img src="' . $page->assets_local . 'img/social_twitter.png" />',
			"/google-plus/" => '<img src="' . $page->assets_local . 'img/social_googleplus.png" />',
			"/youtube/" => '<img src="' . $page->assets_local . 'img/social_youtube.png" />',
			"/instagram/" => '<img src="' . $page->assets_local . 'img/social_instagram.png" />'
		),
		
		"header_right_ellipsis_btn_img" => $page->assets_local . 'img/dots-icon.png',
		
		"header_right_text_link_content" => "Contact Us",
		"header_right_text_link" => "/contact-us/",
		
		"header_right_phone_btn_img" => $page->assets_local . 'img/phone-icon-header.png',
		
		"header_right_map_btn_img" => $page->assets_local . 'img/map-icon-header.png',
		
		"header_phone_numbers" => array(
			"Sales" => $phone_number_data_array_sales,
			"Service" => $phone_number_data_array_service,
			"Parts" => $phone_number_data_array_parts
		),
		
		"header_address" => array(
			"header_city_address" => $loc['city'],
			"header_single_line" => false,
			"header_state_address" => $loc['state'],
			"header_street_address" => $loc['address1'],
			"header_zip_address" => $loc['zip']
		),
		
		"header_directions_link_href" => "/hours-and-directions/",
		"header_directions_link_text" => "Get Directions",
		"header_directions_link_class" => "get-direction",
		
		"header_flyout_close_cnt" => $header_view_content['close_cnt']
	);
	
	$header_3_data = array(
		"header_megamenu_mobile" => modules::run('public/navigation/megamenu/loadMobileMenu'),
		"header_megamenu" => modules::run('public/navigation/megamenu/index'),
		"header_dealer_logo" => '<img src="/assets/d1/img/header3_logo.png" />',
		"header_dealer_logo_url" => $site->url,
		
		"header_address" => array(
			"header_city_address" => $loc['city'],
			"header_single_line" => true,
			"header_state_address" => $loc['state'],
			"header_street_address" => $loc['address1'],
			"header_zip_address" => $loc['zip'],
			"header_address_link" => "/directions/"
		),		
		
		"header_social_media" => array(
			"/facebook/" => '<img src="' . $page->assets_local . 'img/social_facebook.png" />',
			"/twitter/" => '<img src="' . $page->assets_local . 'img/social_twitter.png" />',
			"/google-plus/" => '<img src="' . $page->assets_local . 'img/social_googleplus.png" />',
			"/youtube/" => '<img src="' . $page->assets_local . 'img/social_youtube.png" />',
			"/instagram/" => '<img src="' . $page->assets_local . 'img/social_instagram.png" />'
		),
		
		"header_phone_numbers" => array(
			"Sales" => $phone_number_data_array_sales,
			"Service" => $phone_number_data_array_service,
			"Parts" => $phone_number_data_array_parts
		),
		
		"header_right_ellipsis_btn_img" => $page->assets_local . 'img/dots_icon_header3.png',
		"header_right_phone_btn_img" => $page->assets_local . 'img/phone_icon_header3.png',
		"header_right_map_btn_img" => '<img src="' . $page->assets_local . 'img/map_icon_header3.png" />',
		"header_right_map_btn_url" => '/directions/',
		
		"header_flyout_close_cnt" => $header_view_content['close_cnt']
	);
	
	// call header view builder
	try {
		$view_builder = new \APP\Header\View\HeaderViewBuilder;
		
		$header_view = $view_builder->buildHeader1View($header_1_data);
		
		//$header_view = $view_builder->buildHeader3View($header_3_data);
		
		echo $header_view->getOutput();
	} catch (\TypeError $e) {
		trigger_error('@view_error: \APP\Header\View\HeaderViewBuilder '.$e->getMessage());
		$this->view_file = null;
	} catch (\Exception $e) {
		trigger_error('@view_error: \APP\Header\View\HeaderViewBuilder '.$e->getMessage());
		$this->view_file = null;
	}
}
?>


<?php if ($this->PageModel->page_id != 373) { ?>

<div class="header_wrap">
    <div id="shell-header">
        <div class="lh-container">
            <div class="logo-wrapper"><a href="<?php echo $site->url; ?>"><img class="text-logo toyota" src="<?php echo $page->assets_local; ?>img/site-logo-toyota.png" alt="<?php echo $site->title; ?> Logo" /></a></div>
        </div>
        <div class="phone-mobile fl_r">
            <div id="phone-icon" class="fl_l"><img src="<?php echo $page->assets_local; ?>img/phone_icon-toyota.png" alt="<?php echo $site->title; ?> Call Us" /></div>
            <a class="map-icon fl_l" href="<?php echo $site->url; ?>locations-and-directions/"><img src="<?php echo $page->assets_local; ?>img/map_icon-toyota.png" alt="<?php echo $site->title; ?> Get Directions" /></a>
        </div>
        <div class="rh-container">
            <div class="smart-search-cont">
	            <!-- Smart Search -->
                <!-- Module_id: 1453 -->
                <!-- Arguments: {"index_types":["i","j","s","c","v","p"],"hint_speed":"150","hint_delay":"1000","hint_keywords":["Finance Application","Service Appointment"]} -->
                <?php $components->local_instruction_run(512, 0); ?>
                <div class="fl_c"></div>
            </div>
            <div class="phone-container toyota">
                <span class="phone-desktop">Sales: (888) Rob-Rocks</span>&nbsp;&nbsp; | &nbsp;&nbsp;
                <span class="phone-desktop">Service: (888) 866-1234</span>&nbsp;&nbsp; | &nbsp;&nbsp;
                <span class="phone-desktop">701 Warrenville Rd. Lisle, IL 60532</span>
            </div>
            <div class="megamenu-container">
                <div id="megamenu">
                    <?php $shell->megamenu(); ?>
                </div>
            </div>
        </div>
        <div class="fl_c"></div>
    </div>
</div>


<script>
	/*document.querySelector('#megamenu').classList.add('toyota');
	document.querySelector('#megamenu_mobile').classList.add('toyota');
	document.querySelector('#search_lbl').classList.add('toyota');*/
</script>

<div id="phone-drop-down-container" class="closed">
    <?php
    if (preg_match('/(iphone|ipad|ipaq|ipod)/i', $_SERVER['HTTP_USER_AGENT'])) {
        $proto = 'tel:';
    } else {
        $proto = 'wtai://wp/mc;';
    }
    ?>
    <div id="phone-drop-down-wrap">
        <div class="phone-wrap first">
            <span class="phone-title">Beverly Hills:</span>
            <a href="<?php echo $proto; ?>(844) 877-0781"><span class="phone-number">(844) 877-0781</span></a>
        </div>
        <div class="phone-wrap">
            <span class="phone-title">Calabasas:</span>
            <a href="<?php echo $proto; ?>(844) 877-0776"><span class="phone-number">(844) 877-0776</span></a>
        </div>
        <div class="phone-wrap last">
            <span class="phone-title">Van Nuys:</span>
            <a href="<?php echo $proto; ?>(888) 841-3316"><span class="phone-number">(888) 841-3316</span></a>
        </div>
    </div>
    <div id="phone-drop-down-close-wrap">
        <span>Close</span>
    </div>
</div>

<script type="text/javascript">
    $("#phone-icon").click(function() {
        if ($("#phone-drop-down-container").hasClass('closed')) {
            $("#phone-drop-down-container").removeClass('closed');
        } else {
            $("#phone-drop-down-container").addClass('closed');
        }
    });

    $("#phone-drop-down-close-wrap").click(function() {
        $("#phone-drop-down-container").addClass('closed');
    });
	$('#mobile_menu_parent-1 a').html('<img src="<?php echo $page->assets_local; ?>img/home-icon.png" alt="Nav" />');
	
</script>

<?php }; ?>
