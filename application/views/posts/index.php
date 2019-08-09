<h1><?= $title ?></h1>
<?php foreach($posts as $post) : ?>

    <h1><?php echo $post['title']; ?></h1>
    <p>
        <?php echo $post['body']; ?>
    </p>
    <small>Posted on: <?php echo $post['created_at']; ?></small>


    <?php endforeach; ?>
