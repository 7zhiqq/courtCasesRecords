<div class="tabs d-flex justify-content-between align-items-center mb-3">
    <div class="case-tabs">
        <a href="?case=<?= $case_number ?>&tab=parties"
           class="case-tab <?= $active === 'parties' ? 'active' : '' ?>">
            <i class="bi bi-people-fill"></i>
            Parties <span class="count">(<?= $partyCount ?>)</span>
        </a>

        <a href="?case=<?= $case_number ?>&tab=documents"
           class="case-tab <?= $active === 'documents' ? 'active' : '' ?>">
            <i class="bi bi-folder2-open"></i>
            Documents <span class="count">(<?= $documentCount ?>)</span>
        </a>
    </div>
    
    <div class="case-tab-button d-flex gap-2">
        <button class="btn btn-primary btn-sm" id="addPartyBtn">
            <i class="bi bi-person-plus"></i> Add Party
        </button>
        <button class="btn btn-outline-primary btn-sm" id="addDocsBtn">
            <i class="bi bi-upload"></i> Upload Document
        </button>
    </div>

</div>
