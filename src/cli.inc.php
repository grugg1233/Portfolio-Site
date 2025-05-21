<?php
session_start();

// Initialize or clear history
if (!isset($_SESSION['cli_history'])) {
  $_SESSION['cli_history'] = [];
}

// Handle a submitted command
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['cmd'])) {
  $cmd = trim($_POST['cmd']);
  $_SESSION['cli_history'][] = "<span class='prompt'>guest@site:~$</span> {$cmd}";
  
  // parse & respond
  list($c,$arg) = array_pad(explode(' ', $cmd, 2), 2, '');
  switch(strtolower($c)) {
    case 'help':
      $_SESSION['cli_history'][] = "help | about | clear | contact";
      break;
    case 'about':
      $_SESSION['cli_history'][] = "Hello! I am George Attallah, a rising junior in Computer Science (with an Applied Math minor) at NJIT, 
            holding a 4.0 GPA. I spend my free time turning ideas into code—everything from data-driven platforms 
            to algorithmic experiments. When I am not behind a keyboard, you will find me coaching boxing at NJIT MMA Club 
            or playing piano. After a year troubleshooting tech as a Daktronics support agent, I am headed to Lumena Energy 
            this summer to help build their DAIODE AI node.";
      break;
    case 'clear':
      $_SESSION['cli_history'] = [];
      break;
    case 'contact':
      $_SESSION['cli_history'][] = '
          georgeattallah2005@gmail.com <br>
          <div class="links">
            <img src="Images/Github-Logo.png" width="40" height="40">
            <a href="https://github.com/grugg1233">My GitHub</a>
            <img src="Images/linkedin-logo.webp" width="40" height="40">
            <a href="https://www.linkedin.com/in/george-attallah-0a47112b9/">My LinkedIn</a>
          </div>
        ';
        break;
      
    default:
      $_SESSION['cli_history'][] = "Unknown command: {$c}";
  }
}

// Render history
foreach($_SESSION['cli_history'] as $line) {
  echo "<div>{$line}</div>";
}

// The prompt form
?>
<form method="post">
    <?php   
      date_default_timezone_set("America/New_York");
      echo date("h:ia");
      ?>
    <span class="prompt">guest@site:~$</span>       

  <input name="cmd" autocomplete="off" autofocus>
</form>
