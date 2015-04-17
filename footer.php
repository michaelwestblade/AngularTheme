<?php wp_footer(); ?>

<div class="footer">
    <nav class="navbar navbar-default HeadersBGColor" role="navigation">
        <div class="container">
            <span class="HeadersTextColor"><?php echo get_theme_mod( 'copyright_textbox', '' ); ?></span>
            <span class="HeadersTextColor"><?php echo ( get_theme_mod( 'show_copyright_year' ) != '' ? "&copy; ".date('Y') : ''  ); ?></span>
        </div>
    </nav>
</div>

</div>
</body>
</html>