<table class="table table-hover align-middle shadow-sm">
    <thead class="table-dark">
        <tr>
            <th class="text-center" width="130">Case ID</th>
            <th class="text-center" width="100">Type</th>
            <th width="200">Case Title</th>
            <th width="150">Judge</th>
            <th class="text-center" width="130">Filing Date</th>
            <th>Status</th>
            <th>Priority</th>
            <th class="text-center" width="140">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr id="noResultsRow" style="display: none;">
            <td colspan="8" class="text-center py-4">
                <div class="empty-state">
                    <i class="bi bi-funnel" style="font-size: 40px; color: #bfc5d2;"></i>
                    <p class="mt-2 mb-2" style="color:#555; font-size:15px;">
                        No cases found matching your filters
                    </p>
                    <button id="clearFiltersBtn" class="btn btn-outline-secondary btn-sm">
                        Clear Filters
                    </button>
                </div>
            </td>
        </tr>

        <?php foreach ($cases as $case): ?>
        <tr>
            <td class="text-center fw-semibold"><?= htmlspecialchars($case['case_number']); ?></td>
            <td><?= typeBadge($case['case_type']); ?></td>
            <td class="fw-semibold"><?= htmlspecialchars($case['case_title']); ?></td>

            <td>
                <?php if (!empty($case['judge_firstname'])): ?>
                    <?= htmlspecialchars('Hon. ' . $case['judge_firstname'] . ' ' . $case['judge_lastname']); ?>
                <?php else: ?>
                    <span class="text-muted">—</span>
                <?php endif; ?>
            </td>

            <td class="text-center"><?= htmlspecialchars($case['filing_date']); ?></td>
            <td><?= statusBadge($case['status']); ?></td>
            <td><?= priorityBadge($case['priority']); ?></td>

            <td class="text-center">
                <a href="case_view.php?case=<?= $case['case_number']; ?>" class="table-btn btn-view">View</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>