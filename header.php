<html <?php language_attributes(); ?> ng-app="myapp">
    <head>
        <title>My Angular Theme</title>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <?php wp_head(); ?>
    </head>
    <div id="siteContainer">
        <nav id="header" class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="" ui-sref="home()"><?php echo get_bloginfo('name'); ?></a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li ng-class="{active:$state.includes('home')}"><a href="" ui-sref="home()">Posts</a></li>
                    </ul>

                    <div ng-include="dir+'partials/user-nav.html'"></div>
                </div>
            </div>
        </nav>
        <div ng-include="dir+'partials/instagram-header.html'"></div>
        <body>