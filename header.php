<html <?php language_attributes(); ?> ng-app="myapp">
    <head>
        <title>My Angular Theme</title>
        <?php wp_head(); ?>

        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="" ui-sref="home()">My Angular Theme</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li ng-class="{active:$state.includes('home')}"><a href="" ui-sref="home()">Posts</a></li>
                    </ul>
                </div>
            </div>

        </nav>

    </head>
    <body>