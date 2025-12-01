<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Red_Graphic_Cambridge
 */

?>
<?php 
    $footer_logo = get_field('footer_logo', 'option');
    $footer_left_items = get_field('footer_left_items', 'option');
    $footer_right_items = get_field('footer_right_items', 'option');
    $footer_divider = get_field('footer_divider', 'option');
?>
<footer class="footer">
    <div class="custom-container">
        <div class="footer-inner-box">
            <div class="footer-item">
                <?php echo !empty($footer_logo) ? '<a href="' . site_url('/') . '">' . red_graphic_cambridge_get_acf_image(["acf" => $footer_logo, "class" => "ftr-logo"]) . '</a>' : ''; ?>
                <div class="ftr-additional-details">
                    <?php if(!empty($footer_left_items)){ ?>
                    <div class="ftr-adi-item-lft">
                        <?php foreach($footer_left_items as $left_item): ?>
                        <div class="ftr-inner-item">
                            <?php echo $left_item['content']; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php } ?>
                    <?php if(!empty($footer_right_items)){ ?>
                    <div class="ftr-adi-item-link">
                        <?php foreach($footer_right_items as $right_item): ?>
                        <div class="ftr-inner-item">
                            <?php echo $right_item['content']; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php echo !empty($footer_divider) ? red_graphic_cambridge_get_acf_image(["acf" => $footer_divider, "wrapper_start" => '<div class="footer-item get-touch-ftr">', "wrapper_end" => '</div>']) : ''; ?>
            <div class="footer-item card-details-ftr">
                <?php
                    $heading = get_field('garden_heading', 'option');
                    $items   = get_field('garden_items', 'option');
                    $text_2  = get_field('garden_text', 'option');
                    
                    get_template_part(
                        'template-parts/garden-timing',
                        null,
                        [
                            'heading' => $heading,
                            'items'   => $items,
                            'text_2'  => $text_2
                        ]
                    );
                ?>
            </div>
        </div>
    </div>
</footer>
<script>
jQuery(function($){

    $("#header-search-input").on("keyup", function(){

        let keyword = $(this).val();

        if(keyword.length < 2){
            $("#search-suggestions").hide();
            return;
        }

        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: "POST",
            data: {
                action: "live_search",
                keyword: keyword
            },
            success: function(response){
                $("#search-suggestions").html(response).show();
            }
        });
    });

    // When clicking a suggestion
    $(document).on("click", ".search-suggestion-item", function(){
        window.location = $(this).data("link");
    });

});
</script>

<?php wp_footer(); ?>

</body>
</html>
