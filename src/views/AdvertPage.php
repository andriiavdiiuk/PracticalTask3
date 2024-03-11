<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php

                $advert = $this->data["advert"] ;
                if (isset($_SESSION["user"]))
                {
                    if ($_SESSION["user"]["user_id"] == $advert->getUser()->getUserId())
                    {
                        echo '<a href="/advert/' . $advert->getAdvertId() . '/edit" class="btn btn-primary m-md-2">Edit</a>';
                        echo '<a href="/advert/' . $advert->getAdvertId() . '/delete" class="btn btn-danger ">Delete</a>';
                        echo "<br><br>";
                    }
                }

                echo '<div class="card">';
                echo '<div class="card-header bg-primary text-white">';
                echo '<a class="text-dark" href="/advert/'.$advert->getAdvertID().'">' .$advert->getTitle().'</a></div>';
                echo '<div class="card-body">';
                echo '<p>Creator:'.$advert->getUser()->getFirstname() ." ".$advert->getUser()->getLastname() .'</p>';
                echo '<p>Categories:';
                foreach ($advert->getCategories() as $category)
                {
                    echo '<span class="badge badge-primary text-dark">' . $category->getCategoryName() . '</span>';
                }
                echo '</p>';
                echo '<p>'.$advert->getDescription().'</p>';

                if ($advert->getPrice() > 0)
                {
                    echo '<p>Price: '.$advert->getPrice().'$</p>';
                }
                else
                {
                    echo '<p>Price: free</p>';
                }

                $status = "";
                if (!$advert->getStatus())
                {
                    $status = "Sold";
                }
                else
                {
                    $status = "Active";
                }
                echo '<p>Status: '.$status .'</p>';


                echo '<p >Publication Date: '.$advert->getPublicationDate()->format("d.m.Y H:i").'</p>';
                echo '</div></div><br>';

            ?>
        </div>
    </div>
</div>
