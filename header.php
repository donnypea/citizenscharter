<header class="site-header">
    <div class="header-images">
        <img src="assets/office-of-treasurer.png" alt="City Logo" class="logo">
        <img src="assets/mandaue-logo.png" alt="City Seal" class="logo">
    </div>
</header>
<style>
    /* Header Styles */
.site-header {
    width: auto;
    background-color: #003366;
    color: white;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.header-images {
    margin-left: 30px;
    display: flex;
    gap: 10px;
    align-items: center;
}

.logo {
    height: 60px;
    width: auto;
    object-fit: contain;
}

.header-title {
    font-size: 24px;
    font-weight: bold;
    margin-left: 20px;
    flex-grow: 1;
    text-align: right;
}

</style>