<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["body"];
    $db_host = "bvbmnjawn8p5szgiq78e-mysql.services.clever-cloud.com";
    $db_name = "bvbmnjawn8p5szgiq78e";
    $db_user = "us2zhojyh8zuitju";
    $db_password = "6yx4YEmGCLgN7ldfiTic";
    // Create a connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
    // Sanitize and escape input values
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $currentDate = date("Y-m-d");

        // Use prepared statement
        $query = "INSERT INTO body (title, body, postedBy, postedOn, imageLink) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Bind parameters without passing by reference
        $stmt->bind_param("sssss", $title, $description, $postedBy, $currentDate, $imageLink);

        // Set parameter values
        $postedBy = 'Biniyam Nega';
        $imageLink = 'https://img.freepik.com/free-photo/smiling-students-with-backpacks_1098-1220.jpg';

        if ($stmt->execute()) {
            echo '<script>
            window.alert("you posted something");
            </script>';
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Left and Right Navigation Menu Bar</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="fontawesome/css/all.css">
        <link rel="stylesheet" href="css/blog.css">
    </head>
    <body>
        <div class="topnav">
             <a class="active" href="index.html">Home</a>
      <a href="material.php">Materials</a>
      <a href="blog.php">Blog</a>
      <a href="about.html">About</a>
      <a href="services.html">Services</a>
        </div>
        <div class="main">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="flex-item" class="left-nav">
                    <div>
                        <input type="text" placeholder="title" id="title" name="title">
                    </div>
                    <div class="blog-area">
                        <div class="input-container">
                            <textarea class="input-field" placeholder="" name="body"></textarea>
                            <div class="input-placeholder">what's on your mind?...</div>
                        </div>
                    </div>
                    <script>
                        const inputField = document.querySelector('.input-field');
                        const placeholder = document.querySelector('.input-placeholder');
                        inputField.addEventListener('input', () => {
                            if (inputField.value !== '') {
                                placeholder.style.display = 'none';
                            } else {
                                placeholder.style.display = 'block';
                            }
                        });
                    </script>
                    <div class="submit-button">
                        <input type="submit">
                    </div>
                   <div class="my-blogs"><h3>My Blogs</h3></div> 
                    <div class="prev-blog">
                         <?php
                         // Replace these with your actual database credentials
                         $db_host = "bvbmnjawn8p5szgiq78e-mysql.services.clever-cloud.com";
                         $db_name = "bvbmnjawn8p5szgiq78e";
                         $db_user = "us2zhojyh8zuitju";
                         $db_password = "6yx4YEmGCLgN7ldfiTic";

                         // Create a connection
                         $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                         // Check the connection
                         if ($conn->connect_error) {
                             die("Connection failed: " . $conn->connect_error);
                         } else {
                             // echo "connected";
                             // SQL query for insert operation
                             $dd = "select * from body";
                             $result = $conn->query($dd);

                             if ($result->num_rows > 0) {
                                 // Output data of each row
                                 while ($row = $result->fetch_assoc()) {
                                     $id = $row["title"];
                                     $name = $row["body"];
                                     $last = $row["postedBy"];
                                     $min = $row["postedOn"];
                                     $link = $row["imageLink"];
                                     echo '  <div class="my-blog">
                            <div class="previous-blog">
                                <h4>' . $id . '</h4>
                            </div>
                        </div>';

                                 }
                             } else {
                                 echo "0 results";
                             }
                         }

                         $conn->close();
                         ?>  
                    </div>

                </div>
            </form>
            <div class="flex-item-center main-content">
                <?php
                // Replace these with your actual database credentials
                $db_host = "bvbmnjawn8p5szgiq78e-mysql.services.clever-cloud.com";
                $db_name = "bvbmnjawn8p5szgiq78e";
                $db_user = "us2zhojyh8zuitju";
                $db_password = "6yx4YEmGCLgN7ldfiTic";

                // Create a connection
                $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                // Check the connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    // echo "connected";
                    // SQL query for insert operation
                    $dd = "select * from body";
                    $result = $conn->query($dd);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["title"];
                            $name = $row["body"];
                            $last = $row["postedBy"];
                            $min = $row["postedOn"];
                            $link = $row["imageLink"];
                            echo '
                            <script>
                            const myElement = document.getElementById("myElementId");
myElement.id = ' . $id . ';

                            </script>
                            <section class="single-blog-container" id="myElementId">
        <div class="blog-info">
            <h3>Posted By: ' . $last . '</h3>
            <p>' . $min . '</p>
        </div>
        <div class="container">
            <div class="blog-title">
                <h2><a href="' . $link . '">' . $id . '</a></h2>
            </div>
            <div class="blog-img">
                <img src="' . $link . '">
            </div>
            <div class="blog">
                <div class="blog-body">' .
                                str_replace('\r\n', '<br>', htmlspecialchars_decode($name)) .
                                '</div>
            </div>
        </div>
    </section>';

                        }
                    } else {
                        echo "0 results";
                    }
                }

                $conn->close();
                ?>



            </div>
            <div class="flex-item-right right-nav">
                <div class="search-blog">
                    <div><input id="mat-search-bar" type="text" placeholder="search"></div>
                    <div><button id="mat-search-btn"><i class="fa-solid fa-search"></i></button></div>
                </div>
                <h3>popular topics</h3>
                <ul>
                    <li>
                        <a href="#">w3schools</a>
                    </li>
                    <li>
                        <a href="#">will learn how </a>
                    </li>
                    <li>
                        <a href="#">They offer free</a>
                    </li>
                    <li>
                        <a href="#">tutorials in all</a>
                    </li>
                    <li>
                        <a href="#">w3schools</a>
                    </li>
                    <li>
                        <a href="#">will learn how </a>
                    </li>
                    <li>
                        <a href="#">They offer free</a>
                    </li>
                    <li>
                        <a href="#">tutorials in all</a>
                    </li>
                    <li>
                        <a href="#">w3schools</a>
                    </li>
                    <li>
                        <a href="#">will learn how </a>
                    </li>
                    <li>
                        <a href="#">They offer free</a>
                    </li>
                    <li>
                        <a href="#">tutorials in all</a>
                    </li>
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
        <footer>
            <div class="footer-content">
                <hr>
                <div class="popular-links">
                    <div id="foot-column1">
                        <ul>
                            <li><a href="#">html</a></li>
                            <li><a href="#">css</a></li>
                            <li><a href="#">javascript</a></li>
                            <li><a href="#">php</a></li>
                            <li><a href="#">sql</a></li>
                        </ul>
                    </div>
                    <div id="foot-column2">
                        <ul>
                            <li><a href="#">c++</a></li>
                            <li><a href="#">c</a></li>
                            <li><a href="#">c#</a></li>
                            <li><a href="#">python</a></li>
                        </ul>
                    </div>
                    <div id="foot-column3">
                        <ul>
                            <li><a href="#">flutter</a></li>
                            <li><a href="#">react</a></li>
                            <li><a href="#">angular</a></li>
                            <li><a href="#">express</a></li>

                        </ul>
                    </div>
                    <div>
                        <ul>
                            <li><a href="#">node</a></li>
                            <li><a href="#">firebase</a></li>
                            <li><a href="#">f#</a></li>
                            <li><a href="#">vb</a></li>
                            <li><a href="#">java</a></li>
                        </ul>
                    </div>
                </div>
                <p class="bottom-text">At w3schools.com you will learn how to make a website. They offer free tutorials
                    in all web development technologies.</p>
                <div class="media-icons">
                    <i class="fa-brands fa-square-instagram fa-2x"></i>
                    <i class="fa-brands fa-square-facebook fa-2x"></i>
                    <i class="fa-brands fa-youtube fa-2x"></i>
                    <i class="fa-brands fa-telegram fa-2x"></i>
                    <i class="fa-brands fa-square-twitter fa-2x"></i>
                </div>
                <div class="footer-content">
                    <p>&copy; 2023 Your Website Name. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>

</html>