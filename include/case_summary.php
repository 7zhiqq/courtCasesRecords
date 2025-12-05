<div class="col-auto">
    <div class="case-card border-purple">
        <div class="case-content">
            <h6 class="text-muted">Total Cases</h6 class="text-muted">
            <h2><?= $totalCases ?></h2>
            <p>All recorded cases</p>
        </div>
        <div class="case-icon icon-purple">
            <i class="bi bi-bar-chart"></i>
        </div>
    </div>
</div>

<div class="col-auto">
    <div class="case-card border-green">
        <div class="case-content">
            <h6 class="text-muted">Open Cases</h6 class="text-muted">
            <h2><?= $openCases ?></h2>
            <p>Currently active</p>
        </div>
        <div class="case-icon icon-green">
            <i class="bi bi-check-circle"></i>
        </div>
    </div>
</div>

<div class="col-auto">
    <div class="case-card border-blue">
        <div class="case-content">
            <h6 class="text-muted">Pending Cases</h6 class="text-muted">
            <h2><?= $pendingCases ?></h2>
            <p>Awaiting action</p>
        </div>
        <div class="case-icon icon-blue">
            <i class="bi bi-clock-history"></i>
        </div>
    </div>
</div>

<div class="col-auto">
    <div class="case-card border-red">
        <div class="case-content">
            <h6 class="text-muted">High Priority</h6 class="text-muted">
            <h2><?= $highPriority ?></h2>
            <p>Urgent attention</p>
        </div>
        <div class="case-icon icon-red">
            <i class="bi bi-exclamation-circle"></i>
        </div>
    </div>
</div>