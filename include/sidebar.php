<?php  
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
    <a href="index.php" class="menu-item 
        <?= $current_page == 'index.php' ? 'active' : '' ?>">
        <i class="bi bi-columns-gap"></i>
        Dashboard
    </a>
    <a href="cases.php" class="menu-item 
        <?= $current_page == 'cases.php' ? 'active' : '' ?>
        <?= $current_page == 'case_view.php' ? 'active' : '' ?>">
        <i class="bi bi-folder"></i> 
        Cases
    </a>
    <a href="judges.php" class="menu-item 
        <?= $current_page == 'judges.php' ? 'active' : '' ?>">
        <i class="bi bi-people"></i>
        Judges
    </a>
    <a href="lawyers.php" class="menu-item 
        <?= $current_page == 'lawyers.php' ? 'active' : '' ?>">
        <i class="bi bi-suitcase-lg"></i>
        Lawyers
    </a>
</div>
