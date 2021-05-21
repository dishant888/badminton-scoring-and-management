<?php include("header.php"); ?>
<main class="container">
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
      <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
      <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./images/img-1.jpg" class="bd-placeholder-img" width="100%" height="100%" alt="">
      </div>

      <div class="carousel-item">
        <img src="./images/img-2.jpg" class="bd-placeholder-img" width="100%" height="100%" alt="">
      </div>

      <div class="carousel-item">
        <img src="./images/img-3.jpg" class="bd-placeholder-img" width="100%" height="100%" alt="">
      </div>
    </div>

    <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>
  <br><b></b>
  <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">About Badminton Association</strong>
          <p class="card-text mb-auto">Badminton Association of India (BAI) is the governing body for Badminton in India. Based in New Delhi, BAI is an association registered under the societies act. It was formed in 1934 and has been holding national-level tournaments in India since 1936. BAI has 33 State Associations and 04 other organizations as its members that conduct Badminton tournaments...</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">Disclaimer</strong>
          <p class="mb-auto">The BAI Web Site contains information and material compiled for reference only. Information on this web site is provided solely for the user’s information and, while due care has been taken to make it accurate, it is provided without guarantee of any kind, either expressed or implied. BAI will not be liable for any legal action/ damages, direct or indirect, arising from the use of this web site.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
      </div>
    </div>
  </div>

  </div>

</main>

<?php include("footer.php"); ?>