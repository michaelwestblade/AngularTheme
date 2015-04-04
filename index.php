<?php add_action('wp_enqueue_scripts', 'angularTheme_enqueue_scripts'); ?>
<?php get_header(); ?>

<div class="container" ng-switch="pageLoading">
    <div id="main">
        <div class="pageLoading text-center" ng-switch-when="loading">
            <i class="fa fa-refresh fa-spin fa-5x"></i>
        </div>
        <div ng-switch-when="loaded">
            <div ui-view></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>