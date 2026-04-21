<?php include 'header.php'; ?>
<main>
    <h2>Available Books</h2>
    <?php
    // Example: Fetching books from a database
    $books = array(
        array("title" => "Book 1", "author" => "Author 1"),
        array("title" => "Book 2", "author" => "Author 2"),
        array("title" => "Book 3", "author" => "Author 3")
    );

    // Display books
    echo "<ul>";
    foreach ($books as $book) {
        echo "<li>{$book['title']} by {$book['author']}</li>";
    }
    echo "</ul>";
    ?>
</main>
<?php include 'footer.php'; ?>
