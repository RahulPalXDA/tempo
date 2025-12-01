<?php
$heading = $args['heading'] ?? '';
$items   = $args['items'] ?? [];
$text_2  = $args['text_2'] ?? '';
?>

<?php if ($heading || $items || $text_2): ?>
<div class="details-box">

    <?php if ($heading): ?>
        <h4><?php echo $heading; ?></h4>
    <?php endif; ?>

    <?php if (!empty($items)): ?>
        <ul class="deatils-date">
            <?php foreach($items as $item): ?>
                <li>
                    <?php if(!empty($item['timing_text_1'])): ?>
                        <h5 class="caption-Small-inter"><?php echo $item['timing_text_1']; ?></h5>
                    <?php endif; ?>

                    <?php if(!empty($item['timing_text_2'])): ?>
                        <p><?php echo $item['timing_text_2']; ?></p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($text_2): ?>
        <h6 class="caption-small-cormorant"><?php echo $text_2; ?></h6>
    <?php endif; ?>

</div>
<?php endif; ?>
