<?php

function addTitle($title) 
{
  echo '<section class="container">
  <div class="page">
  <div class="page-content">
  <h1> ' . $title . ' </h1>
  <h3>Home - ' . $title . '</h3>
  </div>
  </div>
  </section>';
}

function connectTitle($title) 
{
  echo '<section class="container">
  <div class="page">
  <div class="page-content">
  <h1> ' . $title . ' </h1>
  <h3>Hello <span class="orange">' . $_SESSION['username'] . '</span></h3>
  </div>
  </div>
  </section>';
}

function profilTitle($title) 
{
  echo '<section class="container">
  <div class="page">
  <div class="page-content">
  <h1> ' . $_SESSION['username'] . ' </h1>
  <h3>Profil de <span class="orange">' . $title . '</span></h3>
  </div>
  </div>
  </section>';
}

?>