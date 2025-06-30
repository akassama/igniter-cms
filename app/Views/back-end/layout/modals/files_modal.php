<?php
$session = session();
// Get session data
$sessionUserId = $session->get('user_id');
?>

<?php if (isFeatureEnabled('FEATURE_FILE_MANAGER')): ?>
    <!--File Manager Modals-->
    <!-- Image Files Modal -->
    <div class="modal fade" id="imageFilesModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Image Files</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>File</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Uploaded At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?= getImageFilesTableData($sessionUserId); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Files Modal -->
    <div class="modal fade" id="documentFilesModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Document Files</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>File</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Uploaded At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?= getDocumentFilesTableData($sessionUserId); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Audio Files Modal -->
    <div class="modal fade" id="audioFilesModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Audio Files</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>File</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Uploaded At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?= getAudioFilesTableData($sessionUserId); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Files Modal -->
    <div class="modal fade" id="videoFilesModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Video Files</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Video</th>
                                <th>File</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Uploaded At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?= getVideoFilesTableData($sessionUserId); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- All Files Modal -->
    <div class="modal fade" id="allFilesModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">All Files</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>File</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Uploaded At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?= getAllFilesTableData($sessionUserId); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
