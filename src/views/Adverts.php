<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php
            if (isset($_SESSION["user"])) {

                echo '<a href="/advert/create" class="btn btn-primary m-md-2">Create new advert</a>';
                echo "<br><br>";
            }
            if ($this->data["adverts"] != null)
            {
                foreach ($this->data["adverts"] as $advert) {
                    echo '<div class="card">';
                    echo '<div class="card-header bg-primary text-white">';
                    echo '<a class="text-dark"href="/advert/' . $advert->getAdvertID() . '">' . $advert->getTitle() . '</a></div>';
                    echo '<div class="card-body">';
                    echo '<p>Categories:';
                    foreach ($advert->getCategories() as $category)
                        echo '<span class="badge badge-primary text-dark">' . $category->getCategoryName() . '</span>';

                    echo '</p>';
                    if ($advert->getPrice() > 0)
                    {
                        echo '<p>Price: '.$advert->getPrice().'$</p>';
                    }
                    else
                    {
                        echo '<p>Price: free</p>';
                    }

                    $status = "";
                    if (!$advert->getStatus()) {
                        $status = "Sold";
                    } else {
                        $status = "Active";
                    }
                    echo '<p>Status: ' . $status . '</p>';


                    echo '<p >Publication Date: ' . $advert->getPublicationDate()->format("d.m.Y H:i") . '</p>';
                    echo '</div></div><br>';
                }
            }
            else
            {
                echo '
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>No Adverts Found</h1>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>
</div>
