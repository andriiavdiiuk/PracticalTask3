<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="get" action="/adverts" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" class="form-control" name="search" placeholder="Search by Title">
                </div>
                <div class="form-group mr-2">
                    <select class="form-control" name="categories[]" multiple>
                        <?php

                        if (isset($this->data["categories"]))
                        {
                            foreach ($this->data["categories"] as $category)
                            {
                                echo '  <option value="'.$category->getCategoryName().'">'.$category->getCategoryName().'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
</div>