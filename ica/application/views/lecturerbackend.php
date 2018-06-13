<!DOCTYPE html>
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
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="<?=site_url('/');?>" class="logo">
                    <img src="<?=base_url('images/solid_normal.png');?>" alt="logo" width="156px" height="56px" float="left">
                    <a class="navbar-brand font-small" href="<?=site_url('/');?>"><p>Institute for <br> the Creative Arts</p></a>
                </div>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?=site_url('lecturerbackend');?>">Lecturer</a>
                        </li>
                        <li class="nav-item acitve">
                            <a class="nav-link text-white" href="<?=site_url('canclectbackend');?>">Cancelled Lectures</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?=site_url('studentportbackend');?>">Student Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?=site_url('vacbackend');?>">Vacancies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?=site_url('registerbackend');?>">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <?=  anchor('logout', 'Logout', 'class = nav-link'); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="add_lecturer">
            <a href="staffbackend">
                <button style="padding:10px; margin-top:50px; margin-left:30px;">Click me</button>
            </a>
        </div>
