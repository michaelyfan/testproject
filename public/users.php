<?php 

if (isset($_POST['submit'])) {
  require "../config.php";
  
  $sql = "";
  try {
    $db = new PDO($dsn, $username, $password, $options);

    $location = $_POST['location'];
    if (strlen($location) >= 1) {
      $sql = "SELECT * FROM users WHERE location = \"$location\"";
    } else {
      $sql = "SELECT * FROM users";
    }

    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

?>

<?php include "templates/header.php"; ?>

<h2>Retrieve user based on location</h2>
<h3>(Leave empty to view all users)</h3>

<form method="post">
  <input placeholder="Location..." type="text" id="location" name="location">
  <input type="submit" name="submit" value="View Results">
</form>

<?php

require "../common.php";

if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <ul>
      <?php foreach ($result as $row) { ?>
          <li>
            <?php echo escape($row["firstname"]); ?> <?php echo escape($row["lastname"]); ?>,
            <?php echo escape($row["email"]); ?>,
            age <?php echo escape($row["age"]); ?>,
            located at "<?php echo escape($row["location"]); ?>",
            (<a href="update-single-user.php?id=<?php echo escape($row["id"]); ?>">Edit</a>)
            (<a href="delete-single-user.php?id=<?php echo escape($row["id"]); ?>">Delete</a>)
          </li>
      <?php } ?>
    </ul>
  <?php } else { ?>
    <p>No results found.<p>
  <?php }
} ?>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>