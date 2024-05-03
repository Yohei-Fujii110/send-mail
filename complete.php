<?php
session_start();

// セッションに保存されたデータを取得
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'ゲスト';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';


// PHPMailerを使うために
// Composerのオートローダーの読み込み
require 'PHPMailer/vendor/autoload.php';
// PHPMailerをインポート(use ベンダー名\ライブラリー名\クラス名や関数名;)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
  // ここからはMailtrapの内容です
  $phpmailer = new PHPMailer();
  $phpmailer->isSMTP();
  $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = 'acf3*******e7c';
  $phpmailer->Password = '***********e55';
  // ここまでMailtrapの内容です

  $phpmailer->setFrom($email, $name); // Fromに当たります
  $phpmailer->addAddress('y*********.com', '*******'); // toに当たります

  $phpmailer->CharSet = 'UTF-8';
  $phpmailer->Subject = 'お問い合わせ';
  $phpmailer->Body    = $message;
  $phpmailer->send();
} catch (Exception $e) {
  $error_msg = "メール送信に失敗しました -> {$e->getMessage()}"; // 変数名は何でも大丈夫です
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
      <h3><?php echo $name; ?>様、 お問い合わせを承りました。</h3>
      <p>ありがとうございました。今後の参考にさせていただきます</p>
      <div class="text-center">
        <button id="btn-back" class="mt-4 btn btn-primary">トップに戻る</button>
      </div>
    </section>
  </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="script.js"></script>

<?php
// セッション変数を初期化
$_SESSION = array();
// セッション終了
session_destroy();
?>
</body>
</html>