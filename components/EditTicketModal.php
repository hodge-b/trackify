<div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class='mt-2'>Edit Ticket</h4>
                <button type='button' class='btn-close btn--exit-modal' data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="includes/editTicket.inc.php" method='POST'>
                    <div class="form-group mt-2 mb-3">
                        <label for="title">Title</label>
                        <?= "<input class='form-control' type='text' name='title' value='$ticketRow[ticketsTitle]'>"; ?>
                    </div>

                    <div class="form-group my-3">
                        <label for="description">Ticket Description</label>
                        <?= "<textarea class='form-control' name='description' cols='30' rows='5'>$ticketRow[ticketsDescription]</textarea>";?>
                    </div>

                    <div class="form-group my-3">
                        <label for="estimate">Time Estimate(Hours)</label>
                        <?= "<input class='form-control' type='number' name='estimate' min='1' value='$ticketRow[ticketsEstimate]'>"; ?>
                    </div>

                    <div class="form-group my-3">
                        <label for="type">Type</label>
                        <select class='form-control' name="type">
                            <option value="issue">Issue</option>
                            <option value="bug">Bug</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group my-3">
                        <label for="priority">Priority</label>
                        <select class='form-control' name="priority">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="immediate">Immediate</option>
                        </select>
                    </div>

                    <div class="form-group my-3">
                        <label for="status">Status</label>
                        <select class='form-control' name="status">
                            <option value="unresolved">Unresolved</option>
                            <option value="resolved">Resolved</option>
                        </select>
                    </div>

                    <input type="hidden" name='ticketID' value=<?= $ticketRow['ticketsID'] ?>>
                    <input type="hidden" name='projectID' value=<?= $ticketRow['ticketsProjectID'] ?>>
                    <input type="hidden" name='authorID' value=<?= $_SESSION['userID']; ?>>
                    <button type='submit' class='btn' style='background-color:#94cc6c;' name='submit'>Save</button> 
                </form>
            </div>

        </div>
    </div>
</div>