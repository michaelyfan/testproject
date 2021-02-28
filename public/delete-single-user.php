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
  require "../config.php";
  
  try {
    $db = new PDO($dsn, $username, $password, $options);
    $sql = "DELETE FROM users WHERE id = :id";

    $statement = $db->prepare($sql);
    $statement->bindValue(":id", $_GET['id']);
    $statement->execute();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  Successfully deleted.
<?php } ?>

<?php if (!isset($_POST['submit'])) { ?>
  <form method="post">
    <p>Are you sure you want to delete <?php echo escape($user['firstname']); ?> ?</p>
    <input type="submit" name="submit" value="Yes">
  </form>
<?php } ?>

<a href="users.php">
  Back to users
</a>

<?php include "templates/footer.php"; ?>
