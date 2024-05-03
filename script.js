$(function() {
  console.log('hello');
  $('#btn-back').on('click', function(e) {
    e.preventDefault();
    location.href = 'index.php';
  });
});
