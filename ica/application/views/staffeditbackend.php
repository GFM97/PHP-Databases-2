<html>
    <head>
        <title>Insert Data Into Database Using CodeIgniter Form</title>
        <link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" />
    </head>
<body>
    <div id="container">
        <div id="wrapper">
            <h1>Update Data In Database Using CodeIgniter </h1><hr/>
            <div id="menu">
                <p>Click On Menu</p>
            <!-- Fetching Names Of All Students From Database -->
                <ol>
                    <?php foreach ($staff as $staff): ?>
                    <li><a href="<?php echo base_url() . "index.php/update_ctrl/show_staff_id/" . $staff->staff_id; ?>"><?php echo $student->student_name; ?></a></li>
                    <?php endforeach; ?>
                </ol>
            </div>
            <div id="detail">
            <!-- Fetching All Details of Selected Student From Database And Showing In a Form -->
                <?php foreach ($single_staff as $staff): ?>
                <p>Edit Detail & Click Update Button</p>
                <form method="post" action="<?php echo base_url() . "index.php/update_ctrl/update_staff_id"?>">
                    <label id="hide">Id :</label>
                    <input type="text" id="hide" name="did" value="<?php echo $staff->student_id; ?>">
                    <label>Name :</label>
                    <input type="text" name="staff_name" value="<?php echo $staff->staff_name; ?>">
                    <label>Email :</label>
                    <input type="text" name="staff_surname" value="<?php echo $staff->staff_surname; ?>">
                    <label>Mobile :</label>
                    <input type="text" name="staff_subject" value="<?php echo $staff->staff_subject; ?>">
                    <label>Address :</label>
                    <input type="text" name="staff_email" value="<?php echo $staff->staff_email; ?>">
                    <input type="submit" id="submit" name="submit" value="Update">
                </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
