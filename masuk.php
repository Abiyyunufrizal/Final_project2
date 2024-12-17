<!DOCTYPE html>
<html>
<head>
  <title>Login/Sign up</title>
  <style>
    /* Add your custom CSS styles here */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    
    .container {
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
    }
    
    .button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }
    
    .button:hover {
      background-color: #45a049;
    }
    
    .input-field {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login/Sign up</h2>
    <div class="button-group">
    </div>
    <input type="password" class="input-field" placeholder="admin">

    <input type="email" class="input-field" placeholder="admin@gmail.com">
    <button class="button">Login</button>
    <span>belum memiliki akun?<a href="daptar.php" class="button1">daptar disini</a>
    </span>
  </div>
</body>
</html>