 <?php
 require "../php-db/db.config.php";
 
 if(isset($_POST['submit'])) {
     // Process the form data here
    $name    = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['Name'])));
$company = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['Company'])));
$email   = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['E-mail'])));
$phone   = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['Phone'])));
$message = mysqli_real_escape_string($db, strip_tags(htmlspecialchars($_POST['Message'])));


$contact_query = "INSERT INTO contact_form (name, company_name, email, phone, message) VALUES ('$name', '$company', '$email', '$phone', '$message')";
if (mysqli_query($db, $contact_query)) {
    echo '<div style="
        padding: 15px;
        margin: 15px 0;
        border: 2px solid #4CAF50;
        background-color: #eaffea;
        color: #2e7d32;
        font-family: Arial, sans-serif;
        border-radius: 8px;
        box-shadow: 0px 3px 8px rgba(0,0,0,0.15);
    ">
        ✅ New contact request submitted successfully.
    </div>';
} else {
    echo '<div style="
        padding: 15px;
        margin: 15px 0;
        border: 2px solid #f44336;
        background-color: #ffeaea;
        color: #c62828;
        font-family: Arial, sans-serif;
        border-radius: 8px;
        box-shadow: 0px 3px 8px rgba(0,0,0,0.15);
    ">
        ❌ <strong>Error:</strong> ' . htmlspecialchars(mysqli_error($db)) . '
    </div>';
}


    
 }
 
 
 ?>