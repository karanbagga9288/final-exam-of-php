<?php require_once('header.php'); ?>
<body class="add">
<div class="container inner saved">
<?php require_once('navigation.php'); ?>
<h1>Journal entry Ontario,Canada</h1>
<main>
    <?php

    $fullname = filter_input(INPUT_POST, 'fullname');
    $text = filter_input(INPUT_POST, 'text');
    $title = filter_input(INPUT_POST, 'title');
    $email = filter_input(INPUT_POST, 'email');
    $publish_date = filter_input(INPUT_POST, 'publish_date');

    $id = null;
    $id = filter_input(INPUT_POST, 'user_id');

    //set up a flag variable
    $ok = true;

    //form validation
    // first name and last name not empty

    if (empty($fullname) ) {
        echo "<p class='error'>Please provide both first and last name! </p>";
        $ok = false;
    }


    //location not empty
    if (empty($title)) {
        echo "<p class='error'>Please add your title to move further!!</p>";
        $ok = false;
    }


    //email not empty and proper format
    if (empty($email) || $email === false) {
        echo "<p class='error'>Please include your email in the proper format!</p>";
        $ok = false;
    }

    //age not empty and proper format
    if (empty($publish_date) || $publish_date === false) {
        echo "<p class='error'>Please tell us your publish date it cannot be left over empty!</p>";
        $ok = false;
    }


    if ($ok === true) {
        try {

            require_once('connect.php');
            //if we have an id, that means we are updating
            if (!empty($id)) {
                $sql = "UPDATE entry SET fullname = :fullname, text = :text,  publish_date = :publish_date, email = :email, title = :title  WHERE user_id = :user_id;";
            } else {

                $sql = "INSERT INTO entry (fullname, text , publish_date, email, title) VALUES (:fullname, :text, :publish_date, :email, :title)";
            }
            // Call the prepare method of the PDO object to prepare the query and return a PDOstatement object
            $statement = $db->prepare($sql);

            //fill the placeholders with the  input variables using bindParam method
            $statement->bindParam(':fullname', $fullname);
            $statement->bindParam(':text', $text);
            $statement->bindParam(':publish_date', $publish_date);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':title', $title);


            //if we are updating, bind :user_id
            if (!empty($id)) {
                $statement->bindParam(':user_id', $id);
            }

            // executethe insert
            $statement->execute();

            // show message
            echo "<p>Thanks for being here! </p>";

            // disconnecting
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();

            echo "<p> Sorry! there is some error.. </p> ";
            echo $error_message;
            echo " $id $first_name $last_name  $publish_date $email $title ";

        }
    }
    ?>
    <a href="index.php" class="btn btn-lg btn-secondary orange"> Back to home page</a>
</main>
<?php require_once('footer.php'); ?>
