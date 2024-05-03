<?php
// セッション開始
session_start();

$name = $_POST['user_name'];
$email = $_POST['email'];
$message = $_POST['message'];

// エラーメッセージの格納先
$errors = [];

if(empty($name)) {
  $errors['name_error'] = 'お名前を入力してください。';
}
if(empty($email)) {
  $errors['email_error'] = 'メールアドレスを入力してください。';
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors['email_error'] = 'メールアドレスの入力形式が正しくありません。';
}
if(empty($message)) {
  $errors['message_error'] = 'お問い合わせ内容を入力してください。';
} elseif(mb_strlen($message) > 100) {
  $errors['message_error'] = 'お問い合わせ内容が100文字を超えています。';
}

$pageFlag = 0;
// エラーが空だったら
if(empty($errors)){
    $pageFlag = 1;
}


// セッション・クッキーの設定
if(empty($errors)) {
  // セッションの保存
  $_SESSION['name'] = $name;
  $_SESSION['email'] = $email;
  $_SESSION['message'] = $message;

  // クッキーの設定（1時間有効）
  setcookie('name', $name, time() + 3600);
  setcookie('email', $email, time() + 3600);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせフォーム</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  <main class="container m-auto mt-4">
    <section>
      <!-- エラーがある場合 -->
      <?php if($pageFlag === 0) : ?>
        <h3>お問い合わせ</h3>
        <p class="text-danger">※ 全て必須入力です</p>

        <form action="confirm.php" method="post" class="p-4 border border-primary">
          <!-- お名前 -->
          <label class="mb-1" class="form-label">お名前</label>
          <!-- name_errorがあれば表示 -->
          <?php if(isset($errors['name_error'])) {
            echo '<font color="red">　※' . $errors['name_error'] . '</font>';
           }
          ?>
          <input type="text" name="user_name" class="mb-4 form-control" placeholder="山田 太郎" value="<?php if(!empty($name)) {echo $name;} ?>">
          
          <!-- メール -->
          <label class="mb-1" class="form-label">メールアドレス</label>
          <!-- email_errorがあれば表示 -->
          <?php if(isset($errors['email_error'])) {
            echo '<font color="red">　※' . $errors['email_error'] . '</font>';
           }
          ?>
          <input type="email" name="email" class="mb-4 form-control" placeholder="yamada@taro.com" value="<?php if(!empty($email)) {echo $email;} ?>">
          
          <!-- お問い合わせ -->
          <label class="mb-1" class="form-label">お問い合わせ内容(100文字以内)</label>
          <!-- message_errorがあれば表示 -->
          <?php if(isset($errors['message_error'])) {
            echo '<font color="red">　※' . $errors['message_error'] . '</font>';
           }
          ?>
          <textarea name="message" class="form-control" placeholder="お問い合わせ内容を入力してください" value="<?php if(!empty($message)) {echo $message;} ?>"></textarea>
          
          <div class="mt-4 text-center">
            <button type="submit" class="me-4 btn btn-primary">確認する</button>
            <button type="reset" class="btn btn-primary">リセット</button>
          </div>
        </form>
      <?php endif; ?>

      <!-- エラーがない場合 -->
      <?php if($pageFlag === 1) : ?>
        <h3>入力内容をご確認ください</h3>
        <p>問題なければ「送信する」、修正する場合は「キャンセル」をクリックしてください</p>
        <form action="complete.php" method="posts" class="p-4 m-auto border border-primary">
          <div class="mb-4">
            <label class="me-4 p-2 border-bottom border-secondary">お名前</label>
            <span class="p-2 border-bottom border-info"><?php echo $name; ?></span>
          </div>

          <div class="mb-4">
            <label class="me-4 p-2 border-bottom border-secondary">メールアドレス</label>
            <span class="p-2 border-bottom border-info"><?php echo $email; ?></span>
          </div>

          <div>
            <label class="mb-1">お問い合わせ内容</label>
            <div class="p-2 border border-info"><?php echo $message; ?></div>
          </div>
          
          <div class="text-center">
            <button id="btn" class="mt-4 btn btn-primary">送信する</button>
            <button id="btn-back" class="mt-4 btn btn-primary">キャンセル</button>
          </div>
        </form>
      <?php endif; ?>
    </section>
  </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>