<?php
// Dummy data gambar berdasarkan id
$images = [
  1 => [
    'title' => 'Lexus IS250 Drift Car',
    'description' => 'Drift Car Stance Luxury Sports Car Art Poster.',
    'image' => 'img/1.jpg',
    'source' => 'etsy.com'
  ],
  2 => [
    'title' => 'Sports Car Poster',
    'description' => 'Luxury Sports Car Background Wallpaper.',
    'image' => 'img/2.jpg',
    'source' => 'etsy.com'
  ],
  3 => [
    'title' => 'Sports Car Poster',
    'description' => 'Luxury Sports Car Background Wallpaper.',
    'image' => 'img/3.jpg',
    'source' => 'etsy.com'
  ]
];

$id = $_GET['id'];
$image = $images[$id];

// Dummy comments
$comments = [
  ['name' => 'John Doe', 'comment' => 'This is a great car!'],
  ['name' => 'Jane Smith', 'comment' => 'I love the design.']
];

// Dummy like count
$like_count = 5;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Tambah komentar baru ke array komentar
  $new_comment = [
    'name' => htmlspecialchars($_POST['name']),
    'comment' => htmlspecialchars($_POST['comment'])
  ];
  $comments[] = $new_comment;

  // Update like count for demo purposes
  if (isset($_POST['like'])) {
    $like_count++;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $image['title']; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Tambahkan Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .container {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            flex-wrap: wrap;
        }
        .image-container {
            flex-basis: 50%;
            padding: 20px;
        }
        .image-container img {
            width: 100%;
            height: auto;
            border-radius: 15px;
        }
        .info-container {
            flex-basis: 40%;
            padding: 20px;
        }
        .info-container h1 {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        .info-container p {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .info-container a {
            text-decoration: none;
            color: #007bff;
        }
        .top-buttons {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .btn-back {
            padding: 10px 15px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            color: white;
            font-size: 1rem;
            background-color: #007bff;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
        .btn-like-container {
            display: flex;
            align-items: center;
        }
        .btn-like {
            font-size: 1.5rem;
            color: #007bff;
            cursor: pointer;
            transition: color 0.3s;
        }
        .btn-like.liked {
            color: red;
        }
        .like-count {
            font-size: 1.2rem;
            margin-left: 10px;
            color: #007bff;
        }
        .comment-section {
            margin-top: 30px;
        }
        .comment-form {
            margin-top: 20px;
            position: relative;
        }
        .comment-form textarea {
            width: calc(100% - 50px); /* Mengurangi lebar untuk memberikan ruang bagi ikon */
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            resize: none;
        }
        .comment-form button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background-color: green;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .comment-form button:hover {
            background-color: darkgreen;
        }
        .comment-list {
            margin-top: 20px;
        }
        .comment-list h4 {
            font-weight: bold;
        }
        .comment-list p {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="image-container">
        <img src="<?php echo $image['image']; ?>" alt="<?php echo $image['title']; ?>">
    </div>
    <div class="info-container">
        <!-- Tombol Like dan Kembali di bagian atas teks -->
        <div class="top-buttons">
            <div class="btn-like-container">
                <i class="fas fa-heart btn-like" onclick="toggleLike()"></i>
                <div class="like-count" id="like-count"><?php echo $like_count; ?></div>
            </div>
            <a href="index.php" class="btn btn-outline-primary m-1 btn-animated">Kembali</a>
        </div>
        <h1><?php echo $image['title']; ?></h1>
        <p><?php echo $image['description']; ?></p>
        <p>Sumber: <a href="<?php echo $image['source']; ?>"><?php echo $image['source']; ?></a></p>
        
        <!-- Form Komentar -->
        <div class="comment-form">
            <form method="POST" action="">
                <textarea name="comment" rows="1" placeholder="Your Comment" required></textarea>
                <button type="submit">
                    <!-- Ikon Panah Kertas -->
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script>
    function toggleLike() {
        const likeButton = document.querySelector('.btn-like');
        const likeCount = document.getElementById('like-count');
        
        likeButton.classList.toggle('liked');
        
        if (likeButton.classList.contains('liked')) {
            likeCount.innerText = parseInt(likeCount.innerText) + 1;
        } else {
            likeCount.innerText = parseInt(likeCount.innerText) - 1;
        }
    }
</script>
</body>
</html>
