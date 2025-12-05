<?php if ($active === 'parties'): ?>
    <div class="p-0 rounded-3">
        <table class="table mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Represented by</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php if ($partyCount == 0): ?>
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bi bi-person-plus fs-1 text-muted"></i>
                            <p class="text-muted mt-3">No parties added yet</p>
                            <button class="btn btn-primary btn-sm" id="addPartyBtn">
                                <i class="bi bi-person-plus"></i> Add First Party
                            </button>
                        </div>
                    </td>
                </tr>

            <?php else: ?>
                <?php mysqli_data_seek($partyResult, 0); ?>
                <?php while ($party = mysqli_fetch_assoc($partyResult)): ?>
                <tr>
                    <td><?= htmlspecialchars($party['party_name']); ?></td>
                    <td><?= htmlspecialchars($party['role']); ?></td>
                    <td>
                        <?= $party['represented_by']
                            ? htmlspecialchars($party['represented_by'])
                            : '<span class="text-muted">—</span>' ?>
                    </td>

                    <td>
                        <?php if ($party['phone']): ?>
                            <?= htmlspecialchars($party['phone']); ?>
                        <?php else: ?>
                            <span class="text-muted">—</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?= $party['address'] 
                            ? htmlspecialchars($party['address']) 
                            : '<span class="text-muted">—</span>' ?>
                    </td>

                    <td class="text-center">
                        <button class="btn btn-warning btn-sm" id="editPartyBtn">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>

<?php include 'case_add_party.php'; ?>
<?php include 'case_edit_party.php'; ?>
<script src="js/modal.js"></script>