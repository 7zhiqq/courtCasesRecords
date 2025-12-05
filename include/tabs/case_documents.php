<?php
    $docsQuery = "
        SELECT * 
        FROM case_documents_tbl 
        WHERE case_id = '$case_number' 
        ORDER BY upload_date DESC
    ";
    $docsResult = mysqli_query($conn, $docsQuery);
    $docs = mysqli_fetch_all($docsResult, MYSQLI_ASSOC);
?>

<?php if ($active === 'documents'): ?>
    <div class="p-0 rounded-3">
        <table class="table mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Document</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Upload Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php if ($documentCount == 0): ?>
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bi bi-folder-x fs-1 text-muted"></i>
                            <p class="text-muted mt-3">No documents uploaded yet</p>
                            <button class="btn btn-primary btn-sm" id="addDocsBtn">
                                <i class="bi bi-upload"></i> Upload First Document
                            </button>
                        </div>
                    </td>
                </tr>

            <?php else: ?>
                <?php mysqli_data_seek($docsResult, 0); ?>
                <?php while ($doc = mysqli_fetch_assoc($docsResult)): ?>
                <tr>
                    <td><?= htmlspecialchars($doc['document_title']); ?></td>

                    <td class="text-uppercase">
                        <?= htmlspecialchars($doc['document_type']); ?>
                    </td>

                    <td>
                        <?php 
                            $desc = htmlspecialchars($doc['description']);
                            echo strlen($desc) > 40 
                                ? nl2br(substr($desc, 0, 40)) . '...' 
                                : nl2br($desc);
                        ?>
                    </td>

                    <td><?= htmlspecialchars($doc['upload_date']); ?></td>

                    <td class="text-center">
                        <a href="<?= htmlspecialchars($doc['file_path']); ?>" 
                           target="_blank" 
                           class="btn btn-sm btn-success">
                            <i class="bi bi-eye"></i> View
                        </a>

                        <a href="<?= htmlspecialchars($doc['file_path']); ?>" 
                           download 
                           class="btn btn-sm btn-secondary">
                            <i class="bi bi-download"></i>
                        </a>

                        <button type="button" 
                                class="btn btn-sm btn-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteDoc<?= $doc['id']; ?>">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php mysqli_data_seek($docsResult, 0); ?>
    <?php while ($doc = mysqli_fetch_assoc($docsResult)): ?>
        <div class="modal fade" id="deleteDoc<?= $doc['id']; ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-exclamation-triangle"></i> Delete Document
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete 
                        <strong><?= htmlspecialchars($doc['document_title']); ?></strong>?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="case_delete_document.php?id=<?= $doc['id']; ?>&case=<?= $case_number; ?>"
                           class="btn btn-danger">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>

<?php endif; ?>
