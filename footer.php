<?php wp_footer(); ?>

<div class="footer">
    <nav class="navbar navbar-default HeadersBGColor" role="navigation">
        <div class="container">
            <?php echo get_theme_mod( 'copyright_textbox', '&copy;' ); ?>
            <?php echo ( get_theme_mod( 'show_copyright_year' ) != '' ? "&copy; ".date('Y') : ''  ); ?>
        </div>
    </nav>
</div>

</div>
</body>
</html>