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
    <title>Dashboard</title>
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
              <a class="active" href=""><li>Children</li></a>
              <a href="subscribers.php"><li>Subscribers</li></a>
              <a href=""><li></li></a>
            </ul>
          </nav>
          <a class="logout" href="logout.php">Logout</a>
        </div>
        <div class="main-page">
          <button onclick="addkid()">Add</button>
          <div class="children-cards">
            <div class="cloader"></div>
          </div>
          <div class="cwrapper">
            <form id="childform">
              <label
                >Profile Image: <input type="file" id="image" required /></label
              ><br />
              <label>Name: <input type="text" id="name" required /></label
              ><br />
              <label>Age: <input type="number" id="age" required /></label
              ><br />
              <label>Gender: <input type="text" id="gender" required /></label
              ><br />
              <label>Location: <input type="text" id="county" required /></label
              ><br />
              <label>Goal: <input type="text" id="goal" required /></label
              ><br />
              <label
                >Future Aspiration:
                <input type="text" id="future_aspiration" required /></label
              ><br />
              <label
                >How Joined:
                <input type="text" id="how_joined" required /></label
              ><br />
              <button type="submit">Add Child</button>
            </form>
          </div>
          
          <div class="cwrapper2">
            <form id="childform2">
                <label>Profile Image: <input type="file" id="image" name="image" /></label><br />
  <label>Name: <input type="text" id="name" name="name" required /></label><br />
  <label>Age: <input type="number" id="age" name="age" required /></label><br />
  <label>Gender: <input type="text" id="gender" name="gender" required /></label><br />
  <label>Location: <input type="text" id="county" name="county" required /></label><br />
  <label>Goal: <input type="text" id="goal" name="goal" required /></label><br />
  <label>Future Aspiration: <input type="text" id="future_aspiration" name="future_aspiration" required /></label><br />
  <label>How Joined: <input type="text" id="how_joined" name="how_joined" required /></label><br />
              <button type="submit">Edit Child</button>
              <div id="delbtn" data-id="">delete</div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="../jquery-3.7.1.min.js"></script>
    <script>
      $(document).ready(function () {
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
          url: "../search.php", // Replace with your API endpoint
          type: "GET", // Change to GET if needed
          dataType: "json",
          success: function (response) {
            response.forEach((item) => {
              $(".children-cards").append(
                '<div class="card" data-id="' + item.id + '">' +
                  '<img src="../'+item.image_path+'" alt="' +
                  item.name +
                  '">' +
                  '<div class="info">' +
                  '<p><span class="step">Name:</span> ' +
                  item.name +
                  "</p>" +
                  '<p><span class="step">Age:</span> ' +
                  item.age +
                  "</p>" +
                  '<p><span class="step">Gender:</span> ' +
                  item.gender +
                  "</p>" +
                  '<p><span class="step">Location:</span> ' +
                  item.county +
                  "</p>" +
                  '<p><span class="step">Goal:</span> ' +
                  item.goal +
                  "</p>" +
                  '<p><span class="step">Future Aspiration:</span> ' +
                  item.future_aspiration +
                  "</p>" +
                  '<p><span class="step">How Joined:</span> ' +
                  item.how_joined +
                  "</p>" +
                  "</div>" +
                  "</div>"
              );
            });
            $(".cloader").hide();
          },
          error: function (xhr, status, error) {
            $(".sponsor-cards").append("<p>No Results Found</p>");
          },
        });
      });
      function addkid() {
        $(".cwrapper").css("display", "flex");
      }
      $(".cwrapper").click(function (event) {
        if (event.target === this) {
          $(".cwrapper").css("display", "none");
        }
      });
      $(".cwrapper2").click(function (event) {
        if (event.target === this) {
          $(".cwrapper2").css("display", "none");
        }
      });
    </script>
    <script>
        $(document).ready(function () {
    $('#childform').submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        let formData = new FormData();
        formData.append('image', $('#image')[0].files[0]);
        formData.append('name', $('#name').val());
        formData.append('age', $('#age').val());
        formData.append('gender', $('#gender').val());
        formData.append('county', $('#county').val());
        formData.append('goal', $('#goal').val());
        formData.append('future_aspiration', $('#future_aspiration').val());
        formData.append('how_joined', $('#how_joined').val());

        $.ajax({
            url: 'addchildren.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                alert(response);
                $('#childform')[0].reset(); // Reset the form after submission
                $(".cwrapper").css("display", "none");
            },
            error: function () {
                alert('Error submitting form');
            }
        });
    });
});

    </script>
<script>
    $(document).ready(function () {
      // When a card is clicked, populate the edit form
      $('.children-cards').on('click', '.card', function () {
        let childId = $(this).attr('data-id');
        let childData = $(this).find('.info');
        console.log(childId);
        // Populate the form fields
        $('#childform2 #name').val(childData.find("p:contains('Name:')").text().replace('Name: ', ''));
        $('#childform2 #age').val(childData.find("p:contains('Age:')").text().replace('Age: ', ''));
        $('#childform2 #gender').val(childData.find("p:contains('Gender:')").text().replace('Gender: ', ''));
        $('#childform2 #county').val(childData.find("p:contains('Location:')").text().replace('Location: ', ''));
        $('#childform2 #goal').val(childData.find("p:contains('Goal:')").text().replace('Goal: ', ''));
        $('#childform2 #future_aspiration').val(childData.find("p:contains('Future Aspiration:')").text().replace('Future Aspiration: ', ''));
        $('#childform2 #how_joined').val(childData.find("p:contains('How Joined:')").text().replace('How Joined: ', ''));
  
        // Add the ID to the delete button and form
        $('#delbtn').attr('data-id', childId);
        $('#childform2').attr('data-id', childId);
        // Show the form for editing
        $('.cwrapper2').css('display', 'flex');
      });
  
      // Handle form submission for updating child data
      $('#childform2').submit(function (event) {
        event.preventDefault();
        let childId = $(this).attr('data-id');
        let formData = new FormData(this);
        formData.append('id', childId);
  
        $.ajax({
          url: 'updatechild.php', // PHP script to update the child in the database
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            alert(response);
            $('.cwrapper2').hide();
            location.reload(); // Reload the page to reflect the changes
          },
          error: function () {
            alert('Error updating child');
          }
        });
      });
  
      // Handle delete button click
      $('#delbtn').click(function () {
        let childId = $(this).attr('data-id');
        if (confirm('Are you sure you want to delete this child?')) {
          $.ajax({
            url: 'updatechild.php', // PHP script to delete the child from the database
            type: 'POST',
            data: { idd: childId },
            success: function (response) {
              alert(response);
              $('.cwrapper2').hide();
              location.reload(); // Reload the page after deletion
            },
            error: function () {
              alert('Error deleting child');
            }
          });
        }
      });
    });
  </script>
  
      
  </body>
</html>
