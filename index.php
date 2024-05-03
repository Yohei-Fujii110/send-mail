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
      <h3>お問い合わせ</h3>
      <p class="text-danger">※ 全て必須入力です</p>

      <form action="confirm.php" method="post" class="p-4 border border-primary">

        <label class="mb-1" class="form-label">お名前</label>
        <input type="text" name="user_name" class="mb-4 form-control" placeholder="山田 太郎" value="<?php echo isset($_COOKIE['name']) ? $_COOKIE['name'] : '';?>">
        
        <label class="mb-1" class="form-label">メールアドレス</label>
        <input type="email" name="email" class="mb-4 form-control" placeholder="yamada@taro.com" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>">
        
        <label class="mb-1" class="form-label">お問い合わせ内容(100文字以内)</label>
        <textarea name="message" class="form-control" placeholder="お問い合わせ内容を入力してください"></textarea>
        
        <div class="mt-4 text-center">
          <button type="submit" class="me-4 btn btn-primary">確認する</button>
          <button type="reset" class="btn btn-primary">リセット</button>
        </div>
      </form>
    </section>
  </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>