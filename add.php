<?php require('header.php'); ?>
<body class="add">
<?php require('navigation.php'); ?>
<div class="container inner">
    <?php

    //initialize variables
    $id = null;
    $fullname = null;
    $text = null;
    $title = null;
    $publish_date = null;
    $email = null;

    //added profile & linkk
    $profile = null;

    if(!empty($_GET['id']) && (is_numeric($_GET['id']))) {
      //grab the id from url
      $id = filter_input(INPUT_GET, 'id');
      //connect to the database
      require_once('connect.php');
      //set up our query
      $sql = "SELECT * FROM entry WHERE user_id = :user_id;";
      //prepare our statement
      $statement = $db->prepare($sql);
      //bind
      $statement->bindParam(':user_id', $id);
      //execute
      $statement->execute();
      //use fetchAll to store
      $records = $statement->fetchAll();
      //to loop through, use a foreach loop
      foreach($records as $record) :
      $fullname = $record['full_name'];
      $text = $record['text'];
      $title = $record['title'];
      $publish_date = $record['publish_date'];
      $email = $record['email'];
      $profilepic = $record['profile'];
      endforeach;
      //close the db connection
      $statement->closeCursor();
    }
    ?>
    <main>
    <h1>You need to share above information to create your Journal!</h1>

      <form action="process.php" method="post" enctype="multipart/form-data" class="form">
        <!-- add hidden input with user id if editing -->
        <input type="hidden" name="user_id" value="<?php echo $id;?>">
        <div class="form-group">
          <label for="fullname"> Your full Name  </label>
          <input type="text" name="full_name" class="form-control" id="full_name" value="<?php echo $fullname; ?>">
        </div>
        <div class="form-group">
          <label for="Text"> Text about your journal  </label>
          <input type="text" name="text" class="form-control" id="text" value="<?php echo $text; ?>">
        </div>
        <div>
          <label for="location"> Your Journal Title </label>
          <input type="text" name="Title" class="form-control" id="Title" value="<?php echo $title; ?>">
        </div>
        <div class="form-group">
          <label for="location"> Publish Date of journal </label>
          <input type="number" name="Date" class="form-control" id="Date" value="<?php echo $publish_date; ?>">
        </div>
        <div class="form-group">
          <label for="email"> Your Email </label>
          <input type="text" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
        </div>

        <div class="form-group">
          <label for="profile">Add Profile Picture for your Journal  </label>
          <input type="file" name="photo" id="profilepic" value="<?php echo $profile;?>">
        </div>

        <input type="submit" name="submit" value="Submit" class="btn">

      </form>
    </main>

<?php require('footer.php'); ?>
