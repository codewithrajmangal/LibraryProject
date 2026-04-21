<?php include 'header.php'; ?>
<main>
    <h2>Borrow a Book</h2>
    <?php
    // Example: Handling book borrowing
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $bookTitle = $_POST["book_title"];
        // Code to handle borrowing process (e.g., updating database)
        echo "<p>Successfully borrowed {$bookTitle}!</p>";
    }
    ?>
    <form method="post">
        <label for="book_title">Book Title:</label>
        <input type="text" id="book_title" name="book_title" required>
        <input type="submit" value="Borrow">
    </form>
</main>
<?php include 'footer.php'; ?>
