<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>City Hall - News and Updates</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
       
        /* Smooth zoom animation */
        #carousel img {
            transition: transform 0.4s ease, z-index 0.4s ease;
            width: 500px; /* Adjust as needed */
            height: inherit;
            left: 175px;
            top:10px;
            cursor: pointer;
        }
        .carousel-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .carousel {
            display: flex;
            gap: 10px;
        }
        .nav {
            background: none;
            border: none;
            font-size: 2rem;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>


<main style="width: 100%;">
<div class="carousel-container">
    <button class="nav left" onclick="prevSlide()">❮</button>

    <div class="carousel" id="carousel">
        <?php
        $conn = new mysqli("localhost", "root", "", "citizenscharterdb");
        $sql = "SELECT id, title, image FROM news_updates ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<img src="uploads/' . $row["image"] . '" alt="' . htmlspecialchars($row["title"]) . '" onclick="openModal(this)">';
            }
        } else {
            echo "<p>No news or updates available.</p>";
        }
        $conn->close();
        ?>
    </div>

    <button class="nav right" onclick="nextSlide()">❯</button>
</div>
</main>

<!-- Modal -->
<div id="modal" class="modal" onclick="closeModal()">
  <span class="close" onclick="closeModal()">&times;</span>
  <img id="modalImage" class="modal-content" />
</div>

<div class="services-section">
  <!-- LEFT PANEL -->
  <div class="left-panel">
    <video class="left-video" autoplay muted loop playsinline>
      <source src="assets/videoplayback.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <h2>WELCOME TO THE<br><span>CITY TREASURER'S OFFICE</span></h2>

    <div class="button-group">
      <button><i class="fas fa-bullseye"></i> MANDATE</button>
      <button><i class="fas fa-eye"></i> VISION</button>
      <button><i class="fas fa-heart"></i> MISSION</button>
      <button><i class="fas fa-table"></i> TAX TABLE</button>
      <button><i class="fas fa-question-circle"></i> FAQS</button>
    </div>
    <a href="#" class="survey-link">
      <i></i><img src="assets/surveyimg.png" alt="">
    </a>
  </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">
    <div class="right-header">
      <center>
        <i class="fas fa-cogs touch-icon"></i> <b>EXTERNAL SERVICES
        <p>(Touch To View)</p>
        </center>
      </div>

    <ul class="services-list">
        <li><a href="externalservice/NEW&RENEWAL.html"><i class="fas fa-file-invoice-dollar"></i> RECEIPT OF PAYMENT OF BUSINESS TAXES (NEW & RENEWAL)</a></li>
        <li><a href="externalservice/BUSINESSOPERATION.html"><i class="fas fa-business-time"></i> RETIREMENT OF BUSINESS OPERATION</a></li>
        <li><a href="externalservice/LICENSEANDFEES.html"><i class="fas fa-certificate"></i> ISSUANCE OF CERTIFICATION RELATED TO BUSINESS LICENSE AND FEES</a></li>
        <li><a href="externalservice/INDIVIDUAL.html"><i class="fas fa-id-card"></i> ISSUANCE OF COMMUNITY TAX CERTIFICATE – INDIVIDUAL</a></li>
        <li><a href="externalservice/CORPORATE.html"><i class="fas fa-building"></i> ISSUANCE OF COMMUNITY TAX CERTIFICATE - CORPORATE</a></li>
        <li><a href="externalservice/PTR"><i class="fas fa-briefcase"></i> ISSUANCE OF PROFESSIONAL TAX RECEIPT (PTR)</a></li>
        <li><a href="externalservice/"><i class="fas fa-home"></i> RECEIPT OF PAYMENT OF REAL PROPERTY TAXES</a></li>
        <li><a href="service-list.php"><i class="fas fa-check-double"></i> ISSUANCE OF REAL PROPERTY TAX CLEARANCE</a></li>
        <li><a href="service-list.php"><i class="fas fa-hand-holding-usd"></i> RECEIPT OF PAYMENT OF REAL PROPERTY TRANSFER TAX</a></li>
        <li><a href="externalservice/CASHALLOWANCE.html"><i class="fas fa-coins"></i> DISBURSEMENT OF FINANCIAL ASSISTANCE / CASH ALLOWANCE</a></li>
        <li><a href="externalservice/GOVERNMENTAGENCIES.html"><i class="fas fa-truck-loading"></i> PAYMENT OF OBLIGATIONS TO SUPPLIERS, CONTRACTORS, BUSINESS ENTERPRISES, AND OTHER GOVERNMENT AGENCIES</a></li>
        <li><a href="externalservice/OFFICIALRECEIPT.html"><i class="fas fa-copy"></i> REQUEST FOR CERTIFIED TRUE COPY OF OFFICIAL RECEIPT</a></li>
    </ul>
</div>



<script src="script.js"></script>
        
</body>
</html>
