<!DOCTYPE html>
<html>
<head>
<title>Delete Data From Database Using CodeIgniter</title>
<!--=========== Importing Google fonts ===========-->
<link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url()?>./css/delete.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
<div id="wrapper">
<h1>Delete Data From Database Using CodeIgniter</h1>
<div id="menu">
<p>Click On Menu</p>
<!--====== Displaying Fetched Names from Database in Links ========-->
<ol>
<?php foreach ($staff as $staff): ?>
<li><a href="<?php echo base_url() . "index.php/delete_ctrl/show_staff_id/" . $staff->staff_id; ?>"><?php echo $staff->staff_name; ?></a>
</li><?php endforeach; ?>
</ol>
</div>
<div id="detail">
<!--====== Displaying Fetched Details from Database ========-->
<?php foreach ($single_staff as $staff): ?>
<p>Student Detail</p>
<?php echo $staff->staff_name; ?>
<?php echo $staff->staff_surname; ?>
<?php echo $staff->staff_subject; ?>
<?php echo $staff->student_email; ?>
<!--====== Delete Button ========-->
<a href="<?php echo base_url() . "index.php/delete_ctrl/delete_staff_id/" . $staff->staff_id; ?>">
<button>Delete</button></a>
<?php endforeach; ?>
</div>
</div>
</div>
</body>
</html>
