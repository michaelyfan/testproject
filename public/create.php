
<?php

if (isset($_POST['submit'])) {
  require "../config.php";
  require "../common.php";
  
  try {
    $db = new PDO($dsn, $username, $password, $options);

    $sql = "INSERT INTO users (firstname, lastname, email, age, location) VALUES (:firstname, :lastname, :email, :age, :location)";
    $statement = $db->prepare($sql);
    $statement->bindValue(':firstname', $_POST['firstname']);
    $statement->bindValue(':lastname', $_POST['lastname']);
    $statement->bindValue(':email', $_POST['email']);
    $statement->bindValue(':age', $_POST['age']);
    $statement->bindValue(':location', $_POST['location']);
    $statement->execute();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['firstname']); ?> successfully added.
<?php } ?>

<h2>Add a user</h2>

<form method="post">
  <label for="firstname">First Name</label>
  <input type="text" name="firstname" id="firstname">
  <label for="lastname">Last Name</label>
  <input type="text" name="lastname" id="lastname">
  <label for="email">Email Address</label>
  <input type="text" name="email" id="email">
  <label for="age">Age</label>
  <input type="text" name="age" id="age">
  <label for="location">Location</label>
  <input type="text" name="location" id="location"><br />
  <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>