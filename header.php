<html <?php language_attributes(); ?> ng-app="myapp">
    <head>
        <title>My Angular Theme</title>
        <?php wp_head(); ?>

        <nav id="header" class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="" ui-sref="home()">My Angular Theme</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li ng-class="{active:$state.includes('home')}"><a href="" ui-sref="home()">Posts</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li ng-if="user.data">
                            <ul class="list-group avatar">
                                <li class="list-group-item">
                                    <div class="row-picture">
                                        <img ng-src="{{user.data.avatar}}" class="circle" alt="icon"/>
                                    </div>
                                    <div class="row-content">
                                        <h4>You are signed in as {{user.data['display_name']}}</h4>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li ng-if="user.data">
                            <a href="wp-login.php?action=logout">Sign Out</a>
                        </li>
                        <li ng-if="!user.data">
                            <a href="wp-login.php?action=register">Sign Up</a>
                        </li>
                        <li ng-if="!user.data">
                            <a href="wp-login.php">Sign In</a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>

    </head>
    <body>