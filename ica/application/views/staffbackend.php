<html>
    <head>
        <title>Insert Data Into Database Using CodeIgniter Form</title>
        <link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" />
    </head>
    <body>

        <div id="container">
            <?php echo form_open('staff_submit'); ?>
            <h1>Insert Data Into Database Using CodeIgniter</h1><hr/>
            <?php if (isset($message)) { ?>
            <CENTER><h3 style="color:green;">Data inserted successfully</h3></CENTER><br>
            <?php } ?>
            <?php echo form_label('Staff Name :'); ?> <?php echo form_error('staff_name'); ?><br />
            <?php echo form_input(array('id' => 'staff_name', 'name' => 'staff_name')); ?><br />

            <?php echo form_label('Staff Surname :'); ?> <?php echo form_error('staff_surname'); ?><br />
            <?php echo form_input(array('id' => 'staff_surname', 'name' => 'staff_surname')); ?><br />

            <?php echo form_label('Staff Subject:'); ?> <?php echo form_error('staff_subject'); ?><br />
            <?php echo form_input(array('id' => 'staff_subject', 'name' => 'staff_subject', 'placeholder' => 'Subject')); ?><br />

            <?php echo form_label('Staff Email :'); ?> <?php echo form_error('staff_email'); ?><br />
            <?php echo form_input(array('id' => 'staff_email', 'name' => 'staff_email')); ?><br />

            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit')); ?>
            <?php echo form_close(); ?><br/>
        </div>
    </body>
</html>
