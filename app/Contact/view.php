<?php
session_start();  // Start the session

// Include the header file
require __DIR__ . '/../includes/header.php'; 

?>

<div class="container mt-5">
    <h1>Welcome to Coff Framework Contact Page!</h1>
    <p>If you have any questions, feel free to contact us by filling out the form below.</p>

    <!-- Display session message if any -->
    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?>" role="alert">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']); // Clear the session message
            unset($_SESSION['message_type']); // Clear the session message type
            ?>
        </div>
    <?php endif; ?>

    <form action="/?path=Contact" method="post" class="mt-4">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group mt-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group mt-3">
            <label for="subject">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="form-group mt-3">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Send Message</button>
    </form>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>
