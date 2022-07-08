<div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title" style="border-bottom: 2px solid #94cc6c">New Member</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="includes/newMember.inc.php" method='POST'>
                        <div class="form-group mt-2 mb-3">
                            <label for="firstname">First Name</label>
                            <input class='form-control' type="text" name='firstname' placeholder='first name'>
                        </div>

                        <div class="form-group my-3">
                            <label for="lastname">Last Name</label>
                            <input class='form-control' type="text" name='lastname' placeholder='last name'>
                        </div>

                        <div class="form-group my-3">
                            <label for="email">Email</label>
                            <input class='form-control' type="email" name='email' placeholder='email'>
                        </div>

                        <div class="form-group my-3">
                            <label for="password">Password</label>
                            <input class='form-control' type="password" name='password' placeholder='password'>
                        </div>

                        <div class="form-group my-3">
                            <label for="phone">Phone</label>
                            <input class='form-control' type="tel" name='phone' placeholder='phone number'>
                        </div>

                        <div class="form-group my-3">
                            <label for="authorization">Authorization</label>
                            <select class='form-control' name="authorization">
                                <option value="0">Developer</option>
                                <option value="1">Administrator</option>
                            </select>
                        </div>
                        <button class='btn' style='background-color:#94cc6c;' name='submit'>Add Member</button>
                    </form>
                </div>

            </div>
        </div>
    </div>