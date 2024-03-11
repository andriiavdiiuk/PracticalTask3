<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">Register</div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">

                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control">
                            <div class="text-danger">
                                <?php
                                if (isset($this->data["errors"]["firstname"]))
                                {
                                    echo $this->data["errors"]["firstname"];
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control">
                            <div class="text-danger">
                                <?php
                                if (isset($this->data["errors"]["lastname"]))
                                {
                                    echo $this->data["errors"]["lastname"];
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email"  name="email" id="email" class="form-control">
                            <div class="text-danger">
                                <?php
                                if (isset($this->data["errors"]["email"]))
                                {
                                    echo $this->data["errors"]["email"];
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>