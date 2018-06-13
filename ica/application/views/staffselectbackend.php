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
        <div id="main">
            <div class="message">
                <?php
                if (isset($read_set_value)) {
                echo $read_set_value;
                }
                if (isset($message_display)) {
                echo $message_display;
                }
                ?>
            </div>

            <div id="show_form">
                <?php
                echo form_open('select_tutorial/select_by_id');
                echo form_label('Select By ID : ');
                $data = array(
                'staff_name' => 'id',
                'placeholder' => 'Please Enter ID'
                );
                echo form_input($data);
                echo "<div class='error_msg'>";
                if (isset($id_error_message)) {
                echo $id_error_message;
                }
                echo "</div>";
                echo form_submit('submit', 'Show Record');
                echo form_close();
                echo form_open('select_tutorial/select_by_subject');
                echo form_label('Select By Subject : ');
                $data = array(
                'type' => 'subject',
                'name' => 'subject',
                'placeholder' => 'subject'
                );
                echo form_input($data);
                echo "<div class='error_msg'>";
                if (isset($subject_error_message)) {
                echo $subject_error_message;
                }
                echo "</div>";
                echo form_submit('submit', 'Show Record');
                echo form_close();
                echo "From : ";

                $data = array(
                'type' => 'subject',
                'name' => 'subject',
                'placeholder' => 'subject'
                );
                echo form_input($data);
                echo " To : ";

                echo form_input($data);
                echo "<div class='error_msg'>";
                }
                echo form_submit('submit', 'Show Record');
                echo form_close();
                ?>
            <div class="message">
                <?php
                if (isset($result_display)) {
                echo "<p><u>Result</u></p>";
                if ($result_display == 'No record found !') {
                echo $result_display;
                } else {
                echo "<table class='result_table'>";
                echo '<tr><th>Staff ID</th><th>Staff Name</th><th>Staff Surname</th><th>Subject</th><th>Email</th><tr/>';
                foreach ($result_display as $value) {
                echo '<tr>' . '<td class="id">' . $value->id . '</td>' . '<td>' . $value->staff_name . '</td>' . '<td class="staff_name">' . $value->staff_surname. '</td>' . '<td>' . $value->staff_subject . '</td>' . '<td class="staff_email">' . $value->staff_email . '</td>' . '<tr/>';
                }
                echo '</table>';
                }
                }
                ?>
            </div>
            <?php
            if (isset($show_table)) {
            echo "<div class='tbl_staff'>";
            if ($show_table == 'Database is empty !') {
            echo $show_table;
            } else {
            echo '<caption>Staff Table</caption>';
            echo "<table width='500px'>";
            echo '<tr><th class="id">Staff ID</th><th>Staff Name</th><th>Subject</th><tr/>';
            foreach ($show_table as $value) {
            echo "<tr>" . "<td class='id'>" . $value->id . "</td>" . "<td>" . $value->staff_name . "</td>" . "<td>" . $value->subject . "</td>" . "<tr/>";
            }
            echo '</table>';
            }
            echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
