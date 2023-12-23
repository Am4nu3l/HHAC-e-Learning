<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Side Navigation with Tabbed View</title>
        <link rel="stylesheet" href="css/material.css">
        <link rel="stylesheet" href="fontawesome/css/all.css">
         <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-storage.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
       
    </head>

    <body>
        <div class="topnav">
           <a class="active" href="index.html">Home</a>
      <a href="material.php">Materials</a>
      <a href="blog.php">Blog</a>
      <a href="about.html">About</a>
      <a href="services.html">Services</a>
        </div>
        <div id="centeredDiv" class="hidden">
            <div class="cancel">
                <button id="cancel"><i class="fa-solid fa-circle-xmark fa-2x"></i></button>
            </div>
            <div class="inner-container">
                <div>
                    <h2>Material Form</h2>
                </div>
                <p>fill every field with the necessary information</p>
            <form id="upload-form" enctype="multipart/form-data" action="upload-endpoint.php" method="post">
    <div class="input-container">
        <input type="text" placeholder="title" name="title">
        <input type="text" placeholder="description" name="description">
        <input type="hidden" name="uploadedURL" id="uploadedURL"> <!-- Hidden input field for uploadedURL -->
       
        <input type="file" id="fileInput">
        <button type="button" onclick="uploadFileAndSubmitForm()">Upload</button>
    </div>
</form>
<script>
var firebaseConfig = {
                apiKey: "AIzaSyCFSIb9PRVW5qR19bfF1QNRqtHtDv6e5bM",
                authDomain: "binipro-ee596.firebaseapp.com",
                projectId: "binipro-ee596",
                storageBucket: "binipro-ee596.appspot.com",
                messagingSenderId: "20810059485",
                appId: "1:20810059485:web:79c38291ace8ca7aa9d534"
            };
firebase.initializeApp(firebaseConfig);
function uploadFileAndSubmitForm() {
    var fileInput = document.getElementById("fileInput");
    var file = fileInput.files[0];

    if (file) {
        var storageRef = firebase.storage().ref();
        var remoteFilePath = "images/" + file.name;

        var uploadTask = storageRef.child(remoteFilePath).put(file);

        uploadTask.on("state_changed",
            function (snapshot) {
                var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                console.log("Upload progress: " + progress + "%");
            },
            function (error) {
                console.error("Error uploading file: ", error);
            },
            function () {
                uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                    console.log("File uploaded successfully. Download URL: ", downloadURL);

                    var database = firebase.database();
                    var dataRef = database.ref('mak');

                    var userData = {
                        userId: "Abul Doe",
                        blogId: "john@example.com",
                        logImageUrl: downloadURL
                    };

                    dataRef.set(userData, function (error) {
                        if (error) {
                            console.error("Error writing data to the database: ", error);
                        } else {
                            console.log("Data written successfully to the database.");
                            // Set the uploadedURL value to the hidden input field
                            var uploadedURLInput = document.getElementById("uploadedURL");
                            uploadedURLInput.value = downloadURL;
                            var uploadForm = document.getElementById('upload-form');
                            var formData = new FormData(uploadForm);
                            formData.set("uploadedURL", downloadURL);
                            uploadForm.submit();
                        }
                    });
                });
            }
        );
    } else {
        console.log("Please select a file.");
    }
}

</script>
                 
           
            </div>
        </div>
        <div class="column-body">
            <div class="contents">
                <div class="left">
                    <h2>contents</h2>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                      <div class="buttons">
                        <div>
                            <button type="submit" name="book" value="book">Books</button>
                        </div>
                        <div>
                             <button type="submit" name="note" value="note">Notes</button>
                        </div>
                        <div>
                             <button type="submit" name="exam" value="exam">Exam Paper</button>
                        </div>
                         <div>
                             <button type="submit" name="problem" value="problem">Solved problems</button>
                        </div>
                        <div>
                            <button type="submit" name="research" value="research">Research Papers</button>
                        </div>
                        <div>
                            <button type="submit" name="document" value="book">Documents</button>
                        </div>
                     </div>
                    </form>
                </div>
                <div class="center">
                    <div class="center-top-nav">
                        <div class="search">
                            <input type="text" placeholder="search">
                            <button>search</button>
                        </div>
                        <div class="add">
                            <button id="showButton">Post Material</button>
                            <script >
                                // Get references to the button and the centered div
