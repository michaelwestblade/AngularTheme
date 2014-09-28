<?php get_header(); ?>

<div class="container">
    <!-- display all post titles in a list -->
    <div ui-view id="main">
        <a href="" ui-sref="posts()">Posts</a>
    </div>
</div>

<?php get_footer(); ?>