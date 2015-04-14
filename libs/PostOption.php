<?php
/**
 * Created by PhpStorm.
 * User: Michael Westblade
 * Date: 4/13/2015
 * Time: 11:55 PM
 */

class PostOption
{
    public $optionId;
    public $optionTitle;
    public $optionName;
    public $optionScreen;
    public $optionType;
    public $selectOptions;
    public $optionTextDomain;

    public function __construct($name,$title,$type,$screen,$selectOptions)
    {
        $this->optionId = $name.'_id';
        $this->optionTitle = $title;
        $this->optionName = $name;
        $this->optionScreen = $screen;
        $this->optionType = $type;
        $this->optionTextDomain = $name.'-textdomain';
        $this->selectOptions = $selectOptions;

        add_action( 'add_meta_boxes', function(){
            add_meta_box(
                $this->optionId,
                __( $this->optionTitle, $this->optionTextDomain ),
                array($this, 'buildOptionHtml'),
                $this->optionScreen
            );
        } );
        add_action( 'save_post', array($this,'saveData') );
    }

    public function buildOptionHtml($post)
    {
        // Add an nonce field so we can check for it later.
        wp_nonce_field( $this->optionName.'_meta_box', $this->optionName.'_meta_box_nonce' );

        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
        $meta = get_post_meta( $post->ID );

        echo '<p>';
        echo '<label for="meta-select" class="prfx-row-title">';
        echo _e( $this->optionTitle, $this->optionTextDomain );
        echo '</label>';

        switch($this->optionType){
            case 'select':
                echo '<select name="'.$this->optionId.'" id="'.$this->optionName.'">';
                var_dump($this->selectOptions);
                foreach($this->selectOptions as $option){
                    ?>
                    <option value="<?php echo $option['value'];?>" <?php if ( isset ( $meta[$this->optionName] ) ) selected( $meta[$this->optionName][0], $option['value'] ); ?>><?php _e( $option['title'], $this->optionTextDomain )?></option>';
                <?php
                }
                echo '</select>';
                break;
            case 'input':
                echo '<input type="text" name="'.$this->optionId.'" id="'.$this->optionName.'">';
            default:
                break;
        }

    }

    public function saveData( $post_id ) {

        /*
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */

        // Check if our nonce is set.
        if ( ! isset( $_POST[$this->optionName.'_meta_box_nonce'] ) ) {
            return;
        }

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST[$this->optionName.'_meta_box_nonce'], $this->optionName.'_meta_box' ) ) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }

        } else {

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }

        /* OK, it's safe for us to save the data now. */

        // Make sure that it is set.
        if ( ! isset( $_POST[$this->optionId] ) ) {
            return;
        }

        // Sanitize user input.
        $my_data = sanitize_text_field( $_POST[$this->optionId] );

        // Update the meta field in the database.
        update_post_meta( $post_id, $this->optionName, $my_data );
    }
}