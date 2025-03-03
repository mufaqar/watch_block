<?php 
    $header_color = get_field('header_color');        
    if($header_color == 'White')
    {
        $logo = "logo.svg";
    }
    else {
        $logo = "logo-dark.svg";
    }

?>

<header id="<?php echo ($header_color == 'White') ? 'white' : 'black'; ?>"
    class="sticky w-full z-50 top-[-1px]">
    <div id="header-wrapper" class="pl-3 sm:pl-4 md:py-2 lg:pl-8 2xl:pl-[64px] items-center justify-between flex gap-5 lg:gap-[46px]">
        <a href="<?php bloginfo('url'); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $logo?>" alt="<?php bloginfo('name'); ?>" class="min-w-[120px]">
        </a>
        <div
            class="md:bg-[#F2F2F2] gap-2 flex justify-end lg:justify-between items-center rounded-tl-[24px] rounded-bl-[24px] lg:flex-1 pl-[19px] py-3 pr-3 sm:pr-4 lg:pr-8 2xl:pr-[64px] ">
            <div class="hidden md:block">
                <?php wp_nav_menu( array( 
					'theme_location' => 'main', 
					'container'      => 'nav',
					'container_class'=> 'flex header-menu flex-col space-y-4',
					'add_li_class'    => 'menu-item',
					'menu_class'     => 'flex sm:flex-row flex-col sm:items-center md:gap-4 gap-5',
				));?>
            </div>
            <div class="flex items-center gap-2">
                <form role="search" method="get" class="" action="<?php echo esc_url(home_url('/')); ?>">
                    <div
                        class="px-4 md:flex hidden items-center gap-3 bg-white shadow-sm max-w-[260px] w-full rounded-full">

                        <label for="search-field" class="sr-only">Search Watches</label>
                        <input id="search-field" placeholder="Search Watches"
                            value="<?php echo esc_attr(get_search_query()); ?>" type="search" name="s"
                            class="bg-transparent py-3 outline-none !border-none w-full focus:border-none text-[#A1A1A1]" />
                        <input type="hidden" name="post_type" value="product" />
                        <button type="submit" class="focus:outline-none">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/svg/search-icon.svg"
                                alt="Search" />
                        </button>
                    </div>
                </form>

                <div class="md:flex item-center gap-2 hidden">
                    <a href="<?php echo home_url('/wishlist'); ?>"
                        class="bg-white w-[48px] h-[48px] rounded-full flex flex-col justify-center items-center shadow">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/save.svg" alt=""
                            class="w-[14px] h-[20px]">
                    </a>
                    <button
                        class="bg-white w-[48px] h-[48px] rounded-full flex flex-col justify-center items-center shadow"
                        id="open-cart">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/cart.svg" alt=""
                            class="w-[17px] h-[17px]">
                    </button>
                    <a href="<?php echo wc_get_page_permalink('myaccount'); ?>"
                        class="bg-white account w-[48px] h-[48px] rounded-full flex flex-col justify-center items-center shadow">
                        <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="personIcon"
                                d="M10.3088 12.806C13.5558 12.806 16.1879 10.1738 16.1879 6.92692C16.1879 3.68 13.5558 1.04785 10.3088 1.04785C7.06192 1.04785 4.42977 3.68 4.42977 6.92692C4.42977 10.1738 7.06192 12.806 10.3088 12.806ZM10.3088 12.806C6.50122 12.806 3.26957 14.8756 1.49023 17.9502M10.3088 12.806C14.1165 12.806 17.3481 14.8756 19.1274 17.9502"
                                stroke="#A2A2A2" stroke-width="1.46977" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <button id="menu-button"
                    class="bg-white w-[48px] h-[48px] md:w-[66px] flex rounded-full lg:hidden flex-col justify-center items-center shadow">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/svg/menu.svg" alt=""
                        class="w-[17px] h-[16px]">
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Header  -->

<nav id="nav-menu" class="bg-black text-white hidden lg:hidden fixed md:sticky mt-[-2px] md:mt-0 w-full z-[100]">
    <div>
        <?php wp_nav_menu( array( 
			'theme_location' => 'main', 
			'container'      => 'div',
			'container_class'=> 'flex header-menu flex-col space-y-4',
			'add_li_class'    => 'menu-item',
			'menu_class'     => 'flex sm:flex-row flex-col sm:items-center md:gap-[3vw] gap-5',
		));?>
    </div>
    <div class="flex flex-col items-center gap-2 px-4">
        <div class="px-4 items-center gap-3 bg-white shadow-sm lg:max-w-[260px] w-full flex rounded-full">
            <input placeholder="Search Watches"
                class="bg-transparent py-3 outline-none border-none w-full focus:border-none text-[#A1A1A1]" />
            <img src="<?php echo get_template_directory_uri(); ?>/images/svg/search-icon.svg" alt="" class="">
        </div>
        <div class="flex item-center gap-2 my-5">
            <a class="bg-white w-[48px] h-[48px] rounded-full flex flex-col justify-center items-center shadow">
                <img src="<?php echo get_template_directory_uri(); ?>/images/svg/save.svg" alt=""
                    class="w-[14px] h-[20px]">
            </a>
            <button class="bg-white w-[48px] h-[48px] rounded-full flex flex-col justify-center items-center shadow"
                id="open-cart">
                <img src="<?php echo get_template_directory_uri(); ?>/images/svg/cart.svg" alt=""
                    class="w-[17px] h-[17px]">

            </button>

            <a href="<?php echo wc_get_page_permalink('myaccount'); ?>"
                class="bg-white w-[48px] h-[48px] rounded-full flex flex-col justify-center items-center shadow">
                <img src="<?php echo get_template_directory_uri(); ?>/images/svg/person.svg" alt=""
                    class="w-[17px] h-[16px]">
            </a>
        </div>
    </div>
</nav>