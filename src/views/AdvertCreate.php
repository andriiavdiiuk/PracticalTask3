<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Create Advert</div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                            <div class="text-danger">
                                <?php
                                if (isset($this->data["errors"]["title"]))
                                {
                                    echo $this->data["errors"]["title"];
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                            <div class="text-danger">
                            <?php
                            if (isset($this->data["errors"]["description"]))
                            {
                                echo $this->data["errors"]["description"];
                            }
                            ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="categories" class="form-label">Categories</label>
                            <select id="categories" name="categories[]"  class="form-select" multiple>
                                <?php
                                    foreach(  $this->data["categories"] as $category)
                                    {
                                        echo '<option value="' . $category->getCategoryId() . '">' . $category->getCategoryName() . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control">
                            <div class="text-danger">
                            <?php
                            if (isset($this->data["errors"]["price"]))
                            {
                                echo $this->data["errors"]["price"];
                            }
                            ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>