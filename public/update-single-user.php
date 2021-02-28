<?php

require "../config.php";
require "../common.php";

if (isset($_GET['id'])) {
  try {
    $db = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM users WHERE id = :id";

    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $_GET['id']);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
} else {
  echo "Something went wrong!";
  exit;
}

if (isset($_POST['submit'])) {
  
  try {
    $db = new PDO($dsn, $username, $password, $options);
    $thisUser =[
      "id"        => $_POST['id'],
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age'],
      "location"  => $_POST['location'],
    ];
    // TODO edit
    $sql = "UPDATE users
            SET id = :id,
              firstname = :firstname,
              lastname = :lastname,
              email = :email,
              age = :age,
              location = :location
            WHERE id = :id";

    $statement = $db->prepare($sql);
    $statement->execute($thisUser);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['firstname']); ?> successfully updated.
<?php } ?>

<form method="post">
  <label for="id">ID (cannot be edited)</label>
  <input type="text" name="id" id="id" value="<?php echo escape($user['id']); ?>" readonly>
  <label for="firstname">First Name</label>
  <input type="text" name="firstname" id="firstname" value="<?php echo escape($user['firstname']) ?>">
  <label for="lastname">Last Name</label>
  <input type="text" name="lastname" id="lastname" value="<?php echo escape($user['lastname']) ?>">
  <label for="email">Email Address</label>
  <input type="text" name="email" id="email" value="<?php echo escape($user['email']) ?>">
  <label for="age">Age</label>
  <input type="text" name="age" id="age" value="<?php echo escape($user['age']) ?>">
  <label for="location">Location</label>
  <input type="text" name="location" id="location" value="<?php echo escape($user['location']) ?>"><br />
  <input type="submit" name="submit" value="Submit">
</form>

<a href="users.php">Back to users</a>

<?php include "templates/footer.php"; ?>
