<html>
<head>
    <meta charset="utf-8">
    <title>MCAST ICA</title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.12/js/all.js" integrity="sha384-Voup2lBiiyZYkRto2XWqbzxHXwzcm4A5RfdfG6466bu5LqjwwrjXCMBQBLMWh7qR" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=base_url('css/style.css')?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    <body>
        <div id="container-fluid" style= "padding: 30px;">
            <?php echo form_open('staff_submit'); ?>
            <h1>Add Staff</h1><hr/>
            <?php if (isset($message)) { ?>
            <CENTER><h3 style="color:green;">Data inserted successfully</h3></CENTER><br>
            <?php } ?>
            <?php echo form_label('Staff Name :'); ?> <?php echo form_error('staff_name'); ?><br />
            <?php echo form_input(array('id' => 'staff_name', 'name' => 'staff_name', 'placeholder' => 'Name')); ?><br />

            <?php echo form_label('Staff Surname :'); ?> <?php echo form_error('staff_surname'); ?><br />
            <?php echo form_input(array('id' => 'staff_surname', 'name' => 'staff_surname', 'placeholder' => 'Surname')); ?><br />

            <?php echo form_label('Staff Subject:'); ?> <?php echo form_error('staff_subject'); ?><br />
            <?php echo form_input(array('id' => 'staff_subject', 'name' => 'staff_subject', 'placeholder' => 'Subject')); ?><br />

            <?php echo form_label('Staff Email :'); ?> <?php echo form_error('staff_email'); ?><br />
            <?php echo form_input(array('id' => 'staff_email', 'name' => 'staff_email', 'placeholder' => 'Email')); ?><br />

            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit')); ?>
            <?php echo form_close(); ?><br/>
        </div>
    </body>
</html>
