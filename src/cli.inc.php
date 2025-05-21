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
      $_SESSION['cli_history'][] = "help | about | clear | contact | projects";
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
      <br>
      <br>    
      EMAIL : georgeattallah2005@gmail.com 
      <br>
      <br>
          <div class="links">
            
            <a href="https://github.com/grugg1233"  target="_blank" 
          rel="noopener noreferrer"><img src="Images/Github-Logo.png" width="80" height="80"></a>
            
            <a href="https://www.linkedin.com/in/george-attallah-0a47112b9/"  target="_blank" 
          rel="noopener noreferrer"><img src="Images/linkedin-logo.webp" width="80" height="80"></a>
          </div>
        <br>
        <br>
          ';
        break;
    case 'projects': 
      $_SESSION['cli_history'][] = '<table class = "projectTable">
          <thead>
            <tr>
              <th>Project</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="https://github.com/grugg1233/Portfolio-Site"  target="_blank" 
          rel="noopener noreferrer">Portfolio-Site</a></td>
              <td>Personal portfolio that showcases my projects in action.</td>
            </tr>
            <tr>
              <td><a href="https://github.com/grugg1233/SADAL_Interpereter"  target="_blank" 
          rel="noopener noreferrer">SADAL_Interpereter</a></td>
              <td>Lexical analyzer, parser, and interpreter for a Simple ADA-like language in C++.</td>
            </tr>
            <tr>
              <td><a href="https://github.com/grugg1233/StudentPerformanceFactors"  target="_blank" 
          rel="noopener noreferrer">StudentPerformanceFactors</a></td>
              <td>Train and optimize AI models to predict student exam scores using Kaggle data.</td>
            </tr>
            <tr>
              <td><a href="https://github.com/grugg1233/Flashcard-Utility-Linked-Lists-"  target="_blank" 
          rel="noopener noreferrer">Flashcard-Utility-Linked-Lists-</a></td>
              <td>Java GUI flashcard app using linked-list data structures.</td>
            </tr>
            <tr>
              <td><a href="https://github.com/grugg1233/SnakeCPP"  target="_blank" 
          rel="noopener noreferrer">SnakeCPP</a></td>
              <td>Terminal-style Snake game written in C++.</td>
            </tr>
            <tr>
              <td><a href="https://github.com/grugg1233/Rental-Bidding-"  target="_blank" 
          rel="noopener noreferrer">Rental-Bidding-</a></td>
              <td>Web-based rental bidding platform (HTML/CSS/JS).</td>
            </tr>
            <tr>
              <td><a href="https://github.com/grugg1233/GUI-Calculator-Project-Java-"  target="_blank" 
          rel="noopener noreferrer">GUI-Calculator-Project-Java-</a></td>
              <td>Integer calculator with a Java Swing GUI.</td>
            </tr>
          </tbody>
        </table>
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
