<?php
session_start();

# Redirects current page to login.php if user is not logged in.
function ensure_logged_in() {
  if (!isset($_SESSION["name"])) {
    redirect("login.php", "You must log in before you can view that page.");
  }
}

function is_logged_in() {
  if (isset($_SESSION["name"])) {
    return true;
  }
  return false;
}

# Redirects current page to the given URL and optionally sets flash message.
function redirect($url, $flash_message = NULL) {
  if ($flash_message) {
    $_SESSION["flash"] = $flash_message;
  }

  header("Location: $url");
  die;
}
?>
