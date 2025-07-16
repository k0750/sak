<?php
session_start();
if (!$_SESSION['role'] == 'admin') {
    header("Location: login.php");
  } 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Subscribers</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="root">
        <header>
            <div class="logo">K&K sons</div>
            <nav>
                <ul>
                    <a href="../index.html"><li>Home</li></a>
                    <a href="../Service.html"><li>Service</li></a>
                    <a href="../Contact Us.html"><li>Contact Us</li></a>
                    <a href="../learn- more.htm"><li>Learn more</li></a>
                    <a href="../sponsor.html"><li>Sponsor A Child</li></a>
                </ul>
            </nav>
        </header>
      <div class="admin-panel">
        <div class="sidebar">
          <div class="logo"></div>
          <nav>
            <ul>
              <a  href="dashboard.php"><li>Children</li></a>
              <a class="active" href=""><li>Subscribers</li></a>
              <a href=""><li></li></a>
            </ul>
          </nav>
          <a class="logout" href="logout.php">Logout</a>
        </div>
        <div class="main-page">
          <div class="children-cards">
            <div class="cloader"></div>
          </div>
        </div>
      </div>
    </div>
    <script src="../jquery-3.7.1.min.js"></script>    
    <script>
                // Send AJAX request
                $.ajax({
          url: "api-subscribers.php", // Replace with your API endpoint
          type: "GET", // Change to GET if needed
          dataType: "json",
          success: function (response) {
            response.forEach((item) => {
              $(".children-cards").append(
                '<div class="sub-card">'+
                    '<a href="mailto:'+item+'">'+item+'</a>'+
                    '</div>'
              );
            });
            $(".cloader").hide();
          },
          error: function (xhr, status, error) {
            $(".sponsor-cards").append("<p>No Results Found</p>");
          },
        });
    </script>
  </body>
</html>
