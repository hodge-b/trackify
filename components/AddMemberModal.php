<div class="modal fade" id="add-member-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog">
        
        <div class="modal-content">
            <div class="modal-header">
                <h4 class='modal-title' id='modal-title' style="border-bottom: 2px solid #94cc6c">Add Member</h4>
                <button type='button' class='btn-close' data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="includes/addMember.inc.php" method='POST'>
                    <div class="form-group my-2">
                        <select class='form-control' name="add-member" id="add-member">
                            <?php
                                $membersData = getAllUsers($conn);
                                while($memberRow = mysqli_fetch_assoc($membersData)){
                                    $role = $memberRow['usersAuthorization']? 'Admin' : 'Dev';

                                    echo "<option value='$memberRow[usersID]'>" .getUsername($conn, $memberRow['usersID']). " - " .$role. "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <input type="hidden" name='projectID' value=<?= $projectRow['projectsID'] ?>>
                        <input type="hidden" name='authorID' value=<?= $_SESSION['userID']; ?>>
                        <button class='btn' style='background-color: #94cc6c;' type='submit' name='submit'>Add Member</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>