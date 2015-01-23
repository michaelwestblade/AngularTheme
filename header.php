<html <?php language_attributes(); ?> ng-app="myapp">
    <head>
        <title><?php echo get_bloginfo('name'); ?></title>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <base href=""/>
        <?php wp_head(); ?>
    </head>
    <div id="siteContainer" class="MainBGColor">
        <nav id="header" class="navbar navbar-default HeadersBGColor" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="" ui-sref="home()">
                        <img class="pull-left" src="<?php echo get_theme_mod( 'logo_img' ); ?>">
                        <h1 class="pull-right text-left"><?php echo get_bloginfo('name'); ?></h1>
                    </a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li ng-class="{active:$state.includes('home')}"><a href="" ui-sref="home()">Posts</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div ng-include="dir+'partials/instagram-header.html'"></div>
        <body>