<?php get_header(); ?>

<div ng-controller="mycontroller">
    <!-- display all post titles in a list -->
    <ul>
        <li ng-repeat="post in postdata">
            {{post.title}}
        </li>
    </ul>
</div>

<?php get_footer(); ?>