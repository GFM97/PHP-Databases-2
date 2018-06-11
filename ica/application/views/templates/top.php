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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" =>
                                About
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item text-center text-white" href="<?=site_url('staff');?>">Staff</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center text-white" href="<?=site_url('mcast');?>">Mcast</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?=site_url('studentport');?>">Student Portfolio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" =>
                                Student
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item text-center text-white" href="<?=site_url('notices');?>">Notices</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center text-white" href="<?=site_url('vacancies');?>">Vacancies</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center text-white" href="<?=site_url('studentlink');?>">Student Links</a>
                            </div>
                        </li>
                        <li class="nav-item acitve">
                            <a class="nav-link text-white" href="<?=site_url('canclect');?>">Cancelled Lectures</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?=site_url('contact');?>">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?=site_url('Login');?>">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
