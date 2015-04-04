<html <?php language_attributes(); ?> ng-app="myapp">
    <head>
        <title><?php echo get_bloginfo('name'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <base href=""/>

        <meta property="og:image" content="<?php echo get_bloginfo('template_directory');?>/img/default.jpg"/>
        <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>"/>
        <meta property="og:url" content="<?php echo  get_bloginfo('wpurl'); ?>"/>
        <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
        <meta property="og:type" content="blog"/>

        <?php
        $options = get_option('plugin_options');
        $ga_code = $options['ga_code'];
        ?>
        <?php if($ga_code): ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', '<?php echo $ga_code; ?>', 'auto');
        </script>
        <?php endif; ?>

        <script>
            var homepageId;
        </script>

        <?php wp_head(); ?>
    </head>
    <body>
        <div id="siteContainer" class="MainBGColor">
            <nav id="header" class="navbar navbar-default HeadersBGColor">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" ng-init="isCollapsed = true" ng-click="isCollapsed = !isCollapsed">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="" ui-sref="home()">
                            <img class="pull-left" src="<?php echo get_theme_mod('logo_img'); ?>">

                            <h1 class="pull-right text-left"><?php echo get_bloginfo('name'); ?></h1>
                        </a>
                    </div>
                    <div id="navbar" class="navbar-collapse" ng-class="{collapse: isCollapsed}">
                        <ul class="nav navbar-nav">
                            <li ng-class="{active:$state.includes('home')}">
                                <a href="" ui-sref="home()">Home</a>
                            </li>
                            <li ng-class="{active:$state.includes('posts')||$state.includes('post')}">
                                <a href="" ui-sref="posts()">Posts</a>
                            </li>
                            <?php build_header_menu(); ?>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>