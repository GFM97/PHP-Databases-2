<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?=$page_title?></title>
    </head>
    <body>
        <?=form_open($form_action);?>
            <?php foreach ($form as $key => $input): ?>

                <?=form_label($key.':', $input['id']);?>
                <?=form_input($input);?>
                <br>

            <?php endforeach; ?>

            <?=form_button($buttons['submit'])?>

        <?=form_close();?>
    </body>
</html>
