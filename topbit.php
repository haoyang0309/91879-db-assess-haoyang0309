<!DOCTYPE HTML>

<html lang="en">

<?php
    
    session_start();
    include("config.php");
    include("functions.php");   // include data sanitising...
    
    // Connect to database...
    
    $dbconnect=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    if (mysqli_connect_errno())
    
    {
        echo "Connection failed:".mysqli_connect_error();
         exit;
    }
    
?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Food Review Database">
    <meta name="keywords" content="Foods, staple, genre, reviews">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Book Review Database</title>
    
    <!-- Edit the link below / replace with your chosen google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato%7cUbuntu" rel="stylesheet"> 
    
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Edit the name of your style sheet - 'foo' is not a valid name!! -->
    <link rel="stylesheet" href="css/foo.css"> 
    
</head>
    
<body>
    
    <div class="wrapper">
    


        
    <div class="box banner">

    <!-- logo image linking to home page goes here -->
       <a href="index.php">
        <div class="box logo"  title="Logo - Click here to go to the Home Page">
        <img class="img-circle" src="Images/download.png" alt="generic logo" />

        </div> </a>  <!-- / logo -->

        
    <h1>Food Database</h1>
    </div>    <!-- / banner -->


    <div class="box side">

    <h3>Search | <a class="side" href="show_all.php">Show All</a></h3>


    <i>Type part of the title / author name if desired</i>

    <hr />

    <!-- Start of Title Search --> 

    <form method="post" action="title_search.php" enctype="multipart/form-data">

        <input class="search" type="text" name="title" size="40" value="" required placeholder="Title..." />

        <input class="submit" type="submit" name="find_title" value="&#xf002;" />

    </form>

    <!-- End of Title Search -->

    <hr />

        
        
    <i>Use the dropdown menus to search by genre or rating</i>

    <hr />
        
        
    <!-- Start of genre Search --> 

    <form method="post" action="genre_search.php" enctype="multipart/form-data">

        <select name="genre" required>
            <option value="" disabled selected>Genre...</option>
            <?php
            // retrieve unique values in genre column...
            $genre_sql="SELECT DISTINCT `Genre`
            FROM `91879_food_reviews` ORDER BY Genre ASC
            LIMIT 0 , 25";
            $genre_query=mysqli_query($dbconnect, $genre_sql);
            $genre_rs=mysqli_fetch_assoc($genre_query);
            
            do {
                
                ?>
            
            <option value="<?php echo $genre_rs['Genre']; ?>"><?php echo $genre_rs['Genre']; ?></option>
            
            <?php
                
            } // end of genre option retrieval
            
             while($genre_rs=mysqli_fetch_assoc($genre_query));
            
            ?>          

        
        </select>
        
        <input class="submit" type="submit" name="find_genre" value="&#xf002;" />
    </form>

    <!-- End of genre Search -->

<hr />
    <!-- Start of ratings Search --> 
    
    <h3>Ratings Search</h3>
    <form method="post" action="rating_search.php" enctype="multipart/form-data">

        <select class="half_width" name="amount">
            <option value="exactly" selected>Exactly...</option>
            <option value="more" selected>At least...</option>
            <option value="less">At most...</option>
        </select>
        
        <select class="half_width" name="stars">
            <option value=1>&#9733;</option>
            <option value=2>&#9733;&#9733;</option>
            <option value=3 selected>&#9733;&#9733;&#9733;</option>
            <option value=4>&#9733;&#9733;&#9733;&#9733;</option>
            <option value=5>&#9733;&#9733;&#9733;&#9733;&#9733;</option>
        
        </select>

        <input class="submit" type="submit" name="find_rating" value="&#xf002;" />

    </form>

    <!-- End of rating Search -->

</div>  <!-- / side bar -->