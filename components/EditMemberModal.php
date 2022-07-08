<div class="modal fade" id="edit-member-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class='mt-2'>Edit Member</h4>
                <button type='button' class='btn-close btn--exit-modal' data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="includes/editMember.inc.php" method='POST'>
                        <div class="form-group mt-2 mb-3">
                            <label for="firstname">First Name</label>
                            <?= "<input class='form-control' type='text' name='firstname' value=$userRow[usersFirstName]>"?>
                        </div>

                        <div class="form-group my-3">
                            <label for="lastname">Last Name</label>
                            <?= "<input class='form-control' type='text' name='lastname' value=$userRow[usersLastName]>"?>
                        </div>

                        <div class="form-group my-3">
                            <label for="email">Email</label>
                            <?= "<input class='form-control' type='text' name='email' value=$userRow[usersEmail]>"?>
                        </div>

                        <div class="form-group my-3">
                            <label for="phone">Phone</label>
                            <?= "<input class='form-control' type='text' name='phone' value=$userRow[usersPhone]>"?>
                        </div>

                        <div class="form-group my-3">
                            <label for="authorization">Authorization</label>
                            <select class='form-control' name="auth">
                                <?php
                                    if($userRow['usersAuthorization']){
                                        echo "<option value='1'>Administrator</option>";
                                        echo "<option value='0'>Developer</option>";
                                    }else{
                                        echo "<option value='0'>Developer</option>";
                                        echo "<option value='1'>Administrator</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name='userID' value=<?= $userID?>>
                        <button class='btn' style='background-color:#94cc6c;' name='submit'>Save</button>
                    </form>
            </div>

        </div>
    </div>
</div>