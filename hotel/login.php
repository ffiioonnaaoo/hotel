<?php 
    require_once 'top.php'; 
?>
<div id="login-page" class="page">
       
       <section>
            <header>
            <h1>Admin Login</h1>
       </header>
     

     
<div id="login-form">
           <form id="frmLogin" method="POST" action="apis/api-admin-login.php">
        <p>Userame: <input name="txtUsername" type="text" placeholder="username" 
         data-validate="yes" data-type="text"></p>
         <p>Password: <input name="txtUserPassword" type="password" placeholder="password"
        data-validate="yes" data-min="4" data-max="50" data-type="string"></p>
        <button class="book-btn">Login</button>
       
      
    </form>
    
</div>

  
        
       </section>
</div>

<?php 
    $sLinktoScript = '<script src="js/admin.js"></script>';
    require_once 'bottom.php'; ?>
    



