<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Edit Advert</div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" value="<?php echo $this->data["title"] ?>" class="form-control">
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
                            <textarea id="description" name="description" class="form-control" rows="4"><?php echo $this->data["advert"]->getDescription()?></textarea>
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
                            <input type="number"  value="<?php echo $this->data["advert"]->getPrice() ?>" name="price" id="price" class="form-control">
                            <div class="text-danger">
                            <?php
                            if (isset($this->data["errors"]["price"]))
                            {
                                echo $this->data["errors"]["price"];
                            }
                            ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="status" name="status" value="true" <?php if ($this->data["advert"]->getStatus()) { echo "checked"; } ?>>
                                <label class="form-check-label" for="status">Active</label>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>