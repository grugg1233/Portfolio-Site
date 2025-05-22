<?php
session_start();

// Initialize or clear history
if (!isset($_SESSION['cli_history'])) {
  $_SESSION['cli_history'] = [];
}

// Handle a submitted command
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cmd'])) {
  $cmd = trim($_POST['cmd']);
  $_SESSION['cli_history'][] = "<span class='prompt'>guest@site:~$</span> {$cmd}";

  // parse & respond
  list($c, $arg) = array_pad(explode(' ', $cmd, 2), 2, '');
  switch (strtolower($c)) {
    case 'help':
      $_SESSION['cli_history'][] = "help | clear | contact | about | projects | work";
      break;

    case 'about':
      ob_start();
      include __DIR__ . '/about.inc.php';
      $html = ob_get_clean();
      $_SESSION['cli_history'][] = $html;
      break;

    case 'clear':
      $_SESSION['cli_history'] = [];
      break;

    case 'contact':
      $_SESSION['cli_history'][] = '<br><br>EMAIL : georgeattallah2005@gmail.com<br><br>' .
        '<div class="links">' .
        '<a href="https://github.com/grugg1233" target="_blank" rel="noopener noreferrer">' .
        '<img src="Images/Github-Logo.png" width="80" height="80" alt="GitHub"></a>' .
        '<a href="https://www.linkedin.com/in/george-attallah-0a47112b9/" target="_blank" rel="noopener noreferrer">' .
        '<img src="Images/linkedin-logo.webp" width="80" height="80" alt="LinkedIn"></a>' .
        '</div><br><br>';
      break;

    case 'projects':
      $_SESSION['cli_history'][] = '<table class="projectTable">'
        . '<thead><tr><th>Project</th><th>Description</th></tr></thead>'
        . '<tbody>'
        . '<tr><td><a href="https://github.com/grugg1233/Portfolio-Site" target="_blank">Portfolio-Site</a></td><td>Personal portfolio that showcases my projects in action.</td></tr>'
        . '<tr><td><a href="https://github.com/grugg1233/SADAL_Interpereter" target="_blank">SADAL_Interpreter</a></td><td>Lexical analyzer, parser, and interpreter for a Simple ADA-like language in C++.</td></tr>'
        . '<tr><td><a href="https://github.com/grugg1233/StudentPerformanceFactors" target="_blank">StudentPerformanceFactors</a></td><td>Train and optimize AI models to predict student exam scores using Kaggle data.</td></tr>'
        . '<tr><td><a href="https://github.com/grugg1233/Flashcard-Utility-Linked-Lists-" target="_blank">Flashcard-Utility-Linked-Lists</a></td><td>Java GUI flashcard app using linked-list data structures.</td></tr>'
        . '<tr><td><a href="https://github.com/grugg1233/SnakeCPP" target="_blank">SnakeCPP</a></td><td>Terminal-style Snake game written in C++.</td></tr>'
        . '<tr><td><a href="https://github.com/grugg1233/Rental-Bidding-" target="_blank">Rental-Bidding</a></td><td>Web-based rental bidding platform (HTML/CSS/JS).</td></tr>'
        . '<tr><td><a href="https://github.com/grugg1233/GUI-Calculator-Project-Java-" target="_blank">GUI-Calculator</a></td><td>Integer calculator with a Java Swing GUI.</td></tr>'
        . '</tbody></table>';
      break;

    case 'work':
      // Daktronics section
      $_SESSION['cli_history'][] = '<div class="work-section">'
        . '<a href="https://www.daktronics.com/en-us" target="_blank" rel="noopener noreferrer">'
        . '<img src="Images/DakLogoWhite.svg" width="150" height="150"></a>'
        . '<div class="recommendation">'
        . '<p>To Whom It May Concern,<br>'
        . 'I am pleased to write this letter of recommendation for George Attallah, who served as a Help Desk Student on our Technical Services team at Daktronics. During his time with us, George consistently demonstrated professionalism, technical aptitude, and a strong commitment to customer service.<br>'
        . 'In his role, George was responsible for assisting customers through phone support and Omni case handling, troubleshooting technical issues with Daktronics products, and maintaining detailed and well-formatted case notes. He actively participated in our Knowledge-Centered Service (KCS) practices, contributed to team discussions via group IM chats, and followed our documented processes for case handling and escalation with diligence.<br>'
        . 'One of George’s standout qualities was his exceptional teamwork. He was always willing to assist his peers, share knowledge, and contribute to a collaborative work environment. Whether it was jumping in to help resolve a challenging case, offering guidance to newer team members, or actively participating in Tier 1 meetings, George consistently demonstrated a team-first mindset. His positive attitude and willingness to support others made him a trusted and respected member of our group.<br>'
        . 'George’s proactive attitude, collaborative spirit, and strong work ethic make him well-suited for any internship or professional opportunity he chooses to pursue. I am confident that he will bring the same level of dedication and excellence to his next role as he did here at Daktronics.<br><strong>Sincerely,<br>Chris Gundvaldson<br>Technical Services Supervisor</strong></p>'
        . '</div>'
        . '</div>';
      // Lumena section
      $_SESSION['cli_history'][] = '<div class="work-section">'
        . '<a href="https://lumenaenergy.com/" target="_blank" rel="noopener noreferrer">'
        . '<img src="Images/Lumena-White-Logo.webp" width="150" height="150"></a>'
        . '<ul class="lumena-tasks">'
        . '<li>Research and identify AI workloads best suited for NPUs in a decentralized setup.</li>'
        . '<li>Establish benchmarking tests for AI model performance and energy efficiency.</li>'
        . '<li>Implement basic AI inference pipelines using pre-trained models to validate hardware.</li>'
        . '<li>Participate in performance testing and system optimization.</li>'
        . '<li>Prepare a final technical report and presentation of your work.</li>'
        . '</ul>'
        . '</div>';
      break;

    default:
      $_SESSION['cli_history'][] = "Unknown command: {$c}";
  }
}

// Render history
foreach ($_SESSION['cli_history'] as $line) {
  echo "<div>{$line}</div>";
}

// The prompt form
?>
<form method="post" class="cli-prompt">
  <?php date_default_timezone_set("America/New_York"); echo date("h:ia"); ?>
  <span class="prompt">guest@site:~$</span>
  <input name="cmd" autocomplete="off" autofocus>
</form>
