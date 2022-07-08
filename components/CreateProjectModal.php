<div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title" style="border-bottom: 2px solid #94cc6c">Add New Project</h4>
                    <button type="button" class='btn-close btn--exit-modal' data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="includes/addProject.inc.php" method="POST">
                        <div class="form-group mt-2 mb-4">
                            <label class='form-label' for="name">Project Name</label>
                            <input class='form-control' type="text" name='name' placeholder='Project Name'>
                        </div>
                        <div class="form-group mt-2 mb-3">
                            <label class='form-label' for="name">Project Description</label>
                            <textarea class='form-control' name='description' placeholder='Description'></textarea>
                        </div>
                        <input type="hidden" name='userID' value=<?= $_SESSION['userID']; ?>>
                        <button class='btn' style='background-color:#94cc6c;' name='submit'>Add Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>