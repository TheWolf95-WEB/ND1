<?php
$errors = $GLOBALS['form_errors'] ?? [];
$success = isset($_GET['success']);
?>

<form method="POST">
  <label>Имя:</label>
  <input type="text" name="name" value="<?php echo esc_attr($_POST['name'] ?? '') ?>">
  <?php if (!empty($errors['name'])): ?>
    <div class="form-message form-error"><?php echo $errors['name']; ?></div>
  <?php endif; ?>

  <label>Email:</label>
  <input type="email" name="email" value="<?php echo esc_attr($_POST['email'] ?? '') ?>">
  <?php if (!empty($errors['email'])): ?>
    <div class="form-message form-error"><?php echo $errors['email']; ?></div>
  <?php endif; ?>

  <label>Отзыв:</label>
  <textarea name="message"><?php echo esc_textarea($_POST['message'] ?? '') ?></textarea>
  <?php if (!empty($errors['message'])): ?>
    <div class="form-message form-error"><?php echo $errors['message']; ?></div>
  <?php endif; ?>

  <input type="submit" name="feedback_submit" value="Отправить">
</form>

<?php if ($success): ?>
  <div class="form-message form-success">✅ Спасибо! Отзыв успешно отправлен.</div>
<?php endif; ?>
