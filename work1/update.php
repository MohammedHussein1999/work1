<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit</title>
    <style rel="stylesheet">
        body {
            background-color: #333;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #444;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        .form-container input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
        }

        .form-container button {
            width: 90%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: green;
            color: #fff;
        }

        .form-container button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
<div class="container">
   <form id="editForm" class="form-container" method="post" action="update.php">
    <h2>Edit</h2>
    <input type="hidden" id="id" name="id"> <!-- حقل خفي لنقل معرف العميل -->
    <input type="text" id="phone" placeholder="Phone number" name="phone" required>
    <input type="text" id="first_name" name="first_name" placeholder="First Name" readonly>
    <input type="text" id="last_name" name="last_name" placeholder="Last Name" readonly>
    <input type="text" id="email" name="email" placeholder="Email" readonly>
    <input type="text" id="address" name="address" placeholder="Address" readonly>
    <button type="submit" class="login-btn">Update</button>
</form>

</div>

<script>
    // استرجاع البيانات من localStorage وتعيينها في حقول النموذج
    var phone = localStorage.getItem('phone');
    var id = localStorage.getItem('id');
    var first_name = localStorage.getItem('first_name');
    var last_name = localStorage.getItem('last_name');
    var email = localStorage.getItem('email');
    var address = localStorage.getItem('address');

    document.getElementById('phone').value = phone;
    document.getElementById('id').value = id;
    document.getElementById('first_name').value = first_name;
    document.getElementById('last_name').value = last_name;
    document.getElementById('email').value = email;
    document.getElementById('address').value = address;
</script>

</body>
</html>
