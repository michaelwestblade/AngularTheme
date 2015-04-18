<style type="text/css">
/* Main Colors */
.HeadersBGColor{
    background-color: <?php echo ( get_theme_mod( 'headers_bg_color' ) != '' ? get_theme_mod( 'headers_bg_color' ).'!important' : ''  ).";";  ?>
}
.HeadersBGColor ul li a,.HeadersBGColor span{
    color: <?php echo ( get_theme_mod( 'headers_text_color' ) != '' ? get_theme_mod( 'headers_text_color' ).'!important' : ''  ).";";  ?>
}
.HeadersBGColor ul li:hover, .HeadersBGColor ul li.active{
    background-color: <?php echo ( get_theme_mod( 'headers_text_highlight' ) != '' ? get_theme_mod( 'headers_text_highlight' ).'!important' : ''  ).";";  ?>
}
.HeadersTextColor{
    color: <?php echo ( get_theme_mod( 'headers_text_color' ) != '' ? get_theme_mod( 'headers_text_color' ).'!important' : ''  ).";";  ?>
}
.MainBGColor{
    background-color: <?php echo ( get_theme_mod( 'main_bg_color' ) != '' ? get_theme_mod( 'main_bg_color' ).'!important' : ''  ).";";  ?>
}

.AccentColor1_color{
    color: <?php echo ( get_theme_mod( 'accent_color_1' ) != '' ? get_theme_mod( 'accent_color_1' ).'!important' : ''  ).";";  ?>
}
.AccentColor1_bg{
    background-color: <?php echo ( get_theme_mod( 'accent_color_1' ) != '' ? get_theme_mod( 'accent_color_1' ).'!important' : ''  ).";";  ?>
   color: <?php echo ( get_theme_mod( 'accent_color_2' ) != '' ? get_theme_mod( 'accent_color_2' ).'!important' : ''  ).";";  ?>
}

#page #about p:first-child::first-letter{color: <?php echo ( get_theme_mod( 'accent_color_1' ) != '' ? get_theme_mod( 'accent_color_1' ).'!important' : ''  ).";";  ?>}
#page .page-header{border-color: <?php echo ( get_theme_mod( 'headers_text_highlight' ) != '' ? get_theme_mod( 'headers_text_highlight' ).'!important' : ''  ).";";  ?>}

#postList ul.posts li .media{border-color: <?php echo ( get_theme_mod( 'headers_text_highlight' ) != '' ? get_theme_mod( 'headers_text_highlight' ).'!important' : ''  ).";";  ?>}
</style>
