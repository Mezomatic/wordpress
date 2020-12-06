<?php
/**
 * @package Ivan
 */
/*
Plugin Name: custom-button
Plugin URI: 
Description: 
Version: 1.0
Author: 
Author URI: 
License:
Text Domain: 
*/

add_action('admin_footer', 'custom_button');
function custom_button() {
?>
    <script>
        jQuery(document).ready(function(){
            if(typeof(QTags) !== 'undefined') {
             QTags.addButton( 'custom_button', 'Добавить подсказку', function(a, b, qt){
                var title, t = this;
                if ( qt.canvas.selectionStart !== qt.canvas.selectionEnd ) {
                    title = prompt('Enter Abbreviation');
                    if ( title === null ) return;
                    t.tagStart = "<span style='color:red' data-toggle='tooltip' data-placement='top' title='" + title + "'>";
                    t.tagEnd = '</span>';
                }
                 QTags.TagButton.prototype.callback.call(t, a, b, qt);
             });
             
            }
        });
    </script>
<?php
}
