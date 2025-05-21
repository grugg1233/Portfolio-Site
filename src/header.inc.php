
<link rel = "stylesheet" type = "text/css" href = style.css> 
<div class="banner">
  <!--<img src="images/bitvaultlogo.png" alt="BitVault Logo" width="100px" height="100px" class="bannerimg">-->
  <div class = "headerInfo">
    <h1 class="headerInfo">
    George Attallah Portfolio
    <span class="loading1">.</span>
    <span class="loading2">.</span>
    <span class="loading3">.</span>
    <span class="blinking">_</span>
    </h1>
  </div>
</div>

<script>
  setTimeout(() => {
    document.querySelectorAll('.loading1, .loading2, .loading3')
      .forEach(el => el.style.opacity = '0');

    const firstDot = document.querySelector('.loading1');
    const blink    = document.querySelector('.blinking');

    firstDot.parentNode.insertBefore(blink, firstDot);
    blink.style.opacity = '1';
  }, 1500);
</script>