const showButton = document.getElementById("showButton");
const centeredDiv = document.getElementById("centeredDiv");
const cancelbtn = document.getElementById("cancel");
// Add a click event listener to the button
showButton.addEventListener("click", () => {
    // Toggle the 'hidden' class on the centered div to show/hide it
    centeredDiv.classList.toggle("hidden");
});
cancelbtn.addEventListener("click",()=>{
 centeredDiv.classList.toggle("hidden");
});
                            </script>
                        </div>
                    </div>
                    <?php
                    // Replace these with your actual database credentials
                    $db_host = "bvbmnjawn8p5szgiq78e-mysql.services.clever-cloud.com";
                    $db_name = "bvbmnjawn8p5szgiq78e";
                    $db_user = "us2zhojyh8zuitju";
                    $db_password = "6yx4YEmGCLgN7ldfiTic@";
                    $button = $_POST['book'];
                    // Create a connection
                    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                    // Check the connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } else {
                        echo "connected";

                        // SQL query for insert operation
                        $dd = "select * from material";
                        $result = $conn->query($dd);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $id = $row["title"];
                                $name = $row["description"];
                                $last = $row["postedBy"];
                                $min = $row["postedOn"];
                                $link = $row["imageLink"];
                                if ($button == 'book') {
                                    echo ' <div class="content-wrraper">
                        <div class="single-material">
                            <div class="img-desc-container">
                                <div class="img-div">
                                    <img src="images/book.jpeg">
                                </div>
                                <div class="description">
                                    <div class="posted-by">
                                        <h3><a href="' . $link . '">' . $id . '</a></h3>
                                    </div>
                                    <p>' . "$name" . '
                                    </p>
                                </div>
                            </div>
                            <div class="posted-on">
                                <h4>Posted By: ' . "$last" . '</h4>
                                <p>Posted On: ' . "$min" . '</p>
                            </div>
                        </div>
                    </div>';
                                } else {
                                    echo 'no result';
                                }

                            }
                        } else {
                            echo "0 results";
                        }
                    }

                    $conn->close();
                    ?>
                </div>
                <div class="right">

                    <div class="flex-item-right right-nav">
                        <div class="search-blog">
                            <div><input id="mat-search-bar" type="text" placeholder="search"></div>
                            <div><button id="mat-search-btn"><i class="fa-solid fa-search"></i></button></div>
                        </div>
                        <div id="most-downloaded">
                            <p>Most Downloaded Documents</p>
                        </div>
                        <ul>
                            <div>
                                <li>
                                    <a href="#">w3schools</a>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <a href="#">will learn how </a>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <a href="#">They offer free</a>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <a href="#">tutorials in all</a>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <a href="#">w3schools</a>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <a href="#">will learn how </a>
                                </li>
                            </div>
                        </ul>
                        <div id="most-viewed">
                            <p>Most Viewed Documents</p>
                        </div>
                        <ul>

                            <div>
                                <li>
                                    <a href="#">They offer free</a>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <a href="#">tutorials in all</a>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <a href="#">w3schools</a>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <a href="#">will learn how </a>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <a href="#">They offer free</a>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <a href="#">tutorials in all</a>
                                </li>
                            </div>
                        </ul>
                        <hr>
                        <div class="medias">
                            <div>
                                <i class="fa-brands fa-square-instagram fa-2x"></i>
                                <i class="fa-brands fa-square-facebook fa-2x"></i>
                                <i class="fa-brands fa-youtube fa-2x"></i>
                                <i class="fa-brands fa-telegram fa-2x"></i>
                                <i class="fa-brands fa-square-twitter fa-2x"></i>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>



    </body>

</html>